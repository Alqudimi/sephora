<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Support\CommerceSettings;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class ShopStatsWidget extends StatsOverviewWidget
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

    protected static ?int $sort = 0;

    protected int|string|array $columnSpan = 'full';

    protected ?string $heading = 'Store performance';

    protected ?string $description = 'Revenue is based on paid and active (non-cancelled, non-refunded) orders.';

    protected function getStats(): array
    {
        $revenueQuery = Order::query()
            ->whereNotIn('status', ['cancelled', 'refunded']);

        $revenue30 = (clone $revenueQuery)
            ->where('placed_at', '>=', now()->subDays(30))
            ->sum('total');

        $revenuePrev30 = (clone $revenueQuery)
            ->whereBetween('placed_at', [now()->subDays(60), now()->subDays(30)])
            ->sum('total');

        $orders30 = (clone $revenueQuery)
            ->where('placed_at', '>=', now()->subDays(30))
            ->count();

        $ordersPrev30 = (clone $revenueQuery)
            ->whereBetween('placed_at', [now()->subDays(60), now()->subDays(30)])
            ->count();

        $avgOrderValue = $orders30 > 0 ? $revenue30 / $orders30 : 0;
        $aovPrev = $ordersPrev30 > 0 ? $revenuePrev30 / $ordersPrev30 : 0;

        $customers = User::query()->where(function ($query): void {
            $query->where('is_admin', false)->whereNull('role');
        })->orWhere(function ($query): void {
            $query->where('is_admin', false)->whereNotIn('role', ['admin', 'manager', 'support']);
        })->count();

        $lowStock = Product::query()
            ->where('stock', '>', 0)
            ->where('stock', '<', CommerceSettings::lowStockThreshold())
            ->count();
        $pendingReviews = Review::query()->where('is_approved', false)->count();
        $newMessages = ContactMessage::query()->where('status', 'new')->count();
        $pendingOrders = Order::query()->whereIn('status', ['pending', 'processing'])->count();

        return [
            Stat::make('Revenue (30 days)', Number::currency($revenue30, 'AED'))
                ->description($this->trend($revenue30, $revenuePrev30))
                ->descriptionIcon($revenue30 >= $revenuePrev30 ? Heroicon::OutlinedArrowTrendingUp : Heroicon::OutlinedArrowTrendingDown)
                ->color($revenue30 >= $revenuePrev30 ? 'success' : 'danger')
                ->chart($this->revenueChart()),

            Stat::make('Orders (30 days)', Number::format($orders30))
                ->description($this->trend($orders30, $ordersPrev30))
                ->descriptionIcon($orders30 >= $ordersPrev30 ? Heroicon::OutlinedArrowTrendingUp : Heroicon::OutlinedArrowTrendingDown)
                ->color($orders30 >= $ordersPrev30 ? 'success' : 'danger'),

            Stat::make('Avg order value', Number::currency($avgOrderValue, 'AED'))
                ->description($this->trend($avgOrderValue, $aovPrev))
                ->descriptionIcon($avgOrderValue >= $aovPrev ? Heroicon::OutlinedArrowTrendingUp : Heroicon::OutlinedArrowTrendingDown)
                ->color($avgOrderValue >= $aovPrev ? 'success' : 'danger'),

            Stat::make('Customers', Number::format($customers))
                ->description('registered accounts')
                ->descriptionIcon(Heroicon::OutlinedUsers),

            Stat::make('Open orders', Number::format($pendingOrders))
                ->description('pending & processing')
                ->descriptionIcon(Heroicon::OutlinedClock)
                ->color($pendingOrders > 0 ? 'warning' : 'gray'),

            Stat::make('Low stock products', Number::format($lowStock))
                ->description('at or below the low-stock threshold')
                ->descriptionIcon(Heroicon::OutlinedExclamationTriangle)
                ->color($lowStock > 0 ? 'danger' : 'success'),

            Stat::make('Reviews to moderate', Number::format($pendingReviews))
                ->description('awaiting approval')
                ->descriptionIcon(Heroicon::OutlinedStar)
                ->color($pendingReviews > 0 ? 'warning' : 'success'),

            Stat::make('New messages', Number::format($newMessages))
                ->description('contact requests')
                ->descriptionIcon(Heroicon::OutlinedInbox)
                ->color($newMessages > 0 ? 'warning' : 'success'),
        ];
    }

    private function trend(float $current, float $previous): string
    {
        if ($previous <= 0) {
            return 'No data for the previous period';
        }

        $change = round((($current - $previous) / $previous) * 100);

        return sprintf('%d%% vs previous 30 days', $change);
    }

    /**
     * @return array<int, float>
     */
    private function revenueChart(): array
    {
        return Order::query()
            ->whereNotIn('status', ['cancelled', 'refunded'])
            ->where('placed_at', '>=', now()->subDays(14))
            ->selectRaw('substr(placed_at, 1, 10) AS day, SUM(total) AS revenue')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('revenue')
            ->map(fn ($value) => (float) $value)
            ->all();
    }
}
