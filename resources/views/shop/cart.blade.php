@extends('layouts.app')
@section('title', 'Shopping Bag | SEPHORA UAE')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav class="text-body-sm font-body-sm text-outline mb-4" aria-label="Breadcrumb">
        <a class="hover:text-secondary transition-colors" href="/">Home</a>
        <span class="mx-1.5">/</span>
        <span class="text-on-surface font-semibold">Shopping Bag</span>
    </nav>

    <div class="flex flex-wrap items-end justify-between gap-3 border-b border-primary pb-4 mb-8">
        <div>
            <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Shopping Bag</h1>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                {{ $items->sum('quantity') }} item{{ $items->sum('quantity') === 1 ? '' : 's' }} in your bag
            </p>
        </div>
        <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary transition-colors" href="/">Continue shopping</a>
    </div>

    @if (session('status'))
        <div class="mb-6 border border-primary bg-surface-container-low p-4 font-body-sm text-body-sm text-primary" role="status">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error') || $errors->any())
        <div class="mb-6 border border-secondary bg-surface-container-low p-4 font-body-sm text-body-sm text-secondary" role="alert">
            {{ session('error') ?? $errors->first() }}
        </div>
    @endif

    @if ($items->isEmpty())
        <div class="text-center py-24 space-y-6">
            <span class="material-symbols-outlined text-[64px] text-outline-variant" data-icon="shopping_bag">shopping_bag</span>
            <h2 class="font-headline-sm text-headline-sm text-primary">Your bag is empty</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto">Discover new arrivals, exclusive launches and beauty icons — all in one place.</p>
            <a class="inline-block bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="{{ route('shop.bestsellers') }}">Shop Best Sellers</a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 space-y-4">
                @foreach ($items as $item)
                    @php
                        $stock = (int) ($item->product->stock ?? 0);
                        $maxQty = min($stock, (int) config('commerce.max_quantity_per_item', 20));
                    @endphp
                    <article class="bg-surface-container-lowest card-border p-3 sm:p-4 flex gap-3 sm:gap-4">
                        <a class="w-20 h-20 sm:w-24 sm:h-24 shrink-0 bg-surface-container-low overflow-hidden flex items-center justify-center" href="{{ route('product.show', $item->product->slug) }}">
                            <img alt="{{ $item->product->name }}" class="w-full h-full object-contain" src="{{ media_url($item->product->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                        </a>

                        <div class="flex-1 flex flex-col min-w-0">
                            <span class="font-label-caps text-[11px] sm:text-label-caps uppercase text-outline tracking-wider font-bold truncate">{{ $item->product->brand?->name }}</span>
                            <a class="font-title-md text-sm sm:text-title-md text-primary hover:underline leading-tight mt-0.5 line-clamp-2" href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                            @if ($item->shade_name)
                                <span class="font-body-sm text-xs sm:text-body-sm text-on-surface-variant mt-0.5">Shade: {{ $item->shade_name }}</span>
                            @endif
                            @if ($stock <= 0)
                                <span class="font-body-sm text-xs sm:text-body-sm text-secondary mt-1">Out of stock — remove to continue</span>
                            @elseif ($stock <= 5)
                                <span class="font-body-sm text-xs sm:text-body-sm text-secondary mt-1">Only {{ $stock }} left</span>
                            @endif

                            <div class="mt-auto flex flex-wrap items-center justify-between gap-2 sm:gap-3 pt-3">
                                <div class="flex items-center border border-outline-variant">
                                    <button class="px-2.5 sm:px-3 py-1 sm:py-1.5 hover:bg-surface-container disabled:opacity-40" data-qty-minus type="button" aria-label="Decrease quantity" @disabled($item->quantity <= 1)>−</button>
                                    <input class="w-10 sm:w-12 text-center font-body-md text-xs sm:text-body-md text-primary bg-transparent"
                                           data-cart-item="{{ $item->id }}" data-qty-input type="number"
                                           min="1" max="{{ max(1, $maxQty) }}" value="{{ $item->quantity }}"
                                           aria-label="Quantity for {{ $item->product->name }}">
                                    <button class="px-2.5 sm:px-3 py-1 sm:py-1.5 hover:bg-surface-container disabled:opacity-40" data-qty-plus type="button" aria-label="Increase quantity" @disabled($item->quantity >= $maxQty)>+</button>
                                </div>
                                <span class="font-price-aed-lg text-sm sm:text-price-aed-lg font-bold text-primary">AED {{ number_format($item->lineTotal(), 2) }}</span>
                            </div>
                        </div>

                        <button class="text-outline hover:text-secondary transition-colors self-start shrink-0 p-1" data-cart-remove="{{ $item->id }}" title="Remove {{ $item->product->name }}" type="button">
                            <span class="material-symbols-outlined text-[18px] sm:text-[20px]" data-icon="close">close</span>
                        </button>
                    </article>
                @endforeach

                <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                    <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary transition-colors" href="/">Continue shopping</a>
                    <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Remove all items from your bag?')">
                        @csrf
                        <button class="font-label-caps text-label-caps uppercase underline text-outline hover:text-secondary transition-colors" type="submit">Clear bag</button>
                    </form>
                </div>
            </div>

            <aside class="lg:col-span-4">
                <div class="bg-surface-container-lowest card-border p-6 lg:sticky lg:top-28">
                    <h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-6">Order Summary</h2>

                    <dl class="space-y-3 font-body-md text-body-md text-on-surface-variant">
                        <div class="flex justify-between">
                            <dt>Subtotal</dt>
                            <dd class="text-on-surface font-semibold">AED {{ number_format($subtotal, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Delivery</dt>
                            <dd class="text-on-surface font-semibold">{{ $shippingFee <= 0 ? 'FREE' : 'AED '.number_format($shippingFee, 2) }}</dd>
                        </div>
                        <div class="flex justify-between font-body-sm text-body-sm">
                            <dt>VAT included</dt>
                            <dd>AED {{ number_format($taxAmount, 2) }}</dd>
                        </div>
                    </dl>

                    @if ($shippingFee > 0 && $subtotal < $freeShippingThreshold)
                        <p class="font-body-sm text-body-sm text-secondary mt-3">Add AED {{ number_format($freeShippingThreshold - $subtotal, 2) }} more for free standard delivery.</p>
                    @else
                        <p class="font-body-sm text-body-sm text-primary mt-3">You qualify for free standard delivery.</p>
                    @endif

                    <div class="border-t border-outline-variant mt-6 pt-4 flex justify-between items-baseline">
                        <span class="font-title-lg text-title-lg text-primary">Total</span>
                        <span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED {{ number_format($total, 2) }}</span>
                    </div>

                    <a class="block mt-6 text-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="{{ route('checkout') }}">Proceed to checkout</a>

                    <p class="font-body-sm text-body-sm text-outline text-center mt-4 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[16px]" data-icon="lock">lock</span> Secure checkout
                    </p>
                    <p class="font-body-sm text-body-sm text-outline text-center mt-2">Promo codes are applied at checkout.</p>
                </div>
            </aside>
        </div>
    @endif
</main>
@endsection
