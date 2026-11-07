@extends('layouts.app')

@section('title', 'SEPHORA | Makeup, Skincare, Fragrance & More')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-4 md:px-8 py-4 space-y-6">
<!-- BEGIN: MemberPerkBanner -->
<section class="bg-[#f5f6f8] rounded border border-gray-200 p-4 md:p-5 flex flex-col md:flex-row items-center justify-between gap-4" data-purpose="member-perks">
<div class="flex items-center gap-4 text-center md:text-left">
<!-- Striped Shopping Bags Graphic Placeholder -->
<div class="w-14 h-14 shrink-0 rounded-lg bg-pink-100 p-1.5 flex items-center justify-center relative shadow-inner overflow-hidden">
<div class="w-10 h-10 border-2 border-black rounded-sm flex flex-col justify-around py-1 bg-white shadow rotate-[-6deg]">
<div class="h-1 bg-black w-full"></div>
<div class="h-1 bg-black w-full"></div>
<div class="h-1 bg-black w-full"></div>
</div>
<div class="w-8 h-8 border-2 border-pink-400 bg-pink-200 rounded-sm absolute right-1 bottom-1 rotate-[12deg] shadow"></div>
</div>
<div>
<h2 class="text-base md:text-lg font-bold text-black tracking-tight">Sign in for exclusive perks!</h2>
<p class="text-xs md:text-sm text-gray-600 mt-0.5">Personalize your experience, track your orders, unlock gifts &amp; more.</p>
</div>
</div>
<div class="shrink-0 w-full md:w-auto">
<a class="block text-center bg-[#1a1a1a] hover:bg-black text-white text-xs md:text-sm font-semibold tracking-wider px-6 py-3 rounded transition-colors uppercase" href="/sign-in">
          SIGN IN / CREATE ACCOUNT
        </a>
</div>
</section>
<!-- END: MemberPerkBanner -->
<!-- BEGIN: HeroCarouselBanner -->
@php
    $heroSlides = [
        [
            'title' => "Holiday Sets\nDropped Early",
            'subtext' => 'Be the first to shop our limited-edition sets online exclusive',
            'cta' => '/shop/bestsellers',
            'image' => 'images/content/img_ae504b2863e30968.jpg',
            'alt' => 'Holiday Sets Dropped Early - Sephora Holiday Showcase',
        ],
        [
            'title' => "New In:\nSkincare Icons",
            'subtext' => 'The serums, creams and treatments everyone is talking about',
            'cta' => '/shop/new',
            'image' => 'images/content/img_e5b9f6068af50d49.jpg',
            'alt' => 'New In Skincare Icons - Sephora skincare favourites',
        ],
        [
            'title' => "Fragrance Wardrobe:\nStack Your Scent",
            'subtext' => 'Layer your signature scent with our newest fragrance arrivals',
            'cta' => '/shop/fragrance',
            'image' => 'images/content/img_588a27163ab88e65.jpg',
            'alt' => 'Fragrance Wardrobe - Stack Your Scent at Sephora',
        ],
    ];
@endphp
<section aria-label="Featured collections" aria-roledescription="carousel" class="relative rounded-lg overflow-hidden shadow-sm bg-sephoraNavy" data-autoplay="5000" data-carousel data-purpose="hero-banner">
    <div class="relative w-full min-h-[320px] sm:min-h-[400px] md:min-h-[500px]">
        @foreach ($heroSlides as $index => $slide)
            <article
                aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                aria-label="{{ $index + 1 }} of {{ count($heroSlides) }}"
                aria-roledescription="slide"
                class="absolute inset-0 flex items-center transition-opacity duration-700 ease-out {{ $index === 0 ? 'is-active opacity-100' : 'opacity-0 pointer-events-none' }}"
                data-carousel-slide
                @if ($index !== 0) inert @endif
            >
                <img alt="{{ $slide['alt'] }}" class="absolute inset-0 w-full h-full object-cover object-center" src="{{ media_url($slide['image']) }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-[#0c1b33]/95 via-[#0c1b33]/55 to-transparent md:bg-gradient-to-r md:from-transparent md:via-[#0c1b33]/60 md:to-[#0c1b33]/90"></div>
                <div class="relative z-10 w-full grid grid-cols-1 md:grid-cols-12 items-center p-6 sm:p-8 md:p-12 lg:p-16">
                    <div class="hidden md:flex md:col-span-5 lg:col-span-6 justify-start items-start h-full">
                        <div class="w-14 h-14 rounded-full bg-white/95 text-black flex flex-col items-center justify-center p-1 shadow-lg border border-black/10">
                            <span class="text-[8px] font-black uppercase tracking-tighter">ONLY</span>
                            <span class="text-[7px] font-medium leading-none">AT</span>
                            <span class="text-[7px] font-black tracking-tight">SEPHORA</span>
                        </div>
                    </div>
                    <div class="md:col-span-7 lg:col-span-6 text-white space-y-3 sm:space-y-4 md:space-y-6 md:pl-6 text-left">
                        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight">{!! nl2br(e($slide['title'])) !!}</h1>
                        <p class="text-sm sm:text-base lg:text-lg text-gray-200 font-normal max-w-md">{{ $slide['subtext'] }}</p>
                        <div class="pt-1 sm:pt-2">
                            <a class="inline-block border border-white text-white hover:bg-white hover:text-sephoraNavy px-8 py-3 text-sm font-semibold tracking-wide transition duration-200" href="{{ $slide['cta'] }}">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach

        <button aria-label="Previous slide" class="absolute left-0 top-1/2 -translate-y-1/2 z-20 flex h-12 w-9 md:w-10 items-center justify-center rounded-r bg-white text-black shadow-md hover:bg-gray-100 transition-colors" data-carousel-prev type="button">
            <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" stroke-width="2.5" viewbox="0 0 24 24">
                <path d="M15 5l-7 7 7 7" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
        <button aria-label="Next slide" class="absolute right-0 top-1/2 -translate-y-1/2 z-20 flex h-12 w-9 md:w-10 items-center justify-center rounded-l bg-white text-black shadow-md hover:bg-gray-100 transition-colors" data-carousel-next type="button">
            <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" stroke-width="2.5" viewbox="0 0 24 24">
                <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <div aria-label="Choose slide" class="absolute bottom-4 left-1/2 z-20 flex -translate-x-1/2 items-center gap-2" role="tablist">
            @foreach ($heroSlides as $index => $slide)
                <button
                    aria-label="Go to slide {{ $index + 1 }}"
                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                    class="h-2 w-2 rounded-full transition-colors duration-300 {{ $index === 0 ? 'bg-white' : 'bg-white/40' }}"
                    data-carousel-dot
                    role="tab"
                    type="button"
                ></button>
            @endforeach
        </div>
    </div>
</section>
<!-- END: HeroCarouselBanner -->
<!-- BEGIN: CuratedHolidaySection -->
<section class="pt-6" data-purpose="holiday-collection">
<!-- Section Header -->
<div class="flex items-center justify-between border-b border-gray-200 pb-3 mb-6">
<div>
<span class="text-xs font-bold uppercase tracking-widest text-[#be7d76]">Limited Edition</span>
<h2 class="text-xl md:text-2xl font-bold text-black mt-0.5">The Holiday Collection</h2>
</div>
<a class="text-xs md:text-sm font-semibold text-black hover:underline underline-offset-4 flex items-center gap-1" href="/shop/new">
          View All <span aria-hidden="true">→</span>
</a>
</div>
<!-- Product Carousel / Grid Container -->
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
    @foreach ($holidayProducts as $product)
        <article class="product-card group relative flex flex-col justify-between bg-white border border-gray-200 rounded hover:shadow-md transition-all p-2.5 sm:p-3 md:p-4">
            <div class="relative w-full aspect-square bg-[#fafafa] rounded overflow-hidden flex items-center justify-center">
                <span class="absolute top-2 left-2 bg-black text-white text-[10px] font-bold px-2 py-0.5 uppercase z-10 tracking-wider">
                    Exclusive
                </span>
                <button aria-label="Add {{ $product->name }} to wishlist" class="absolute top-2 right-2 text-gray-400 hover:text-black z-10 p-1 bg-white/80 rounded-full" data-wishlist-toggle="{{ $product->id }}" type="button">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </button>
                <a aria-label="View {{ $product->name }}" class="block w-full h-full" href="/p/{{ $product->slug }}">
                    <img alt="{{ $product->name }}" class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform duration-300" src="{{ media_url($product->first_image) }}"/>
                </a>
            </div>
            <div class="pt-3 flex flex-col flex-grow min-w-0">
                <p class="text-[11px] sm:text-xs font-bold text-black uppercase tracking-wider truncate">{{ $product->brand?->name ?? 'Sephora' }}</p>
                <a class="mt-1 min-w-0" href="/p/{{ $product->slug }}">
                    <h3 class="text-xs sm:text-sm text-gray-800 line-clamp-2 font-normal group-hover:text-black">{{ $product->name }}</h3>
                </a>
                <div class="flex items-center gap-1 mt-2 text-yellow-500 text-xs">
                    <span>@include('components.stars', ['rating' => $product->rating])</span>
                    <span class="text-gray-400 text-[11px]">({{ number_format($product->reviews_count) }})</span>
                </div>
                <div class="mt-auto pt-2">
                    <span class="text-sm md:text-base font-bold text-black">{{ number_format($product->price, 2) }} AED</span>
                </div>
            </div>
            <button class="mt-3 w-full py-2 bg-black text-white text-xs font-bold uppercase rounded hover:bg-gray-800 transition-colors" data-add-to-bag="{{ $product->id }}" type="button">
                Add to Bag
            </button>
        </article>
    @endforeach
</div>
</section>
<!-- END: CuratedHolidaySection -->
<!-- BEGIN: JustDroppedSection -->
<section class="pt-8" data-purpose="just-dropped">
<!-- Section Header -->
<div class="flex items-center justify-between border-b border-gray-200 pb-3 mb-6">
<div>
<span class="text-xs font-bold uppercase tracking-widest text-black">Trending Now</span>
<h2 class="text-xl md:text-2xl font-bold text-black mt-0.5">Just Dropped: New In Beauty</h2>
</div>
<a class="text-xs md:text-sm font-semibold text-black hover:underline underline-offset-4 flex items-center gap-1" href="/shop/new">
          Explore All New <span aria-hidden="true">→</span>
</a>
</div>
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
    @foreach ($justDropped as $product)
        <article class="product-card group relative flex flex-col justify-between bg-white border border-gray-200 rounded hover:shadow-md transition-all p-2.5 sm:p-3 md:p-4">
            <div class="relative w-full aspect-square bg-[#fafafa] rounded overflow-hidden flex items-center justify-center">
                <span class="absolute top-2 left-2 bg-black text-white text-[10px] font-bold px-2 py-0.5 uppercase z-10 tracking-wider">
                    New
                </span>
                <button aria-label="Add {{ $product->name }} to wishlist" class="absolute top-2 right-2 text-gray-400 hover:text-black z-10 p-1 bg-white/80 rounded-full" data-wishlist-toggle="{{ $product->id }}" type="button">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </button>
                <a aria-label="View {{ $product->name }}" class="block w-full h-full" href="/p/{{ $product->slug }}">
                    <img alt="{{ $product->name }}" class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform duration-300" src="{{ media_url($product->first_image) }}"/>
                </a>
            </div>
            <div class="pt-3 flex flex-col flex-grow min-w-0">
                <p class="text-[11px] sm:text-xs font-bold text-black uppercase tracking-wider truncate">{{ $product->brand?->name ?? 'Sephora' }}</p>
                <a class="mt-1 min-w-0" href="/p/{{ $product->slug }}">
                    <h3 class="text-xs sm:text-sm text-gray-800 line-clamp-2 font-normal group-hover:text-black">{{ $product->name }}</h3>
                </a>
                <div class="flex items-center gap-1 mt-2 text-yellow-500 text-xs">
                    <span>@include('components.stars', ['rating' => $product->rating])</span>
                    <span class="text-gray-400 text-[11px]">({{ number_format($product->reviews_count) }})</span>
                </div>
                <div class="mt-auto pt-2">
                    <span class="text-sm md:text-base font-bold text-black">{{ number_format($product->price, 2) }} AED</span>
                </div>
            </div>
            <button class="mt-3 w-full py-2 bg-black text-white text-xs font-bold uppercase rounded hover:bg-gray-800 transition-colors" data-add-to-bag="{{ $product->id }}" type="button">
                Add to Bag
            </button>
        </article>
    @endforeach
</div>
</section>
<!-- END: JustDroppedSection -->
<!-- BEGIN: ValueBannersAndServices -->
<section class="border-t border-b border-gray-200 py-6 my-10 bg-white" data-purpose="services-banner">
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
<div class="flex flex-col items-center">
<div class="w-10 h-10 rounded-full bg-neutral-100 flex items-center justify-center mb-2">
<svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<h4 class="text-xs md:text-sm font-bold uppercase tracking-wider text-black">Free Delivery</h4>
<p class="text-xs text-gray-500 mt-1">On orders over 250 AED</p>
</div>
<div class="flex flex-col items-center">
<div class="w-10 h-10 rounded-full bg-neutral-100 flex items-center justify-center mb-2">
<svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<h4 class="text-xs md:text-sm font-bold uppercase tracking-wider text-black">100% Authentic</h4>
<p class="text-xs text-gray-500 mt-1">Direct from official brands</p>
</div>
<div class="flex flex-col items-center">
<div class="w-10 h-10 rounded-full bg-neutral-100 flex items-center justify-center mb-2">
<svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<h4 class="text-xs md:text-sm font-bold uppercase tracking-wider text-black">Easy In-Store Returns</h4>
<p class="text-xs text-gray-500 mt-1">At any Sephora UAE store</p>
</div>
<div class="flex flex-col items-center">
<div class="w-10 h-10 rounded-full bg-neutral-100 flex items-center justify-center mb-2">
<svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
<h4 class="text-xs md:text-sm font-bold uppercase tracking-wider text-black">Beauty Pass Points</h4>
<p class="text-xs text-gray-500 mt-1">Earn with every order</p>
</div>
</div>
</section>
<!-- END: ValueBannersAndServices -->
</main>
@endsection
