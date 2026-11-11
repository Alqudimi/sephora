@extends('layouts.app')

@section('title', __('meta.lips'))
@section('body_class', 'bg-background text-on-surface antialiased font-body-md selection:bg-primary selection:text-on-primary')

@section('content')
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- 3. Breadcrumbs & Category Header -->
<section class="mb-10">
<!-- Breadcrumbs -->
<nav aria-label="{{ __('ui.breadcrumb') }}" class="mb-5">
<ol class="flex items-center gap-2 font-body-sm text-body-sm text-outline">
<li><a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a></li>
<li><span>/</span></li>
<li><a class="hover:text-primary transition-colors" href="/shop/makeup">{{ __('ui.makeup') }}</a></li>
<li><span>/</span></li>
<li aria-current="page" class="text-primary font-semibold">{{ __('ui.lips') }}</li>
</ol>
</nav>
<!-- Category Title & Sorting Bar -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-outline-variant">
<div class="max-w-3xl">
<div class="flex items-baseline gap-3">
<h1 class="font-headline-lg text-headline-lg font-semibold tracking-tight text-primary">{{ __('ui.lips') }}</h1>
<span class="font-body-md text-body-md text-outline font-normal">({{ __('ui.items_count_label', ['count' => '344']) }})</span>
</div>
<p class="mt-3 font-body-md text-body-md text-on-surface-variant max-w-2xl leading-relaxed">
            {{ __('content.t_49789387c8eb') }}
          </p>
</div>
<!-- Sort dropdown -->
<div class="flex items-center justify-between md:justify-end gap-3 flex-shrink-0">
<label class="sr-only" for="sort-select">{{ __('content.t_a2a5bdeca939') }}</label>
<div class="relative inline-block">
<button class="flex items-center justify-between gap-3 px-4 py-2.5 bg-surface-container-lowest border border-primary text-primary font-label-caps text-label-caps uppercase hover:bg-surface-container-low transition-colors min-w-[200px]">
<span>{{ __('content.t_83282b82ceb8') }}</span>
<span class="material-symbols-outlined text-sm" data-icon="expand_more">expand_more</span>
</button>
</div>
</div>
</div>
</section>
<!-- Content Workspace: 2 Columns (Sidebar + Grid) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">
<!-- 4. Left Sidebar (Categories & Refine Filters) -->
<aside class="lg:col-span-3 space-y-6">
<!-- CATEGORIES Accordion -->
<div class="border border-outline-variant bg-surface-container-lowest p-5">
<div class="flex items-center justify-between pb-3 border-b border-outline-variant">
<h2 class="font-label-caps text-label-caps uppercase tracking-wider text-primary">{{ __('ui.categories') }}</h2>
<span class="material-symbols-outlined text-sm" data-icon="expand_less">expand_less</span>
</div>
<ul class="pt-3 space-y-2.5 font-body-sm text-body-sm">
<li class="flex items-center justify-between group cursor-pointer hover:text-primary">
<span class="text-on-surface-variant group-hover:text-primary transition-colors">{{ __('ui.lipsticks') }}</span>
<span class="text-outline text-xs">(120)</span>
</li>
<li class="flex items-center justify-between group cursor-pointer hover:text-primary">
<span class="text-on-surface-variant group-hover:text-primary transition-colors">{{ __('ui.gloss') }}</span>
<span class="text-outline text-xs">(95)</span>
</li>
<li class="flex items-center justify-between group cursor-pointer hover:text-primary">
<span class="text-on-surface-variant group-hover:text-primary transition-colors">{{ __('content.t_23a87f779eed') }}</span>
<span class="text-outline text-xs">(52)</span>
</li>
<li class="flex items-center justify-between group cursor-pointer hover:text-primary">
<span class="text-on-surface-variant group-hover:text-primary transition-colors">{{ __('content.t_fe7cd39ca306') }}</span>
<span class="text-outline text-xs">(46)</span>
</li>
<li class="flex items-center justify-between group cursor-pointer hover:text-primary">
<span class="text-on-surface-variant group-hover:text-primary transition-colors">Plumpers</span>
<span class="text-outline text-xs">(38)</span>
</li>
<li class="flex items-center justify-between group cursor-pointer hover:text-primary">
<span class="text-on-surface-variant group-hover:text-primary transition-colors">{{ __('content.t_cec504f5bda9') }}</span>
<span class="text-outline text-xs">(64)</span>
</li>
<li class="flex items-center justify-between group cursor-pointer hover:text-primary">
<span class="text-on-surface-variant group-hover:text-primary transition-colors">{{ __('content.t_eb697cf4af76') }}</span>
<span class="text-outline text-xs">(28)</span>
</li>
</ul>
</div>
<!-- REFINE SECTION -->
<div class="border border-outline-variant bg-surface-container-lowest p-5 space-y-5">
<div class="flex items-center justify-between pb-3 border-b border-outline-variant">
<h2 class="font-label-caps text-label-caps uppercase tracking-wider text-primary">{{ __('ui.refine') }}</h2>
<button class="font-label-caps text-label-caps text-outline hover:text-primary underline uppercase transition-colors">{{ __('content.t_00c6d526e85f') }}</button>
</div>
<!-- Sephora Exclusive Only Toggle -->
<div class="flex items-center justify-between py-2 border-b border-outline-variant">
<span class="font-body-sm text-body-sm font-semibold text-primary">{{ __('content.t_a283183b6457') }}</span>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox"/>
<div class="w-9 h-5 bg-outline-variant peer-checked:bg-primary transition-colors rounded-none after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
</label>
</div>
<!-- BRAND Accordion -->
<div class="space-y-3">
<div class="flex items-center justify-between">
<h3 class="font-label-caps text-label-caps uppercase tracking-wider text-primary">{{ __('ui.brand_caps') }}</h3>
<span class="material-symbols-outlined text-sm" data-icon="expand_less">expand_less</span>
</div>
<!-- Brand Search Input -->
<div class="relative">
<span class="material-symbols-outlined absolute left-2.5 top-2 text-outline text-base" data-icon="search">search</span>
<input class="w-full bg-surface-container-low pl-8 pr-3 py-1.5 border border-outline-variant font-body-sm text-body-sm focus:border-primary focus:ring-0 rounded-none" placeholder="{{ __('content.t_5c1d91f3c2a3') }}" type="text"/>
</div>
<!-- Checkbox List -->
<div class="max-h-52 overflow-y-auto space-y-2.5 pt-2 custom-scrollbar">
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface cursor-pointer select-none">
<input checked="" class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1 font-semibold">{{ __('content.t_289b65242e3b') }}</span>
<span class="text-outline text-xs">(48)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface cursor-pointer select-none">
<input checked="" class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1 font-semibold">{{ __('content.t_b003ed5119d2') }}</span>
<span class="text-outline text-xs">(32)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface cursor-pointer select-none">
<input checked="" class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1 font-semibold">{{ __('content.t_4b74143abede') }}</span>
<span class="text-outline text-xs">(15)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface cursor-pointer select-none">
<input checked="" class="w-4 h-4 rounded-none border-primary text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1 font-semibold">{{ __('content.t_be9af4115635') }}</span>
<span class="text-outline text-xs">(24)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface-variant cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1">{{ __('content.t_71c3847062d5') }}</span>
<span class="text-outline text-xs">(18)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface-variant cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1">Saie</span>
<span class="text-outline text-xs">(12)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface-variant cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1">Tarte</span>
<span class="text-outline text-xs">(22)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface-variant cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1">Tower 28</span>
<span class="text-outline text-xs">(14)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface-variant cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1">Dior</span>
<span class="text-outline text-xs">(26)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface-variant cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1">e.l.f. Cosmetics</span>
<span class="text-outline text-xs">(19)</span>
</label>
<label class="flex items-center gap-2.5 font-body-sm text-body-sm text-on-surface-variant cursor-pointer select-none">
<input class="w-4 h-4 rounded-none border-outline text-primary focus:ring-0" type="checkbox"/>
<span class="flex-1">Kosas</span>
<span class="text-outline text-xs">(16)</span>
</label>
</div>
</div>
<!-- Additional Filter Accordions -->
<div class="border-t border-outline-variant pt-3 space-y-4">
<div class="flex items-center justify-between cursor-pointer py-1 group">
<span class="font-label-caps text-label-caps uppercase text-primary group-hover:text-secondary">{{ __('ui.finish') }}</span>
<span class="material-symbols-outlined text-sm text-outline group-hover:text-primary" data-icon="add">add</span>
</div>
<div class="flex items-center justify-between cursor-pointer py-1 group">
<span class="font-label-caps text-label-caps uppercase text-primary group-hover:text-secondary">{{ __('ui.formulation') }}</span>
<span class="material-symbols-outlined text-sm text-outline group-hover:text-primary" data-icon="add">add</span>
</div>
<div class="flex items-center justify-between cursor-pointer py-1 group">
<span class="font-label-caps text-label-caps uppercase text-primary group-hover:text-secondary">{{ __('content.t_25483ea2e0ad') }}</span>
<span class="material-symbols-outlined text-sm text-outline group-hover:text-primary" data-icon="add">add</span>
</div>
<div class="flex items-center justify-between cursor-pointer py-1 group">
<span class="font-label-caps text-label-caps uppercase text-primary group-hover:text-secondary">{{ __('content.t_f5b80c02f41a') }}</span>
<span class="material-symbols-outlined text-sm text-outline group-hover:text-primary" data-icon="add">add</span>
</div>
</div>
</div>
</aside>
<!-- 5. Product Grid (4 Columns on Desktop, Hairline Precision) -->
<section class="lg:col-span-9" id="shop">
<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-5">
<!-- Product 1 -->
@foreach($products as $products)
<article onclick="window.location='/p/{{ $products->slug }}'" class="group bg-surface-container-lowest border border-outline-variant hover:border-primary transition-all duration-200 flex flex-col justify-between p-3 relative">
<div>
<div class="flex flex-wrap gap-1 mb-2">
@if($products->badge)
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-1.5 py-0.5 tracking-wider uppercase">{{ $products->badge }}</span>
@endif

</div>
<button aria-label="{{ __('content.t_a44253758df5') }}" class="absolute top-3 right-3 text-outline hover:text-secondary p-1 z-10">
<span class="material-symbols-outlined text-lg" data-icon="favorite">favorite</span>
</button>
<div class="aspect-square w-full overflow-hidden flex items-center justify-center mb-3 bg-surface-container-lowest">
<img class="object-contain w-full h-full group-hover:scale-105 transition-transform duration-300" data-alt="{{ $products->name }}" src="{{ media_url($products->first_image) }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"/>
</div>
<p class="font-label-caps text-[10px] tracking-widest uppercase text-outline">{{ $products->brand->name }}
<h3 class="font-body-md text-body-md font-bold text-primary mt-1 line-clamp-2">{{ $products->name }}</h3>
<div class="flex items-center gap-1.5 mt-1.5">
<span class="text-amber-500 text-xs">@include('components.stars', ['rating' => $products->rating])</span>
<span class="font-body-sm text-body-sm font-semibold text-primary">{{ $products->rating }}</span>
<span class="font-body-sm text-body-sm text-outline">({{ number_format($products->reviews_count) }})</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-outline-variant">
<p class="font-price-aed-lg text-price-aed-lg font-bold text-primary mb-3">AED {{ number_format($products->price, 2) }}</p>
<button class="w-full bg-primary text-on-primary font-label-caps text-label-caps py-2.5 uppercase tracking-widest hover:bg-surface-container-lowest hover:border hover:border-primary hover:text-primary transition-all" data-add-to-bag="{{ $products->id }}">{{ __('content.t_ea34a3a7ca7b') }}</button>
</div>
</article>
@endforeach
</div>
<!-- Grid Pagination / Counter -->
<div class="mt-12 pt-8 border-t border-outline-variant text-center max-w-md mx-auto">
<p class="font-label-caps text-label-caps uppercase text-outline tracking-wider mb-2">{{ __('content.t_f7990702e641') }}</p>
<div class="w-full bg-surface-container h-1 mb-6">
<div class="bg-primary h-1" style="width: 4.65%;"></div>
</div>
<button class="w-full md:w-auto px-10 py-3 bg-surface-container-lowest border border-primary text-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary hover:text-on-primary transition-all">
            {{ __('content.t_ff6255edd8b2') }}
          </button>
</div>
</section>
</div>
<!-- 6. Trust Badges Section -->
<section class="mt-20 py-10 border-y border-outline-variant">
<div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
<!-- Badge 1 -->
<div class="space-y-2">
<span class="material-symbols-outlined text-2xl text-primary" data-icon="local_shipping">local_shipping</span>
<h4 class="font-label-caps text-label-caps uppercase font-bold text-primary">{{ __('ui.free_delivery') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_108ddab01fe7') }}</p>
</div>
<!-- Badge 2 -->
<div class="space-y-2">
<span class="material-symbols-outlined text-2xl text-primary" data-icon="verified">verified</span>
<h4 class="font-label-caps text-label-caps uppercase font-bold text-primary">{{ __('ui.authentic') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_4cc34ac8bd87') }}</p>
</div>
<!-- Badge 3 -->
<div class="space-y-2">
<span class="material-symbols-outlined text-2xl text-primary" data-icon="cached">cached</span>
<h4 class="font-label-caps text-label-caps uppercase font-bold text-primary">{{ __('ui.easy_returns') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_0bdb7910318d') }}</p>
</div>
<!-- Badge 4 -->
<div class="space-y-2">
<span class="material-symbols-outlined text-2xl text-primary" data-icon="loyalty">loyalty</span>
<h4 class="font-label-caps text-label-caps uppercase font-bold text-primary">{{ __('ui.beauty_pass_points') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_c5bdd6223bae') }}</p>
</div>
</div>
</section>
<!-- 7. Newsletter Subscription Banner -->
<section class="mt-14 p-8 md:p-12 bg-surface-container-low border border-outline-variant text-center max-w-4xl mx-auto">
<h3 class="font-display-hero text-headline-sm uppercase tracking-widest font-bold text-primary">{{ __('ui.stay_connected') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-lg mx-auto">
        {{ __('content.t_d39eb1fbef6c') }}
      </p>
<form class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-2 max-w-md mx-auto" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="w-full bg-surface-container-lowest px-4 py-3 border border-outline-variant text-on-surface font-body-sm text-body-sm focus:border-primary focus:ring-0 rounded-none" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="w-full sm:w-auto px-8 py-3 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all whitespace-nowrap" type="submit">
          {{ __('content.t_1e0c8c669c5f') }}
        </button>
</form>
</section>
</main>
@endsection
