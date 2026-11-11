@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
<div class="flex flex-wrap items-end justify-between gap-3 mb-6">
    <div>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Dashboard</h1>
        <p class="font-body-sm text-body-sm text-outline mt-1">Store health at a glance.</p>
    </div>
    <div class="flex flex-wrap gap-2">
        <a class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-4 h-10 inline-flex items-center border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" href="{{ route('admin.products.create') }}">+ Product</a>
        <a class="border border-primary text-primary font-label-caps text-label-caps uppercase tracking-widest px-4 h-10 inline-flex items-center hover:bg-primary hover:text-on-primary transition-all" href="{{ route('admin.orders') }}">View orders</a>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-3 md:gap-4 mb-8">
    @foreach (['Orders' => ['orders', 'receipt_long', number_format($stats['orders'])], 'Revenue (AED)' => ['revenue', 'payments', number_format($stats['revenue'], 0)], 'Products' => ['products', 'inventory_2', number_format($stats['products'])], 'Customers' => ['customers', 'group', number_format($stats['customers'])], 'Processing' => ['pending', 'schedule', number_format($stats['pending'])], 'New Messages' => ['messages', 'mail', number_format($stats['messages'])]] as $label => $data)
        <div class="bg-surface-container-lowest border border-outline-variant p-4 md:p-5">
            <span class="material-symbols-outlined text-outline text-[22px] mb-2">{{ $data[1] }}</span>
            <p class="font-price-aed-lg text-price-aed-lg font-bold text-primary leading-tight">{{ $data[2] }}</p>
            <p class="font-label-caps text-label-caps uppercase text-outline mt-1">{{ $label }}</p>
        </div>
    @endforeach
</div>

<div class="flex flex-wrap items-center justify-between gap-2 mb-4">
    <h2 class="font-headline-sm text-headline-sm text-primary uppercase">Recent orders</h2>
    <a class="font-body-sm text-body-sm underline text-primary hover:text-secondary" href="{{ route('admin.orders') }}">View all orders</a>
</div>

<div class="bg-surface-container-lowest border border-outline-variant overflow-x-auto">
    <table class="w-full text-left font-body-sm text-body-sm min-w-[720px]">
        <thead class="bg-surface-container text-on-surface-variant font-label-caps text-label-caps uppercase">
            <tr>
                <th class="px-4 py-3">Order</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">{{ __('ui.status') }}</th>
                <th class="px-4 py-3">{{ __('ui.payment') }}</th>
                <th class="px-4 py-3">{{ __('ui.total') }}</th>
                <th class="px-4 py-3 text-right">{{ __('ui.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentOrders as $order)
                <tr class="border-t border-outline-variant hover:bg-surface-container-low/60">
                    <td class="px-4 py-3 font-semibold text-primary whitespace-nowrap">{{ $order->order_number }}</td>
                    <td class="px-4 py-3">
                        <span class="block max-w-[180px] truncate">{{ $order->customer_name }}</span>
                        <span class="block text-[12px] text-outline">{{ $order->placed_at?->format('d M Y') ?? $order->created_at?->format('d M Y') }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="font-label-tag text-label-tag uppercase px-2 py-0.5 font-bold bg-primary text-on-primary whitespace-nowrap">{{ $order->status_label }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="block uppercase">{{ $order->payment_method }}</span>
                        <span class="block text-[12px] {{ $order->payment_status === 'paid' ? 'text-[#1b6b45]' : 'text-outline' }}">{{ $order->payment_status }}</span>
                    </td>
                    <td class="px-4 py-3 font-bold whitespace-nowrap">AED {{ number_format($order->total, 2) }}</td>
                    <td class="px-4 py-3 text-right">
                        <a class="underline hover:text-secondary whitespace-nowrap" href="{{ route('admin.orders.show', $order) }}">{{ __('ui.view') }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-16 text-center">
                        <span class="material-symbols-outlined text-[40px] text-outline-variant">receipt_long</span>
                        <p class="font-body-md text-body-md text-primary mt-2">{{ __('ui.no_orders') }}</p>
                        <p class="font-body-sm text-body-sm text-outline">New orders will appear here as soon as they are placed.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
