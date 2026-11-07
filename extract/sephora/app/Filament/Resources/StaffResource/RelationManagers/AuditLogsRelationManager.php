<?php

namespace App\Filament\Resources\StaffResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AuditLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'auditLogs';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextColumn::make('description'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('action')
                    ->badge()
                    ->color('info'),

                TextColumn::make('description')
                    ->limit(80)
                    ->wrap(),

                TextColumn::make('old_values')
                    ->formatStateUsing(fn ($state): string => is_array($state) ? json_encode($state) : (string) $state)
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('new_values')
                    ->formatStateUsing(fn ($state): string => is_array($state) ? json_encode($state) : (string) $state)
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('ip_address')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->bulkActions([]);
    }
}
