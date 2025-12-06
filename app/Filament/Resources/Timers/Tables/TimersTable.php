<?php

namespace App\Filament\Resources\Timers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TimersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('description')
                    ->searchable()
                    ->placeholder('No description')
                    ->limit(50),
                TextColumn::make('started_at')
                    ->label('Started')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                TextColumn::make('stopped_at')
                    ->label('Stopped')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->placeholder('Running'),
                TextColumn::make('duration')
                    ->label('Duration')
                    ->formatStateUsing(fn($state) => gmdate('H:i:s', $state ?? 0))
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('started_at', 'desc');
    }
}
