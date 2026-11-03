@extends('layouts.app')
@section('title', 'Order Confirmed | SEPHORA UAE')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')
@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<div class="max-w-3xl mx-auto text-center py-12">
    <div class="w-20 h-20 rounded-full bg-primary text-on-primary flex items-center justify-center mx-auto mb-8">
        <span class="material-symbols-outlined text-[40px]" data-icon="check_circle">check_circle</span>
    </div>
    <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-2">Order Confirmed</span>
    <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase mb-3">Thank You, {{ $order->customer_name }}!</h1>
    <p class="font-body-md text-body-md text-on-surface-variant max-w-lg mx-auto mb-2">Your order <strong class="text-primary">{{ $order->order_number }}</strong> has been received and is being prepared with care.</p>
    <p class="font-body-sm text-body-sm text-outline mb-10">A confirmation has been sent to {{ $order->customer_email ?? 'your email' }}.</p>
    <div class="bg-surface-container-lowest card-border p-6 text-left space-y-4 mb-10">
        <div class="flex justify-between font-body-md text-body-md">
            <span class="text-on-surface-variant">Date</span>
            <span class="text-on-surface font-semibold">{{ $order->placed_at?->format('d F Y, h:i A') }}</span>
        </div>
        <div class="flex justify-between font-body-md text-body-md">
            <span class="text-on-surface-variant">Delivery</span>
            <span class="text-on-surface font-semibold uppercase">{{ str_replace('_', ' & ', $order->delivery_method) }}</span>
        </div>
        <div class="flex justify-between font-body-md text-body-md">
            <span class="text-on-surface-variant">Payment</span>
            <span class="text-on-surface font-semibold uppercase">{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : ucfirst($order->payment_method) }}</span>
        </div>
        <div class="border-t border-outline-variant pt-4 space-y-3">
            @foreach($order->items as $item)
            <div class="flex items-center gap-4">
                <img alt="{{ $item->product_name }}" class="w-14 h-14 object-contain bg-surface-container-low" src="{{ asset($item->image_path ?? 'images/placeholder.webp') }}"/>
                <div class="flex-1">
                    <p class="font-title-md text-title-md text-primary leading-tight">{{ $item->product_name }}</p>
                    <p class="font-body-sm text-body-sm text-outline">{{ $item->brand_name }} &middot; Qty {{ $item->quantity }}</p>
                </div>
                <span class="font-price-aed-md text-price-aed-md font-bold text-primary">AED {{ number_format($item->line_total, 2) }}</span>
            </div>
            @endforeach
        </div>
        <div class="border-t border-primary pt-4 flex justify-between items-baseline">
            <span class="font-title-lg text-title-lg text-primary">Total Paid</span>
            <span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED {{ number_format($order->total, 2) }}</span>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        @auth
        <a class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="{{ route('account.orders') }}">Track My Order</a>
        @else
        <a class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="/sign-in">Sign In to Track</a>
        @endauth
        <a class="border border-primary text-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-primary hover:text-on-primary transition-all" href="/">Continue Shopping</a>
    </div>
</div>

</main>
@endsection
