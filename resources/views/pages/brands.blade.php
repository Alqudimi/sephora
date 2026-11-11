@extends('layouts.app')

@section('title', __('meta.brands_directory'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased flex flex-col min-h-screen selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- 3. Breadcrumbs & Page Heading -->
<div class="mb-8">
<nav aria-label="{{ __('ui.breadcrumb') }}" class="flex items-center space-x-2 text-on-surface-variant font-label-caps text-label-caps tracking-widest uppercase mb-3">
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-bold">{{ __('content.t_e39d93f810f1') }}</span>
</nav>
<div class="border-b border-primary pb-4 flex items-end justify-between">
<h1 class="font-headline-lg text-headline-lg md:font-display-hero md:text-display-hero uppercase tracking-tight text-primary">
          {{ __('content.t_e39d93f810f1') }}
        </h1>
<span class="font-label-caps text-label-caps text-outline uppercase tracking-wider hidden sm:block">
          {{ __('content.t_466ecbe371ed') }}
        </span>
</div>
</div>
<!-- 4. Featured Brands Section -->
<section class="mb-14">
<div class="flex items-center justify-between mb-6">
<h2 class="font-headline-sm text-headline-sm uppercase tracking-wider text-primary font-semibold">
          {{ __('content.t_aa26bec8b1d3') }}
        </h2>
<span class="font-label-caps text-label-caps tracking-widest text-on-surface-variant uppercase">
          {{ __('content.t_10d19e684afd') }}
        </span>
</div>
<!-- Bento-style High-Contrast Grid -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
<!-- SEPHORA COLLECTION (Hero Brand Card) -->
<a class="group col-span-2 sm:col-span-3 lg:col-span-2 p-6 bg-surface-container-lowest border border-primary flex flex-col justify-between hover:bg-primary hover:text-on-primary transition-all duration-200 min-h-[140px] relative overflow-hidden" href="/brands/sephora-collection">
<div class="flex justify-between items-start">
<span class="font-label-tag text-label-tag tracking-widest bg-secondary-container text-on-secondary px-2 py-0.5 uppercase">
              {{ __('content.t_10f91fc5ce64') }}
            </span>
<span class="material-symbols-outlined text-lg opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" data-icon="arrow_forward">arrow_forward</span>
</div>
<div>
<h3 class="font-headline-md text-headline-md tracking-wider uppercase font-bold mt-4">
              {{ __('content.t_7e772d9d5bf0') }}
            </h3>
<p class="font-body-sm text-body-sm opacity-75 mt-1">{{ __('content.t_415e9f6fe465') }}</p>
</div>
</a>
<!-- HUDA BEAUTY -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/huda-beauty">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">{{ __('content.t_8ff2d80739af') }}</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            {{ __('content.t_d6675db98e96') }}
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">{{ __('ui.shop_all') }}</span>
</a>
<!-- KAYALI -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/kayali">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">{{ __('content.t_2ea63d2e1119') }}</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            KAYALI
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">{{ __('content.t_3ae897386333') }}</span>
</a>
<!-- PHLUR -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/phlur">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">{{ __('ui.trending') }}</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            PHLUR
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">{{ __('content.t_ed910b8d6d44') }}</span>
</a>
<!-- MOONGLAZE -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/moonglaze">
<span class="font-label-tag text-label-tag tracking-wider text-secondary uppercase font-bold">{{ __('ui.new_caps') }}</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            MOONGLAZE
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">{{ __('content.t_6d4f16e43693') }}</span>
</a>
<!-- FENTY BEAUTY -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/fenty-beauty">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">{{ __('content.t_2310599f4169') }}</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            {{ __('content.t_7e7bfae6c647') }}
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">{{ __('content.t_78affe1adeb7') }}</span>
</a>
<!-- NARS -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/nars">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">{{ __('ui.artistry') }}</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            NARS
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">{{ __('content.t_2fe921b646ec') }}</span>
</a>
<!-- TOO FACED -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/too-faced">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">{{ __('ui.icons') }}</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            {{ __('content.t_945462b49267') }}
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">{{ __('content.t_9fc43e119d7d') }}</span>
</a>
<!-- URBAN DECAY -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/urban-decay">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">{{ __('content.t_41825476eedb') }}</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            {{ __('content.t_6a8278fe00c8') }}
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">{{ __('content.t_88f2d35cd547') }}</span>
</a>
</div>
</section>
<!-- 5. A-Z Alphabetical Directory Sticky Jump Navigation Bar -->
<div class="sticky top-[105px] z-40 bg-surface-container-lowest/95 backdrop-blur-sm border-y border-primary py-3 mb-12">
<div class="flex items-center justify-between overflow-x-auto no-scrollbar gap-1 sm:gap-2 px-1">
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-A">A</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-B">B</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-C">C</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-D">D</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-E">E</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-F">F</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-G">G</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-H">H</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-I">I</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-J">J</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-K">K</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-L">L</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-M">M</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-N">N</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-O">O</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-P">P</a>
<span class="px-2 py-1 text-sm font-normal text-outline-variant cursor-not-allowed">Q</span>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-R">R</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-S">S</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-T">T</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-U">U</a>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-V">V</a>
<span class="px-2 py-1 text-sm font-normal text-outline-variant cursor-not-allowed">W</span>
<span class="px-2 py-1 text-sm font-normal text-outline-variant cursor-not-allowed">X</span>
<a class="px-2 py-1 text-sm font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors" href="#letter-Y">Y</a>
<span class="px-2 py-1 text-sm font-normal text-outline-variant cursor-not-allowed">Z</span>
<span class="px-2 py-1 text-sm font-normal text-outline-variant cursor-not-allowed">#</span>
</div>
</div>
<!-- 6. Alphabetical Brand Index Listing -->
<div class="space-y-12">
<!-- SECTION A -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-A">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">A</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 6]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/amika">AMIKA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/anastasia-beverly-hills">{{ __('content.t_0068ed4cdcf6') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/anua">ANUA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/armani">ARMANI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/augustinus-bader">{{ __('content.t_4cea8b505709') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/aveda">AVEDA</a>
</div>
</div>
</section>
<!-- SECTION B -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-B">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">B</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 14]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/bareminerals">BAREMINERALS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/bbb-london">{{ __('content.t_3a1b3fe573d7') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/beautyblender">BEAUTYBLENDER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/beautyworks">BEAUTYWORKS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/benefit-cosmetics">{{ __('content.t_00232ca2eb3a') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/biodance">BIODANCE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/biotherm">BIOTHERM</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/bobbi-brown">{{ __('content.t_c5361f9483f1') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/borntostandout">BORNTOSTANDOUT</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/briogeo">BRIOGEO</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/bubble">BUBBLE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/burberry">BURBERRY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/bvlgari">BVLGARI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/byoma">BYOMA</a>
</div>
</div>
</section>
<!-- SECTION C -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-C">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">C</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 11]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/carolina-herrera">{{ __('content.t_046c1d9503bb') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/cartier">CARTIER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/caudalie">CAUDALIE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/chanel">CHANEL</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/chloe">CHLOE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/clarins">CLARINS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/cle-de-peau-beaute">{{ __('content.t_da70c6c668e4') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/clear-start-by-dermalogica">{{ __('content.t_7c16cf2b7a36') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/clinique">CLINIQUE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/color-wow">{{ __('content.t_0b95d626b4f2') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/creed">CREED</a>
</div>
</div>
</section>
<!-- SECTION D -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-D">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">D</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 9]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dermalogica">DERMALOGICA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dior">DIOR</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dior-backstage">{{ __('content.t_fe2808b6c501') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dolce-gabbana">{{ __('content.t_e8b912d14180') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dr-dennis-gross">{{ __('content.t_e69375fa6df1') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dr-jart">{{ __('content.t_1eb19a58204f') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/drunk-elephant">{{ __('content.t_0a229218435f') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/drybar">DRYBAR</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dyson">DYSON</a>
</div>
</div>
</section>
<!-- SECTION E -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-E">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">E</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 6]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/e-l-f-cosmetics">E.L.F. COSMETICS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/elemis">ELEMIS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/elizabeth-arden">{{ __('content.t_f8b15907c6db') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/erborian">ERBORIAN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/estee-lauder">{{ __('content.t_2f86665094e7') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/estrid">ESTRID</a>
</div>
</div>
</section>
<!-- SECTION F -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-F">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">F</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 6]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fable-mane">{{ __('content.t_57bfa0ae947a') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fenty-beauty">{{ __('content.t_7e7bfae6c647') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fenty-hair">{{ __('content.t_0f9d052f3910') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fenty-skin">{{ __('content.t_a4ebb903d819') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/first-aid-beauty">{{ __('content.t_32d726e6e61c') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fugazzi-fragrances">{{ __('content.t_ce5c656c3a26') }}</a>
</div>
</div>
</section>
<!-- SECTION G -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-G">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">G</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 8]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/ghd">GHD</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/gisou">GISOU</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/givenchy">GIVENCHY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/glossier">GLOSSIER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/glow-recipe">{{ __('content.t_6b643b994b8b') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/grande-cosmetics">{{ __('content.t_5f0b3e8222c0') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/gucci">GUCCI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/guerlain">GUERLAIN</a>
</div>
</div>
</section>
<!-- SECTION H -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-H">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">H</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 6]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/haus-labs-by-lady-gaga">{{ __('content.t_0ea914d02ae8') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/hello-sunday">{{ __('content.t_02d5e941118d') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/hermes">HERMES</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/hourglass">HOURGLASS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/huda-beauty">{{ __('content.t_d6675db98e96') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/hugo-boss">{{ __('content.t_01e7e997165f') }}</a>
</div>
</div>
</section>
<!-- SECTION I & J -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-I">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">I &amp; J</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 6]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/ilia">ILIA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/invisibobble">INVISIBOBBLE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/it-cosmetics">{{ __('content.t_95bb580e5280') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/jean-paul-gaultier">{{ __('content.t_d353c1c0fc5b') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/jo-malone-london">{{ __('content.t_525b8089a6ce') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/juliette-has-a-gun">{{ __('content.t_993215eed4e9') }}</a>
</div>
</div>
</section>
<!-- SECTION K & L -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-K">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">K &amp; L</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 19]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/k18">K18</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kayali">KAYALI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kerastase">KÉRASTASE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kiehl-s-since-1851">{{ __('content.t_592a565cb50f') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kilian-paris">{{ __('content.t_0d9c74ce3071') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kitsch">KITSCH</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kosas">KOSAS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/l-occitane">L'OCCITANE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/l-oreal-professionnel">{{ __('content.t_1f67dd7ce2ae') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/la-mer">{{ __('content.t_c3cac019f5a3') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/la-prairie">{{ __('content.t_a81f9d42e5fc') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/lancaster">LANCASTER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/lancome">{{ __('content.t_070fb3f5c3c6') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/laneige">LANEIGE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/lanolips">LANOLIPS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/laura-mercier">{{ __('content.t_308d9eab4a44') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/le-mini-macaron">{{ __('content.t_51f1e910d7bd') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/loewe">LOEWE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/luna-daily">{{ __('content.t_4fff9e9ebaa0') }}</a>
</div>
</div>
</section>
<!-- SECTION M & N -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-M">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">M &amp; N</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 15]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/m-a-c">M.A.C</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/maison-francis-kurkdjian">{{ __('content.t_e4868601b50d') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/maison-margiela">{{ __('content.t_be31ba2c1ccd') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/make-up-for-ever">{{ __('content.t_4afc5243f952') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/makeup-by-mario">{{ __('content.t_435328c2e874') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/matiere-premiere">{{ __('content.t_45f9a5008d6e') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/mediheal">MEDIHEAL</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/memo-paris">{{ __('content.t_3f062f36a1fa') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/milk-makeup">{{ __('content.t_2dcd5b8905c1') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/miu-miu">{{ __('content.t_9cf941e54455') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/moonglaze">MOONGLAZE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/narciso-rodriguez">{{ __('content.t_3f10fb00303d') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/nars">NARS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/nudestix">NUDESTIX</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/nuxe">NUXE</a>
</div>
</div>
</section>
<!-- SECTION O & P -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-O">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">O &amp; P</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 14]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/olaplex">OLAPLEX</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/olehenriksen">OLEHENRIKSEN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/onesize">ONESIZE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/oribe">ORIBE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/ouai">OUAI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/parfum-bdk">{{ __('content.t_7c019e522f6c') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/parfums-de-marly">{{ __('content.t_acbcf9925705') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/patrick-ta">{{ __('content.t_5ab61473e0dd') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/paula-s-choice">{{ __('content.t_f1bb5f3cd5c0') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/peace-out-skincare">{{ __('content.t_24d4f62ee956') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/penhaligon-s">PENHALIGON'S</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/phlur">PHLUR</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/pixi">PIXI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/prada">PRADA</a>
</div>
</div>
</section>
<!-- SECTION R & S -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-R">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">R &amp; S</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 24]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/rabanne-fragrances">{{ __('content.t_a74eea4b87da') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/rare-beauty">{{ __('content.t_bd5f1e1ea5d0') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/redken">REDKEN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/refy">REFY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/roberto-cavalli">{{ __('content.t_41567536e685') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/saie">SAIE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/salt-and-stone">{{ __('content.t_e51164a7ceac') }}</a>
<a class="text-body-md font-bold underline transition-all" href="/brands/sephora-collection">{{ __('content.t_7e772d9d5bf0') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/sephora-favorites">{{ __('content.t_553a77ded276') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/shark">SHARK</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/shiseido">SHISEIDO</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/simihaze-beauty">{{ __('content.t_a6bfa9628fd3') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/slickhair">SLICKHAIR</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/slip">SLIP</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/sol-de-janeiro">{{ __('content.t_eeafde1dc3b0') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/starface">STARFACE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/steampod">STEAMPOD</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/summer-fridays">{{ __('content.t_a349e4c45ae2') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/sunday-riley">{{ __('content.t_1facc872b7f5') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/supergoop">SUPERGOOP!</a>
</div>
</div>
</section>
<!-- SECTION T, U, V, Y -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-T">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">T – Y</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">{{ __('ui.brands_count', ['count' => 17]) }}</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tarte">TARTE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tatcha">TATCHA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/the-inkey-list">{{ __('content.t_84955104e42d') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/the-ordinary">{{ __('content.t_1fd4e851e251') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/thomas-kosmala">{{ __('content.t_60792e7b92dd') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tom-ford">{{ __('content.t_65f12af36527') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/too-faced">{{ __('content.t_945462b49267') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/touchland">TOUCHLAND</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tower-28">TOWER 28</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tweezerman">TWEEZERMAN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/urban-decay">{{ __('content.t_6a8278fe00c8') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/valentino">VALENTINO</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/vegamour">VEGAMOUR</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/versace">VERSACE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/virtue">VIRTUE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/youth-to-the-people">{{ __('content.t_0cbcb5221857') }}</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/yves-saint-laurent">{{ __('content.t_f7ad8be4a251') }}</a>
</div>
</div>
</section>
</div>
<!-- 7. Sephora Trust & Value Pillars (4-column) -->
<section class="mt-20 pt-10 border-t border-primary">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
<div class="flex items-start space-x-3.5">
<span class="material-symbols-outlined text-3xl text-primary flex-shrink-0" data-icon="local_shipping">local_shipping</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">{{ __('content.t_fc2bdabb8563') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">{{ __('content.t_1262f62b5ef5') }}</p>
</div>
</div>
<div class="flex items-start space-x-3.5">
<span class="material-symbols-outlined text-3xl text-primary flex-shrink-0" data-icon="verified">verified</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">{{ __('ui.authentic_100') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">{{ __('content.t_f5f63432e5e8') }}</p>
</div>
</div>
<div class="flex items-start space-x-3.5">
<span class="material-symbols-outlined text-3xl text-primary flex-shrink-0" data-icon="sync_alt">sync_alt</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">{{ __('content.t_a067e40f0b80') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">{{ __('content.t_6bd2586a8391') }}</p>
</div>
</div>
<div class="flex items-start space-x-3.5">
<span class="material-symbols-outlined text-3xl text-primary flex-shrink-0" data-icon="card_membership">card_membership</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">{{ __('content.t_6bd8f9001b02') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">{{ __('content.t_c5bdd6223bae') }}</p>
</div>
</div>
</div>
</section>
<!-- 8. Newsletter Subscription Strip -->
<section class="mt-16 bg-surface-container-low border border-outline-variant p-8 md:p-12 text-center max-w-4xl mx-auto">
<span class="font-label-caps text-label-caps tracking-widest text-outline uppercase block mb-1">{{ __('content.t_49326ffd6778') }}</span>
<h3 class="font-headline-sm text-headline-sm uppercase font-bold tracking-tight text-primary">{{ __('ui.stay_connected') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto mt-2 mb-6">
        {{ __('content.t_cde29f80e378') }}
      </p>
<form class="flex flex-col sm:flex-row items-center justify-center max-w-md mx-auto gap-2" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="w-full px-4 py-3 bg-surface-container-lowest text-on-surface border border-outline focus:border-primary font-body-sm text-body-sm outline-none rounded-none" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="w-full sm:w-auto px-8 py-3 bg-primary text-on-primary font-label-caps text-label-caps tracking-widest uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all duration-200 min-h-[48px] whitespace-nowrap" type="submit">
          {{ __('content.t_1e0c8c669c5f') }}
        </button>
</form>
</section>
</main>
<!-- 9. Full Footer & Legal (Shared Component Execution) -->
@endsection
