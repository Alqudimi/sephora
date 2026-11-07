<?php

namespace App\Filament\Resources\CartResource\RelationManagers;

use App\Filament\Resources\ProductResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('product.name')
                    ->limit(35)
                    ->url(fn ($record): ?string => $record->product
                        ? ProductResource::getUrl('edit', ['record' => $record->product])
                        : null),

                TextColumn::make('shade_name')
                    ->placeholder('—')
                    ->badge(),

                TextColumn::make('quantity')
                    ->badge(),

                TextColumn::make('line_value')
                    ->label('Line value')
                    ->money('AED')
                    ->state(fn ($record): float => ($record->product?->price ?? 0) * $record->quantity),

                TextColumn::make('created_at')
                    ->label('Added')
                    ->since(),
            ]);
    }
}
