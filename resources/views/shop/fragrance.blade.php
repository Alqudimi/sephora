@extends('layouts.app')

@section('title', 'Fragrance Luxury Collection | SEPHORA UAE')
@section('body_class', 'bg-surface-container-lowest text-on-surface antialiased font-body-md text-body-md min-h-screen selection:bg-primary selection:text-on-primary')

@section('content')
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- 3. BREADCRUMBS & TITLE HEADER -->
<nav class="flex items-center gap-2 text-outline text-[12px] font-body-sm mb-4">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<span class="text-on-surface font-semibold">Fragrance</span>
</nav>
<div class="flex flex-col md:flex-row md:items-end justify-between border-b border-primary pb-5 mb-8">
<div>
<div class="flex items-baseline gap-3">
<h1 class="font-headline-lg text-headline-lg font-bold tracking-tight text-primary">Fragrance</h1>
<span class="font-body-md text-outline font-normal text-sm">846 items</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1 max-w-xl">
          Immerse yourself in our curated anthology of rare ouds, Parisian florals, and timeless oriental essences from the world's most coveted perfume houses.
        </p>
</div>
<!-- Sort By Dropdown -->
<div class="mt-4 md:mt-0 flex items-center gap-3">
<label class="font-label-caps text-label-caps uppercase text-outline" for="sort-select">Sort by:</label>
<div class="relative">
<select class="appearance-none bg-surface-container-lowest border border-outline pl-3 pr-8 py-2 font-label-caps text-label-caps tracking-wider rounded-none cursor-pointer focus:border-primary focus:ring-0 text-on-surface" id="sort-select">
<option>Recommended</option>
<option>New Arrivals</option>
<option>Price: High to Low</option>
<option>Price: Low to High</option>
<option>Best Sellers</option>
<option>Customer Rating</option>
</select>
<span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none text-[18px]" data-icon="expand_more">expand_more</span>
</div>
</div>
</div>
<!-- 4 & 5. SIDEBAR FILTERS & PRODUCT GRID -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- 4. SIDEBAR FILTERS (Left Column) -->
<aside class="lg:col-span-3 space-y-6">
<!-- Categories List -->
<div class="border border-outline-variant p-5 bg-surface-container-lowest">
<h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-extrabold pb-3 border-b border-surface-container">CATEGORIES</h2>
<ul class="mt-3 space-y-2.5 font-body-sm text-body-sm">
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">For Her</span>
<span class="text-outline text-xs">(420)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">For Him</span>
<span class="text-outline text-xs">(215)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">By Fragrance Family</span>
<span class="text-outline text-xs">(380)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">Niche Collection</span>
<span class="text-outline text-xs">(120)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">Spray Refill Repeat</span>
<span class="text-outline text-xs">(45)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">Home Fragrance</span>
<span class="text-outline text-xs">(32)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">Travel Size</span>
<span class="text-outline text-xs">(88)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">Gift Sets</span>
<span class="text-outline text-xs">(96)</span>
</li>
</ul>
</div>
<!-- Refine Section -->
<div class="border border-outline-variant p-5 bg-surface-container-lowest">
<div class="flex items-center justify-between pb-3 border-b border-surface-container">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-extrabold">REFINE</span>
<button class="font-label-caps text-[10px] tracking-wider text-outline hover:text-secondary underline transition-colors" type="button">Clear All</button>
</div>
<!-- Sephora Exclusive Toggle -->
<div class="flex items-center justify-between py-4 border-b border-surface-container">
<span class="font-body-sm text-body-sm font-semibold text-on-surface">Sephora Exclusive Only</span>
<label class="relative inline-flex items-center cursor-pointer">
<input class="sr-only peer" type="checkbox" value=""/>
<div class="w-9 h-5 bg-surface-container-highest peer-focus:outline-none peer-checked:bg-primary transition-colors"></div>
<div class="absolute left-0.5 top-0.5 w-4 h-4 bg-white transition-transform peer-checked:translate-x-4"></div>
</label>
</div>
<!-- Accordion 1: Brand -->
<details class="group py-3 border-b border-surface-container" open="">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>BRAND</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2 pl-0.5">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input checked="" class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Kayali</span>
<span class="text-outline text-[11px]">(28)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Dior</span>
<span class="text-outline text-[11px]">(42)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input checked="" class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Yves Saint Laurent</span>
<span class="text-outline text-[11px]">(35)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Maison Francis Kurkdjian</span>
<span class="text-outline text-[11px]">(19)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Tom Ford</span>
<span class="text-outline text-[11px]">(24)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Carolina Herrera</span>
<span class="text-outline text-[11px]">(18)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Jean Paul Gaultier</span>
<span class="text-outline text-[11px]">(15)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Rabanne</span>
<span class="text-outline text-[11px]">(17)</span>
</label>
</div>
</details>
<!-- Accordion 2: Fragrance Family -->
<details class="group py-3 border-b border-surface-container" open="">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>FRAGRANCE FAMILY</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Floral</span>
<span class="text-outline text-[11px]">(145)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Woody &amp; Oud</span>
<span class="text-outline text-[11px]">(112)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Amber</span>
<span class="text-outline text-[11px]">(89)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Vanilla</span>
<span class="text-outline text-[11px]">(74)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Fresh</span>
<span class="text-outline text-[11px]">(65)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Fruity</span>
<span class="text-outline text-[11px]">(52)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Musky</span>
<span class="text-outline text-[11px]">(48)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Oriental</span>
<span class="text-outline text-[11px]">(98)</span>
</label>
</div>
</details>
<!-- Accordion 3: Product Type -->
<details class="group py-3 border-b border-surface-container">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>PRODUCT TYPE</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Eau de Parfum</span>
<span class="text-outline text-[11px]">(310)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Eau de Toilette</span>
<span class="text-outline text-[11px]">(140)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Perfume Extract</span>
<span class="text-outline text-[11px]">(42)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Fragrance Mist</span>
<span class="text-outline text-[11px]">(36)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Scented Body Care</span>
<span class="text-outline text-[11px]">(55)</span>
</label>
</div>
</details>
<!-- Accordion 4: Size & Volume -->
<details class="group py-3 border-b border-surface-container">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>SIZE &amp; VOLUME</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 flex flex-wrap gap-2">
<button class="px-3 py-1 border border-outline-variant text-xs hover:border-primary" type="button">30ml</button>
<button class="px-3 py-1 border border-primary bg-primary text-white text-xs" type="button">50ml</button>
<button class="px-3 py-1 border border-outline-variant text-xs hover:border-primary" type="button">70ml</button>
<button class="px-3 py-1 border border-outline-variant text-xs hover:border-primary" type="button">100ml</button>
</div>
</details>
<!-- Accordion 5: Price -->
<details class="group py-3 border-b border-surface-container">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>PRICE</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Under 200 AED</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">200 - 500 AED</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">500 - 1000 AED</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">1000+ AED</span>
</label>
</div>
</details>
<!-- Accordion 6: Benefits / Occasion -->
<details class="group py-3">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>BENEFITS / OCCASION</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Long-Lasting (8h+)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Evening &amp; Galas</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Signature Daily</span>
</label>
</div>
</details>
</div>
</aside>
<!-- 5. PRODUCT GRID (4 Columns, Responsive in 9-col container) -->
<section class="lg:col-span-9" id="fragrance-grid">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
<!-- Card 1: Maison Francis Kurkdjian -->
@foreach($products as $products)
<div class="group relative flex flex-col bg-surface-container-lowest border border-outline-variant hover:border-primary transition-all duration-200">
<div class="relative w-full aspect-square bg-[#fcfbfa] overflow-hidden flex items-center justify-center p-3">
<div class="absolute top-2 left-2 z-10 flex flex-col gap-1 items-start">
@if($products->badge)
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-widest">{{ $products->badge }}</span>
@endif

</div>
<button aria-label="Add to wishlist" class="absolute top-2 right-2 z-10 text-on-surface-variant hover:text-secondary p-1 transition-colors" type="button">
<span class="material-symbols-outlined text-[20px]" data-icon="favorite">favorite</span>
</button>
<img alt="{{ $products->name }}" class="object-contain w-full h-full group-hover:scale-105 transition-transform duration-300" src="{{ media_url($products->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
</div>
<div class="p-3.5 flex flex-col flex-1">
<p class="font-label-caps text-label-caps uppercase text-primary font-bold tracking-wider">{{ $products->brand->name }}
<h3 class="font-body-md text-sm font-medium text-on-surface line-clamp-2 mt-1 min-h-[40px]">{{ $products->name }}</h3>
<div class="flex items-center gap-1.5 my-2">
<div class="flex text-amber-500 text-[14px]">
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-label-tag text-[11px] text-outline">4.9 ({{ number_format($products->reviews_count) }})</span>
</div>
<div class="mt-auto pt-2 border-t border-surface-container flex items-baseline justify-between">
<span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED {{ number_format($products->price, 2) }}</span>
</div>
<button class="mt-3 w-full py-2.5 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-white hover:text-primary hover:border hover:border-primary transition-all duration-150" type="button" data-add-to-bag="{{ $products->id }}">
                ADD TO BAG
              </button>
</div>
</div>
@endforeach
</div>
<!-- 6. PAGINATION & LOAD MORE -->
<div class="mt-12 flex flex-col items-center justify-center text-center">
<p class="font-body-sm text-body-sm text-outline mb-2">Showing 12 of 846 items</p>
<div class="w-64 h-1 bg-surface-container mb-6 overflow-hidden">
<div class="bg-primary h-full w-[20%]"></div>
</div>
<button class="px-10 py-3.5 border-2 border-primary bg-transparent text-primary hover:bg-primary hover:text-white font-label-caps text-label-caps uppercase tracking-widest transition-all duration-200 cursor-pointer" type="button">
            LOAD MORE PRODUCTS
          </button>
</div>
</section>
</div>
<!-- 7. TRUST BADGES (Sephora Signature 4 Columns) -->
<section class="mt-20 pt-10 border-t border-outline-variant grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
<div class="flex flex-col items-center p-4 border border-surface-container bg-surface-container-lowest">
<span class="material-symbols-outlined text-[32px] text-primary mb-2" data-icon="local_shipping">local_shipping</span>
<h4 class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary">FREE DELIVERY</h4>
<p class="font-body-sm text-xs text-outline mt-1">On all orders above AED 250</p>
</div>
<div class="flex flex-col items-center p-4 border border-surface-container bg-surface-container-lowest">
<span class="material-symbols-outlined text-[32px] text-primary mb-2" data-icon="verified">verified</span>
<h4 class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary">100% AUTHENTIC</h4>
<p class="font-body-sm text-xs text-outline mt-1">Direct from certified brands</p>
</div>
<div class="flex flex-col items-center p-4 border border-surface-container bg-surface-container-lowest">
<span class="material-symbols-outlined text-[32px] text-primary mb-2" data-icon="assignment_return">assignment_return</span>
<h4 class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary">EASY RETURNS</h4>
<p class="font-body-sm text-xs text-outline mt-1">In-store across all UAE branches</p>
</div>
<div class="flex flex-col items-center p-4 border border-surface-container bg-surface-container-lowest">
<span class="material-symbols-outlined text-[32px] text-primary mb-2" data-icon="loyalty">loyalty</span>
<h4 class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary">BEAUTY PASS POINTS</h4>
<p class="font-body-sm text-xs text-outline mt-1">Earn points on every dirham spent</p>
</div>
</section>
<!-- 8. NEWSLETTER / VIP BANNER -->
<section class="mt-16 bg-[#111111] text-white p-8 md:p-12 text-center">
<div class="max-w-2xl mx-auto">
<span class="material-symbols-outlined text-[36px] text-white mb-2" data-icon="mail">mail</span>
<h2 class="font-display-hero text-headline-sm uppercase tracking-widest font-bold">STAY CONNECTED WITH SEPHORA</h2>
<p class="font-body-sm text-body-sm text-outline-variant mt-2 mb-6">
          Sign up to receive early access to new launches, gifts with purchase and holiday exclusives.
        </p>
<form class="flex flex-col sm:flex-row gap-2 max-w-md mx-auto" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="flex-1 px-4 py-3 bg-surface-container-lowest text-black rounded-none border border-outline focus:border-white focus:ring-0 text-sm placeholder:text-outline" placeholder="Enter your email address" required="" type="email"/>
<button class="px-8 py-3 bg-white text-black font-label-caps text-label-caps uppercase tracking-widest font-bold hover:bg-neutral-200 transition-colors" type="submit">
            SIGN UP
          </button>
</form>
</div>
</section>
</main>
@endsection
