<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\DoughnutChartWidget;

class OrderStatusChartWidget extends DoughnutChartWidget
{
    protected ?string $heading = 'Orders by status';

    protected ?string $description = 'All-time order pipeline.';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 1,
    ];

    protected ?array $options = [
        'plugins' => [
            'legend' => ['position' => 'right'],
        ],
        'cutout' => '62%',
    ];

    protected function getData(): array
    {
        $counts = Order::query()
            ->selectRaw('status, COUNT(*) AS count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $labels = [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'out_for_delivery' => 'Out for delivery',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
            'refunded' => 'Refunded',
        ];

        $colors = [
            'pending' => '#f59e0b',
            'processing' => '#0ea5e9',
            'shipped' => '#6366f1',
            'out_for_delivery' => '#8b5cf6',
            'delivered' => '#10b981',
            'cancelled' => '#ef4444',
            'refunded' => '#9ca3af',
        ];

        return [
            'datasets' => [
                [
                    'data' => array_values($labels) ? array_map(fn ($status) => (int) ($counts[$status] ?? 0), array_keys($labels)) : [],
                    'backgroundColor' => array_values($colors),
                ],
            ],
            'labels' => array_values($labels),
        ];
    }
}
