<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChartWidget extends ChartWidget
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

    protected ?string $heading = 'Revenue & orders';

    protected ?string $description = 'Daily revenue and order count over the selected window.';

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    public ?string $filter = '30';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            '7' => 'Last 7 days',
            '30' => 'Last 30 days',
            '90' => 'Last 90 days',
        ];
    }

    protected function getData(): array
    {
        $days = (int) ($this->filter ?? '30');

        $range = collect(range($days - 1, 0))->map(fn (int $day): Carbon => now()->subDays($day)->startOfDay());

        $query = Order::query()
            ->whereNotIn('status', ['cancelled', 'refunded'])
            ->where('placed_at', '>=', $range->first());

        $revenueByDay = (clone $query)
            ->selectRaw('DATE(placed_at) AS day, SUM(total) AS revenue')
            ->groupBy('day')
            ->pluck('revenue', 'day');

        $ordersByDay = (clone $query)
            ->selectRaw('DATE(placed_at) AS day, COUNT(*) AS count')
            ->groupBy('day')
            ->pluck('count', 'day');

        $labels = $range->map(fn (Carbon $date): string => $date->format('d M'));

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (AED)',
                    'data' => $range->map(fn (Carbon $date) => (float) ($revenueByDay[$date->format('Y-m-d')] ?? 0))->all(),
                    'borderColor' => '#e50046',
                    'backgroundColor' => 'rgba(229, 0, 70, 0.08)',
                    'fill' => true,
                    'tension' => 0.35,
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Orders',
                    'data' => $range->map(fn (Carbon $date) => (int) ($ordersByDay[$date->format('Y-m-d')] ?? 0))->all(),
                    'borderColor' => '#1a1a1a',
                    'backgroundColor' => '#1a1a1a',
                    'type' => 'bar',
                    'yAxisID' => 'y1',
                ],
            ],
            'labels' => $labels->all(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'beginAtZero' => true,
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'beginAtZero' => true,
                    'grid' => ['drawOnChartArea' => false],
                ],
            ],
            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],
        ];
    }
}
