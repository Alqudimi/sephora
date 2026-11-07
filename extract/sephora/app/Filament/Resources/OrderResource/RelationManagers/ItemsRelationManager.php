<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Filament\Resources\ProductResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ImageColumn;
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
            ->recordTitleAttribute('product_name')
            ->columns([
                ImageColumn::make('image_path')
                    ->label('')
                    ->square()
                    ->size(44)
                    ->state(fn ($record): string => media_url($record->image_path)),

                TextColumn::make('product_name')
                    ->weight('bold')
                    ->limit(35)
                    ->url(fn ($record): ?string => $record->product
                        ? ProductResource::getUrl('edit', ['record' => $record->product])
                        : null),

                TextColumn::make('brand_name')
                    ->placeholder('—'),

                TextColumn::make('shade_name')
                    ->placeholder('—')
                    ->badge(),

                TextColumn::make('unit_price')
                    ->money('AED'),

                TextColumn::make('quantity')
                    ->badge(),

                TextColumn::make('line_total')
                    ->money('AED')
                    ->weight('bold'),
            ]);
    }
}
