@extends('layouts.app')

@section('title', 'Search: ' . $query . ' ≡ SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-4 sm:py-6">

    <!-- Breadcrumb -->
    <nav class="text-xs text-neutral-500 mb-4" aria-label="Breadcrumb">
        <a class="hover:text-black transition-colors" href="/">Home</a>
        <span class="mx-1.5">&rsaquo;</span>
        <span class="text-black font-semibold">Search</span>
    </nav>

    <div class="flex items-baseline justify-between border-b-2 border-black pb-3 mb-6">
        <div>
            <span class="text-[11px] font-bold uppercase tracking-widest text-neutral-500 block">Search Results</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">
                {{ $products->count() }} {{ Str::plural('result', $products->count()) }} for &ldquo;{{ $query }}&rdquo;
            </h1>
        </div>
        <a class="text-xs font-bold text-black uppercase underline hover:text-neutral-600 transition-colors" href="/">
            Back to Home &rarr;
        </a>
    </div>

    @if ($products->isEmpty())
        <div class="text-center py-20 border border-gray-200 rounded-sm bg-white space-y-4">
            <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold uppercase tracking-tight text-black">No products found</h2>
            <p class="text-xs text-neutral-500 max-w-sm mx-auto">Try checking your spelling, using more general terms, or browse by category.</p>
            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a class="text-xs font-bold uppercase tracking-wider px-4 py-2 border border-black hover:bg-black hover:text-white transition-colors" href="/shop/makeup">Makeup</a>
                <a class="text-xs font-bold uppercase tracking-wider px-4 py-2 border border-black hover:bg-black hover:text-white transition-colors" href="/shop/fragrance">Fragrance</a>
                <a class="text-xs font-bold uppercase tracking-wider px-4 py-2 border border-black hover:bg-black hover:text-white transition-colors" href="/shop/skincare">Skincare</a>
                <a class="text-xs font-bold uppercase tracking-wider px-4 py-2 border border-black hover:bg-black hover:text-white transition-colors" href="/shop/gifts">Holiday Sets</a>
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
