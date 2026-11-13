@extends('layouts.app')

@section('title', __('meta.stores'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- BREADCRUMBS -->
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-4">
<nav class="flex items-center space-x-2 text-[12px] font-body-sm text-outline">
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span>/</span>
<span class="text-primary font-bold">{{ __('ui.stores_services') }}</span>
</nav>
</div>
<!-- HERO SECTION -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pb-12">
<div class="relative bg-surface-container-lowest border border-primary overflow-hidden grid grid-cols-1 lg:grid-cols-{{ __('ui.items_count_label', ['count' => '12']) }}-stretch">
<!-- Content Column -->
<div class="lg:col-span-6 p-5 sm:p-8 md:p-14 lg:p-16 flex flex-col justify-center space-y-6 z-10 bg-surface-container-lowest">
<div class="inline-flex items-center space-x-2">
<span class="bg-primary text-on-primary text-[10px] font-label-caps uppercase px-2.5 py-1 tracking-widest">{{ __('content.t_dfe4d49754cc') }}</span>
<span class="text-[12px] font-label-caps uppercase text-secondary font-bold tracking-wider">{{ __('content.t_8735b0a0f051') }}</span>
</div>
<h1 class="font-display-hero text-2xl sm:text-[34px] md:text-headline-lg lg:text-display-hero leading-tight text-primary font-bold">
          {{ __('content.t_7da940b07116') }}
        </h1>
<p class="font-body-md text-on-surface-variant leading-relaxed text-[15px] max-w-xl">
          {{ __('content.t_1197480eaf24') }}
        </p>
<!-- CTA Buttons -->
<div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 pt-4">
<a class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:outline hover:outline-1 hover:outline-primary px-6 sm:px-8 py-3.5 font-label-caps text-label-caps tracking-widest transition-all duration-200 uppercase inline-flex items-center justify-center gap-3 text-center" href="#booking-section">
<span>{{ __('content.t_62d7ba96b18d') }}</span>
<span class="material-symbols-outlined text-[16px]">calendar_today</span>
</a>
<a class="bg-transparent border border-primary text-primary hover:bg-primary hover:text-on-primary px-6 sm:px-8 py-3.5 font-label-caps text-label-caps tracking-widest transition-all duration-200 uppercase inline-flex items-center justify-center gap-3 text-center" href="#locator">
<span>{{ __('content.t_540ab5aac52c') }}</span>
<span class="material-symbols-outlined text-[16px]">near_me</span>
</a>
</div>
<!-- Trust Mini Badges -->
<div class="pt-6 border-t border-outline-variant/60 grid grid-cols-3 gap-4 text-center md:text-left">
<div>
<p class="font-title-md text-[14px] font-bold text-primary">{{ __('ui.thirty_plus_salons') }}</p>
<p class="font-body-sm text-[11px] text-outline">{{ __('content.t_87820f98311e') }}</p>
</div>
<div>
<p class="font-title-md text-[14px] font-bold text-primary">{{ __('content.t_c8693179ca8e') }}</p>
<p class="font-body-sm text-[11px] text-outline">{{ __('content.t_48dc416557eb') }}</p>
</div>
<div>
<p class="font-title-md text-[14px] font-bold text-primary">{{ __('content.t_ccd01dcdbf66') }}</p>
<p class="font-body-sm text-[11px] text-outline">{{ __('content.t_4edb2a4a2da2') }}</p>
</div>
</div>
</div>
<!-- Image Column (Hero Packshot/Store Visual) -->
<div class="lg:col-span-6 relative min-h-[380px] lg:min-h-[560px] border-t lg:border-t-0 lg:border-l border-primary">
<img alt="{{ __('content.t_69059b2bb9cb') }}" class="w-full h-full object-cover grayscale contrast-125 hover:grayscale-0 transition-all duration-700" src="{{ asset('images/content/img_90fc51af9f1a91cf.jpg') }}"/>
<div class="absolute bottom-4 right-4 bg-primary text-on-primary px-3 py-1.5 font-label-caps text-[10px] tracking-widest">
          {{ __('content.t_de276be8102d') }}
        </div>
</div>
</div>
</section>
<!-- SERVICES MENU & BOOKING CARDS -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-12" id="booking-section">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-4 border-b border-primary">
<div>
<p class="font-label-caps text-secondary font-bold text-[12px] tracking-widest uppercase mb-1">{{ __('content.t_518cbf886c01') }}</p>
<h2 class="font-headline-md text-headline-md md:text-headline-lg font-bold text-primary tracking-tight">
          {{ __('content.t_be9ace38fc11') }}
        </h2>
</div>
<p class="font-body-sm text-outline-variant text-[13px] mt-2 md:mt-0 max-w-md">
        {{ __('content.t_4011427d9bea') }}
      </p>
</div>
<!-- 4 Services Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Service 1: BrowBar -->
<div class="border border-primary bg-surface-container-lowest flex flex-col group transition-all duration-200">
<div class="relative overflow-hidden aspect-[4/3] border-b border-primary">
<span class="absolute top-2 left-2 z-10 bg-primary text-on-primary text-[10px] font-label-caps px-2 py-0.5 tracking-widest uppercase">
            {{ __('content.t_7994f65b9f0e') }}
          </span>
<img alt="{{ __('content.t_661351033777') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_8e182dd2a6fc44aa.jpg') }}"/>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between text-outline text-[12px] font-label-caps mb-1">
<span>{{ __('content.t_00232ca2eb3a') }}</span>
<span class="flex items-center gap-1 font-bold text-primary"><span class="material-symbols-outlined text-[14px]">schedule</span> {{ __('ui.minutes_count', ['count' => 20]) }}</span>
</div>
<h3 class="font-headline-sm text-[20px] font-bold text-primary mb-2">{{ __('content.t_8504346a9755') }}</h3>
<p class="font-body-sm text-on-surface-variant text-[13px] leading-relaxed">
              {{ __('content.t_fed23edb29b8') }}
            </p>
</div>
<div class="pt-4 border-t border-outline-variant/40 flex items-center justify-between">
<div>
<span class="font-label-tag text-outline block">{{ __('ui.price') }}</span>
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 95</span>
</div>
<button class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-4 py-2 text-[11px] font-label-caps tracking-widest uppercase transition-colors">
              {{ __('content.t_d88e1af5d66c') }}
            </button>
</div>
</div>
</div>
<!-- Service 2: Full Glam Studio -->
<div class="border border-primary bg-surface-container-lowest flex flex-col group transition-all duration-200">
<div class="relative overflow-hidden aspect-[4/3] border-b border-primary">
<span class="absolute top-2 left-2 z-10 bg-secondary text-on-secondary text-[10px] font-label-caps px-2 py-0.5 tracking-widest uppercase">
            {{ __('content.t_e0fccb2d5c20') }}
          </span>
<img alt="{{ __('content.t_c17adf74564b') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_ce313ebf17007119.jpg') }}"/>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between text-outline text-[12px] font-label-caps mb-1">
<span>{{ __('content.t_a327947d5468') }}</span>
<span class="flex items-center gap-1 font-bold text-primary"><span class="material-symbols-outlined text-[14px]">schedule</span> {{ __('ui.minutes_count', ['count' => 45]) }}</span>
</div>
<h3 class="font-headline-sm text-[20px] font-bold text-primary mb-2">{{ __('content.t_f1e28d5b86e2') }}</h3>
<p class="font-body-sm text-on-surface-variant text-[13px] leading-relaxed">
              {{ __('content.t_e03e6ecd7565') }}
            </p>
</div>
<div class="pt-4 border-t border-outline-variant/40 flex items-center justify-between">
<div>
<span class="font-label-tag text-outline block">{{ __('content.t_7ea00423d194') }}</span>
<span class="font-title-md text-[13px] font-bold text-secondary">{{ __('content.t_c16b6fcc87b3') }}</span>
</div>
<button class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-4 py-2 text-[11px] font-label-caps tracking-widest uppercase transition-colors">
              {{ __('content.t_d88e1af5d66c') }}
            </button>
</div>
</div>
</div>
<!-- Service 3: Skin Diagnostics Bar -->
<div class="border border-primary bg-surface-container-lowest flex flex-col group transition-all duration-200">
<div class="relative overflow-hidden aspect-[4/3] border-b border-primary">
<span class="absolute top-2 left-2 z-10 bg-[#00732f] text-on-secondary text-[10px] font-label-caps px-2 py-0.5 tracking-widest uppercase">
            {{ __('content.t_2885ce3d39f1') }}
          </span>
<img alt="{{ __('content.t_b583a69efd32') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_d8e469b413ce20b3.jpg') }}"/>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between text-outline text-[12px] font-label-caps mb-1">
<span>{{ __('content.t_17d90fadc700') }}</span>
<span class="flex items-center gap-1 font-bold text-primary"><span class="material-symbols-outlined text-[14px]">schedule</span> {{ __('ui.minutes_count', ['count' => 15]) }}</span>
</div>
<h3 class="font-headline-sm text-[20px] font-bold text-primary mb-2">{{ __('content.t_f05e0a7da6d7') }}</h3>
<p class="font-body-sm text-on-surface-variant text-[13px] leading-relaxed">
              {{ __('content.t_91e407d8400d') }}
            </p>
</div>
<div class="pt-4 border-t border-outline-variant/40 flex items-center justify-between">
<div>
<span class="font-label-tag text-outline block">{{ __('ui.complimentary') }}</span>
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 0.00</span>
</div>
<button class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-4 py-2 text-[11px] font-label-caps tracking-widest uppercase transition-colors">
              {{ __('content.t_d88e1af5d66c') }}
            </button>
</div>
</div>
</div>
<!-- Service 4: Fragrance Engraving & Layering -->
<div class="border border-primary bg-surface-container-lowest flex flex-col group transition-all duration-200">
<div class="relative overflow-hidden aspect-[4/3] border-b border-primary bg-surface-container-low flex items-center justify-center">
<span class="absolute top-2 left-2 z-10 bg-tertiary-container text-[#e0c298] text-[10px] font-label-caps px-2 py-0.5 tracking-widest uppercase font-bold">
            {{ __('content.t_8f00d22d9906') }}
          </span>
<!-- Artistic Packshot Graphic container -->
<div class="w-full h-full bg-primary flex flex-col items-center justify-center p-6 text-center text-on-primary">
<span class="material-symbols-outlined text-[54px] text-tertiary-fixed mb-2">draw</span>
<span class="font-display-hero text-headline-sm">{{ __('content.t_f1e1618d5ec8') }}</span>
<span class="font-label-tag text-outline-variant mt-1 tracking-widest">{{ __('content.t_93cd16382a2c') }}</span>
</div>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between text-outline text-[12px] font-label-caps mb-1">
<span>{{ __('content.t_2c0bf277dc4d') }}</span>
<span class="flex items-center gap-1 font-bold text-primary"><span class="material-symbols-outlined text-[14px]">schedule</span> {{ __('ui.minutes_count', ['count' => 15]) }}</span>
</div>
<h3 class="font-headline-sm text-[20px] font-bold text-primary mb-2">{{ __('content.t_9dda60a48893') }}</h3>
<p class="font-body-sm text-on-surface-variant text-[13px] leading-relaxed">
              {{ __('content.t_be4a60473143') }}
            </p>
</div>
<div class="pt-4 border-t border-outline-variant/40 flex items-center justify-between">
<div>
<span class="font-label-tag text-outline block">{{ __('ui.complimentary') }}</span>
<span class="font-price-aed-lg text-price-aed-lg text-primary">{{ __('content.t_5409e1c99235') }}</span>
</div>
<button class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-4 py-2 text-[11px] font-label-caps tracking-widest uppercase transition-colors">
              {{ __('content.t_d88e1af5d66c') }}
            </button>
</div>
</div>
</div>
</div>
</section>
<!-- HOW TO BOOK A SERVICE (3 Steps) -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-10">
<div class="border border-outline-variant bg-surface-container-low p-8 md:p-12">
<h3 class="font-headline-sm text-center text-primary font-bold tracking-tight mb-8">
        {{ __('content.t_e3a52b381864') }}
      </h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
<div class="text-center space-y-3">
<div class="w-12 h-12 border-2 border-primary bg-surface-container-lowest mx-auto flex items-center justify-center font-bold text-primary text-lg font-headline-sm">
            1
          </div>
<h4 class="font-title-md font-bold text-primary uppercase text-sm tracking-wider">{{ __('content.t_36784672f72d') }}</h4>
<p class="font-body-sm text-on-surface-variant text-xs max-w-xs mx-auto">
            {{ __('content.t_a3bdee8fff6f') }}
          </p>
</div>
<div class="text-center space-y-3">
<div class="w-12 h-12 border-2 border-primary bg-surface-container-lowest mx-auto flex items-center justify-center font-bold text-primary text-lg font-headline-sm">
            2
          </div>
<h4 class="font-title-md font-bold text-primary uppercase text-sm tracking-wider">{{ __('content.t_aaeec72eefda') }}</h4>
<p class="font-body-sm text-on-surface-variant text-xs max-w-xs mx-auto">
            {{ __('content.t_d7f5e268465b') }}
          </p>
</div>
<div class="text-center space-y-3">
<div class="w-12 h-12 border-2 border-primary bg-surface-container-lowest mx-auto flex items-center justify-center font-bold text-primary text-lg font-headline-sm">
            3
          </div>
<h4 class="font-title-md font-bold text-primary uppercase text-sm tracking-wider">{{ __('content.t_3fac838e11bb') }}</h4>
<p class="font-body-sm text-on-surface-variant text-xs max-w-xs mx-auto">
            {{ __('content.t_cd63523c69b7') }}
          </p>
</div>
</div>
</div>
</section>
<!-- INTERACTIVE STORE LOCATOR & FINDER (2 COLUMNS) -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-12" id="locator">
<div class="mb-8">
<div class="flex items-center space-x-2 mb-2">
<span class="material-symbols-outlined text-secondary text-[20px]">location_on</span>
<span class="font-label-caps text-secondary font-bold text-[12px] tracking-widest uppercase">{{ __('content.t_8d432f9f450d') }}</span>
</div>
<h2 class="font-headline-md text-headline-md md:text-headline-lg font-bold text-primary tracking-tight">
        {{ __('content.t_6f6de155d51d') }}
      </h2>
<p class="font-body-md text-outline mt-1 max-w-2xl">
        {{ __('content.t_fbf0bf5adc47') }}
      </p>
</div>
<!-- Search & Filter Bar Controls -->
<div class="border border-primary bg-surface-container-lowest p-6 mb-6">
<div class="grid grid-cols-1 md:grid-cols-12 gap-4">
<!-- Search input -->
<div class="md:col-span-6 relative">
<label class="font-label-caps text-[10px] text-outline block mb-1 uppercase tracking-widest">{{ __('content.t_b4fdf3ba2386') }}</label>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3 text-outline text-[18px]">search</span>
<input class="w-full pl-9 pr-3 py-2 text-sm bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 rounded-none outline-none font-body-md" placeholder="{{ __('content.t_a70fd5945054') }}" type="text" value="Dubai Mall"/>
</div>
</div>
<!-- Emirate City Filter -->
<div class="md:col-span-3">
<label class="font-label-caps text-[10px] text-outline block mb-1 uppercase tracking-widest">{{ __('content.t_e9ddbf6255d6') }}</label>
<select class="w-full py-2 px-3 text-sm bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 rounded-none font-body-md">
<option selected="">{{ __('ui.all_emirates_uae') }}</option>
<option>{{ __('ui.dubai_stores') }}</option>
<option>{{ __('content.long_612e0da98f7e) }}</option>
<option>{{ __('ui.sharjah_stores') }}</option>
<option>{{ __('ui.al_ain_stores') }}</option>
<option>{{ __('content.long_c4839634defa) }}</option>
<option>{{ __('ui.ajman_stores') }}</option>
</select>
</div>
<!-- Service Filter -->
<div class="md:col-span-3">
<label class="font-label-caps text-[10px] text-outline block mb-1 uppercase tracking-widest">{{ __('content.t_7e280269101f') }}</label>
<select class="w-full py-2 px-3 text-sm bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 rounded-none font-body-md">
<option selected="">{{ __('content.t_bfd3d979c134') }}</option>
<option>{{ __('content.t_8504346a9755') }}</option>
<option>{{ __('content.t_78d387292f30') }}</option>
<option>{{ __('content.t_7a057bd539c9') }}</option>
<option>{{ __('content.t_05220ebab2da') }}</option>
<option>{{ __('content.long_ba9c6bde80ae) }}</option>
</select>
</div>
</div>
<!-- Quick Service Tag Chips -->
<div class="flex items-center flex-wrap gap-2 pt-4 mt-4 border-t border-outline-variant/50">
<span class="font-label-caps text-[10px] text-outline uppercase tracking-wider mr-2">{{ __('content.t_b458455db1bc') }}</span>
<button class="border border-primary bg-primary text-on-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">ALL</button>
<button class="border border-outline hover:border-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">{{ __('content.t_65d835d6dff7') }}</button>
<button class="border border-outline hover:border-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">{{ __('content.t_ace2ee138d26') }}</button>
<button class="border border-outline hover:border-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">{{ __('content.t_f762543da032') }}</button>
<button class="border border-outline hover:border-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">{{ __('content.t_593b2c0b5616') }}</button>
</div>
</div>
<!-- 2 COLUMN DIRECTORY & MAP PREVIEW -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">
<!-- LEFT COLUMN: Store Cards List (Scrollable Vitrine) -->
<div class="lg:col-span-5 space-y-4 max-h-[740px] overflow-y-auto pr-2 custom-scrollbar">
<!-- Store 1: The Dubai Mall (Active Highlight) -->
<div class="border-2 border-primary bg-surface-container-lowest p-6 relative">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-[#00732f] text-on-secondary text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                {{ __('content.t_cfa6d1b52579') }}
              </span>
<h3 class="font-headline-sm text-[20px] font-bold text-primary">{{ __('content.t_d41735eca54e') }}</h3>
</div>
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">stars</span>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            {{ __('content.t_0ba3770d4307') }}
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">{{ __('content.t_30d27794c963') }}</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97143399828">+971 4 339 9828</a>
</div>
</div>
<!-- Store feature tags -->
<div class="flex flex-wrap gap-1.5 mb-5">
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_185a464a03f4') }}</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_db54c9ac296f') }}</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_868a8e3be719') }}</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_05220ebab2da') }}</span>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant">
<a class="border border-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:bg-surface-container transition-colors flex items-center justify-center gap-1.5" href="https://maps.google.com" target="_blank">
<span class="material-symbols-outlined text-[15px]">directions</span>
<span>{{ __('content.t_e9bbdd149abb') }}</span>
</a>
<a class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors flex items-center justify-center gap-1.5" href="#booking-section">
<span class="material-symbols-outlined text-[15px]">calendar_today</span>
<span>{{ __('content.t_c2f685165f1f') }}</span>
</a>
</div>
</div>
<!-- Store 2: Mall of the Emirates -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                {{ __('content.t_c8cd05271cf0') }}
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">{{ __('content.t_121699b4f5bf') }}</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            {{ __('content.long_312cc83d62cc) }}
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">{{ __('content.t_0e94715bfae5') }}</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97143951860">+971 4 395 1860</a>
</div>
</div>
<div class="flex flex-wrap gap-1.5 mb-5">
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_185a464a03f4') }}</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_deeac6f5baa8') }}</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_fd3abddeac35') }}</span>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              {{ __('content.t_e9bbdd149abb') }}
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              {{ __('content.t_c2f685165f1f') }}
            </button>
</div>
</div>
<!-- Store 3: Yas Mall Abu Dhabi -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                {{ __('content.t_c8cd05271cf0') }}
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">{{ __('content.t_1045d1f4074d') }}</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            {{ __('content.t_c80d9d8694ea') }}
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">{{ __('content.t_0e94715bfae5') }}</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97125650680">+971 2 565 0680</a>
</div>
</div>
<div class="flex flex-wrap gap-1.5 mb-5">
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_185a464a03f4') }}</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_acb14070e7b1') }}</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">{{ __('content.t_16d3c3dadaac') }}</span>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              {{ __('content.t_e9bbdd149abb') }}
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              {{ __('content.t_c2f685165f1f') }}
            </button>
</div>
</div>
<!-- Store 4: Dubai Marina Mall -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                {{ __('content.t_93970fc02eaf') }}
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">{{ __('content.t_6a7e3b889afe') }}</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            {{ __('content.t_1afaa6b65045') }}
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">{{ __('content.t_ca96659569a2') }}</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97144361020">+971 4 436 1020</a>
</div>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              {{ __('content.t_e9bbdd149abb') }}
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              {{ __('content.t_c2f685165f1f') }}
            </button>
</div>
</div>
<!-- Store 5: Galleria Mall Al Maryah Island -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                {{ __('content.t_c8cd05271cf0') }}
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">{{ __('content.t_b28046419d45') }}</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            {{ __('content.t_ff466900f2d4') }}
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">{{ __('content.t_0e94715bfae5') }}</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97126760520">+971 2 676 0520</a>
</div>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              {{ __('content.t_e9bbdd149abb') }}
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              {{ __('content.t_c2f685165f1f') }}
            </button>
</div>
</div>
<!-- Store 6: City Centre Mirdif -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                {{ __('content.t_c8cd05271cf0') }}
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">{{ __('content.t_5eb7be01d07b') }}</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            {{ __('content.t_fd7a03acd66d') }}
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">{{ __('content.t_0e94715bfae5') }}</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97142843710">+971 4 284 3710</a>
</div>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              {{ __('content.t_e9bbdd149abb') }}
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              {{ __('content.t_c2f685165f1f') }}
            </button>
</div>
</div>
</div>
<!-- RIGHT COLUMN: INTERACTIVE MAP PREVIEW CARD -->
<div class="lg:col-span-7 sticky top-28 border border-primary bg-surface-container-low min-h-[580px] lg:min-h-[740px] flex flex-col justify-between overflow-hidden">
<!-- Map Canvas Visual with UAE Landmarks / Stylized Map -->
<div class="relative w-full h-[580px] bg-[#e5e3df] overflow-hidden flex items-center justify-center p-8">
<!-- Stylized UAE Grid/Cartography lines -->
<div class="absolute inset-0 opacity-20 bg-[linear-gradient(to_right,#000000_1px,transparent_1px),linear-gradient(to_bottom,#000000_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
<!-- Coastline Silhouette Accent -->
<div class="absolute inset-0 pointer-events-none opacity-10 flex items-center justify-center">
<span class="text-[240px] font-display-hero text-primary select-none">UAE</span>
</div>
<!-- Interactive Pins across Dubai & Abu Dhabi -->
<!-- Dubai Mall Pin (Active Callout) -->
<div class="absolute top-[38%] left-[54%] -translate-x-1/2 -translate-y-1/2 group cursor-pointer z-20">
<div class="relative flex flex-col items-center">
<!-- Info Pill tooltip -->
<div class="bg-primary text-on-primary px-3 py-1.5 shadow-lg whitespace-nowrap mb-2 border border-primary flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
<span class="font-label-caps text-[10px] tracking-wider uppercase font-bold">{{ __('content.t_9c6411c14f9b') }}</span>
<span class="material-symbols-outlined text-[13px]">arrow_forward</span>
</div>
<div class="w-9 h-9 bg-primary text-on-primary rounded-full flex items-center justify-center shadow-md border-2 border-on-primary">
<span class="material-symbols-outlined text-[18px]">shopping_bag</span>
</div>
<div class="w-1 h-3 bg-primary"></div>
</div>
</div>
<!-- Mall of Emirates Pin -->
<div class="absolute top-[48%] left-[46%] -translate-x-1/2 -translate-y-1/2 group cursor-pointer">
<div class="w-7 h-7 bg-primary text-on-primary rounded-full flex items-center justify-center shadow border-2 border-on-primary hover:scale-125 transition-transform">
<span class="material-symbols-outlined text-[14px]">storefront</span>
</div>
<div class="hidden group-hover:block absolute bottom-8 left-1/2 -translate-x-1/2 bg-primary text-on-primary text-[10px] px-2 py-1 font-label-caps whitespace-nowrap">
              {{ __('content.t_7c57cf4d6371') }}
            </div>
</div>
<!-- Dubai Marina Mall Pin -->
<div class="absolute top-[56%] left-[40%] -translate-x-1/2 -translate-y-1/2 group cursor-pointer">
<div class="w-7 h-7 bg-primary text-on-primary rounded-full flex items-center justify-center shadow border-2 border-on-primary hover:scale-125 transition-transform">
<span class="material-symbols-outlined text-[14px]">storefront</span>
</div>
<div class="hidden group-hover:block absolute bottom-8 left-1/2 -translate-x-1/2 bg-primary text-on-primary text-[10px] px-2 py-1 font-label-caps whitespace-nowrap">
              {{ __('content.t_524f47d76e2e') }}
            </div>
</div>
<!-- Abu Dhabi Yas Mall Pin -->
<div class="absolute top-[68%] left-[28%] -translate-x-1/2 -translate-y-1/2 group cursor-pointer">
<div class="w-7 h-7 bg-primary text-on-primary rounded-full flex items-center justify-center shadow border-2 border-on-primary hover:scale-125 transition-transform">
<span class="material-symbols-outlined text-[14px]">storefront</span>
</div>
<div class="hidden group-hover:block absolute bottom-8 left-1/2 -translate-x-1/2 bg-primary text-on-primary text-[10px] px-2 py-1 font-label-caps whitespace-nowrap">
              {{ __('content.t_f755a4b9c99f') }}
            </div>
</div>
<!-- City Centre Mirdif Pin -->
<div class="absolute top-[32%] left-[62%] -translate-x-1/2 -translate-y-1/2 group cursor-pointer">
<div class="w-7 h-7 bg-primary text-on-primary rounded-full flex items-center justify-center shadow border-2 border-on-primary hover:scale-125 transition-transform">
<span class="material-symbols-outlined text-[14px]">storefront</span>
</div>
<div class="hidden group-hover:block absolute bottom-8 left-1/2 -translate-x-1/2 bg-primary text-on-primary text-[10px] px-2 py-1 font-label-caps whitespace-nowrap">
              {{ __('content.t_a9d995e047a5') }}
            </div>
</div>
<!-- Map HUD / Controls -->
<div class="absolute top-4 right-4 bg-surface-container-lowest border border-primary flex flex-col p-1 space-y-1">
<button class="w-8 h-8 flex items-center justify-center text-primary hover:bg-surface-container">
<span class="material-symbols-outlined text-[18px]">add</span>
</button>
<button class="w-8 h-8 flex items-center justify-center text-primary hover:bg-surface-container border-t border-outline-variant">
<span class="material-symbols-outlined text-[18px]">remove</span>
</button>
</div>
<div class="absolute bottom-4 left-4 bg-surface-container-lowest/90 backdrop-blur-sm border border-primary px-3 py-1.5 text-[10px] font-label-caps text-primary tracking-widest">
            {{ __('content.long_e75d589b5d4a) }}
          </div>
</div>
<!-- Selected Location Summary Panel at base of Map -->
<div class="p-6 bg-surface-container-lowest border-t border-primary">
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
<div>
<p class="font-label-caps text-[10px] text-secondary font-bold tracking-widest uppercase">{{ __('content.t_6ec78a4725a4') }}</p>
<h4 class="font-headline-sm text-primary font-bold">{{ __('content.t_d45ee65b71cf') }}</h4>
<p class="font-body-sm text-outline text-xs mt-0.5">{{ __('content.t_f6210106fbe0') }}</p>
</div>
<div class="flex items-center gap-3">
<a class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-5 py-2.5 font-label-caps text-[11px] uppercase tracking-wider transition-colors inline-flex items-center gap-2" href="https://maps.google.com" target="_blank">
<span>{{ __('content.t_ea7e93f41335') }}</span>
<span class="material-symbols-outlined text-[14px]">open_in_new</span>
</a>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- VALUE PROPOSITION & TRUST BANNER -->
<section class="border-y border-outline-variant bg-surface-container-lowest py-10 mt-12">
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="grid grid-cols-2 md:grid-cols-4 gap-8">
<div class="flex items-center space-x-4">
<span class="material-symbols-outlined text-[36px] text-primary">local_shipping</span>
<div>
<h4 class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">{{ __('ui.free_delivery') }}</h4>
<p class="font-body-sm text-[12px] text-outline">{{ __('content.t_5ae4fa42fde1') }}</p>
</div>
</div>
<div class="flex items-center space-x-4">
<span class="material-symbols-outlined text-[36px] text-primary">verified</span>
<div>
<h4 class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">{{ __('ui.authentic') }}</h4>
<p class="font-body-sm text-[12px] text-outline">{{ __('content.t_e414293259ed') }}</p>
</div>
</div>
<div class="flex items-center space-x-4">
<span class="material-symbols-outlined text-[36px] text-primary">replay</span>
<div>
<h4 class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">{{ __('ui.easy_returns') }}</h4>
<p class="font-body-sm text-[12px] text-outline">{{ __('content.t_3bf5a2803a2f') }}</p>
</div>
</div>
<div class="flex items-center space-x-4">
<span class="material-symbols-outlined text-[36px] text-primary">loyalty</span>
<div>
<h4 class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">{{ __('ui.beauty_pass_points') }}</h4>
<p class="font-body-sm text-[12px] text-outline">{{ __('content.t_084556337981') }}</p>
</div>
</div>
</div>
</div>
</section>
<!-- NEWSLETTER SIGNUP -->
<section class="bg-surface-container-low border-b border-outline-variant py-14">
<div class="w-full max-w-[800px] mx-auto px-4 text-center space-y-4">
<span class="material-symbols-outlined text-[32px] text-primary">mail</span>
<h3 class="font-headline-md text-headline-md font-bold text-primary tracking-tight">{{ __('ui.stay_connected') }}</h3>
<p class="font-body-md text-outline text-[14px]">
        {{ __('content.t_c04393209ae5') }}
      </p>
<form class="flex flex-col sm:flex-row items-center justify-center gap-2 max-w-lg mx-auto pt-2" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="w-full sm:flex-1 py-3 px-4 text-xs font-body-md bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 rounded-none outline-none" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="w-full sm:w-auto bg-primary text-on-primary hover:bg-neutral-800 px-8 py-3 font-label-caps text-label-caps tracking-widest uppercase transition-colors whitespace-nowrap" type="submit">
          {{ __('ui.subscribe_caps') }}
        </button>
</form>
<p class="font-body-sm text-[11px] text-outline">
        {{ __('content.t_a9c69bad6863') }}
      </p>
</div>
</section>
<!-- OFFICIAL DESKTOP FOOTER (Shared Components JSON Anchor) -->
@endsection
