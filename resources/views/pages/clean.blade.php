@extends('layouts.app')

@section('title', __('meta.clean'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- 3. Breadcrumbs & Page Header -->
<main class="w-full">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-5">
<!-- Breadcrumb -->
<nav aria-label="{{ __('ui.breadcrumb') }}" class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase text-[10px] tracking-wider mb-6">
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span>/</span>
<span class="text-primary font-bold">{{ __('content.t_87e7a5115e2e') }}</span>
</nav>
<!-- Page Title -->
<div class="mb-8">
<h1 class="font-headline-lg text-headline-lg md:text-[44px] text-primary tracking-tight">
          {{ __('content.t_87e7a5115e2e') }}
        </h1>
</div>
<!-- Hero Banner Image & Overlay Concept -->
<div class="relative w-full border border-primary overflow-hidden mb-12 bg-[#D9EAF0]">
<img alt="{{ __('content.t_b97ce393f72e') }}" class="w-full h-auto object-cover min-h-[260px] md:min-h-[380px]" src="{{ asset('images/hero/modern_luxury_sephora_beauty_flagship_store_interior_sleek_monochrome_black_and.webp') }}"/>
<!-- Clean + Planet Aware Badges Showcase Strip -->
<div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-primary border-t border-primary bg-surface-container-lowest">
<div class="p-6 flex items-center gap-4 group cursor-pointer hover:bg-surface-container transition-colors">
<img alt="{{ __('content.t_256f6c72e531') }}" class="w-16 h-16 object-contain flex-shrink-0" src="{{ asset('images/content/img_a01311f0e4ad8f4d.jpg') }}"/>
<div>
<span class="font-label-caps text-label-caps text-outline block mb-1">{{ __('ui.standard_01') }}</span>
<h2 class="font-title-lg text-title-lg text-primary uppercase font-bold">{{ __('content.t_55e31f606edb') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_4d973c4d33cb') }}</p>
</div>
</div>
<div class="p-6 flex items-center gap-4 group cursor-pointer hover:bg-surface-container transition-colors">
<img alt="{{ __('content.t_f62c3c07d25b') }}" class="w-16 h-16 object-contain flex-shrink-0" src="{{ asset('images/content/img_f55510eb9ee312ed.jpg') }}"/>
<div>
<span class="font-label-caps text-label-caps text-outline block mb-1">{{ __('ui.standard_02') }}</span>
<h2 class="font-title-lg text-title-lg text-primary uppercase font-bold">{{ __('content.t_d293db19dc1b') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_ee033c2adfae') }}</p>
</div>
</div>
<div class="p-6 flex items-center gap-4 group cursor-pointer hover:bg-surface-container transition-colors">
<img alt="{{ __('content.t_2cab16c16152') }}" class="w-16 h-16 object-contain flex-shrink-0" src="{{ asset('images/content/img_4c436417accfce85.jpg') }}"/>
<div>
<span class="font-label-caps text-label-caps text-outline block mb-1">{{ __('content.t_d33da31dc6b2') }}</span>
<h2 class="font-title-lg text-title-lg text-primary uppercase font-bold">{{ __('content.t_19bc4c124664') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_286957c8d930') }}</p>
</div>
</div>
</div>
</div>
<!-- Editorial Manifesto Bar -->
<section aria-labelledby="manifesto-heading" class="border border-primary p-8 md:p-12 mb-16 text-center bg-surface-container-lowest">
<h2 class="font-headline-md text-headline-md mb-3 text-primary" id="manifesto-heading">
          {{ __('content.t_a6b8d3270618') }}
        </h2>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl mx-auto mb-6">
          {{ __('content.t_5397207117bd') }}
        </p>
<button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase px-8 py-3.5 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all duration-200">{{ __('ui.learn_more') }}</button>
</section>
<!-- 4. Clean Skincare Carousel & Grid -->
<section class="mb-16">
<div class="flex items-baseline justify-between border-b border-primary pb-3 mb-6">
<div class="flex items-center gap-3">
<h2 class="font-headline-md text-headline-md text-primary">{{ __('content.t_746756e7ba51') }}</h2>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag text-on-surface-variant uppercase">{{ __('ui.products_count', ['count' => 8]) }}</span>
</div>
<a class="font-label-caps text-label-caps uppercase underline underline-offset-4 hover:text-secondary transition-colors" href="/shop/skincare">
            {{ __('content.t_140c43afa05e') }}
          </a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
<!-- Item 1 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-[#008751] text-white font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.clean_badge') }}</span>
<img alt="{{ __('content.t_144fabcd9a80') }}" class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" src="{{ asset('images/content/img_394b44c9b6270c9c.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">{{ __('content.t_289b65242e3b') }}</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_170f350aa096') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.5</span>
<span class="font-body-sm text-body-sm text-outline">(11)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.one_size') }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 35.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Item 2 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img alt="{{ __('content.t_92d937d65e61') }}" class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" src="{{ asset('images/content/img_fa93b718f81461ee.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">{{ __('content.t_785f6dcaf07c') }}</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_df18a444def6') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.6</span>
<span class="font-body-sm text-body-sm text-outline">(193)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.one_size') }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 130.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Item 3 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img alt="{{ __('content.t_228c825ba8a1') }}" class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" src="{{ asset('images/content/img_0d65c90c90a4cac3.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">Caudalie</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_ae6d46a00a4e') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.6</span>
<span class="font-body-sm text-body-sm text-outline">(2,261)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.sizes_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 71.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Item 4 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-[#008751] text-white font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.clean_badge') }}</span>
<img class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" data-alt="{{ __('content.t_c261fce252e5') }}" src="{{ asset('images/content/img_075de8d9d539e71e.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">{{ __('content.t_289b65242e3b') }}</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.long_070146db67d8) }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.5</span>
<span class="font-body-sm text-body-sm text-outline">(100)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.sizes_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 60.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
</div>
</section>
<!-- 5. Clean Makeup Section -->
<section class="mb-16">
<div class="flex items-baseline justify-between border-b border-primary pb-3 mb-6">
<div class="flex items-center gap-3">
<h2 class="font-headline-md text-headline-md text-primary">{{ __('content.t_d63977332d61') }}</h2>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag text-on-surface-variant uppercase">{{ __('content.t_8c796254a302') }}</span>
</div>
<a class="font-label-caps text-label-caps uppercase underline underline-offset-4 hover:text-secondary transition-colors" href="/shop/skincare">
            {{ __('content.t_140c43afa05e') }}
          </a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
<!-- Makeup 1 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img alt="{{ __('content.t_c5c22aaf44fa') }}" class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" src="{{ asset('images/content/img_0ac071ffad051a87.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">{{ __('content.t_c810842051b6') }}</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_efb3b70e188b') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.2</span>
<span class="font-body-sm text-body-sm text-outline">(423)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.shades_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 65.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Makeup 2 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img alt="{{ __('content.t_96b4a1d6defa') }}" class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" src="{{ asset('images/content/img_5906b63ae9b02a83.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">TOWER 28</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_0ea375921187') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.5</span>
<span class="font-body-sm text-body-sm text-outline">(456)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.shades_count', ['count' => 7]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 85.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Makeup 3 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" data-alt="{{ __('content.t_9d6651595a4e') }}" src="{{ asset('images/content/img_2e0a236f76fa29c3.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">Kosas</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_7c1da0b6c27a') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.2</span>
<span class="font-body-sm text-body-sm text-outline">(874)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.shades_count', ['count' => 5]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 140.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Makeup 4 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" data-alt="{{ __('content.t_322f9d7e85f6') }}" src="{{ asset('images/content/img_6fc11dad299df6da.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">ILIA</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_7fabf45ee3ee') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.3</span>
<span class="font-body-sm text-body-sm text-outline">(13,673)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.shades_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 110.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
</div>
</section>
<!-- 6. Clean Haircare Section -->
<section class="mb-16">
<div class="flex items-baseline justify-between border-b border-primary pb-3 mb-6">
<div class="flex items-center gap-3">
<h2 class="font-headline-md text-headline-md text-primary">{{ __('content.t_fad62d533830') }}</h2>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag text-on-surface-variant uppercase">{{ __('content.t_6386d8401ef1') }}</span>
</div>
<a class="font-label-caps text-label-caps uppercase underline underline-offset-4 hover:text-secondary transition-colors" href="/shop/skincare">
            {{ __('content.t_140c43afa05e') }}
          </a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
<!-- Hair 1 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img alt="{{ __('content.t_21b1e9ce4bdd') }}" class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" src="{{ asset('images/content/img_f69ae8dfcb0a1e03.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">Gisou</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_b963d5ba4638') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.2</span>
<span class="font-body-sm text-body-sm text-outline">(410)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.sizes_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 115.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Hair 2 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" data-alt="{{ __('content.t_295534536689') }}" src="{{ asset('images/content/img_35110e8c9c1ede6c.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">Amika</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_b68f52a4f5c4') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.5</span>
<span class="font-body-sm text-body-sm text-outline">(1,306)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.sizes_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 135.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Hair 3 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-[#008751] text-white font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.clean_badge') }}</span>
<img class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" data-alt="{{ __('content.t_bbd9d4e72a51') }}" src="{{ asset('images/content/img_5877c69670320399.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">Aveda</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_0354097e27e0') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.7</span>
<span class="font-body-sm text-body-sm text-outline">(32)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.one_size') }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 150.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Hair 4 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" data-alt="{{ __('content.t_79fe5f98d4f5') }}" src="{{ asset('images/content/img_f6846622fa702a8a.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">{{ __('content.t_1dc451b71f65') }}</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_8e226eb7a12d') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.3</span>
<span class="font-body-sm text-body-sm text-outline">(420)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.sizes_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 70.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
</div>
</section>
<!-- 7. Clean Fragrance Section -->
<section class="mb-16">
<div class="flex items-baseline justify-between border-b border-primary pb-3 mb-6">
<div class="flex items-center gap-3">
<h2 class="font-headline-md text-headline-md text-primary">{{ __('content.t_012749c56b76') }}</h2>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag text-on-surface-variant uppercase">{{ __('content.t_841bb7671ccb') }}</span>
</div>
<a class="font-label-caps text-label-caps uppercase underline underline-offset-4 hover:text-secondary transition-colors" href="/shop/skincare">
            {{ __('content.t_140c43afa05e') }}
          </a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
<!-- Fragrance 1 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<div class="absolute top-3 left-3 flex flex-col gap-1">
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<span class="bg-surface-container-highest text-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.online_only') }}</span>
</div>
<img alt="{{ __('content.t_64f488415ab5') }}" class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" src="{{ asset('images/content/img_6a3f9451eba456cb.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">PHLUR</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_8544a9af5b2d') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">3.9</span>
<span class="font-body-sm text-body-sm text-outline">(413)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.sizes_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 155.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Fragrance 2 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" data-alt="{{ __('content.t_c5f364a86440') }}" src="{{ asset('images/content/img_193583fe1670d2f2.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">PHLUR</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_0dbc84f643b3') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.7</span>
<span class="font-body-sm text-body-sm text-outline">(582)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.one_size') }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 385.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Fragrance 3 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" data-alt="{{ __('content.t_12b0c23216c8') }}" src="{{ asset('images/content/img_f51babaa8138b90b.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">PHLUR</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_937a38eaeab4') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.4</span>
<span class="font-body-sm text-body-sm text-outline">(1,932)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.sizes_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 105.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
<!-- Fragrance 4 -->
<article class="group border border-outline-variant hover:border-primary transition-colors flex flex-col justify-between bg-surface-container-lowest">
<div class="relative p-4 flex flex-col items-center">
<span class="absolute top-3 left-3 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase">{{ __('ui.exclusive') }}</span>
<img class="w-full aspect-square object-contain transition-transform duration-300 group-hover:scale-105" data-alt="{{ __('content.t_50dc8e14d69e') }}" src="{{ asset('images/content/img_ea998308c005f3b8.jpg') }}"/>
</div>
<div class="p-4 border-t border-outline-variant flex flex-col flex-1 justify-between">
<div>
<span class="font-label-caps text-label-caps text-outline block uppercase mb-1">PHLUR</span>
<h3 class="font-title-md text-title-md text-primary font-bold line-clamp-2">{{ __('content.t_b722a020b766') }}</h3>
<div class="flex items-center gap-1.5 mt-2">
<div class="flex text-primary text-xs">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<span class="font-body-sm text-body-sm font-bold">4.1</span>
<span class="font-body-sm text-body-sm text-outline">(1,433)</span>
<span class="text-outline mx-1">•</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('ui.sizes_count', ['count' => 2]) }}</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-surface-container flex items-center justify-between">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 385.00</span>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-2 uppercase hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors">
                  {{ __('ui.add') }}
                </button>
</div>
</div>
</article>
</div>
</section>
<!-- 8. "What is Clean + Planet Aware At Sephora?" Informational Pillar Grid -->
<section class="border border-primary bg-surface-container-lowest p-8 md:p-12 mb-16">
<div class="text-center max-w-2xl mx-auto mb-12">
<span class="font-label-caps text-label-caps text-outline uppercase tracking-widest block mb-2">{{ __('content.t_9e1188e0f70d') }}</span>
<h2 class="font-headline-lg text-headline-lg text-primary">{{ __('content.t_e3d43818f474') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-2">
            {{ __('content.t_584d2dd44d6e') }}
          </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Pillar 1 -->
<div class="border border-outline-variant p-6 flex flex-col justify-between hover:border-primary transition-colors">
<div>
<div class="w-16 h-16 mb-4">
<img alt="{{ __('content.t_27c1d9f508fc') }}" class="w-full h-full object-contain" src="{{ asset('images/content/img_a01311f0e4ad8f4d.jpg') }}"/>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-primary mb-2">{{ __('content.t_55e31f606edb') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
                {{ __('content.t_c584b06e194e') }}
              </p>
</div>
<a class="font-label-caps text-label-caps uppercase underline underline-offset-4 text-primary hover:text-secondary font-bold inline-flex items-center gap-1" href="/shop/skincare">
              {{ __('content.t_140c43afa05e') }}
            </a>
</div>
<!-- Pillar 2 -->
<div class="border border-outline-variant p-6 flex flex-col justify-between hover:border-primary transition-colors">
<div>
<div class="w-16 h-16 mb-4">
<img alt="{{ __('content.t_09c2779e6fab') }}" class="w-full h-full object-contain" src="{{ asset('images/content/img_f55510eb9ee312ed.jpg') }}"/>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-primary mb-2">{{ __('content.t_97d58ad2139b') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
                {{ __('content.t_07420e88424e') }}
              </p>
</div>
<a class="font-label-caps text-label-caps uppercase underline underline-offset-4 text-primary hover:text-secondary font-bold inline-flex items-center gap-1" href="/shop/skincare">
              {{ __('content.t_140c43afa05e') }}
            </a>
</div>
<!-- Pillar 3 -->
<div class="border border-outline-variant p-6 flex flex-col justify-between hover:border-primary transition-colors">
<div>
<div class="w-16 h-16 mb-4">
<img alt="{{ __('content.t_2cab16c16152') }}" class="w-full h-full object-contain" src="{{ asset('images/content/img_4c436417accfce85.jpg') }}"/>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-primary mb-2">{{ __('content.t_d693d354f2b3') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
                {{ __('content.t_9ad9b1e50b50') }}
              </p>
</div>
<a class="font-label-caps text-label-caps uppercase underline underline-offset-4 text-primary hover:text-secondary font-bold inline-flex items-center gap-1" href="/shop/skincare">
              {{ __('content.t_140c43afa05e') }}
            </a>
</div>
</div>
</section>
<!-- 9. Brand Badges & Logos of Clean Partners -->
<section class="mb-16">
<div class="text-center mb-8">
<span class="font-label-caps text-label-caps text-outline uppercase tracking-widest block mb-2">{{ __('content.t_890f838a8495') }}</span>
<h2 class="font-headline-md text-headline-md text-primary">{{ __('content.t_b7a331e912a0') }}</h2>
</div>
<div class="grid grid-cols-3 sm:grid-cols-5 md:grid-cols-9 gap-3">
<a class="border border-outline-variant p-4 flex items-center justify-center text-center font-title-md text-title-md hover:border-primary hover:bg-surface-container transition-colors uppercase font-bold text-primary" href="/shop/skincare">
            Aveda
          </a>
<a class="border border-outline-variant p-4 flex items-center justify-center text-center font-title-md text-title-md hover:border-primary hover:bg-surface-container transition-colors uppercase font-bold text-primary" href="/shop/skincare">
            Caudalie
          </a>
<a class="border border-outline-variant p-4 flex items-center justify-center text-center font-title-md text-title-md hover:border-primary hover:bg-surface-container transition-colors uppercase font-bold text-primary text-xs" href="/shop/skincare">
            {{ __('content.t_785f6dcaf07c') }}
          </a>
<a class="border border-outline-variant p-4 flex items-center justify-center text-center font-title-md text-title-md hover:border-primary hover:bg-surface-container transition-colors uppercase font-bold text-primary" href="/shop/skincare">
            Gisou
          </a>
<a class="border border-outline-variant p-4 flex items-center justify-center text-center font-title-md text-title-md hover:border-primary hover:bg-surface-container transition-colors uppercase font-bold text-primary" href="/shop/skincare">
            Ilia
          </a>
<a class="border border-outline-variant p-4 flex items-center justify-center text-center font-title-md text-title-md hover:border-primary hover:bg-surface-container transition-colors uppercase font-bold text-primary" href="/shop/skincare">
            Kosas
          </a>
<a class="border border-outline-variant p-4 flex items-center justify-center text-center font-title-md text-title-md hover:border-primary hover:bg-surface-container transition-colors uppercase font-bold text-primary text-xs" href="/shop/skincare">
            {{ __('content.t_c810842051b6') }}
          </a>
<a class="border border-outline-variant p-4 flex items-center justify-center text-center font-title-md text-title-md hover:border-primary hover:bg-surface-container transition-colors uppercase font-bold text-primary text-xs" href="/shop/skincare">
            {{ __('content.t_62bb4dd0b19b') }}
          </a>
<a class="border border-outline-variant p-4 flex items-center justify-center text-center font-title-md text-title-md hover:border-primary hover:bg-surface-container transition-colors uppercase font-bold text-primary text-xs" href="/shop/skincare">
            {{ __('content.t_7a7d37cf4c8e') }}
          </a>
</div>
</section>
<!-- 10. Clean at Sephora FAQs Accordion -->
<section class="border border-primary p-8 md:p-12 mb-16 bg-surface-container-lowest">
<h2 class="font-headline-md text-headline-md text-primary mb-8 text-center">{{ __('ui.faq') }}</h2>
<div class="divide-y divide-outline-variant border-t border-b border-outline-variant max-w-3xl mx-auto">
<!-- FAQ 1 -->
<details class="group py-5 cursor-pointer">
<summary class="flex justify-between items-center font-title-lg text-title-lg font-bold text-primary list-none">
<span>{{ __('content.t_6cab49c07f38') }}</span>
<span class="material-symbols-outlined text-[20px] transition-transform group-open:rotate-180">expand_more</span>
</summary>
<div class="mt-4 text-on-surface-variant font-body-md text-body-md leading-relaxed pr-6">
              {{ __('content.t_2358390e1796') }}
            </div>
</details>
<!-- FAQ 2 -->
<details class="group py-5 cursor-pointer">
<summary class="flex justify-between items-center font-title-lg text-title-lg font-bold text-primary list-none">
<span>{{ __('content.t_bb910525ef9c') }}</span>
<span class="material-symbols-outlined text-[20px] transition-transform group-open:rotate-180">expand_more</span>
</summary>
<div class="mt-4 text-on-surface-variant font-body-md text-body-md leading-relaxed pr-6">
              {{ __('content.long_3b798058b7a1) }}
            </div>
</details>
<!-- FAQ 3 -->
<details class="group py-5 cursor-pointer">
<summary class="flex justify-between items-center font-title-lg text-title-lg font-bold text-primary list-none">
<span>{{ __('content.t_c910620b6783') }}</span>
<span class="material-symbols-outlined text-[20px] transition-transform group-open:rotate-180">expand_more</span>
</summary>
<div class="mt-4 text-on-surface-variant font-body-md text-body-md leading-relaxed pr-6">
              {{ __('content.long_c5af69c95921) }}
            </div>
</details>
</div>
</section>
<!-- 11. Sephora Official Trust Badges -->
<section class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-outline-variant border border-outline-variant mb-16 bg-surface-container-lowest">
<div class="p-6 text-center flex flex-col items-center">
<span class="material-symbols-outlined text-primary text-[32px] mb-2" data-icon="local_shipping">local_shipping</span>
<h3 class="font-title-md text-title-md font-bold text-primary uppercase mb-1">{{ __('ui.free_delivery') }}</h3>
<p class="font-body-sm text-body-sm text-outline">{{ __('content.t_5ae4fa42fde1') }}</p>
</div>
<div class="p-6 text-center flex flex-col items-center">
<span class="material-symbols-outlined text-primary text-[32px] mb-2" data-icon="verified">verified</span>
<h3 class="font-title-md text-title-md font-bold text-primary uppercase mb-1">{{ __('ui.authentic') }}</h3>
<p class="font-body-sm text-body-sm text-outline">{{ __('content.t_3056c4f6fd54') }}</p>
</div>
<div class="p-6 text-center flex flex-col items-center">
<span class="material-symbols-outlined text-primary text-[32px] mb-2" data-icon="assignment_return">assignment_return</span>
<h3 class="font-title-md text-title-md font-bold text-primary uppercase mb-1">{{ __('ui.easy_returns') }}</h3>
<p class="font-body-sm text-body-sm text-outline">{{ __('content.t_0c05e86a0a93') }}</p>
</div>
<div class="p-6 text-center flex flex-col items-center">
<span class="material-symbols-outlined text-primary text-[32px] mb-2" data-icon="support_agent">support_agent</span>
<h3 class="font-title-md text-title-md font-bold text-primary uppercase mb-1">{{ __('ui.customer_service') }}</h3>
<p class="font-body-sm text-body-sm text-outline">{{ __('content.t_3dd2ef504ac0') }}</p>
</div>
</section>
<!-- Newsletter Section -->
<section class="border border-primary bg-primary text-on-primary p-8 md:p-12 mb-16 text-center">
<div class="max-w-xl mx-auto">
<h2 class="font-headline-md text-headline-md mb-2">{{ __('content.t_518c2ee6743f') }}</h2>
<p class="font-body-sm text-body-sm text-outline-variant mb-6">
            {{ __('content.t_a14034955f3a') }}
          </p>
<form class="flex flex-col sm:flex-row gap-2" onsubmit="event.preventDefault()" data-newsletter-form>
<input class="w-full px-4 py-3 bg-surface-container-lowest text-primary text-body-sm font-body-sm rounded-none border border-outline-variant focus:outline-none focus:border-white" placeholder="{{ __('content.t_c09924a9f455') }}" type="email"/>
<button class="bg-surface-container-lowest text-primary font-label-caps text-label-caps uppercase px-8 py-3 whitespace-nowrap border border-white hover:bg-primary hover:text-white transition-colors duration-200" type="submit">
              {{ __('ui.subscribe') }}
            </button>
</form>
</div>
</section>
</div>
</main>
<!-- 12. Official Footer (Shared Component Footer) -->
@endsection
