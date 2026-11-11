@extends('layouts.app')

@section('title', __('meta.newness'))
@section('body_class', 'font-sans text-sm selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-5">
<!-- Breadcrumb Navigation -->
<nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2" data-purpose="breadcrumbs">
<a class="hover:underline" href="/">{{ __('ui.home') }}</a>
<span>/</span>
<a class="hover:underline" href="/shop/new">{{ __('ui.new') }}</a>
<span>/</span>
<span class="text-black font-bold underline cursor-default">{{ __('content.t_931e1a4b152a') }}</span>
</nav>
<!-- Page Title & Top Filters Controls Bar -->
<div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-gray-200 pb-4 mb-6 gap-4">
<div>
<h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-black">{{ __('ui.view_all') }}</h1>
<p class="text-xs sm:text-sm text-gray-500 mt-2 font-normal">{{ __('ui.items_count_label', ['count' => 471]) }}</p>
</div>
<!-- Sort Dropdown -->
<div class="flex items-center self-end sm:self-auto space-x-2">
<label class="text-xs font-medium text-gray-700" for="sort">{{ __('content.t_9bb640e5a014') }}</label>
<div class="relative inline-block">
<select class="appearance-none bg-white border border-gray-300 rounded px-3 py-1.5 pr-8 text-xs font-semibold focus:outline-none focus:border-black cursor-pointer" id="sort">
<option>{{ __('ui.recommended') }}</option>
<option>{{ __('content.t_6dbb398c44c7') }}</option>
<option>{{ __('ui.price_low_high') }}</option>
<option>{{ __('ui.price_high_low') }}</option>
<option>{{ __('ui.top_rated') }}</option>
</select>
<span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none text-gray-500">
<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</span>
</div>
</div>
</div>
<!-- Catalog Two-Column Layout -->
<div class="flex flex-col lg:flex-row items-start gap-8">
<!-- BEGIN: FilterSidebar -->
<aside class="w-full lg:w-64 shrink-0" data-purpose="catalog-filters">
<!-- New Category Filter Accordion -->
<div class="border border-gray-200 rounded p-4 mb-5">
<div class="flex items-center justify-between font-bold text-sm text-black pb-2 mb-2 border-b border-gray-100 cursor-pointer">
<span>{{ __('ui.new') }}<span class="text-xs font-normal text-gray-500">(494)</span></span>
<svg class="w-4 h-4 text-gray-600 transform rotate-180" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
<ul class="space-y-2.5 text-xs pt-1 pl-1">
<li>
<a class="font-bold text-black flex items-center justify-between" href="{{ route('shop.category', ['slug' => 'new']) }}">
<span>{{ __('ui.view_all') }}</span>
<span class="text-gray-400 font-normal">(471)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="{{ route('shop.category', ['slug' => 'new']) }}">
<span>{{ __('content.t_1411312757e3') }}</span>
<span class="text-gray-400">(102)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="{{ route('shop.category', ['slug' => 'new']) }}">
<span>{{ __('content.t_63e21e0ef014') }}</span>
<span class="text-gray-400">(55)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="{{ route('shop.category', ['slug' => 'new']) }}">
<span>{{ __('content.t_8f0fe12661cb') }}</span>
<span class="text-gray-400">(65)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="{{ route('shop.category', ['slug' => 'new']) }}">
<span>{{ __('content.t_26ea5d123b5f') }}</span>
<span class="text-gray-400">(36)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="{{ route('shop.category', ['slug' => 'new']) }}">
<span>{{ __('content.t_d27c84b3b553') }}</span>
<span class="text-gray-400">(32)</span>
</a>
</li>
</ul>
</div>
<!-- Refine Heading -->
<h2 class="font-bold text-sm tracking-wider uppercase text-black mb-3">{{ __('ui.refine') }}</h2>
<!-- Facet Accordions -->
<div class="border-t border-gray-200 divide-y divide-gray-200">
<!-- Brands Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>{{ __('ui.brands') }}</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
<!-- Shades Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>{{ __('ui.shades') }}</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
<!-- Price Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>{{ __('ui.price') }}</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
<!-- Benefits Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>{{ __('ui.benefits') }}</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
<!-- Formulation Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>{{ __('ui.formulation_label') }}</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
</div>
</aside>
<!-- END: FilterSidebar -->
<!-- BEGIN: ProductCatalogGrid -->
<section class="flex-1 w-full" data-purpose="product-grid">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
<!-- Product Card 1: Patrick Ta Major Headlines Blush -->
@foreach($products as $products)
<article onclick="window.location='/p/{{ $products->slug }}'" class="product-card border border-gray-200 bg-white rounded-sm p-3.5 flex flex-col justify-between relative group">
<div>
<!-- Header Badges & Wishlist -->
<div class="flex items-start justify-between min-h-[24px] mb-2">
<div class="flex flex-col gap-{{ __('ui.items_count_label', ['count' => '1']) }}-start">
<span class="bg-black text-white text-[10px] uppercase font-bold tracking-wider px-2 py-0.5">{{ __('ui.new') }}</span>
</div>
<button aria-label="{{ __('content.t_c7a159eeb9d2') }}" class="text-gray-400 hover:text-black transition-colors">
<svg class="w-5 h-5 stroke-current" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
</svg>
</button>
</div>
<!-- Product Image -->
<div class="w-full aspect-square flex items-center justify-center p-2 mb-3 overflow-hidden">
<img alt="{{ $products->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ media_url($products->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
</div>
<!-- Product Info -->
<h3 class="font-bold text-xs uppercase tracking-wide text-black mb-1">{{ __('content.t_5ab61473e0dd') }}</h3>
<p class="text-xs text-gray-700 line-clamp-2 min-h-[32px] mb-1.5 leading-snug">{{ __('content.t_82e0a85cb79d') }}</p>
<!-- Rating -->
<div class="flex items-center text-xs text-amber-500 mb-2">
<span class="text-amber-500">@include('components.stars', ['rating' => $products->rating])</span>
<span class="text-gray-700 text-[11px] font-semibold ml-1">{{ $products->rating }}</span>
<span class="text-gray-400 text-[11px] ml-0.5">({{ number_format($products->reviews_count) }})</span>
</div>
</div>
<div>
<p class="font-bold text-sm text-black mb-3">AED {{ number_format($products->price, 2) }}</p>
<button class="add-to-bag-btn w-full bg-black text-white text-xs font-bold uppercase tracking-wider py-2.5 rounded-none" data-add-to-bag="{{ $products->id }}">{{ __('ui.add_to_bag') }}</button>
</div>
</article>
@endforeach
</div>
<!-- Pagination / Load More Button -->
<div class="mt-12 text-center pb-8">
<p class="text-xs text-gray-500 mb-3">{{ __('content.t_3d0798551206') }}</p>
<div class="w-48 h-1 bg-gray-200 mx-auto rounded-full overflow-hidden mb-5">
<div class="w-1/6 h-full bg-black"></div>
</div>
<button class="inline-block border border-black bg-white hover:bg-black hover:text-white px-8 py-3 text-xs uppercase tracking-widest font-bold transition-colors">
            {{ __('content.t_176de849c65c') }}
          </button>
</div>
</section>
<!-- END: ProductCatalogGrid -->
</div>
</main>
@endsection
