@extends('layouts.app')
@section('title', 'My Orders | SEPHORA')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')
@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<nav class="text-body-sm font-body-sm text-outline mb-4"><a class="hover:text-secondary" href="/">Home</a> / <a class="hover:text-secondary" href="/my-account">My Account</a> / <span class="text-on-surface font-semibold">Orders</span></nav>
<div class="flex items-end justify-between border-b border-primary pb-4 mb-8">
    <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">My Orders</h1>
    <span class="font-body-sm text-body-sm text-outline">{{ $orders->total() }} orders</span>
</div>
@if($orders->isEmpty())
<div class="text-center py-24 space-y-5">
    <span class="material-symbols-outlined text-[64px] text-outline-variant" data-icon="receipt_long">receipt_long</span>
    <h2 class="font-headline-sm text-headline-sm text-primary">No orders yet</h2>
    <p class="font-body-md text-body-md text-on-surface-variant">Your order history and tracking will appear here.</p>
    <a class="inline-block bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="/shop/bestsellers">Start Shopping</a>
</div>
@else
<div class="space-y-4">
    @foreach($orders as $order)
    <article class="bg-surface-container-lowest card-border p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
            <div>
                <span class="font-label-caps text-label-caps uppercase text-outline tracking-wider font-bold">{{ $order->placed_at?->format('d M Y') }}</span>
                <h3 class="font-title-lg text-title-lg text-primary mt-0.5">{{ $order->order_number }}</h3>
            </div>
            <span class="font-label-tag text-label-tag uppercase px-3 py-1.5 font-bold {{ $order->status === 'delivered' ? 'bg-[#1b6b45] text-white' : ($order->status === 'cancelled' ? 'bg-error text-on-error' : 'bg-primary text-on-primary') }}">{{ $order->status_label }}</span>
        </div>
        <div class="flex items-center gap-3 mb-4">
            @foreach($order->items->take(4) as $item)
            <img alt="{{ $item->product_name }}" class="w-14 h-14 object-contain bg-surface-container-low" src="{{ media_url($item->image_path) }}"/>
            @endforeach
            @if($order->items->count() > 4)<span class="font-body-sm text-body-sm text-outline">+{{ $order->items->count() - 4 }} more</span>@endif
        </div>
        <div class="flex items-center justify-between border-t border-outline-variant pt-4">
            <span class="font-body-md text-body-md text-on-surface-variant">{{ $order->items->count() }} item(s)</span>
            <div class="flex items-center gap-6">
                <span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED {{ number_format($order->total, 2) }}</span>
                <a class="font-label-caps text-label-caps uppercase underline text-primary hover:text-secondary" href="{{ route('account.orders.show', $order->order_number) }}">View Details</a>
            </div>
        </div>
    </article>
    @endforeach
</div>
{{ $orders->links() }}
@endif

</main>
@endsection
