<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('order_number')
            ->defaultSort('placed_at', 'desc')
            ->columns([
                TextColumn::make('order_number')
                    ->weight('bold')
                    ->url(fn ($record): string => OrderResource::getUrl('view', ['record' => $record])),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => str($state)->headline())
                    ->colors(OrderResource::statusColors()),

                TextColumn::make('total')
                    ->money('AED')
                    ->sortable(),

                TextColumn::make('placed_at')
                    ->since()
                    ->sortable(),
            ]);
    }
}
