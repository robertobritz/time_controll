<?php

namespace App\Filament\Resources\Timers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TimerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(auth()->id()),
                TextInput::make('description')
                    ->maxLength(255)
                    ->placeholder('What are you working on?'),
                DateTimePicker::make('started_at')
                    ->required()
                    ->default(now()),
                DateTimePicker::make('stopped_at'),
                TextInput::make('duration')
                    ->numeric()
                    ->suffix('seconds')
                    ->disabled()
                    ->dehydrated(false)
                    ->placeholder('Auto-calculated'),
            ]);
    }
}
