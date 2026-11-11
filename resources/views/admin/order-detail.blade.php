@extends('admin.layout')

@section('title', 'Order ' . $order->order_number)

@php
    $currency = config('commerce.currency', 'AED');
    $deliveryLabel = config('commerce.delivery_methods.' . $order->delivery_method, ucfirst(str_replace('_', ' ', (string) $order->delivery_method)));
    $isPickup = $order->delivery_method === 'click_collect';
    $address = trim(implode(', ', array_filter([
        $order->shipping_address,
        $order->area,
        $order->emirate,
    ])));
@endphp

@section('content')
<div class="max-w-6xl">
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <div>
            <a class="font-body-sm text-body-sm underline text-on-surface-variant hover:text-primary" href="{{ route('admin.orders') }}">&larr; All orders</a>
            <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase mt-1">{{ $order->order_number }}</h1>
            <p class="font-body-sm text-body-sm text-outline mt-1">
                Placed {{ ($order->placed_at ?? $order->created_at)?->format('d M Y, h:i A') }}
                · {{ $order->items->sum('quantity') }} item{{ $order->items->sum('quantity') === 1 ? '' : 's' }}
            </p>
        </div>
        <span class="font-label-caps text-label-caps uppercase tracking-wider px-3 py-2 bg-primary text-on-primary font-bold">{{ $order->status_label }}</span>
    </div>

    @if (session('status_saved'))
        <div class="bg-[#1b6b45] text-white px-4 py-3 mb-6 font-body-sm" role="status">Order status updated.</div>
    @endif

    {{-- Status form --}}
    <section class="bg-surface-container-lowest border border-outline-variant p-4 md:p-5 mb-6">
        <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">Update status</h2>
        <form class="space-y-3" method="POST" action="{{ route('admin.orders.status', $order) }}">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3">
                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Fulfilment</span>
                    <select class="w-full h-11 px-3 bg-surface-container-low border border-outline font-body-sm text-body-sm focus:border-primary focus:outline-none" name="status">
                        @foreach (['pending', 'processing', 'shipped', 'out_for_delivery', 'delivered', 'cancelled', 'refunded'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $order->status) === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('ui.payment') }}</span>
                    <select class="w-full h-11 px-3 bg-surface-container-low border border-outline font-body-sm text-body-sm focus:border-primary focus:outline-none" name="payment_status">
                        @foreach (['pending', 'paid', 'failed', 'refunded'] as $status)
                            <option value="{{ $status }}" @selected(old('payment_status', $order->payment_status) === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </label>

                <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 h-11 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all self-end" type="submit">
                    Update
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Cancellation reason</span>
                    <input class="w-full h-11 px-3 bg-surface-container-low border border-outline font-body-sm text-body-sm focus:border-primary focus:outline-none" name="cancel_reason" value="{{ old('cancel_reason', $order->cancel_reason) }}" maxlength="500" placeholder="Required context for cancellations">
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Refund amount (AED)</span>
                    <input class="w-full h-11 px-3 bg-surface-container-low border border-outline font-body-sm text-body-sm focus:border-primary focus:outline-none" name="refund_amount" type="number" min="0" max="{{ $order->total }}" step="0.01" value="{{ old('refund_amount') }}" placeholder="Defaults to order total">
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Refund reference</span>
                    <input class="w-full h-11 px-3 bg-surface-container-low border border-outline font-body-sm text-body-sm focus:border-primary focus:outline-none" name="refund_reference" value="{{ old('refund_reference', $order->refund_reference) }}" maxlength="190" placeholder="Gateway / bank reference">
                </label>
            </div>
        </form>

        @error('status')
            <p class="font-body-sm text-body-sm text-error mt-3" role="alert">{{ $message }}</p>
        @enderror

        <p class="font-body-sm text-body-sm text-outline mt-3">
            Cancelling or refunding restores stock automatically — once per order. Refunds also force the payment status to <strong>Refunded</strong>.
        </p>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- Items + delivery --}}
        <div class="lg:col-span-2 space-y-6">
            <section class="bg-surface-container-lowest border border-outline-variant">
                <header class="px-4 md:px-5 py-4 border-b border-outline-variant flex items-center justify-between gap-3">
                    <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">Items</h2>
                    <span class="font-body-sm text-body-sm text-outline">{{ $order->items->count() }} line{{ $order->items->count() === 1 ? '' : 's' }}</span>
                </header>
                <div class="divide-y divide-outline-variant/60">
                    @forelse ($order->items as $item)
                        <div class="p-4 md:p-5 flex items-center gap-3 md:gap-4">
                            <img alt="{{ $item->product_name }}" class="w-14 h-14 shrink-0 object-contain bg-surface-container-low border border-outline-variant p-1"
                                 src="{{ media_url($item->image_path) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                            <div class="flex-1 min-w-0">
                                <p class="font-title-md text-body-md font-bold text-primary truncate">{{ $item->product_name }}</p>
                                <p class="font-body-sm text-body-sm text-outline">
                                    {{ $item->brand_name }}
                                    @if ($item->shade_name) · {{ $item->shade_name }} @endif
                                    · Qty {{ $item->quantity }}
                                </p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $currency }} {{ number_format($item->unit_price, 2) }} each</p>
                            </div>
                            <span class="font-price-aed-md text-price-aed-md font-bold text-primary whitespace-nowrap">{{ $currency }} {{ number_format($item->line_total, 2) }}</span>
                        </div>
                    @empty
                        <p class="p-6 font-body-sm text-body-sm text-outline">No items recorded for this order.</p>
                    @endforelse
                </div>
            </section>

            <section class="bg-surface-container-lowest border border-outline-variant p-4 md:p-5 space-y-4">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">{{ $isPickup ? 'Collection' : 'Delivery' }}</h2>

                <div class="flex justify-between gap-4 font-body-sm text-body-sm">
                    <span class="text-on-surface-variant">{{ __('ui.method') }}</span>
                    <span class="text-primary font-semibold text-right">{{ $deliveryLabel }}</span>
                </div>

                @if ($isPickup && $order->store)
                    <div class="border-t border-outline-variant/60 pt-3">
                        <p class="font-body-md text-body-md text-primary font-semibold">{{ $order->store->name }}</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $order->store->address }}, {{ $order->store->city }}</p>
                        @if ($order->store->phone)
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Phone: {{ $order->store->phone }}</p>
                        @endif
                    </div>
                @else
                    <div class="border-t border-outline-variant/60 pt-3 space-y-1">
                        <p class="font-body-md text-body-md text-primary font-semibold">{{ $order->customer_name }}</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $address ?: 'No address supplied' }}</p>
                        @if ($order->building)
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Building: {{ $order->building }}</p>
                        @endif
                        @if ($order->delivery_instructions)
                            <p class="font-body-sm text-body-sm text-outline mt-2">Notes: {{ $order->delivery_instructions }}</p>
                        @endif
                    </div>
                @endif

                @if ($order->tracking_number)
                    <div class="border-t border-outline-variant/60 pt-3 font-body-sm text-body-sm">
                        Tracking number: <strong class="text-primary">{{ $order->tracking_number }}</strong>
                    </div>
                @endif
            </section>

            @if ($order->gift_box || $order->gift_message || ! empty($order->samples))
                <section class="bg-surface-container-lowest border border-outline-variant p-4 md:p-5 space-y-2">
                    <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">Gift &amp; extras</h2>
                    @if ($order->gift_box)
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Signature gift box requested.</p>
                    @endif
                    @if ($order->gift_message)
                        <p class="font-body-sm text-body-sm text-on-surface-variant italic">“{{ $order->gift_message }}”</p>
                    @endif
                    @if (! empty($order->samples))
                        <p class="font-body-sm text-body-sm text-on-surface-variant">{{ count($order->samples) }} complimentary sample{{ count($order->samples) === 1 ? '' : 's' }}.</p>
                    @endif
                </section>
            @endif
        </div>

        {{-- Customer + totals --}}
        <aside class="space-y-6">
            <section class="bg-surface-container-lowest border border-outline-variant p-4 md:p-5 font-body-sm text-body-sm">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">Customer</h2>
                <p class="font-body-md text-body-md text-primary font-semibold">{{ $order->customer_name }}</p>
                @if ($order->customer_phone)
                    <p class="text-on-surface-variant mt-1"><a class="hover:underline" href="tel:{{ $order->customer_phone }}">{{ $order->customer_phone }}</a></p>
                @endif
                @if ($order->customer_email)
                    <p class="text-on-surface-variant"><a class="hover:underline break-all" href="mailto:{{ $order->customer_email }}">{{ $order->customer_email }}</a></p>
                @endif
                <p class="mt-3 text-outline">Account: {{ $order->user_id ? 'Registered customer' : 'Guest checkout' }}</p>
            </section>

            <section class="bg-surface-container-lowest border border-outline-variant p-4 md:p-5 font-body-sm text-body-sm space-y-2.5">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-1">Payment &amp; totals</h2>

                <div class="flex justify-between gap-3">
                    <span class="text-on-surface-variant">{{ __('ui.method') }}</span>
                    <span class="text-primary font-semibold text-right">{{ $order->payment_method_label }}</span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="text-on-surface-variant">{{ __('ui.status') }}</span>
                    <span class="text-primary font-semibold uppercase text-right">{{ $order->payment_status }}</span>
                </div>
                @if ($order->coupon_code)
                    <div class="flex justify-between gap-3">
                        <span class="text-on-surface-variant">Coupon</span>
                        <span class="text-primary font-semibold uppercase text-right">{{ $order->coupon_code }}</span>
                    </div>
                @endif

                <div class="border-t border-outline-variant/60 pt-3 space-y-2">
                    <div class="flex justify-between gap-3">
                        <span class="text-on-surface-variant">{{ __('ui.subtotal') }}</span>
                        <span>{{ $currency }} {{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if ($order->discount > 0)
                        <div class="flex justify-between gap-3 text-secondary">
                            <span>{{ __('ui.discount') }}</span>
                            <span>−{{ $currency }} {{ number_format($order->discount, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between gap-3">
                        <span class="text-on-surface-variant">{{ $isPickup ? 'Pick-up' : 'Delivery' }}</span>
                        <span>{{ $order->shipping_fee <= 0 ? 'FREE' : $currency . ' ' . number_format($order->shipping_fee, 2) }}</span>
                    </div>
                    @if ($order->tax_amount > 0)
                        <div class="flex justify-between gap-3">
                            <span class="text-on-surface-variant">VAT ({{ rtrim(rtrim(number_format($order->tax_rate, 2), '0'), '.') }}%)</span>
                            <span>{{ $currency }} {{ number_format($order->tax_amount, 2) }}</span>
                        </div>
                    @endif
                </div>

                <div class="flex justify-between gap-3 border-t border-primary pt-3 font-title-md text-title-md font-bold text-primary">
                    <span>{{ __('ui.total') }}</span>
                    <span>{{ $currency }} {{ number_format($order->total, 2) }}</span>
                </div>

                @if ($order->refund_amount > 0)
                    <p class="text-secondary">Refunded: {{ $currency }} {{ number_format($order->refund_amount, 2) }}@if ($order->refund_reference) · Ref {{ $order->refund_reference }}@endif</p>
                @endif
                @if ($order->cancel_reason)
                    <p class="text-on-surface-variant">Cancellation reason: {{ $order->cancel_reason }}</p>
                @endif
            </section>
        </aside>
    </div>
</div>
@endsection
