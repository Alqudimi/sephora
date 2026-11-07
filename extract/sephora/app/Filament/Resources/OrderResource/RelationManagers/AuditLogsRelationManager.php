<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AuditLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'auditLogs';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('action')
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->placeholder('system')
                    ->badge()
                    ->color('info'),

                TextColumn::make('action')
                    ->badge()
                    ->colors([
                        'info' => ['order.status.updated'],
                        'success' => ['order.payment.marked_paid', 'order.payment.confirmed'],
                        'danger' => ['order.cancelled', 'order.refunded'],
                    ]),

                TextColumn::make('description')
                    ->limit(60)
                    ->wrap(),

                TextColumn::make('ip_address')
                    ->placeholder('—'),
            ]);
    }
}
