@extends('admin.layout')
@section('title', 'Orders')
@section('content')
<h1 class="font-headline-md text-headline-md font-bold text-primary uppercase mb-6">Orders</h1>
<form class="mb-4 flex gap-2 max-w-md" method="GET">
    <input class="h-11 px-4 bg-surface-container-lowest border border-outline font-body-sm focus:border-primary flex-1" name="q" placeholder="Order number..." value="{{ request('q') }}" type="text"/>
    <select class="h-11 px-3 bg-surface-container-lowest border border-outline font-body-sm" name="status">
        <option value="">All statuses</option>
        @foreach(['pending','processing','shipped','out_for_delivery','delivered','cancelled'] as $s)
        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
        @endforeach
    </select>
    <button class="bg-primary text-on-primary font-label-caps uppercase px-5 text-label-caps" type="submit">Filter</button>
</form>
<div class="bg-surface-container-lowest card-border overflow-x-auto">
    <table class="w-full text-left font-body-sm text-body-sm min-w-[700px]">
        <thead class="bg-surface-container text-on-surface-variant font-label-caps text-label-caps uppercase">
            <tr><th class="px-4 py-3">Order</th><th class="px-4 py-3">Customer</th><th class="px-4 py-3">Date</th><th class="px-4 py-3">Payment</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Total</th><th class="px-4 py-3"></th></tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="border-t border-outline-variant">
                <td class="px-4 py-3 font-semibold text-primary">{{ $order->order_number }}</td>
                <td class="px-4 py-3">{{ $order->customer_name }}</td>
                <td class="px-4 py-3">{{ $order->placed_at?->format('d M Y') }}</td>
                <td class="px-4 py-3 uppercase">{{ $order->payment_method }} / {{ $order->payment_status }}</td>
                <td class="px-4 py-3"><span class="font-label-tag uppercase px-2 py-0.5 font-bold bg-primary text-on-primary">{{ $order->status_label }}</span></td>
                <td class="px-4 py-3 font-bold">AED {{ number_format($order->total, 2) }}</td>
                <td class="px-4 py-3"><a class="underline hover:text-secondary" href="{{ route('admin.orders.show', $order) }}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $orders->links() }}
@endsection
