<?php

namespace App\Filament\Resources\CouponResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RedemptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'redemptions';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('email')
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->placeholder('guest')
                    ->badge(),

                TextColumn::make('email')
                    ->copyable(),

                TextColumn::make('order.order_number')
                    ->url(fn ($record): ?string => $record->order
                        ? OrderResource::getUrl('view', ['record' => $record->order])
                        : null),

                TextColumn::make('amount')
                    ->money('AED')
                    ->color('danger'),
            ]);
    }
}
