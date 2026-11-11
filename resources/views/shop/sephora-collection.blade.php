@extends('layouts.app')

@section('title', __('meta.sephora_collection'))
@section('body_class', 'min-h-screen flex flex-col bg-white text-gray-900')

@section('content')
<main class="flex-1 max-w-[1440px] w-full mx-auto px-4 lg:px-8 py-5">
<!-- Breadcrumbs -->
<nav aria-label="Breadcrumb" class="mb-4">
<ol class="flex items-center space-x-2 text-xs text-neutral-500">
<li>
<a class="hover:underline hover:text-black" href="/">{{ __('ui.home') }}</a>
</li>
<li class="text-neutral-400">/</li>
<li class="font-bold text-neutral-900 tracking-wider">{{ __('content.t_7e772d9d5bf0') }}</li>
</ol>
</nav>
<!-- Page Title & Brand Story -->
<div class="mb-8">
<h1 class="text-2xl md:text-3xl font-black tracking-tight uppercase text-neutral-950 mb-2">
        {{ __('content.t_7e772d9d5bf0') }}
      </h1>
<p class="text-xs md:text-sm text-neutral-700 max-w-4xl leading-relaxed">
        {{ __('content.t_6ab9723b0554') }}
        <button class="font-bold underline text-black hover:opacity-80 uppercase ml-1 text-xs">{{ __('content.t_78577dbc45db') }}</button>
</p>
</div>
<!-- Filter Bar Header: Count & Sort Dropdown -->
<div class="flex items-center justify-between border-b border-subtle pb-3 mb-6">
<span class="text-xs sm:text-sm font-semibold text-neutral-700">
        {{ $products->count() }} items
      </span>
<div class="flex items-center gap-2">
<label class="text-xs font-medium text-neutral-600" for="sort-select">{{ __('content.t_9bb640e5a014') }}</label>
<div class="relative">
<select class="text-xs font-bold text-neutral-900 border-none bg-transparent pr-6 py-0 focus:ring-0 cursor-pointer" id="sort-select">
<option>{{ __('ui.recommended') }}</option>
<option>{{ __('ui.new_arrivals') }}</option>
<option>{{ __('ui.price_low_high') }}</option>
<option>{{ __('ui.price_high_low') }}</option>
<option>{{ __('content.t_c9418ddbe778') }}</option>
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
<h2 class="text-xs font-bold uppercase tracking-wider text-black mb-3">{{ __('ui.categories') }}</h2>
<ul class="space-y-2.5 font-medium text-neutral-700">
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('ui.holiday_collection') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(19)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('ui.new') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(40)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('ui.makeup') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(234)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('ui.fragrance') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(3)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('ui.skincare') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(129)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('ui.bath_body') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(28)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('ui.hair') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(35)</span>
</a>
</li>
<!-- Active Filter -->
<li class="bg-neutral-100 -mx-2 px-2 py-1 rounded">
<a class="flex justify-between items-center font-bold text-black" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('content.t_289b65242e3b') }}</span>
<span class="text-black">(376)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('content.t_a1118d1ba9c9') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(28)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('ui.gifts') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(40)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('content.t_0b3ff1e45ba6') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(10)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center hover:text-black group" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
<span>{{ __('content.t_491aa5dbd5ed') }}</span>
<span class="text-neutral-400 group-hover:text-neutral-700">(1)</span>
</a>
</li>
</ul>
</div>
<hr class="border-subtle"/>
<!-- Refine Accordion Filter Groups -->
<div class="space-y-4">
<h3 class="text-xs font-bold uppercase tracking-wider text-black">{{ __('ui.refine') }}</h3>
<!-- Exclusivity Toggle -->
<div class="flex items-center justify-between py-1">
<span class="text-neutral-800 font-medium">{{ __('content.t_a283183b6457') }}</span>
<label class="relative inline-flex items-center cursor-pointer">
<input class="sr-only peer" type="checkbox" value=""/>
<div class="w-8 h-4 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-black"></div>
</label>
</div>
<!-- Filter Accordion Item 1 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>{{ __('ui.product_type') }}</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
<!-- Filter Accordion Item 2 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>{{ __('ui.shades_tones') }}</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
<!-- Filter Accordion Item 3 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>{{ __('ui.coverage') }}</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
<!-- Filter Accordion Item 4 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>{{ __('ui.price') }}</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
<!-- Filter Accordion Item 5 -->
<div class="border-t border-subtle pt-3">
<button class="w-full flex justify-between items-center text-left font-semibold text-neutral-900 py-1">
<span>{{ __('ui.benefits') }}</span>
<svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
</button>
</div>
</div>
</aside>
<!-- END: LeftFilterSidebar -->
<!-- BEGIN: ProductGrid -->
<section aria-label="{{ __('content.t_4971e32f3bcc') }}" class="lg:col-span-3 xl:col-span-4">
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
<!-- Card 1: Brand Feature Hero Card -->
<article class="col-span-2 md:col-span-1 bg-[#1e1e1e] text-white rounded-none flex flex-col justify-between overflow-hidden relative group shadow-sm">
<div class="relative w-full aspect-square overflow-hidden bg-neutral-800">
<!-- ONLY AT SEPHORA BADGE -->
<div class="absolute top-3 left-3 z-10">
<span class="inline-flex items-center justify-center bg-black/80 text-white rounded-full p-1.5 border border-white/40 shadow">
<span class="text-[9px] font-black uppercase tracking-tight text-center leading-tight px-1">
                    {{ __('content.t_1eff8e171f5a') }}<br/>SEPHORA
                  </span>
</span>
</div>
<img alt="{{ __('content.t_eaf4cc0416d8') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_991d73ffa07c4484.jpg') }}"/>
</div>
<div class="p-4 sm:p-5 flex flex-col flex-1 justify-between bg-[#232323]">
<div>
<h3 class="font-bold text-sm sm:text-base uppercase tracking-wide mb-1 text-white">{{ __('content.t_3e62beb7aeb0') }}</h3>
<p class="text-xs text-neutral-300 font-light leading-relaxed mb-4">
                  {{ __('content.t_47aeb07fd3a4') }}
                </p>
</div>
<a class="inline-block text-center w-full py-2.5 bg-white text-black text-xs font-bold tracking-wider uppercase hover:bg-neutral-200 transition-colors" href="{{ route('shop.category', ['slug' => 'bestsellers']) }}">
                {{ __('content.t_137db5768297') }}
              </a>
</div>
</article>
<!-- Products Loop -->
@foreach($products as $product)
    <x-product-card :product="$product" />
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
