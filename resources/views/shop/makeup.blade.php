@extends('layouts.app')

@section('title', __('meta.makeup'))
@section('body_class', 'bg-surface-container-lowest text-on-surface antialiased selection:bg-primary selection:text-on-primary')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-6 pb-space-xl">
<!-- 3. Breadcrumb & Page Header -->
<section class="mb-8">
<nav aria-label="Breadcrumb" class="mb-4">
<ol class="flex items-center space-x-2 font-body-sm text-body-sm text-on-surface-variant">
<li><a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a></li>
<li><span class="text-outline-variant">/</span></li>
<li aria-current="page" class="font-bold text-on-surface">{{ __('ui.makeup') }}</li>
</ol>
</nav>
<div class="flex flex-col md:flex-row md:items-baseline justify-between border-b border-outline-variant pb-6 gap-4">
<div class="flex items-baseline space-x-4">
<h1 class="font-headline-lg text-headline-lg text-primary tracking-tight">{{ __('ui.makeup') }}</h1>
<span class="font-body-md text-body-md text-on-surface-variant">1,240 items</span>
</div>
<!-- Sorting Dropdown -->
<div class="flex items-center space-x-2">
<label class="sr-only" for="sort-select">{{ __('content.t_deefa3c0dc08') }}</label>
<div class="relative inline-block text-left">
<button aria-expanded="false" aria-haspopup="true" class="inline-flex items-center justify-between border border-primary bg-surface-container-lowest px-4 py-2 text-on-surface font-title-md text-title-md min-w-[220px] focus:outline-none" id="sort-menu-button" type="button">
<span>{{ __('content.t_9bb640e5a014') }} <span class="font-normal text-on-surface-variant">{{ __('ui.recommended') }}</span></span>
<span aria-hidden="true" class="material-symbols-outlined text-sm ml-2">expand_more</span>
</button>
</div>
</div>
</div>
</section>
<!-- Catalog Layout: 4-col Sidebar + 8-col/12-col Grid Architecture -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- 4. Left Sidebar Filters & Categories (3 cols on desktop) -->
<aside class="lg:col-span-3 space-y-6">
<!-- Accordion: Categories -->
<div class="border-b border-outline-variant pb-6">
<h2 class="font-title-lg text-title-lg tracking-wider uppercase mb-4 text-primary flex items-center justify-between">
<span>{{ __('ui.categories') }}</span>
<span aria-hidden="true" class="material-symbols-outlined text-sm">expand_less</span>
</h2>
<ul class="space-y-2.5 font-body-md text-body-md text-on-surface">
<li>
<a class="flex items-center justify-between hover:text-secondary group transition-colors" href="{{ route('shop.category', ['slug' => 'makeup']) }}">
<span class="group-hover:translate-x-1 transition-transform">{{ __('ui.face') }}</span>
<span class="text-on-surface-variant text-body-sm">(412)</span>
</a>
</li>
<li>
<a class="flex items-center justify-between hover:text-secondary group transition-colors" href="{{ route('shop.category', ['slug' => 'makeup']) }}">
<span class="group-hover:translate-x-1 transition-transform">{{ __('ui.lips') }}</span>
<span class="text-on-surface-variant text-body-sm">(280)</span>
</a>
</li>
<li>
<a class="flex items-center justify-between hover:text-secondary group transition-colors" href="{{ route('shop.category', ['slug' => 'makeup']) }}">
<span class="group-hover:translate-x-1 transition-transform">Eyes</span>
<span class="text-on-surface-variant text-body-sm">(245)</span>
</a>
</li>
<li>
<a class="flex items-center justify-between hover:text-secondary group transition-colors" href="{{ route('shop.category', ['slug' => 'makeup']) }}">
<span class="group-hover:translate-x-1 transition-transform">Brows</span>
<span class="text-on-surface-variant text-body-sm">(95)</span>
</a>
</li>
<li>
<a class="flex items-center justify-between hover:text-secondary group transition-colors" href="{{ route('shop.category', ['slug' => 'makeup']) }}">
<span class="group-hover:translate-x-1 transition-transform">{{ __('content.t_003342fefc4f') }}</span>
<span class="text-on-surface-variant text-body-sm">(118)</span>
</a>
</li>
<li>
<a class="flex items-center justify-between hover:text-secondary group transition-colors" href="{{ route('shop.category', ['slug' => 'makeup']) }}">
<span class="group-hover:translate-x-1 transition-transform">{{ __('ui.makeup_palettes') }}</span>
<span class="text-on-surface-variant text-body-sm">(54)</span>
</a>
</li>
<li>
<a class="flex items-center justify-between hover:text-secondary group transition-colors" href="{{ route('shop.category', ['slug' => 'makeup']) }}">
<span class="group-hover:translate-x-1 transition-transform">Nails</span>
<span class="text-on-surface-variant text-body-sm">(36)</span>
</a>
</li>
</ul>
</div>
<!-- Section: Refine -->
<div class="space-y-4">
<div class="flex items-center justify-between pb-2 border-b border-outline-variant">
<h2 class="font-title-lg text-title-lg tracking-wider uppercase text-primary">{{ __('ui.refine') }}</h2>
<button class="font-label-caps text-label-caps uppercase text-on-surface-variant hover:text-primary underline">{{ __('ui.clear_all') }}</button>
</div>
<!-- Sephora Exclusive Toggle -->
<div class="py-3 flex items-center justify-between border-b border-outline-variant">
<span class="font-title-md text-title-md text-primary">{{ __('content.t_a283183b6457') }}</span>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox"/>
<div class="w-11 h-6 bg-surface-container-high peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
<!-- Filter Accordions -->
<div class="space-y-0 text-primary">
<!-- Brand -->
<details class="group border-b border-outline-variant py-3" open="">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-md text-title-md uppercase tracking-wider">
<span>{{ __('ui.brand') }}</span>
<span class="material-symbols-outlined text-sm group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="pt-3 space-y-2 max-h-48 overflow-y-auto custom-scroll pr-2">
<label class="flex items-center space-x-2.5 cursor-pointer text-body-sm">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Huda Beauty (42)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer text-body-sm">
<input checked="" class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Dior (38)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer text-body-sm">
<input checked="" class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>NARS (34)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer text-body-sm">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Patrick Ta (18)</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer text-body-sm">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Dolce &amp; Gabbana (14)</span>
</label>
</div>
</details>
<!-- Product Type -->
<details class="group border-b border-outline-variant py-3">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-md text-title-md uppercase tracking-wider">
<span>{{ __('content.t_ac278bc760c9') }}</span>
<span class="material-symbols-outlined text-sm group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="pt-3 space-y-2 text-body-sm">
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_0ae4179bd2a1') }}</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Concealer</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_7f631491b474') }}</span>
</label>
</div>
</details>
<!-- Shades & Tones -->
<details class="group border-b border-outline-variant py-3">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-md text-title-md uppercase tracking-wider">
<span>{{ __('ui.shades_tones') }}</span>
<span class="material-symbols-outlined text-sm group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="pt-3 grid grid-cols-5 gap-2">
<button aria-label="{{ __('content.t_cfb70409e6f2') }}" class="w-6 h-6 rounded-none bg-[#e8beac] border border-outline hover:scale-105 transition-transform" title="Nude"></button>
<button aria-label="{{ __('content.t_b1f25081d5dd') }}" class="w-6 h-6 rounded-none bg-[#d98293] border border-outline hover:scale-105 transition-transform" title="Pink"></button>
<button aria-label="{{ __('content.t_7fd71da11a3b') }}" class="w-6 h-6 rounded-none bg-[#9e1c25] border border-outline hover:scale-105 transition-transform" title="Red"></button>
<button aria-label="{{ __('content.t_5d5a24c8fbcc') }}" class="w-6 h-6 rounded-none bg-[#631a31] border border-outline hover:scale-105 transition-transform" title="Berry"></button>
<button aria-label="{{ __('content.t_6539b35ac2a8') }}" class="w-6 h-6 rounded-none bg-[#a06b4b] border border-outline hover:scale-105 transition-transform" title="Bronze"></button>
</div>
</details>
<!-- Finish -->
<details class="group border-b border-outline-variant py-3">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-md text-title-md uppercase tracking-wider">
<span>Finish</span>
<span class="material-symbols-outlined text-sm group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="pt-3 space-y-2 text-body-sm">
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Matte</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_e76f195844a2') }}</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Natural</span>
</label>
</div>
</details>
<!-- Coverage -->
<details class="group border-b border-outline-variant py-3">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-md text-title-md uppercase tracking-wider">
<span>{{ __('ui.coverage') }}</span>
<span class="material-symbols-outlined text-sm group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="pt-3 space-y-2 text-body-sm">
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_810c5014bad7') }}</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_b2aa9c5d130f') }}</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Sheer</span>
</label>
</div>
</details>
<!-- Price -->
<details class="group border-b border-outline-variant py-3">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-md text-title-md uppercase tracking-wider">
<span>{{ __('ui.price') }}</span>
<span class="material-symbols-outlined text-sm group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="pt-3 space-y-2 text-body-sm">
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_8400251be41e') }}</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_102013f03e4a') }}</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>AED 250+</span>
</label>
</div>
</details>
<!-- Benefits -->
<details class="group border-b border-outline-variant py-3">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-md text-title-md uppercase tracking-wider">
<span>{{ __('ui.benefits') }}</span>
<span class="material-symbols-outlined text-sm group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="pt-3 space-y-2 text-body-sm">
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_996cee09d133') }}</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Hydrating</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Waterproof</span>
</label>
</div>
</details>
<!-- Formulation -->
<details class="group border-b border-outline-variant py-3">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-md text-title-md uppercase tracking-wider">
<span>Formulation</span>
<span class="material-symbols-outlined text-sm group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="pt-3 space-y-2 text-body-sm">
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>Liquid</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_90ccf06e0bba') }}</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="rounded-none border-outline text-primary focus:ring-0 w-4 h-4" type="checkbox"/>
<span>{{ __('content.t_ce2305467027') }}</span>
</label>
</div>
</details>
</div>
</div>
</aside>
<!-- 5. Makeup Product Grid (9 cols on desktop, 4 columns internal grid) -->
<section class="lg:col-span-9">
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-8">
<!-- Card 1: PATRICK TA -->
@foreach($products as $products)
<article onclick="window.location='/p/{{ $products->slug }}'" class="group relative flex flex-col justify-between border border-outline-variant hover:border-primary transition-colors bg-surface-container-lowest p-3">
<div class="relative w-full aspect-square overflow-hidden bg-surface-container-low mb-3">
<div class="absolute top-2 left-2 z-10 flex flex-col gap-1">
@if($products->badge)
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-1.5 py-0.5 uppercase tracking-wider">{{ $products->badge }}</span>
@endif

</div>
<button aria-label="{{ __('content.t_d4ee53a6f50d') }}" class="absolute top-2 right-2 z-10 p-1 text-primary hover:text-secondary transition-colors">
<span class="material-symbols-outlined text-[20px]">favorite</span>
</button>
<img alt="{{ $products->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ media_url($products->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
</div>
<div class="flex-1 flex flex-col">
<span class="font-label-caps text-label-caps uppercase font-bold tracking-widest text-primary mb-1">{{ $products->brand->name }}
<h3 class="font-body-sm text-body-sm text-on-surface line-clamp-2 min-h-[36px] mb-2 font-normal">{{ $products->name }}</h3>
<div class="flex items-center space-x-1 text-body-sm text-on-surface-variant mb-2">
<span class="text-tertiary-fixed-dim font-bold">@include('components.stars', ['rating' => $products->rating])</span>
<span class="font-bold text-on-surface text-[12px]">{{ $products->rating }}</span>
<span class="text-[11px]">({{ number_format($products->reviews_count) }})</span>
</div>
<div class="mt-auto mb-3">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED {{ number_format($products->price, 2) }}</span>
</div>
<button class="w-full h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider border border-primary hover:bg-surface-container-lowest hover:text-primary transition-colors" data-add-to-bag="{{ $products->id }}">
                {{ __('content.t_ea34a3a7ca7b') }}
              </button>
</div>
</article>
@endforeach
</div>
<!-- 6. Pagination / Progress Indicator -->
<div class="mt-14 pt-8 border-t border-outline-variant flex flex-col items-center justify-center space-y-4">
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_f963131c83d9') }}</p>
<div class="w-64 h-1 bg-surface-container rounded-none overflow-hidden">
<div class="bg-primary h-full w-[2%]"></div>
</div>
<button class="px-8 h-12 border border-primary text-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary hover:text-on-primary transition-colors">
            {{ __('content.t_ff6255edd8b2') }}
          </button>
</div>
</section>
</div>
<!-- 7. Sephora UAE Trust Badges -->
<section class="mt-20 pt-10 pb-8 border-t border-b border-outline-variant">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
<!-- Badge 1 -->
<div class="flex items-center space-x-4">
<span aria-hidden="true" class="material-symbols-outlined text-[32px] text-primary">local_shipping</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">{{ __('content.t_fc2bdabb8563') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_108ddab01fe7') }}</p>
</div>
</div>
<!-- Badge 2 -->
<div class="flex items-center space-x-4">
<span aria-hidden="true" class="material-symbols-outlined text-[32px] text-primary">verified</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">100% AUTHENTIC</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_4cc34ac8bd87') }}</p>
</div>
</div>
<!-- Badge 3 -->
<div class="flex items-center space-x-4">
<span aria-hidden="true" class="material-symbols-outlined text-[32px] text-primary">sync</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">{{ __('content.t_3feade442c68') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_0bdb7910318d') }}</p>
</div>
</div>
<!-- Badge 4 -->
<div class="flex items-center space-x-4">
<span aria-hidden="true" class="material-symbols-outlined text-[32px] text-primary">stars</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">{{ __('content.t_6bd8f9001b02') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_c5bdd6223bae') }}</p>
</div>
</div>
</div>
</section>
<!-- 8. VIP / Newsletter Section -->
<section class="my-16 py-12 px-6 bg-surface-container-low border border-outline-variant text-center max-w-4xl mx-auto">
<h3 class="font-headline-md text-headline-md uppercase tracking-widest text-primary mb-3">{{ __('ui.stay_connected') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant max-w-lg mx-auto mb-6">
        {{ __('content.t_9c0ee22741d1') }}
      </p>
<form class="flex flex-col sm:flex-row items-center justify-center gap-2 max-w-md mx-auto" onsubmit="event.preventDefault();" data-newsletter-form>
<label class="sr-only" for="newsletter-email">{{ __('content.t_c09924a9f455') }}</label>
<input class="w-full sm:w-80 h-12 bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 px-4 font-body-sm text-body-sm placeholder:text-on-surface-variant text-on-surface rounded-none" id="newsletter-email" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="w-full sm:w-auto h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider hover:bg-surface-container-highest hover:text-primary transition-colors border border-primary" type="submit">
          {{ __('content.t_1e0c8c669c5f') }}
        </button>
</form>
</section>
</main>
@endsection
