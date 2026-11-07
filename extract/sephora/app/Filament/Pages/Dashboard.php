<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LowStockWidget;
use App\Filament\Widgets\OrderStatusChartWidget;
use App\Filament\Widgets\RecentOrdersWidget;
use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\ShopStatsWidget;
use App\Filament\Widgets\TopProductsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    public function getColumns(): int|array
    {
        return [
            'default' => 1,
            'md' => 2,
            'xl' => 4,
        ];
    }

    public function getWidgets(): array
    {
        return [
            ShopStatsWidget::class,
            RevenueChartWidget::class,
            OrderStatusChartWidget::class,
            RecentOrdersWidget::class,
            TopProductsWidget::class,
            LowStockWidget::class,
        ];
    }
}
