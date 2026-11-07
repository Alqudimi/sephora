<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Filament\Resources\ProductResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WishlistRelationManager extends RelationManager
{
    protected static string $relationship = 'wishlist';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('first_image')
                    ->label('')
                    ->square()
                    ->size(40),

                TextColumn::make('name')
                    ->limit(35)
                    ->url(fn ($record): string => ProductResource::getUrl('edit', ['record' => $record])),

                TextColumn::make('brand.name'),

                TextColumn::make('price')
                    ->money('AED'),

                TextColumn::make('pivot.created_at')
                    ->label('Added')
                    ->since(),
            ]);
    }
}
