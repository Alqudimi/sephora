@extends('layouts.app')

@section('title', 'Beauty Offers | SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- MAIN CANVAS -->
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- BREADCRUMBS -->
<nav class="flex items-center space-x-2 text-outline font-label-caps text-label-caps uppercase mb-6">
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span>/</span>
<span class="text-primary font-bold">{{ __('ui.beauty_offers') }}</span>
</nav>
<!-- EDITORIAL HERO HEADER & BANNER -->
<section class="border border-primary bg-surface-container-lowest p-8 md:p-12 mb-10 relative overflow-hidden">
<div class="max-w-3xl relative z-10">
<div class="inline-block bg-primary text-on-primary font-label-caps text-label-caps uppercase px-2.5 py-1 mb-3">
          Complimentary Gifts &amp; Deluxe Treats
        </div>
<h1 class="font-headline-lg text-headline-lg text-primary uppercase tracking-tight mb-4">{{ __('ui.beauty_offers') }}</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-6">
          Discover our exclusive complimentary gifts, limited-edition deluxe miniatures, and brand offers available with your purchases online across the UAE. Valid while promotional supplies last.
        </p>
<div class="flex flex-wrap items-center gap-6 text-body-sm font-label-caps text-on-surface-variant uppercase tracking-wider">
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-primary">auto_fix_high</span> Auto-applied in basket</span>
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-primary">verified</span> 100% Authentic Brands</span>
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-primary">inventory_2</span> Deluxe miniatures &amp; GWPs</span>
</div>
</div>
<!-- Decorative High-Fashion Hairline Brand Tag -->
<div class="absolute right-0 bottom-0 text-[120px] font-display-hero uppercase text-surface-container font-black select-none pointer-events-none -mr-10 -mb-10 opacity-40">
        SEPHORA
      </div>
</section>
<!-- FILTER & SORT CONTROLS -->
<section class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 mb-8 pb-4 border-b border-outline-variant">
<!-- Filter Chips -->
<div class="flex items-center gap-2 overflow-x-auto custom-scroll pb-2 md:pb-0">
<button class="bg-primary text-on-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap transition-colors">
          All Offers (35)
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          Fragrance Gifts
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          Skincare Treats
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          Makeup Exclusives
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          Haircare Gifts
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          Brand GWPs
        </button>
</div>
<!-- Sort Selection -->
<div class="flex items-center space-x-3 self-end md:self-auto">
<span class="text-body-sm font-label-caps uppercase text-outline">Sort by:</span>
<select class="bg-surface-container-lowest border border-outline font-label-caps text-label-caps uppercase py-1.5 px-3 rounded-none focus:outline-none focus:border-primary text-on-surface cursor-pointer">
<option>Featured Offers</option>
<option>Newest Additions</option>
<option>Expiring Soon</option>
<option>Brand A-Z</option>
</select>
</div>
</section>
<!-- OFFERS BENTO / VITRINE GRID (30 PRESTIGIOUS OFFERS) -->
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
<!-- Card 1: Nuxe Summer Pouch -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              DELUXE GIFT
            </span>
<img alt="Nuxe Summer Pouch" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/qr_code_mockup_for_downloading_mobile_app_with_elegant_sephora_minimalist.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">NUXE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Summer Pouch</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              On purchase of any 2 products from Nuxe
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP NUXE</a>
</div>
</article>
<!-- Card 2: Tarte Star Brush -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              FREE GIFT
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="A minimalist studio still life of a sleek metallic star-shaped cosmetic brush from Tarte resting on a pristine white marble vanity against a high-contrast luxury studio background. High-key soft editorial lighting, ultra-sharp detail, monochrome contrast with subtle rose accents." src="{{ asset('images/content/img_29a65c938ee04f17.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">TARTE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Get a Star Brush Free</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              A little Star Brush for your beauty bag when you purchase any 2 full-size products
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP TARTE</a>
</div>
</article>
<!-- Card 3: Narciso Rodriguez Patchouli Musc 10ml -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              FRAGRANCE MINI
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Narciso Rodriguez Patchouli Musc 10ml deluxe travel fragrance miniature bottle photographed in an architectural gallery setting with deep black accents, crisp clean light, and pure luxury aesthetic. Ultra refined packaging photography." src="{{ asset('images/content/img_d5515c46c027760d.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">NARCISO RODRIGUEZ</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Patchouli Musc Eau de Parfum Intense 10ml</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Buy any Narciso Rodriguez fragrance and enjoy an exclusive gift
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP NARCISO RODRIGUEZ</a>
</div>
</article>
<!-- Card 4: Youth To The People Water Bottle -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              ECO GWP
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Youth to the People branded frosted glass water bottle with black lid displayed in a clean contemporary architectural light setting with soft shadows, minimal styling and Sephora luxury beauty composition." src="{{ asset('images/content/img_13c1dfe2b8ba358b.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">YOUTH TO THE PEOPLE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">YTTP Glass Water Bottle</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              On purchase of YTTP Superfood Protein Balm
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP YTTP</a>
</div>
</article>
<!-- Card 5: Rabanne Million Gold Miniature 5ml -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              GOLD EXCLUSIVE
            </span>
<img alt="Rabanne Million Gold 5ml Miniature" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/natasha_denona_glam_or_bronze_eyeshadow_palette_open_showing_shimmering.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">RABANNE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Million Gold Eau de Parfum Intense 5ml Miniature</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Buy any Rabanne fragrance and enjoy an exclusive gift
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP RABANNE</a>
</div>
</article>
<!-- Card 6: Prada Deluxe Wisteria Balm -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              COUTURE BEAUTY
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Prada Beauty luxury lip balm packaging with iconic Prada green and silver triangle logo in a museum vitrine studio setup with pure white high-key lighting and couture minimal composition." src="{{ asset('images/content/img_f55510eb9ee312ed.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">PRADA</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Deluxe Prada Wisteria Balm</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Enjoy the lip balm on purchase of any Prada makeup!
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP PRADA</a>
</div>
</article>
<!-- Card 7: Nars Powermatte Duos -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              MAKEUP DUO
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Nars Powermatte Lip Pencil Duos displayed on a monochrome geometric pedestal, high-contrast black matte packaging with rich pigment swatches in a luxury editorial beauty shoot setting." src="{{ asset('images/content/img_b0ecdfdd6f170bf8.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">NARS</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Nars Powermatte Lip Pencil Duos</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Purchase of any 2 Nars products to avail the gift.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP NARS</a>
</div>
</article>
<!-- Card 8: Laneige Donut Keychain Cap -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              LIMITED EDITION
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="A playful designer collectible donut keychain cap for Laneige lip sleeping mask sitting on a light pastel pedestal in a pristine high-key cosmetics shoot, Parisian aesthetic." src="{{ asset('images/content/img_9ab4d130f1c6be0e.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">LANEIGE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Donut Keychain Cap</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              On purchase of any 2 full size products from Laneige
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP LANEIGE</a>
</div>
</article>
<!-- Card 9: Elemis Dynamic Resurfacing 30ml -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              SKINCARE MINI
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Elemis Dynamic Resurfacing Facial Wash 30ml sleek white tube displayed next to pristine water reflections and clean white marble background with crisp clinical lighting." src="{{ asset('images/content/img_f94e8bff6537398b.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">ELEMIS</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Dynamic Resurfacing Facial Wash 30ml</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              On any purchase from Elemis
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP ELEMIS</a>
</div>
</article>
<!-- Card 10: Color Wow Dream Coat Spray 50ml -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              HAIRCARE ICON
            </span>
<img alt="Color Wow Dream Coat Spray 50ml" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_64342687abdf467c.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">COLOR WOW</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Dream Coat Supernatural Spray 50ml</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              On purchase of any 2 products from Color Wow
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP COLOR WOW</a>
</div>
</article>
<!-- Card 11: Tatcha Brightening Serum 5ml -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              J-BEAUTY LUXURY
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Tatcha Brightening Serum 5ml miniature violet dropper bottle perched on white raked sand with Japanese zen aesthetic, soft diffuse studio light and minimalist perfection." src="{{ asset('images/content/img_66eeb2e01888735b.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">TATCHA</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Brightening Serum 5ml</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              On purchase of any full size product from Tatcha
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP TATCHA</a>
</div>
</article>
<!-- Card 12: Milk Makeup Concealer Brush -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              BEAUTY TOOL
            </span>
<img alt="Milk Makeup Concealer Brush" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/sol_de_janeiro_brazilian_bum_bum_cream_vibrant_yellow_jar_with_white_cap_luxury.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">MILK MAKEUP</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Milk Makeup Concealer Brush</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Avail the above gift on purchase of any 2 products from Milk Makeup
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP MILK MAKEUP</a>
</div>
</article>
<!-- Card 13: Biodance Serum Sample Trio -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              K-BEAUTY TRIO
            </span>
<img alt="Biodance Serum Sample Trio" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/k18_leave_in_molecular_repair_hair_mask_white_pump_bottle_with_pink_accent_high.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">BIODANCE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Serum Sample Trio</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              On purchase of any 2 products from Biodance
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP BIODANCE</a>
</div>
</article>
<!-- Card 14: BBB London The Chic Mirror Sleeve -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              ACCESSORY
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="BBB London compact travel mirror nestled in an elegant black pebbled leather protective sleeve, photographed from above in a luxury handbag flatlay style with clean white studio lighting." src="{{ asset('images/content/img_b1e0691c21c80697.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">BBB LONDON</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">The Chic Mirror Sleeve</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Avail the above gift on purchase of any BBB London Products.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP BBB LONDON</a>
</div>
</article>
<!-- Card 15: Clarins Pouch with Minis -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              DELUXE BUNDLE
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Clarins red and white designer cosmetic travel pouch packed with deluxe skincare miniature tubes, positioned on a crisp clean white surface with editorial lighting." src="{{ asset('images/content/img_f2119405498dd8c4.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">CLARINS</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Pouch with Minis</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              On purchase of 3 products from Clarins
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP CLARINS</a>
</div>
</article>
<!-- Card 16: Hourglass Luxury Makeup Bag -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              VIP GWP
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Hourglass Cosmetics gleaming deep bronze metallic luxury makeup bag with gold zipper detail resting on minimalist black plinth, Parisian elegance." src="{{ asset('images/content/img_d0e12a2bc9a7d42b.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">HOURGLASS</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Your Beauty Essentials, Beautifully Stored</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Get a makeup bag when you purchase any 2 full-size Hourglass products.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP HOURGLASS</a>
</div>
</article>
<!-- Card 17: Gucci Flora Mirror & Eye Mask -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              HIGH COUTURE
            </span>
<img alt="Gucci Flora Mirror and Eye Mask" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/luxury_black_and_white_striped_sephora_gift_card_on_an_elegant_sleek_marble.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">GUCCI</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">A Floral Treat, Just for You</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Enjoy a complimentary Gucci Flora mirror &amp; eye mask with every 100ml fragrance purchase from the Gucci Flora collection.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP GUCCI</a>
</div>
</article>
<!-- Card 18: Carolina Herrera Good Girl Jasmine Absolute 7ml -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              FRAGRANCE DELUXE
            </span>
<img alt="Good Girl Jasmine Absolute 7ml Miniature" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/drunk_elephant_protini_polypeptide_cream_teal_and_white_jar_luxury_skincare.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">CAROLINA HERRERA</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Good Girl Jasmine Absolute 7ml Miniature</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Enjoy a complimentary gift with the purchase of any 100ml fragrance from the brand.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP CAROLINA HERRERA</a>
</div>
</article>
<!-- Card 19: Huda Beauty Bronze Filter Palette Gift -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              ICONIC ME
            </span>
<img alt="Huda Beauty Gift Bronze Filter" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/qr_code_mockup_for_downloading_mobile_app_with_elegant_sephora_minimalist.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">HUDA BEAUTY</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Get your Huda Beauty Gift</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Avail the above gift on purchase of any Bronze Filter Pallette
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP HUDA BEAUTY</a>
</div>
</article>
<!-- Card 20: Benefit POREfessional Sponge -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              SPECIAL EDITION
            </span>
<img alt="Benefit POREfessional Sponge Applicator" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/tartelette_in_bloom_clay_eyeshadow_palette_open_with_mirror_showing_12_neutral.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">BENEFIT</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Porefessional Sponge Applicator</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Get a free Sponge Applicator- Upon purchase of 1 POREfessional Concealer and any Benefit full-size product
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP BENEFIT</a>
</div>
</article>
<!-- Card 21: Urban Decay Pouch & Mini Bestsellers -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              EDGY DELUXE
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Urban Decay edgy black crinkle makeup pouch with graffiti graphics next to mini setting spray bottle and eyeliner pencil on bright studio light background." src="{{ asset('images/content/img_b72cb6750298b70a.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">URBAN DECAY</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Urban Decay pouch &amp; mini bestsellers</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Purchase any 2 Urban decay products and receive an Urban Decay Pouch + 2 Mini bestsellers
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP URBAN DECAY</a>
</div>
</article>
<!-- Card 22: Lancôme Idôle Set Miniature -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              FRENCH COUTURE
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Lancôme Idôle slim architectural glass miniature bottle in ultra luxury high-contrast beauty studio setting with rose-gold metallic accents and bright clean aesthetic." src="{{ asset('images/content/img_86c814e3a71a7738.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">LANCÔME</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Idôle Set Miniature</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Avail the above gift on purchase of any 2 products from Lancôme.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP LANCÔME</a>
</div>
</article>
<!-- Card 23: Maison Margiela Replica Totebag -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              AVANT-GARDE
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Maison Margiela Replica unbleached canvas tote bag featuring raw cotton texture and the iconic numeric label printed sharply in black ink, captured in a sunlit architectural Parisian studio." src="{{ asset('images/content/img_a37566368ed47806.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">MAISON MARGIELA</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Maison Margiela Replica Totebag</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              With any purchase from Maison Margiela.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP MAISON MARGIELA</a>
</div>
</article>
<!-- Card 24: Moonglaze Disco Ball Keychain -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              TRENDING
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="A shimmering miniature disco ball mirror keychain casting prismatic reflections over a glossy vanity, high-fashion cosmetics commercial photograph with intense studio highlight." src="{{ asset('images/content/img_5906b63ae9b02a83.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">MOONGLAZE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Get a free Disco Ball Keychain</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Avail the above gift from Moonglaze with every Moonglow Highlighter purchase!
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP MOONGLAZE</a>
</div>
</article>
<!-- Card 25: Fugazzi Canvas Totebag XL -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              NICHE GWP
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Fugazzi Fragrances oversized heavy canvas tote bag in off-white with bold black brutalist typography, luxury niche perfumery aesthetic." src="{{ asset('images/content/img_4370ee2033cc2dbe.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">FUGAZZI</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Fugazzi Canvas Totebag XL</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Upon the purchase of any 50ml or 100ml fragrance
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP FUGAZZI</a>
</div>
</article>
<!-- Card 26: Slip Single Skinny Scrunchie -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              PURE SILK
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Pure mulberry black silk skinny hair scrunchie by Slip placed gracefully on an alabaster dish, ultra crisp high-contrast studio photograph, luxury light-mode." src="{{ asset('images/content/img_d6e20d8e62bbcf85.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">SLIP</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Slip Single Scrunchie – Black</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Receive a multi-award winning Slip skinny scrunchie when you spend 500 AED on Slip products
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP SLIP</a>
</div>
</article>
<!-- Card 27: Rare Beauty Soft Pinch Blush Deluxe -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              BESTSELLER MINI
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Rare Beauty Soft Pinch liquid blush miniature bottle with pale peach gold cap standing next to a soft dew droplet, high-fashion Sephora makeup photo." src="{{ asset('images/content/img_a01311f0e4ad8f4d.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">RARE BEAUTY</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Free Soft Pinch Liquid Blush Deluxe</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Upon the purchase of any 2 products from Rare Beauty.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP RARE BEAUTY</a>
</div>
</article>
<!-- Card 28: Burberry Luxury GWP -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              HERITAGE GIFT
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Burberry luxury signature check pattern cosmetic pouch and deluxe gold miniature bottle positioned in a minimalist architectural vitrine with bright white lighting." src="{{ asset('images/content/img_c03fe87dd9b9dcf2.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">BURBERRY</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Unlock the exclusive gift!</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              On purchases above AED 600 from the brand.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP BURBERRY</a>
</div>
</article>
<!-- Card 29: Jean Paul Gaultier La Belle 6ml -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              DELUXE MINIATURE
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="Jean Paul Gaultier sculpted torso perfume bottle in radiant crimson glass with golden rose collar miniature 6ml, opulent studio lighting, high contrast monochromatic set." src="{{ asset('images/content/img_45325766470b3402.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">JEAN PAUL GAULTIER</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">La Belle Rosea Eau de Parfum 6ml</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Purchase any Jean Paul Gaultier fragrance to avail this gift.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP JEAN PAUL GAULTIER</a>
</div>
</article>
<!-- Card 30: Maison Francis Kurkdjian Baccarat Rouge 540 5ml -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              PRESTIGE NICHE
            </span>
<img alt="Maison Francis Kurkdjian Baccarat Rouge 540" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_9fc7f307517320b3.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">MAISON FRANCIS KURKDJIAN</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">Baccarat Rouge 540 EDP 5ml</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Enjoy a complimentary gift with every purchase of an 70ml fragrance.
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">SHOP MAISON FRANCIS KURKDJIAN</a>
</div>
</article>
</section>
<!-- SECTION: HOW TO CLAIM YOUR BEAUTY OFFERS -->
<section class="mt-16 border border-primary bg-surface-container-lowest p-8 md:p-12">
<div class="max-w-2xl mb-8">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">TERMS &amp; REDEMPTION POLICY</span>
<h2 class="font-headline-md text-headline-md text-primary uppercase">How to Claim Your Beauty Offers</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-2">
          Complimentary gifts with purchase are automatically evaluated in real-time according to your bag contents.
        </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 border-t border-outline-variant pt-8">
<div class="flex items-start space-x-4">
<span class="font-display-hero text-headline-lg text-primary leading-none">01</span>
<div>
<h3 class="font-title-md text-title-md uppercase font-bold text-primary mb-1">Add Qualifying Items</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Select your favorite brand products that satisfy minimum quantity or cart spending limits described on the offer card.
            </p>
</div>
</div>
<div class="flex items-start space-x-4">
<span class="font-display-hero text-headline-lg text-primary leading-none">02</span>
<div>
<h3 class="font-title-md text-title-md uppercase font-bold text-primary mb-1">Automatic GWP Trigger</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              The qualifying complimentary deluxe miniatures, branded bags, or beauty gifts will appear in your online basket at checkout.
            </p>
</div>
</div>
<div class="flex items-start space-x-4">
<span class="font-display-hero text-headline-lg text-primary leading-none">03</span>
<div>
<h3 class="font-title-md text-title-md uppercase font-bold text-primary mb-1">Stock Availability</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              Offers are strictly valid while stocks last. One gift per transaction unless stated otherwise. Returns recalculate gift eligibility.
            </p>
</div>
</div>
</div>
</section>
<!-- SECTION: SEPHORA TRUST & SERVICE PILLARS -->
<section class="mt-12 py-10 border-y border-outline-variant bg-surface-container-lowest">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
<div class="p-4 border-r border-outline-variant last:border-none">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">local_shipping</span>
<h4 class="font-title-md text-title-md uppercase font-bold text-primary">{{ __('ui.free_delivery') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Over 250 AED across UAE</p>
</div>
<div class="p-4 border-r border-outline-variant last:border-none">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">verified_user</span>
<h4 class="font-title-md text-title-md uppercase font-bold text-primary">{{ __('ui.authentic') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Official brand partnerships</p>
</div>
<div class="p-4 border-r border-outline-variant last:border-none">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">replay</span>
<h4 class="font-title-md text-title-md uppercase font-bold text-primary">{{ __('ui.easy_returns') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">In any UAE store</p>
</div>
<div class="p-4">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">support_agent</span>
<h4 class="font-title-md text-title-md uppercase font-bold text-primary">{{ __('ui.customer_service') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Dedicated support (800 7374672)</p>
</div>
</div>
</section>
<!-- SECTION: NEWSLETTER SUBSCRIPTION -->
<section class="mt-12 mb-16 bg-primary text-on-primary p-8 md:p-12 text-center max-w-4xl mx-auto border border-primary">
<span class="font-label-caps text-label-caps uppercase text-outline-variant block mb-2">BEAUTY PASS EXCLUSIVE</span>
<h2 class="font-headline-md text-headline-md uppercase mb-3">Subscribe to the Sephora Newsletter</h2>
<p class="font-body-md text-body-md text-surface-container-highest max-w-xl mx-auto mb-6">
        Receive private preview access to Beauty Offers, tier point boosts, invitations to masterclasses, and secret promotional codes.
      </p>
<form class="flex flex-col sm:flex-row gap-3 justify-center max-w-md mx-auto" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="bg-surface-container-lowest border border-outline text-primary font-body-sm text-body-sm px-4 py-3 rounded-none focus:outline-none focus:ring-0 flex-1 placeholder:text-outline" placeholder="Enter your email address" required="" type="email"/>
<button class="bg-surface-container-lowest text-primary hover:bg-secondary hover:text-on-secondary font-label-caps text-label-caps uppercase px-6 py-3 transition-colors" type="submit">
          Subscribe
        </button>
</form>
</section>
</main>
<!-- FOOTER (Exact JSON Shared Component Specifications) -->
@endsection
