@extends('layouts.app')

@section('title', 'Beauty Offers | SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- MAIN CANVAS -->
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- 3. BREADCRUMBS -->
<nav aria-label="Breadcrumb" class="py-space-md">
<ol class="flex items-center gap-space-xs font-label-caps text-label-caps text-on-surface-variant tracking-wider uppercase">
<li>
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
</li>
<li class="select-none text-outline">/</li>
<li aria-current="page" class="text-primary font-bold">{{ __('ui.beauty_offers') }}</li>
</ol>
</nav>
<!-- 4. PAGE HEADER & QUICK FILTER CHIPS -->
<section class="pb-space-xl pt-2">
<div class="border-b border-outline-variant pb-space-lg">
<h1 class="font-headline-lg text-headline-lg md:text-display-hero text-primary tracking-tight">{{ __('ui.beauty_offers') }}</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mt-space-xs max-w-2xl">
          Explore our exclusive gifts with purchase, deluxe samples, and limited-edition beauty bundles.
        </p>
<!-- Filter Chips (0px geometry, crisp hairline outline) -->
<div class="flex items-center gap-space-xs md:gap-space-sm flex-wrap mt-space-lg pt-space-xs">
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-4 py-2 border border-primary transition-colors duration-150" type="button">
            All Offers (19)
          </button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">{{ __('ui.fragrance') }}</button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">{{ __('ui.makeup') }}</button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">{{ __('ui.skincare') }}</button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">
            Haircare
          </button>
<button class="bg-surface-container-lowest text-on-surface-variant hover:text-primary border border-outline-variant hover:border-primary font-label-caps text-label-caps px-4 py-2 transition-colors duration-150" type="button">
            Sephora Collection
          </button>
</div>
</div>
</section>
<!-- 5. BEAUTY OFFERS CARDS GRID (19 REAL PROMOTIONAL OFFERS) -->
<section class="pb-space-xl">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-gutter">
<!-- CARD 1: NUXE -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="NUXE Summer Pouch" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/glow_recipe_watermelon_glow_niacinamide_dew_drops_pink_glass_serum_bottle.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">NUXE</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Summer Pouch</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">On purchase of any 2 products from Nuxe</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 2: TARTE -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">ONLY AT SEPHORA</span>
<img alt="TARTE Star Brush" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/l_occitane_en_provence_shea_butter_ultra_rich_body_cream_luxury_silver_lid_tin.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">TARTE</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Get a Star Brush Free</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">A little Star Brush for your beauty bag when you purchase any 2 full-size products</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 3: NARCISO RODRIGUEZ -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="Narciso Rodriguez Patchouli Musc" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/gisou_honey_infused_hair_oil_luxury_glass_dropper_bottle_with_golden_honey_oil.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">NARCISO RODRIGUEZ</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Patchouli Musc Eau de Parfum Intense 10ml</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Buy any Narciso Rodriguez fragrance and enjoy an exclusive gift</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 4: RABANNE -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="Rabanne Million Gold" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/sephora_brow_bar_by_benefit_or_beauty_consultation_service_expert_brow_styling.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">RABANNE</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Million Gold Eau de Parfum Intense 5ml Miniature</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Buy any Rabanne fragrance and enjoy an exclusive gift</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 5: PRADA -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">ONLY AT SEPHORA</span>
<img alt="Prada Deluxe Wisteria Balm" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/modern_luxury_sephora_beauty_flagship_store_interior_sleek_monochrome_black_and.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">PRADA</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Deluxe Prada Wisteria Balm</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Enjoy the lip balm on purchase of any Prada makeup!</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 6: NARS -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">ONLY AT SEPHORA</span>
<img alt="NARS Powermatte Lip Pencil Duos" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/luxury_bottle_of_kayali_vanilla_28_or_yum_pistachio_gelato_perfume_high_end.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">NARS</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Nars Powermatte Lip Pencil Duos</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Purchase of any 2 Nars products to avail the gift.</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 7: ELEMIS -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">ONLY AT SEPHORA</span>
<img alt="ELEMIS Dynamic Resurfacing Facial Wash" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/luxury_smartphone_mockup_showing_sephora_mobile_beauty_shopping_app_interface.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">ELEMIS</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Dynamic Resurfacing Facial Wash 30ml</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">On any purchase from Elemis</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 8: COLOR WOW -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="Color Wow Dream Coat Supernatural Spray" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/maison_francis_kurkdjian_baccarat_rouge_540_eau_de_parfum_bottle_iconic_red.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">COLOR WOW</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Dream Coat Supernatural Spray 50ml</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">On purchase of any 2 products from Color Wow</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 9: TATCHA -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">ONLY AT SEPHORA</span>
<img alt="Tatcha Brightening Serum" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/luxury_black_and_white_striped_sephora_gift_card_on_an_elegant_sleek_marble.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">TATCHA</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Brightening Serum 5ml</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">On purchase of any full size product from Tatcha</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 10: MILK MAKEUP -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="Milk Makeup Concealer Brush" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/natasha_denona_glam_or_bronze_eyeshadow_palette_open_showing_shimmering.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">MILK MAKEUP</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Milk Makeup Concealer Brush</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Avail the above gift on purchase of any 2 products from Milk Makeup</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 11: BIODANCE -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="Biodance Serum Sample Trio" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/drunk_elephant_protini_polypeptide_cream_teal_and_white_jar_luxury_skincare.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">BIODANCE</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Serum Sample Trio</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">On purchase of any 2 products from Biodance</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 12: CLARINS -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="Clarins Pouch with Minis" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/luxury_beauty_services_at_sephora_professional_makeup_artist_applying_glam.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">CLARINS</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Pouch with Minis</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">On purchase of 3 products from Clarins</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 13: HOURGLASS -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="Hourglass Beauty Essentials" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/ouai_st__barts_body_cleanser_luxury_minimalist_bottle_with_pump_clean_studio.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">HOURGLASS</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Your Beauty Essentials, Beautifully Stored</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Get a makeup bag when you purchase any 2 full-size Hourglass products.</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 14: GUCCI -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="Gucci Flora Treat" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/k18_leave_in_molecular_repair_hair_mask_white_pump_bottle_with_pink_accent_high.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">GUCCI</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">A Floral Treat, Just for You</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Enjoy a complimentary Gucci Flora mirror &amp; eye mask with every 100ml fragrance purchase from the Gucci Flora collection.</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 15: HUDA BEAUTY -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">ONLY AT SEPHORA</span>
<img alt="Huda Beauty Gift" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/maison_francis_kurkdjian_baccarat_rouge_540_eau_de_parfum_bottle_iconic_red.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">HUDA BEAUTY</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Get your Huda Beauty Gift</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Avail the above gift on purchase of any Bronze Filter Palette</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 16: CAROLINA HERRERA -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<img alt="Carolina Herrera Good Girl Jasmine Absolute" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/natasha_denona_glam_or_bronze_eyeshadow_palette_open_showing_shimmering.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">CAROLINA HERRERA</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Good Girl Jasmine Absolute 7ml Miniature</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Enjoy a complimentary gift with the purchase of any 100ml fragrance from the brand.</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 17: BENEFIT -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">ONLY AT SEPHORA</span>
<img alt="Benefit Porefessional Sponge Applicator" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/qr_code_mockup_for_downloading_mobile_app_with_elegant_sephora_minimalist.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">BENEFIT</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Porefessional Sponge Applicator</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Get a free Sponge Applicator upon purchase of 1 POREfessional Concealer and any Benefit full-size product</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 18: URBAN DECAY -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">ONLY AT SEPHORA</span>
<img alt="Urban Decay Pouch and Minis" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/sephora_skincare_consultation_and_custom_beauty_bar_high_tech_skin_diagnostics.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">URBAN DECAY</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Urban Decay pouch &amp; mini bestsellers</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Purchase any 2 Urban Decay products and receive an Urban Decay Pouch + 2 Mini bestsellers</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
<!-- CARD 19: LANCÔME -->
<article class="group bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between transition-colors duration-200">
<div>
<div class="relative overflow-hidden aspect-[1.23] bg-surface-container-low border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-1 tracking-widest z-10">ONLY AT SEPHORA</span>
<img alt="Lancôme Idôle Set Miniature" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300" src="{{ asset('images/hero/yves_saint_laurent_libre_eau_de_parfum_bottle_studio_e_commerce_beauty_product.webp') }}"/>
</div>
<div class="p-space-md flex flex-col gap-1.5">
<span class="font-label-caps text-label-caps text-on-surface-variant tracking-widest uppercase">LANCÔME</span>
<h2 class="font-headline-sm text-headline-sm text-primary leading-tight">Idôle Set Miniature</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Avail the above gift on purchase of any 2 products from Lancôme.</p>
</div>
</div>
<div class="p-space-md pt-0 mt-2">
<a href="/shop" class="w-full bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps py-3 transition-colors duration-200">{{ __('ui.shop_now') }}</a>
</div>
</article>
</div>
</section>
<!-- 6. TRUST BADGES BAR -->
<section class="border-t border-b border-outline-variant py-space-xl my-space-xl">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter text-center lg:text-left">
<!-- Pillar 1 -->
<div class="flex items-center gap-space-md p-2 justify-center lg:justify-start">
<span class="material-symbols-outlined text-[32px] text-primary">local_shipping</span>
<div>
<h3 class="font-title-md text-title-md text-primary">{{ __('ui.free_delivery') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">On orders over 250 AED</p>
</div>
</div>
<!-- Pillar 2 -->
<div class="flex items-center gap-space-md p-2 justify-center lg:justify-start">
<span class="material-symbols-outlined text-[32px] text-primary">verified</span>
<div>
<h3 class="font-title-md text-title-md text-primary">{{ __('ui.authentic') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Direct from official brands</p>
</div>
</div>
<!-- Pillar 3 -->
<div class="flex items-center gap-space-md p-2 justify-center lg:justify-start">
<span class="material-symbols-outlined text-[32px] text-primary">store</span>
<div>
<h3 class="font-title-md text-title-md text-primary">Easy In-Store Returns</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">At any Sephora UAE store</p>
</div>
</div>
<!-- Pillar 4 -->
<div class="flex items-center gap-space-md p-2 justify-center lg:justify-start">
<span class="material-symbols-outlined text-[32px] text-primary">card_membership</span>
<div>
<h3 class="font-title-md text-title-md text-primary">{{ __('ui.beauty_pass_points') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Earn with every order</p>
</div>
</div>
</div>
</section>
<!-- 7. NEWSLETTER SECTION -->
<section class="py-space-xl mb-space-xl bg-surface-container-low border border-outline-variant p-space-lg text-center">
<div class="max-w-xl mx-auto flex flex-col items-center gap-space-sm">
<span class="material-symbols-outlined text-[28px] text-primary">mail</span>
<h2 class="font-headline-sm text-headline-sm text-primary">Stay Connected with Sephora</h2>
<p class="font-body-md text-body-md text-on-surface-variant">
          Sign up for exclusive offers, new product launches &amp; beauty advice.
        </p>
<form class="w-full flex flex-col sm:flex-row gap-2 mt-4" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="flex-1 bg-surface-container-lowest border border-outline px-4 py-3 font-body-sm text-body-sm text-on-surface focus:outline-none focus:border-primary placeholder:text-on-surface-variant rounded-none" placeholder="Enter your email address" required="" type="email"/>
<button class="bg-primary hover:bg-surface-container-lowest text-on-primary hover:text-primary border border-primary font-label-caps text-label-caps px-8 py-3 tracking-widest transition-colors duration-200" type="submit">
            SIGN UP
          </button>
</form>
</div>
</section>
</main>
<!-- 8. FOOTER (SHARED COMPONENT EXECUTION) -->
@endsection
