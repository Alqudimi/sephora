@extends('layouts.app')

@section('title', __('meta.fragrance'))
@section('body_class', 'bg-surface-container-lowest text-on-surface antialiased font-body-md text-body-md min-h-screen selection:bg-primary selection:text-on-primary')

@section('content')
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- 3. BREADCRUMBS & TITLE HEADER -->
<nav class="flex items-center gap-2 text-outline text-[12px] font-body-sm mb-4">
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span>/</span>
<span class="text-on-surface font-semibold">{{ __('ui.fragrance') }}</span>
</nav>
<div class="flex flex-col md:flex-row md:items-end justify-between border-b border-primary pb-5 mb-8">
<div>
<div class="flex items-baseline gap-3">
<h1 class="font-headline-lg text-headline-lg font-bold tracking-tight text-primary">{{ __('ui.fragrance') }}</h1>
<span class="font-body-md text-outline font-normal text-sm">{{ __('ui.items_count_label', ['count' => 846]) }}</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1 max-w-xl">
          {{ __('content.t_9bb2d0bea17c') }}
        </p>
</div>
<!-- Sort By Dropdown -->
<div class="mt-4 md:mt-0 flex items-center gap-3">
<label class="font-label-caps text-label-caps uppercase text-outline" for="sort-select">{{ __('content.t_9bb640e5a014') }}</label>
<div class="relative">
<select class="appearance-none bg-surface-container-lowest border border-outline pl-3 pr-8 py-2 font-label-caps text-label-caps tracking-wider rounded-none cursor-pointer focus:border-primary focus:ring-0 text-on-surface" id="sort-select">
<option>{{ __('ui.recommended') }}</option>
<option>{{ __('ui.new_arrivals') }}</option>
<option>{{ __('ui.price_high_low') }}</option>
<option>{{ __('ui.price_low_high') }}</option>
<option>{{ __('content.t_a1118d1ba9c9') }}</option>
<option>{{ __('content.t_c9418ddbe778') }}</option>
</select>
<span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none text-[18px]" data-icon="expand_more">expand_more</span>
</div>
</div>
</div>
<!-- 4 & 5. SIDEBAR FILTERS & PRODUCT GRID -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">
<!-- 4. SIDEBAR FILTERS (Left Column) -->
<aside class="lg:col-span-3 space-y-6">
<!-- Categories List -->
<div class="border border-outline-variant p-5 bg-surface-container-lowest">
<h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-extrabold pb-3 border-b border-surface-container">{{ __('ui.categories') }}</h2>
<ul class="mt-3 space-y-2.5 font-body-sm text-body-sm">
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">{{ __('content.t_4b8fa4114b85') }}</span>
<span class="text-outline text-xs">(420)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">{{ __('content.t_d3bc2c6a5d7a') }}</span>
<span class="text-outline text-xs">(215)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">{{ __('content.t_04cd06bb6bd6') }}</span>
<span class="text-outline text-xs">(380)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">{{ __('content.t_595a603804ee') }}</span>
<span class="text-outline text-xs">(120)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">{{ __('content.t_853bb73019e5') }}</span>
<span class="text-outline text-xs">(45)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">{{ __('content.t_a3ed045a1b87') }}</span>
<span class="text-outline text-xs">(32)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">{{ __('ui.travel_size') }}</span>
<span class="text-outline text-xs">(88)</span>
</li>
<li class="flex items-center justify-between text-on-surface hover:text-primary cursor-pointer font-medium group">
<span class="group-hover:translate-x-0.5 transition-transform">{{ __('content.t_0f494f97b6d3') }}</span>
<span class="text-outline text-xs">(96)</span>
</li>
</ul>
</div>
<!-- Refine Section -->
<div class="border border-outline-variant p-5 bg-surface-container-lowest">
<div class="flex items-center justify-between pb-3 border-b border-surface-container">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-extrabold">{{ __('ui.refine') }}</span>
<button class="font-label-caps text-[10px] tracking-wider text-outline hover:text-secondary underline transition-colors" type="button">{{ __('ui.clear_all') }}</button>
</div>
<!-- Sephora Exclusive Toggle -->
<div class="flex items-center justify-between py-4 border-b border-surface-container">
<span class="font-body-sm text-body-sm font-semibold text-on-surface">{{ __('content.t_a283183b6457') }}</span>
<label class="relative inline-flex items-center cursor-pointer">
<input class="sr-only peer" type="checkbox" value=""/>
<div class="w-9 h-5 bg-surface-container-highest peer-focus:outline-none peer-checked:bg-primary transition-colors"></div>
<div class="absolute left-0.5 top-0.5 w-4 h-4 bg-white transition-transform peer-checked:translate-x-4"></div>
</label>
</div>
<!-- Accordion 1: Brand -->
<details class="group py-3 border-b border-surface-container" open="">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>{{ __('ui.brand_caps') }}</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2 pl-0.5">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input checked="" class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Kayali</span>
<span class="text-outline text-[11px]">(28)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Dior</span>
<span class="text-outline text-[11px]">(42)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input checked="" class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_81685b353e5c') }}</span>
<span class="text-outline text-[11px]">(35)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_e76d141f2b1c') }}</span>
<span class="text-outline text-[11px]">(19)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_35ec2602fdb4') }}</span>
<span class="text-outline text-[11px]">(24)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_9635c853330f') }}</span>
<span class="text-outline text-[11px]">(18)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_37eb97b4ea4f') }}</span>
<span class="text-outline text-[11px]">(15)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Rabanne</span>
<span class="text-outline text-[11px]">(17)</span>
</label>
</div>
</details>
<!-- Accordion 2: Fragrance Family -->
<details class="group py-3 border-b border-surface-container" open="">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>{{ __('content.t_705f7966a7fe') }}</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('ui.floral') }}</span>
<span class="text-outline text-[11px]">(145)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_378237ae0470') }}</span>
<span class="text-outline text-[11px]">(112)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">Amber</span>
<span class="text-outline text-[11px]">(89)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('ui.vanilla') }}</span>
<span class="text-outline text-[11px]">(74)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('ui.fresh') }}</span>
<span class="text-outline text-[11px]">(65)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('ui.fruity') }}</span>
<span class="text-outline text-[11px]">(52)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('ui.musky') }}</span>
<span class="text-outline text-[11px]">(48)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('ui.oriental') }}</span>
<span class="text-outline text-[11px]">(98)</span>
</label>
</div>
</details>
<!-- Accordion 3: Product Type -->
<details class="group py-3 border-b border-surface-container">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>{{ __('content.t_1b0f4cd9df91') }}</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_e48e35f25de4') }}</span>
<span class="text-outline text-[11px]">(310)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_1feb90e3933d') }}</span>
<span class="text-outline text-[11px]">(140)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_e127e681cb6a') }}</span>
<span class="text-outline text-[11px]">(42)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_900d30ec7ce2') }}</span>
<span class="text-outline text-[11px]">(36)</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_881fa521fab9') }}</span>
<span class="text-outline text-[11px]">(55)</span>
</label>
</div>
</details>
<!-- Accordion 4: Size & Volume -->
<details class="group py-3 border-b border-surface-container">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>{{ __('content.t_8ad0dae94bc3') }}</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 flex flex-wrap gap-2">
<button class="px-3 py-1 border border-outline-variant text-xs hover:border-primary" type="button">30ml</button>
<button class="px-3 py-1 border border-primary bg-primary text-white text-xs" type="button">50ml</button>
<button class="px-3 py-1 border border-outline-variant text-xs hover:border-primary" type="button">70ml</button>
<button class="px-3 py-1 border border-outline-variant text-xs hover:border-primary" type="button">100ml</button>
</div>
</details>
<!-- Accordion 5: Price -->
<details class="group py-3 border-b border-surface-container">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>{{ __('ui.price') }}</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_82c42e506ad0') }}</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">200 - 500 AED</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">500 - 1000 AED</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">1000+ AED</span>
</label>
</div>
</details>
<!-- Accordion 6: Benefits / Occasion -->
<details class="group py-3">
<summary class="flex justify-between items-center cursor-pointer list-none font-label-caps text-label-caps text-primary tracking-wider">
<span>{{ __('content.t_168bfb974763') }}</span>
<span class="material-symbols-outlined text-[18px] group-open:rotate-180 transition-transform" data-icon="expand_more">expand_more</span>
</summary>
<div class="mt-3 space-y-2">
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('ui.long_lasting') }}</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_d6d4a9f49340') }}</span>
</label>
<label class="flex items-center gap-2 cursor-pointer text-xs text-on-surface">
<input class="w-4 h-4 rounded-none text-primary focus:ring-0 border-outline" type="checkbox"/>
<span class="flex-1">{{ __('content.t_e07c79ee30ff') }}</span>
</label>
</div>
</details>
</div>
</aside>
<!-- 5. PRODUCT GRID (4 Columns, Responsive in 9-col container) -->
<section class="lg:col-span-9" id="fragrance-grid">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
<!-- Card 1: Maison Francis Kurkdjian -->
@foreach($products as $products)
<div class="group relative flex flex-col bg-surface-container-lowest border border-outline-variant hover:border-primary transition-all duration-200">
<div class="relative w-full aspect-square bg-[#fcfbfa] overflow-hidden flex items-center justify-center p-3">
<div class="absolute top-2 left-2 z-10 flex flex-col gap-{{ __('ui.items_count_label', ['count' => '1']) }}-start">
@if($products->badge)
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-widest">{{ $products->badge }}</span>
@endif

</div>
<button aria-label="{{ __('content.t_c7a159eeb9d2') }}" class="absolute top-2 right-2 z-10 text-on-surface-variant hover:text-secondary p-1 transition-colors" type="button">
<span class="material-symbols-outlined text-[20px]" data-icon="favorite">favorite</span>
</button>
<img alt="{{ $products->name }}" class="object-contain w-full h-full group-hover:scale-105 transition-transform duration-300" src="{{ media_url($products->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
</div>
<div class="p-3.5 flex flex-col flex-1">
<p class="font-label-caps text-label-caps uppercase text-primary font-bold tracking-wider">{{ $products->brand->name }}
<h3 class="font-body-md text-sm font-medium text-on-surface line-clamp-2 mt-1 min-h-[40px]">{{ $products->name }}</h3>
<div class="flex items-center gap-1.5 my-2">
<div class="flex text-amber-500 text-[14px]">
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[15px]" data-icon="star" data-weight="fill" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-label-tag text-[11px] text-outline">4.9 ({{ number_format($products->reviews_count) }})</span>
</div>
<div class="mt-auto pt-2 border-t border-surface-container flex items-baseline justify-between">
<span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED {{ number_format($products->price, 2) }}</span>
</div>
<button class="mt-3 w-full py-2.5 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-white hover:text-primary hover:border hover:border-primary transition-all duration-150" type="button" data-add-to-bag="{{ $products->id }}">
                {{ __('content.t_ea34a3a7ca7b') }}
              </button>
</div>
</div>
@endforeach
</div>
<!-- 6. PAGINATION & LOAD MORE -->
<div class="mt-12 flex flex-col items-center justify-center text-center">
<p class="font-body-sm text-body-sm text-outline mb-2">{{ __('content.t_541ac5d66b51') }}</p>
<div class="w-64 h-1 bg-surface-container mb-6 overflow-hidden">
<div class="bg-primary h-full w-[20%]"></div>
</div>
<button class="px-10 py-3.5 border-2 border-primary bg-transparent text-primary hover:bg-primary hover:text-white font-label-caps text-label-caps uppercase tracking-widest transition-all duration-200 cursor-pointer" type="button">
            {{ __('content.t_ff6255edd8b2') }}
          </button>
</div>
</section>
</div>
<!-- 7. TRUST BADGES (Sephora Signature 4 Columns) -->
<section class="mt-20 pt-10 border-t border-outline-variant grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
<div class="flex flex-col items-center p-4 border border-surface-container bg-surface-container-lowest">
<span class="material-symbols-outlined text-[32px] text-primary mb-2" data-icon="local_shipping">local_shipping</span>
<h4 class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary">{{ __('content.t_fc2bdabb8563') }}</h4>
<p class="font-body-sm text-xs text-outline mt-1">{{ __('content.t_108ddab01fe7') }}</p>
</div>
<div class="flex flex-col items-center p-4 border border-surface-container bg-surface-container-lowest">
<span class="material-symbols-outlined text-[32px] text-primary mb-2" data-icon="verified">verified</span>
<h4 class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary">{{ __('ui.authentic_100') }}</h4>
<p class="font-body-sm text-xs text-outline mt-1">{{ __('content.t_4cc34ac8bd87') }}</p>
</div>
<div class="flex flex-col items-center p-4 border border-surface-container bg-surface-container-lowest">
<span class="material-symbols-outlined text-[32px] text-primary mb-2" data-icon="assignment_return">assignment_return</span>
<h4 class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary">{{ __('content.t_3feade442c68') }}</h4>
<p class="font-body-sm text-xs text-outline mt-1">{{ __('content.t_0bdb7910318d') }}</p>
</div>
<div class="flex flex-col items-center p-4 border border-surface-container bg-surface-container-lowest">
<span class="material-symbols-outlined text-[32px] text-primary mb-2" data-icon="loyalty">loyalty</span>
<h4 class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary">{{ __('content.t_6bd8f9001b02') }}</h4>
<p class="font-body-sm text-xs text-outline mt-1">{{ __('content.t_c5bdd6223bae') }}</p>
</div>
</section>
<!-- 8. NEWSLETTER / VIP BANNER -->
<section class="mt-16 bg-[#111111] text-white p-8 md:p-12 text-center">
<div class="max-w-2xl mx-auto">
<span class="material-symbols-outlined text-[36px] text-white mb-2" data-icon="mail">mail</span>
<h2 class="font-display-hero text-headline-sm uppercase tracking-widest font-bold">{{ __('ui.stay_connected') }}</h2>
<p class="font-body-sm text-body-sm text-outline-variant mt-2 mb-6">
          {{ __('content.t_9c0ee22741d1') }}
        </p>
<form class="flex flex-col sm:flex-row gap-2 max-w-md mx-auto" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="flex-1 px-4 py-3 bg-surface-container-lowest text-black rounded-none border border-outline focus:border-white focus:ring-0 text-sm placeholder:text-outline" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="px-8 py-3 bg-white text-black font-label-caps text-label-caps uppercase tracking-widest font-bold hover:bg-neutral-200 transition-colors" type="submit">
            {{ __('content.t_1e0c8c669c5f') }}
          </button>
</form>
</div>
</section>
</main>
@endsection
