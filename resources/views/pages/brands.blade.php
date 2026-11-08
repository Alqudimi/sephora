@extends('layouts.app')

@section('title', 'All Brands Directory | SEPHORA UAE Official')
@section('body_class', 'bg-background text-on-surface antialiased font-body-md text-body-md flex flex-col min-h-screen selection:bg-primary selection:text-on-primary')

@section('head')
@endsection

@section('content')
<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- 3. Breadcrumbs & Page Heading -->
<div class="mb-8">
<nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-on-surface-variant font-label-caps text-label-caps tracking-widest uppercase mb-3">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-bold">All brands</span>
</nav>
<div class="border-b border-primary pb-4 flex items-end justify-between">
<h1 class="font-headline-lg text-headline-lg md:font-display-hero md:text-display-hero uppercase tracking-tight text-primary">
          All brands
        </h1>
<span class="font-label-caps text-label-caps text-outline uppercase tracking-wider hidden sm:block">
          Official Luxury Directory
        </span>
</div>
</div>
<!-- 4. Featured Brands Section -->
<section class="mb-14">
<div class="flex items-center justify-between mb-6">
<h2 class="font-headline-sm text-headline-sm uppercase tracking-wider text-primary font-semibold">
          Featured Brands
        </h2>
<span class="font-label-caps text-label-caps tracking-widest text-on-surface-variant uppercase">
          Curated Exclusives
        </span>
</div>
<!-- Bento-style High-Contrast Grid -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
<!-- SEPHORA COLLECTION (Hero Brand Card) -->
<a class="group col-span-2 sm:col-span-3 lg:col-span-2 p-6 bg-surface-container-lowest border border-primary flex flex-col justify-between hover:bg-primary hover:text-on-primary transition-all duration-200 min-h-[140px] relative overflow-hidden" href="/brands/sephora-collection">
<div class="flex justify-between items-start">
<span class="font-label-tag text-label-tag tracking-widest bg-secondary-container text-on-secondary px-2 py-0.5 uppercase">
              Sephora Icon
            </span>
<span class="material-symbols-outlined text-lg opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" data-icon="arrow_forward">arrow_forward</span>
</div>
<div>
<h3 class="font-headline-md text-headline-md tracking-wider uppercase font-bold mt-4">
              SEPHORA COLLECTION
            </h3>
<p class="font-body-sm text-body-sm opacity-75 mt-1">High quality beauty essentials &amp; innovative daily formulas.</p>
</div>
</a>
<!-- HUDA BEAUTY -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/huda-beauty">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">Dubai Founded</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            HUDA BEAUTY
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">Shop All</span>
</a>
<!-- KAYALI -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/kayali">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">Niche Perfume</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            KAYALI
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">Layered Scents</span>
</a>
<!-- PHLUR -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/phlur">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">Trending</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            PHLUR
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">Fine Fragrance</span>
</a>
<!-- MOONGLAZE -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/moonglaze">
<span class="font-label-tag text-label-tag tracking-wider text-secondary uppercase font-bold">NEW</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            MOONGLAZE
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">Gloss &amp; Dew</span>
</a>
<!-- FENTY BEAUTY -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/fenty-beauty">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">Complexion Lead</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            FENTY BEAUTY
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">By Rihanna</span>
</a>
<!-- NARS -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/nars">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">Artistry</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            NARS
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">Cult Pigments</span>
</a>
<!-- TOO FACED -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/too-faced">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">Icons</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            TOO FACED
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">Better Than Sex</span>
</a>
<!-- URBAN DECAY -->
<a class="group p-5 bg-surface-container-lowest border border-outline-variant hover:border-primary flex flex-col justify-between hover:bg-surface-container-low transition-all duration-200 min-h-[140px]" href="/brands/urban-decay">
<span class="font-label-tag text-label-tag tracking-wider text-outline uppercase">High Performance</span>
<h3 class="font-title-lg text-title-lg uppercase tracking-widest font-bold my-auto text-center group-hover:scale-105 transition-transform duration-200">
            URBAN DECAY
          </h3>
<span class="font-label-caps text-label-caps text-center text-outline group-hover:text-primary transition-colors">All Nighter</span>
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
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">6 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/amika">AMIKA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/anastasia-beverly-hills">ANASTASIA BEVERLY HILLS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/anua">ANUA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/armani">ARMANI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/augustinus-bader">AUGUSTINUS BADER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/aveda">AVEDA</a>
</div>
</div>
</section>
<!-- SECTION B -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-B">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">B</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">14 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/bareminerals">BAREMINERALS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/bbb-london">BBB LONDON</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/beautyblender">BEAUTYBLENDER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/beautyworks">BEAUTYWORKS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/benefit-cosmetics">BENEFIT COSMETICS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/biodance">BIODANCE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/biotherm">BIOTHERM</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/bobbi-brown">BOBBI BROWN</a>
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
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">11 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/carolina-herrera">CAROLINA HERRERA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/cartier">CARTIER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/caudalie">CAUDALIE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/chanel">CHANEL</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/chloe">CHLOE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/clarins">CLARINS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/cle-de-peau-beaute">CLE DE PEAU BEAUTE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/clear-start-by-dermalogica">CLEAR START BY DERMALOGICA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/clinique">CLINIQUE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/color-wow">COLOR WOW</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/creed">CREED</a>
</div>
</div>
</section>
<!-- SECTION D -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-D">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">D</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">9 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dermalogica">DERMALOGICA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dior">DIOR</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dior-backstage">DIOR BACKSTAGE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dolce-gabbana">DOLCE &amp; GABBANA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dr-dennis-gross">DR DENNIS GROSS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/dr-jart">DR. JART+</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/drunk-elephant">DRUNK ELEPHANT</a>
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
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">6 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/e-l-f-cosmetics">E.L.F. COSMETICS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/elemis">ELEMIS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/elizabeth-arden">ELIZABETH ARDEN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/erborian">ERBORIAN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/estee-lauder">ESTÉE LAUDER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/estrid">ESTRID</a>
</div>
</div>
</section>
<!-- SECTION F -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-F">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">F</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">6 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fable-mane">FABLE &amp; MANE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fenty-beauty">FENTY BEAUTY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fenty-hair">FENTY HAIR</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fenty-skin">FENTY SKIN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/first-aid-beauty">FIRST AID BEAUTY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/fugazzi-fragrances">FUGAZZI FRAGRANCES</a>
</div>
</div>
</section>
<!-- SECTION G -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-G">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">G</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">8 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/ghd">GHD</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/gisou">GISOU</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/givenchy">GIVENCHY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/glossier">GLOSSIER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/glow-recipe">GLOW RECIPE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/grande-cosmetics">GRANDE COSMETICS</a>
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
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">6 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/haus-labs-by-lady-gaga">HAUS LABS BY LADY GAGA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/hello-sunday">HELLO SUNDAY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/hermes">HERMES</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/hourglass">HOURGLASS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/huda-beauty">HUDA BEAUTY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/hugo-boss">HUGO BOSS</a>
</div>
</div>
</section>
<!-- SECTION I & J -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-I">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">I &amp; J</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">6 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/ilia">ILIA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/invisibobble">INVISIBOBBLE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/it-cosmetics">IT COSMETICS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/jean-paul-gaultier">JEAN PAUL GAULTIER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/jo-malone-london">JO MALONE LONDON</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/juliette-has-a-gun">JULIETTE HAS A GUN</a>
</div>
</div>
</section>
<!-- SECTION K & L -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-K">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">K &amp; L</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">19 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/k18">K18</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kayali">KAYALI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kerastase">KÉRASTASE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kiehl-s-since-1851">KIEHL'S SINCE 1851</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kilian-paris">KILIAN PARIS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kitsch">KITSCH</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/kosas">KOSAS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/l-occitane">L'OCCITANE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/l-oreal-professionnel">L'ORÉAL PROFESSIONNEL</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/la-mer">LA MER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/la-prairie">LA PRAIRIE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/lancaster">LANCASTER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/lancome">LANCÔME</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/laneige">LANEIGE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/lanolips">LANOLIPS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/laura-mercier">LAURA MERCIER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/le-mini-macaron">LE MINI MACARON</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/loewe">LOEWE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/luna-daily">LUNA DAILY</a>
</div>
</div>
</section>
<!-- SECTION M & N -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-M">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">M &amp; N</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">15 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/m-a-c">M.A.C</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/maison-francis-kurkdjian">MAISON FRANCIS KURKDJIAN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/maison-margiela">MAISON MARGIELA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/make-up-for-ever">MAKE UP FOR EVER</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/makeup-by-mario">MAKEUP BY MARIO</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/matiere-premiere">MATIERE PREMIERE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/mediheal">MEDIHEAL</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/memo-paris">MEMO PARIS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/milk-makeup">MILK MAKEUP</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/miu-miu">MIU MIU</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/moonglaze">MOONGLAZE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/narciso-rodriguez">NARCISO RODRIGUEZ</a>
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
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">14 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/olaplex">OLAPLEX</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/olehenriksen">OLEHENRIKSEN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/onesize">ONESIZE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/oribe">ORIBE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/ouai">OUAI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/parfum-bdk">PARFUM BDK</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/parfums-de-marly">PARFUMS DE MARLY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/patrick-ta">PATRICK TA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/paula-s-choice">PAULA'S CHOICE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/peace-out-skincare">PEACE OUT SKINCARE</a>
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
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">24 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/rabanne-fragrances">RABANNE FRAGRANCES</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/rare-beauty">RARE BEAUTY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/redken">REDKEN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/refy">REFY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/roberto-cavalli">ROBERTO CAVALLI</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/saie">SAIE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/salt-and-stone">SALT AND STONE</a>
<a class="text-body-md font-bold underline transition-all" href="/brands/sephora-collection">SEPHORA COLLECTION</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/sephora-favorites">SEPHORA FAVORITES</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/shark">SHARK</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/shiseido">SHISEIDO</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/simihaze-beauty">SIMIHAZE BEAUTY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/slickhair">SLICKHAIR</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/slip">SLIP</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/sol-de-janeiro">SOL DE JANEIRO</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/starface">STARFACE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/steampod">STEAMPOD</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/summer-fridays">SUMMER FRIDAYS</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/sunday-riley">SUNDAY RILEY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/supergoop">SUPERGOOP!</a>
</div>
</div>
</section>
<!-- SECTION T, U, V, Y -->
<section class="scroll-mt-36 border-t border-outline-variant/60 pt-6" id="letter-T">
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<div class="md:col-span-2">
<span class="font-headline-lg text-headline-lg font-bold text-primary block leading-none">T – Y</span>
<span class="font-label-caps text-label-caps text-outline tracking-widest uppercase mt-1 block">17 Brands</span>
</div>
<div class="md:col-span-10 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-y-3.5 gap-x-6">
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tarte">TARTE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tatcha">TATCHA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/the-inkey-list">THE INKEY LIST</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/the-ordinary">THE ORDINARY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/thomas-kosmala">THOMAS KOSMALA</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tom-ford">TOM FORD</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/too-faced">TOO FACED</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/touchland">TOUCHLAND</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tower-28">TOWER 28</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/tweezerman">TWEEZERMAN</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/urban-decay">URBAN DECAY</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/valentino">VALENTINO</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/vegamour">VEGAMOUR</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/versace">VERSACE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/virtue">VIRTUE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/youth-to-the-people">YOUTH TO THE PEOPLE</a>
<a class="text-body-md hover:font-bold hover:underline transition-all" href="/brands/yves-saint-laurent">YVES SAINT LAURENT</a>
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
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">FREE DELIVERY</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">On orders above 250 AED</p>
</div>
</div>
<div class="flex items-start space-x-3.5">
<span class="material-symbols-outlined text-3xl text-primary flex-shrink-0" data-icon="verified">verified</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">100% AUTHENTIC</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Direct from authorized brands</p>
</div>
</div>
<div class="flex items-start space-x-3.5">
<span class="material-symbols-outlined text-3xl text-primary flex-shrink-0" data-icon="sync_alt">sync_alt</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">EASY IN-STORE RETURNS</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">At any Sephora store across UAE</p>
</div>
</div>
<div class="flex items-start space-x-3.5">
<span class="material-symbols-outlined text-3xl text-primary flex-shrink-0" data-icon="card_membership">card_membership</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">BEAUTY PASS POINTS</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Earn points on every dirham spent</p>
</div>
</div>
</div>
</section>
<!-- 8. Newsletter Subscription Strip -->
<section class="mt-16 bg-surface-container-low border border-outline-variant p-8 md:p-12 text-center max-w-4xl mx-auto">
<span class="font-label-caps text-label-caps tracking-widest text-outline uppercase block mb-1">VIP Exclusives</span>
<h3 class="font-headline-sm text-headline-sm uppercase font-bold tracking-tight text-primary">
        STAY CONNECTED WITH SEPHORA
      </h3>
<p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto mt-2 mb-6">
        Subscribe for exclusive product previews, beauty news, and VIP member offers.
      </p>
<form class="flex flex-col sm:flex-row items-center justify-center max-w-md mx-auto gap-2" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="w-full px-4 py-3 bg-surface-container-lowest text-on-surface border border-outline focus:border-primary font-body-sm text-body-sm outline-none rounded-none" placeholder="Enter your email address" required="" type="email"/>
<button class="w-full sm:w-auto px-8 py-3 bg-primary text-on-primary font-label-caps text-label-caps tracking-widest uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all duration-200 min-h-[48px] whitespace-nowrap" type="submit">
          SIGN UP
        </button>
</form>
</section>
</main>
<!-- 9. Full Footer & Legal (Shared Component Execution) -->
@endsection
