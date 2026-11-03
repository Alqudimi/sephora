@extends('layouts.app')
@section('title', 'Brand | SEPHORA UAE')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')
@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<nav class="text-body-sm font-body-sm text-outline mb-4" aria-label="Breadcrumb">
    <a class="hover:text-secondary transition-colors" href="/">Home</a>
    <span class="mx-1.5">/</span>
    <a class="hover:text-secondary transition-colors" href="/brands">Brands</a>
    <span class="mx-1.5">/</span>
    <span class="text-on-surface font-semibold">{{ $brand->name }}</span>
</nav>
<div class="flex items-end justify-between border-b border-primary pb-4 mb-8">
    <div>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ $brand->name }}</h1>
        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ $products->count() }} products available</p>
    </div>
</div>
@if($products->isEmpty())
<div class="text-center py-24">
    <h2 class="font-headline-sm text-headline-sm text-primary mb-3">Coming Soon</h2>
    <p class="font-body-md text-body-md text-on-surface-variant">Products from this brand will be available shortly.</p>
</div>
@else
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($products as $product)
    <article class="bg-surface-container-lowest card-border p-4 flex flex-col justify-between group relative" onclick="window.location='/p/{{ $product->slug }}'">
        <div class="relative">
            @if($product->badge)
            <span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase z-10 font-bold">{{ $product->badge }}</span>
            @endif
            <button class="absolute top-0 right-0 z-10 text-on-surface hover:text-secondary p-1" data-wishlist-toggle="{{ $product->id }}" title="Add to Wishlist" type="button">
                <span class="material-symbols-outlined text-[20px]" data-icon="favorite_border">favorite_border</span>
            </button>
            <div class="w-full aspect-square overflow-hidden mb-4 bg-surface-container-low flex items-center justify-center">
                <img alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset($product->first_image) }}"/>
            </div>
        </div>
        <div class="flex flex-col flex-1">
            <span class="font-label-caps text-label-caps uppercase text-outline tracking-wider font-bold mb-1">{{ $product->brand?->name }}</span>
            <h3 class="font-title-md text-[14px] text-primary line-clamp-2 leading-tight mb-2 group-hover:underline">{{ $product->name }}</h3>
            <div class="flex items-center gap-1.5 mb-3">
                @include('components.stars-m3', ['rating' => $product->rating])
                <span class="text-outline text-[12px] font-body-sm">({{ number_format($product->reviews_count) }})</span>
            </div>
            <div class="mt-auto">
                <p class="font-price-aed-lg text-price-aed-lg font-bold text-primary mb-3">AED {{ number_format($product->price, 2) }}</p>
                <button class="w-full h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" data-add-to-bag="{{ $product->id }}" type="button">Add to Bag</button>
            </div>
        </div>
    </article>
    @endforeach
</div>
@endif

</main>
@endsection
