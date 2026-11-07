<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProductResource;
use App\Models\OrderItem;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TopProductsWidget extends TableWidget
{
    /**
     * Revenue KPIs are business intelligence — same rule as the Reports
     * page (managers and admins only; support keeps the operational view).
     */
    public static function canView(): bool
    {
        $user = auth()->user();

        return $user !== null && ($user->isAdmin() || $user->hasRole('manager'));
    }

    protected static ?string $heading = 'Best-selling products';

    protected static ?string $description = 'Units sold and revenue, all time.';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = [
        'md' => 2,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('name')
                    ->label('Product')
                    ->limit(35)
                    ->url(fn ($record): string => ProductResource::getUrl('edit', ['record' => $record->product_id])),

                TextColumn::make('units')
                    ->badge()
                    ->color('info'),

                TextColumn::make('revenue')
                    ->money('AED')
                    ->weight('bold'),
            ])
            ->paginated(false);
    }

    protected function getTableQuery(): Builder
    {
        return OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereNotIn('orders.status', ['cancelled', 'refunded'])
            ->groupBy('order_items.product_id', 'order_items.product_name')
            ->selectRaw('order_items.product_id, order_items.product_name AS name, SUM(order_items.quantity) AS units, SUM(order_items.line_total) AS revenue')
            ->orderByDesc('units')
            ->limit(8);
    }

    /**
     * The rows are aggregated per product and carry no real primary key,
     * so identify them by product id instead.
     */
    public function getTableRecordKey(Model|array $record): string
    {
        $productKey = is_array($record)
            ? ($record['product_id'] ?? null)
            : $record->product_id;

        return (string) $productKey;
    }
}
