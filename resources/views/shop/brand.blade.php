@extends('layouts.app')

@section('title', $brand->name . ' ≡ SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-4 sm:py-6">

    <!-- Breadcrumb -->
    <nav class="text-xs text-neutral-500 mb-4" aria-label="Breadcrumb">
        <a class="hover:text-black transition-colors" href="/">Home</a>
        <span class="mx-1.5">&rsaquo;</span>
        <a class="hover:text-black transition-colors" href="/brands">Brands</a>
        <span class="mx-1.5">&rsaquo;</span>
        <span class="text-black font-semibold">{{ $brand->name }}</span>
    </nav>

    <!-- Brand Header -->
    <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-2 border-b-2 border-black pb-3 mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-black uppercase tracking-tight">
                {{ $brand->name }}
            </h1>
            <p class="text-xs text-neutral-500 mt-0.5">
                {{ $products->count() }} {{ Str::plural('product', $products->count()) }} available
            </p>
        </div>
        <a class="text-xs font-bold text-black uppercase underline hover:text-neutral-600 transition-colors" href="/brands">
            View All Brands &rarr;
        </a>
    </div>

    @if ($products->isEmpty())
        <div class="text-center py-20 border border-gray-200 rounded-sm bg-white space-y-4">
            <h2 class="text-xl font-bold uppercase tracking-tight text-black">Coming Soon</h2>
            <p class="text-xs text-neutral-500 max-w-sm mx-auto">New drops and products from {{ $brand->name }} are arriving shortly.</p>
            <div class="pt-2">
                <a class="inline-block bg-black text-white text-xs font-bold uppercase tracking-wider px-8 py-3 rounded-sm hover:bg-neutral-800 transition-colors" href="/brands">
                    EXPLORE ALL BRANDS &rarr;
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
