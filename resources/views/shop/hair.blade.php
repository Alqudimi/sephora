@extends('layouts.app')

@section('title', 'Sephora UAE | Haircare Category - Luxury Beauty E-Commerce')
@section('body_class', 'bg-surface text-on-surface antialiased selection:bg-primary selection:text-on-primary')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-6 pb-20">
<!-- 3. BREADCRUMBS & CATEGORY HEADER -->
<div class="mb-8">
<nav aria-label="Breadcrumb" class="flex items-center space-x-2 font-label-caps text-label-caps tracking-widest text-on-surface-variant mb-4">
<a class="hover:text-primary uppercase transition-colors" href="/">Home</a>
<span class="text-outline-variant font-normal">/</span>
<span class="text-primary font-bold uppercase">Hair</span>
</nav>
<div class="flex flex-col md:flex-row md:items-end justify-between border-b border-outline-variant pb-6 gap-4">
<div>
<div class="flex items-baseline space-x-3">
<h1 class="font-headline-lg text-headline-lg font-bold text-primary tracking-tight">Hair</h1>
<span class="font-body-sm text-body-sm text-on-surface-variant font-medium">(780 items)</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-2xl leading-relaxed">
            From everyday essentials to salon-grade treatments, discover our curated collection for strong, lustrous, healthy hair from root to tip.
          </p>
</div>
<!-- Sort dropdown -->
<div class="flex items-center space-x-3 self-end md:self-auto">
<label class="font-label-caps text-label-caps tracking-wider text-on-surface-variant uppercase whitespace-nowrap" for="sort-select">Sort By:</label>
<div class="relative inline-block w-48">
<select class="w-full appearance-none bg-surface-container-lowest border border-outline-variant px-3.5 py-2 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary rounded-none cursor-pointer" id="sort-select">
<option selected="">Recommended</option>
<option>Bestsellers</option>
<option>Price: Low to High</option>
<option>Price: High to Low</option>
<option>Customer Rating</option>
<option>New Arrivals</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant text-[18px]">
              expand_more
            </span>
</div>
</div>
</div>
</div>
<!-- MAIN TWO-COLUMN LAYOUT (SIDEBAR + 4-COLUMN PRODUCT GRID) -->
<div class="flex flex-col lg:flex-row gap-8 items-start">
<!-- 4. SIDEBAR FILTERS (260px Fixed) -->
<aside class="w-full lg:w-[260px] flex-shrink-0 divide-y divide-outline-variant font-body-sm text-body-sm">
<!-- Collapsible CATEGORIES -->
<div class="py-4">
<div class="flex items-center justify-between cursor-pointer mb-3">
<h3 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">Categories</h3>
<span class="material-symbols-outlined text-[18px]">remove</span>
</div>
<ul class="space-y-2 text-on-surface-variant font-body-sm">
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>Shampoo &amp; Conditioner</span> <span class="text-outline text-[11px]">(240)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors font-medium text-primary" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>Treatments</span> <span class="text-outline text-[11px]">(195)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>Hair Type</span> <span class="text-outline text-[11px]">(160)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>Tools &amp; Accessories</span> <span class="text-outline text-[11px]">(75)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>Shop By Concern</span> <span class="text-outline text-[11px]">(130)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>Sets</span> <span class="text-outline text-[11px]">(48)</span></a></li>
<li><a class="hover:text-primary flex justify-between items-center transition-colors" href="{{ route('shop.category', ['slug' => 'hair']) }}"><span>Travel Size</span> <span class="text-outline text-[11px]">(52)</span></a></li>
</ul>
</div>
<!-- REFINE SECTION & EXCLUSIVES TOGGLE -->
<div class="py-4">
<div class="flex items-center justify-between mb-3">
<h3 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">Refine By</h3>
<button class="font-label-caps text-[10px] tracking-wider text-on-surface-variant hover:text-primary underline">Clear All</button>
</div>
<div class="flex items-center justify-between bg-surface-container-low p-2.5 border border-outline-variant">
<span class="font-label-caps text-label-caps uppercase text-primary font-semibold">Sephora Exclusive Only</span>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox"/>
<div class="w-8 h-4 bg-outline-variant peer-focus:outline-none rounded-none peer peer-checked:bg-primary after:content-[''] after:absolute after:top-[1px] after:left-[1px] after:bg-on-primary after:h-3.5 after:w-3.5 after:transition-all peer-checked:after:translate-x-4"></div>
</label>
</div>
</div>
<!-- BRAND FILTER SECTION (Expanded with search & checkboxes) -->
<div class="py-4">
<div class="flex items-center justify-between cursor-pointer mb-3">
<h3 class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold">Brand</h3>
<span class="material-symbols-outlined text-[18px]">remove</span>
</div>
<!-- Brand filter search -->
<div class="relative mb-3">
<input class="w-full pl-7 pr-2 py-1.5 border border-outline-variant bg-surface-container-lowest text-xs rounded-none focus:outline-none focus:border-primary" placeholder="Search brands..." type="text"/>
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
<span class="text-primary font-semibold group-hover:text-secondary transition-colors">Color Wow</span>
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
<span class="text-on-surface-variant group-hover:text-primary transition-colors">Fable &amp; Mane</span>
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
<span class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold group-hover:text-secondary transition-colors">Hair Type</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</button>
</div>
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold group-hover:text-secondary transition-colors">Hair Concern</span>
<span class="material-symbols-outlined text-[18px]">add</span>
</button>
</div>
<div class="py-3.5">
<button class="w-full flex items-center justify-between text-left group">
<span class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold group-hover:text-secondary transition-colors">Product Formulation</span>
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
<span class="font-title-md text-title-md uppercase tracking-wider text-primary font-bold group-hover:text-secondary transition-colors">Price</span>
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
<button class="text-on-surface hover:text-secondary transition-colors" title="Wishlist">
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
              ADD TO BAG
            </button>
</article>
@endforeach
</div>
<!-- PAGINATION & PROGRESS INDICATOR -->
<div class="mt-16 text-center max-w-md mx-auto">
<p class="font-body-sm text-body-sm text-on-surface-variant mb-2.5">
            Showing <strong class="text-primary">12</strong> of <strong class="text-primary">780</strong> items
          </p>
<div class="w-full bg-outline-variant h-0.5 mb-6 overflow-hidden">
<div class="bg-primary h-0.5 w-[2%]"></div>
</div>
<button class="w-full h-12 bg-transparent text-primary border border-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary hover:text-on-primary transition-colors duration-150">
            LOAD MORE PRODUCTS
          </button>
</div>
</section>
</div>
</main>
@endsection
