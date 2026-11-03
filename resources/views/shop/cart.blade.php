@extends('layouts.app')
@section('title', 'Shopping Bag | SEPHORA UAE')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<!-- Breadcrumbs -->
<nav class="text-body-sm font-body-sm text-outline mb-4" aria-label="Breadcrumb">
    <a class="hover:text-secondary transition-colors" href="/">Home</a>
    <span class="mx-1.5">/</span>
    <span class="text-on-surface font-semibold">Shopping Bag</span>
</nav>

<!-- Page Header -->
<div class="flex items-end justify-between border-b border-primary pb-4 mb-8">
    <div>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Shopping Bag</h1>
        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ $items->count() }} item{{ $items->count() === 1 ? '' : 's' }} in your bag</p>
    </div>
    <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary transition-colors" href="/">Continue Shopping</a>
</div>

@if($items->isEmpty())
<!-- Empty State -->
<div class="text-center py-24 space-y-6">
    <span class="material-symbols-outlined text-[64px] text-outline-variant" data-icon="shopping_bag">shopping_bag</span>
    <h2 class="font-headline-sm text-headline-sm text-primary">Your bag is empty</h2>
    <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto">Discover new arrivals, exclusive launches and beauty icons — all in one place.</p>
    <a class="inline-block bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="/shop/bestsellers">Shop Best Sellers</a>
</div>
@else
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Items Column -->
    <div class="lg:col-span-8 space-y-4">
        @foreach($items as $item)
        <article class="bg-surface-container-lowest card-border p-4 flex gap-4">
            <a class="w-24 h-24 shrink-0 bg-surface-container-low overflow-hidden flex items-center justify-center" href="/p/{{ $item->product->slug }}">
                <img alt="{{ $item->product->name }}" class="w-full h-full object-contain" src="{{ asset($item->product->first_image) }}"/>
            </a>
            <div class="flex-1 flex flex-col">
                <span class="font-label-caps text-label-caps uppercase text-outline tracking-wider font-bold">{{ $item->product->brand?->name }}</span>
                <a class="font-title-md text-title-md text-primary hover:underline leading-tight mt-0.5" href="/p/{{ $item->product->slug }}">{{ $item->product->name }}</a>
                @if($item->shade_name)
                <span class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Shade: {{ $item->shade_name }}</span>
                @endif
                <div class="mt-auto flex items-center justify-between pt-3">
                    <div class="flex items-center border border-outline-variant">
                        <button class="px-3 py-1.5 hover:bg-surface-container" data-qty-minus type="button">−</button>
                        <input class="w-10 text-center font-body-md text-body-md text-primary bg-transparent" data-cart-item="{{ $item->id }}" data-qty-input type="text" value="{{ $item->quantity }}"/>
                        <button class="px-3 py-1.5 hover:bg-surface-container" data-qty-plus type="button">+</button>
                    </div>
                    <span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED {{ number_format($item->lineTotal(), 2) }}</span>
                </div>
            </div>
            <button class="text-outline hover:text-secondary transition-colors self-start" data-cart-remove="{{ $item->id }}" title="Remove" type="button">
                <span class="material-symbols-outlined text-[20px]" data-icon="close">close</span>
            </button>
        </article>
        @endforeach
    </div>

    <!-- Summary Column -->
    <aside class="lg:col-span-4">
        <div class="bg-surface-container-lowest card-border p-6 sticky top-28">
            <h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-6">Order Summary</h2>
            <dl class="space-y-3 font-body-md text-body-md text-on-surface-variant">
                <div class="flex justify-between">
                    <dt>Subtotal</dt>
                    <dd class="text-on-surface font-semibold">AED {{ number_format($subtotal, 2) }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt>Delivery</dt>
                    <dd class="text-on-surface font-semibold">{{ $shippingFee == 0 ? 'FREE' : 'AED ' . number_format($shippingFee, 2) }}</dd>
                </div>
            </dl>
            @if($shippingFee > 0)
            <p class="font-body-sm text-body-sm text-secondary mt-3">Add AED {{ number_format($freeShippingThreshold - $subtotal, 2) }} more for free delivery</p>
            @endif
            <div class="border-t border-outline-variant mt-6 pt-4 flex justify-between items-baseline">
                <span class="font-title-lg text-title-lg text-primary">Total</span>
                <span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED {{ number_format($subtotal + $shippingFee, 2) }}</span>
            </div>
            <a class="block mt-6 text-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="/checkout">Proceed to Checkout</a>
            <p class="font-body-sm text-body-sm text-outline text-center mt-4 flex items-center justify-center gap-1">
                <span class="material-symbols-outlined text-[16px]" data-icon="lock">lock</span> Secure Checkout
            </p>
        </div>
    </aside>
</div>
@endif

</main>
@endsection
