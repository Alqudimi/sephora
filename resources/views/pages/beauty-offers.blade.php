@extends('layouts.app')

@section('title', __('meta.beauty_offers'))
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
          {{ __('content.t_964b223afa02') }}
        </div>
<h1 class="font-headline-lg text-headline-lg text-primary uppercase tracking-tight mb-4">{{ __('ui.beauty_offers') }}</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-6">
          {{ __('content.t_db6b969475bc') }}
        </p>
<div class="flex flex-wrap items-center gap-6 text-body-sm font-label-caps text-on-surface-variant uppercase tracking-wider">
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-primary">auto_fix_high</span> {{ __('content.t_6e21d07cd409') }}</span>
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-primary">verified</span> {{ __('content.t_9dc710fefcca') }}</span>
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px] text-primary">inventory_2</span> {{ __('content.t_c3c2bc21d2b4') }}</span>
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
          {{ __('ui.all_offers_count_35') }}
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          {{ __('content.t_a785c722a82d') }}
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          {{ __('content.t_ca34a40bc972') }}
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          {{ __('content.t_4e0ed30f1930') }}
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          {{ __('content.t_d75b6819de8e') }}
        </button>
<button class="border border-outline-variant text-on-surface hover:border-primary px-4 py-2 text-label-caps font-label-caps uppercase tracking-wider whitespace-nowrap bg-surface-container-lowest transition-colors">
          {{ __('content.t_6cfca4c8fd8c') }}
        </button>
</div>
<!-- Sort Selection -->
<div class="flex items-center space-x-3 self-end md:self-auto">
<span class="text-body-sm font-label-caps uppercase text-outline">{{ __('content.t_9bb640e5a014') }}</span>
<select class="bg-surface-container-lowest border border-outline font-label-caps text-label-caps uppercase py-1.5 px-3 rounded-none focus:outline-none focus:border-primary text-on-surface cursor-pointer">
<option>{{ __('content.t_6b8ba94e683d') }}</option>
<option>{{ __('content.t_a025e1593549') }}</option>
<option>{{ __('content.t_50b61e0c8341') }}</option>
<option>{{ __('ui.brand_az') }}</option>
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
              {{ __('content.t_5259d8e60e65') }}
            </span>
<img alt="{{ __('content.t_a06e4257191d') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/qr_code_mockup_for_downloading_mobile_app_with_elegant_sephora_minimalist.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">NUXE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_f2e1a3b51c56') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_b8ac711d9d86') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_ff002eaa9b68') }}</a>
</div>
</article>
<!-- Card 2: Tarte Star Brush -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_7b61aa1ecac1') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_e6313cc64b97') }}" src="{{ asset('images/content/img_29a65c938ee04f17.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">TARTE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_ef2430595af4') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_f6cff8b12ce5') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_5d1e15b873d1') }}</a>
</div>
</article>
<!-- Card 3: Narciso Rodriguez Patchouli Musc 10ml -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_068325a1aa4c') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_9f3676381c23') }}" src="{{ asset('images/content/img_d5515c46c027760d.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_3f10fb00303d') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_c39c79d5a28d') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_c22ffa2e02c2') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_4775d1a242ec') }}</a>
</div>
</article>
<!-- Card 4: Youth To The People Water Bottle -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_cb2bf5f0f8a7') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_a647a757f104') }}" src="{{ asset('images/content/img_13c1dfe2b8ba358b.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_0cbcb5221857') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_11a50a8c8f43') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_6f75ec33e27b') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_03ef5a1041a5') }}</a>
</div>
</article>
<!-- Card 5: Rabanne Million Gold Miniature 5ml -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_4e47cf89b9bb') }}
            </span>
<img alt="{{ __('content.t_e5d51ce72e61') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/natasha_denona_glam_or_bronze_eyeshadow_palette_open_showing_shimmering.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">RABANNE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_ac29f01d5338') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_546b3c3d56a8') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_ba3efae884c4') }}</a>
</div>
</article>
<!-- Card 6: Prada Deluxe Wisteria Balm -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_e45a9be90ce7') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_b82d22f91667') }}" src="{{ asset('images/content/img_f55510eb9ee312ed.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">PRADA</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_d42bcea15f43') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_1655829cb40b') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_38c2bbe2ba92') }}</a>
</div>
</article>
<!-- Card 7: Nars Powermatte Duos -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_5c94854e2b14') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_be06e5382570') }}" src="{{ asset('images/content/img_b0ecdfdd6f170bf8.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">NARS</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_7f847b69061c') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_288de05847f3') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_50b33198d954') }}</a>
</div>
</article>
<!-- Card 8: Laneige Donut Keychain Cap -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_37a725d141e3') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_7f14739e1c11') }}" src="{{ asset('images/content/img_9ab4d130f1c6be0e.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">LANEIGE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_87a18535d822') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_9dad0b4f89ce') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_020b9a1b0af8') }}</a>
</div>
</article>
<!-- Card 9: Elemis Dynamic Resurfacing 30ml -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_3bc04d98a851') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_93561027fa70') }}" src="{{ asset('images/content/img_f94e8bff6537398b.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">ELEMIS</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_a4ca41843d23') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_7c8563bd6b69') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_36cb0b925c71') }}</a>
</div>
</article>
<!-- Card 10: Color Wow Dream Coat Spray 50ml -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_809e585b918a') }}
            </span>
<img alt="{{ __('content.t_d393ac2df381') }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_64342687abdf467c.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_0b95d626b4f2') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_267712ed71b5') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_1e4d6af1ba9e') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_82e099cf5645') }}</a>
</div>
</article>
<!-- Card 11: Tatcha Brightening Serum 5ml -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_a1ce78ae79f0') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_7b19d545374b') }}" src="{{ asset('images/content/img_66eeb2e01888735b.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">TATCHA</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_40660270f230') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_9d9c20737ddb') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_f0d2c1793b74') }}</a>
</div>
</article>
<!-- Card 12: Milk Makeup Concealer Brush -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_b20c147c7e19') }}
            </span>
<img alt="{{ __('content.t_e99ac5366638') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/sol_de_janeiro_brazilian_bum_bum_cream_vibrant_yellow_jar_with_white_cap_luxury.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_2dcd5b8905c1') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_e99ac5366638') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_ba47277f321c') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_21dc377d1b65') }}</a>
</div>
</article>
<!-- Card 13: Biodance Serum Sample Trio -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_6696899d932f') }}
            </span>
<img alt="{{ __('content.t_efc53bc76afe') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/k18_leave_in_molecular_repair_hair_mask_white_pump_bottle_with_pink_accent_high.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">BIODANCE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_b2425f1ea042') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_9d669643c766') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_949124dad4e9') }}</a>
</div>
</article>
<!-- Card 14: BBB London The Chic Mirror Sleeve -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              ACCESSORY
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_6ceb439ce69e') }}" src="{{ asset('images/content/img_b1e0691c21c80697.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_3a1b3fe573d7') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_a40d4040d880') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_4348ce3513ad') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_cd7529fc306a') }}</a>
</div>
</article>
<!-- Card 15: Clarins Pouch with Minis -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_498dcb1cd141') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_d883c023abe0') }}" src="{{ asset('images/content/img_f2119405498dd8c4.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">CLARINS</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_8c7d038ef13d') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_2acefaf3248d') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_8dbc7d2b7c47') }}</a>
</div>
</article>
<!-- Card 16: Hourglass Luxury Makeup Bag -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_27e6ba2a93b9') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_96955e3ca3e3') }}" src="{{ asset('images/content/img_d0e12a2bc9a7d42b.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">HOURGLASS</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_55ab9143a9a5') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_f06b5914702b') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_1dda5de60ca8') }}</a>
</div>
</article>
<!-- Card 17: Gucci Flora Mirror & Eye Mask -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_bd6ca7dc7dc0') }}
            </span>
<img alt="{{ __('content.t_515ce61fc46d') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/luxury_black_and_white_striped_sephora_gift_card_on_an_elegant_sleek_marble.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">GUCCI</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_64d429444fc6') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_97737a7dc563') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_75cd559049bd') }}</a>
</div>
</article>
<!-- Card 18: Carolina Herrera Good Girl Jasmine Absolute 7ml -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_56f506c1664f') }}
            </span>
<img alt="{{ __('content.t_53f69c2fc447') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/drunk_elephant_protini_polypeptide_cream_teal_and_white_jar_luxury_skincare.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_046c1d9503bb') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_53f69c2fc447') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_8b8a9ed35190') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_2bf9924e9377') }}</a>
</div>
</article>
<!-- Card 19: Huda Beauty Bronze Filter Palette Gift -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_04c0c7fce676') }}
            </span>
<img alt="{{ __('content.t_ec4f66b62e8f') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/qr_code_mockup_for_downloading_mobile_app_with_elegant_sephora_minimalist.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_d6675db98e96') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_e73ea0294738') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_1a7cd12fe93b') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_ae606ddb18cc') }}</a>
</div>
</article>
<!-- Card 20: Benefit POREfessional Sponge -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_75b83ae8fda4') }}
            </span>
<img alt="{{ __('content.t_0951e8259776') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/hero/tartelette_in_bloom_clay_eyeshadow_palette_open_with_mirror_showing_12_neutral.webp') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">BENEFIT</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_dac65c9decae') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_4dc571e46b30') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_9c930e3dbcce') }}</a>
</div>
</article>
<!-- Card 21: Urban Decay Pouch & Mini Bestsellers -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_8bec8ca8d0d4') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_c216f32d7659') }}" src="{{ asset('images/content/img_b72cb6750298b70a.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_6a8278fe00c8') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_3db3ec1369e4') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_d5df4ce1a2e6') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_a14a0af930ad') }}</a>
</div>
</article>
<!-- Card 22: Lancôme Idôle Set Miniature -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_6f80612365d6') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_b18b5fb9fad6') }}" src="{{ asset('images/content/img_86c814e3a71a7738.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_070fb3f5c3c6') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_5d82d6caf9f9') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_68cef1937c6b') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_b64c921282b8') }}</a>
</div>
</article>
<!-- Card 23: Maison Margiela Replica Totebag -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_d8c5c06d6170') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_e07ae14dbbd4') }}" src="{{ asset('images/content/img_a37566368ed47806.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_be31ba2c1ccd') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_b1316e0623d3') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_ec7b6732d218') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_aa5ade03372c') }}</a>
</div>
</article>
<!-- Card 24: Moonglaze Disco Ball Keychain -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('ui.trending_caps') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_18e279b736aa') }}" src="{{ asset('images/content/img_5906b63ae9b02a83.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">MOONGLAZE</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_86a4cce5c858') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_74dd39b1ca1e') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_bcd12b0f9af9') }}</a>
</div>
</article>
<!-- Card 25: Fugazzi Canvas Totebag XL -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_36c142873e44') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_cbaaa266cef1') }}" src="{{ asset('images/content/img_4370ee2033cc2dbe.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">FUGAZZI</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_54438046b4b5') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_65f24606492f') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_5888190f4fed') }}</a>
</div>
</article>
<!-- Card 26: Slip Single Skinny Scrunchie -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_b3d94e36fdcd') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_0584681a0619') }}" src="{{ asset('images/content/img_d6e20d8e62bbcf85.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">SLIP</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_55d5eec8e4d3') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_27821ea1e0c7') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_dd3d04bc7554') }}</a>
</div>
</article>
<!-- Card 27: Rare Beauty Soft Pinch Blush Deluxe -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_5f4644fa5580') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_3e2e524c0578') }}" src="{{ asset('images/content/img_a01311f0e4ad8f4d.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_bd5f1e1ea5d0') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_e73eceb0cbaa') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_a4a0fca1630c') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_06dc00e80191') }}</a>
</div>
</article>
<!-- Card 28: Burberry Luxury GWP -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_0f8cdacef9ca') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_8033302053c9') }}" src="{{ asset('images/content/img_c03fe87dd9b9dcf2.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">BURBERRY</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_beed9b84c694') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_6b07aa3c2275') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_adcbbbabb7e0') }}</a>
</div>
</article>
<!-- Card 29: Jean Paul Gaultier La Belle 6ml -->
<article class="border border-outline-variant hover:border-primary bg-surface-container-lowest flex flex-col justify-between group transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_79e2c44b739f') }}
            </span>
<img class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" data-alt="{{ __('content.t_c197a862bdd0') }}" src="{{ asset('images/content/img_45325766470b3402.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_d353c1c0fc5b') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_b83bc3af8d31') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_ddc88f7a7c5d') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_d62e39db5da7') }}</a>
</div>
</article>
<!-- Card 30: Maison Francis Kurkdjian Baccarat Rouge 540 5ml -->
<article class="border border-primary bg-surface-container-lowest flex flex-col justify-between group hover:border-primary transition-all">
<div>
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-high border-b border-outline-variant flex items-center justify-center p-6">
<span class="absolute top-0 left-0 bg-secondary text-on-secondary font-label-tag text-label-tag px-2.5 py-1 z-10 uppercase">
              {{ __('content.t_9fca7460fece') }}
            </span>
<img alt="{{ __('content.t_833f99c5fc67') }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_9fc7f307517320b3.jpg') }}"/>
</div>
<div class="p-5">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_e4868601b50d') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-2">{{ __('content.t_8023a3d35013') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_7314472d0dee') }}
            </p>
</div>
</div>
<div class="p-5 pt-0">
<a href="/shop" class="w-full bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border-primary border border-primary font-label-caps text-label-caps uppercase py-3 transition-colors">{{ __('content.t_e6515aa87a9b') }}</a>
</div>
</article>
</section>
<!-- SECTION: HOW TO CLAIM YOUR BEAUTY OFFERS -->
<section class="mt-16 border border-primary bg-surface-container-lowest p-8 md:p-12">
<div class="max-w-2xl mb-8">
<span class="font-label-caps text-label-caps uppercase text-outline block mb-1">{{ __('content.t_554c2809703b') }}</span>
<h2 class="font-headline-md text-headline-md text-primary uppercase">{{ __('content.t_9c62d5f02ea8') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-2">
          {{ __('content.t_4ef175114eec') }}
        </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 border-t border-outline-variant pt-8">
<div class="flex items-start space-x-4">
<span class="font-display-hero text-headline-lg text-primary leading-none">01</span>
<div>
<h3 class="font-title-md text-title-md uppercase font-bold text-primary mb-1">{{ __('content.t_7b395ac88ec3') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_913ab0323d08') }}
            </p>
</div>
</div>
<div class="flex items-start space-x-4">
<span class="font-display-hero text-headline-lg text-primary leading-none">02</span>
<div>
<h3 class="font-title-md text-title-md uppercase font-bold text-primary mb-1">{{ __('content.t_5428ccdee78a') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_ca72cb244022') }}
            </p>
</div>
</div>
<div class="flex items-start space-x-4">
<span class="font-display-hero text-headline-lg text-primary leading-none">03</span>
<div>
<h3 class="font-title-md text-title-md uppercase font-bold text-primary mb-1">{{ __('content.t_8f757bd6b9f5') }}</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
              {{ __('content.t_16a159f75b3c') }}
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
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_d5ddb243405b') }}</p>
</div>
<div class="p-4 border-r border-outline-variant last:border-none">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">verified_user</span>
<h4 class="font-title-md text-title-md uppercase font-bold text-primary">{{ __('ui.authentic') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_3727deb206ce') }}</p>
</div>
<div class="p-4 border-r border-outline-variant last:border-none">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">replay</span>
<h4 class="font-title-md text-title-md uppercase font-bold text-primary">{{ __('ui.easy_returns') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_de87fa640461') }}</p>
</div>
<div class="p-4">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">support_agent</span>
<h4 class="font-title-md text-title-md uppercase font-bold text-primary">{{ __('ui.customer_service') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('ui.dedicated_support') }}</p>
</div>
</div>
</section>
<!-- SECTION: NEWSLETTER SUBSCRIPTION -->
<section class="mt-12 mb-16 bg-primary text-on-primary p-8 md:p-12 text-center max-w-4xl mx-auto border border-primary">
<span class="font-label-caps text-label-caps uppercase text-outline-variant block mb-2">{{ __('content.t_18891874ae4b') }}</span>
<h2 class="font-headline-md text-headline-md uppercase mb-3">{{ __('content.t_e01e16e1c2df') }}</h2>
<p class="font-body-md text-body-md text-surface-container-highest max-w-xl mx-auto mb-6">
        {{ __('content.t_9b3275b51822') }}
      </p>
<form class="flex flex-col sm:flex-row gap-3 justify-center max-w-md mx-auto" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="bg-surface-container-lowest border border-outline text-primary font-body-sm text-body-sm px-4 py-3 rounded-none focus:outline-none focus:ring-0 flex-1 placeholder:text-outline" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="bg-surface-container-lowest text-primary hover:bg-secondary hover:text-on-secondary font-label-caps text-label-caps uppercase px-6 py-3 transition-colors" type="submit">
          {{ __('ui.subscribe') }}
        </button>
</form>
</section>
</main>
<!-- FOOTER (Exact JSON Shared Component Specifications) -->
@endsection
