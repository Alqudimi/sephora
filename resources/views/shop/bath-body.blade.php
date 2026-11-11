@extends('layouts.app')

@section('title', __('meta.bath_body'))
@section('body_class', 'bg-surface text-on-surface antialiased')

@section('content')
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- Breadcrumb -->
<nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-outline font-label-caps text-label-caps mb-6">
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span>/</span>
<span class="text-primary font-bold">{{ __('ui.bath_body') }}</span>
</nav>
<!-- Header & Filter Row -->
<div class="border-b border-outline-variant pb-6 mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<div class="flex items-baseline space-x-3 mb-2">
<h1 class="font-headline-lg text-headline-lg font-bold text-primary">{{ __('ui.bath_body') }}</h1>
<span class="font-body-md text-body-md text-outline">(540 items)</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">
          {{ __('content.t_9229e6f77d14') }}
        </p>
</div>
<!-- Sort Dropdown -->
<div class="flex items-center space-x-3 self-start md:self-auto">
<label class="font-label-caps text-label-caps text-on-surface whitespace-nowrap" for="sort-select">{{ __('content.t_38ffc08439a3') }}</label>
<div class="relative inline-block border border-primary bg-surface-container-lowest">
<select class="appearance-none bg-transparent pr-10 pl-3 py-2 font-label-caps text-label-caps text-primary cursor-pointer focus:outline-none" id="sort-select">
<option>{{ __('ui.recommended') }}</option>
<option>{{ __('ui.new_arrivals') }}</option>
<option>{{ __('ui.bestsellers') }}</option>
<option>{{ __('ui.price_low_high') }}</option>
<option>{{ __('ui.price_high_low') }}</option>
<option>{{ __('ui.top_rated') }}</option>
</select>
<span class="material-symbols-outlined pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-primary text-[18px]">keyboard_arrow_down</span>
</div>
</div>
</div>
<!-- 4. Content Area: Sidebar + Product Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
<!-- LEFT SIDEBAR: Categories & Refinements (3 cols on desktop) -->
<aside class="lg:col-span-3 space-y-6">
<!-- CATEGORIES Accordion -->
<div class="border border-outline-variant bg-surface-container-lowest p-5">
<div class="flex items-center justify-between pb-3 border-b border-surface-container cursor-pointer">
<h3 class="font-title-md text-title-md font-bold text-primary uppercase">{{ __('ui.categories') }}</h3>
<span class="material-symbols-outlined text-primary text-[20px]">expand_less</span>
</div>
<ul class="pt-4 space-y-3 font-body-sm text-body-sm">
<li class="flex items-center justify-between hover:text-secondary cursor-pointer transition-colors">
<span class="text-on-surface">{{ __('content.t_11a342e89fc8') }}</span>
<span class="text-outline font-label-tag text-label-tag">(210)</span>
</li>
<li class="flex items-center justify-between hover:text-secondary cursor-pointer transition-colors">
<span class="text-on-surface font-semibold text-primary">{{ __('content.t_913726c11d1a') }}</span>
<span class="text-outline font-label-tag text-label-tag">(185)</span>
</li>
<li class="flex items-center justify-between hover:text-secondary cursor-pointer transition-colors">
<span class="text-on-surface">{{ __('content.t_96a426247d33') }}</span>
<span class="text-outline font-label-tag text-label-tag">(45)</span>
</li>
<li class="flex items-center justify-between hover:text-secondary cursor-pointer transition-colors">
<span class="text-on-surface">{{ __('content.t_f3560456889a') }}</span>
<span class="text-outline font-label-tag text-label-tag">(62)</span>
</li>
<li class="flex items-center justify-between hover:text-secondary cursor-pointer transition-colors">
<span class="text-on-surface">{{ __('content.t_69db8a758e16') }}</span>
<span class="text-outline font-label-tag text-label-tag">(98)</span>
</li>
<li class="flex items-center justify-between hover:text-secondary cursor-pointer transition-colors">
<span class="text-on-surface">{{ __('content.t_3fd51fb30a78') }}</span>
<span class="text-outline font-label-tag text-label-tag">(42)</span>
</li>
<li class="flex items-center justify-between hover:text-secondary cursor-pointer transition-colors">
<span class="text-on-surface">{{ __('content.t_5d1968582364') }}</span>
<span class="text-outline font-label-tag text-label-tag">(110)</span>
</li>
<li class="flex items-center justify-between hover:text-secondary cursor-pointer transition-colors">
<span class="text-on-surface">{{ __('content.t_36b25362e3bc') }}</span>
<span class="text-outline font-label-tag text-label-tag">(38)</span>
</li>
</ul>
</div>
<!-- REFINE SECTION -->
<div class="border border-outline-variant bg-surface-container-lowest p-5 space-y-5">
<div class="flex items-center justify-between pb-3 border-b border-surface-container">
<h3 class="font-title-md text-title-md font-bold text-primary uppercase">{{ __('ui.refine') }}</h3>
<button class="font-label-caps text-label-caps text-outline hover:text-secondary underline cursor-pointer transition-colors">{{ __('ui.clear_all') }}</button>
</div>
<!-- Exclusive Toggle -->
<div class="flex items-center justify-between py-1">
<span class="font-body-sm text-body-sm font-semibold text-on-surface">{{ __('content.t_a283183b6457') }}</span>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox"/>
<div class="w-10 h-5 bg-surface-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-surface-container-lowest after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-surface-container-lowest after:border-outline-variant after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
<!-- BRAND FILTER (Expanded) -->
<div class="pt-3 border-t border-surface-container">
<div class="flex items-center justify-between mb-3 cursor-pointer">
<span class="font-title-md text-title-md font-bold text-primary">BRAND</span>
<span class="material-symbols-outlined text-[18px]">expand_less</span>
</div>
<!-- Search Inside Brand -->
<div class="relative mb-3">
<input class="w-full text-xs py-1.5 px-3 border border-outline-variant focus:border-primary focus:outline-none bg-surface" placeholder="{{ __('content.t_5c1d91f3c2a3') }}" type="text"/>
</div>
<div class="space-y-2.5 max-h-48 overflow-y-auto pr-1">
<label class="flex items-center space-x-2.5 cursor-pointer">
<input checked="" class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="font-body-sm text-body-sm text-on-surface flex-1">{{ __('content.t_26a43a9b7210') }}</span>
<span class="text-outline font-label-tag text-label-tag">(24)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input checked="" class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="font-body-sm text-body-sm text-on-surface flex-1">Ouai</span>
<span class="text-outline font-label-tag text-label-tag">(18)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="font-body-sm text-body-sm text-on-surface flex-1">Rituals</span>
<span class="text-outline font-label-tag text-label-tag">(22)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input checked="" class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="font-body-sm text-body-sm text-on-surface flex-1">{{ __('content.t_77e01c688af0') }}</span>
<span class="text-outline font-label-tag text-label-tag">(30)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="font-body-sm text-body-sm text-on-surface flex-1">{{ __('content.t_289b65242e3b') }}</span>
<span class="text-outline font-label-tag text-label-tag">(45)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="font-body-sm text-body-sm text-on-surface flex-1">Nuxe</span>
<span class="text-outline font-label-tag text-label-tag">(14)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="font-body-sm text-body-sm text-on-surface flex-1">{{ __('content.t_a908ff0770b0') }}</span>
<span class="text-outline font-label-tag text-label-tag">(12)</span>
</label>
</div>
</div>
<!-- PRODUCT TYPE (Collapsible) -->
<div class="pt-3 border-t border-surface-container flex items-center justify-between cursor-pointer">
<span class="font-title-md text-title-md font-bold text-primary">{{ __('content.t_1b0f4cd9df91') }}</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</div>
<!-- BENEFIT / CONCERN (Collapsible) -->
<div class="pt-3 border-t border-surface-container flex items-center justify-between cursor-pointer">
<span class="font-title-md text-title-md font-bold text-primary">{{ __('content.t_25483ea2e0ad') }}</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</div>
<!-- SCENT FAMILY (Collapsible) -->
<div class="pt-3 border-t border-surface-container flex items-center justify-between cursor-pointer">
<span class="font-title-md text-title-md font-bold text-primary">{{ __('content.t_a1e56f3a3da9') }}</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</div>
<!-- FORMULATION (Collapsible) -->
<div class="pt-3 border-t border-surface-container flex items-center justify-between cursor-pointer">
<span class="font-title-md text-title-md font-bold text-primary">{{ __('ui.formulation') }}</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</div>
<!-- PRICE (Collapsible) -->
<div class="pt-3 border-t border-surface-container flex items-center justify-between cursor-pointer">
<span class="font-title-md text-title-md font-bold text-primary">{{ __('ui.price') }}</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</div>
</div>
</aside>
<!-- 5. PRODUCT CATALOG GRID (9 cols on desktop, 4 product columns) -->
<section class="lg:col-span-9">
<!-- Active Filter Pills Bar -->
<div class="flex flex-wrap items-center gap-2 mb-6">
<span class="font-label-caps text-label-caps text-outline mr-2">{{ __('ui.filters') }}</span>
<div class="flex items-center space-x-1.5 bg-primary text-on-primary px-3 py-1 font-label-caps text-label-caps cursor-pointer">
<span>{{ __('content.t_26a43a9b7210') }}</span>
<span class="material-symbols-outlined text-[14px]">close</span>
</div>
<div class="flex items-center space-x-1.5 bg-primary text-on-primary px-3 py-1 font-label-caps text-label-caps cursor-pointer">
<span>Ouai</span>
<span class="material-symbols-outlined text-[14px]">close</span>
</div>
<div class="flex items-center space-x-1.5 bg-primary text-on-primary px-3 py-1 font-label-caps text-label-caps cursor-pointer">
<span>L'Occitane</span>
<span class="material-symbols-outlined text-[14px]">close</span>
</div>
<div class="flex items-center space-x-1.5 bg-secondary text-on-secondary px-3 py-1 font-label-caps text-label-caps cursor-pointer">
<span>{{ __('content.t_ded6d4b027b3') }}</span>
<span class="material-symbols-outlined text-[14px]">close</span>
</div>
<button class="font-label-caps text-label-caps text-outline hover:text-secondary underline ml-2">{{ __('ui.reset') }}</button>
</div>
<!-- 4-Column Responsive Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
<!-- Card 1: Sol de Janeiro Bum Bum Cream -->
@foreach($products as $products)
<div class="product-card group relative bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between p-4 transition-all duration-150">
<div>
<div class="flex justify-between items-start mb-2">
@if($products->badge)
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">{{ $products->badge }}</span>
@endif
<button class="text-outline hover:text-secondary transition-colors" title="{{ __('content.t_a44253758df5') }}">
<span class="material-symbols-outlined text-[20px]">favorite</span>
</button>
</div>
<!-- Product Packshot -->
<div class="relative w-full aspect-square overflow-hidden mb-3 bg-surface-container-lowest flex items-center justify-center">
<img class="product-image w-full h-full object-contain transition-transform duration-300" data-alt="{{ $products->name }}" src="{{ media_url($products->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
</div>
<div class="space-y-1">
<p class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-wider">{{ $products->brand->name }}
<h4 class="font-body-md text-body-md text-on-surface line-clamp-2 hover:underline cursor-pointer">
                  Brazilian Bum Bum Cream (240ml)
                </h4>
<!-- Rating -->
<div class="flex items-center space-x-1 pt-1">
<div class="flex text-amber-500">
<span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-label-tag text-label-tag text-outline">4.8 ({{ number_format($products->reviews_count) }})</span>
</div>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container">
<div class="mb-3">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED {{ number_format($products->price, 2) }}</span>
</div>
<button class="w-full h-10 bg-primary hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary text-on-primary font-label-caps text-label-caps tracking-widest transition-colors duration-200 uppercase" data-add-to-bag="{{ $products->id }}">
                {{ __('content.t_ea34a3a7ca7b') }}
              </button>
</div>
</div>
@endforeach
</div>
<!-- Catalog Pagination / Progress Indicator -->
<div class="mt-12 text-center space-y-4">
<p class="font-label-caps text-label-caps text-outline tracking-wider">{{ __('content.t_a790c22c4175') }}</p>
<div class="w-64 h-1 bg-surface-variant mx-auto overflow-hidden">
<div class="w-1/12 h-full bg-primary"></div>
</div>
<div>
<button class="px-10 py-3.5 border border-primary text-primary hover:bg-primary hover:text-on-primary font-label-caps text-label-caps tracking-widest transition-colors duration-200 uppercase cursor-pointer">
              {{ __('content.t_ff6255edd8b2') }}
            </button>
</div>
</div>
</section>
</div>
</main>
@endsection
