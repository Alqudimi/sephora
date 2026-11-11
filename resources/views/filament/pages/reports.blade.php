<x-filament-panels::page>
    {{ $this->form }}

    @php
        $summary = $this->getSummaryStats();
        $trend = $this->getRevenueTrend();
        $topProducts = $this->getTopProducts();
        $topBrands = $this->getTopBrands();
        $topEmirates = $this->getTopEmirates();
        $paymentMethods = $this->getPaymentMethods();
        $deliveryMethods = $this->getDeliveryMethods();
        $topCustomers = $this->getTopCustomers();
        $couponPerformance = $this->getCouponPerformance();
        $vatSummary = $this->getVatSummary();
        $reviewsSummary = $this->getReviewsSummary();
        $refundsSummary = $this->getRefundsSummary();
        $mostWished = $this->getMostWished();
        $abandonedCarts = $this->getAbandonedCarts();

        $maxTrend = max(1, ...($trend['data'] ?: [1]));
        $maxProducts = max(1, ...(array_column($topProducts, "revenue") ?: [1]));
        $maxBrands = max(1, ...(array_column($topBrands, "revenue") ?: [1]));
        $maxEmirates = max(1, ...(array_column($topEmirates, "revenue") ?: [1]));
        $maxPayments = max(1, ...(array_column($paymentMethods, "orders") ?: [1]));
        $maxDelivery = max(1, ...(array_column($deliveryMethods, "orders") ?: [1]));
    @endphp

    {{-- ── Summary cards ── --}}
    <div class="grid grid-cols-2 gap-4 xl:grid-cols-7 mt-6">
        @foreach([
            ['label' => 'Revenue', 'value' => $summary['revenue']],
            ['label' => 'Orders', 'value' => $summary['orders']],
            ['label' => 'Avg order value', 'value' => $summary['aov']],
            ['label' => 'Units sold', 'value' => $summary['units_sold']],
            ['label' => 'Discounts given', 'value' => $summary['discount_given']],
            ['label' => 'New customers', 'value' => $summary['new_customers']],
            ['label' => 'Delivery fees', 'value' => $summary['shipping_collected']],
        ] as $card)
            <x-filament::section>
                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ $card['label'] }}</p>
                <p class="mt-1 text-xl font-bold">{{ $card['value'] }}</p>
            </x-filament::section>
        @endforeach
    </div>

    {{-- ── Revenue trend ── --}}
    <x-filament::section class="mt-6" icon="heroicon-o-chart-bar">
        <x-slot name="heading">{{ __('content.t_8126da036b60') }}</x-slot>
        <div class="flex h-48 items-end gap-1 overflow-x-auto">
            @foreach($trend['data'] as $i => $value)
                <div class="group relative flex min-w-[18px] flex-1 flex-col items-center justify-end self-stretch">
                    <span class="pointer-events-none absolute -top-6 z-10 hidden whitespace-nowrap rounded bg-gray-900 px-2 py-1 text-xs text-white group-hover:block">
                        {{ 'AED '.number_format($value, 0) }} · {{ $trend['labels'][$i] }}
                    </span>
                    <div class="w-full rounded-t bg-danger-500/80 transition group-hover:bg-danger-500"
                         style="height: {{ max(2, (int) round($value / $maxTrend * 100)) }}%"></div>
                </div>
            @endforeach
        </div>
    </x-filament::section>

    <div class="grid gap-6 xl:grid-cols-2">
        {{-- ── Top products ── --}}
        <x-filament::section icon="heroicon-o-cube">
            <x-slot name="heading">{{ __('content.t_a3b3ba6bd7ef') }}</x-slot>
            <table class="w-full text-sm">
                @foreach($topProducts as $row)
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-2 pr-3 w-1/2">{{ \Illuminate\Support\Str::limit($row->name, 42) }}</td>
                        <td class="py-2 px-3 text-gray-500">{{ (int) $row->units }} units</td>
                        <td class="py-2 pl-3 text-right font-semibold w-32">AED {{ number_format($row->revenue, 2) }}</td>
                    </tr>
                @endforeach
                @if(empty($topProducts))
                    <tr><td class="py-6 text-center text-gray-500">{{ __('content.t_3012d48610b3') }}</td></tr>
                @endif
            </table>
        </x-filament::section>

        {{-- ── Top brands ── --}}
        <x-filament::section icon="heroicon-o-tag">
            <x-slot name="heading">{{ __('content.t_888ed91c9ad9') }}</x-slot>
            <table class="w-full text-sm">
                @foreach($topBrands as $row)
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-2 pr-3 w-1/2">{{ $row->name }}</td>
                        <td class="py-2 px-3 text-gray-500">{{ (int) $row->units }} units</td>
                        <td class="py-2 pl-3 text-right font-semibold w-32">AED {{ number_format($row->revenue, 2) }}</td>
                    </tr>
                @endforeach
                @if(empty($topBrands))
                    <tr><td class="py-6 text-center text-gray-500">{{ __('content.t_3012d48610b3') }}</td></tr>
                @endif
            </table>
        </x-filament::section>

        {{-- ── Top emirates ── --}}
        <x-filament::section icon="heroicon-o-map-pin">
            <x-slot name="heading">{{ __('content.t_795faa052c46') }}</x-slot>
            <table class="w-full text-sm">
                @foreach($topEmirates as $row)
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-2 pr-3 w-1/2">{{ $row->name }}</td>
                        <td class="py-2 px-3 text-gray-500">{{ (int) $row->orders }} orders</td>
                        <td class="py-2 pl-3 text-right font-semibold w-32">AED {{ number_format($row->revenue, 2) }}</td>
                    </tr>
                @endforeach
                @if(empty($topEmirates))
                    <tr><td class="py-6 text-center text-gray-500">{{ __('content.t_3012d48610b3') }}</td></tr>
                @endif
            </table>
        </x-filament::section>

        {{-- ── Top customers ── --}}
        <x-filament::section icon="heroicon-o-users">
            <x-slot name="heading">{{ __('content.t_b6c600062323') }}</x-slot>
            <table class="w-full text-sm">
                @foreach($topCustomers as $row)
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-2 pr-3">
                            <span class="font-medium">{{ $row->customer_name }}</span>
                            <span class="block text-xs text-gray-500">{{ $row->customer_email }}</span>
                        </td>
                        <td class="py-2 px-3 text-gray-500">{{ (int) $row->orders }} orders</td>
                        <td class="py-2 pl-3 text-right font-semibold w-32">AED {{ number_format($row->revenue, 2) }}</td>
                    </tr>
                @endforeach
                @if(empty($topCustomers))
                    <tr><td class="py-6 text-center text-gray-500">{{ __('content.t_3012d48610b3') }}</td></tr>
                @endif
            </table>
        </x-filament::section>

        {{-- ── Payment methods ── --}}
        <x-filament::section icon="heroicon-o-credit-card">
            <x-slot name="heading">{{ __('content.t_dc80127fcd41') }}</x-slot>
            @foreach($paymentMethods as $row)
                <div class="mb-3">
                    <div class="mb-1 flex justify-between text-sm">
                        <span>{{ $row['name'] }}</span>
                        <span class="text-gray-500">{{ $row['orders'] }} orders · AED {{ number_format($row['revenue'], 2) }}</span>
                    </div>
                    <div class="h-2 rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-2 rounded-full bg-info-500" style="width: {{ (int) round($row['orders'] / $maxPayments * 100) }}%"></div>
                    </div>
                </div>
            @endforeach
            @if(empty($paymentMethods))
                <p class="py-6 text-center text-gray-500">{{ __('content.t_3012d48610b3') }}</p>
            @endif
        </x-filament::section>

        {{-- ── Delivery methods ── --}}
        <x-filament::section icon="heroicon-o-truck">
            <x-slot name="heading">{{ __('content.t_8046fd600489') }}</x-slot>
            @foreach($deliveryMethods as $row)
                <div class="mb-3">
                    <div class="mb-1 flex justify-between text-sm">
                        <span>{{ $row['name'] }}</span>
                        <span class="text-gray-500">{{ $row['orders'] }} orders</span>
                    </div>
                    <div class="h-2 rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-2 rounded-full bg-success-500" style="width: {{ (int) round($row['orders'] / $maxDelivery * 100) }}%"></div>
                    </div>
                </div>
            @endforeach
            @if(empty($deliveryMethods))
                <p class="py-6 text-center text-gray-500">{{ __('content.t_3012d48610b3') }}</p>
            @endif
        </x-filament::section>

        {{-- ── Coupon performance ── --}}
        <x-filament::section icon="heroicon-o-ticket">
            <x-slot name="heading">{{ __('content.t_5ebae6ec8a40') }}</x-slot>
            <table class="w-full text-sm">
                @foreach($couponPerformance as $row)
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-2 pr-3 font-medium">{{ $row['code'] }}</td>
                        <td class="py-2 px-3 text-gray-500">{{ $row['orders'] }} orders</td>
                        <td class="py-2 px-3 text-gray-500">{{ $row['usage_limit'] ? 'limit '.$row['usage_limit'] : 'no limit' }}</td>
                        <td class="py-2 pl-3 text-right font-semibold w-32">- AED {{ number_format($row['discount'], 2) }}</td>
                    </tr>
                @endforeach
                @if(empty($couponPerformance))
                    <tr><td class="py-6 text-center text-gray-500">{{ __('content.t_f5ff07ca029f') }}</td></tr>
                @endif
            </table>
        </x-filament::section>

        {{-- ── VAT report ── --}}
        <x-filament::section icon="heroicon-o-calculator">
            <x-slot name="heading">VAT ({{ $vatSummary['rate_percent'] }}%)</x-slot>
            <table class="w-full text-sm">
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="py-2 pr-3">Taxable amount (excl. VAT)</td>
                    <td class="py-2 pl-3 text-right font-semibold w-40">AED {{ number_format($vatSummary['taxable'], 2) }}</td>
                </tr>
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="py-2 pr-3">{{ __('content.t_2c623cd85a30') }}</td>
                    <td class="py-2 pl-3 text-right font-semibold w-40">AED {{ number_format($vatSummary['vat'], 2) }}</td>
                </tr>
                <tr>
                    <td class="py-2 pr-3">Gross (incl. VAT)</td>
                    <td class="py-2 pl-3 text-right font-semibold w-40">AED {{ number_format($vatSummary['gross'], 2) }}</td>
                </tr>
            </table>
        </x-filament::section>

        {{-- ── Reviews & ratings ── --}}
        <x-filament::section icon="heroicon-o-star">
            <x-slot name="heading">Reviews ({{ $reviewsSummary['total'] }} · avg {{ $reviewsSummary['average'] }} ★)</x-slot>
            @foreach($reviewsSummary['distribution'] as $row)
                <div class="mb-2 flex items-center gap-3 text-sm">
                    <span class="w-8 text-gray-500">{{ $row['stars'] }}★</span>
                    <div class="h-2 flex-1 rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-2 rounded-full bg-warning-500" style="width: {{ $row['percent'] }}%"></div>
                    </div>
                    <span class="w-16 text-right text-gray-500">{{ $row['count'] }} ({{ $row['percent'] }}%)</span>
                </div>
            @endforeach
            @if($reviewsSummary['total'] === 0)
                <p class="py-6 text-center text-gray-500">{{ __('content.t_704845c6414b') }}</p>
            @endif
        </x-filament::section>

        {{-- ── Refunds & cancellations ── --}}
        <x-filament::section icon="heroicon-o-arrow-uturn-left">
            <x-slot name="heading">{{ __('content.t_a6835649080f') }}</x-slot>
            <table class="w-full text-sm">
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="py-2 pr-3">{{ __('content.t_d7f8e35536c3') }}</td>
                    <td class="py-2 pl-3 text-right font-semibold w-40">{{ $refundsSummary['refunded_orders'] }} · AED {{ number_format($refundsSummary['refunded_amount'], 2) }}</td>
                </tr>
                <tr>
                    <td class="py-2 pr-3">{{ __('content.t_345c1cc5747c') }}</td>
                    <td class="py-2 pl-3 text-right font-semibold w-40">{{ $refundsSummary['cancelled_orders'] }} · AED {{ number_format($refundsSummary['cancelled_value'], 2) }}</td>
                </tr>
            </table>
        </x-filament::section>

        {{-- ── Most wished for ── --}}
        <x-filament::section icon="heroicon-o-heart">
            <x-slot name="heading">{{ __('content.t_27fc4f87c4d5') }}</x-slot>
            <table class="w-full text-sm">
                @foreach($mostWished as $row)
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-2 pr-3 w-1/2">{{ \Illuminate\Support\Str::limit($row->name, 42) }}</td>
                        <td class="py-2 pl-3 text-right text-gray-500">{{ (int) $row->wishes }} wishes</td>
                    </tr>
                @endforeach
                @if(empty($mostWished))
                    <tr><td class="py-6 text-center text-gray-500">{{ __('content.t_d4e63ec282ce') }}</td></tr>
                @endif
            </table>
        </x-filament::section>

        {{-- ── Abandoned carts ── --}}
        <x-filament::section icon="heroicon-o-shopping-bag">
            <x-slot name="heading">Abandoned carts (inactive &gt; 24h)</x-slot>
            <table class="w-full text-sm">
                @foreach($abandonedCarts as $row)
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <td class="py-2 pr-3">
                            <span class="font-medium">{{ $row['customer'] }}</span>
                            <span class="block text-xs text-gray-500">{{ $row['email'] }}</span>
                        </td>
                        <td class="py-2 px-3 text-gray-500">{{ $row['items'] }} items</td>
                        <td class="py-2 px-3 text-gray-500">{{ $row['last_activity'] }}</td>
                        <td class="py-2 pl-3 text-right font-semibold w-32">AED {{ number_format($row['value'], 2) }}</td>
                    </tr>
                @endforeach
                @if(empty($abandonedCarts))
                    <tr><td class="py-6 text-center text-gray-500">{{ __('content.t_320394460f01') }}</td></tr>
                @endif
            </table>
        </x-filament::section>
    </div>
</x-filament-panels::page>
