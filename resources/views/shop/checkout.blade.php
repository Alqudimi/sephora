@extends('layouts.app')

@section('title', 'Checkout | SEPHORA UAE')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav class="text-body-sm font-body-sm text-outline mb-4" aria-label="Breadcrumb">
        <a class="hover:text-secondary transition-colors" href="/">Home</a>
        <span class="mx-1.5">/</span>
        <a class="hover:text-secondary transition-colors" href="{{ route('cart') }}">Shopping Bag</a>
        <span class="mx-1.5">/</span>
        <span class="text-on-surface font-semibold">Checkout</span>
    </nav>

    <div class="flex flex-wrap items-end justify-between gap-3 border-b border-primary pb-4 mb-8">
        <div>
            <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Secure Checkout</h1>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">United Arab Emirates &middot; Prices include 5% VAT</p>
        </div>
        <div class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps">
            <span class="material-symbols-outlined text-[16px] text-primary">verified_user</span>
            <span>Encrypted connection</span>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 border border-secondary bg-surface-container-low p-4" role="alert">
            <p class="font-title-md text-title-md text-secondary font-bold uppercase mb-2">Please review the highlighted fields</p>
            <ul class="list-disc list-inside font-body-sm text-body-sm text-on-surface-variant space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="checkout-form" method="POST" action="{{ route('checkout.place') }}"
          data-summary-url="{{ route('checkout.summary') }}"
          data-max-samples="{{ (int) config('commerce.max_samples', 3) }}"
          class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">
        @csrf
        <input type="hidden" name="idempotency_key" value="{{ old('idempotency_key', $idempotencyKey) }}">

        <div class="lg:col-span-7 xl:col-span-8 flex flex-col gap-space-md">

            {{-- 1. Contact & delivery address --}}
            <section class="border border-primary bg-surface-container-lowest">
                <header class="p-space-md md:p-space-lg border-b border-primary flex items-center gap-4">
                    <span class="w-8 h-8 bg-primary text-on-primary flex items-center justify-center font-title-md text-title-md">1</span>
                    <div>
                        <h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Receive Your Order</h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Contact details and delivery address</p>
                    </div>
                </header>

                <div class="p-space-md md:p-space-lg space-y-space-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="customer_name">Recipient full name *</label>
                            <input id="customer_name" name="customer_name" type="text" required autocomplete="name"
                                   value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                   class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-0">
                        </div>
                        <div>
                            <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="customer_phone">UAE mobile number *</label>
                            <input id="customer_phone" name="customer_phone" type="tel" required autocomplete="tel"
                                   inputmode="tel" placeholder="+971 50 123 4567" maxlength="40"
                                   value="{{ old('customer_phone', auth()->user()->phone ?? $defaultAddress->phone ?? '') }}"
                                   class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-0">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="customer_email">Email for confirmation *</label>
                            <input id="customer_email" name="customer_email" type="email" autocomplete="email"
                                   @guest required @endguest
                                   value="{{ old('customer_email', auth()->user()->email ?? '') }}"
                                   class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-0">
                            <p class="font-body-sm text-body-sm text-outline mt-1">We email the order confirmation and tracking link here.</p>
                        </div>
                    </div>

                    <div class="pt-space-sm border-t border-primary/10">
                        <h3 class="font-title-md text-title-md uppercase tracking-wider text-primary mb-4">Delivery address</h3>
                        <div id="address-fields" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="emirate">Emirate *</label>
                                <select id="emirate" name="emirate" class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md uppercase bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-0">
                                    <option value="">Select emirate</option>
                                    @foreach (['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Al Ain', 'Ras Al Khaimah', 'Fujairah', 'Umm Al Quwain'] as $emirate)
                                        <option value="{{ $emirate }}" @selected(old('emirate', $defaultAddress->emirate ?? 'Dubai') === $emirate)>{{ $emirate }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="area">District / area</label>
                                <input id="area" name="area" type="text" autocomplete="address-level2"
                                       value="{{ old('area', $defaultAddress->area ?? '') }}"
                                       placeholder="e.g. Downtown Dubai"
                                       class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-0">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="street_address">Building, street or villa *</label>
                                <input id="street_address" name="street_address" type="text" autocomplete="street-address"
                                       value="{{ old('street_address', $defaultAddress->street_address ?? '') }}"
                                       placeholder="e.g. Burj Crown Residences, Suite 1804"
                                       class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-0">
                            </div>
                            <div>
                                <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="building">Apartment / villa no.</label>
                                <input id="building" name="building" type="text"
                                       value="{{ old('building', $defaultAddress->building ?? '') }}"
                                       class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-0">
                            </div>
                            <div>
                                <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="delivery_instructions">Delivery notes / landmark</label>
                                <input id="delivery_instructions" name="delivery_instructions" type="text" maxlength="500"
                                       value="{{ old('delivery_instructions', $defaultAddress->delivery_instructions ?? '') }}"
                                       placeholder="e.g. Leave with concierge"
                                       class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-0">
                            </div>
                        </div>

                        <div id="store-field" class="mt-4 hidden">
                            <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="store_id">Pick-up boutique *</label>
                            <select id="store_id" name="store_id" class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-0">
                                <option value="">Select a boutique</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}" @selected((string) old('store_id') === (string) $store->id)>
                                        {{ $store->name }} — {{ $store->city }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="font-body-sm text-body-sm text-outline mt-1">You will receive a ready-for-collection email. Bring your order number and photo ID.</p>
                        </div>

                        @auth
                            <label class="mt-4 flex items-center gap-3 cursor-pointer">
                                <input class="w-4 h-4 text-primary border-primary focus:ring-0" id="save_address" type="checkbox" name="save_address" value="1" @checked(old('save_address'))>
                                <span class="font-body-sm text-body-sm text-on-surface">Save this address to my account</span>
                            </label>
                        @endauth
                    </div>
                </div>
            </section>

            {{-- 2. Delivery method --}}
            <section class="border border-outline-variant bg-surface-container-lowest">
                <header class="p-space-md md:p-space-lg border-b border-outline-variant flex items-center gap-4">
                    <span class="w-8 h-8 bg-surface-container-low text-primary border border-outline-variant flex items-center justify-center font-title-md text-title-md">2</span>
                    <div>
                        <h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Delivery Method</h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Choose how and when you receive your order</p>
                    </div>
                </header>
                <div class="p-space-md md:p-space-lg grid grid-cols-1 md:grid-cols-3 gap-3">
                    @php
                        $deliveryMeta = [
                            'standard' => ['icon' => 'local_shipping', 'title' => 'Standard Delivery', 'note' => '2–3 business days', 'fee' => (float) config('commerce.shipping.standard', 25)],
                            'same_day' => ['icon' => 'bolt', 'title' => 'Same-Day Delivery', 'note' => 'Dubai, Sharjah, Ajman — order before 2 PM', 'fee' => (float) config('commerce.shipping.same_day', 40)],
                            'click_collect' => ['icon' => 'storefront', 'title' => 'Click &amp; Collect', 'note' => 'Ready in about 2 hours', 'fee' => 0.0],
                        ];
                    @endphp
                    @foreach ($deliveryMethods as $key => $label)
                        @php $meta = $deliveryMeta[$key] ?? ['icon' => 'local_shipping', 'title' => $label, 'note' => '', 'fee' => 0.0]; @endphp
                        <label class="relative border border-outline-variant p-4 cursor-pointer bg-surface-container-lowest flex flex-col justify-between hover:border-primary transition-colors has-[:checked]:border-2 has-[:checked]:border-primary">
                            <input class="absolute top-4 right-4 text-primary focus:ring-0 w-4 h-4 border-outline-variant" name="delivery_method" type="radio" value="{{ $key }}" @checked(old('delivery_method', $deliveryMethod) === $key)>
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="material-symbols-outlined text-primary text-[22px]">{{ $meta['icon'] }}</span>
                                    <span class="font-title-md text-title-md text-primary font-bold">{!! $meta['title'] !!}</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mb-2">{{ $meta['note'] }}</p>
                            </div>
                            <div class="mt-4 pt-2 border-t border-outline-variant/40 flex items-center justify-between text-primary">
                                <span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant">Fee</span>
                                <span class="font-title-md text-body-md font-bold">
                                    @if ($key === 'standard')
                                        FREE over {{ number_format($freeShippingThreshold, 0) }} AED
                                    @elseif ($meta['fee'] <= 0)
                                        FREE
                                    @else
                                        AED {{ number_format($meta['fee'], 2) }}
                                    @endif
                                </span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </section>

            {{-- 3. Samples & gift options --}}
            <section class="border border-outline-variant bg-surface-container-lowest">
                <header class="p-space-md md:p-space-lg border-b border-outline-variant flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-4">
                        <span class="w-8 h-8 bg-surface-container-low text-primary border border-outline-variant flex items-center justify-center font-title-md text-title-md">3</span>
                        <div>
                            <h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Samples &amp; Gift Options</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Select up to {{ (int) config('commerce.max_samples', 3) }} complimentary deluxe minis</p>
                        </div>
                    </div>
                    <span class="font-label-caps text-label-caps uppercase text-secondary font-bold tracking-widest" id="sample-counter">0 selected</span>
                </header>
                <div class="p-space-md md:p-space-lg space-y-space-md">
                    @if ($samples->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @foreach ($samples as $sample)
                                <label class="border border-outline-variant p-3 relative flex flex-col justify-between cursor-pointer hover:border-primary has-[:checked]:border-2 has-[:checked]:border-primary">
                                    <input type="checkbox" class="absolute top-2 right-2 w-4 h-4 text-primary border-primary focus:ring-0" name="samples[]" value="{{ $sample->id }}" @checked(in_array((string) $sample->id, array_map('strval', (array) old('samples', [])), true))>
                                    <div class="w-full h-32 bg-surface-container-lowest flex items-center justify-center mb-2 overflow-hidden border border-outline-variant">
                                        <img class="h-28 object-contain" alt="{{ $sample->name }}" src="{{ media_url($sample->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <div>
                                        <span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant block">{{ $sample->brand?->name }}</span>
                                        <h3 class="font-title-md text-body-sm font-bold text-primary truncate">{{ $sample->name }}</h3>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p class="font-body-sm text-body-sm text-on-surface-variant">No samples are available right now.</p>
                    @endif

                    <div class="pt-space-sm border-t border-primary/10">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="font-title-md text-title-md uppercase tracking-wider text-primary">Signature gift box</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Complimentary Sephora black-and-white striped box with ribbon.</p>
                            </div>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input class="w-4 h-4 text-primary border-primary focus:ring-0" id="gift_box" type="checkbox" name="gift_box" value="1" @checked(old('gift_box'))>
                                <span class="font-body-sm text-body-sm text-primary whitespace-nowrap">Add gift box</span>
                            </label>
                        </div>
                        <div class="mt-3">
                            <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="gift_message">Gift message</label>
                            <textarea id="gift_message" name="gift_message" rows="2" maxlength="400"
                                      class="w-full border border-outline p-2.5 font-body-sm text-body-sm bg-surface-container-lowest focus:outline-none focus:border-primary"
                                      placeholder="Write a message for the gift card (max 400 characters)">{{ old('gift_message') }}</textarea>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 4. Payment --}}
            <section class="border border-primary bg-surface-container-lowest">
                <header class="p-space-md md:p-space-lg border-b border-primary flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-4">
                        <span class="w-8 h-8 bg-primary text-on-primary flex items-center justify-center font-title-md text-title-md">4</span>
                        <div>
                            <h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Payment Method</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Card details are entered on the payment provider's secure page</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 text-primary">
                        <span class="material-symbols-outlined text-[18px]">lock</span>
                        <span class="font-label-caps text-label-caps uppercase">Secure payment</span>
                    </div>
                </header>

                <div class="p-space-md md:p-space-lg space-y-3">
                    @forelse ($paymentMethods as $key => $label)
                        @php
                            $paymentMeta = [
                                'card' => ['icon' => 'credit_card', 'note' => 'Visa, Mastercard, American Express. 3-D Secure where required.'],
                                'apple_pay' => ['icon' => 'phone_iphone', 'note' => 'Pay with Apple Pay on supported devices.'],
                                'cod' => ['icon' => 'payments', 'note' => 'Pay the courier in cash on delivery. A AED '.number_format((float) config('commerce.shipping.cod_fee', 20), 0).' fee applies.'],
                                'tabby' => ['icon' => 'account_balance_wallet', 'note' => 'Split your purchase into 4 interest-free payments.'],
                                'tamara' => ['icon' => 'account_balance_wallet', 'note' => 'Split your purchase into 4 payments. Sharia-compliant.'],
                            ];
                            $meta = $paymentMeta[$key] ?? ['icon' => 'payments', 'note' => ''];
                        @endphp
                        <label class="border border-outline-variant p-4 bg-surface-container-lowest hover:border-primary transition-colors flex items-center justify-between cursor-pointer has-[:checked]:border-2 has-[:checked]:border-primary">
                            <div class="flex items-center gap-3">
                                <input class="w-4 h-4 text-primary border-primary focus:ring-0" name="payment_method" type="radio" value="{{ $key }}" @checked(old('payment_method', $paymentMethod) === $key)>
                                <div>
                                    <span class="font-title-md text-title-md uppercase tracking-wider text-primary">{{ $label }}</span>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $meta['note'] }}</p>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-outline">{{ $meta['icon'] }}</span>
                        </label>
                    @empty
                        <p class="font-body-sm text-body-sm text-secondary" role="alert">
                            Online payment is temporarily unavailable. Please contact client concierge to complete your order.
                        </p>
                    @endforelse

                    <label class="flex items-start gap-3 pt-2 cursor-pointer">
                        <input class="mt-0.5 w-4 h-4 text-primary border-primary focus:ring-0" type="checkbox" name="terms" value="1" required @checked(old('terms'))>
                        <span class="font-body-sm text-body-sm text-on-surface">
                            I agree to the <a class="underline hover:text-secondary" href="{{ url('/terms') }}">Terms &amp; Conditions</a>,
                            <a class="underline hover:text-secondary" href="{{ url('/privacy') }}">Privacy Policy</a> and confirm my order details.
                        </span>
                    </label>
                </div>
            </section>
        </div>

        {{-- Order summary --}}
        <aside class="lg:col-span-5 xl:col-span-4 lg:sticky lg:top-28 space-y-space-md" aria-label="Order summary">
            <div class="border-2 border-primary bg-surface-container-lowest">
                <div class="p-space-md border-b border-primary flex items-center justify-between bg-surface-container-lowest">
                    <h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Order Summary</h2>
                    <span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant font-bold">{{ $items->sum('quantity') }} item{{ $items->sum('quantity') === 1 ? '' : 's' }}</span>
                </div>

                <div class="divide-y divide-primary/10 max-h-80 overflow-y-auto">
                    @foreach ($items as $item)
                        <div class="p-4 flex gap-4 items-center">
                            <div class="w-20 h-20 bg-surface-container-low border border-outline-variant flex-shrink-0 flex items-center justify-center p-1">
                                <img class="w-full h-full object-contain" alt="{{ $item->product->name }}" src="{{ media_url($item->product->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                            </div>
                            <div class="flex-grow min-w-0">
                                <span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant">{{ $item->product->brand?->name }}</span>
                                <h3 class="font-title-md text-body-md font-bold text-primary leading-tight">{{ $item->product->name }}</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Qty: {{ $item->quantity }}{{ $item->shade_name ? ' • '.$item->shade_name : '' }}</p>
                                <p class="font-price-aed-md text-price-aed-md text-primary mt-1">AED {{ number_format($item->product->price * $item->quantity, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4 border-t border-b border-primary bg-surface-container-low">
                    <label class="block font-label-caps text-label-caps uppercase text-primary mb-1.5 tracking-wider" for="promo-code-input">Promo code</label>
                    <div class="flex gap-2">
                        <input class="flex-grow h-11 border border-outline px-3 py-2 text-primary font-body-md uppercase bg-surface-container-lowest focus:outline-none focus:border-primary"
                               placeholder="e.g. WELCOME10" type="text" id="promo-code-input" value="{{ $appliedCoupon }}" autocomplete="off">
                        <button class="px-5 h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors"
                                type="button" id="promo-apply-btn">Apply</button>
                    </div>
                    <p class="hidden mt-2 font-body-sm text-body-sm" id="promo-feedback" aria-live="polite"></p>
                    @if ($appliedCoupon)
                        <button type="button" id="promo-remove-btn" class="mt-2 font-body-sm text-body-sm text-secondary underline">Remove promo code</button>
                    @endif
                </div>

                <div class="p-space-md space-y-3" aria-live="polite">
                    <div class="flex justify-between font-body-md text-body-md">
                        <span class="text-on-surface-variant">Subtotal</span>
                        <span class="font-bold text-primary" id="summary-subtotal">AED {{ number_format($totals->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-body-md text-body-md {{ $discount > 0 ? '' : 'hidden' }}" id="discount-row">
                        <span class="text-on-surface-variant">Promo ({{ $appliedCoupon }})</span>
                        <span class="font-bold text-secondary" id="summary-discount">-AED {{ number_format($discount, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-body-md text-body-md">
                        <span class="text-on-surface-variant" id="summary-shipping-label">{{ $deliveryMethods[$deliveryMethod] ?? 'Delivery' }}</span>
                        <span class="font-bold text-secondary uppercase tracking-wider" id="summary-shipping">{{ $totals->shipping <= 0 ? 'FREE' : 'AED '.number_format($totals->shipping, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-body-sm text-body-sm">
                        <span class="text-on-surface-variant">VAT ({{ number_format($totals->taxRate, 0) }}%) included</span>
                        <span class="text-on-surface-variant" id="summary-tax">AED {{ number_format($totals->taxAmount, 2) }}</span>
                    </div>
                    <div class="border-t border-primary/20 pt-3 flex justify-between items-baseline">
                        <div>
                            <span class="font-title-lg text-title-lg uppercase tracking-wider text-primary block">Total</span>
                            <span class="font-label-caps text-label-caps text-on-surface-variant">All taxes included</span>
                        </div>
                        <span class="font-price-aed-lg text-price-aed-lg text-primary" id="checkout-total">AED {{ number_format($totals->total, 2) }}</span>
                    </div>

                    <div class="p-3 bg-surface-container-low border border-primary flex items-center gap-3 mt-2">
                        <span class="material-symbols-outlined text-secondary text-[20px]">stars</span>
                        <p class="font-label-caps text-label-caps text-primary tracking-wider uppercase">
                            <span class="font-bold text-secondary" id="summary-points">+{{ (int) floor($totals->total) }} Beauty Pass points</span> will be credited
                        </p>
                    </div>

                    <div class="pt-2">
                        <button id="checkout-submit" class="w-full h-14 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-[0.2em] font-bold border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all duration-200 flex items-center justify-center gap-3 disabled:opacity-60"
                                type="submit">
                            <span class="material-symbols-outlined text-[20px]">lock</span>
                            <span id="checkout-submit-label">Complete Purchase</span>
                        </button>
                    </div>

                    <div class="pt-3 border-t border-primary/10 space-y-2">
                        <div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
                            <span class="material-symbols-outlined text-[16px] text-primary">verified</span>
                            <span>100% authentic brand guarantee</span>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
                            <span class="material-symbols-outlined text-[16px] text-primary">assignment_return</span>
                            <span>Complimentary 14-day returns</span>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
                            <span class="material-symbols-outlined text-[16px] text-primary">support_agent</span>
                            <span>Client concierge 10 AM – 10 PM</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border border-outline-variant p-4 bg-surface-container-lowest">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h3 class="font-title-md text-body-md font-bold text-primary uppercase tracking-wider">Need help?</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Our beauty advisors are available 10 AM – 10 PM.</p>
                    </div>
                    <a class="font-label-caps text-label-caps uppercase tracking-wider text-primary underline font-bold" href="mailto:customercare@sephora.ae">Contact us</a>
                </div>
            </div>
        </aside>
    </form>
</main>
@endsection

@section('scripts')
<script>
(function () {
    const form = document.getElementById('checkout-form');
    if (!form) return;

    const summaryUrl = form.dataset.summaryUrl;
    const maxSamples = parseInt(form.dataset.maxSamples || '3', 10);
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    const shippingLabel = document.getElementById('summary-shipping-label');
    const storeField = document.getElementById('store-field');
    const storeSelect = document.getElementById('store_id');
    const samples = Array.from(document.querySelectorAll('input[name="samples[]"]'));
    const sampleCounter = document.getElementById('sample-counter');

    function selected(name) {
        const el = form.querySelector('input[name="' + name + '"]:checked');
        return el ? el.value : null;
    }

    function deliveryLabel() {
        const checked = form.querySelector('input[name="delivery_method"]:checked');
        if (!checked) return 'Delivery';
        const label = checked.closest('label');
        const title = label ? label.querySelector('.font-title-md') : null;
        return title ? title.textContent.trim() : checked.value;
    }

    function applyTotals(data) {
        const f = data.formatted || {};
        const set = (id, value) => {
            const el = document.getElementById(id);
            if (el && typeof value !== 'undefined') el.textContent = value;
        };

        set('summary-subtotal', f.subtotal);
        set('summary-shipping', f.shipping);
        set('summary-tax', f.tax);
        set('checkout-total', f.total);

        if (shippingLabel) shippingLabel.textContent = deliveryLabel();

        const discountRow = document.getElementById('discount-row');
        if (discountRow) {
            if (Number(data.discount) > 0) {
                discountRow.classList.remove('hidden');
                set('summary-discount', '-' + (f.discount || ''));
            } else {
                discountRow.classList.add('hidden');
            }
        }

        const points = document.getElementById('summary-points');
        if (points && typeof data.total !== 'undefined') {
            points.textContent = '+' + Math.floor(Number(data.total)) + ' Beauty Pass points';
        }
    }

    let summaryTimer = null;
    function refreshTotals() {
        clearTimeout(summaryTimer);
        summaryTimer = setTimeout(function () {
            const body = {
                delivery_method: selected('delivery_method') || 'standard',
                payment_method: selected('payment_method') || 'card'
            };
            fetch(summaryUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(body)
            })
                .then(r => r.json())
                .then(res => { if (res.success) applyTotals(res); })
                .catch(() => {});
        }, 120);
    }

    function toggleStore() {
        const method = selected('delivery_method');
        const isCollect = method === 'click_collect';
        if (storeField) storeField.classList.toggle('hidden', !isCollect);
        if (storeSelect) storeSelect.required = isCollect;
        const address = document.getElementById('address-fields');
        if (address) address.classList.toggle('opacity-50', isCollect);
    }

    form.querySelectorAll('input[name="delivery_method"], input[name="payment_method"]').forEach(function (input) {
        input.addEventListener('change', function () {
            toggleStore();
            refreshTotals();
        });
    });

    samples.forEach(function (input) {
        input.addEventListener('change', function () {
            const checked = samples.filter(s => s.checked);
            if (checked.length > maxSamples) {
                input.checked = false;
                if (window.sephoraToast) window.sephoraToast('You can choose up to ' + maxSamples + ' samples.', 'error');
            }
            const count = samples.filter(s => s.checked).length;
            if (sampleCounter) sampleCounter.textContent = count + ' selected';
        });
    });

    const removeBtn = document.getElementById('promo-remove-btn');
    if (removeBtn) {
        removeBtn.addEventListener('click', function () {
            fetch('{{ route('checkout.coupon.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    delivery_method: selected('delivery_method') || 'standard',
                    payment_method: selected('payment_method') || 'card'
                })
            })
                .then(r => r.json())
                .then(res => {
                    if (res.success) {
                        applyTotals(res);
                        const input = document.getElementById('promo-code-input');
                        if (input) input.value = '';
                        removeBtn.remove();
                    }
                })
                .catch(() => {});
        });
    }

    document.addEventListener('checkout:totals', function (event) {
        const detail = event.detail || {};
        applyTotals(detail);
        if (Number(detail.discount) > 0 && !document.getElementById('promo-remove-btn')) {
            // Reload-free path: the server already persisted the coupon in session.
            const holder = document.getElementById('promo-feedback');
            if (holder && holder.parentElement) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.id = 'promo-remove-btn';
                btn.className = 'mt-2 font-body-sm text-body-sm text-secondary underline';
                btn.textContent = 'Remove promo code';
                btn.addEventListener('click', () => window.location.reload());
                holder.parentElement.appendChild(btn);
            }
        }
    });

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            return;
        }
        const btn = document.getElementById('checkout-submit');
        const label = document.getElementById('checkout-submit-label');
        if (btn) btn.disabled = true;
        if (label) label.textContent = 'Processing…';
    });

    toggleStore();
})();
</script>
@endsection
