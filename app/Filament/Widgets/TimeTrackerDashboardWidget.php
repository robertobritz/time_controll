<?php

namespace App\Filament\Widgets;

use App\Models\Timer;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Livewire\Attributes\On;

class TimeTrackerDashboardWidget extends Widget
{
    protected string $view = 'filament.widgets.time-tracker-dashboard-widget';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = -1;

    public $description = '';
    public $isRunning = false;
    public $currentTimer = null;
    public $elapsedTime = 0;

    public function mount(): void
    {
        $this->checkActiveTimer();
    }

    public function checkActiveTimer(): void
    {
        $activeTimer = auth()->user()
            ->timers()
            ->whereNull('stopped_at')
            ->first();

        if ($activeTimer) {
            $this->currentTimer = $activeTimer;
            $this->isRunning = true;
            $this->description = $activeTimer->description ?? '';
            $this->calculateElapsedTime();
        }
    }

    public function calculateElapsedTime(): void
    {
        if ($this->currentTimer) {
            $this->elapsedTime = Carbon::parse($this->currentTimer->started_at)
                ->diffInSeconds(Carbon::now());
        }
    }

    #[On('tick')]
    public function tick(): void
    {
        if ($this->isRunning) {
            $this->calculateElapsedTime();
        }
    }

    public function start(): void
    {
        if ($this->isRunning) {
            return;
        }

        $this->currentTimer = Timer::create([
            'user_id' => auth()->id(),
            'description' => $this->description,
            'started_at' => Carbon::now(),
        ]);

        $this->isRunning = true;
        $this->elapsedTime = 0;

        $this->dispatch('timer-started');
    }

    public function stop(): void
    {
        if (!$this->isRunning || !$this->currentTimer) {
            return;
        }

        $stoppedAt = Carbon::now();
        $duration = Carbon::parse($this->currentTimer->started_at)
            ->diffInSeconds($stoppedAt);

        $this->currentTimer->update([
            'stopped_at' => $stoppedAt,
            'duration' => $duration,
            'description' => $this->description,
        ]);

        $this->isRunning = false;
        $this->currentTimer = null;
        $this->elapsedTime = 0;
        $this->description = '';

        $this->dispatch('timer-stopped');
    }

    public function getFormattedTimeProperty(): string
    {
        $hours = floor($this->elapsedTime / 3600);
        $minutes = floor(($this->elapsedTime % 3600) / 60);
        $seconds = $this->elapsedTime % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
