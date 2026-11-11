@extends('layouts.app')

@section('title', __('messages.account.title'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@php
    $currency = config('commerce.currency', 'AED');
    $initial = Str::upper(Str::substr($user->name, 0, 1));
@endphp

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">{{ __('messages.home') }}</a> /
        <span class="text-on-surface font-semibold">{{ __('messages.account.my_account') }}</span>
    </nav>

    {{-- Account sub-navigation --}}
    @include('partials.account-nav', ['active' => 'dashboard'])

    @if (session('verified'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">{{ __('messages.account.verified_notice') }}</div>
    @endif
    @if (session('settings_saved'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">{{ __('messages.account.settings_saved_notice') }}</div>
    @endif
    @if (session('address_saved'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">{{ __('messages.account.address_saved_notice') }}</div>
    @endif

    @unless ($user->hasVerifiedEmail())
        <div class="border border-outline bg-surface-container-low px-4 py-3 mb-6 font-body-sm text-body-sm flex flex-wrap items-center justify-between gap-2">
            <span>{{ __('messages.account.unverified_notice') }}</span>
            <a class="underline text-primary font-semibold" href="{{ route('verification.notice') }}">{{ __('messages.account.verify_email_link') }}</a>
        </div>
    @endunless

    {{-- Welcome --}}
    <section class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 mb-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <span class="w-14 h-14 rounded-full bg-primary text-on-primary flex items-center justify-center font-headline-sm text-headline-sm font-bold" aria-hidden="true">{{ $initial }}</span>
                <div>
                    <p class="font-label-caps text-label-caps uppercase tracking-widest text-outline">{{ __('messages.account.welcome_back') }}</p>
                    <h1 class="font-headline-md text-headline-md font-bold text-primary">{{ $user->name }}</h1>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $user->email }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="font-label-caps text-label-caps uppercase tracking-widest text-outline">{{ __('messages.account.my_sephora') }}</p>
                <p class="font-title-lg text-title-lg font-bold text-primary">{{ $user->loyalty_tier ? ucfirst($user->loyalty_tier) : 'Member' }}</p>
                <p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('messages.account.points', ['count' => number_format((int) $user->loyalty_points)]) }}</p>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-8">
        <a class="border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.orders') }}">
            <span class="material-symbols-outlined text-outline text-[22px]">receipt_long</span>
            <p class="font-price-aed-lg text-price-aed-lg font-bold text-primary mt-2">{{ number_format($stats['orders']) }}</p>
            <p class="font-label-caps text-label-caps uppercase text-outline mt-1">{{ __('messages.account.orders') }}</p>
        </a>
        <a class="border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.wishlist') }}">
            <span class="material-symbols-outlined text-outline text-[22px]">favorite</span>
            <p class="font-price-aed-lg text-price-aed-lg font-bold text-primary mt-2">{{ number_format($stats['wishlist']) }}</p>
            <p class="font-label-caps text-label-caps uppercase text-outline mt-1">{{ __('messages.account.saved_items') }}</p>
        </a>
        <a class="border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.addresses') }}">
            <span class="material-symbols-outlined text-outline text-[22px]">home_pin</span>
            <p class="font-price-aed-lg text-price-aed-lg font-bold text-primary mt-2">{{ number_format($stats['addresses']) }}</p>
            <p class="font-label-caps text-label-caps uppercase text-outline mt-1">{{ __('messages.account.addresses') }}</p>
        </a>
        <a class="border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.contact') }}">
            <span class="material-symbols-outlined text-outline text-[22px]">support_agent</span>
            <p class="font-price-aed-lg text-price-aed-lg font-bold text-primary mt-2">24h</p>
            <p class="font-label-caps text-label-caps uppercase text-outline mt-1">{{ __('messages.account.concierge_reply') }}</p>
        </a>
    </section>

    {{-- Recent orders --}}
    <section class="border border-outline-variant bg-surface-container-lowest mb-8">
        <header class="flex flex-wrap items-center justify-between gap-2 px-5 py-4 border-b border-outline-variant">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">{{ __('messages.account.recent_orders') }}</h2>
            <a class="font-body-sm text-body-sm underline text-primary hover:text-secondary" href="{{ route('account.orders') }}">{{ __('messages.account.view_all_orders') }}</a>
        </header>

        @if ($orders->isEmpty())
            <div class="px-5 py-14 text-center">
                <span class="material-symbols-outlined text-[40px] text-outline-variant">receipt_long</span>
                <p class="font-body-md text-body-md text-primary mt-2">{{ __('messages.account.no_orders_placed') }}</p>
                <a class="inline-block mt-4 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-8 py-3 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" href="/shop/bestsellers">{{ __('messages.account.start_shopping') }}</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left font-body-sm text-body-sm min-w-[640px]">
                    <thead class="bg-surface-container text-on-surface-variant font-label-caps text-label-caps uppercase">
                        <tr>
                            <th class="px-5 py-3">{{ __('messages.account.order_number') }}</th>
                            <th class="px-5 py-3">{{ __('messages.account.date') }}</th>
                            <th class="px-5 py-3">{{ __('messages.account.status') }}</th>
                            <th class="px-5 py-3">{{ __('messages.total') }}</th>
                            <th class="px-5 py-3 text-right">{{ __('messages.account.view_details') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-t border-outline-variant">
                                <td class="px-5 py-3 font-semibold text-primary whitespace-nowrap">{{ $order->order_number }}</td>
                                <td class="px-5 py-3 whitespace-nowrap">{{ $order->placed_at?->format('d M Y') ?? $order->created_at?->format('d M Y') }}</td>
                                <td class="px-5 py-3">
                                    <span class="font-label-tag text-label-tag uppercase px-2 py-0.5 font-bold {{ $order->status === 'delivered' ? 'bg-[#1b6b45] text-white' : ($order->status === 'cancelled' ? 'bg-error text-on-error' : 'bg-primary text-on-primary') }}">{{ $order->status_label }}</span>
                                </td>
                                <td class="px-5 py-3 font-bold whitespace-nowrap">{{ $currency }} {{ number_format($order->total, 2) }}</td>
                                <td class="px-5 py-3 text-right">
                                    <a class="underline text-primary hover:text-secondary whitespace-nowrap" href="{{ route('account.orders.show', $order->order_number) }}">{{ __('messages.account.view_order') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    {{-- Account shortcuts --}}
    <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a class="border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.settings') }}">
            <h2 class="font-title-md text-title-md text-primary uppercase tracking-wider">{{ __('ui.settings') }}</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_1cc2c71e48e0') }}</p>
        </a>
        <a class="border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.country-language') }}">
            <h2 class="font-title-md text-title-md text-primary uppercase tracking-wider">{{ __('ui.country_language') }}</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_095793ecb2e4') }}</p>
        </a>
        <a class="border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.contact') }}">
            <h2 class="font-title-md text-title-md text-primary uppercase tracking-wider">{{ __('content.t_9bf5aa98f550') }}</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_3e9fd39ceee4') }}</p>
        </a>
    </section>
</main>
@endsection
