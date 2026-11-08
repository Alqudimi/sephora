@extends('layouts.app')

@section('title', 'Shopping Bag ≡ SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-4 sm:py-6">

    <!-- Breadcrumb -->
    <nav class="text-xs text-neutral-500 mb-4" aria-label="Breadcrumb">
        <a class="hover:text-black transition-colors" href="/">Home</a>
        <span class="mx-1.5">&rsaquo;</span>
        <span class="text-black font-semibold">Shopping Bag</span>
    </nav>

    <div class="flex flex-wrap items-baseline justify-between gap-3 border-b-2 border-black pb-3 mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-black uppercase tracking-tight">Shopping Bag</h1>
            <p class="text-xs text-neutral-500 mt-0.5">
                {{ $items->sum('quantity') }} {{ Str::plural('item', $items->sum('quantity')) }} in your bag
            </p>
        </div>
        <a class="text-xs font-bold text-black uppercase tracking-wider underline hover:text-neutral-600 transition-colors" href="/">
            Continue Shopping &rarr;
        </a>
    </div>

    @if (session('status'))
        <div class="mb-6 border border-black bg-neutral-50 p-3 text-xs text-black" role="status">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error') || $errors->any())
        <div class="mb-6 border border-red-500 bg-red-50 p-3 text-xs text-red-700" role="alert">
            {{ session('error') ?? $errors->first() }}
        </div>
    @endif

    @if ($items->isEmpty())
        <div class="text-center py-20 border border-gray-200 rounded-sm bg-white space-y-4">
            <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold uppercase tracking-tight text-black">Your bag is empty</h2>
            <p class="text-xs text-neutral-500 max-w-sm mx-auto">Discover new holiday drops, iconic beauty bestsellers, and viral sensations.</p>
            <div class="pt-2">
                <a class="inline-block bg-black text-white text-xs font-bold uppercase tracking-wider px-8 py-3 rounded-sm hover:bg-neutral-800 transition-colors" href="{{ route('shop.bestsellers') }}">
                    SHOP BEST SELLERS &rarr;
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Items Column (8 cols) -->
            <div class="lg:col-span-8 space-y-4">
                @foreach ($items as $item)
                    @php
                        $stock = (int) ($item->product->stock ?? 0);
                        $maxQty = min($stock, (int) config('commerce.max_quantity_per_item', 20));
                    @endphp
                    <article class="bg-white border border-gray-200 rounded-sm p-4 flex gap-4 transition-shadow hover:shadow-sm">
                        <!-- Product Image -->
                        <a class="w-20 h-20 sm:w-24 sm:h-24 shrink-0 bg-[#fafafa] rounded-sm overflow-hidden flex items-center justify-center p-2 border border-gray-100" href="{{ route('product.show', $item->product->slug) }}">
                            <img alt="{{ $item->product->name }}" class="w-full h-full object-contain" src="{{ media_url($item->product->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                        </a>

                        <!-- Product Info -->
                        <div class="flex-1 flex flex-col min-w-0">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-black truncate">{{ $item->product->brand?->name }}</span>
                            <a class="text-xs sm:text-[13px] text-gray-900 font-semibold hover:underline leading-snug mt-0.5 line-clamp-2" href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                            @if ($item->shade_name)
                                <span class="text-xs text-neutral-500 mt-0.5">Shade: <strong>{{ $item->shade_name }}</strong></span>
                            @endif
                            @if ($stock <= 0)
                                <span class="text-xs text-red-600 font-bold mt-1">Out of stock — remove to continue</span>
                            @elseif ($stock <= 5)
                                <span class="text-xs text-amber-600 font-medium mt-1">Only {{ $stock }} left in stock</span>
                            @endif

                            <div class="mt-auto flex flex-wrap items-center justify-between gap-3 pt-3">
                                <!-- Quantity Controls -->
                                <div class="flex items-center border border-gray-300 rounded-sm h-8">
                                    <button class="w-8 h-full flex items-center justify-center hover:bg-gray-100 text-black text-sm disabled:opacity-40" data-qty-minus type="button" aria-label="Decrease quantity" @disabled($item->quantity <= 1)>−</button>
                                    <input class="w-10 text-center text-xs font-bold text-black bg-transparent border-0 p-0"
                                           data-cart-item="{{ $item->id }}" data-qty-input type="number"
                                           min="1" max="{{ max(1, $maxQty) }}" value="{{ $item->quantity }}"
                                           aria-label="Quantity for {{ $item->product->name }}">
                                    <button class="w-8 h-full flex items-center justify-center hover:bg-gray-100 text-black text-sm disabled:opacity-40" data-qty-plus type="button" aria-label="Increase quantity" @disabled($item->quantity >= $maxQty)>+</button>
                                </div>
                                <!-- Line Total -->
                                <span class="text-sm sm:text-base font-bold text-black">AED {{ number_format($item->lineTotal(), 2) }}</span>
                            </div>
                        </div>

                        <!-- Remove Button -->
                        <button class="text-gray-400 hover:text-black transition-colors self-start shrink-0 p-1" data-cart-remove="{{ $item->id }}" title="Remove {{ $item->product->name }}" type="button">
                            <span class="text-lg leading-none font-bold">&times;</span>
                        </button>
                    </article>
                @endforeach

                <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                    <a class="text-xs font-bold text-black uppercase underline hover:text-neutral-600 transition-colors" href="/">
                        &larr; Continue Shopping
                    </a>
                    <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Remove all items from your bag?')">
                        @csrf
                        <button class="text-xs text-neutral-500 uppercase underline hover:text-red-600 transition-colors" type="submit">
                            Clear Bag
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary Sidebar (4 cols) -->
            <aside class="lg:col-span-4">
                <div class="bg-gray-50 border border-gray-200 rounded-sm p-5 lg:sticky lg:top-28 space-y-4">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-black pb-3 border-b border-gray-200">Order Summary</h2>

                    <!-- Free Delivery Progress -->
                    @php
                        $subtotalProgress = min(100, ($subtotal / max(1, $freeShippingThreshold)) * 100);
                    @endphp
                    <div class="bg-white p-3 rounded-sm border border-gray-200 space-y-1.5">
                        <div class="flex justify-between text-xs">
                            <span class="font-bold text-black">Free Standard Delivery</span>
                            <span class="text-neutral-500">{{ $subtotal >= $freeShippingThreshold ? 'Unlocked!' : 'Over AED ' . number_format($freeShippingThreshold, 0) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-black h-1.5 rounded-full transition-all duration-300" style="width: {{ $subtotalProgress }}%"></div>
                        </div>
                        @if ($subtotal < $freeShippingThreshold)
                            <p class="text-[11px] text-neutral-600">
                                Add <strong>AED {{ number_format($freeShippingThreshold - $subtotal, 2) }}</strong> more to unlock <strong>FREE DELIVERY</strong>.
                            </p>
                        @else
                            <p class="text-[11px] text-green-700 font-semibold">
                                ✓ You have unlocked free standard delivery on this order!
                            </p>
                        @endif
                    </div>

                    <!-- Breakdown -->
                    <dl class="space-y-2.5 text-xs text-neutral-700">
                        <div class="flex justify-between">
                            <dt>Subtotal</dt>
                            <dd class="text-black font-semibold">AED {{ number_format($subtotal, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Delivery</dt>
                            <dd class="text-black font-semibold">{{ $shippingFee <= 0 ? 'FREE' : 'AED ' . number_format($shippingFee, 2) }}</dd>
                        </div>
                        <div class="flex justify-between text-neutral-500">
                            <dt>VAT included (5%)</dt>
                            <dd>AED {{ number_format($taxAmount, 2) }}</dd>
                        </div>
                    </dl>

                    <!-- Split Payments Banner (Tabby / Tamara) -->
                    @php
                        $installment = $total / 4;
                    @endphp
                    <div class="p-2.5 bg-neutral-100 rounded-sm border border-neutral-200 text-[11px] text-neutral-700">
                        <span>or 4 interest-free payments of <strong>AED {{ number_format($installment, 2) }}</strong> with <strong class="text-emerald-700">Tabby</strong> or <strong class="text-amber-700">Tamara</strong></span>
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 pt-3 flex justify-between items-baseline">
                        <span class="text-sm font-bold uppercase tracking-wider text-black">Total</span>
                        <span class="text-lg font-extrabold text-black">AED {{ number_format($total, 2) }}</span>
                    </div>

                    <!-- Checkout Button -->
                    <a class="block text-center bg-black hover:bg-neutral-800 text-white text-xs sm:text-sm font-bold uppercase tracking-wider py-3.5 rounded-sm transition-colors shadow-sm" href="{{ route('checkout') }}">
                        PROCEED TO CHECKOUT &rarr;
                    </a>

                    <!-- Reassurances -->
                    <div class="pt-2 text-center text-[11px] text-neutral-500 space-y-1">
                        <p class="flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5 text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            <span>100% Encrypted &amp; Secure Checkout</span>
                        </p>
                        <p>3 Free Samples with every order</p>
                        <p>Promo codes can be applied on the next step</p>
                    </div>
                </div>
            </aside>
        </div>
    @endif
</main>
@endsection
