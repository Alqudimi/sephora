@extends('layouts.app')

@section('title', 'View All Gifts - Gifts | Sephora UAE')
@section('body_class', 'bg-white text-black min-h-screen flex flex-col selection:bg-black selection:text-white')

@section('content')
<main class="flex-grow max-w-[1440px] mx-auto px-6 py-4 w-full">
<!-- Breadcrumb Navigation -->
<nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs text-gray-600 mb-6">
<a class="hover:text-black" href="/">{{ __('ui.home') }}</a>
<span class="text-gray-400">/</span>
<a class="hover:text-black" href="/shop/gifts">{{ __('ui.gifts') }}</a>
<span class="text-gray-400">/</span>
<span class="font-bold text-black border-b border-black pb-0.5">View all gifts</span>
</nav>
<!-- Page Title & Sorting Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-3 border-b border-transparent">
<div>
<h1 class="text-3xl font-extrabold text-black tracking-tight mb-2">View All Gifts</h1>
<p class="text-xs text-gray-500 font-medium">415 items</p>
</div>
<!-- Sort Dropdown Trigger -->
<div class="mt-4 md:mt-0 flex items-center justify-end">
<div class="relative inline-block text-left">
<button class="inline-flex items-center gap-2 text-xs font-semibold text-black hover:text-gray-700 bg-white py-1.5 px-3 border border-transparent rounded hover:border-gray-300 transition-colors" type="button">
<span>Sort by: <strong class="font-bold underline underline-offset-4">{{ __('ui.recommended') }}</strong></span>
<svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
</div>
</div>
<!-- Main Grid Layout (Sidebar Filters + Products Grid) -->
<div class="flex gap-8 items-start">
<!-- BEGIN: FilterSidebar -->
<aside aria-label="Product Filters" class="w-64 shrink-0 hidden md:block">
<!-- Category Nav Box (Selected Group) -->
<div class="border border-gray-200 rounded-sm mb-6 p-4 bg-white">
<div class="flex items-center justify-between pb-3 border-b border-gray-100 font-bold text-sm text-black">
<span>{{ __('ui.gifts') }}<span class="text-gray-400 font-normal text-xs">(772)</span></span>
<svg class="w-4 h-4 text-black cursor-pointer" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M5 15l7-7 7 7" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<ul class="pt-3 space-y-2.5 text-xs">
<li>
<a class="font-bold text-black flex items-center justify-between" href="{{ route('shop.category', ['slug' => 'gifts']) }}">
<span>View All Gifts</span>
<span class="text-gray-400 font-normal">(415)</span>
</a>
</li>
<li>
<a class="text-gray-600 hover:text-black flex items-center justify-between" href="{{ route('shop.category', ['slug' => 'gifts']) }}">
<span>Minis &amp; More</span>
<span class="text-gray-400">(285)</span>
</a>
</li>
<li>
<a class="text-gray-600 hover:text-black flex items-center justify-between" href="{{ route('shop.category', ['slug' => 'gifts']) }}">
<span>Gifts by Price</span>
<span class="text-gray-400">(72)</span>
</a>
</li>
</ul>
</div>
<!-- Facet Heading -->
<h2 class="text-sm font-bold text-black mb-3 uppercase tracking-wider">{{ __('ui.refine') }}</h2>
<!-- Facets Accordion List -->
<div class="divide-y divide-gray-200 border-t border-b border-gray-200">
<!-- Accordion Item: Type of product -->
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="text-xs font-semibold text-black group-hover:text-gray-600">{{ __('ui.product_type') }}</span>
<svg class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
<!-- Accordion Item: Brands -->
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="text-xs font-semibold text-black group-hover:text-gray-600">{{ __('ui.brands') }}</span>
<svg class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
<!-- Accordion Item: Shades -->
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="text-xs font-semibold text-black group-hover:text-gray-600">Shades</span>
<svg class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
<!-- Accordion Item: Coverage -->
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="text-xs font-semibold text-black group-hover:text-gray-600">{{ __('ui.coverage') }}</span>
<svg class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
<!-- Accordion Item: Skin Types -->
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="text-xs font-semibold text-black group-hover:text-gray-600">Skin Types</span>
<svg class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
<!-- Accordion Item: Benefits -->
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="text-xs font-semibold text-black group-hover:text-gray-600">{{ __('ui.benefits') }}</span>
<svg class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
<!-- Accordion Item: Price -->
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="text-xs font-semibold text-black group-hover:text-gray-600">{{ __('ui.price') }}</span>
<svg class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
</div>
</aside>
<!-- END: FilterSidebar -->
<!-- BEGIN: ProductCatalogGrid -->
<section aria-label="{{ __('ui.products') }}" class="flex-1">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-5 gap-y-10">
<!-- Product Card 1: Sol De Janeiro -->
@foreach($products as $products)
<article onclick="window.location='/p/{{ $products->slug }}'" class="product-card group relative flex flex-col justify-between border border-gray-200 bg-white p-3 rounded hover:border-black transition-colors" data-purpose="product-card">
<div>
<!-- Top Badges & Wishlist -->
<div class="flex items-center justify-between mb-2">
<span class="bg-black text-white text-[10px] font-bold px-2 py-0.5 uppercase tracking-wider rounded-xs">{{ __('ui.exclusive') }}</span>
<button aria-label="Add to wishlist" class="text-gray-400 hover:text-black transition-colors">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.6" viewbox="0 0 24 24">
<path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</button>
</div>
<!-- Product Visual Canvas/Image -->
<div class="aspect-square w-full mb-3 flex items-center justify-center p-2 bg-[#fbfbfb] rounded overflow-hidden">
<!-- Illustrated Graphic for Sol de Janeiro discovery spray set -->
<div class="flex items-end justify-center gap-1.5 h-full w-full py-4">
<div class="w-9 h-28 bg-[#f59e0b] rounded-t-md border border-amber-600 flex flex-col justify-between items-center py-1 text-[9px] font-bold text-white shadow-sm">
<span class="w-3 h-4 bg-white/70 rounded-xs mb-1"></span>
<span>62</span>
<span class="text-[7px]">MIST</span>
</div>
<div class="w-9 h-28 bg-[#ea580c] rounded-t-md border border-orange-600 flex flex-col justify-between items-center py-1 text-[9px] font-bold text-white shadow-sm">
<span class="w-3 h-4 bg-white/70 rounded-xs mb-1"></span>
<span>71</span>
<span class="text-[7px]">MIST</span>
</div>
<div class="w-9 h-28 bg-[#dc2626] rounded-t-md border border-red-600 flex flex-col justify-between items-center py-1 text-[9px] font-bold text-white shadow-sm">
<span class="w-3 h-4 bg-white/70 rounded-xs mb-1"></span>
<span>40</span>
<span class="text-[7px]">MIST</span>
</div>
<div class="w-9 h-28 bg-[#ec4899] rounded-t-md border border-pink-600 flex flex-col justify-between items-center py-1 text-[9px] font-bold text-white shadow-sm">
<span class="w-3 h-4 bg-white/70 rounded-xs mb-1"></span>
<span>68</span>
<span class="text-[7px]">MIST</span>
</div>
</div>
</div>
<!-- Brand & Name -->
<h3 class="text-xs font-extrabold uppercase text-black tracking-wider mb-1 line-clamp-1">SOL DE JANEIRO</h3>
<p class="text-xs text-gray-700 leading-snug line-clamp-2 min-h-[32px] mb-2 font-medium">Spritz &amp; Shine Cheirosa Perfume Mist Set</p>
<!-- Stars Rating -->
<div class="flex items-center gap-1.5 mb-2 text-xs">
<div class="flex text-black text-xs">@include('components.stars', ['rating' => $products->rating])<span class="text-black">★</span></div>
<span class="text-gray-400 text-[11px] font-medium">({{ number_format($products->reviews_count) }})</span>
</div>
</div>
<div>
<p class="text-sm font-bold text-black mb-3">AED {{ number_format($products->price, 2) }}</p>
<button class="w-full bg-black text-white text-xs font-bold uppercase py-2.5 rounded-sm hover:bg-neutral-800 transition-colors tracking-wide" data-add-to-bag="{{ $products->id }}">
                ADD TO BAG
              </button>
</div>
</article>
@endforeach
</div>
<!-- BEGIN: PaginationSection -->
<div class="mt-14 mb-16 text-center max-w-sm mx-auto" data-purpose="pagination-controls">
<p class="text-xs text-gray-600 font-medium mb-3">Showing 8 of 415 items</p>
<!-- Progress Bar -->
<div class="w-full bg-gray-200 h-1 rounded-full mb-6 overflow-hidden">
<div class="bg-black h-1 rounded-full w-[8%]"></div>
</div>
<button class="w-full border-2 border-black text-black hover:bg-black hover:text-white transition-all font-bold text-xs uppercase py-3.5 tracking-wider rounded-sm">
            LOAD MORE PRODUCTS
          </button>
</div>
<!-- END: PaginationSection -->
</section>
<!-- END: ProductCatalogGrid -->
</div>
</main>
@endsection
