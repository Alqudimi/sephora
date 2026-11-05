@extends('layouts.app')

@section('title', 'Skincare | SEPHORA UAE Official Online Store')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-6 md:py-8">
<!-- Breadcrumbs -->
<nav class="flex items-center space-x-2 text-on-surface-variant font-label-caps text-label-caps uppercase mb-4 tracking-wider">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<span class="text-primary font-bold">Skincare</span>
</nav>
<!-- Page Header & Editorial Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between hairline-b pb-6 mb-8 gap-4">
<div>
<div class="flex items-baseline gap-3 mb-2">
<h1 class="font-headline-md text-headline-md font-semibold text-primary tracking-tight">Skincare</h1>
<span class="font-body-md text-outline font-normal text-sm">(1,120 items)</span>
</div>
<p class="font-body-md text-on-surface-variant max-w-2xl text-[14px] leading-relaxed">
          Reveal radiant, healthy skin with our curated collection of clinical actives, clean hydration, and luxury botanicals.
        </p>
</div>
<!-- Sort by Dropdown -->
<div class="flex items-center gap-3 self-end md:self-auto">
<label class="font-label-caps text-label-caps uppercase text-outline" for="sort-select">Sort by:</label>
<div class="relative inline-block">
<select class="appearance-none bg-surface-container-lowest border border-primary pl-4 pr-10 py-2.5 text-body-sm font-title-md text-primary font-bold cursor-pointer rounded-none focus:outline-none hover:bg-surface-container-low transition-colors" id="sort-select">
<option>Recommended</option>
<option>Best Sellers</option>
<option>Price: Low to High</option>
<option>Price: High to Low</option>
<option>Newest Arrivals</option>
</select>
<span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-primary text-[18px]" data-icon="expand_more">expand_more</span>
</div>
</div>
</div>
<!-- TWO COLUMN LAYOUT: Filters & Product Grid -->
<div class="flex flex-col lg:flex-row gap-8 lg:gap-10 items-start">
<!-- LEFT SIDEBAR: Filters & Facets -->
<aside class="w-full lg:w-64 flex-shrink-0">
<!-- CATEGORIES FACET (Collapsible, Expanded) -->
<div class="hairline-b pb-6 mb-6">
<div class="flex items-center justify-between cursor-pointer mb-4">
<h2 class="font-title-lg text-[13px] font-bold uppercase tracking-widest text-primary">CATEGORIES</h2>
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="expand_less">expand_less</span>
</div>
<ul class="space-y-2.5 text-body-sm text-on-surface-variant font-body-sm">
<li class="flex justify-between items-center hover:text-primary cursor-pointer transition-colors">
<span class="hover:font-semibold">Moisturizers</span>
<span class="text-outline text-[11px]">(340)</span>
</li>
<li class="flex justify-between items-center hover:text-primary cursor-pointer transition-colors">
<span class="hover:font-semibold">Cleansers</span>
<span class="text-outline text-[11px]">(215)</span>
</li>
<li class="flex justify-between items-center hover:text-primary cursor-pointer transition-colors">
<span class="hover:font-semibold">Serums &amp; Face Oils</span>
<span class="text-outline text-[11px]">(280)</span>
</li>
<li class="flex justify-between items-center hover:text-primary cursor-pointer transition-colors">
<span class="hover:font-semibold">Eye Cream</span>
<span class="text-outline text-[11px]">(95)</span>
</li>
<li class="flex justify-between items-center hover:text-primary cursor-pointer transition-colors">
<span class="hover:font-semibold">Masks</span>
<span class="text-outline text-[11px]">(140)</span>
</li>
<li class="flex justify-between items-center hover:text-primary cursor-pointer transition-colors">
<span class="hover:font-semibold">Suncare</span>
<span class="text-outline text-[11px]">(85)</span>
</li>
<li class="flex justify-between items-center hover:text-primary cursor-pointer transition-colors">
<span class="hover:font-semibold">Lip Care</span>
<span class="text-outline text-[11px]">(72)</span>
</li>
<li class="flex justify-between items-center hover:text-primary cursor-pointer transition-colors">
<span class="hover:font-semibold">Sets &amp; Travel Size</span>
<span class="text-outline text-[11px]">(93)</span>
</li>
</ul>
</div>
<!-- REFINE SECTION -->
<div class="hairline-b pb-6 mb-6">
<div class="flex items-center justify-between mb-4">
<h2 class="font-title-lg text-[13px] font-bold uppercase tracking-widest text-primary">REFINE</h2>
<button class="font-label-caps text-label-caps underline uppercase text-outline hover:text-primary transition-colors">Clear All</button>
</div>
<!-- Sephora Exclusive Toggle -->
<div class="flex items-center justify-between py-2 border-b border-surface-container-high mb-4">
<span class="font-title-md text-[13px] font-semibold text-primary">Sephora Exclusive Only</span>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-9 h-5 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
<!-- BRAND (Expanded) -->
<div class="mb-5">
<div class="flex items-center justify-between cursor-pointer mb-3">
<span class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">BRAND</span>
<span class="material-symbols-outlined text-[18px]" data-icon="expand_less">expand_less</span>
</div>
<div class="space-y-2.5 max-h-48 overflow-y-auto pr-1">
<label class="flex items-center justify-between text-body-sm cursor-pointer group">
<span class="flex items-center gap-2.5">
<input checked="" class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0 cursor-pointer" type="checkbox"/>
<span class="group-hover:text-primary font-medium">Glow Recipe</span>
</span>
<span class="text-outline text-[11px]">(24)</span>
</label>
<label class="flex items-center justify-between text-body-sm cursor-pointer group">
<span class="flex items-center gap-2.5">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0 cursor-pointer" type="checkbox"/>
<span class="group-hover:text-primary">The Ordinary</span>
</span>
<span class="text-outline text-[11px]">(38)</span>
</label>
<label class="flex items-center justify-between text-body-sm cursor-pointer group">
<span class="flex items-center gap-2.5">
<input checked="" class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0 cursor-pointer" type="checkbox"/>
<span class="group-hover:text-primary font-medium">Drunk Elephant</span>
</span>
<span class="text-outline text-[11px]">(29)</span>
</label>
<label class="flex items-center justify-between text-body-sm cursor-pointer group">
<span class="flex items-center gap-2.5">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0 cursor-pointer" type="checkbox"/>
<span class="group-hover:text-primary">Laneige</span>
</span>
<span class="text-outline text-[11px]">(18)</span>
</label>
<label class="flex items-center justify-between text-body-sm cursor-pointer group">
<span class="flex items-center gap-2.5">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0 cursor-pointer" type="checkbox"/>
<span class="group-hover:text-primary">Tatcha</span>
</span>
<span class="text-outline text-[11px]">(22)</span>
</label>
<label class="flex items-center justify-between text-body-sm cursor-pointer group">
<span class="flex items-center gap-2.5">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0 cursor-pointer" type="checkbox"/>
<span class="group-hover:text-primary">Kiehl's</span>
</span>
<span class="text-outline text-[11px]">(31)</span>
</label>
<label class="flex items-center justify-between text-body-sm cursor-pointer group">
<span class="flex items-center gap-2.5">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0 cursor-pointer" type="checkbox"/>
<span class="group-hover:text-primary">Caudalie</span>
</span>
<span class="text-outline text-[11px]">(27)</span>
</label>
<label class="flex items-center justify-between text-body-sm cursor-pointer group">
<span class="flex items-center gap-2.5">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0 cursor-pointer" type="checkbox"/>
<span class="group-hover:text-primary">Paula's Choice</span>
</span>
<span class="text-outline text-[11px]">(16)</span>
</label>
</div>
</div>
<!-- SKIN CONCERN (Dropdown/Expanded) -->
<div class="mb-5">
<div class="flex items-center justify-between cursor-pointer mb-3">
<span class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">SKIN CONCERN</span>
<span class="material-symbols-outlined text-[18px]" data-icon="expand_less">expand_less</span>
</div>
<div class="space-y-2 text-body-sm">
<div class="flex justify-between items-center hover:text-primary cursor-pointer">
<span>Dryness &amp; Dehydration</span>
<span class="text-outline text-[11px]">(190)</span>
</div>
<div class="flex justify-between items-center hover:text-primary cursor-pointer">
<span>Anti-Aging &amp; Fine Lines</span>
<span class="text-outline text-[11px]">(165)</span>
</div>
<div class="flex justify-between items-center hover:text-primary cursor-pointer">
<span>Dark Spots &amp; Hyperpigmentation</span>
<span class="text-outline text-[11px]">(110)</span>
</div>
<div class="flex justify-between items-center hover:text-primary cursor-pointer">
<span>Acne &amp; Blemish</span>
<span class="text-outline text-[11px]">(95)</span>
</div>
<div class="flex justify-between items-center hover:text-primary cursor-pointer">
<span>Dullness &amp; Uneven Texture</span>
<span class="text-outline text-[11px]">(145)</span>
</div>
<div class="flex justify-between items-center hover:text-primary cursor-pointer">
<span>Pore Care</span>
<span class="text-outline text-[11px]">(80)</span>
</div>
</div>
</div>
<!-- Other Collapsible Sections -->
<div class="py-3 border-t border-surface-container-high flex items-center justify-between cursor-pointer">
<span class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">PRODUCT TYPE</span>
<span class="material-symbols-outlined text-[18px]" data-icon="expand_more">expand_more</span>
</div>
<div class="py-3 border-t border-surface-container-high flex items-center justify-between cursor-pointer">
<span class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">INGREDIENTS</span>
<span class="material-symbols-outlined text-[18px]" data-icon="expand_more">expand_more</span>
</div>
<div class="py-3 border-t border-surface-container-high flex items-center justify-between cursor-pointer">
<span class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">FORMULATION</span>
<span class="material-symbols-outlined text-[18px]" data-icon="expand_more">expand_more</span>
</div>
<div class="py-3 border-t border-surface-container-high flex items-center justify-between cursor-pointer">
<span class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">PRICE</span>
<span class="material-symbols-outlined text-[18px]" data-icon="expand_more">expand_more</span>
</div>
<div class="py-3 border-t border-surface-container-high flex items-center justify-between cursor-pointer">
<span class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">BENEFITS</span>
<span class="material-symbols-outlined text-[18px]" data-icon="expand_more">expand_more</span>
</div>
</div>
</aside>
<!-- RIGHT MAIN CONTENT: Product Grid (4 columns, 12 items) -->
<section class="flex-1 w-full">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-5">
<!-- PRODUCT CARD 1: Glow Recipe -->
@foreach($products as $products)
<article onclick="window.location='/p/{{ $products->slug }}'" class="bg-surface-container-lowest card-border p-4 flex flex-col justify-between group relative">
<div class="relative">
<!-- Badges -->
<div class="absolute top-0 left-0 flex flex-col gap-1 z-10">
@if($products->badge)
<span class="bg-primary text-on-primary font-label-tag text-[9px] px-1.5 py-0.5 uppercase tracking-wider font-bold">{{ $products->badge }}</span>
@endif

</div>
<!-- Wishlist Heart -->
<button class="absolute top-0 right-0 z-10 text-on-surface hover:text-secondary p-1" title="Add to Wishlist">
<span class="material-symbols-outlined text-[20px]" data-icon="favorite_border">favorite_border</span>
</button>
<!-- Packshot Image -->
<div class="w-full aspect-square overflow-hidden mb-4 bg-surface-container-low flex items-center justify-center">
<img alt="{{ $products->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ media_url($products->first_image) }}"/>
</div>
</div>
<!-- Content Area -->
<div class="flex flex-col flex-1">
<span class="font-label-caps text-label-caps uppercase text-outline tracking-wider font-bold mb-1">{{ $products->brand->name }}
<h3 class="font-title-md text-[14px] text-primary line-clamp-2 leading-tight mb-2 group-hover:underline">{{ $products->name }}</h3>
<!-- Star Rating -->
<div class="flex items-center gap-1.5 mb-3">
@include('components.stars-m3', ['rating' => $products->rating])
<span class="text-outline text-[12px] font-body-sm">({{ number_format($products->reviews_count) }})</span>
</div>
<!-- Price & CTA -->
<div class="mt-auto">
<p class="font-price-aed-lg text-price-aed-lg font-bold text-primary mb-3">AED {{ number_format($products->price, 2) }}</p>
<button class="w-full h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider font-bold hover:bg-surface-container-lowest hover:border hover:border-primary hover:text-primary transition-all duration-150" data-add-to-bag="{{ $products->id }}">
                  ADD TO BAG
                </button>
</div>
</div>
</article>
@endforeach
</div>
<!-- PAGINATION & PROGRESS INDICATOR -->
<div class="mt-12 flex flex-col items-center justify-center text-center">
<p class="font-body-md text-on-surface-variant mb-3">Showing <strong class="text-primary">12</strong> of <strong class="text-primary">1,120</strong> items</p>
<div class="w-64 h-1 bg-surface-container-high overflow-hidden mb-6">
<div class="bg-primary h-full" style="width: 1.07%;"></div>
</div>
<button class="px-10 py-3.5 border border-primary text-primary font-label-caps text-label-caps uppercase tracking-widest font-bold hover:bg-primary hover:text-on-primary transition-all duration-150">
            LOAD MORE PRODUCTS
          </button>
</div>
</section>
</div>
</main>
@endsection
