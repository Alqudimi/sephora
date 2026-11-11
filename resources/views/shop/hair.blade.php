@extends('layouts.app')

@section('title', __('meta.hair'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-6 pb-20">
<!-- 3. BREADCRUMBS & CATEGORY HEADER -->
<div class="mb-8">
<nav aria-label="{{ __('ui.breadcrumb') }}" class="flex items-center space-x-2 font-label-caps text-label-caps tracking-widest text-on-surface-variant mb-4">
<a class="hover:text-primary uppercase transition-colors" href="/">{{ __('ui.home') }}</a>
<span class="text-outline-variant font-normal">/</span>
<span class="text-primary font-bold uppercase">{{ __('ui.hair') }}</span>
</nav>
<div class="flex flex-col md:flex-row md:items-end justify-between border-b border-outline-variant pb-6 gap-4">
<div>
<div class="flex items-baseline space-x-3">
<h1 class="font-headline-lg text-headline-lg font-bold text-primary tracking-tight">{{ __('ui.hair') }}</h1>
<span class="font-body-sm text-body-sm text-on-surface-variant font-medium">({{ __('ui.items_count_label', ['count' => '780']) }})</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-2xl leading-relaxed">
            {{ __('content.t_6cda56cff690') }}
          </p>
</div>
<!-- Sort dropdown -->
<div class="flex items-center space-x-3 self-end md:self-auto">
<label class="font-label-caps text-label-caps tracking-wider text-on-surface-variant uppercase whitespace-nowrap" for="sort-select">{{ __('ui.sort_by') }}</label>
<div class="relative inline-block w-48">
<select class="w-full appearance-none bg-surface-container-lowest border border-outline-variant px-3.5 py-2 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary rounded-none cursor-pointer" id="sort-select">
<option selected="">{{ __('ui.recommended') }}</option>
<option>{{ __('ui.bestsellers') }}</option>
<option>{{ __('ui.price_low_high') }}</option>
<option>{{ __('ui.price_high_low') }}</option>
<option>{{ __('content.t_c9418ddbe778') }}</option>
<option>{{ __('ui.new_arrivals') }}</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant text-[18px]">
              expand_more
            </span>
</div>
</div>
</div>
</div>
<!-- MAIN TWO-COLUMN LAYOUT (SIDEBAR + 4-COLUMN PRODUCT GRID) -->
<div class="flex flex-col lg:flex-row gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">
<!-- 4. SIDEBAR FILTERS (260px Fixed) -->
<aside class="w-full lg:w-[260px] flex-shrink-0 divide-y divide-outline-variant font-body-sm text-body-sm">
<!-- Collapsible CATEGORIES -->
<div class="py-4">
<div class="flex items-center justify-between cursor-pointer mb-3">
<h3 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">{{ __('ui.categories') }}</h3>
<span class="material-symbols-outlined text-[18px]">remove</span>
</div>
<ul class="space-y-2 text-on-surface-variant font-body-sm">
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>{{ __('content.t_c90748ce8f27') }}</span> <span class="text-outline text-[11px]">(240)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors font-medium text-primary" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>{{ __('ui.treatments') }}</span> <span class="text-outline text-[11px]">(195)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>{{ __('content.t_c09cb99e975f') }}</span> <span class="text-outline text-[11px]">(160)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>{{ __('content.t_6cab3fb9d490') }}</span> <span class="text-outline text-[11px]">(75)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>{{ __('content.t_16591cf73c89') }}</span> <span class="text-outline text-[11px]">(130)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>{{ __('ui.sets') }}</span> <span class="text-outline text-[11px]">(48)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>{{ __('ui.travel_size') }}</span> <span class="text-outline text-[11px]">(52)</span></a></li>
</ul>
</div>
<!-- REFINE SECTION & EXCLUSIVES TOGGLE -->
<div class="py-4">
<div class="flex items-center justify-between mb-3">
<h3 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">{{ __('content.t_96c857ca3a60') }}</h3>
<button class="font-label-caps text-[10px] tracking-wider text-on-surface-variant hover:text-primary underline">{{ __('ui.clear_all') }}</button>
</div>
<div class="flex items-center justify-between bg-surface-container-low p-2.5 border border-outline-variant">
<span class="font-label-caps text-label-caps uppercase text-primary font-semibold">{{ __('content.t_a283183b6457') }}</span>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox"/>
<div class="w-8 h-4 bg-outline-variant peer-focus:outline-none rounded-none peer peer-checked:bg-primary after:content-[''] after:absolute after:top-[1px] after:left-[1px] after:bg-on-primary after:h-3.5 after:w-3.5 after:transition-all peer-checked:after:translate-x-4"></div>
</label>
</div>
</div>
<!-- BRAND FILTER SECTION (Expanded with search & checkboxes) -->
<div class="py-4">
<div class="flex items-center justify-between cursor-pointer mb-3">
<h3 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">{{ __('ui.brand') }}</h3>
<span class="material-symbols-outlined text-[18px]">remove</span>
</div>
<!-- Brand filter search -->
<div class="relative mb-3">
<input class="w-full pl-7 pr-2 py-1.5 border border-outline-variant bg-surface-container-lowest text-xs rounded-none focus:outline-none focus:border-primary" placeholder="{{ __('content.t_5c1d91f3c2a3') }}" type="text"/>
<span class="material-symbols-outlined absolute left-1.5 top-1.5 text-outline text-[16px]">search</span>
</div>
<div class="space-y-2 max-h-56 overflow-y-auto pr-1">
<label class="flex items-center justify-between cursor-pointer group">
<div class="flex items-center space-x-2">
<input checked="" class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-primary font-semibold group-hover:text-secondary transition-colors">Olaplex</span>
</div>
<span class="text-outline text-xs">(32)</span>
</label>
<label class="flex items-center justify-between cursor-pointer group">
<div class="flex items-center space-x-2">
<input checked="" class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-primary font-semibold group-hover:text-secondary transition-colors">K18</span>
</div>
<span class="text-outline text-xs">(18)</span>
</label>
<label class="flex items-center justify-between cursor-pointer group">
<div class="flex items-center space-x-2">
<input checked="" class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-primary font-semibold group-hover:text-secondary transition-colors">Gisou</span>
</div>
<span class="text-outline text-xs">(14)</span>
</label>
<label class="flex items-center justify-between cursor-pointer group">
<div class="flex items-center space-x-2">
<input checked="" class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-primary font-semibold group-hover:text-secondary transition-colors">{{ __('content.t_33452044ba46') }}</span>
</div>
<span class="text-outline text-xs">(20)</span>
</label>
<label class="flex items-center justify-between cursor-pointer group">
<div class="flex items-center space-x-2">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant group-hover:text-primary transition-colors">Dyson</span>
</div>
<span class="text-outline text-xs">(15)</span>
</label>
<label class="flex items-center justify-between cursor-pointer group">
<div class="flex items-center space-x-2">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant group-hover:text-primary transition-colors">Kérastase</span>
</div>
<span class="text-outline text-xs">(42)</span>
</label>
<label class="flex items-center justify-between cursor-pointer group">
<div class="flex items-center space-x-2">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant group-hover:text-primary transition-colors">{{ __('content.t_58cb39776e84') }}</span>
</div>
<span class="text-outline text-xs">(16)</span>
</label>
<label class="flex items-center justify-between cursor-pointer group">
<div class="flex items-center space-x-2">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant group-hover:text-primary transition-colors">Ouai</span>
</div>
<span class="text-outline text-xs">(22)</span>
</label>
<label class="flex items-center justify-between cursor-pointer group">
<div class="flex items-center space-x-2">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant group-hover:text-primary transition-colors">Briogeo</span>
</div>
<span class="text-outline text-xs">(19)</span>
</label>
</div>
</div>
<!-- COLLAPSIBLE ACCORDIONS -->
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold group-hover:text-secondary transition-colors">{{ __('content.t_c09cb99e975f') }}</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</button>
</div>
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold group-hover:text-secondary transition-colors">{{ __('content.t_4f5b0c359785') }}</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</button>
</div>
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold group-hover:text-secondary transition-colors">{{ __('content.t_ae1f4d25db2b') }}</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</button>
</div>
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold group-hover:text-secondary transition-colors">Benefit</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</button>
</div>
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold group-hover:text-secondary transition-colors">{{ __('ui.price') }}</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</button>
</div>
</aside>
<!-- 5. PRODUCT CATALOG GRID (4 COLUMNS) -->
<section class="flex-1 w-full">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-8">
<!-- Card 1: Gisou Honey Infused Hair Oil -->
@foreach($products as $products)
<article onclick="window.location='/p/{{ $products->slug }}'" class="product-card-container border border-outline-variant bg-surface-container-lowest flex flex-col justify-between p-3.5 group relative">
<div>
<!-- Badges & Wishlist -->
<div class="flex items-start justify-between relative z-10 mb-2">
<div class="flex flex-col space-y-1">
@if($products->badge)
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-1.5 py-0.5 uppercase tracking-wider">{{ $products->badge }}</span>
@endif

</div>
<button class="text-on-surface hover:text-secondary transition-colors" title="{{ __('ui.wishlist_label') }}">
<span class="material-symbols-outlined text-[20px]">favorite</span>
</button>
</div>
<!-- Product Image -->
<div class="aspect-square w-full overflow-hidden bg-surface-container-lowest flex items-center justify-center p-2 mb-3">
<img alt="{{ $products->name }}" class="product-card-img object-contain w-full h-full" src="{{ media_url($products->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
</div>
<!-- Metadata -->
<h4 class="font-label-caps text-label-caps uppercase tracking-wider text-primary font-bold">{{ $products->brand->name }}
<h3 class="font-body-md text-body-md text-on-surface line-clamp-2 min-h-[44px] mt-1 font-medium">{{ $products->name }}</h3>
<!-- Rating -->
<div class="flex items-center space-x-1 mt-2">
@include('components.stars-m3', ['rating' => $products->rating])
<span class="font-body-sm text-body-sm text-on-surface-variant font-medium">4.8 ({{ number_format($products->reviews_count) }})</span>
</div>
<!-- Price -->
<div class="mt-2.5 font-price-aed-lg text-price-aed-lg text-primary font-bold">
                AED {{ number_format($products->price, 2) }}
              </div>
</div>
<!-- Action Button -->
<button class="mt-4 w-full h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all duration-150" data-add-to-bag="{{ $products->id }}">
              {{ __('content.t_ea34a3a7ca7b') }}
            </button>
</article>
@endforeach
</div>
<!-- PAGINATION & PROGRESS INDICATOR -->
<div class="mt-16 text-center max-w-md mx-auto">
<p class="font-body-sm text-body-sm text-on-surface-variant mb-2.5">
            {{ __('ui.showing') }} <strong class="text-primary">12</strong> {{ __('ui.of') }} <strong class="text-primary">780</strong> items
          </p>
<div class="w-full bg-outline-variant h-0.5 mb-6 overflow-hidden">
<div class="bg-primary h-0.5 w-[2%]"></div>
</div>
<button class="w-full h-12 bg-transparent text-primary border border-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary hover:text-on-primary transition-colors duration-150">
            {{ __('content.t_ff6255edd8b2') }}
          </button>
</div>
</section>
</div>
</main>
@endsection
