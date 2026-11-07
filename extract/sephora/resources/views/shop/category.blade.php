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
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@section('head')
    <link rel="canonical" href="{{ route('shop.category', ['slug' => $category->slug]) }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SEPHORA UAE">
    <meta property="og:title" content="{{ $heroTitle }} | SEPHORA UAE">
    <meta property="og:description" content="{{ Str::limit(strip_tags($heroSubtitle ?: 'Shop ' . $category->name . ' at SEPHORA UAE. 100% authentic products with free delivery over AED 250.'), 200) }}">
    <meta property="og:url" content="{{ route('shop.category', ['slug' => $category->slug]) }}">
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
                ['@type' => 'ListItem', 'position' => 2, 'name' => $category->name, 'item' => route('shop.category', ['slug' => $category->slug])],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($breadcrumbJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endsection

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-on-surface-variant flex items-center flex-wrap gap-2 mb-6">
        <a class="hover:text-primary transition-colors" href="/">Home</a>
        <span class="text-outline-variant">/</span>
        <a class="hover:text-primary transition-colors" href="/shop/makeup">Shop</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-semibold">{{ $category->name }}</span>
    </nav>

    {{-- Category hero --}}
    <section class="relative mb-8 overflow-hidden border border-outline-variant bg-primary text-on-primary">
        @if ($category->hero_image)
            <img src="{{ media_url($category->hero_image) }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-40" loading="lazy">
        @endif
        <div class="relative px-6 py-10 md:px-10 md:py-14 max-w-3xl">
            <span class="font-label-caps text-label-caps uppercase tracking-[0.25em] text-on-primary/70 block mb-2">SEPHORA UAE</span>
            <h1 class="font-headline-md text-headline-md md:text-[40px] leading-tight font-bold uppercase mb-3">{{ $heroTitle }}</h1>
            @if ($heroSubtitle)
                <p class="font-body-md text-body-md text-on-primary/80 max-w-xl">{{ Str::limit(strip_tags($heroSubtitle), 220) }}</p>
            @endif
            <p class="font-body-sm text-body-sm text-on-primary/60 mt-4">{{ number_format($total) }} product{{ $total === 1 ? '' : 's' }}</p>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- Filters --}}
        <aside class="lg:col-span-3">
            <details open class="lg:block border border-outline-variant bg-surface-container-lowest">
                <summary class="lg:hidden cursor-pointer list-none flex items-center justify-between px-4 py-4 font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">
                    Filters
                    <span class="material-symbols-outlined text-[20px]">tune</span>
                </summary>

                <form method="GET" action="{{ route('shop.category', ['slug' => $category->slug]) }}" class="p-4 md:p-5 space-y-6">
                    @if (request()->filled('sort'))
                        <input type="hidden" name="sort" value="{{ $filters['sort'] }}">
                    @endif

                    <div>
                        <label for="filter-brand" class="block font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Brand</label>
                        <select id="filter-brand" name="brand" class="w-full h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary">
                            <option value="">All brands</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->slug }}" @selected($filters['brand'] === $brand->slug)>
                                    {{ $brand->name }} ({{ $brand->products_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <span class="block font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Price ({{ $currency }})</span>
                        <div class="flex items-center gap-2">
                            <label class="sr-only" for="filter-min-price">Minimum price</label>
                            <input id="filter-min-price" name="min_price" type="number" inputmode="numeric" min="0" max="{{ $maxBound }}"
                                   value="{{ $filters['min_price'] !== null ? (int) $filters['min_price'] : '' }}"
                                   placeholder="{{ $minBound }}"
                                   class="w-full h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary">
                            <span class="text-outline">–</span>
                            <label class="sr-only" for="filter-max-price">Maximum price</label>
                            <input id="filter-max-price" name="max_price" type="number" inputmode="numeric" min="0" max="{{ $maxBound }}"
                                   value="{{ $filters['max_price'] !== null ? (int) $filters['max_price'] : '' }}"
                                   placeholder="{{ $maxBound }}"
                                   class="w-full h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary">
                        </div>
                    </div>

                    <fieldset>
                        <legend class="block font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Refine</legend>
                        <div class="space-y-2.5">
                            <label class="flex items-center gap-2.5 cursor-pointer font-body-sm text-body-sm text-on-surface-variant">
                                <input type="checkbox" name="clean" value="1" @checked($filters['clean']) class="h-4 w-4 border-outline text-primary focus:ring-primary">
                                Clean beauty
                            </label>
                            <label class="flex items-center gap-2.5 cursor-pointer font-body-sm text-body-sm text-on-surface-variant">
                                <input type="checkbox" name="new" value="1" @checked($filters['new']) class="h-4 w-4 border-outline text-primary focus:ring-primary">
                                New arrivals
                            </label>
                            <label class="flex items-center gap-2.5 cursor-pointer font-body-sm text-body-sm text-on-surface-variant">
                                <input type="checkbox" name="in_stock" value="1" @checked($filters['in_stock']) class="h-4 w-4 border-outline text-primary focus:ring-primary">
                                In stock only
                            </label>
                        </div>
                    </fieldset>

                    <div>
                        <label for="filter-q" class="block font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Search in {{ $category->name }}</label>
                        <input id="filter-q" name="q" type="search" value="{{ $filters['q'] }}" placeholder="Product or brand"
                               class="w-full h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary">
                    </div>

                    <div class="flex flex-col gap-2 pt-2">
                        <button type="submit" class="h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all">
                            Apply filters
                        </button>
                        <a href="{{ route('shop.category', ['slug' => $category->slug]) }}"
                           class="h-11 flex items-center justify-center border border-outline-variant text-primary font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-all">
                            Clear all
                        </a>
                    </div>
                </form>
            </details>
        </aside>

        {{-- Results --}}
        <div class="lg:col-span-9">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Showing <strong class="text-primary">{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</strong>
                    of <strong class="text-primary">{{ number_format($total) }}</strong>
                    {{ Str::plural('product', $total) }}
                </p>

                <form method="GET" action="{{ route('shop.category', ['slug' => $category->slug]) }}" class="flex items-center gap-2">
                    @foreach (request()->except(['sort', 'page']) as $key => $value)
                        @if (is_scalar($value) && $value !== '')
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                    <label for="sort" class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant whitespace-nowrap">Sort by</label>
                    <select id="sort" name="sort" class="h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary" onchange="this.form.submit()">
                        @foreach ($sortOptions as $value => $label)
                            <option value="{{ $value }}" @selected($filters['sort'] === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <noscript>
                        <button type="submit" class="h-11 px-3 border border-primary text-primary font-label-caps text-label-caps uppercase">Go</button>
                    </noscript>
                </form>
            </div>

            @if ($activeFilters)
                <div class="flex flex-wrap items-center gap-2 mb-5">
                    @foreach ($activeFilters as $chip)
                        @php
                            $removeQuery = $chip['key'] === 'price'
                                ? ['min_price' => null, 'max_price' => null, 'page' => null]
                                : [$chip['key'] => null, 'page' => null];
                        @endphp
                        <a href="{{ request()->fullUrlWithQuery($removeQuery) }}"
                           class="inline-flex items-center gap-1.5 border border-outline-variant bg-surface-container-low px-3 py-1.5 font-body-sm text-body-sm text-primary hover:border-primary transition-colors">
                            {{ $chip['label'] }}
                            <span class="material-symbols-outlined text-[16px]">close</span>
                            <span class="sr-only">Remove filter</span>
                        </a>
                    @endforeach
                    <a href="{{ route('shop.category', ['slug' => $category->slug]) }}" class="font-body-sm text-body-sm text-secondary underline ml-1">Clear all</a>
                </div>
            @endif

            @if ($products->isEmpty())
                <div class="border border-outline-variant bg-surface-container-lowest text-center py-20 px-6">
                    <span class="material-symbols-outlined text-[40px] text-outline-variant">search_off</span>
                    <h2 class="font-headline-sm text-headline-sm text-primary mt-3 mb-2">No products match these filters</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-5">Try removing a filter or browsing the full category.</p>
                    <a href="{{ route('shop.category', ['slug' => $category->slug]) }}"
                       class="inline-block bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 py-3 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all">
                        Show all {{ $category->name }}
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                    @foreach ($products as $product)
                        @php
                            $hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
                            $inStock = (int) $product->stock > 0;
                        @endphp
                        <article class="group border border-outline-variant bg-surface-container-lowest flex flex-col">
                            <div class="relative">
                                <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="block" aria-label="View {{ $product->name }}">
                                    <div class="aspect-square bg-surface-bright flex items-center justify-center p-4 overflow-hidden">
                                        <img src="{{ media_url($product->first_image) }}" alt="{{ $product->name }}"
                                             class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300" loading="lazy">
                                    </div>
                                </a>

                                <div class="absolute top-2 left-2 flex flex-col gap-1 items-start">
                                    @if ($product->is_exclusive)
                                        <span class="bg-secondary text-on-secondary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">Exclusive</span>
                                    @endif
                                    @if ($product->is_new)
                                        <span class="bg-surface text-on-surface border border-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">New</span>
                                    @endif
                                    @if ($product->is_bestseller)
                                        <span class="bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">Best Seller</span>
                                    @endif
                                    @if ($product->badge)
                                        <span class="bg-surface-container-low text-primary border border-outline-variant font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">{{ $product->badge }}</span>
                                    @endif
                                    @if ($hasDiscount)
                                        <span class="bg-secondary-fixed text-on-secondary-fixed-variant font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider font-bold">Sale</span>
                                    @endif
                                </div>

                                <button type="button" data-wishlist-toggle="{{ $product->id }}"
                                        class="absolute top-2 right-2 w-9 h-9 flex items-center justify-center bg-surface-container-lowest/90 border border-outline-variant text-primary hover:border-primary transition-colors"
                                        aria-label="Add {{ $product->name }} to wishlist">
                                    <span class="material-symbols-outlined text-[20px]">favorite_border</span>
                                </button>
                            </div>

                            <div class="p-3 md:p-4 flex flex-col flex-1">
                                <span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant">{{ $product->brand?->name }}</span>
                                <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                   class="font-title-md text-body-sm font-bold text-primary leading-snug line-clamp-2 mt-0.5 hover:underline">
                                    {{ $product->name }}
                                </a>

                                <div class="flex items-center gap-1.5 mt-1.5">
                                    @include('components.stars-m3', ['rating' => (float) $product->rating])
                                    <span class="font-body-sm text-[12px] text-outline">({{ number_format((int) $product->reviews_count) }})</span>
                                </div>

                                <div class="mt-auto pt-3">
                                    <div class="flex flex-wrap items-baseline gap-2 mb-2.5">
                                        <span class="font-price-aed-md text-price-aed-md font-bold text-primary">{{ $currency }} {{ number_format($product->price, 2) }}</span>
                                        @if ($hasDiscount)
                                            <span class="font-body-sm text-[13px] line-through text-outline">{{ $currency }} {{ number_format($product->compare_at_price, 2) }}</span>
                                        @endif
                                    </div>

                                    <button type="button" data-add-to-bag="{{ $product->id }}" @disabled(! $inStock)
                                            class="w-full h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                        {{ $inStock ? 'Add to bag' : 'Sold out' }}
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($products->hasPages())
                    <nav aria-label="Pagination" class="mt-10 flex flex-wrap items-center justify-center gap-1.5">
                        @if ($products->onFirstPage())
                            <span class="h-10 px-3 flex items-center border border-outline-variant text-outline font-body-sm text-body-sm cursor-not-allowed" aria-disabled="true">
                                <span class="material-symbols-outlined text-[18px] mr-1">chevron_left</span> Previous
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" rel="prev"
                               class="h-10 px-3 flex items-center border border-outline-variant text-primary font-body-sm text-body-sm hover:border-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px] mr-1">chevron_left</span> Previous
                            </a>
                        @endif

                        @foreach ($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                            @if ($page === $products->currentPage())
                                <span aria-current="page" class="h-10 w-10 flex items-center justify-center bg-primary text-on-primary border border-primary font-body-sm text-body-sm font-bold">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="h-10 w-10 flex items-center justify-center border border-outline-variant text-primary font-body-sm text-body-sm hover:border-primary transition-colors">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" rel="next"
                               class="h-10 px-3 flex items-center border border-outline-variant text-primary font-body-sm text-body-sm hover:border-primary transition-colors">
                                Next <span class="material-symbols-outlined text-[18px] ml-1">chevron_right</span>
                            </a>
                        @else
                            <span class="h-10 px-3 flex items-center border border-outline-variant text-outline font-body-sm text-body-sm cursor-not-allowed" aria-disabled="true">
                                Next <span class="material-symbols-outlined text-[18px] ml-1">chevron_right</span>
                            </span>
                        @endif
                    </nav>
                @endif
            @endif
        </div>
    </div>
</main>
@endsection
