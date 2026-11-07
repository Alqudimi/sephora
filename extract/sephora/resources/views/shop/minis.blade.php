@extends('layouts.app')

@section('title', 'Minis & More | Sephora UAE')
@section('body_class', 'bg-white text-neutral-900 font-sans antialiased text-sm')

@section('content')
<main class="max-w-[1380px] mx-auto px-4 sm:px-6 lg:px-8 pb-16">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- BEGIN: LeftSidebarFilters -->
<aside class="lg:col-span-3 space-y-6" data-purpose="filters-sidebar">
<!-- Category Tree Box -->
<div class="border border-neutral-200 p-4 rounded-sm">
<div class="flex items-center justify-between font-bold text-sm text-black cursor-pointer pb-2">
<span>Gifts <span class="font-normal text-neutral-500 text-xs">(772)</span></span>
<svg class="w-4 h-4 text-neutral-700" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M5 15l7-7 7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
<div class="pl-3 pt-2">
<span class="text-xs font-bold text-black cursor-pointer hover:underline">
              Minis &amp; More <span class="font-normal text-neutral-500">(362)</span>
</span>
</div>
</div>
<!-- Refine Section Title -->
<div>
<h2 class="font-bold text-sm uppercase tracking-wide text-black mb-3">Refine</h2>
<div class="border-t border-neutral-200">
<!-- Exclusivity Toggle Item -->
<div class="py-4 border-b border-neutral-200 flex items-center justify-between">
<span class="text-sm font-medium text-black">Exclusivity</span>
<label aria-label="Toggle Exclusivity Filter" class="switch">
<input checked="" type="checkbox"/>
<span class="slider"></span>
</label>
</div>
<!-- Type of Product Accordion -->
<div class="py-4 border-b border-neutral-200 flex items-center justify-between cursor-pointer hover:bg-neutral-50 px-1">
<span class="text-sm font-medium text-black">Type of product</span>
<svg class="w-4 h-4 text-neutral-600" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
<!-- Brands Accordion -->
<div class="py-4 border-b border-neutral-200 flex items-center justify-between cursor-pointer hover:bg-neutral-50 px-1">
<span class="text-sm font-medium text-black">Brands</span>
<svg class="w-4 h-4 text-neutral-600" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
<!-- Shades Accordion -->
<div class="py-4 border-b border-neutral-200 flex items-center justify-between cursor-pointer hover:bg-neutral-50 px-1">
<span class="text-sm font-medium text-black">Shades</span>
<svg class="w-4 h-4 text-neutral-600" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
<!-- Coverage Accordion -->
<div class="py-4 border-b border-neutral-200 flex items-center justify-between cursor-pointer hover:bg-neutral-50 px-1">
<span class="text-sm font-medium text-black">Coverage</span>
<svg class="w-4 h-4 text-neutral-600" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
<!-- Price Accordion -->
<div class="py-4 border-b border-neutral-200 flex items-center justify-between cursor-pointer hover:bg-neutral-50 px-1">
<span class="text-sm font-medium text-black">Price</span>
<svg class="w-4 h-4 text-neutral-600" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
<!-- Benefits Accordion -->
<div class="py-4 border-b border-neutral-200 flex items-center justify-between cursor-pointer hover:bg-neutral-50 px-1">
<span class="text-sm font-medium text-black">Benefits</span>
<svg class="w-4 h-4 text-neutral-600" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
</div>
</div>
</aside>
<!-- END: LeftSidebarFilters -->
<!-- BEGIN: ProductListingSection -->
<section class="lg:col-span-9" data-purpose="product-catalog">
<!-- Header Info & Sort By Bar -->
<div class="mb-6">
<h1 class="text-3xl lg:text-4xl font-black text-black tracking-tight mb-4">Minis &amp; More</h1>
<div class="flex items-center justify-between border-b border-neutral-200 pb-3 text-xs md:text-sm">
<span class="text-neutral-600 font-medium">362 items</span>
<!-- Sort dropdown -->
<div class="relative inline-flex items-center cursor-pointer group">
<span class="font-normal text-neutral-800">Sort by: <strong class="font-bold underline text-black">Recommended</strong></span>
<svg class="w-4 h-4 ml-1 text-black" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
</div>
</div>
<!-- Product Grid (4 columns) -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
<!-- Product Card 1: STARFACE (From Screenshot) -->
@foreach($products as $products)
<article onclick="window.location='/p/{{ $products->slug }}'" class="group relative flex flex-col justify-between border border-neutral-200 bg-white p-3 hover:shadow-md transition-shadow">
<div>
<!-- Image & Wishlist -->
<div class="relative aspect-square w-full bg-white mb-3 overflow-hidden flex items-center justify-center">
<!-- Fallback Styled Card Matching STARFACE artwork -->
<div class="w-full h-full bg-[#fdf9d5] flex items-center justify-between p-2 rounded">
<div class="w-1/2 bg-yellow-400 h-full rounded flex flex-col items-center justify-center p-2 text-center border border-yellow-500 shadow-inner">
<span class="text-2xl">😊</span>
<span class="font-black text-black text-xs tracking-tighter mt-1">STARFACE</span>
<span class="text-[8px] text-neutral-700 leading-none mt-1">star strips</span>
</div>
<div class="w-1/2 h-full flex flex-col justify-around pl-2 items-center">
<span class="text-yellow-500 font-black text-xl">@include('components.stars', ['rating' => $products->rating]) ★ ★</span>
<span class="text-green-500 font-black text-xl">★ ★ ★</span>
<span class="text-purple-600 font-black text-xl">★ ★ ★</span>
</div>
</div>
<button aria-label="Add to Wishlist" class="absolute top-2 right-2 text-neutral-600 hover:text-black p-1 bg-white/80 rounded-full" type="button">
<svg class="w-5 h-5 stroke-[1.5]" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
<!-- Product Details -->
<div class="space-y-1">
<h3 class="text-xs font-black uppercase text-black tracking-wider">STARFACE</h3>
<p class="text-xs text-neutral-800 product-title-clamp font-normal">Star Strips</p>
<div class="flex items-center text-xs text-neutral-600 pt-1">
<div class="flex text-sephora-gold mr-1 text-sm">★★★★<span class="text-neutral-300">★</span></div>
<span class="font-bold text-neutral-900 mr-1">{{ $products->rating }}</span>
<span class="text-neutral-500">({{ number_format($products->reviews_count) }})</span>
</div>
</div>
</div>
<!-- Price & Button -->
<div class="mt-4 pt-2">
<p class="text-sm font-bold text-black mb-3">AED {{ number_format($products->price, 2) }}</p>
<button class="w-full bg-black text-white text-xs font-bold py-2.5 uppercase tracking-wide hover:bg-neutral-800 transition-colors" data-add-to-bag="{{ $products->id }}">
                Add to Bag
              </button>
</div>
</article>
@endforeach
</div>
<!-- Pagination & Load More Section -->
<div class="mt-12 text-center max-w-sm mx-auto space-y-3" data-purpose="pagination-controls">
<p class="text-xs text-neutral-600">Showing 8 of 362 items</p>
<div class="w-full bg-neutral-200 h-1 rounded-full overflow-hidden">
<div class="bg-black h-1 w-[2.2%]"></div>
</div>
<button class="w-full border border-black bg-white text-black py-3 text-xs font-bold tracking-widest uppercase hover:bg-black hover:text-white transition-colors duration-200">
            LOAD MORE PRODUCTS
          </button>
</div>
</section>
<!-- END: ProductListingSection -->
</div>
</main>
@endsection
