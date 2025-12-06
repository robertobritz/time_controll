<?php

namespace App\Filament\Resources\Timers;

use App\Filament\Resources\Timers\Pages\CreateTimer;
use App\Filament\Resources\Timers\Pages\EditTimer;
use App\Filament\Resources\Timers\Pages\ListTimers;
use App\Filament\Resources\Timers\Schemas\TimerForm;
use App\Filament\Resources\Timers\Tables\TimersTable;
use App\Models\Timer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TimerResource extends Resource
{
    protected static ?string $model = Timer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static ?string $navigationLabel = 'Time Entries';

    protected static ?string $modelLabel = 'Time Entry';

    protected static ?string $pluralModelLabel = 'Time Entries';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $schema): Schema
    {
        return TimerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TimersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTimers::route('/'),
            'create' => CreateTimer::route('/create'),
            'edit' => EditTimer::route('/{record}/edit'),
        ];
    }
}
