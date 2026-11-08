@extends('layouts.app')

@section('title', 'My Wishlist ≡ SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-4 sm:py-6">

    <!-- Breadcrumb -->
    <nav class="text-xs text-neutral-500 mb-4" aria-label="Breadcrumb">
        <a class="hover:text-black transition-colors" href="/">Home</a>
        <span class="mx-1.5">&rsaquo;</span>
        <a class="hover:text-black transition-colors" href="/my-account">My Account</a>
        <span class="mx-1.5">&rsaquo;</span>
        <span class="text-black font-semibold">Wishlist</span>
    </nav>

    @include('partials.account-nav', ['active' => 'wishlist'])

    <div class="flex items-baseline justify-between border-b-2 border-black pb-3 mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-black uppercase tracking-tight">My Wishlist</h1>
            <p class="text-xs text-neutral-500 mt-0.5">{{ $products->count() }} saved {{ Str::plural('item', $products->count()) }}</p>
        </div>
        <a class="text-xs font-bold text-black uppercase underline hover:text-neutral-600 transition-colors" href="/shop/bestsellers">
            Discover Bestsellers &rarr;
        </a>
    </div>

    @if ($products->isEmpty())
        <div class="text-center py-20 border border-gray-200 rounded-sm bg-white space-y-4">
            <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold uppercase tracking-tight text-black">Nothing saved yet</h2>
            <p class="text-xs text-neutral-500 max-w-sm mx-auto">Tap the heart on any luxury cosmetic or fragrance to save it here for later.</p>
            <div class="pt-2">
                <a class="inline-block bg-black text-white text-xs font-bold uppercase tracking-wider px-8 py-3 rounded-sm hover:bg-neutral-800 transition-colors" href="/shop/bestsellers">
                    EXPLORE BEST SELLERS &rarr;
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-5">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    @endif

</main>
@endsection
