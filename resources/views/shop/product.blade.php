@extends('layouts.app')

@php
    $images = $product->images;
    $primaryCategory = $product->categories->first();
    $stock = (int) $product->stock;
    $maxQty = max(1, min($stock, (int) config('commerce.max_quantity_per_item', 20)));
    $rating = (float) ($product->rating > 0 ? $product->rating : ($product->reviews->avg('rating') ?? 0));
    $reviewCount = max((int) $product->reviews_count, $product->reviews->count());
    $hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
    $currency = config('commerce.currency', 'AED');
    $mainImage = $images->first()?->path ?? 'images/placeholder.webp';
    $productUrl = route('product.show', ['slug' => $product->slug]);

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product->name,
        'image' => $images->pluck('path')->map(fn ($path) => media_url($path))->values()->all(),
        'description' => Str::limit(strip_tags((string) $product->description), 500),
        'sku' => $product->sku,
        'brand' => ['@type' => 'Brand', 'name' => $product->brand?->name],
        'offers' => [
            '@type' => 'Offer',
            'url' => $productUrl,
            'priceCurrency' => $currency,
            'price' => number_format((float) $product->price, 2, '.', ''),
            'availability' => $stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            'itemCondition' => 'https://schema.org/NewCondition',
        ],
    ];

    if ($reviewCount > 0 && $rating > 0) {
        $schema['aggregateRating'] = [
            '@type' => 'AggregateRating',
            'ratingValue' => round($rating, 1),
            'reviewCount' => $reviewCount,
        ];
    }
@endphp

@section('title', ($product->meta_title ?: $product->name . ' | ' . ($product->brand?->name ?? 'SEPHORA')) . ' | SEPHORA UAE')
@section('meta_description', Str::limit(strip_tags($product->meta_description ?: ($product->description ?: 'Shop ' . $product->name . ' at SEPHORA UAE. 100% authentic products with free delivery over AED 250.')), 155))
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@section('head')
    <link rel="canonical" href="{{ $productUrl }}">
    <meta property="og:type" content="product">
    <meta property="og:site_name" content="SEPHORA UAE">
    <meta property="og:title" content="{{ $product->meta_title ?: $product->name }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags((string) $product->description), 200) }}">
    <meta property="og:image" content="{{ media_url($mainImage) }}">
    <meta property="og:url" content="{{ $productUrl }}">
    <meta name="twitter:card" content="summary_large_image">
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endsection

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-on-surface-variant flex items-center flex-wrap gap-2 mb-6">
        <a class="hover:text-primary transition-colors" href="/">Home</a>
        <span class="text-outline-variant">/</span>
        @if ($primaryCategory)
            <a class="hover:text-primary transition-colors" href="{{ route('shop.category', ['slug' => $primaryCategory->slug]) }}">{{ $primaryCategory->name }}</a>
            <span class="text-outline-variant">/</span>
        @endif
        @if ($product->brand)
            <a class="hover:text-primary transition-colors" href="{{ route('brands.show', ['slug' => $product->brand->slug]) }}">{{ $product->brand->name }}</a>
            <span class="text-outline-variant">/</span>
        @endif
        <span class="text-primary font-semibold truncate max-w-xs md:max-w-none">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 pb-12 border-b border-outline-variant">

        {{-- Gallery --}}
        <div class="lg:col-span-7 flex flex-col gap-4">
            <div class="flex flex-col-reverse md:flex-row gap-3">
                <div class="flex md:flex-col gap-3 overflow-x-auto md:overflow-visible pb-1 md:pb-0 shrink-0" role="list" aria-label="Product images">
                    @forelse ($images->take(6) as $image)
                        <button type="button"
                                data-pdp-thumb
                                data-image="{{ media_url($image->path) }}"
                                data-alt="{{ $image->alt ?: $product->name }}"
                                class="w-20 h-20 shrink-0 border {{ $loop->first ? 'border-2 border-primary' : 'border-outline-variant' }} bg-surface-container-lowest p-1 hover:border-primary transition-all"
                                aria-label="View image {{ $loop->iteration }}">
                            <img src="{{ media_url($image->path) }}" alt="{{ $image->alt ?: $product->name }}" class="w-full h-full object-cover" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                        </button>
                    @empty
                        <span class="w-20 h-20 shrink-0 border border-outline-variant bg-surface-container-lowest p-1">
                            <img src="{{ media_url($mainImage) }}" alt="{{ $product->name }}" class="w-full h-full object-contain" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                        </span>
                    @endforelse
                </div>

                <div class="relative flex-1 border border-outline-variant bg-surface-container-lowest overflow-hidden group">
                    <div class="absolute top-4 left-4 z-10 flex flex-col gap-1.5 items-start">
                        @if ($product->is_exclusive)
                            <span class="bg-secondary text-on-secondary font-label-caps text-label-caps px-2.5 py-1 tracking-wider uppercase">Exclusive</span>
                        @endif
                        @if ($product->is_new)
                            <span class="bg-surface text-on-surface border border-primary font-label-caps text-label-caps px-2 py-0.5 tracking-wider uppercase">New</span>
                        @endif
                        @if ($product->is_bestseller)
                            <span class="bg-primary text-on-primary font-label-caps text-label-caps px-2.5 py-1 tracking-wider uppercase">Best Seller</span>
                        @endif
                        @if ($product->badge)
                            <span class="bg-surface-container-low text-primary border border-outline-variant font-label-caps text-label-caps px-2 py-0.5 tracking-wider uppercase">{{ $product->badge }}</span>
                        @endif
                        @if ($hasDiscount)
                            <span class="bg-secondary-fixed text-on-secondary-fixed-variant font-label-tag text-label-tag px-2 py-0.5 tracking-wider uppercase font-bold">
                                Save {{ $currency }} {{ number_format($product->compare_at_price - $product->price, 0) }}
                            </span>
                        @endif
                    </div>

                    <div class="aspect-square w-full flex items-center justify-center p-6 bg-surface-bright">
                        <img id="pdp-main-image"
                             src="{{ media_url($mainImage) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-105"
                             onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                    </div>

                    <div class="hidden sm:flex absolute bottom-4 right-4 bg-surface-container-lowest/90 px-2.5 py-1.5 border border-outline-variant text-on-surface-variant font-label-caps text-label-caps items-center gap-1.5 pointer-events-none">
                        <span class="material-symbols-outlined text-[16px]">zoom_in</span>
                        <span>Hover to zoom</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Purchase column --}}
        <div class="lg:col-span-5 flex flex-col">
            @if ($product->brand)
                <a class="font-label-caps text-label-caps tracking-widest uppercase text-on-surface-variant hover:text-primary transition-colors underline decoration-1 underline-offset-4 mb-2"
                   href="{{ route('brands.show', ['slug' => $product->brand->slug]) }}">
                    {{ $product->brand->name }}
                </a>
            @endif

            <h1 class="font-headline-md text-headline-md text-primary mb-3">{{ $product->name }}</h1>

            <div class="flex flex-wrap items-center gap-3 pb-4 mb-5 border-b border-outline-variant">
                <div class="flex items-center text-primary">
                    @include('components.stars', ['rating' => $rating])
                    <span class="font-bold text-sm ml-1.5">{{ number_format($rating, 1) }}</span>
                </div>
                <span class="text-outline-variant">|</span>
                <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary underline" href="#reviews">
                    {{ number_format($reviewCount) }} review{{ $reviewCount === 1 ? '' : 's' }}
                </a>
                <span class="text-outline-variant">|</span>
                <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary underline" href="#write-review">Write a review</a>
            </div>

            <div class="mb-5">
                <div class="flex flex-wrap items-baseline gap-3">
                    <span class="font-price-aed-lg text-price-aed-lg text-primary">{{ $currency }} {{ number_format($product->price, 2) }}</span>
                    @if ($hasDiscount)
                        <span class="font-body-md text-body-md line-through text-outline">{{ $currency }} {{ number_format($product->compare_at_price, 2) }}</span>
                    @endif
                </div>
                @if ($product->size || $product->sku)
                    <p class="font-body-sm text-body-sm text-outline mt-1">
                        {{ $product->size }}
                        @if ($product->size && $product->sku) · @endif
                        @if ($product->sku) SKU: {{ $product->sku }} @endif
                    </p>
                @endif
            </div>

            @if ($product->description)
                <p class="font-body-md text-body-md text-on-surface-variant mb-6">{{ Str::limit(strip_tags($product->description), 220) }}</p>
            @endif

            @if ($product->shades->isNotEmpty())
                <div class="mb-5">
                    <span class="block font-label-caps text-label-caps uppercase text-on-surface mb-2">Shade</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($product->shades as $shade)
                            <label class="cursor-pointer">
                                <input type="radio" name="shade" value="{{ $shade->name }}" class="peer sr-only" @checked($loop->first)>
                                <span class="flex items-center gap-2 border border-outline-variant px-3 py-2 font-body-sm text-body-sm text-primary hover:border-primary peer-checked:border-2 peer-checked:border-primary peer-focus-visible:ring-2 peer-focus-visible:ring-primary/40">
                                    @if ($shade->hex_color)
                                        <span class="w-4 h-4 rounded-full border border-outline-variant" style="background-color: {{ $shade->hex_color }}"></span>
                                    @endif
                                    {{ $shade->name }}
                                    @if ($shade->stock !== null && (int) $shade->stock <= 0)
                                        <span class="text-secondary text-[11px] uppercase">Sold out</span>
                                    @endif
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex flex-col sm:flex-row gap-3 mb-4">
                <div class="flex items-center justify-between sm:justify-start border border-outline-variant h-12 sm:h-14 shrink-0{{ $stock <= 0 ? ' opacity-50 pointer-events-none' : '' }}">
                    <button type="button" data-qty-minus class="w-12 sm:w-11 h-full hover:bg-surface-container disabled:opacity-40" aria-label="Decrease quantity">−</button>
                    <input data-qty-input type="number" min="1" max="{{ $maxQty }}" value="1"
                           class="w-14 h-full text-center font-body-md text-body-md text-primary bg-transparent border-0 focus:ring-0"
                           aria-label="Quantity">
                    <button type="button" data-qty-plus class="w-12 sm:w-11 h-full hover:bg-surface-container disabled:opacity-40" aria-label="Increase quantity">+</button>
                </div>

                <div class="flex items-center gap-3 flex-1">
                    <button type="button"
                            data-add-to-bag="{{ $product->id }}"
                            @disabled($stock <= 0)
                            class="flex-1 h-12 sm:h-14 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-[0.18em] font-bold border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        {{ $stock > 0 ? 'Add to bag' : 'Out of stock' }}
                    </button>

                    <button type="button"
                            data-wishlist-toggle="{{ $product->id }}"
                            class="h-12 w-12 sm:h-14 sm:w-14 shrink-0 border border-outline-variant text-primary hover:border-primary hover:bg-surface-container-low transition-colors flex items-center justify-center"
                            aria-label="Add {{ $product->name }} to wishlist">
                        <span class="material-symbols-outlined">favorite</span>
                    </button>
                </div>
            </div>

            <div class="space-y-2 mb-6" aria-live="polite">
                @if ($stock <= 0)
                    <p class="font-body-sm text-body-sm text-secondary flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">error</span>
                        This product is currently out of stock.
                    </p>
                @elseif ($stock <= 5)
                    <p class="font-body-sm text-body-sm text-secondary flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">local_fire_department</span>
                        Only {{ $stock }} left — order soon.
                    </p>
                @else
                    <p class="font-body-sm text-body-sm text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        In stock and ready to ship.
                    </p>
                @endif

                <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                    Free standard delivery over {{ $currency }} {{ number_format((float) config('commerce.free_shipping_threshold', 250), 0) }}
                </p>
                <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">assignment_return</span>
                    Complimentary 14-day returns
                </p>
                <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">verified</span>
                    100% authentic — sourced from the brand
                </p>
            </div>

            <div class="border-t border-outline-variant divide-y divide-outline-variant">
                @if ($product->description)
                    <details class="group py-4" open>
                        <summary class="flex items-center justify-between cursor-pointer list-none font-title-md text-body-md font-bold uppercase tracking-wider text-primary">
                            Description
                            <span class="material-symbols-outlined text-[20px] group-open:rotate-180 transition-transform">expand_more</span>
                        </summary>
                        <div class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mt-3">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </details>
                @endif

                @if ($product->how_to_use)
                    <details class="group py-4">
                        <summary class="flex items-center justify-between cursor-pointer list-none font-title-md text-body-md font-bold uppercase tracking-wider text-primary">
                            How to use
                            <span class="material-symbols-outlined text-[20px] group-open:rotate-180 transition-transform">expand_more</span>
                        </summary>
                        <div class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mt-3">
                            {!! nl2br(e($product->how_to_use)) !!}
                        </div>
                    </details>
                @endif

                @if ($product->ingredients)
                    <details class="group py-4">
                        <summary class="flex items-center justify-between cursor-pointer list-none font-title-md text-body-md font-bold uppercase tracking-wider text-primary">
                            Ingredients
                            <span class="material-symbols-outlined text-[20px] group-open:rotate-180 transition-transform">expand_more</span>
                        </summary>
                        <div class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mt-3">
                            {!! nl2br(e($product->ingredients)) !!}
                        </div>
                    </details>
                @endif
            </div>
        </div>
    </div>

    {{-- Reviews --}}
    <section id="reviews" class="py-12 border-b border-outline-variant">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4">
                <h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary mb-4">Customer reviews</h2>
                <div class="flex items-end gap-3 mb-2">
                    <span class="font-price-aed-lg text-price-aed-lg text-primary font-bold">{{ number_format($rating, 1) }}</span>
                    <div class="pb-1">
                        <div class="text-primary text-lg">@include('components.stars', ['rating' => $rating])</div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Based on {{ number_format($reviewCount) }} review{{ $reviewCount === 1 ? '' : 's' }}</p>
                    </div>
                </div>
                <p class="font-body-sm text-body-sm text-outline">Reviews are submitted by verified shoppers and moderated before publishing.</p>
            </div>

            <div class="lg:col-span-8 space-y-4">
                @if (session('review_status'))
                    <div class="border border-primary bg-surface-container-low p-4 font-body-sm text-body-sm text-primary" role="status">
                        {{ session('review_status') }}
                    </div>
                @endif

                @forelse ($product->reviews as $review)
                    <article class="border border-outline-variant bg-surface-container-lowest p-5">
                        <header class="flex flex-wrap items-center justify-between gap-2 mb-2">
                            <div class="flex items-center gap-2">
                                <span class="font-title-md text-body-md font-bold text-primary">{{ $review->author_name ?: 'Verified Client' }}</span>
                                <span class="text-primary text-sm">@include('components.stars', ['rating' => (float) $review->rating])</span>
                            </div>
                            <time class="font-body-sm text-body-sm text-outline" datetime="{{ $review->created_at?->toDateString() }}">
                                {{ $review->created_at?->format('d M Y') }}
                            </time>
                        </header>
                        @if ($review->title)
                            <h3 class="font-title-md text-body-md font-bold text-primary mb-1">{{ $review->title }}</h3>
                        @endif
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">{{ $review->body }}</p>
                    </article>
                @empty
                    <div class="border border-outline-variant bg-surface-container-lowest p-8 text-center">
                        <span class="material-symbols-outlined text-[32px] text-outline-variant">rate_review</span>
                        <p class="font-body-md text-body-md text-primary mt-2">No reviews yet.</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Be the first to share your experience.</p>
                    </div>
                @endforelse

                @if ($product->reviews->count() < $reviewCount)
                    <p class="font-body-sm text-body-sm text-outline">Showing the latest {{ $product->reviews->count() }} of {{ number_format($reviewCount) }} reviews.</p>
                @endif
            </div>
        </div>

        {{-- Write a review --}}
        <div id="write-review" class="mt-10 max-w-3xl">
            <h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary mb-4">Write a review</h2>

            @auth
                @if ($errors->any())
                    <div class="mb-4 border border-secondary bg-surface-container-low p-4" role="alert">
                        <ul class="list-disc list-inside font-body-sm text-body-sm text-secondary space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('reviews.store', ['product' => $product->slug]) }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="review-rating">Rating *</label>
                            <select id="review-rating" name="rating" required class="w-full h-12 border border-outline px-3 bg-surface-container-lowest text-primary focus:outline-none focus:border-primary">
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" @selected(old('rating') === (string) $i)>{{ $i }} star{{ $i === 1 ? '' : 's' }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="review-title">Title</label>
                            <input id="review-title" name="title" type="text" maxlength="120" value="{{ old('title') }}"
                                   class="w-full h-12 border border-outline px-3 bg-surface-container-lowest text-primary focus:outline-none focus:border-primary"
                                   placeholder="Sum it up in a few words">
                        </div>
                    </div>
                    <div>
                        <label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1" for="review-body">Your review *</label>
                        <textarea id="review-body" name="body" rows="4" required minlength="10" maxlength="2000"
                                  class="w-full border border-outline p-3 bg-surface-container-lowest text-primary font-body-sm focus:outline-none focus:border-primary"
                                  placeholder="What did you like or dislike? How did you use the product?">{{ old('body') }}</textarea>
                    </div>
                    <button type="submit" class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-8 py-3 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all">
                        Submit review
                    </button>
                </form>
            @else
                <div class="border border-outline-variant bg-surface-container-lowest p-6">
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        <a class="text-primary underline font-semibold" href="{{ route('login') }}">Sign in</a> to write a review for this product.
                    </p>
                </div>
            @endauth
        </div>
    </section>

    {{-- Related products --}}
    @if ($related->isNotEmpty())
        <section class="py-12">
            <div class="flex items-end justify-between gap-3 mb-6">
                <h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">You may also like</h2>
                @if ($primaryCategory)
                    <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary" href="{{ route('shop.category', ['slug' => $primaryCategory->slug]) }}">
                        Shop {{ $primaryCategory->name }}
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach ($related as $item)
                    <article class="group border border-outline-variant bg-surface-container-lowest flex flex-col">
                        <a class="block relative overflow-hidden" href="{{ route('product.show', ['slug' => $item->slug]) }}">
                            <div class="absolute top-2 left-2 z-10 flex flex-col gap-1">
                                @if ($item->is_new)
                                    <span class="bg-surface text-on-surface border border-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">New</span>
                                @endif
                                @if ($item->is_bestseller)
                                    <span class="bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">Best Seller</span>
                                @endif
                            </div>
                            <div class="aspect-square flex items-center justify-center p-4 bg-surface-bright">
                                <img alt="{{ $item->name }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300"
                                     src="{{ media_url($item->first_image) }}" loading="lazy"
                                     onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                            </div>
                        </a>
                        <div class="p-3 flex flex-col flex-1">
                            <span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant">{{ $item->brand?->name }}</span>
                            <a class="font-title-md text-body-sm font-bold text-primary leading-tight line-clamp-2 mt-0.5 hover:underline" href="{{ route('product.show', ['slug' => $item->slug]) }}">
                                {{ $item->name }}
                            </a>
                            <div class="flex items-center text-primary text-xs mt-1">
                                @include('components.stars', ['rating' => (float) $item->rating])
                                <span class="text-on-surface-variant ml-1">({{ number_format((int) $item->reviews_count) }})</span>
                            </div>
                            <div class="mt-auto pt-3 flex flex-wrap items-center justify-between gap-2">
                                <span class="font-price-aed-md text-sm sm:text-price-aed-md font-bold text-primary">{{ $currency }} {{ number_format($item->price, 2) }}</span>
                                <button type="button" data-add-to-bag="{{ $item->id }}"
                                        class="h-8 sm:h-9 px-2.5 sm:px-3 bg-primary text-on-primary font-label-tag text-[11px] sm:text-label-tag uppercase tracking-wider border border-primary hover:bg-surface-container-lowest hover:text-primary transition-colors disabled:opacity-50"
                                        @disabled($item->stock <= 0)>
                                    {{ $item->stock > 0 ? 'Add' : 'Sold out' }}
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</main>
@endsection

@section('scripts')
<script>
(function () {
    const main = document.getElementById('pdp-main-image');
    const thumbs = document.querySelectorAll('[data-pdp-thumb]');

    thumbs.forEach(function (thumb) {
        thumb.addEventListener('click', function () {
            if (main) {
                main.src = thumb.dataset.image;
                main.alt = thumb.dataset.alt || '';
            }

            thumbs.forEach(function (other) {
                other.classList.remove('border-primary', 'border-2');
                other.classList.add('border-outline-variant');
            });

            thumb.classList.remove('border-outline-variant');
            thumb.classList.add('border-primary', 'border-2');
        });
    });
})();
</script>
@endsection
