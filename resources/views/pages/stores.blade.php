@extends('layouts.app')

@section('title', 'Stores & Services | SEPHORA Middle East')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- BREADCRUMBS -->
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-4">
<nav class="flex items-center space-x-2 text-[12px] font-body-sm text-outline">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<span class="text-primary font-bold">Stores &amp; Services</span>
</nav>
</div>
<!-- HERO SECTION -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pb-12">
<div class="relative bg-surface-container-lowest border border-primary overflow-hidden grid grid-cols-1 lg:grid-cols-12 items-stretch">
<!-- Content Column -->
<div class="lg:col-span-6 p-5 sm:p-8 md:p-14 lg:p-16 flex flex-col justify-center space-y-6 z-10 bg-surface-container-lowest">
<div class="inline-flex items-center space-x-2">
<span class="bg-primary text-on-primary text-[10px] font-label-caps uppercase px-2.5 py-1 tracking-widest">FLAGSHIP EXPERIENCE</span>
<span class="text-[12px] font-label-caps uppercase text-secondary font-bold tracking-wider">UNITED ARAB EMIRATES</span>
</div>
<h1 class="font-display-hero text-2xl sm:text-[34px] md:text-headline-lg lg:text-display-hero leading-tight text-primary font-bold">
          DISCOVER OUR SEPHORA STORES &amp; SERVICES
        </h1>
<p class="font-body-md text-on-surface-variant leading-relaxed text-[15px] max-w-xl">
          At Sephora stores, we offer you a unique beauty experience that combines expert beauty services and unparalleled choice among premium brands to help you discover your perfect look and express your beauty your way.
        </p>
<!-- CTA Buttons -->
<div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 pt-4">
<a class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:outline hover:outline-1 hover:outline-primary px-6 sm:px-8 py-3.5 font-label-caps text-label-caps tracking-widest transition-all duration-200 uppercase inline-flex items-center justify-center gap-3 text-center" href="#booking-section">
<span>BOOK A SERVICE NOW</span>
<span class="material-symbols-outlined text-[16px]">calendar_today</span>
</a>
<a class="bg-transparent border border-primary text-primary hover:bg-primary hover:text-on-primary px-6 sm:px-8 py-3.5 font-label-caps text-label-caps tracking-widest transition-all duration-200 uppercase inline-flex items-center justify-center gap-3 text-center" href="#locator">
<span>FIND A STORE NEAR YOU</span>
<span class="material-symbols-outlined text-[16px]">near_me</span>
</a>
</div>
<!-- Trust Mini Badges -->
<div class="pt-6 border-t border-outline-variant/60 grid grid-cols-3 gap-4 text-center md:text-left">
<div>
<p class="font-title-md text-[14px] font-bold text-primary">30+ Salons</p>
<p class="font-body-sm text-[11px] text-outline">Across all Emirates</p>
</div>
<div>
<p class="font-title-md text-[14px] font-bold text-primary">100+ Pro Artists</p>
<p class="font-body-sm text-[11px] text-outline">Certified &amp; Licensed</p>
</div>
<div>
<p class="font-title-md text-[14px] font-bold text-primary">Instant Booking</p>
<p class="font-body-sm text-[11px] text-outline">Via Beauty Pass</p>
</div>
</div>
</div>
<!-- Image Column (Hero Packshot/Store Visual) -->
<div class="lg:col-span-6 relative min-h-[380px] lg:min-h-[560px] border-t lg:border-t-0 lg:border-l border-primary">
<img alt="Luxury Sephora UAE Flagship store interior" class="w-full h-full object-cover grayscale contrast-125 hover:grayscale-0 transition-all duration-700" src="{{ asset('images/content/img_90fc51af9f1a91cf.jpg') }}"/>
<div class="absolute bottom-4 right-4 bg-primary text-on-primary px-3 py-1.5 font-label-caps text-[10px] tracking-widest">
          DUBAI MALL FLAGSHIP BEAUTY HUB
        </div>
</div>
</div>
</section>
<!-- SERVICES MENU & BOOKING CARDS -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-12" id="booking-section">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-4 border-b border-primary">
<div>
<p class="font-label-caps text-secondary font-bold text-[12px] tracking-widest uppercase mb-1">SIGNATURE BEAUTY BARS</p>
<h2 class="font-headline-md text-headline-md md:text-headline-lg font-bold text-primary tracking-tight">
          IN-STORE BEAUTY SERVICES
        </h2>
</div>
<p class="font-body-sm text-outline-variant text-[13px] mt-2 md:mt-0 max-w-md">
        Experience tailored beauty expertise with one-on-one appointments conducted by accredited global specialists.
      </p>
</div>
<!-- 4 Services Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Service 1: BrowBar -->
<div class="border border-primary bg-surface-container-lowest flex flex-col group transition-all duration-200">
<div class="relative overflow-hidden aspect-[4/3] border-b border-primary">
<span class="absolute top-2 left-2 z-10 bg-primary text-on-primary text-[10px] font-label-caps px-2 py-0.5 tracking-widest uppercase">
            MOST POPULAR
          </span>
<img alt="Benefit BrowBar Expert brow styling and waxing" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_8e182dd2a6fc44aa.jpg') }}"/>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between text-outline text-[12px] font-label-caps mb-1">
<span>BENEFIT COSMETICS</span>
<span class="flex items-center gap-1 font-bold text-primary"><span class="material-symbols-outlined text-[14px]">schedule</span> 20 MINS</span>
</div>
<h3 class="font-headline-sm text-[20px] font-bold text-primary mb-2">Benefit BrowBar</h3>
<p class="font-body-sm text-on-surface-variant text-[13px] leading-relaxed">
              Expert brow shaping, signature waxing, precision tinting, and arch architecture styling by certified Benefit artists.
            </p>
</div>
<div class="pt-4 border-t border-outline-variant/40 flex items-center justify-between">
<div>
<span class="font-label-tag text-outline block">PRICE</span>
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 95</span>
</div>
<button class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-4 py-2 text-[11px] font-label-caps tracking-widest uppercase transition-colors">
              BOOK NOW
            </button>
</div>
</div>
</div>
<!-- Service 2: Full Glam Studio -->
<div class="border border-primary bg-surface-container-lowest flex flex-col group transition-all duration-200">
<div class="relative overflow-hidden aspect-[4/3] border-b border-primary">
<span class="absolute top-2 left-2 z-10 bg-secondary text-on-secondary text-[10px] font-label-caps px-2 py-0.5 tracking-widest uppercase">
            COMPLIMENTARY OFFER
          </span>
<img alt="Full Face Glam &amp; Makeup Studio at Sephora UAE" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_ce313ebf17007119.jpg') }}"/>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between text-outline text-[12px] font-label-caps mb-1">
<span>SEPHORA PRO ARTISTRY</span>
<span class="flex items-center gap-1 font-bold text-primary"><span class="material-symbols-outlined text-[14px]">schedule</span> 45 MINS</span>
</div>
<h3 class="font-headline-sm text-[20px] font-bold text-primary mb-2">Full Face Glam &amp; Makeup</h3>
<p class="font-body-sm text-on-surface-variant text-[13px] leading-relaxed">
              Personalized bespoke makeover, red-carpet glam, or everyday luminous finish crafted by high-couture Sephora Pro Artists.
            </p>
</div>
<div class="pt-4 border-t border-outline-variant/40 flex items-center justify-between">
<div>
<span class="font-label-tag text-outline block">AED 250 OR</span>
<span class="font-title-md text-[13px] font-bold text-secondary">FREE W/ 350 AED SPEND</span>
</div>
<button class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-4 py-2 text-[11px] font-label-caps tracking-widest uppercase transition-colors">
              BOOK NOW
            </button>
</div>
</div>
</div>
<!-- Service 3: Skin Diagnostics Bar -->
<div class="border border-primary bg-surface-container-lowest flex flex-col group transition-all duration-200">
<div class="relative overflow-hidden aspect-[4/3] border-b border-primary">
<span class="absolute top-2 left-2 z-10 bg-[#00732f] text-on-secondary text-[10px] font-label-caps px-2 py-0.5 tracking-widest uppercase">
            FREE CONSULTATION
          </span>
<img alt="Advanced Skin Diagnostics and custom beauty consultation at Sephora UAE" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_d8e469b413ce20b3.jpg') }}"/>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between text-outline text-[12px] font-label-caps mb-1">
<span>SKINCARE LAB</span>
<span class="flex items-center gap-1 font-bold text-primary"><span class="material-symbols-outlined text-[14px]">schedule</span> 15 MINS</span>
</div>
<h3 class="font-headline-sm text-[20px] font-bold text-primary mb-2">Skin Diagnostics &amp; Beauty Bar</h3>
<p class="font-body-sm text-on-surface-variant text-[13px] leading-relaxed">
              Advanced device facial scan, deep moisture &amp; barrier diagnostic, plus an individualized clean formula routine regimen.
            </p>
</div>
<div class="pt-4 border-t border-outline-variant/40 flex items-center justify-between">
<div>
<span class="font-label-tag text-outline block">COMPLIMENTARY</span>
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 0.00</span>
</div>
<button class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-4 py-2 text-[11px] font-label-caps tracking-widest uppercase transition-colors">
              BOOK NOW
            </button>
</div>
</div>
</div>
<!-- Service 4: Fragrance Engraving & Layering -->
<div class="border border-primary bg-surface-container-lowest flex flex-col group transition-all duration-200">
<div class="relative overflow-hidden aspect-[4/3] border-b border-primary bg-surface-container-low flex items-center justify-center">
<span class="absolute top-2 left-2 z-10 bg-tertiary-container text-[#e0c298] text-[10px] font-label-caps px-2 py-0.5 tracking-widest uppercase font-bold">
            BESPOKE LUXURY
          </span>
<!-- Artistic Packshot Graphic container -->
<div class="w-full h-full bg-primary flex flex-col items-center justify-center p-6 text-center text-on-primary">
<span class="material-symbols-outlined text-[54px] text-tertiary-fixed mb-2">draw</span>
<span class="font-display-hero text-headline-sm">Atelier Haute Parfumerie</span>
<span class="font-label-tag text-outline-variant mt-1 tracking-widest">CUSTOM MONOGRAMMING</span>
</div>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between text-outline text-[12px] font-label-caps mb-1">
<span>HAUTE PARFUM</span>
<span class="flex items-center gap-1 font-bold text-primary"><span class="material-symbols-outlined text-[14px]">schedule</span> 15 MINS</span>
</div>
<h3 class="font-headline-sm text-[20px] font-bold text-primary mb-2">Fragrance Engraving &amp; Layering</h3>
<p class="font-body-sm text-on-surface-variant text-[13px] leading-relaxed">
              Custom laser bottle calligraphy engraving paired with a personalized Middle Eastern niche layering masterclass.
            </p>
</div>
<div class="pt-4 border-t border-outline-variant/40 flex items-center justify-between">
<div>
<span class="font-label-tag text-outline block">COMPLIMENTARY</span>
<span class="font-price-aed-lg text-price-aed-lg text-primary">WITH BOTTLE</span>
</div>
<button class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-4 py-2 text-[11px] font-label-caps tracking-widest uppercase transition-colors">
              BOOK NOW
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
        HOW TO BOOK YOUR BEAUTY SERVICE IN 3 SIMPLE STEPS
      </h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
<div class="text-center space-y-3">
<div class="w-12 h-12 border-2 border-primary bg-surface-container-lowest mx-auto flex items-center justify-center font-bold text-primary text-lg font-headline-sm">
            1
          </div>
<h4 class="font-title-md font-bold text-primary uppercase text-sm tracking-wider">CHOOSE YOUR SERVICE</h4>
<p class="font-body-sm text-on-surface-variant text-xs max-w-xs mx-auto">
            Select your preferred consultation, makeover, or brow styling from our curated treatments menu.
          </p>
</div>
<div class="text-center space-y-3">
<div class="w-12 h-12 border-2 border-primary bg-surface-container-lowest mx-auto flex items-center justify-center font-bold text-primary text-lg font-headline-sm">
            2
          </div>
<h4 class="font-title-md font-bold text-primary uppercase text-sm tracking-wider">SELECT STORE &amp; TIME</h4>
<p class="font-body-sm text-on-surface-variant text-xs max-w-xs mx-auto">
            Pick from 30+ Sephora stores across Dubai, Abu Dhabi, Sharjah and find a time that fits your calendar.
          </p>
</div>
<div class="text-center space-y-3">
<div class="w-12 h-12 border-2 border-primary bg-surface-container-lowest mx-auto flex items-center justify-center font-bold text-primary text-lg font-headline-sm">
            3
          </div>
<h4 class="font-title-md font-bold text-primary uppercase text-sm tracking-wider">MEET YOUR BEAUTY ADVISOR</h4>
<p class="font-body-sm text-on-surface-variant text-xs max-w-xs mx-auto">
            Arrive at our Beauty Studio for your dedicated VIP session and leave feeling completely empowered.
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
<span class="font-label-caps text-secondary font-bold text-[12px] tracking-widest uppercase">STORE NETWORK DIRECTORY</span>
</div>
<h2 class="font-headline-md text-headline-md md:text-headline-lg font-bold text-primary tracking-tight">
        FIND A SEPHORA STORE IN UAE
      </h2>
<p class="font-body-md text-outline mt-1 max-w-2xl">
        Visit our flagships to experience exclusive fragrance collections, interactive skincare testing, and hands-on artistry counters.
      </p>
</div>
<!-- Search & Filter Bar Controls -->
<div class="border border-primary bg-surface-container-lowest p-6 mb-6">
<div class="grid grid-cols-1 md:grid-cols-12 gap-4">
<!-- Search input -->
<div class="md:col-span-6 relative">
<label class="font-label-caps text-[10px] text-outline block mb-1 uppercase tracking-widest">Search Mall or Street</label>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3 text-outline text-[18px]">search</span>
<input class="w-full pl-9 pr-3 py-2 text-sm bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 rounded-none outline-none font-body-md" placeholder="e.g. Dubai Mall, Yas Island, Marina Mall..." type="text" value="Dubai Mall"/>
</div>
</div>
<!-- Emirate City Filter -->
<div class="md:col-span-3">
<label class="font-label-caps text-[10px] text-outline block mb-1 uppercase tracking-widest">Select Emirate</label>
<select class="w-full py-2 px-3 text-sm bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 rounded-none font-body-md">
<option selected="">All Emirates (UAE)</option>
<option>Dubai (16 Stores)</option>
<option>Abu Dhabi (9 Stores)</option>
<option>Sharjah (3 Stores)</option>
<option>Al Ain (2 Stores)</option>
<option>Ras Al Khaimah (1 Store)</option>
<option>Ajman (1 Store)</option>
</select>
</div>
<!-- Service Filter -->
<div class="md:col-span-3">
<label class="font-label-caps text-[10px] text-outline block mb-1 uppercase tracking-widest">Filter by Service</label>
<select class="w-full py-2 px-3 text-sm bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 rounded-none font-body-md">
<option selected="">All Services</option>
<option>Benefit BrowBar</option>
<option>Full Face Glam Studio</option>
<option>Skin Diagnostics Bar</option>
<option>Fragrance Engraving</option>
<option>Click &amp; Collect (2hr)</option>
</select>
</div>
</div>
<!-- Quick Service Tag Chips -->
<div class="flex items-center flex-wrap gap-2 pt-4 mt-4 border-t border-outline-variant/50">
<span class="font-label-caps text-[10px] text-outline uppercase tracking-wider mr-2">Quick Filter:</span>
<button class="border border-primary bg-primary text-on-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">ALL</button>
<button class="border border-outline hover:border-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">BENEFIT BROWBAR</button>
<button class="border border-outline hover:border-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">SKIN DIAGNOSTICS</button>
<button class="border border-outline hover:border-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">MAKEUP STUDIO</button>
<button class="border border-outline hover:border-primary px-3 py-1 font-label-caps text-[10px] tracking-wider uppercase">CLICK &amp; COLLECT</button>
</div>
</div>
<!-- 2 COLUMN DIRECTORY & MAP PREVIEW -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- LEFT COLUMN: Store Cards List (Scrollable Vitrine) -->
<div class="lg:col-span-5 space-y-4 max-h-[740px] overflow-y-auto pr-2 custom-scrollbar">
<!-- Store 1: The Dubai Mall (Active Highlight) -->
<div class="border-2 border-primary bg-surface-container-lowest p-6 relative">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-[#00732f] text-on-secondary text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                OPEN TODAY UNTIL 12:00 AM
              </span>
<h3 class="font-headline-sm text-[20px] font-bold text-primary">Sephora - The Dubai Mall</h3>
</div>
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">stars</span>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            Ground &amp; First Floor, Downtown Dubai, Near Ice Rink
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">10:00 AM – 12:00 AM Midnight</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97143399828">+971 4 339 9828</a>
</div>
</div>
<!-- Store feature tags -->
<div class="flex flex-wrap gap-1.5 mb-5">
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Benefit Brow Bar</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Full Glam Studio</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Skin Diagnostics</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Fragrance Engraving</span>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant">
<a class="border border-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:bg-surface-container transition-colors flex items-center justify-center gap-1.5" href="https://maps.google.com" target="_blank">
<span class="material-symbols-outlined text-[15px]">directions</span>
<span>GET DIRECTIONS</span>
</a>
<a class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors flex items-center justify-center gap-1.5" href="#booking-section">
<span class="material-symbols-outlined text-[15px]">calendar_today</span>
<span>BOOK SERVICES</span>
</a>
</div>
</div>
<!-- Store 2: Mall of the Emirates -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                OPEN TODAY UNTIL 11:00 PM
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">Sephora - Mall of the Emirates</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            Level 1, Al Barsha, Dubai (Near Ski Dubai Entrance)
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">10:00 AM – 11:00 PM</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97143951860">+971 4 395 1860</a>
</div>
</div>
<div class="flex flex-wrap gap-1.5 mb-5">
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Benefit Brow Bar</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Custom Beauty Bar</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Click &amp; Collect</span>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              GET DIRECTIONS
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              BOOK SERVICES
            </button>
</div>
</div>
<!-- Store 3: Yas Mall Abu Dhabi -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                OPEN TODAY UNTIL 11:00 PM
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">Sephora - Yas Mall</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            Ground Floor, Yas Island, Abu Dhabi, Central Plaza
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">10:00 AM – 11:00 PM</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97125650680">+971 2 565 0680</a>
</div>
</div>
<div class="flex flex-wrap gap-1.5 mb-5">
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Benefit Brow Bar</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Makeup Studio</span>
<span class="bg-surface-container-high text-on-surface text-[10px] font-label-caps px-2 py-0.5">Fragrance Bar</span>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              GET DIRECTIONS
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              BOOK SERVICES
            </button>
</div>
</div>
<!-- Store 4: Dubai Marina Mall -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                OPEN TODAY UNTIL 10:00 PM
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">Sephora - Dubai Marina Mall</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            Dome Level, Dubai Marina, Sheikh Zayed Road
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">10:00 AM – 10:00 PM</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97144361020">+971 4 436 1020</a>
</div>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              GET DIRECTIONS
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              BOOK SERVICES
            </button>
</div>
</div>
<!-- Store 5: Galleria Mall Al Maryah Island -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                OPEN TODAY UNTIL 11:00 PM
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">Sephora - The Galleria Mall</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            Level 2, Al Maryah Island, Abu Dhabi
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">10:00 AM – 11:00 PM</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97126760520">+971 2 676 0520</a>
</div>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              GET DIRECTIONS
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              BOOK SERVICES
            </button>
</div>
</div>
<!-- Store 6: City Centre Mirdif -->
<div class="border border-outline-variant bg-surface-container-lowest p-6 hover:border-primary transition-all">
<div class="flex items-start justify-between mb-2">
<div>
<span class="bg-surface-container-highest text-on-surface text-[9px] font-label-caps px-2 py-0.5 uppercase tracking-widest inline-block mb-1">
                OPEN TODAY UNTIL 11:00 PM
              </span>
<h3 class="font-headline-sm text-[18px] font-bold text-primary">Sephora - City Centre Mirdif</h3>
</div>
</div>
<p class="font-body-sm text-on-surface-variant text-[13px] mb-3">
            Central Galleria, Ground Floor, Dubai
          </p>
<div class="space-y-1.5 text-xs text-outline mb-4">
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
<span class="text-on-surface font-medium">10:00 AM – 11:00 PM</span>
</div>
<div class="flex items-center space-x-2">
<span class="material-symbols-outlined text-[16px] text-primary">call</span>
<a class="text-on-surface hover:underline" href="tel:+97142843710">+971 4 284 3710</a>
</div>
</div>
<div class="grid grid-cols-2 gap-3 pt-3 border-t border-outline-variant/60">
<button class="border border-outline text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-primary hover:border-primary transition-colors">
              GET DIRECTIONS
            </button>
<button class="bg-primary text-center py-2.5 text-[11px] font-label-caps uppercase tracking-wider text-on-primary hover:bg-neutral-800 transition-colors">
              BOOK SERVICES
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
<span class="font-label-caps text-[10px] tracking-wider uppercase font-bold">The Dubai Mall Flagship</span>
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
              Mall of the Emirates
            </div>
</div>
<!-- Dubai Marina Mall Pin -->
<div class="absolute top-[56%] left-[40%] -translate-x-1/2 -translate-y-1/2 group cursor-pointer">
<div class="w-7 h-7 bg-primary text-on-primary rounded-full flex items-center justify-center shadow border-2 border-on-primary hover:scale-125 transition-transform">
<span class="material-symbols-outlined text-[14px]">storefront</span>
</div>
<div class="hidden group-hover:block absolute bottom-8 left-1/2 -translate-x-1/2 bg-primary text-on-primary text-[10px] px-2 py-1 font-label-caps whitespace-nowrap">
              Dubai Marina Mall
            </div>
</div>
<!-- Abu Dhabi Yas Mall Pin -->
<div class="absolute top-[68%] left-[28%] -translate-x-1/2 -translate-y-1/2 group cursor-pointer">
<div class="w-7 h-7 bg-primary text-on-primary rounded-full flex items-center justify-center shadow border-2 border-on-primary hover:scale-125 transition-transform">
<span class="material-symbols-outlined text-[14px]">storefront</span>
</div>
<div class="hidden group-hover:block absolute bottom-8 left-1/2 -translate-x-1/2 bg-primary text-on-primary text-[10px] px-2 py-1 font-label-caps whitespace-nowrap">
              Yas Mall, Abu Dhabi
            </div>
</div>
<!-- City Centre Mirdif Pin -->
<div class="absolute top-[32%] left-[62%] -translate-x-1/2 -translate-y-1/2 group cursor-pointer">
<div class="w-7 h-7 bg-primary text-on-primary rounded-full flex items-center justify-center shadow border-2 border-on-primary hover:scale-125 transition-transform">
<span class="material-symbols-outlined text-[14px]">storefront</span>
</div>
<div class="hidden group-hover:block absolute bottom-8 left-1/2 -translate-x-1/2 bg-primary text-on-primary text-[10px] px-2 py-1 font-label-caps whitespace-nowrap">
              City Centre Mirdif
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
            MAP VIEW: UNITED ARAB EMIRATES (32 BOUTIQUES)
          </div>
</div>
<!-- Selected Location Summary Panel at base of Map -->
<div class="p-6 bg-surface-container-lowest border-t border-primary">
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
<div>
<p class="font-label-caps text-[10px] text-secondary font-bold tracking-widest uppercase">CURRENTLY PREVIEWING</p>
<h4 class="font-headline-sm text-primary font-bold">The Dubai Mall - Sephora Flagship</h4>
<p class="font-body-sm text-outline text-xs mt-0.5">Downtown Dubai · Level 0 &amp; Level 1 · 1,400+ Premium Fragrance &amp; Cosmetics Lines</p>
</div>
<div class="flex items-center gap-3">
<a class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary border border-primary px-5 py-2.5 font-label-caps text-[11px] uppercase tracking-wider transition-colors inline-flex items-center gap-2" href="https://maps.google.com" target="_blank">
<span>OPEN IN GOOGLE MAPS</span>
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
<h4 class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">Free Delivery</h4>
<p class="font-body-sm text-[12px] text-outline">On all orders over 250 AED</p>
</div>
</div>
<div class="flex items-center space-x-4">
<span class="material-symbols-outlined text-[36px] text-primary">verified</span>
<div>
<h4 class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">100% Authentic</h4>
<p class="font-body-sm text-[12px] text-outline">Direct from luxury ateliers</p>
</div>
</div>
<div class="flex items-center space-x-4">
<span class="material-symbols-outlined text-[36px] text-primary">replay</span>
<div>
<h4 class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">Easy Returns</h4>
<p class="font-body-sm text-[12px] text-outline">In any UAE Sephora store</p>
</div>
</div>
<div class="flex items-center space-x-4">
<span class="material-symbols-outlined text-[36px] text-primary">loyalty</span>
<div>
<h4 class="font-title-md text-[13px] font-bold uppercase tracking-wider text-primary">Beauty Pass Points</h4>
<p class="font-body-sm text-[12px] text-outline">Earn points in-store &amp; online</p>
</div>
</div>
</div>
</div>
</section>
<!-- NEWSLETTER SIGNUP -->
<section class="bg-surface-container-low border-b border-outline-variant py-14">
<div class="w-full max-w-[800px] mx-auto px-4 text-center space-y-4">
<span class="material-symbols-outlined text-[32px] text-primary">mail</span>
<h3 class="font-headline-md text-headline-md font-bold text-primary tracking-tight">
        STAY CONNECTED WITH SEPHORA
      </h3>
<p class="font-body-md text-outline text-[14px]">
        Subscribe to receive backstage beauty invitations, private VIP masterclasses, and tailored Middle East previews.
      </p>
<form class="flex flex-col sm:flex-row items-center justify-center gap-2 max-w-lg mx-auto pt-2" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="w-full sm:flex-1 py-3 px-4 text-xs font-body-md bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 rounded-none outline-none" placeholder="Enter your email address" required="" type="email"/>
<button class="w-full sm:w-auto bg-primary text-on-primary hover:bg-neutral-800 px-8 py-3 font-label-caps text-label-caps tracking-widest uppercase transition-colors whitespace-nowrap" type="submit">
          SUBSCRIBE
        </button>
</form>
<p class="font-body-sm text-[11px] text-outline">
        By subscribing, you agree to receive marketing communications and accept our Privacy Policy.
      </p>
</div>
</section>
<!-- OFFICIAL DESKTOP FOOTER (Shared Components JSON Anchor) -->
@endsection
