@extends('layouts.app')

@section('title', 'Makeup Palettes | SEPHORA UAE')
@section('body_class', 'bg-surface-container-lowest text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary min-h-screen flex flex-col')

@section('content')
<main class="flex-1 w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-6">
<!-- Breadcrumb -->
<nav aria-label="Breadcrumb" class="mb-4">
<ol class="flex items-center space-x-2 font-label-caps text-label-caps tracking-widest uppercase text-on-primary-container">
<li><a class="hover:text-primary transition-colors" href="/">Home</a></li>
<li class="select-none">/</li>
<li><a class="hover:text-primary transition-colors" href="/shop/makeup">Makeup</a></li>
<li class="select-none">/</li>
<li class="text-primary font-bold">Makeup Palettes</li>
</ol>
</nav>
<!-- 4. Category Title, Description & Sort Bar -->
<div class="border-b border-primary pb-6 mb-8">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<h1 class="font-display-hero text-headline-lg text-primary uppercase font-bold tracking-tight">
            Makeup Palettes 
            <span class="font-body-md text-title-md font-normal text-on-surface-variant ml-2 tracking-normal lowercase">(148 items)</span>
</h1>
<p class="font-body-md text-body-md text-on-surface-variant max-w-3xl mt-2">
            Curate your signature looks with all-in-one eyeshadow, contour, blush, and highlighting palettes from world-renowned beauty houses.
          </p>
</div>
<!-- Sort Control -->
<div class="flex items-center gap-2 self-start md:self-end">
<label class="font-label-caps text-label-caps uppercase text-primary font-bold whitespace-nowrap" for="sort-select">SORT BY:</label>
<div class="relative">
<select class="font-body-sm text-body-sm bg-surface-container-lowest border border-outline-variant py-2 pl-3 pr-8 rounded-none text-primary font-medium focus:border-primary focus:ring-0 appearance-none cursor-pointer" id="sort-select">
<option>Recommended</option>
<option>New Arrivals</option>
<option>Best Sellers</option>
<option>Price: Low to High</option>
<option>Price: High to Low</option>
<option>Customer Rating</option>
</select>
<span class="material-symbols-outlined pointer-events-none absolute right-2 top-2.5 text-[18px] text-primary">expand_more</span>
</div>
</div>
</div>
</div>
<!-- Layout Grid: 5. Left Sidebar + 6. Main 4-Column Product Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- 5. Left Filter Sidebar (3 Columns on Large Screen) -->
<aside class="lg:col-span-3 space-y-6">
<!-- Filter Header & Refine Actions -->
<div class="flex items-center justify-between pb-3 border-b border-primary">
<h2 class="font-title-lg text-title-lg uppercase tracking-wider text-primary">Filter By</h2>
<button class="font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant hover:text-secondary underline decoration-1">Clear All</button>
</div>
<!-- Sephora Exclusive Toggle -->
<div class="flex items-center justify-between p-3 bg-surface-container-low border border-surface-container">
<span class="font-title-md text-title-md text-primary font-bold">Sephora Exclusive Only</span>
<label class="relative inline-flex items-center cursor-pointer">
<input class="sr-only peer" type="checkbox"/>
<div class="w-9 h-5 bg-outline-variant peer-focus:outline-none rounded-none peer-checked:bg-primary transition-colors after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
</label>
</div>
<!-- CATEGORIES Accordion -->
<div class="border-b border-surface-container pb-5">
<h3 class="font-label-caps text-label-caps uppercase tracking-widest text-primary mb-3 font-bold">CATEGORIES</h3>
<ul class="space-y-2 font-body-sm text-body-sm">
<li class="flex items-center justify-between">
<a class="text-primary font-semibold hover:underline" href="{{ route('shop.category', ['slug' => 'makeup-palettes']) }}">Eye Palettes</a>
<span class="text-on-surface-variant">(68)</span>
</li>
<li class="flex items-center justify-between">
<a class="text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'makeup-palettes']) }}">Face Palettes</a>
<span class="text-on-surface-variant">(44)</span>
</li>
<li class="flex items-center justify-between">
<a class="text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'makeup-palettes']) }}">Cheek &amp; Blush Palettes</a>
<span class="text-on-surface-variant">(22)</span>
</li>
<li class="flex items-center justify-between">
<a class="text-on-surface-variant hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => 'makeup-palettes']) }}">Multi-Use &amp; Vault Sets</a>
<span class="text-on-surface-variant">(14)</span>
</li>
</ul>
</div>
<!-- BRAND Filter -->
<div class="border-b border-surface-container pb-5">
<h3 class="font-label-caps text-label-caps uppercase tracking-widest text-primary mb-3 font-bold">BRAND</h3>
<div class="relative mb-3">
<input class="w-full text-xs py-1.5 px-3 border border-outline-variant rounded-none focus:border-primary focus:ring-0" placeholder="Search brand..." type="text"/>
</div>
<div class="space-y-2 max-h-48 overflow-y-auto pr-1">
<label class="flex items-center justify-between text-body-sm text-on-surface hover:text-primary cursor-pointer">
<span class="flex items-center gap-2">
<input checked="" class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Huda Beauty</span>
</span>
<span class="text-outline text-xs">(18)</span>
</label>
<label class="flex items-center justify-between text-body-sm text-on-surface hover:text-primary cursor-pointer">
<span class="flex items-center gap-2">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Dior</span>
</span>
<span class="text-outline text-xs">(12)</span>
</label>
<label class="flex items-center justify-between text-body-sm text-on-surface hover:text-primary cursor-pointer">
<span class="flex items-center gap-2">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Patrick Ta</span>
</span>
<span class="text-outline text-xs">(10)</span>
</label>
<label class="flex items-center justify-between text-body-sm text-on-surface hover:text-primary cursor-pointer">
<span class="flex items-center gap-2">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Anastasia Beverly Hills</span>
</span>
<span class="text-outline text-xs">(14)</span>
</label>
<label class="flex items-center justify-between text-body-sm text-on-surface hover:text-primary cursor-pointer">
<span class="flex items-center gap-2">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Tarte</span>
</span>
<span class="text-outline text-xs">(16)</span>
</label>
<label class="flex items-center justify-between text-body-sm text-on-surface hover:text-primary cursor-pointer">
<span class="flex items-center gap-2">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Natasha Denona</span>
</span>
<span class="text-outline text-xs">(12)</span>
</label>
<label class="flex items-center justify-between text-body-sm text-on-surface hover:text-primary cursor-pointer">
<span class="flex items-center gap-2">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Benefit Cosmetics</span>
</span>
<span class="text-outline text-xs">(8)</span>
</label>
<label class="flex items-center justify-between text-body-sm text-on-surface hover:text-primary cursor-pointer">
<span class="flex items-center gap-2">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Sephora Collection</span>
</span>
<span class="text-outline text-xs">(24)</span>
</label>
</div>
</div>
<!-- PALETTE TYPE -->
<div class="border-b border-surface-container pb-5">
<h3 class="font-label-caps text-label-caps uppercase tracking-widest text-primary mb-3 font-bold">PALETTE TYPE</h3>
<div class="flex flex-wrap gap-1.5">
<button class="px-2.5 py-1 text-xs border border-primary bg-primary text-on-primary font-medium">Eyeshadow</button>
<button class="px-2.5 py-1 text-xs border border-outline-variant hover:border-primary text-on-surface transition-colors">Complexion</button>
<button class="px-2.5 py-1 text-xs border border-outline-variant hover:border-primary text-on-surface transition-colors">Contour &amp; Highlight</button>
</div>
</div>
<!-- FINISH -->
<div class="border-b border-surface-container pb-5">
<h3 class="font-label-caps text-label-caps uppercase tracking-widest text-primary mb-3 font-bold">FINISH</h3>
<div class="space-y-1.5">
<label class="flex items-center gap-2 text-body-sm text-on-surface cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Matte</span>
</label>
<label class="flex items-center gap-2 text-body-sm text-on-surface cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Shimmer</span>
</label>
<label class="flex items-center gap-2 text-body-sm text-on-surface cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Metallic</span>
</label>
<label class="flex items-center gap-2 text-body-sm text-on-surface cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Glitter</span>
</label>
<label class="flex items-center gap-2 text-body-sm text-on-surface cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Satin</span>
</label>
</div>
</div>
<!-- FORMULATION -->
<div class="border-b border-surface-container pb-5">
<h3 class="font-label-caps text-label-caps uppercase tracking-widest text-primary mb-3 font-bold">FORMULATION</h3>
<div class="space-y-1.5">
<label class="flex items-center gap-2 text-body-sm text-on-surface cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Pressed Powder</span>
</label>
<label class="flex items-center gap-2 text-body-sm text-on-surface cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Cream-to-Powder</span>
</label>
<label class="flex items-center gap-2 text-body-sm text-on-surface cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Baked</span>
</label>
</div>
</div>
<!-- PRICE RANGE -->
<div>
<h3 class="font-label-caps text-label-caps uppercase tracking-widest text-primary mb-3 font-bold">PRICE RANGE</h3>
<div class="flex items-center gap-2">
<input class="w-1/2 text-xs py-1.5 px-2 border border-outline-variant rounded-none text-center" placeholder="AED 40" type="text"/>
<span class="text-outline">-</span>
<input class="w-1/2 text-xs py-1.5 px-2 border border-outline-variant rounded-none text-center" placeholder="AED 500" type="text"/>
</div>
<button class="w-full mt-2 py-1.5 bg-surface-container-high hover:bg-primary hover:text-on-primary transition-colors text-xs font-bold tracking-widest uppercase">Apply</button>
</div>
</aside>
<!-- 6. Main Product Grid (9 Columns on Large Screen -> 4 Columns Product Layout) -->
<section aria-label="Product Showcase" class="lg:col-span-9">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-8">
<!-- Card 1: HUDA BEAUTY -->
@foreach($products as $products)
<article onclick="window.location='/p/{{ $products->slug }}'" class="product-card group flex flex-col justify-between border border-surface-container hover:border-primary transition-all p-3 relative bg-surface-container-lowest">
<div>
<div class="relative w-full aspect-square bg-surface-container-low overflow-hidden product-image-container flex items-center justify-center p-3 mb-3">
<!-- Badges -->
<div class="absolute top-2 left-2 z-10 flex flex-col gap-1">
@if($products->badge)
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-1.5 py-0.5 uppercase tracking-wider font-bold">{{ $products->badge }}</span>
@endif

</div>
<!-- Wishlist button -->
<button aria-label="Add to Wishlist" class="absolute top-2 right-2 z-10 text-on-surface-variant hover:text-secondary p-1 bg-surface-container-lowest/80 backdrop-blur-sm transition-colors">
<span class="material-symbols-outlined text-[18px]">favorite</span>
</button>
<img alt="{{ $products->name }}" class="w-full h-full object-contain" src="{{ media_url($products->first_image) }}"/>
</div>
<div class="space-y-1">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant block font-bold">{{ $products->brand->name }}
<h3 class="font-title-md text-title-md text-primary font-semibold line-clamp-2 leading-tight">{{ $products->name }}</h3>
<!-- Rating -->
<div class="flex items-center gap-1 pt-1">
@include('components.stars-m3', ['rating' => $products->rating])
<span class="font-body-sm text-body-sm font-semibold text-primary">{{ $products->rating }}</span>
<span class="text-on-surface-variant text-xs">({{ number_format($products->reviews_count) }})</span>
</div>
</div>
</div>
<div class="mt-4 pt-2 border-t border-surface-container">
<div class="font-price-aed-lg text-price-aed-lg text-primary mb-3">AED {{ number_format($products->price, 2) }}</div>
<button class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-transparent font-label-caps text-label-caps uppercase tracking-widest py-3 font-bold transition-all duration-150" data-add-to-bag="{{ $products->id }}">
                ADD TO BAG
              </button>
</div>
</article>
@endforeach
</div>
<!-- 7. Pagination / Load More -->
<div class="mt-14 mb-8 flex flex-col items-center justify-center space-y-4 text-center">
<p class="font-body-sm text-body-sm text-on-surface-variant">Showing 12 of 148 items</p>
<div class="w-48 h-1 bg-surface-container overflow-hidden">
<div class="w-1/12 h-full bg-primary"></div>
</div>
<button class="mt-2 px-10 py-3.5 border-2 border-primary text-primary hover:bg-primary hover:text-on-primary font-label-caps text-label-caps uppercase tracking-widest font-bold transition-all duration-200">
            LOAD MORE PRODUCTS
          </button>
</div>
</section>
</div>
<!-- 8. Sephora UAE Trust Badges -->
<section aria-label="Customer Commitments" class="mt-16 pt-12 pb-12 border-t border-b border-surface-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
<div class="flex flex-col items-center p-4">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">local_shipping</span>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">FREE DELIVERY</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">On all orders above AED 250 across UAE</p>
</div>
<div class="flex flex-col items-center p-4">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">verified</span>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">100% AUTHENTIC</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Direct from official certified luxury houses</p>
</div>
<div class="flex flex-col items-center p-4">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">replay</span>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">EASY RETURNS</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">In-store returns across all UAE branches</p>
</div>
<div class="flex flex-col items-center p-4">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">card_membership</span>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">BEAUTY PASS POINTS</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Earn points on every single dirham spent</p>
</div>
</section>
<!-- 9. Newsletter Section -->
<section aria-label="Newsletter" class="my-16 bg-surface-container-low border border-surface-container p-8 md:p-12 text-center max-w-4xl mx-auto">
<h3 class="font-display-hero text-headline-sm uppercase tracking-wider font-bold text-primary mb-2">STAY CONNECTED WITH SEPHORA</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 max-w-xl mx-auto">
        Be the first to discover exclusive masterclasses, VIP product drops, and bespoke beauty perks delivered straight to your inbox.
      </p>
<form class="flex flex-col sm:flex-row items-center justify-center gap-0 max-w-md mx-auto" onsubmit="event.preventDefault()" data-newsletter-form>
<input class="w-full py-3 px-4 bg-surface-container-lowest border border-outline-variant font-body-sm text-body-sm focus:border-primary focus:ring-0 rounded-none" placeholder="Enter your email address" required="" type="email"/>
<button class="w-full sm:w-auto bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-transparent font-label-caps text-label-caps uppercase tracking-widest px-8 py-3 whitespace-nowrap font-bold transition-all" type="submit">
          SIGN UP
        </button>
</form>
</section>
</main>
@endsection
