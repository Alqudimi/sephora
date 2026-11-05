@extends('layouts.app')

@section('title', 'Face Makeup - Foundation, Concealer, Blush & Powder | SEPHORA UAE')
@section('body_class', 'bg-surface-container-lowest text-on-surface antialiased font-body-md text-body-md min-h-screen flex flex-col')

@section('content')
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8 flex-1">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
<!-- 4. Left Sidebar (Categories & Refinements) -->
<aside class="lg:col-span-3 space-y-6">
<!-- Categories Accordion (Open) -->
<div class="border-b border-outline-variant pb-6">
<div class="flex items-center justify-between mb-4 cursor-pointer">
<h2 class="font-title-lg text-title-lg uppercase tracking-wider text-primary">Categories</h2>
<span class="material-symbols-outlined text-lg" data-icon="expand_less">expand_less</span>
</div>
<ul class="space-y-2.5 text-body-md font-body-md">
<li>
<a class="flex justify-between items-center text-primary font-bold hover:text-secondary transition-colors" href="{{ route('shop.category', ['slug' => 'face']) }}">
<span>Foundation</span>
<span class="text-outline text-body-sm">(142)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'face']) }}">
<span>Concealers &amp; Correctors</span>
<span class="text-outline text-body-sm">(88)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'face']) }}">
<span>Powder</span>
<span class="text-outline text-body-sm">(54)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'face']) }}">
<span>Blush</span>
<span class="text-outline text-body-sm">(62)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'face']) }}">
<span>Primer &amp; Setting Spray</span>
<span class="text-outline text-body-sm">(45)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'face']) }}">
<span>Highlighters</span>
<span class="text-outline text-body-sm">(38)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'face']) }}">
<span>Bronzer &amp; Contour</span>
<span class="text-outline text-body-sm">(29)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'face']) }}">
<span>Tinted Moisturizer &amp; BB Cream</span>
<span class="text-outline text-body-sm">(18)</span>
</a>
</li>
<li>
<a class="flex justify-between items-center text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'face']) }}">
<span>Face Palette</span>
<span class="text-outline text-body-sm">(22)</span>
</a>
</li>
</ul>
</div>
<!-- Refine Section -->
<div class="space-y-6">
<div class="flex items-center justify-between">
<h3 class="font-title-lg text-title-lg uppercase tracking-wider text-primary">REFINE</h3>
<button class="font-label-caps text-label-caps uppercase text-outline underline hover:text-primary transition-colors">
              Clear All
            </button>
</div>
<!-- Sephora Exclusive Toggle -->
<div class="flex items-center justify-between p-3 bg-surface-container-low border border-outline-variant/60">
<span class="font-title-md text-title-md text-primary">Sephora Exclusive Only</span>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox"/>
<div class="w-11 h-6 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
<!-- Brand Filter Section -->
<div class="border-b border-outline-variant pb-6">
<div class="flex items-center justify-between mb-3 cursor-pointer">
<span class="font-title-md text-title-md uppercase tracking-wider text-primary">Brand</span>
<span class="material-symbols-outlined text-sm" data-icon="remove">remove</span>
</div>
<!-- Search Inside Brands -->
<div class="relative mb-3">
<input class="w-full text-body-sm font-body-sm py-1.5 px-3 bg-surface-container-lowest border border-outline-variant focus:border-primary outline-none" placeholder="Search Brand..." type="text"/>
</div>
<div class="space-y-2 max-h-52 overflow-y-auto custom-scrollbar pr-1">
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input checked="" class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-primary font-medium">Huda Beauty (28)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input checked="" class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-primary font-medium">Patrick Ta (19)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">Too Faced (34)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">Benefit Cosmetics (42)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">NARS (48)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">Haus Labs (14)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">e.l.f. Cosmetics (25)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">Kosas (11)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">Clarins (22)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">Bobbi Brown (31)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">Saie (9)</span>
</label>
<label class="flex items-center gap-2.5 text-body-sm cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="text-on-surface-variant">Dior (37)</span>
</label>
</div>
</div>
<!-- Collapsible Accordions: Product Type, Coverage, Finish, Formulation, Benefits, Price -->
<div class="border-b border-outline-variant pb-4">
<button class="w-full flex items-center justify-between text-left font-title-md text-title-md uppercase tracking-wider text-primary py-2 hover:opacity-80">
<span>Product Type</span>
<span class="material-symbols-outlined text-sm" data-icon="add">add</span>
</button>
</div>
<div class="border-b border-outline-variant pb-4">
<button class="w-full flex items-center justify-between text-left font-title-md text-title-md uppercase tracking-wider text-primary py-2 hover:opacity-80">
<span>Coverage</span>
<span class="material-symbols-outlined text-sm" data-icon="add">add</span>
</button>
</div>
<div class="border-b border-outline-variant pb-4">
<button class="w-full flex items-center justify-between text-left font-title-md text-title-md uppercase tracking-wider text-primary py-2 hover:opacity-80">
<span>Finish</span>
<span class="material-symbols-outlined text-sm" data-icon="add">add</span>
</button>
</div>
<div class="border-b border-outline-variant pb-4">
<button class="w-full flex items-center justify-between text-left font-title-md text-title-md uppercase tracking-wider text-primary py-2 hover:opacity-80">
<span>Formulation</span>
<span class="material-symbols-outlined text-sm" data-icon="add">add</span>
</button>
</div>
<div class="border-b border-outline-variant pb-4">
<button class="w-full flex items-center justify-between text-left font-title-md text-title-md uppercase tracking-wider text-primary py-2 hover:opacity-80">
<span>Benefits</span>
<span class="material-symbols-outlined text-sm" data-icon="add">add</span>
</button>
</div>
<div class="border-b border-outline-variant pb-4">
<button class="w-full flex items-center justify-between text-left font-title-md text-title-md uppercase tracking-wider text-primary py-2 hover:opacity-80">
<span>Price</span>
<span class="material-symbols-outlined text-sm" data-icon="add">add</span>
</button>
</div>
</div>
</aside>
<!-- 5. Product Grid (4 Columns on Desktop, 2 on Mobile) -->
<section class="lg:col-span-9">
<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
<!-- Card 1 -->
@foreach($products as $products)
<article onclick="window.location='/p/{{ $products->slug }}'" class="group relative flex flex-col justify-between bg-surface-container-lowest border border-outline-variant/60 hover:border-primary transition-all p-3">
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low mb-3">
<img alt="{{ $products->name }}" class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform duration-300" src="{{ media_url($products->first_image) }}"/>
<div class="absolute top-1 left-1 flex flex-col gap-1 z-10">
@if($products->badge)
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-1.5 py-0.5 tracking-wider uppercase">{{ $products->badge }}</span>
@endif

</div>
<button class="absolute top-1 right-1 p-1 text-primary hover:text-secondary transition-colors" title="Add to Wishlist">
<span class="material-symbols-outlined text-xl" data-icon="favorite">favorite</span>
</button>
</div>
<div class="flex-1 flex flex-col">
<h4 class="font-title-md text-title-md font-bold text-primary uppercase tracking-wider">{{ $products->brand->name }}
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mt-0.5 min-h-[36px]">Matte &amp; Glow Bronze Filter 4-Pan Palette</p>
<div class="flex items-center gap-1.5 my-1.5">
<span class="text-xs text-primary font-bold">@include('components.stars', ['rating' => $products->rating]) 4.8</span>
<span class="text-outline text-xs">({{ number_format($products->reviews_count) }})</span>
</div>
<p class="font-price-aed-lg text-price-aed-lg text-primary mt-auto">AED {{ number_format($products->price, 2) }}</p>
</div>
<button class="w-full mt-3 py-2.5 bg-primary text-on-primary font-label-caps text-label-caps tracking-widest uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" data-add-to-bag="{{ $products->id }}">
              ADD TO BAG
            </button>
</article>
@endforeach
</div>
<!-- 6. Pagination & Progress -->
<div class="mt-12 flex flex-col items-center justify-center space-y-4">
<p class="font-body-sm text-body-sm text-outline tracking-wider">Showing 16 of 412 items</p>
<div class="w-64 h-1 bg-surface-container-highest rounded-full overflow-hidden">
<div class="w-[4%] h-full bg-primary"></div>
</div>
<button class="px-8 py-3 rounded-full border border-primary text-primary font-title-md text-title-md uppercase tracking-wider hover:bg-primary hover:text-on-primary transition-colors cursor-pointer mt-2">
            LOAD MORE PRODUCTS
          </button>
</div>
</section>
</div>
</main>
@endsection
