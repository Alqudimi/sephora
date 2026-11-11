@extends('layouts.app')

@section('title', 'Beauty Products, Makeup, Perfume & Skincare ≡ Sephora UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-3 sm:py-5 space-y-8 sm:space-y-12">

    <!-- BEGIN: Guest Loyalty Block -->
    <section class="bg-[#faf8f5] rounded-sm border border-neutral-200 p-4 sm:p-5 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm" data-purpose="guest-loyalty">
        <div class="flex items-center gap-4 text-center md:text-left">
            <div class="w-14 h-14 sm:w-16 sm:h-16 shrink-0 flex items-center justify-center">
                <img
                    alt="Illustration for Non-Loyalty User"
                    class="w-full h-full object-contain"
                    src="https://img-content.sephora.me/m3aon8mn8vtz/3lfhaQmTln7O5XJQkOr3W5/8424af08532713db0712a304cae44fec/Illustration_for_Non-Loyalty_User.png?fm=webp&q=85"
                    onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"
                />
            </div>
            <div>
                <h2 class="text-base sm:text-lg md:text-xl font-bold text-black tracking-tight">Sign in for exclusive perks!</h2>
                <p class="text-xs sm:text-sm text-neutral-600 mt-0.5">Personalize your experience, track your orders, unlock gifts &amp; more.</p>
            </div>
        </div>
        <div class="shrink-0 w-full md:w-auto flex items-center justify-center">
            <a class="block w-full sm:w-auto text-center bg-black hover:bg-neutral-800 text-white text-xs sm:text-sm font-bold tracking-wider px-7 py-3 rounded-sm transition-colors uppercase whitespace-nowrap shadow-sm" href="/sign-in">
                SIGN IN / CREATE ACCOUNT
            </a>
        </div>
    </section>
    <!-- END: Guest Loyalty Block -->

    <!-- BEGIN: HeroCarouselBanner (4 Official Sephora Campaigns) -->
    @php
        if (isset($heroBanners) && $heroBanners->isNotEmpty()) {
            $heroSlides = $heroBanners->map(fn ($b) => [
                'badge' => $b->badge,
                'title' => $b->title,
                'subtext' => $b->subtitle,
                'cta' => $b->link ?: '#',
                'cta_label' => $b->cta_label ?: 'Shop Now',
                'image' => media_url($b->image_path),
                'alt' => $b->title . ' at Sephora UAE',
            ])->all();
        } else {
            $heroSlides = [
                [
                    'badge' => 'NEW LAUNCH',
                    'title' => "NARS New Notorious Mascara",
                    'subtext' => 'Steal the Scene. High-drama volume and irresistible lash lift, exclusively at Sephora.',
                    'cta' => '/brands/nars',
                    'cta_label' => 'Shop Now',
                    'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/6yXJcFFTJWBuN2Zz3GwxjS/2085f5f8c7e0032c525f0a75f85bc515/Nars-Notorious_Hero-Carousel_1142x928_Eng.jpg?fm=webp&q=85&w=1200',
                    'alt' => 'NARS New Notorious Mascara at Sephora UAE',
                ],
                [
                    'badge' => 'EXCLUSIVE FRAGRANCE',
                    'title' => "Cherry Amber By Matiere Premiere",
                    'subtext' => 'A modern amber coloured by natural Cherry Extract. 50 ml, exclusively at Sephora Middle East.',
                    'cta' => '/shop/fragrance',
                    'cta_label' => 'Shop Now',
                    'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/vOUoBvO6GOSVYs6bDCj8L/1e31db6fb76da289f074d2757270b615/Matiere_Premiere_Cherry_Amber_ENG_1142x928.jpg?fm=webp&q=85&w=1200',
                    'alt' => 'Matiere Premiere Cherry Amber at Sephora UAE',
                ],
                [
                    'badge' => 'ANNIVERSARY',
                    'title' => "tarte: 10 Years 10 Icons",
                    'subtext' => 'Celebrating a decade of tarte at Sephora Middle East with the beauty icons you know and love.',
                    'cta' => '/brands/tarte',
                    'cta_label' => 'Shop Now',
                    'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/6pE1QhppKX12pww01udLL/4ce2ba15f9ee7e28bf6b77c5d7348981/tarte_Hero-Carousel_Tablet_1142x928_ENG.jpg?fm=webp&q=85&w=1200',
                    'alt' => 'tarte 10 Years at Sephora UAE',
                ],
                [
                    'badge' => 'SIGNATURE LAYERING',
                    'title' => "Stack Your Scent",
                    'subtext' => 'Discover a world of fragrances, from juicy gourmands to soft musks and modern lavenders. Mix, match, and create a scent that’s uniquely yours.',
                    'cta' => '/shop/fragrance',
                    'cta_label' => 'Shop Now',
                    'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/1U86f2Z19tG4l50kUqT5xV/6fd5317789498234399e46a782a20b99/Stack_Your_Scent_Hero_Carousel_1142x928_Eng.jpg?fm=webp&q=85&w=1200',
                    'alt' => 'Stack Your Scent Fragrance Campaign at Sephora UAE',
                ],
            ];
        }
    @endphp
    <section aria-label="Featured campaigns" aria-roledescription="carousel" class="relative rounded-sm overflow-hidden shadow-sm bg-neutral-900" data-autoplay="5000" data-carousel data-purpose="hero-banner">
        <div class="relative w-full min-h-[340px] sm:min-h-[420px] md:min-h-[500px]">
            @foreach ($heroSlides as $index => $slide)
                <article
                    aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                    aria-label="{{ $index + 1 }} of {{ count($heroSlides) }}"
                    aria-roledescription="slide"
                    class="absolute inset-0 flex items-center transition-opacity duration-700 ease-out {{ $index === 0 ? 'is-active opacity-100' : 'opacity-0 pointer-events-none' }}"
                    data-carousel-slide
                    @if ($index !== 0) inert @endif
                >
                    <img alt="{{ $slide['alt'] }}" class="absolute inset-0 w-full h-full object-cover object-center" src="{{ $slide['image'] }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent md:bg-gradient-to-r md:from-black/80 md:via-black/50 md:to-transparent"></div>
                    <div class="relative z-10 w-full max-w-2xl p-6 sm:p-10 md:p-14 text-white space-y-3 sm:space-y-4">
                        <span class="inline-block bg-white text-black text-[10px] sm:text-xs font-black px-2.5 py-1 uppercase tracking-widest rounded-sm">
                            {{ $slide['badge'] }}
                        </span>
                        <h2 class="text-2xl sm:text-4xl md:text-5xl font-extrabold tracking-tight leading-tight uppercase font-sans">
                            {{ $slide['title'] }}
                        </h2>
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
                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M15 5l-7 7 7 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
            <button aria-label="Next slide" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-black shadow-md hover:bg-white transition-colors" data-carousel-next type="button">
                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>
    </section>
    <!-- END: HeroCarouselBanner -->

    <!-- BEGIN: CuratedHolidaySection (Product Row 1) -->
    <section class="pt-2 sm:pt-4" data-purpose="holiday-collection">
        <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
            <div>
                <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-[#1A3066]">Limited-Edition Sets</span>
                <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">{{ __('ui.holiday_collection') }}</h3>
                <p class="text-xs sm:text-sm text-neutral-500 mt-0.5">Iconic vaults, festive bundles, and exclusive beauty sets.</p>
            </div>
            <a class="text-xs sm:text-sm font-bold text-black hover:underline underline-offset-4 flex items-center gap-1 shrink-0 uppercase tracking-wider" href="/shop/gifts">{{ __('ui.shop_now') }}<span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-5">
            @foreach ($holidayProducts as $product)
                <x-product-card :product="$product" badge="Holiday Set" />
            @endforeach
        </div>
    </section>
    <!-- END: CuratedHolidaySection -->

    <!-- BEGIN: Secondary Editorial Promo Grid (6 Cards) -->
    @php
        $editorialCards = [
            [
                'title' => 'The Sets Everyone Wants',
                'subtext' => 'All the most-loved beauty sets in one place.',
                'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/6ARX3CtDVjaAtfIT9njNfh/b910e93159bab4fc0a5f7263cd0c735c/Festive_Collection_1142x928_Eng.jpg?fm=webp&q=85&w=608',
                'cta' => '/shop/gifts',
            ],
            [
                'title' => 'New Make Up For Ever',
                'subtext' => 'Artist Bronze and Sculpt Powders for effortless warmth and definition.',
                'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/7aPFtxydFLWU9w8x4Z7rZb/18ab71b1a5c6bedc9e01fbbf3d944e99/Hero_Carousel_-_EN.jpg?fm=webp&q=85&w=608',
                'cta' => '/brands/make-up-for-ever',
            ],
            [
                'title' => 'Yum Vanilla Cupcake | 108',
                'subtext' => 'Indulge in the sweetest new fragrance sensation from KAYALI.',
                'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/1U86f2Z19tG4l50kUqT5xV/6fd5317789498234399e46a782a20b99/Stack_Your_Scent_Hero_Carousel_1142x928_Eng.jpg?fm=webp&q=85&w=608',
                'cta' => '/brands/kayali',
            ],
            [
                'title' => 'New Erborian Triple Care BB Milk',
                'subtext' => 'Get that dewy, bouncy BB skin everyone is watching.',
                'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/6yXJcFFTJWBuN2Zz3GwxjS/2085f5f8c7e0032c525f0a75f85bc515/Nars-Notorious_Hero-Carousel_1142x928_Eng.jpg?fm=webp&q=85&w=608',
                'cta' => '/brands/erborian',
            ],
            [
                'title' => 'Your Glow, Made Easy',
                'subtext' => "Effortless radiance in one kit, because glowing shouldn't be complicated.",
                'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/7HOUaojRlqzWNsiHYHHCPn/8ce82f85343ab8be27c55b5ca15f102d/Hero_Carousel_-_EN.jpg?fm=webp&q=85&w=608',
                'cta' => '/shop/new',
            ],
            [
                'title' => 'New! Power Grip Rosé Setting Spray',
                'subtext' => 'Set makeup and brighten skin with the latest drip from e.l.f.',
                'image' => 'https://img-content.sephora.me/m3aon8mn8vtz/3O7pbz0h020sC33lJ6H0uO/0ff32c443173791af651c33e6909b222/3931_elf_GCC_Sephora-P1-eComm-Rose_Spray_Hero-Carousel_1142x928.jpg?fm=webp&q=85&w=608',
                'cta' => '/brands/e-l-f-cosmetics',
            ],
        ];
    @endphp
    <section class="pt-2 sm:pt-4" data-purpose="editorial-promo-grid">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach ($editorialCards as $card)
                <div class="group flex flex-col bg-white border border-gray-100 rounded-sm overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="aspect-[16/10] bg-gray-100 overflow-hidden relative">
                        <img
                            alt="{{ $card['title'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                            src="{{ $card['image'] }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"
                        />
                    </div>
                    <div class="p-4 sm:p-5 flex flex-col flex-grow justify-between">
                        <div>
                            <h4 class="text-base sm:text-lg font-bold text-black tracking-tight group-hover:text-neutral-700 transition-colors">
                                {{ $card['title'] }}
                            </h4>
                            <p class="text-xs sm:text-sm text-neutral-600 mt-1 leading-relaxed">
                                {{ $card['subtext'] }}
                            </p>
                        </div>
                        <div class="pt-4">
                            <a class="text-xs font-bold text-black uppercase tracking-wider underline underline-offset-4 hover:text-neutral-600 transition-colors inline-flex items-center gap-1" href="{{ $card['cta'] }}">
                                Shop Now &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- END: Secondary Editorial Promo Grid -->

    <!-- BEGIN: JustDroppedSection (Product Row 2) -->
    <section class="pt-2 sm:pt-4" data-purpose="just-dropped">
        <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
            <div>
                <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-neutral-600">Trending Now</span>
                <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">Just Dropped.</h3>
                <p class="text-xs sm:text-sm text-neutral-500 mt-0.5">The newest arrivals and viral formulations just landed at Sephora UAE.</p>
            </div>
            <a class="text-xs sm:text-sm font-bold text-black hover:underline underline-offset-4 flex items-center gap-1 shrink-0 uppercase tracking-wider" href="/shop/new">{{ __('ui.shop_now') }}<span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-5">
            @foreach ($justDropped as $product)
                <x-product-card :product="$product" badge="NEW" />
            @endforeach
        </div>
    </section>
    <!-- END: JustDroppedSection -->

    <!-- BEGIN: BrandFeatureSpotlight ("The Gift On Every Wishlist") -->
    @php
        $wishlistSpotlights = [
            [
                'title' => 'Gisou Cherry Chocolate Collection',
                'subtitle' => 'Treat your hair and lips to the sweet indulgence of limited-edition holiday care.',
                'image' => 'images/hero/gisou_honey_infused_hair_oil_luxury_glass_dropper_bottle_with_golden_honey_oil.webp',
                'cta' => '/brands/gisou',
            ],
            [
                'title' => 'Unlock the exclusive gift!',
                'subtitle' => 'Receive iconic Sol De Janeiro Cheirosa treats when you spend AED 250 on the brand.',
                'image' => 'images/hero/sol_de_janeiro_brazilian_bum_bum_cream_vibrant_yellow_jar_with_white_cap_luxury.webp',
                'cta' => '/brands/sol-de-janeiro',
            ],
            [
                'title' => 'NEW Sephora Collection Mascara!',
                'subtitle' => 'High-drama volume, intense curl and deep carbon-black pigments for every festive look.',
                'image' => 'images/hero/anastasia_beverly_hills_modern_renaissance_or_glam_eyeshadow_palette_open.webp',
                'cta' => '/brands/sephora-collection',
            ],
        ];
    @endphp
    <section class="pt-2 sm:pt-4" data-purpose="wishlist-spotlight">
        <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
            <div>
                <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-[#1A3066]">Curated Highlights</span>
                <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">The Gift On Every Wishlist</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
            @foreach ($wishlistSpotlights as $spotlight)
                <div class="group relative rounded-sm overflow-hidden bg-neutral-900 border border-neutral-800 shadow-sm min-h-[300px] flex items-end">
                    <img
                        alt="{{ $spotlight['title'] }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-80"
                        loading="lazy"
                        src="{{ media_url($spotlight['image']) }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                    <div class="relative z-10 p-5 sm:p-6 text-white space-y-2">
                        <h4 class="text-lg sm:text-xl font-bold tracking-tight">
                            {{ $spotlight['title'] }}
                        </h4>
                        <p class="text-xs text-neutral-300 leading-relaxed">
                            {{ $spotlight['subtitle'] }}
                        </p>
                        <div class="pt-2">
                            <a class="inline-block bg-white text-black text-xs font-bold uppercase tracking-wider px-5 py-2 rounded-sm hover:bg-neutral-200 transition-colors" href="{{ $spotlight['cta'] }}">
                                Explore Now &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- END: BrandFeatureSpotlight -->

    <!-- BEGIN: BeautyOffers Section -->
    @if (isset($offers) && $offers->count() > 0)
        <section class="pt-2 sm:pt-4" data-purpose="beauty-offers">
            <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
                <div>
                    <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-[#BBA08B]">Gifts With Purchase</span>
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">{{ __('ui.beauty_offers') }}</h3>
                    <p class="text-xs sm:text-sm text-neutral-500 mt-0.5">Exclusive complimentary deluxe miniatures with your favorite brand orders.</p>
                </div>
                <a class="text-xs sm:text-sm font-bold text-black hover:underline underline-offset-4 flex items-center gap-1 shrink-0 uppercase tracking-wider" href="/beauty-offers">{{ __('ui.view_all') }}<span aria-hidden="true">&rarr;</span>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-5">
                @foreach ($offers->take(8) as $offer)
                    <div class="bg-white border border-gray-100 rounded-sm p-3 hover:shadow-md transition-shadow flex flex-col justify-between">
                        <div>
                            <div class="aspect-square bg-[#fafafa] rounded-sm overflow-hidden mb-2.5 flex items-center justify-center p-2">
                                <img
                                    alt="{{ $offer->title }}"
                                    class="w-full h-full object-contain"
                                    loading="lazy"
                                    src="{{ media_url($offer->image_path ?? 'images/placeholder.webp') }}"
                                    onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"
                                />
                            </div>
                            <span class="text-[10px] font-bold text-black uppercase tracking-widest block truncate">
                                {{ $offer->brand_name ?? 'Special Gift' }}
                            </span>
                            <h4 class="text-xs sm:text-[13px] font-bold text-black mt-0.5 line-clamp-1">
                                {{ $offer->title }}
                            </h4>
                            <p class="text-[11px] text-neutral-500 mt-1 line-clamp-2 leading-relaxed">
                                {{ $offer->description }}
                            </p>
                        </div>
                        <div class="pt-3 border-t border-gray-100 mt-3">
                            <a class="text-[11px] font-bold text-black uppercase tracking-wider hover:underline flex items-center justify-between" href="/beauty-offers">
                                <span>Get Offer</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    <!-- END: BeautyOffers Section -->

    <!-- BEGIN: DiscoverTheBrands Section (Brand Poster Cards) -->
    <section class="pt-2 sm:pt-4" data-purpose="discover-the-brands">
        <div class="flex items-end justify-between border-b-2 border-black pb-3 mb-6">
            <div>
                <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-neutral-600">Iconic Houses</span>
                <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">Discover the Brands</h3>
                <p class="text-xs sm:text-sm text-neutral-500 mt-0.5">Shop the world’s most coveted luxury cosmetics and fragrance houses.</p>
            </div>
            <a class="text-xs sm:text-sm font-bold text-black hover:underline underline-offset-4 flex items-center gap-1 shrink-0 uppercase tracking-wider" href="/brands">
                View All Brands <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 sm:gap-4">
            @foreach ($featuredBrands as $brand)
                <a href="/brands/{{ $brand->slug }}" class="group border border-gray-200 bg-white hover:border-black p-4 sm:p-6 rounded-sm flex flex-col items-center justify-center text-center transition-all duration-200 hover:shadow-md min-h-[110px]">
                    <span class="text-xs sm:text-sm font-black uppercase tracking-wider text-black group-hover:scale-105 transition-transform duration-200">
                        {{ $brand->name }}
                    </span>
                    <span class="text-[10px] text-neutral-400 group-hover:text-black uppercase tracking-widest mt-1.5 flex items-center gap-1">
                        Shop Now &rsaquo;
                    </span>
                </a>
            @endforeach
        </div>
    </section>
    <!-- END: DiscoverTheBrands Section -->

    <!-- BEGIN: SephoraServices -->
    <section class="pt-2 sm:pt-4" data-purpose="sephora-services">
        <div class="border-b-2 border-black pb-3 mb-6">
            <span class="text-[11px] sm:text-xs font-black uppercase tracking-widest text-neutral-600">At Your Service</span>
            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black uppercase tracking-tight mt-0.5">Sephora Services</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <!-- Gift Cards -->
            <div class="bg-neutral-900 text-white p-6 sm:p-8 rounded-sm relative overflow-hidden flex flex-col justify-between min-h-[220px]">
                <div class="relative z-10 max-w-md">
                    <span class="text-[10px] font-black uppercase tracking-widest text-neutral-400">Perfect Gift</span>
                    <h4 class="text-xl sm:text-2xl font-bold tracking-tight mt-1">{{ __('ui.gift_cards') }}</h4>
                    <p class="text-xs sm:text-sm text-neutral-300 mt-1 leading-relaxed">Beauty that Fits Every Wish. Deliver joy instantly via email or physical cards.</p>
                </div>
                <div class="relative z-10 pt-4">
                    <a href="/gift-cards" class="inline-block bg-white text-black font-bold uppercase text-xs px-6 py-2.5 rounded-sm hover:bg-neutral-200 transition-colors">
                        DISCOVER
                    </a>
                </div>
            </div>

            <!-- Stores -->
            <div class="bg-neutral-100 text-black border border-neutral-300 p-6 sm:p-8 rounded-sm relative overflow-hidden flex flex-col justify-between min-h-[220px]">
                <div class="relative z-10 max-w-md">
                    <span class="text-[10px] font-black uppercase tracking-widest text-neutral-600">Store Locator</span>
                    <h4 class="text-xl sm:text-2xl font-bold tracking-tight mt-1">Visit our Stores</h4>
                    <p class="text-xs sm:text-sm text-neutral-600 mt-1 leading-relaxed">Find a boutique near you across Dubai, Abu Dhabi, Sharjah &amp; all Emirates.</p>
                </div>
                <div class="relative z-10 pt-4">
                    <a href="/stores" class="inline-block bg-black text-white font-bold uppercase text-xs px-6 py-2.5 rounded-sm hover:bg-neutral-800 transition-colors">
                        OUR STORES
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END: SephoraServices -->

    <!-- BEGIN: ValueBannersAndServices (4 Value Pillars) -->
    <section class="border-t border-b border-neutral-200 py-8 my-6 bg-white" data-purpose="services-banner">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mb-2.5">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-black">{{ __('ui.free_delivery') }}</h4>
                <p class="text-xs text-neutral-500 mt-1">Over 250 AED</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mb-2.5">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-black">{{ __('ui.secure_payment') }}</h4>
                <p class="text-xs text-neutral-500 mt-1">100% Secure Checkout</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mb-2.5">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-black">{{ __('ui.easy_returns') }}</h4>
                <p class="text-xs text-neutral-500 mt-1">In any UAE store</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mb-2.5">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-black">{{ __('ui.customer_service') }}</h4>
                <p class="text-xs text-neutral-500 mt-1">Questions? Call 800-SEPHORA</p>
            </div>
        </div>
    </section>
    <!-- END: ValueBannersAndServices -->

</main>
@endsection
