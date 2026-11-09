@extends('layouts.app')

@section('title', __('messages.confirmation.title', ['number' => $order->order_number]))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
@php
    $isPaid = $order->payment_status === 'paid';
    $isRefunded = $order->payment_status === 'refunded' || $order->status === 'refunded';
    $isCancelled = $order->status === 'cancelled';
    $isCod = $order->payment_method === 'cod';
    $isOnline = in_array($order->payment_method, ['card', 'apple_pay', 'tabby', 'tamara', 'zaincash'], true);
    $canRetry = ! $isPaid && ! $isRefunded && ! $isCancelled && $isOnline;

    $statusIndex = match ($order->status) {
        'pending' => 0,
        'processing' => 1,
        'shipped', 'out_for_delivery' => 2,
        'delivered' => 3,
        default => -1,
    };
    $timeline = [
        ['label' => __('messages.confirmation.order_placed'), 'icon' => 'receipt_long'],
        ['label' => __('messages.confirmation.preparing'), 'icon' => 'inventory_2'],
        ['label' => __('messages.confirmation.shipped'), 'icon' => 'local_shipping'],
        ['label' => __('messages.confirmation.delivered'), 'icon' => 'check_circle'],
    ];

    $isPickup = $order->delivery_method === 'click_collect';
    $deliveryLabel = config('commerce.delivery_methods.' . $order->delivery_method, ucfirst(str_replace('_', ' ', (string) $order->delivery_method)));
    $currency = config('commerce.currency', 'AED');
@endphp

<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav class="text-body-sm font-body-sm text-outline mb-4" aria-label="Breadcrumb">
        <a class="hover:text-secondary transition-colors" href="/">{{ __('messages.home') }}</a>
        <span class="mx-1.5">/</span>
        <span class="text-on-surface font-semibold">{{ __('messages.confirmation.heading') }}</span>
    </nav>

    {{-- Flash messages from the payment flow --}}
    @if (session('payment_error'))
        <div class="mb-6 border border-secondary bg-surface-container-low p-4 flex items-start gap-3" role="alert">
            <span class="material-symbols-outlined text-secondary text-[22px]">error</span>
            <p class="font-body-sm text-body-sm text-secondary">{{ session('payment_error') }}</p>
        </div>
    @endif

    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="text-center py-8 md:py-10">
            <div class="w-20 h-20 rounded-full {{ $isPaid || $isCod ? 'bg-primary text-on-primary' : 'bg-surface-container-low text-primary border border-outline-variant' }} flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-[40px]">{{ $isCancelled ? 'cancel' : ($isRefunded ? 'undo' : 'check_circle') }}</span>
            </div>
            <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-2">
                {{ $isCancelled ? __('messages.confirmation.order_cancelled') : ($isRefunded ? __('messages.confirmation.order_refunded') : __('messages.confirmation.thank_you')) }}
            </span>
            <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase mb-3">
                {{ $isCancelled ? __('messages.confirmation.order_cancelled') : __('messages.confirmation.thank_you') . ', ' . $order->customer_name . '!' }}
            </h1>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto">
                Order <strong class="text-primary">{{ $order->order_number }}</strong>
                @if (! $isCancelled && ! $isRefunded)
                    has been received and is being prepared with care.
                @else
                    is closed. If you have questions, contact client concierge.
                @endif
            </p>
            @if ($order->customer_email)
                <p class="font-body-sm text-body-sm text-outline mt-2">A confirmation has been sent to {{ $order->customer_email }}.</p>
            @endif
        </div>

        {{-- Payment status banner --}}
        <section class="mb-6 border-2 {{ $isPaid ? 'border-primary' : ($isRefunded ? 'border-outline-variant' : ($isCancelled ? 'border-secondary' : 'border-outline')) }} bg-surface-container-lowest p-5 md:p-6" aria-live="polite">
            <div class="flex flex-col md:flex-row md:items-center gap-4 justify-between">
                <div class="flex items-start gap-4">
                    <span class="material-symbols-outlined text-[28px] {{ $isPaid ? 'text-primary' : ($isCancelled ? 'text-secondary' : 'text-on-surface-variant') }}">
                        {{ $isPaid ? 'verified' : ($isCod ? 'payments' : ($isRefunded ? 'undo' : ($isCancelled ? 'cancel' : 'schedule'))) }}
                    </span>
                    <div>
                        <h2 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">
                            @if ($isPaid)
                                Payment received
                            @elseif ($isCod)
                                Cash on delivery
                            @elseif ($isRefunded)
                                Payment refunded
                            @elseif ($isCancelled)
                                Order cancelled
                            @elseif ($order->payment_status === 'failed')
                                Payment failed
                            @else
                                Payment pending
                            @endif
                        </h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 max-w-xl">
                            @if ($isPaid)
                                We have received your payment of {{ $currency }} {{ number_format($order->total, 2) }}. Your order is confirmed.
                            @elseif ($isCod)
                                Please have {{ $currency }} {{ number_format($order->total, 2) }} ready for the courier. The amount includes any cash-on-delivery fee.
                            @elseif ($isRefunded)
                                A refund of {{ $currency }} {{ number_format($order->refund_amount ?: $order->total, 2) }} has been issued to your original payment method. Bank processing can take 5–10 business days.
                            @elseif ($isCancelled)
                                {{ $order->cancel_reason ?: 'This order will not be fulfilled. Any captured payment is refunded automatically.' }}
                            @elseif ($order->payment_status === 'failed')
                                Your payment was not completed. You can try again securely below — no charge was made.
                            @else
                                Your order is reserved, but payment has not been confirmed yet. Complete payment to start preparation.
                            @endif
                        </p>
                    </div>
                </div>

                @if ($canRetry)
                    <form method="POST" action="{{ route('checkout.payment.retry', ['order' => $order->order_number]) }}" class="shrink-0">
                        @csrf
                        <button type="submit" class="w-full md:w-auto bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 py-3 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all">
                            {{ $order->payment_status === 'failed' ? 'Try payment again' : 'Complete payment' }}
                        </button>
                    </form>
                @endif
            </div>
        </section>

        {{-- Status timeline --}}
        @if (! $isCancelled && ! $isRefunded)
            <section class="mb-6 border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                <h2 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold mb-5">Order status</h2>
                <ol class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach ($timeline as $index => $step)
                        @php $done = $statusIndex >= $index; @endphp
                        <li class="relative">
                            <div class="flex items-center gap-2">
                                <span class="w-8 h-8 rounded-full flex items-center justify-center {{ $done ? 'bg-primary text-on-primary' : 'bg-surface-container-low text-outline border border-outline-variant' }}">
                                    <span class="material-symbols-outlined text-[18px]">{{ $step['icon'] }}</span>
                                </span>
                                <span class="font-label-caps text-label-caps uppercase tracking-wider {{ $done ? 'text-primary font-bold' : 'text-outline' }}">{{ $step['label'] }}</span>
                            </div>
                            @if ($index === 0 && $order->placed_at)
                                <p class="font-body-sm text-body-sm text-outline mt-2">{{ $order->placed_at->format('d M, h:i A') }}</p>
                            @endif
                            @if ($index === 2 && $order->shipped_at)
                                <p class="font-body-sm text-body-sm text-outline mt-2">{{ $order->shipped_at->format('d M, h:i A') }}</p>
                            @endif
                            @if ($index === 3 && $order->delivered_at)
                                <p class="font-body-sm text-body-sm text-outline mt-2">{{ $order->delivered_at->format('d M, h:i A') }}</p>
                            @endif
                        </li>
                    @endforeach
                </ol>
                @if ($order->tracking_number)
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-5 pt-4 border-t border-outline-variant">
                        Tracking number: <strong class="text-primary">{{ $order->tracking_number }}</strong>
                    </p>
                @endif
            </section>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <div class="lg:col-span-7 space-y-6">

                {{-- Items --}}
                <section class="border border-outline-variant bg-surface-container-lowest">
                    <header class="p-5 border-b border-outline-variant flex items-center justify-between">
                        <h2 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">Your items</h2>
                        <span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant">{{ $order->items->sum('quantity') }} item{{ $order->items->sum('quantity') === 1 ? '' : 's' }}</span>
                    </header>
                    <div class="divide-y divide-outline-variant/60">
                        @foreach ($order->items as $item)
                            <div class="p-4 flex items-center gap-4">
                                <div class="w-16 h-16 shrink-0 bg-surface-container-low border border-outline-variant flex items-center justify-center p-1">
                                    <img alt="{{ $item->product_name }}" class="w-full h-full object-contain" src="{{ media_url($item->image_path) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant">{{ $item->brand_name }}</span>
                                    <p class="font-title-md text-body-md font-bold text-primary leading-tight truncate">{{ $item->product_name }}</p>
                                    <p class="font-body-sm text-body-sm text-outline">
                                        Qty {{ $item->quantity }}{{ $item->shade_name ? ' · ' . $item->shade_name : '' }}
                                        · {{ $currency }} {{ number_format($item->unit_price, 2) }} each
                                    </p>
                                </div>
                                <span class="font-price-aed-md text-price-aed-md font-bold text-primary whitespace-nowrap">{{ $currency }} {{ number_format($item->line_total, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- Delivery / pickup --}}
                <section class="border border-outline-variant bg-surface-container-lowest p-5 space-y-4">
                    <h2 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">
                        {{ $isPickup ? 'Click & Collect' : 'Delivery details' }}
                    </h2>

                    <div class="flex justify-between gap-4 font-body-sm text-body-sm">
                        <span class="text-on-surface-variant">Method</span>
                        <span class="text-primary font-semibold text-right">{{ $deliveryLabel }}</span>
                    </div>

                    @if ($isPickup && $order->store)
                        <div class="border-t border-outline-variant/60 pt-3 space-y-1">
                            <p class="font-body-md text-body-md text-primary font-semibold">{{ $order->store->name }}</p>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $order->store->address }}, {{ $order->store->city }}</p>
                            @if ($order->store->phone)
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Phone: {{ $order->store->phone }}</p>
                            @endif
                            <p class="font-body-sm text-body-sm text-outline mt-2">Bring your order number and a photo ID. We hold uncollected orders for 7 days.</p>
                        </div>
                    @else
                        <div class="border-t border-outline-variant/60 pt-3 space-y-1">
                            <p class="font-body-md text-body-md text-primary font-semibold">{{ $order->customer_name }}</p>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $order->shipping_address }}</p>
                            @if ($order->emirate)
                                <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $order->area ? $order->area . ', ' : '' }}{{ $order->emirate }}</p>
                            @endif
                            @if ($order->customer_phone)
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Phone: {{ $order->customer_phone }}</p>
                            @endif
                            @if ($order->delivery_instructions)
                                <p class="font-body-sm text-body-sm text-outline mt-2">Notes: {{ $order->delivery_instructions }}</p>
                            @endif
                        </div>
                    @endif
                </section>

                {{-- Gift options --}}
                @if ($order->gift_box || $order->gift_message || ! empty($order->samples))
                    <section class="border border-outline-variant bg-surface-container-lowest p-5 space-y-3">
                        <h2 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">Gift & extras</h2>
                        @if ($order->gift_box)
                            <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-primary">redeem</span>
                                Signature Sephora gift box included.
                            </p>
                        @endif
                        @if ($order->gift_message)
                            <div class="border-l-2 border-primary pl-3">
                                <p class="font-label-caps text-label-caps uppercase text-outline tracking-wider">Gift message</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant italic">“{{ $order->gift_message }}”</p>
                            </div>
                        @endif
                        @if (! empty($order->samples))
                            <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-primary">spa</span>
                                {{ count($order->samples) }} complimentary sample{{ count($order->samples) === 1 ? '' : 's' }} added.
                            </p>
                        @endif
                    </section>
                @endif
            </div>

            {{-- Payment summary --}}
            <aside class="lg:col-span-5">
                <div class="border-2 border-primary bg-surface-container-lowest lg:sticky lg:top-28">
                    <header class="p-5 border-b border-primary">
                        <h2 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">Payment summary</h2>
                    </header>

                    <dl class="p-5 space-y-3 font-body-md text-body-md">
                        <div class="flex justify-between gap-4">
                            <dt class="text-on-surface-variant">Subtotal</dt>
                            <dd class="text-primary font-semibold">{{ $currency }} {{ number_format($order->subtotal, 2) }}</dd>
                        </div>

                        @if ($order->discount > 0)
                            <div class="flex justify-between gap-4">
                                <dt class="text-on-surface-variant">Promo{{ $order->coupon_code ? ' (' . $order->coupon_code . ')' : '' }}</dt>
                                <dd class="text-secondary font-semibold">−{{ $currency }} {{ number_format($order->discount, 2) }}</dd>
                            </div>
                        @endif

                        <div class="flex justify-between gap-4">
                            <dt class="text-on-surface-variant">{{ $isPickup ? 'Pick-up' : 'Delivery' }}</dt>
                            <dd class="text-primary font-semibold">
                                {{ $order->shipping_fee <= 0 ? 'FREE' : $currency . ' ' . number_format($order->shipping_fee, 2) }}
                            </dd>
                        </div>

                        @if ($order->payment_method === 'cod')
                            <div class="flex justify-between gap-4">
                                <dt class="text-on-surface-variant">Cash-on-delivery fee</dt>
                                <dd class="text-on-surface-variant">Included</dd>
                            </div>
                        @endif

                        <div class="flex justify-between gap-4 font-body-sm text-body-sm pt-2 border-t border-outline-variant/60">
                            <dt class="text-on-surface-variant">VAT ({{ rtrim(rtrim(number_format($order->tax_rate, 2), '0'), '.') }}%) included</dt>
                            <dd class="text-on-surface-variant">{{ $currency }} {{ number_format($order->tax_amount, 2) }}</dd>
                        </div>

                        <div class="flex justify-between items-baseline gap-4 pt-4 border-t border-primary">
                            <dt class="font-title-lg text-title-lg text-primary uppercase tracking-wider">Total</dt>
                            <dd class="font-price-aed-lg text-price-aed-lg font-bold text-primary">{{ $currency }} {{ number_format($order->total, 2) }}</dd>
                        </div>

                        <div class="pt-3 text-right">
                            <span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant">
                                {{ $order->payment_method_label }}
                                @if ($isPaid)
                                    · Paid
                                @elseif ($isCod)
                                    · Due on delivery
                                @elseif ($isRefunded)
                                    · Refunded
                                @else
                                    · {{ ucfirst($order->payment_status) }}
                                @endif
                            </span>
                        </div>
                    </dl>

                    @guest
                        <div class="mx-5 mb-5 p-4 bg-surface-container-low border border-outline-variant">
                            <p class="font-label-caps text-label-caps uppercase tracking-wider text-primary font-bold mb-1">Guest checkout</p>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">
                                This page is available from the session that placed the order and from the link in your confirmation email. Bookmark it now to keep your receipt.
                            </p>
                            <a class="inline-block mt-2 font-body-sm text-body-sm text-primary underline" href="{{ URL::temporarySignedRoute('checkout.confirmation.guest', now()->addDays(30), ['order' => $order->order_number]) }}">
                                Get a secure receipt link
                            </a>
                        </div>
                    @endguest
                </div>

                <div class="mt-4 flex flex-col gap-3">
                    @auth
                        <a class="text-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 py-4 hover:bg-surface-container-lowest hover:text-primary border border-primary transition-all" href="{{ route('account.orders') }}">
                            {{ __('messages.confirmation.track_package') }}
                        </a>
                    @else
                        <a class="text-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 py-4 hover:bg-surface-container-lowest hover:text-primary border border-primary transition-all" href="{{ route('login') }}">
                            {{ __('messages.auth.login') }}
                        </a>
                    @endauth
                    <a class="text-center border border-primary text-primary font-label-caps text-label-caps uppercase tracking-widest px-6 py-4 hover:bg-primary hover:text-on-primary transition-all" href="/">
                        {{ __('messages.continue_shopping') }}
                    </a>
                </div>

                <p class="font-body-sm text-body-sm text-outline mt-4 text-center">
                    Questions? <a class="underline hover:text-secondary" href="mailto:customercare@sephora.ae">customercare@sephora.ae</a> · 800 SEPHORA
                </p>
            </aside>
        </div>
    </div>
</main>
@endsection
