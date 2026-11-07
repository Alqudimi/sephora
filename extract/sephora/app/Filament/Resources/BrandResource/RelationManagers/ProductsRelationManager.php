<?php

namespace App\Filament\Resources\BrandResource\RelationManagers;

use App\Filament\Resources\ProductResource;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

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
                    ->searchable()
                    ->limit(35),

                TextColumn::make('price')
                    ->money('AED')
                    ->sortable(),

                TextColumn::make('stock')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state < 10 => 'warning',
                        default => 'success',
                    }),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->actions([
                EditAction::make()
                    ->url(fn ($record): string => ProductResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
