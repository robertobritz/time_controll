<?php

namespace App\Filament\Resources\Timers\Pages;

use App\Filament\Resources\Timers\TimerResource;
use App\Filament\Widgets\TimeTrackerDashboardWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTimers extends ListRecords
{
    protected static string $resource = TimerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TimeTrackerDashboardWidget::class,
        ];
    }
}
