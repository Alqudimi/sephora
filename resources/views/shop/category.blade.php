@extends('layouts.app')

@php
    $currency = config('commerce.currency', 'AED');
    $total = $products->total();
    $heroTitle = $category->hero_title ?: $category->name;
    $heroSubtitle = $category->hero_subtitle ?: $category->description;
    $minBound = (int) floor((float) ($priceBounds->min_price ?? 0));
    $maxBound = (int) ceil((float) ($priceBounds->max_price ?? 0));

    $activeFilters = [];
    if ($filters['brand']) {
        $brandName = optional($brands->firstWhere('slug', $filters['brand']))->name ?: $filters['brand'];
        $activeFilters[] = ['label' => $brandName, 'key' => 'brand'];
    }
    if ($filters['min_price'] !== null || $filters['max_price'] !== null) {
        $activeFilters[] = [
            'label' => 'Price ' . ($filters['min_price'] !== null ? $currency . ' ' . number_format($filters['min_price'], 0) : '0')
                . ' – ' . ($filters['max_price'] !== null ? $currency . ' ' . number_format($filters['max_price'], 0) : 'any'),
            'key' => 'price',
        ];
    }
    if ($filters['clean']) {
        $activeFilters[] = ['label' => 'Clean beauty', 'key' => 'clean'];
    }
    if ($filters['new']) {
        $activeFilters[] = ['label' => 'New arrivals', 'key' => 'new'];
    }
    if ($filters['in_stock']) {
        $activeFilters[] = ['label' => 'In stock', 'key' => 'in_stock'];
    }
    if ($filters['q']) {
        $activeFilters[] = ['label' => 'Search: “' . $filters['q'] . '”', 'key' => 'q'];
    }
@endphp

@section('title', $heroTitle . ' | SEPHORA UAE')
@section('meta_description', Str::limit(strip_tags($heroSubtitle ?: 'Shop ' . $category->name . ' at SEPHORA UAE. 100% authentic products with free delivery over AED 250.'), 155))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@php
    $canonicalUrl = $category->slug === 'all' ? route('shop.all') : route('shop.category', ['slug' => $category->slug]);
@endphp

@section('head')
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SEPHORA UAE">
    <meta property="og:title" content="{{ $heroTitle }} | SEPHORA UAE">
    <meta property="og:description" content="{{ Str::limit(strip_tags($heroSubtitle ?: 'Shop ' . $category->name . ' at SEPHORA UAE. 100% authentic products with free delivery over AED 250.'), 200) }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $category->hero_image ? media_url($category->hero_image) : asset('images/placeholder.webp') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $heroTitle }} | SEPHORA UAE">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($heroSubtitle ?: 'Shop ' . $category->name . ' at SEPHORA UAE. 100% authentic products with free delivery over AED 250.'), 200) }}">
    <meta name="twitter:image" content="{{ $category->hero_image ? media_url($category->hero_image) : asset('images/placeholder.webp') }}">
    @php
        $breadcrumbJson = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $category->name, 'item' => $canonicalUrl],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($breadcrumbJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endsection

@section('content')
<main class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-4 sm:py-6">

    <!-- Breadcrumb -->
    <nav aria-label="{{ __('ui.breadcrumb') }}" class="text-xs text-neutral-500 flex items-center flex-wrap gap-2 mb-4 sm:mb-6">
        <a class="hover:text-black transition-colors" href="/">{{ __('ui.home') }}</a>
        <span>/</span>
        @if ($category->slug !== 'all')
            <a class="hover:text-black transition-colors" href="{{ route('shop.all') }}">{{ __('ui.shop') }}</a>
            <span>/</span>
        @endif
        <span class="text-black font-semibold">{{ $category->name }}</span>
    </nav>

    <!-- Category Header -->
    <section class="border-b border-gray-200 pb-5 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-2">
            <div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold uppercase tracking-tight text-black">
                    {{ $heroTitle }}
                </h1>
                @if ($heroSubtitle)
                    <p class="text-xs sm:text-sm text-neutral-600 mt-1 max-w-2xl">{{ Str::limit(strip_tags($heroSubtitle), 220) }}</p>
                @endif
            </div>
            <span class="text-xs sm:text-sm text-neutral-500 font-medium shrink-0">
                {{ number_format($total) }} {{ Str::plural('product', $total) }}
            </span>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">

        <!-- Filters Sidebar -->
        <aside class="lg:col-span-3">
            <details open class="lg:block border border-gray-200 rounded-sm bg-white p-4">
                <summary class="lg:hidden cursor-pointer list-none flex items-center justify-between font-bold text-xs uppercase tracking-wider text-black pb-2 border-b border-gray-200 mb-4">
                    <span>{{ __('ui.filters_label') }}</span>
                    <span class="text-xs underline">{{ __('ui.toggle_label') }}</span>
                </summary>

                <form method="GET" action="{{ route('shop.category', ['slug' => $category->slug]) }}" class="space-y-6">
                    @if (request()->filled('sort'))
                        <input type="hidden" name="sort" value="{{ $filters['sort'] }}">
                    @endif

                    <!-- Brand Filter -->
                    <div>
                        <label for="filter-brand" class="block text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('ui.brand') }}</label>
                        <select id="filter-brand" name="brand" class="w-full h-10 border border-gray-300 rounded-sm bg-white px-3 text-xs text-black focus:outline-none focus:border-black">
                            <option value="">{{ __('content.t_1a8970fe81ac') }}</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->slug }}" @selected($filters['brand'] === $brand->slug)>
                                    {{ $brand->name }} ({{ $brand->products_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Filter -->
                    <div>
                        <span class="block text-xs font-bold uppercase tracking-wider text-black mb-2">Price ({{ $currency }})</span>
                        <div class="flex items-center gap-2">
                            <label class="sr-only" for="filter-min-price">{{ __('content.t_2e56b2d2622d') }}</label>
                            <input id="filter-min-price" name="min_price" type="number" inputmode="numeric" min="0" max="{{ $maxBound }}"
                                   value="{{ $filters['min_price'] !== null ? (int) $filters['min_price'] : '' }}"
                                   placeholder="{{ $minBound }}"
                                   class="w-full h-10 border border-gray-300 rounded-sm px-3 text-xs text-black focus:outline-none focus:border-black">
                            <span class="text-gray-400">–</span>
                            <label class="sr-only" for="filter-max-price">{{ __('content.t_20c2e7a42c6f') }}</label>
                            <input id="filter-max-price" name="max_price" type="number" inputmode="numeric" min="0" max="{{ $maxBound }}"
                                   value="{{ $filters['max_price'] !== null ? (int) $filters['max_price'] : '' }}"
                                   placeholder="{{ $maxBound }}"
                                   class="w-full h-10 border border-gray-300 rounded-sm px-3 text-xs text-black focus:outline-none focus:border-black">
                        </div>
                    </div>

                    <!-- Quick Checkbox Refinements -->
                    <fieldset>
                        <legend class="block text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('ui.refine') }}</legend>
                        <div class="space-y-2.5 text-xs text-neutral-700">
                            <label class="flex items-center gap-2.5 cursor-pointer hover:text-black">
                                <input type="checkbox" name="clean" value="1" @checked($filters['clean']) class="rounded-sm border-gray-300 text-black focus:ring-black">
                                {{ __('content.t_d3c0f8404f3f') }}
                            </label>
                            <label class="flex items-center gap-2.5 cursor-pointer hover:text-black">
                                <input type="checkbox" name="new" value="1" @checked($filters['new']) class="rounded-sm border-gray-300 text-black focus:ring-black">{{ __('ui.new_arrivals') }}</label>
                            <label class="flex items-center gap-2.5 cursor-pointer hover:text-black">
                                <input type="checkbox" name="in_stock" value="1" @checked($filters['in_stock']) class="rounded-sm border-gray-300 text-black focus:ring-black">
                                {{ __('content.t_31540ffd976f') }}
                            </label>
                        </div>
                    </fieldset>

                    <!-- Search Filter -->
                    <div>
                        <label for="filter-q" class="block text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('ui.keyword_label') }}</label>
                        <input id="filter-q" name="q" type="search" value="{{ $filters['q'] }}" placeholder="{{ __('content.t_b73f756bef16') }}"
                               class="w-full h-10 border border-gray-300 rounded-sm px-3 text-xs text-black focus:outline-none focus:border-black">
                    </div>

                    <!-- Submit & Reset -->
                    <div class="flex flex-col gap-2 pt-2">
                        <button type="submit" class="h-10 bg-black text-white text-xs font-bold uppercase tracking-wider rounded-sm hover:bg-neutral-800 transition-colors">
                            {{ __('content.t_6b2a78a8f716') }}
                        </button>
                        <a href="{{ route('shop.category', ['slug' => $category->slug]) }}"
                           class="h-10 flex items-center justify-center border border-gray-300 rounded-sm text-black text-xs font-bold uppercase tracking-wider hover:border-black transition-colors">{{ __('ui.clear_all') }}</a>
                    </div>
                </form>
            </details>
        </aside>

        <!-- Product Grid & Sorting -->
        <div class="lg:col-span-9">

            <!-- Sorting & Count Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5 pb-3 border-b border-gray-200">
                <p class="text-xs text-neutral-600">
                    {{ __('ui.showing') }} <strong class="text-black">{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</strong>
                    {{ __('ui.of') }} <strong class="text-black">{{ number_format($total) }}</strong>
                    {{ Str::plural('product', $total) }}
                </p>

                <form method="GET" action="{{ route('shop.category', ['slug' => $category->slug]) }}" class="flex items-center gap-2">
                    @foreach (request()->except(['sort', 'page']) as $key => $value)
                        @if (is_scalar($value) && $value !== '')
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                    <label for="sort" class="text-xs font-bold uppercase tracking-wider text-neutral-600 whitespace-nowrap">{{ __('ui.sort_by') }}</label>
                    <select id="sort" name="sort" class="h-9 border border-gray-300 rounded-sm bg-white px-3 text-xs text-black focus:outline-none focus:border-black" onchange="this.form.submit()">
                        @foreach ($sortOptions as $value => $label)
                            <option value="{{ $value }}" @selected($filters['sort'] === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Active Filter Chips -->
            @if ($activeFilters)
                <div class="flex flex-wrap items-center gap-2 mb-5">
                    @foreach ($activeFilters as $chip)
                        @php
                            $removeQuery = $chip['key'] === 'price'
                                ? ['min_price' => null, 'max_price' => null, 'page' => null]
                                : [$chip['key'] => null, 'page' => null];
                        @endphp
                        <a href="{{ request()->fullUrlWithQuery($removeQuery) }}"
                           class="inline-flex items-center gap-1.5 border border-gray-300 bg-gray-50 px-2.5 py-1 text-xs text-black hover:border-black rounded-sm transition-colors">
                            <span>{{ $chip['label'] }}</span>
                            <span class="text-gray-400 hover:text-black font-bold">&times;</span>
                        </a>
                    @endforeach
                    <a href="{{ route('shop.category', ['slug' => $category->slug]) }}" class="text-xs font-bold text-black underline ml-1">{{ __('content.t_c043160a89ba') }}</a>
                </div>
            @endif

            <!-- Product Cards -->
            @if ($products->isEmpty())
                <div class="border border-gray-200 rounded-sm bg-white text-center py-20 px-6">
                    <h3 class="text-lg font-bold text-black mb-2">{{ __('ui.no_products_filters') }}</h3>
                    <p class="text-xs text-neutral-500 mb-5">{{ __('content.t_5964ae3c15c1') }}</p>
                    <a href="{{ route('shop.category', ['slug' => $category->slug]) }}"
                       class="inline-block bg-black text-white text-xs font-bold uppercase tracking-wider px-6 py-2.5 rounded-sm hover:bg-neutral-800 transition-colors">
                        Show all {{ $category->name }}
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 md:gap-5">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                @if ($products->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $products->links() }}
                    </div>
                @endif
            @endif

        </div>

    </div>

</main>
@endsection
