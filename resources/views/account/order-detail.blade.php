@extends('layouts.app')
@section('title', __('messages.account.order_number') . ' ' . $order->order_number . ' | ' . __('messages.app_name'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')
@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<nav class="text-body-sm font-body-sm text-outline mb-4">
    <a class="hover:text-secondary" href="/">{{ __('messages.home') }}</a> /
    <a class="hover:text-secondary" href="/my-account">{{ __('messages.account.my_account') }}</a> /
    <a class="hover:text-secondary" href="{{ route('account.orders') }}">{{ __('messages.account.orders') }}</a> /
    <span class="text-on-surface font-semibold">{{ $order->order_number }}</span>
</nav>

<div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-primary pb-4 mb-8 gap-3">
    <div>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ __('messages.account.order_number') }} {{ $order->order_number }}</h1>
        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('messages.confirmation.placed_on') }} {{ $order->placed_at?->format('d F Y, h:i A') }}</p>
    </div>
    <div class="flex flex-wrap items-center gap-2 self-start sm:self-auto">
        <a href="{{ route('account.orders.invoice', $order->order_number) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 border border-primary text-primary text-label-tag font-label-tag uppercase tracking-wider hover:bg-primary hover:text-white transition-all">
            <span class="material-symbols-outlined text-[16px]">receipt_long</span>
            {{ __('messages.account.tax_invoice') }}
        </a>
        <span class="font-label-tag text-label-tag uppercase px-3 py-1.5 font-bold {{ $order->status === 'delivered' ? 'bg-[#1b6b45] text-white' : ($order->status === 'cancelled' ? 'bg-error text-on-error' : 'bg-primary text-on-primary') }}">{{ $order->status_label }}</span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-4">
        @foreach($order->items as $item)
        <article class="bg-surface-container-lowest card-border p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3 sm:gap-4 min-w-0 flex-1">
                <img alt="{{ $item->product_name }}" class="w-16 h-16 sm:w-20 sm:h-20 shrink-0 object-contain bg-surface-container-low" src="{{ media_url($item->image_path) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
                <div class="flex-1 min-w-0">
                    <span class="font-label-caps text-label-caps uppercase text-outline font-bold truncate block">{{ $item->brand_name }}</span>
                    <p class="font-title-md text-title-md text-primary leading-tight line-clamp-2">{{ $item->product_name }}</p>
                    <p class="font-body-sm text-body-sm text-outline mt-1">{{ __('messages.confirmation.qty') }} {{ $item->quantity }} &times; {{ __('messages.aed') }} {{ number_format($item->unit_price, 2) }}</p>
                </div>
            </div>
            <span class="font-price-aed-md text-price-aed-md font-bold text-primary self-end sm:self-center shrink-0">{{ __('messages.aed') }} {{ number_format($item->line_total, 2) }}</span>
        </article>
        @endforeach
    </div>

    <aside class="space-y-6">
        @if ($order->tracking_number)
        <div class="bg-surface-container-lowest card-border p-6 border-l-4 border-l-primary">
            <h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">local_shipping</span>
                {{ __('messages.account.tracking') }}
            </h2>
            <div class="space-y-1 font-body-sm text-body-sm text-on-surface-variant">
                @if ($order->courier_label)
                    <p>{{ __('messages.account.courier') }}: <strong>{{ $order->courier_label }}</strong></p>
                @endif
                <p>{{ __('messages.account.tracking_number') }}: <strong class="font-mono">{{ $order->tracking_number }}</strong></p>
            </div>
            @if ($order->tracking_url)
                <a href="{{ $order->tracking_url }}" target="_blank" rel="noopener" class="mt-4 inline-flex items-center justify-center w-full h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-white hover:text-primary transition-all">
                    {{ __('messages.account.track_parcel') }} →
                </a>
            @endif
        </div>
        @endif

        <div class="bg-surface-container-lowest card-border p-6">
            <h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-4">{{ __('messages.checkout.order_summary') }}</h2>
            <dl class="space-y-2 font-body-md text-body-md text-on-surface-variant">
                <div class="flex justify-between"><dt>{{ __('messages.subtotal') }}</dt><dd>{{ __('messages.aed') }} {{ number_format($order->subtotal, 2) }}</dd></div>
                <div class="flex justify-between"><dt>{{ __('messages.delivery') }}</dt><dd>{{ $order->shipping_fee == 0 ? __('messages.checkout.free') : __('messages.aed') . ' ' . number_format($order->shipping_fee, 2) }}</dd></div>
                @if($order->discount > 0)<div class="flex justify-between text-secondary"><dt>{{ __('messages.discount') }}</dt><dd>-{{ __('messages.aed') }} {{ number_format($order->discount, 2) }}</dd></div>@endif
                <div class="flex justify-between border-t border-primary pt-2 text-primary font-bold"><dt>{{ __('messages.total') }}</dt><dd>{{ __('messages.aed') }} {{ number_format($order->total, 2) }}</dd></div>
            </dl>
        </div>

        <div class="bg-surface-container-lowest card-border p-6">
            <h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-4">{{ __('messages.checkout.delivery_address') }}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                {{ $order->customer_name }}<br/>
                {{ $order->shipping_address }}<br/>
                {{ $order->area }} {{ $order->emirate }}<br/>
                {{ $order->customer_phone }}
            </p>
        </div>
    </aside>
</div>

</main>
@endsection
