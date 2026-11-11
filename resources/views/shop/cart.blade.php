@extends('layouts.app')

@section('title', __('messages.cart.title'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-4 sm:py-6">

    <!-- Breadcrumb -->
    <nav class="text-xs text-neutral-500 mb-4" aria-label="{{ __('ui.breadcrumb') }}">
        <a class="hover:text-black transition-colors" href="/">{{ __('messages.home') }}</a>
        <span class="mx-1.5">&rsaquo;</span>
        <span class="text-black font-semibold">{{ __('messages.cart.heading') }}</span>
    </nav>

    <div class="flex flex-wrap items-baseline justify-between gap-3 border-b-2 border-black pb-3 mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-black uppercase tracking-tight">{{ __('messages.cart.heading') }}</h1>
            <p class="text-xs text-neutral-500 mt-0.5">
                {{ __('messages.cart.items_in_bag', ['count' => $items->sum('quantity')]) }}
            </p>
        </div>
        <a class="text-xs font-bold text-black uppercase tracking-wider underline hover:text-neutral-600 transition-colors" href="/">
            {{ __('messages.cart.continue_shopping') }}
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
            <h2 class="text-xl font-bold uppercase tracking-tight text-black">{{ __('messages.cart.empty_heading') }}</h2>
            <p class="text-xs text-neutral-500 max-w-sm mx-auto">{{ __('messages.cart.empty_text') }}</p>
            <div class="pt-2">
                <a class="inline-block bg-black text-white text-xs font-bold uppercase tracking-wider px-8 py-3 rounded-sm hover:bg-neutral-800 transition-colors" href="{{ route('shop.bestsellers') }}">
                    {{ __('messages.cart.shop_bestsellers') }}
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">
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
                                <span class="text-xs text-neutral-500 mt-0.5">{{ __('messages.cart.shade') }}: <strong>{{ $item->shade_name }}</strong></span>
                            @endif
                            @if ($stock <= 0)
                                <span class="text-xs text-red-600 font-bold mt-1">{{ __('messages.cart.out_of_stock_remove') }}</span>
                            @elseif ($stock <= 5)
                                <span class="text-xs text-amber-600 font-medium mt-1">{{ __('messages.cart.only_left', ['count' => $stock]) }}</span>
                            @endif

                            <div class="mt-auto flex flex-wrap items-center justify-between gap-3 pt-3">
                                <!-- Quantity Controls -->
                                <div class="flex items-center border border-gray-300 rounded-sm h-8">
                                    <button class="w-8 h-full flex items-center justify-center hover:bg-gray-100 text-black text-sm disabled:opacity-40" data-qty-minus type="button" aria-label="{{ __('messages.cart.decrease_quantity') }}" @disabled($item->{{ __('ui.quantity') }} <= 1)>−</button>
                                    <input class="w-10 text-center text-xs font-bold text-black bg-transparent border-0 p-0"
                                           data-cart-item="{{ $item->id }}" data-qty-input type="number"
                                           min="1" max="{{ max(1, $maxQty) }}" value="{{ $item->quantity }}"
                                           aria-label="{{ __('messages.cart.quantity') }}">
                                    <button class="w-8 h-full flex items-center justify-center hover:bg-gray-100 text-black text-sm disabled:opacity-40" data-qty-plus type="button" aria-label="{{ __('messages.cart.increase_quantity') }}" @disabled($item->quantity >= $maxQty)>+</button>
                                </div>
                                <!-- Line Total -->
                                <span class="text-sm sm:text-base font-bold text-black">{{ __('messages.aed') }} {{ number_format($item->lineTotal(), 2) }}</span>
                            </div>
                        </div>

                        <!-- Remove Button -->
                        <button class="text-gray-400 hover:text-black transition-colors self-start shrink-0 p-1" data-cart-remove="{{ $item->id }}" title="{{ __('messages.cart.remove_item') }}" type="button">
                            <span class="text-lg leading-none font-bold">&times;</span>
                        </button>
                    </article>
                @endforeach

                <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                    <a class="text-xs font-bold text-black uppercase underline hover:text-neutral-600 transition-colors" href="/">
                        &larr; {{ __('messages.continue_shopping') }}
                    </a>
                    <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('{{ __('messages.cart.remove_all_confirm') }}')">
                        @csrf
                        <button class="text-xs text-neutral-500 uppercase underline hover:text-red-600 transition-colors" type="submit">
                            {{ __('messages.cart.clear_bag') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary Sidebar (4 cols) -->
            <aside class="lg:col-span-4">
                <div class="bg-gray-50 border border-gray-200 rounded-sm p-5 lg:sticky lg:top-28 space-y-4">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-black pb-3 border-b border-gray-200">{{ __('messages.cart.order_summary') }}</h2>

                    <!-- Free Delivery Progress -->
                    @php
                        $subtotalProgress = min(100, ($subtotal / max(1, $freeShippingThreshold)) * 100);
                    @endphp
                    <div class="bg-white p-3 rounded-sm border border-gray-200 space-y-1.5">
                        <div class="flex justify-between text-xs">
                            <span class="font-bold text-black">{{ __('messages.cart.free_standard_delivery') }}</span>
                            <span class="text-neutral-500">{{ $subtotal >= $freeShippingThreshold ? __('messages.cart.unlocked') : __('messages.cart.over_aed', ['amount' => number_format($freeShippingThreshold, 0)]) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-black h-1.5 rounded-full transition-all duration-300" style="width: {{ $subtotalProgress }}%"></div>
                        </div>
                        @if ($subtotal < $freeShippingThreshold)
                            <p class="text-[11px] text-neutral-600">
                                {!! __('messages.cart.add_more', ['amount' => number_format($freeShippingThreshold - $subtotal, 2)]) !!}
                            </p>
                        @else
                            <p class="text-[11px] text-green-700 font-semibold">
                                {{ __('messages.cart.free_delivery_unlocked') }}
                            </p>
                        @endif
                    </div>

                    <!-- Breakdown -->
                    <dl class="space-y-2.5 text-xs text-neutral-700">
                        <div class="flex justify-between">
                            <dt>{{ __('messages.subtotal') }}</dt>
                            <dd class="text-black font-semibold">{{ __('messages.aed') }} {{ number_format($subtotal, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>{{ __('messages.delivery') }}</dt>
                            <dd class="text-black font-semibold">{{ $shippingFee <= 0 ? __('messages.free_delivery') : __('messages.aed') . ' ' . number_format($shippingFee, 2) }}</dd>
                        </div>
                        <div class="flex justify-between text-neutral-500">
                            <dt>{{ __('messages.vat') }} (5%)</dt>
                            <dd>{{ __('messages.aed') }} {{ number_format($taxAmount, 2) }}</dd>
                        </div>
                    </dl>

                    <!-- Split Payments Banner (Tabby / Tamara) -->
                    @php
                        $installment = $total / 4;
                    @endphp
                    <div class="p-2.5 bg-neutral-100 rounded-sm border border-neutral-200 text-[11px] text-neutral-700">
                        <span>{!! __('messages.cart.installment_text', ['amount' => number_format($installment, 2)]) !!}</span>
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 pt-3 flex justify-between items-baseline">
                        <span class="text-sm font-bold uppercase tracking-wider text-black">{{ __('messages.total') }}</span>
                        <span class="text-lg font-extrabold text-black">{{ __('messages.aed') }} {{ number_format($total, 2) }}</span>
                    </div>

                    <!-- Checkout Button -->
                    <a class="block text-center bg-black hover:bg-neutral-800 text-white text-xs sm:text-sm font-bold uppercase tracking-wider py-3.5 rounded-sm transition-colors shadow-sm" href="{{ route('checkout') }}">
                        {{ __('messages.cart.proceed_to_checkout') }}
                    </a>

                    <!-- Reassurances -->
                    <div class="pt-2 text-center text-[11px] text-neutral-500 space-y-1">
                        <p class="flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5 text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            <span>{{ __('messages.cart.secure_encrypted') }}</span>
                        </p>
                        <p>{{ __('messages.cart.free_samples_note') }}</p>
                        <p>{{ __('messages.cart.promo_next_step') }}</p>
                    </div>
                </div>
            </aside>
        </div>
    @endif
</main>
@endsection
