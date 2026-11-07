<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentOrdersWidget extends TableWidget
{
    protected static ?string $heading = 'Latest orders';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = [
        'md' => 2,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query()->latest('placed_at'))
            ->columns([
                TextColumn::make('order_number')
                    ->weight('bold')
                    ->url(fn ($record): string => OrderResource::getUrl('view', ['record' => $record])),

                TextColumn::make('customer_name')
                    ->limit(22),

                TextColumn::make('total')
                    ->money('AED'),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => str($state)->headline())
                    ->colors(OrderResource::statusColors()),

                TextColumn::make('placed_at')
                    ->since(),
            ])
            ->paginated([5]);
    }
}
