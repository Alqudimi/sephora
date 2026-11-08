@extends('layouts.app')

@section('title', 'SEPHORA UAE | Makeup, Skincare, Fragrance & More')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-3 sm:py-5 space-y-8 sm:space-y-12">

    <!-- BEGIN: HeroCarouselBanner -->
    @php
        $heroSlides = [
            [
                'badge' => 'LIMITED EDITION',
                'title' => "The Holiday Collection\nDropped Early",
                'subtext' => 'Be the first to shop exclusive holiday beauty vaults, festive kits & limited-edition sets.',
                'cta' => '/shop/gifts',
                'cta_label' => 'Shop Holiday Collection',
                'image' => 'images/hero/luxury_black_and_white_striped_sephora_gift_card_on_an_elegant_sleek_marble.webp',
                'alt' => 'The Holiday Collection at Sephora UAE',
            ],
            [
                'badge' => 'SIGNATURE SCENTS',
                'title' => "Stack Your Scent:\nLayer Without Limits",
                'subtext' => 'Fruity Gourmands, Skin Musks & Lavender Blends. Discover your bespoke fragrance trail.',
                'cta' => '/shop/fragrance',
                'cta_label' => 'Explore Fragrances',
                'image' => 'images/hero/luxury_bottle_of_kayali_vanilla_28_or_yum_pistachio_gelato_perfume_high_end.webp',
                'alt' => 'Stack Your Scent at Sephora UAE',
            ],
            [
                'badge' => 'NEW & VIRAL',
                'title' => "New In Beauty:\nIconic Launches",
                'subtext' => 'The hottest drops from Haus Labs, Huda Beauty, Kayali & Fenty Beauty have arrived.',
                'cta' => '/shop/new',
                'cta_label' => 'Discover Newness',
                'image' => 'images/hero/modern_luxury_sephora_beauty_flagship_store_interior_sleek_monochrome_black_and.webp',
                'alt' => 'New In Beauty - Sephora UAE Flagship',
            ],
            [
                'badge' => 'PRESTIGE ESSENTIALS',
                'title' => "Sephora Collection:\nHigh Performance",
                'subtext' => 'Accessible luxury, clean pigments and clinical skincare formulas loved by millions.',
                'cta' => '/shop/sephora-collection',
                'cta_label' => 'Shop Sephora Collection',
                'image' => 'images/hero/anastasia_beverly_hills_modern_renaissance_or_glam_eyeshadow_palette_open.webp',
                'alt' => 'Sephora Collection Makeup & Skincare',
            ],
        ];
    @endphp
    <section aria-label="Featured collections" aria-roledescription="carousel" class="relative rounded-sm overflow-hidden shadow-sm bg-neutral-900" data-autoplay="5000" data-carousel data-purpose="hero-banner">
        <div class="relative w-full min-h-[340px] sm:min-h-[420px] md:min-h-[480px]">
            @foreach ($heroSlides as $index => $slide)
                <article
                    aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                    aria-label="{{ $index + 1 }} of {{ count($heroSlides) }}"
                    aria-roledescription="slide"
                    class="absolute inset-0 flex items-center transition-opacity duration-700 ease-out {{ $index === 0 ? 'is-active opacity-100' : 'opacity-0 pointer-events-none' }}"
                    data-carousel-slide
                    @if ($index !== 0) inert @endif
                >
                    <img alt="{{ $slide['alt'] }}" class="absolute inset-0 w-full h-full object-cover object-center" src="{{ media_url($slide['image']) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent md:bg-gradient-to-r md:from-black/90 md:via-black/60 md:to-transparent"></div>
                    <div class="relative z-10 w-full max-w-3xl p-6 sm:p-10 md:p-14 text-white space-y-3 sm:space-y-4">
                        <span class="inline-block bg-white text-black text-[10px] sm:text-xs font-black px-2.5 py-1 uppercase tracking-widest rounded-sm">
                            {{ $slide['badge'] }}
                        </span>
                        <h1 class="text-2xl sm:text-4xl md:text-5xl font-extrabold tracking-tight leading-tight uppercase font-sans">
                            {!! nl2br(e($slide['title'])) !!}
                        </h1>
                        <p class="text-xs sm:text-sm md:text-base text-neutral-200 font-normal max-w-xl leading-relaxed">
                            {{ $slide['subtext'] }}
                        </p>
                        <div class="pt-2 sm:pt-4">
                            <a class="inline-block bg-white hover:bg-neutral-200 text-black px-7 sm:px-9 py-3 text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-200 shadow-md rounded-sm" href="{{ $slide['cta'] }}">
                                {{ $slide['cta_label'] }} &rarr;
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach

            <button aria-label="Previous slide" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-black shadow-md hover:bg-white transition-colors" data-carousel-prev type="button">
                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" stroke-width="2.5" viewbox="0 0 24 24">
                    <path d="M15 5l-7 7 7 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
            <button aria-label="Next slide" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-black shadow-md hover:bg-white transition-colors" data-carousel-next type="button">
                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" stroke-width="2.5" viewbox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>
    </section>
    <!-- END: HeroCarouselBanner -->

    <!-- BEGIN: CategoryRoundels (Circular Visual Navigation) -->
    @php
        $categoryRoundels = [
            ['name' => 'Makeup', 'url' => '/shop/makeup', 'image' => 'images/hero/anastasia_beverly_hills_modern_renaissance_or_glam_eyeshadow_palette_open.webp'],
            ['name' => 'Fragrance', 'url' => '/shop/fragrance', 'image' => 'images/hero/dior_sauvage_eau_de_parfum_bottle_luxury_studio_product_photography_on_solid.webp'],
            ['name' => 'Skincare', 'url' => '/shop/skincare', 'image' => 'images/hero/drunk_elephant_protini_polypeptide_cream_teal_and_white_jar_luxury_skincare.webp'],
            ['name' => 'Hair', 'url' => '/shop/hair', 'image' => 'images/hero/gisou_honey_infused_hair_oil_luxury_glass_dropper_bottle_with_golden_honey_oil.webp'],
            ['name' => 'Bath & Body', 'url' => '/shop/bath-body', 'image' => 'images/hero/sol_de_janeiro_brazilian_bum_bum_cream_vibrant_yellow_jar_with_white_cap_luxury.webp'],
            ['name' => 'Sephora Collection', 'url' => '/shop/sephora-collection', 'image' => 'images/hero/laneige_lip_sleeping_mask_berry_pink_jar_container_with_lid_luxury_studio.webp'],
            ['name' => 'Beauty Offers', 'url' => '/beauty-offers', 'image' => 'images/hero/luxury_beauty_services_at_sephora_professional_makeup_artist_applying_glam.webp'],
            ['name' => 'Gifts & Minis', 'url' => '/shop/gifts', 'image' => 'images/hero/luxury_black_and_white_striped_sephora_gift_card_on_an_elegant_sleek_marble.webp'],
        ];
    @endphp
    <section aria-label="Shop by category" class="py-2" data-purpose="category-roundels">
        <div class="grid grid-cols-4 md:grid-cols-8 gap-3 sm:gap-4 md:gap-6 text-center">
            @foreach ($categoryRoundels as $cat)
                <a href="{{ $cat['url'] }}" class="group flex flex-col items-center gap-2">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-full overflow-hidden bg-neutral-100 border-2 border-transparent group-hover:border-black transition-all duration-200 shadow-sm flex items-center justify-center p-1.5 sm:p-2">
                        <img src="{{ media_url($cat['image']) }}" alt="{{ $cat['name'] }}" class="w-full h-full object-cover rounded-full group-hover:scale-110 transition-transform duration-300" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-neutral-800 uppercase tracking-tight group-hover:text-black transition-colors text-center leading-tight">
                        {{ $cat['name'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </section>
    <!-- END: CategoryRoundels -->

    <!-- BEGIN: MemberPerkBanner -->
    <section class="bg-[#faf8f5] rounded-sm border border-neutral-200 p-4 sm:p-5 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm" data-purpose="member-perks">
        <div class="flex items-center gap-3.5 sm:gap-4 text-center md:text-left">
            <div class="w-12 h-12 sm:w-14 sm:h-14 shrink-0 rounded-sm bg-black text-white p-1.5 flex flex-col justify-around items-center shadow-md">
                <span class="text-[9px] font-black tracking-widest uppercase">BEAUTY</span>
                <div class="w-8 h-0.5 bg-white"></div>
                <span class="text-[9px] font-black tracking-widest uppercase">PASS</span>
            </div>
            <div>
                <h2 class="text-sm sm:text-base md:text-lg font-bold text-black tracking-tight">Sign in for exclusive Beauty Pass perks!</h2>
                <p class="text-xs sm:text-sm text-neutral-600 mt-0.5">Earn points on every AED, track your orders & unlock free luxury gifts with every purchase.</p>
            </div>
        </div>
        <div class="shrink-0 w-full md:w-auto flex items-center justify-center gap-3">
            <a class="block w-full sm:w-auto text-center bg-black hover:bg-neutral-800 text-white text-xs sm:text-sm font-bold tracking-wider px-6 py-2.5 sm:py-3 rounded-sm transition-colors uppercase whitespace-nowrap" href="/sign-in">
                SIGN IN / REGISTER
            </a>
        </div>
    </section>
    <!-- END: MemberPerkBanner -->

    <!-- BEGIN: CuratedHolidaySection -->
    <section class="pt-2 sm:pt-4" data-purpose="holiday-collection">
        <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
            <div>
                <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-[#b45309]">Seasonal Special</span>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">The Holiday Collection</h2>
                <p class="text-xs sm:text-sm text-neutral-500 mt-0.5">Curated festive vaults, limited-edition bundles and gifting sets.</p>
            </div>
            <a class="text-xs sm:text-sm font-bold text-black hover:underline underline-offset-4 flex items-center gap-1 shrink-0 uppercase tracking-wider" href="/shop/gifts">
                Shop All <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
            @foreach ($holidayProducts as $product)
                @php
                    $hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
                @endphp
                <article class="product-card group relative flex flex-col justify-between bg-white border border-neutral-200 rounded-sm hover:shadow-lg transition-all p-2.5 sm:p-3.5">
                    <div class="relative w-full aspect-square bg-[#fafafa] rounded-sm overflow-hidden flex items-center justify-center">
                        <div class="absolute top-2 left-2 flex flex-col gap-1 z-10">
                            <span class="bg-[#b45309] text-white text-[9px] sm:text-[10px] font-black px-2 py-0.5 uppercase tracking-wider">
                                Holiday Set
                            </span>
                            @if ($hasDiscount)
                                <span class="bg-red-600 text-white text-[9px] sm:text-[10px] font-bold px-1.5 py-0.5 uppercase">Sale</span>
                            @endif
                        </div>
                        <button aria-label="Add {{ $product->name }} to wishlist" class="absolute top-2 right-2 text-neutral-400 hover:text-black z-10 p-1.5 bg-white/90 rounded-full shadow-sm transition-colors" data-wishlist-toggle="{{ $product->id }}" type="button">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                        <a aria-label="View {{ $product->name }}" class="block w-full h-full p-2" href="/p/{{ $product->slug }}">
                            <img alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ media_url($product->first_image) }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
                        </a>
                    </div>
                    <div class="pt-3 flex flex-col flex-grow min-w-0">
                        <p class="text-[11px] sm:text-xs font-bold text-black uppercase tracking-wider truncate">{{ $product->brand?->name ?? 'Sephora' }}</p>
                        <a class="mt-1 min-w-0" href="/p/{{ $product->slug }}">
                            <h3 class="text-xs sm:text-sm text-neutral-800 line-clamp-2 font-normal group-hover:text-black leading-snug">{{ $product->name }}</h3>
                        </a>
                        <div class="flex items-center gap-1 mt-2 text-amber-500 text-xs">
                            <span>@include('components.stars', ['rating' => $product->rating])</span>
                            <span class="text-neutral-400 text-[11px]">({{ number_format($product->reviews_count) }})</span>
                        </div>
                        <div class="mt-auto pt-2 flex items-baseline gap-2">
                            <span class="text-sm sm:text-base font-bold text-black">AED {{ number_format($product->price, 2) }}</span>
                            @if ($hasDiscount)
                                <span class="text-xs text-neutral-400 line-through">AED {{ number_format($product->compare_at_price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                    <button class="mt-3 w-full py-2.5 bg-black text-white text-xs font-bold uppercase rounded-sm hover:bg-neutral-800 transition-colors tracking-wider" data-add-to-bag="{{ $product->id }}" type="button">
                        Add to Bag
                    </button>
                </article>
            @endforeach
        </div>
    </section>
    <!-- END: CuratedHolidaySection -->

    <!-- BEGIN: StackYourScent Section -->
    <section class="pt-2 sm:pt-4" data-purpose="stack-your-scent">
        <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
            <div>
                <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-neutral-600">Editorial Fragrance</span>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">Stack Your Scent: Layer Without Limits</h2>
                <p class="text-xs sm:text-sm text-neutral-500 mt-0.5">Three iconic olfactory paths to craft your unforgettable signature trail.</p>
            </div>
            <a class="text-xs sm:text-sm font-bold text-black hover:underline underline-offset-4 flex items-center gap-1 shrink-0 uppercase tracking-wider" href="/shop/fragrance">
                Shop Fragrance <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <!-- Editorial Scent Pillars -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-200/70 p-4 sm:p-5 rounded-md flex flex-col justify-between">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-amber-800">Scent Pillar 01</span>
                    <h3 class="text-lg font-bold text-black mt-1">Fruity Gourmands</h3>
                    <p class="text-xs text-neutral-600 mt-1 leading-relaxed">Sugared pistachio, creamy vanilla, juicy berries and delicious warmth.</p>
                </div>
                <a href="/shop/fragrance" class="mt-4 text-xs font-bold text-amber-900 uppercase tracking-wider hover:underline">Explore Gourmands &rarr;</a>
            </div>

            <div class="bg-gradient-to-br from-stone-50 to-neutral-100 border border-neutral-200 p-4 sm:p-5 rounded-md flex flex-col justify-between">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-neutral-700">Scent Pillar 02</span>
                    <h3 class="text-lg font-bold text-black mt-1">Skin Musks</h3>
                    <p class="text-xs text-neutral-600 mt-1 leading-relaxed">Intimate second-skin warmth, white amber, soft cashmere and solar petals.</p>
                </div>
                <a href="/shop/fragrance" class="mt-4 text-xs font-bold text-neutral-900 uppercase tracking-wider hover:underline">Explore Musks &rarr;</a>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-indigo-50 border border-purple-200/70 p-4 sm:p-5 rounded-md flex flex-col justify-between">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-purple-800">Scent Pillar 03</span>
                    <h3 class="text-lg font-bold text-black mt-1">Lavender &amp; Oud Blends</h3>
                    <p class="text-xs text-neutral-600 mt-1 leading-relaxed">French lavender, velvety Middle Eastern oud, and rich aromatic woods.</p>
                </div>
                <a href="/shop/fragrance" class="mt-4 text-xs font-bold text-purple-900 uppercase tracking-wider hover:underline">Explore Woody Blends &rarr;</a>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
            @foreach ($fragrances->take(4) as $product)
                @php
                    $hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
                @endphp
                <article class="product-card group relative flex flex-col justify-between bg-white border border-neutral-200 rounded-sm hover:shadow-lg transition-all p-2.5 sm:p-3.5">
                    <div class="relative w-full aspect-square bg-[#fafafa] rounded-sm overflow-hidden flex items-center justify-center">
                        <span class="absolute top-2 left-2 bg-black text-white text-[9px] sm:text-[10px] font-black px-2 py-0.5 uppercase tracking-wider z-10">
                            Fragrance
                        </span>
                        <button aria-label="Add {{ $product->name }} to wishlist" class="absolute top-2 right-2 text-neutral-400 hover:text-black z-10 p-1.5 bg-white/90 rounded-full shadow-sm transition-colors" data-wishlist-toggle="{{ $product->id }}" type="button">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                        <a aria-label="View {{ $product->name }}" class="block w-full h-full p-2" href="/p/{{ $product->slug }}">
                            <img alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ media_url($product->first_image) }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
                        </a>
                    </div>
                    <div class="pt-3 flex flex-col flex-grow min-w-0">
                        <p class="text-[11px] sm:text-xs font-bold text-black uppercase tracking-wider truncate">{{ $product->brand?->name ?? 'Fragrance' }}</p>
                        <a class="mt-1 min-w-0" href="/p/{{ $product->slug }}">
                            <h3 class="text-xs sm:text-sm text-neutral-800 line-clamp-2 font-normal group-hover:text-black leading-snug">{{ $product->name }}</h3>
                        </a>
                        <div class="flex items-center gap-1 mt-2 text-amber-500 text-xs">
                            <span>@include('components.stars', ['rating' => $product->rating])</span>
                            <span class="text-neutral-400 text-[11px]">({{ number_format($product->reviews_count) }})</span>
                        </div>
                        <div class="mt-auto pt-2 flex items-baseline gap-2">
                            <span class="text-sm sm:text-base font-bold text-black">AED {{ number_format($product->price, 2) }}</span>
                            @if ($hasDiscount)
                                <span class="text-xs text-neutral-400 line-through">AED {{ number_format($product->compare_at_price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                    <button class="mt-3 w-full py-2.5 bg-black text-white text-xs font-bold uppercase rounded-sm hover:bg-neutral-800 transition-colors tracking-wider" data-add-to-bag="{{ $product->id }}" type="button">
                        Add to Bag
                    </button>
                </article>
            @endforeach
        </div>
    </section>
    <!-- END: StackYourScent Section -->

    <!-- BEGIN: BestsellersSection -->
    <section class="pt-2 sm:pt-4" data-purpose="bestsellers">
        <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
            <div>
                <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-neutral-600">Loved By You</span>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">Sephora UAE Bestsellers</h2>
                <p class="text-xs sm:text-sm text-neutral-500 mt-0.5">The most wanted cosmetics, serums, and scents in Dubai &amp; Abu Dhabi.</p>
            </div>
            <a class="text-xs sm:text-sm font-bold text-black hover:underline underline-offset-4 flex items-center gap-1 shrink-0 uppercase tracking-wider" href="/shop/bestsellers">
                View All Bestsellers <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
            @foreach ($bestsellers as $product)
                @php
                    $hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
                @endphp
                <article class="product-card group relative flex flex-col justify-between bg-white border border-neutral-200 rounded-sm hover:shadow-lg transition-all p-2.5 sm:p-3.5">
                    <div class="relative w-full aspect-square bg-[#fafafa] rounded-sm overflow-hidden flex items-center justify-center">
                        <span class="absolute top-2 left-2 bg-neutral-900 text-white text-[9px] sm:text-[10px] font-black px-2 py-0.5 uppercase tracking-wider z-10">
                            Bestseller
                        </span>
                        <button aria-label="Add {{ $product->name }} to wishlist" class="absolute top-2 right-2 text-neutral-400 hover:text-black z-10 p-1.5 bg-white/90 rounded-full shadow-sm transition-colors" data-wishlist-toggle="{{ $product->id }}" type="button">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                        <a aria-label="View {{ $product->name }}" class="block w-full h-full p-2" href="/p/{{ $product->slug }}">
                            <img alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ media_url($product->first_image) }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
                        </a>
                    </div>
                    <div class="pt-3 flex flex-col flex-grow min-w-0">
                        <p class="text-[11px] sm:text-xs font-bold text-black uppercase tracking-wider truncate">{{ $product->brand?->name ?? 'Sephora' }}</p>
                        <a class="mt-1 min-w-0" href="/p/{{ $product->slug }}">
                            <h3 class="text-xs sm:text-sm text-neutral-800 line-clamp-2 font-normal group-hover:text-black leading-snug">{{ $product->name }}</h3>
                        </a>
                        <div class="flex items-center gap-1 mt-2 text-amber-500 text-xs">
                            <span>@include('components.stars', ['rating' => $product->rating])</span>
                            <span class="text-neutral-400 text-[11px]">({{ number_format($product->reviews_count) }})</span>
                        </div>
                        <div class="mt-auto pt-2 flex items-baseline gap-2">
                            <span class="text-sm sm:text-base font-bold text-black">AED {{ number_format($product->price, 2) }}</span>
                            @if ($hasDiscount)
                                <span class="text-xs text-neutral-400 line-through">AED {{ number_format($product->compare_at_price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                    <button class="mt-3 w-full py-2.5 bg-black text-white text-xs font-bold uppercase rounded-sm hover:bg-neutral-800 transition-colors tracking-wider" data-add-to-bag="{{ $product->id }}" type="button">
                        Add to Bag
                    </button>
                </article>
            @endforeach
        </div>
    </section>
    <!-- END: BestsellersSection -->

    <!-- BEGIN: BrandSpotlight -->
    <section class="pt-2 sm:pt-4" data-purpose="brand-spotlight">
        <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
            <div>
                <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-neutral-600">The Houses We Love</span>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">Featured Brands</h2>
            </div>
            <a class="text-xs sm:text-sm font-bold text-black hover:underline underline-offset-4 flex items-center gap-1 shrink-0 uppercase tracking-wider" href="/brands">
                View All Brands <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-4">
            @foreach ($featuredBrands as $brand)
                <a href="/brands/{{ $brand->slug }}" class="group border border-neutral-200 bg-white hover:border-black p-4 rounded-sm flex flex-col items-center justify-center text-center transition-all duration-200 hover:shadow-md min-h-[90px]">
                    <span class="text-xs sm:text-sm font-black uppercase tracking-wider text-black group-hover:scale-105 transition-transform duration-200">
                        {{ $brand->name }}
                    </span>
                    <span class="text-[10px] text-neutral-400 group-hover:text-neutral-600 uppercase tracking-widest mt-1">Shop Brand &rarr;</span>
                </a>
            @endforeach
        </div>
    </section>
    <!-- END: BrandSpotlight -->

    <!-- BEGIN: JustDroppedSection -->
    <section class="pt-2 sm:pt-4" data-purpose="just-dropped">
        <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
            <div>
                <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-neutral-600">Trending Now</span>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">Just Dropped: New In Beauty</h2>
                <p class="text-xs sm:text-sm text-neutral-500 mt-0.5">Fresh formulas, seasonal drops and viral sensations.</p>
            </div>
            <a class="text-xs sm:text-sm font-bold text-black hover:underline underline-offset-4 flex items-center gap-1 shrink-0 uppercase tracking-wider" href="/shop/new">
                Explore All New <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
            @foreach ($justDropped as $product)
                @php
                    $hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
                @endphp
                <article class="product-card group relative flex flex-col justify-between bg-white border border-neutral-200 rounded-sm hover:shadow-lg transition-all p-2.5 sm:p-3.5">
                    <div class="relative w-full aspect-square bg-[#fafafa] rounded-sm overflow-hidden flex items-center justify-center">
                        <span class="absolute top-2 left-2 bg-white text-black border border-black text-[9px] sm:text-[10px] font-black px-2 py-0.5 uppercase tracking-wider z-10">
                            New
                        </span>
                        <button aria-label="Add {{ $product->name }} to wishlist" class="absolute top-2 right-2 text-neutral-400 hover:text-black z-10 p-1.5 bg-white/90 rounded-full shadow-sm transition-colors" data-wishlist-toggle="{{ $product->id }}" type="button">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                        <a aria-label="View {{ $product->name }}" class="block w-full h-full p-2" href="/p/{{ $product->slug }}">
                            <img alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ media_url($product->first_image) }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
                        </a>
                    </div>
                    <div class="pt-3 flex flex-col flex-grow min-w-0">
                        <p class="text-[11px] sm:text-xs font-bold text-black uppercase tracking-wider truncate">{{ $product->brand?->name ?? 'Sephora' }}</p>
                        <a class="mt-1 min-w-0" href="/p/{{ $product->slug }}">
                            <h3 class="text-xs sm:text-sm text-neutral-800 line-clamp-2 font-normal group-hover:text-black leading-snug">{{ $product->name }}</h3>
                        </a>
                        <div class="flex items-center gap-1 mt-2 text-amber-500 text-xs">
                            <span>@include('components.stars', ['rating' => $product->rating])</span>
                            <span class="text-neutral-400 text-[11px]">({{ number_format($product->reviews_count) }})</span>
                        </div>
                        <div class="mt-auto pt-2 flex items-baseline gap-2">
                            <span class="text-sm sm:text-base font-bold text-black">AED {{ number_format($product->price, 2) }}</span>
                            @if ($hasDiscount)
                                <span class="text-xs text-neutral-400 line-through">AED {{ number_format($product->compare_at_price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                    <button class="mt-3 w-full py-2.5 bg-black text-white text-xs font-bold uppercase rounded-sm hover:bg-neutral-800 transition-colors tracking-wider" data-add-to-bag="{{ $product->id }}" type="button">
                        Add to Bag
                    </button>
                </article>
            @endforeach
        </div>
    </section>
    <!-- END: JustDroppedSection -->

    <!-- BEGIN: SephoraAppBanner -->
    <section class="bg-black text-white rounded-sm p-6 sm:p-8 md:p-10 relative overflow-hidden shadow-lg" data-purpose="app-download-banner">
        <div class="relative z-10 grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
            <div class="md:col-span-8 space-y-3">
                <span class="inline-block bg-white text-black text-[10px] sm:text-xs font-black px-2.5 py-1 uppercase tracking-widest rounded-sm">
                    MOBILE EXCLUSIVE
                </span>
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-extrabold uppercase tracking-tight">
                    Get 10% Off On Your First App Order
                </h3>
                <p class="text-neutral-300 text-xs sm:text-sm max-w-xl leading-relaxed">
                    Download the Sephora UAE App and enjoy early product access, exclusive shade finder tools, instant order tracking &amp; 10% off with promo code <strong class="text-white bg-neutral-800 px-2 py-0.5 rounded border border-neutral-600 font-mono">APP10</strong>.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-3">
                    <a href="/download-app" class="inline-flex items-center gap-2 bg-white text-black font-bold uppercase text-xs px-5 py-2.5 rounded-sm hover:bg-neutral-200 transition-colors">
                        <span>Download App</span> &rarr;
                    </a>
                </div>
            </div>
            <div class="md:col-span-4 flex items-center justify-center md:justify-end gap-4">
                <div class="w-24 h-24 sm:w-28 sm:h-28 bg-white p-2 rounded-sm shadow-inner flex items-center justify-center">
                    <img src="{{ media_url('images/hero/qr_code_mockup_for_downloading_mobile_app_with_elegant_sephora_minimalist.webp') }}" alt="QR Code to Download Sephora App" class="w-full h-full object-contain" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                </div>
                <div class="text-left text-xs text-neutral-300">
                    <p class="font-bold text-white uppercase text-[11px] tracking-wider">Scan to download</p>
                    <p class="text-[11px] text-neutral-400 mt-0.5">Available for iOS &amp; Android</p>
                </div>
            </div>
        </div>
    </section>
    <!-- END: SephoraAppBanner -->

    <!-- BEGIN: ValueBannersAndServices -->
    <section class="border-t border-b border-neutral-200 py-8 my-6 bg-white" data-purpose="services-banner">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mb-2.5">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                        <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-black">Free Delivery</h4>
                <p class="text-xs text-neutral-500 mt-1">On all UAE orders over 250 AED</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mb-2.5">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-black">100% Authentic</h4>
                <p class="text-xs text-neutral-500 mt-1">Direct from official luxury brands</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mb-2.5">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-black">3 Free Samples</h4>
                <p class="text-xs text-neutral-500 mt-1">Chosen by you with every online order</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mb-2.5">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                        <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-black">Easy In-Store Returns</h4>
                <p class="text-xs text-neutral-500 mt-1">At any Sephora UAE boutique</p>
            </div>
        </div>
    </section>
    <!-- END: ValueBannersAndServices -->

</main>
@endsection
