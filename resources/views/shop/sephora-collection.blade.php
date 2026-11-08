@extends('layouts.app')

@section('title', 'SEPHORA COLLECTION - Makeup, Skincare & Fragrance | Sephora UAE')
@section('body_class', 'min-h-screen flex flex-col bg-white text-gray-900')

@section('content')
<main class="flex-1 max-w-[1440px] w-full mx-auto px-4 lg:px-8 py-5">
<!-- Breadcrumbs -->
<nav aria-label="Breadcrumb" class="mb-4">
<ol class="flex items-center space-x-2 text-xs text-neutral-500">
<li>
<a class="hover:underline hover:text-black" href="/">Home</a>
</li>
<li class="text-neutral-400">/</li>
<li class="font-bold text-neutral-900 tracking-wider">SEPHORA COLLECTION</li>
</ol>
</nav>
<!-- Page Title & Brand Story -->
<div class="mb-8">
<h1 class="text-2xl md:text-3xl font-black tracking-tight uppercase text-neutral-950 mb-2">
        SEPHORA COLLECTION
      </h1>
<p class="text-xs md:text-sm text-neutral-700 max-w-4xl leading-relaxed">
        An inspiring brand, in constant progress; discover our thousands of products, colors, effects and finishes. Feel free to wear what you love and express your unique style with high performance beauty formulas created for everyone...
        <button class="font-bold underline text-black hover:opacity-80 uppercase ml-1 text-xs">READ MORE</button>
</p>
</div>
<!-- Filter Bar Header: Count & Sort Dropdown -->
<div class="flex items-center justify-between border-b border-subtle pb-3 mb-6">
<span class="text-xs sm:text-sm font-semibold text-neutral-700">
        {{ $products->count() }} items
      </span>
<div class="flex items-center gap-2">
<label class="text-xs font-medium text-neutral-600" for="sort-select">Sort by:</label>
<div class="relative">
<select class="text-xs font-bold text-neutral-900 border-none bg-transparent pr-6 py-0 focus:ring-0 cursor-pointer" id="sort-select">
<option>Recommended</option>
<option>New Arrivals</option>
<option>Price: Low to High</option>
<option>Price: High to Low</option>
<option>Customer Rating</option>
</select>
</div>
</div>
</div>
<!-- Main Two-Column Layout: Sidebar & Products Grid -->
<div class="grid grid-cols-1 lg:grid-cols-4 xl:grid-cols-5 gap-8 items-start">
<!-- BEGIN: LeftFilterSidebar -->
<aside class="hidden lg:block lg:col-span-1 border-r border-subtle pr-6 space-y-6 text-xs">
<!-- Category Hierarchy Facets -->
<div>
<h2 class="text-xs font-bold uppercase tracking-wider text-black mb-3">Categories</h2>
<ul class="space-y-2.5 font-medium text-neutral-700">
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>The Holiday Collection</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(19)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>New</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(40)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Makeup</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(234)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Fragrance</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(3)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Skincare</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(129)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Bath &amp; Body</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(28)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Hair</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(35)</span>
</a>
</li>
<!-- Active Filter -->
<li class="bg-neutral-100 -mx-2 px-2 py-1 rounded">
<a class="flex justify-between items-center font-bold text-black" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Sephora Collection</span>
<span class="text-black">(376)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Best Sellers</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(28)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Gifts</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(40)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Beauty Finds</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(10)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>Great Hair Starts Here</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(1)</span>
</a>
</li>
</ul>
</div>
<hr class="border-subtle"/>
<!-- Refine Accordion Filter Groups -->
<div class="space-y-4">
<h3 class="text-xs font-bold uppercase tracking-wider text-black">Refine</h3>
<!-- Exclusivity Toggle -->
<div class="flex items-center justify-between py-1">
<span class="text-neutral-800 font-medium">Sephora Exclusive Only</span>
<label class="relative inline-flex items-center cursor-pointer">
<input class="sr-only peer" type="checkbox" value=""/>
<div class="w-8 h-4 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-black"></div>
</label>
</div>
<!-- Filter Accordion Item 1 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>Type of product</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
<!-- Filter Accordion Item 2 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>Shades &amp; Tones</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
<!-- Filter Accordion Item 3 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>Coverage</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
<!-- Filter Accordion Item 4 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>Price</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
<!-- Filter Accordion Item 5 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>Benefits</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
</div>
</aside>
<!-- END: LeftFilterSidebar -->
<!-- BEGIN: ProductGrid -->
<section aria-label="Product Catalog" class="lg:col-span-3 xl:col-span-4">
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
<!-- Card 1: Brand Feature Hero Card -->
<article class="col-span-2 md:col-span-1 bg-[#1e1e1e] text-white rounded-none flex flex-col justify-between overflow-hidden relative group shadow-sm">
<div class="relative w-full aspect-square overflow-hidden bg-neutral-800">
<!-- ONLY AT SEPHORA BADGE -->
<div class="absolute top-3 left-3 z-10">
<span class="inline-flex items-center justify-center bg-black/80 text-white rounded-full p-1.5 border border-white/40 shadow">
<span class="text-[9px] font-black uppercase tracking-tight text-center leading-tight px-1">
                    ONLY AT<br/>SEPHORA
                  </span>
</span>
</div>
<img alt="Sephora Cheek Brush applying powder" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_991d73ffa07c4484.jpg') }}"/>
</div>
<div class="p-4 sm:p-5 flex flex-col flex-1 justify-between bg-[#232323]">
<div>
<h3 class="font-bold text-sm sm:text-base uppercase tracking-wide mb-1 text-white">The Cheek Brush</h3>
<p class="text-xs text-neutral-300 font-light leading-relaxed mb-4">
                  Sculpt, contour and add warmth with ultra-soft vegan bristles.
                </p>
</div>
<a class="inline-block text-center w-full py-2.5 bg-white text-black text-xs font-bold tracking-wider uppercase hover:bg-neutral-200 transition-colors" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
                DISCOVER NOW
              </a>
</div>
</article>
<!-- Products Loop -->
@foreach($products as $product)
<article class="product-card group flex flex-col justify-between border border-gray-200 hover:border-black p-2.5 sm:p-3 transition-all relative">
<div>
<!-- Image & Badges Container -->
<div class="relative aspect-square bg-[#fbfbfb] mb-3 overflow-hidden flex items-center justify-center">
<!-- Badge -->
@if($product->badge)
<span class="absolute top-2 left-2 z-10 bg-black text-white text-[10px] font-bold px-2 py-0.5 uppercase tracking-wide">
  {{ $product->badge }}
</span>
@elseif($product->is_new)
<span class="absolute top-2 left-2 z-10 bg-black text-white text-[10px] font-bold px-2 py-0.5 uppercase tracking-wide">
  New
</span>
@endif
<!-- Wishlist Heart -->
<button type="button" class="absolute top-2 right-2 z-10 text-neutral-400 hover:text-black transition-colors p-1" data-wishlist-toggle="{{ $product->id }}" title="Save to Wishlist">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
</button>
<a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="w-full h-full flex items-center justify-center p-3">
  <img alt="{{ $product->name }}" class="product-img object-contain w-full h-full transition-transform duration-300 group-hover:scale-105" src="{{ media_url($product->first_image) }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
</a>
</div>
<!-- Product Info -->
<div class="space-y-1">
<span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-neutral-900 block truncate">SEPHORA COLLECTION</span>
<h3 class="text-xs font-medium text-neutral-800 line-clamp-2 hover:underline">
  <a href="{{ route('product.show', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
</h3>
<!-- Ratings -->
<div class="flex items-center gap-1.5 pt-1">
  @include('components.stars', ['rating' => (float) $product->rating])
  <span class="text-[11px] text-neutral-500 font-medium">{{ number_format((float) $product->rating, 1) }} ({{ number_format((int) $product->reviews_count) }})</span>
</div>
<!-- Price -->
<div class="pt-1.5">
<span class="text-xs sm:text-sm font-bold text-neutral-900">AED {{ number_format($product->price, 2) }}</span>
</div>
</div>
</div>
<!-- Action Button -->
<button type="button" class="quick-add-btn mt-3 w-full bg-black text-white text-[11px] sm:text-xs font-bold py-2 sm:py-2.5 uppercase tracking-wider hover:bg-neutral-800 transition-colors" data-add-to-bag="{{ $product->id }}">
  ADD TO BAG
</button>
</article>
@endforeach
</div>
<!-- Pagination & Load More Section -->
<div class="mt-12 text-center flex flex-col items-center">
<p class="text-xs text-neutral-600 font-medium mb-3">Showing {{ $products->count() }} items</p>
</div>
</section>
<!-- END: ProductGrid -->
</div>
</main>
@endsection
