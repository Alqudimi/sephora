<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Support\CommerceSettings;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LowStockWidget extends TableWidget
{
    /**
     * Stock levels are operational data — visible to every staff role.
     */
    protected static ?string $heading = 'Low stock alert';

    protected static ?string $description = 'Products running low on stock.';

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = [
        'md' => 2,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => Product::query()
                ->where('stock', '>', 0)
                ->where('stock', '<', CommerceSettings::lowStockThreshold())
                ->orderBy('stock'))
            ->columns([
                TextColumn::make('name')
                    ->limit(35)
                    ->url(fn ($record): string => ProductResource::getUrl('edit', ['record' => $record])),

                TextColumn::make('brand.name')
                    ->placeholder('—')
                    ->limit(15),

                TextColumn::make('stock')
                    ->badge()
                    ->color(fn (int $state): string => $state <= 0 ? 'danger' : 'warning'),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->paginated([5]);
    }
}
