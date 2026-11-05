@extends('admin.layout')
@section('title', 'Orders')
@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Orders</h1>
        <p class="font-body-sm text-body-sm text-outline mt-1">{{ number_format($orders->total()) }} orders</p>
    </div>
</div>

<form class="mb-5 flex flex-col sm:flex-row gap-2 max-w-2xl" method="GET">
    <label class="sr-only" for="order-search">Search orders</label>
    <input id="order-search" class="h-11 px-4 bg-surface-container-lowest border border-outline font-body-sm text-body-sm focus:border-primary flex-1 min-w-0"
           name="q" placeholder="Order number..." value="{{ request('q') }}" type="text">
    <label class="sr-only" for="order-status">Status</label>
    <select id="order-status" name="status" class="h-11 px-3 bg-surface-container-lowest border border-outline font-body-sm text-body-sm focus:border-primary">
        <option value="">All statuses</option>
        @foreach (['pending', 'processing', 'shipped', 'out_for_delivery', 'delivered', 'cancelled'] as $status)
            <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
        @endforeach
    </select>
    <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase px-5 h-11 hover:bg-secondary transition-colors" type="submit">Filter</button>
    @if (request()->filled('q') || request()->filled('status'))
        <a class="h-11 px-4 inline-flex items-center border border-outline-variant font-label-caps text-label-caps uppercase text-primary hover:border-primary transition-colors" href="{{ route('admin.orders') }}">Clear</a>
    @endif
</form>

<div class="bg-surface-container-lowest border border-outline-variant overflow-x-auto">
    <table class="w-full text-left font-body-sm text-body-sm min-w-[860px]">
        <thead class="bg-surface-container text-on-surface-variant font-label-caps text-label-caps uppercase">
            <tr>
                <th class="px-4 py-3">Order</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Payment</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr class="border-t border-outline-variant hover:bg-surface-container-low/60">
                    <td class="px-4 py-3 font-semibold text-primary whitespace-nowrap">{{ $order->order_number }}</td>
                    <td class="px-4 py-3">
                        <span class="block max-w-[180px] truncate">{{ $order->customer_name }}</span>
                        <span class="block text-[12px] text-outline">{{ $order->customer_phone }}</span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $order->placed_at?->format('d M Y') ?? $order->created_at?->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <span class="block uppercase">{{ $order->payment_method }}</span>
                        <span class="block text-[12px] {{ $order->payment_status === 'paid' ? 'text-[#1b6b45]' : 'text-outline' }}">{{ $order->payment_status }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="font-label-tag text-label-tag uppercase px-2 py-0.5 font-bold bg-primary text-on-primary whitespace-nowrap">{{ $order->status_label }}</span>
                    </td>
                    <td class="px-4 py-3 font-bold whitespace-nowrap">AED {{ number_format($order->total, 2) }}</td>
                    <td class="px-4 py-3 text-right">
                        <a class="underline hover:text-secondary whitespace-nowrap" href="{{ route('admin.orders.show', $order) }}">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-16 text-center">
                        <span class="material-symbols-outlined text-[40px] text-outline-variant">receipt_long</span>
                        <p class="font-body-md text-body-md text-primary mt-2">No orders match this filter.</p>
                        <a class="inline-block mt-3 underline text-primary hover:text-secondary" href="{{ route('admin.orders') }}">Clear filters</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('admin.partials.pagination', ['paginator' => $orders])
@endsection
