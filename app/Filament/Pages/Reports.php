<?php

namespace App\Filament\Pages;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
use App\Models\WishlistItem;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Reports extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected string $view = 'filament.pages.reports';

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?string $title = 'Reports & Analytics';

    protected static ?int $navigationSort = 2;

    /**
     * Business intelligence is a manager/admin concern — support staff
     * get the operational dashboard instead.
     */
    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user !== null && ($user->isAdmin() || $user->hasRole('manager'));
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'range' => '30',
            'from' => now()->subDays(30)->format('Y-m-d'),
            'to' => now()->format('Y-m-d'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Grid::make(3)
                    ->schema([
                        Select::make('range')
                            ->label('Period')
                            ->options([
                                '7' => 'Last 7 days',
                                '30' => 'Last 30 days',
                                '90' => 'Last 90 days',
                                '365' => 'Last 12 months',
                                'custom' => 'Custom range',
                            ])
                            ->live()
                            ->afterStateUpdated(fn () => $this->applyPresetRange())
                            ->columnSpan(1),

                        DatePicker::make('from')
                            ->label('From')
                            ->live()
                            ->maxDate(now())
                            ->visible(fn ($get) => $get('range') === 'custom'),

                        DatePicker::make('to')
                            ->label('To')
                            ->live()
                            ->maxDate(now())
                            ->visible(fn ($get) => $get('range') === 'custom'),
                    ]),
            ]);
    }

    public function applyPresetRange(): void
    {
        $days = (int) ($this->data['range'] ?? '30');

        if ($days > 0) {
            $this->data['from'] = now()->subDays($days)->format('Y-m-d');
            $this->data['to'] = now()->format('Y-m-d');
        }
    }

    private function period(): array
    {
        $from = Carbon::parse($this->data['from'] ?? now()->subDays(30)->format('Y-m-d'))->startOfDay();
        $to = Carbon::parse($this->data['to'] ?? now()->format('Y-m-d'))->endOfDay();

        return [$from, $to];
    }

    private function baseOrderQuery()
    {
        [$from, $to] = $this->period();

        return Order::query()
            ->whereNotIn('status', ['cancelled', 'refunded'])
            ->whereBetween('placed_at', [$from, $to]);
    }

    public function getSummaryStats(): array
    {
        $query = $this->baseOrderQuery();

        $revenue = (clone $query)->sum('total');
        $orders = (clone $query)->count();
        $discount = (clone $query)->sum('discount');
        $shipping = (clone $query)->sum('shipping_fee');
        $unitsSold = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereNotIn('orders.status', ['cancelled', 'refunded'])
            ->whereBetween('orders.placed_at', $this->period())
            ->sum('order_items.quantity');

        $newCustomers = User::query()
            ->whereBetween('created_at', $this->period())
            ->where(fn ($q) => $q->where('is_admin', false)->orWhereNull('is_admin'))
            ->count();

        return [
            'revenue' => Number::currency($revenue, 'AED'),
            'orders' => Number::format($orders),
            'aov' => Number::currency($orders > 0 ? $revenue / $orders : 0, 'AED'),
            'units_sold' => Number::format($unitsSold),
            'discount_given' => Number::currency($discount, 'AED'),
            'shipping_collected' => Number::currency($shipping, 'AED'),
            'new_customers' => Number::format($newCustomers),
        ];
    }

    public function getTopProducts(): array
    {
        return OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereNotIn('orders.status', ['cancelled', 'refunded'])
            ->whereBetween('orders.placed_at', $this->period())
            ->groupBy('order_items.product_name')
            ->selectRaw('order_items.product_name AS name, SUM(order_items.quantity) AS units, SUM(order_items.line_total) AS revenue')
            ->orderByDesc('revenue')
            ->limit(10)
            ->get()
            ->all();
    }

    public function getTopBrands(): array
    {
        return OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereNotIn('orders.status', ['cancelled', 'refunded'])
            ->whereBetween('orders.placed_at', $this->period())
            ->whereNotNull('order_items.brand_name')
            ->groupBy('order_items.brand_name')
            ->selectRaw('order_items.brand_name AS name, SUM(order_items.quantity) AS units, SUM(order_items.line_total) AS revenue')
            ->orderByDesc('revenue')
            ->limit(10)
            ->get()
            ->all();
    }

    public function getTopEmirates(): array
    {
        return $this->baseOrderQuery()
            ->whereNotNull('emirate')
            ->groupBy('emirate')
            ->selectRaw('emirate AS name, COUNT(*) AS orders, SUM(total) AS revenue')
            ->orderByDesc('revenue')
            ->limit(10)
            ->get()
            ->all();
    }

    public function getPaymentMethods(): array
    {
        return $this->baseOrderQuery()
            ->groupBy('payment_method')
            ->selectRaw('payment_method AS name, COUNT(*) AS orders, SUM(total) AS revenue')
            ->orderByDesc('orders')
            ->get()
            ->map(function ($row): array {
                $labels = [
                    'card' => 'Card',
                    'apple_pay' => 'Apple Pay',
                    'tabby' => 'Tabby',
                    'tamara' => 'Tamara',
                    'cod' => 'Cash on Delivery',
                ];

                return [
                    'name' => $labels[$row->name] ?? $row->name,
                    'orders' => $row->orders,
                    'revenue' => $row->revenue,
                ];
            })
            ->all();
    }

    public function getDeliveryMethods(): array
    {
        $labels = [
            'standard' => 'Standard',
            'same_day' => 'Same-day',
            'click_collect' => 'Click & Collect',
        ];

        return $this->baseOrderQuery()
            ->groupBy('delivery_method')
            ->selectRaw('delivery_method AS name, COUNT(*) AS orders')
            ->orderByDesc('orders')
            ->get()
            ->map(fn ($row): array => [
                'name' => $labels[$row->name] ?? $row->name,
                'orders' => $row->orders,
            ])
            ->all();
    }

    public function getTopCustomers(): array
    {
        return $this->baseOrderQuery()
            ->whereNotNull('user_id')
            ->with('user')
            ->groupBy('user_id', 'customer_name', 'customer_email')
            ->selectRaw('user_id, customer_name, customer_email, COUNT(*) AS orders, SUM(total) AS revenue')
            ->orderByDesc('revenue')
            ->limit(10)
            ->get()
            ->all();
    }

    public function getRevenueTrend(): array
    {
        [$from, $to] = $this->period();

        $days = $from->diffInDays($to) + 1;

        // Bucket long ranges into months for a readable chart.
        if ($days > 90) {
            $buckets = Order::query()
                ->whereNotIn('status', ['cancelled', 'refunded'])
                ->whereBetween('placed_at', [$from, $to])
                ->selectRaw("strftime('%Y-%m', placed_at) AS bucket, SUM(total) AS revenue")
                ->groupBy('bucket')
                ->orderBy('bucket')
                ->pluck('revenue', 'bucket');

            return [
                'labels' => $buckets->keys()->map(fn ($m) => Carbon::parse($m.'-01')->format('M Y'))->all(),
                'data' => $buckets->values()->map(fn ($v) => (float) $v)->all(),
            ];
        }

        $range = collect(range(0, max(0, $days - 1)))->map(fn (int $i): Carbon => $from->copy()->addDays($i));

        $byDay = Order::query()
            ->whereNotIn('status', ['cancelled', 'refunded'])
            ->whereBetween('placed_at', [$from, $to])
            ->selectRaw('DATE(placed_at) AS day, SUM(total) AS revenue')
            ->groupBy('day')
            ->pluck('revenue', 'day');

        return [
            'labels' => $range->map(fn (Carbon $date) => $date->format('d M'))->all(),
            'data' => $range->map(fn (Carbon $date) => (float) ($byDay[$date->format('Y-m-d')] ?? 0))->all(),
        ];
    }

    // ─────────────────────────────────────────────────────────
    // Extended analytics (coupons, VAT, reviews, refunds,
    // wishlists, abandoned carts) + per-section CSV export.
    // ─────────────────────────────────────────────────────────

    public function getCouponPerformance(): array
    {
        $rows = $this->baseOrderQuery()
            ->whereNotNull('coupon_code')
            ->where('discount', '>', 0)
            ->groupBy('coupon_code')
            ->selectRaw('coupon_code AS code, COUNT(*) AS orders, SUM(discount) AS discount')
            ->orderByDesc('discount')
            ->get();

        $limits = Coupon::query()->pluck('usage_limit', 'code');

        return $rows->map(function ($row) use ($limits): array {
            return [
                'code' => $row->code,
                'orders' => (int) $row->orders,
                'discount' => (float) $row->discount,
                'usage_limit' => $limits[$row->code] ?? null,
            ];
        })->all();
    }

    public function getVatSummary(): array
    {
        $query = $this->baseOrderQuery();

        $taxable = (clone $query)->sum('subtotal_ex_tax');
        $vat = (clone $query)->sum('tax_amount');
        $gross = (clone $query)->sum('total');

        return [
            'taxable' => (float) $taxable,
            'vat' => (float) $vat,
            'gross' => (float) $gross,
            'rate_percent' => $gross > 0 ? round($vat / max(1, $gross - $vat) * 100, 2) : 0.0,
        ];
    }

    public function getReviewsSummary(): array
    {
        [$from, $to] = $this->period();

        $rows = Review::query()
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('rating')
            ->selectRaw('rating, COUNT(*) AS count')
            ->pluck('count', 'rating');

        $total = $rows->sum();

        return [
            'distribution' => collect(range(5, 1))->map(fn (int $stars): array => [
                'stars' => $stars,
                'count' => (int) ($rows[$stars] ?? 0),
                'percent' => $total > 0 ? round(($rows[$stars] ?? 0) / $total * 100) : 0,
            ])->all(),
            'total' => (int) $total,
            'average' => $total > 0 ? round($rows->map(fn ($count, $rating) => $count * $rating)->sum() / $total, 2) : 0.0,
        ];
    }

    public function getRefundsSummary(): array
    {
        [$from, $to] = $this->period();

        $refunded = Order::query()
            ->whereBetween('placed_at', [$from, $to])
            ->where('status', 'refunded');
        $cancelled = Order::query()
            ->whereBetween('placed_at', [$from, $to])
            ->where('status', 'cancelled');

        return [
            'refunded_orders' => (clone $refunded)->count(),
            'refunded_amount' => (float) (clone $refunded)->sum('refund_amount'),
            'cancelled_orders' => (clone $cancelled)->count(),
            'cancelled_value' => (float) (clone $cancelled)->sum('total'),
        ];
    }

    public function getMostWished(): array
    {
        return WishlistItem::query()
            ->join('products', 'products.id', '=', 'wishlist_items.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('wishes')
            ->limit(10)
            ->get(['products.id', 'products.name', \DB::raw('COUNT(*) AS wishes')])->all();
    }

    public function getAbandonedCarts(): array
    {
        return Cart::query()
            ->whereHas('items')
            ->where('updated_at', '<', now()->subDay())
            ->with(['user', 'items.product'])
            ->withCount('items')
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get()
            ->map(fn (Cart $cart): array => [
                'id' => $cart->id,
                'customer' => $cart->user?->name ?? 'Guest',
                'email' => $cart->user?->email ?? '—',
                'items' => $cart->items_count,
                'value' => $cart->items->sum(fn ($item) => ($item->product?->price ?? 0) * $item->quantity),
                'last_activity' => $cart->updated_at?->diffForHumans() ?? '—',
            ])
            ->all();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportCsv')
                ->label('Export CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn () => $this->exportSummaryCsv()),
        ];
    }

    public function exportSummaryCsv(): StreamedResponse
    {
        $filename = 'report-summary-'.now()->format('Ymd-His').'.csv';

        return response()->streamDownload(function (): void {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");

            $summary = $this->getSummaryStats();
            fputcsv($out, ['SUMMARY']);
            fputcsv($out, ['metric', 'value']);
            foreach ($summary as $metric => $value) {
                fputcsv($out, [$metric, $value]);
            }

            fputcsv($out, []);
            fputcsv($out, ['COUPON PERFORMANCE']);
            fputcsv($out, ['code', 'orders', 'discount_given', 'usage_limit']);
            foreach ($this->getCouponPerformance() as $row) {
                fputcsv($out, [$row['code'], $row['orders'], $row['discount'], $row['usage_limit']]);
            }

            fputcsv($out, []);
            fputcsv($out, ['VAT']);
            fputcsv($out, ['metric', 'value']);
            $vat = $this->getVatSummary();
            fputcsv($out, ['taxable_amount_ex_vat', $vat['taxable']]);
            fputcsv($out, ['vat_collected', $vat['vat']]);
            fputcsv($out, ['gross_incl_vat', $vat['gross']]);

            fputcsv($out, []);
            fputcsv($out, ['REFUNDS & CANCELLATIONS']);
            $refunds = $this->getRefundsSummary();
            fputcsv($out, ['refunded_orders', $refunds['refunded_orders']]);
            fputcsv($out, ['refunded_amount', $refunds['refunded_amount']]);
            fputcsv($out, ['cancelled_orders', $refunds['cancelled_orders']]);
            fputcsv($out, ['cancelled_value', $refunds['cancelled_value']]);

            fputcsv($out, []);
            fputcsv($out, ['REVIEWS']);
            $reviews = $this->getReviewsSummary();
            fputcsv($out, ['total_reviews', $reviews['total']]);
            fputcsv($out, ['average_rating', $reviews['average']]);
            foreach ($reviews['distribution'] as $row) {
                fputcsv($out, ["{$row['stars']}_star", $row['count']]);
            }

            fputcsv($out, []);
            fputcsv($out, ['TOP PRODUCTS']);
            fputcsv($out, ['product', 'units', 'revenue']);
            foreach ($this->getTopProducts() as $row) {
                fputcsv($out, [$row->name, $row->units, $row->revenue]);
            }

            fputcsv($out, []);
            fputcsv($out, ['MOST WISHED FOR']);
            fputcsv($out, ['product', 'wishes']);
            foreach ($this->getMostWished() as $row) {
                fputcsv($out, [$row->name, $row->wishes]);
            }

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
