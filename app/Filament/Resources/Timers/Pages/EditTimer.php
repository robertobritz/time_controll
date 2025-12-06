<?php

namespace App\Filament\Resources\Timers\Pages;

use App\Filament\Resources\Timers\TimerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTimer extends EditRecord
{
    protected static string $resource = TimerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
