<x-filament-widgets::widget>
    <x-filament::section>
        <div x-data="{
            init() {
                setInterval(() => {
                    if ({{ $isRunning ? 'true' : 'false' }}) {
                        $wire.dispatch('tick');
                    }
                }, 1000);
            }
        }">
            <!-- Timer Header -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <x-filament::icon icon="heroicon-o-clock" class="w-6 h-6 text-gray-500 dark:text-gray-400" />
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Time Tracker
                    </h3>
                </div>
                @if ($isRunning)
                    <x-filament::badge color="success">
                        <div class="flex items-center gap-1.5">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-success-500"></span>
                            </span>
                            Running
                        </div>
                    </x-filament::badge>
                @endif
            </div>

            <!-- Timer Controls - Forced Single Line -->
            <div style="display: flex; flex-wrap: nowrap; align-items: center; gap: 0.75rem;">
                <!-- Description Input -->
                <div style="flex: 1; min-width: 0;">
                    <input type="text" wire:model.live="description" placeholder="What are you working on?"
                        class="fi-input block w-full border-gray-300 rounded-lg shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                </div>

                <!-- Timer Display -->
                <div style="font-size: 1.5rem; font-family: ui-monospace, monospace; font-weight: bold; white-space: nowrap; flex-shrink: 0;"
                    class="text-primary-600 dark:text-primary-400">
                    {{ $this->formattedTime }}
                </div>

                <!-- Start/Stop Button -->
                <div style="flex-shrink: 0;">
                    @if ($isRunning)
                        <x-filament::button wire:click="stop" color="danger" icon="heroicon-o-stop" size="lg">
                            Stop
                        </x-filament::button>
                    @else
                        <x-filament::button wire:click="start" color="primary" icon="heroicon-o-play" size="lg">
                            Start
                        </x-filament::button>
                    @endif
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
