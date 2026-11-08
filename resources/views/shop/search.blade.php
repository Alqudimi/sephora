@extends('layouts.app')
@section('title', 'Search | SEPHORA UAE')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<div class="flex items-end justify-between border-b border-primary pb-4 mb-8">
    <div>
        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest block font-bold">Search Results</span>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ $products->count() }} result{{ $products->count() === 1 ? '' : 's' }} for &ldquo;{{ $query }}&rdquo;</h1>
    </div>
    <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary transition-colors" href="/">Back to Home</a>
</div>

@if($products->isEmpty())
<div class="text-center py-24 space-y-6">
    <span class="material-symbols-outlined text-[64px] text-outline-variant" data-icon="search">search</span>
    <h2 class="font-headline-sm text-headline-sm text-primary">No results found</h2>
    <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto">Try different keywords or browse our most-loved categories.</p>
    <div class="flex justify-center gap-3">
        <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary" href="/shop/makeup">Makeup</a>
        <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary" href="/shop/skincare">Skincare</a>
        <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary" href="/shop/fragrance">Fragrance</a>
    </div>
</div>
@else
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
    @foreach($products as $product)
    <article class="bg-surface-container-lowest card-border p-3 sm:p-4 flex flex-col justify-between group relative">
        <div class="relative">
            @if($product->badge)
            <span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase z-10 font-bold">{{ $product->badge }}</span>
            @endif
            <button class="absolute top-0 right-0 z-10 text-on-surface hover:text-secondary p-1" data-wishlist-toggle="{{ $product->id }}" title="Add to Wishlist" type="button">
                <span class="material-symbols-outlined text-[20px]" data-icon="favorite_border">favorite_border</span>
            </button>
            <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="block w-full aspect-square overflow-hidden mb-3 sm:mb-4 bg-surface-container-low flex items-center justify-center">
                <img alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ media_url($product->first_image) }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
            </a>
        </div>
        <div class="flex flex-col flex-1">
            <span class="font-label-caps text-label-caps uppercase text-outline tracking-wider font-bold mb-1 truncate">{{ $product->brand?->name }}</span>
            <h3 class="font-title-md text-[13px] sm:text-[14px] text-primary line-clamp-2 leading-tight mb-2">
                <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="hover:underline">{{ $product->name }}</a>
            </h3>
            <div class="flex items-center gap-1.5 mb-3">
                @include('components.stars-m3', ['rating' => $product->rating])
                <span class="text-outline text-[11px] sm:text-[12px] font-body-sm">({{ number_format($product->reviews_count) }})</span>
            </div>
            <div class="mt-auto">
                <p class="font-price-aed-lg text-price-aed-lg font-bold text-primary mb-3 text-sm sm:text-base">AED {{ number_format($product->price, 2) }}</p>
                <button class="w-full h-10 sm:h-11 bg-primary text-on-primary font-label-caps text-[11px] sm:text-label-caps uppercase tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" data-add-to-bag="{{ $product->id }}" type="button">Add to Bag</button>
            </div>
        </div>
    </article>
    @endforeach
</div>
@endif

</main>
@endsection
