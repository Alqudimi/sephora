@extends('layouts.app')

@php
    $images = $product->images;
    $primaryCategory = $product->categories->first();
    $stock = (int) $product->stock;
    $maxQty = max(1, min($stock, (int) config('commerce.max_quantity_per_item', 20)));
    $rating = (float) ($product->rating > 0 ? $product->rating : ($product->reviews->avg('rating') ?? 4.8));
    $reviewCount = max((int) $product->reviews_count, $product->reviews->count() ?: 24);
    $hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
    $currency = config('commerce.currency', 'AED');
    $mainImage = $product->first_image;
    $productUrl = route('product.show', ['slug' => $product->slug]);
    $loyaltyPoints = max(10, (int) round($product->price * 0.1));

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

@section('title', ($product->meta_title ?: $product->name . ' | ' . ($product->brand?->name ?? 'SEPHORA')) . ' ≡ SEPHORA UAE')
@section('meta_description', Str::limit(strip_tags($product->meta_description ?: ($product->description ?: 'Shop ' . $product->name . ' at SEPHORA UAE. 100% authentic products with free delivery over AED 250.')), 155))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

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
<main class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-4 sm:py-6">

    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="text-xs text-neutral-500 flex items-center flex-wrap gap-2 mb-4 sm:mb-6">
        <a class="hover:text-black transition-colors" href="/">{{ __('ui.home') }}</a>
        <span>&rsaquo;</span>
        @if ($primaryCategory)
            <a class="hover:text-black transition-colors" href="{{ route('shop.category', ['slug' => $primaryCategory->slug]) }}">{{ $primaryCategory->name }}</a>
            <span>&rsaquo;</span>
        @endif
        @if ($product->brand)
            <a class="hover:text-black transition-colors" href="{{ route('brands.show', ['slug' => $product->brand->slug]) }}">{{ $product->brand->name }}</a>
            <span>&rsaquo;</span>
        @endif
        <span class="text-black font-semibold truncate max-w-xs md:max-w-none">{{ $product->name }}</span>
    </nav>

    <!-- Main PDP Grid (Left Gallery 60% / Right Info 40%) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 pb-12 border-b border-gray-200">

        <!-- Left Gallery -->
        <div class="lg:col-span-7 flex flex-col gap-4">
            <div class="flex flex-col-reverse md:flex-row gap-3">
                <!-- Thumbnails Strip -->
                <div class="flex md:flex-col gap-2.5 overflow-x-auto md:overflow-visible pb-1 md:pb-0 shrink-0" role="list" aria-label="Product thumbnails">
                    @forelse ($images->take(6) as $image)
                        <button type="button"
                                data-pdp-thumb
                                data-image="{{ media_url($image->path) }}"
                                data-alt="{{ $image->alt ?: $product->name }}"
                                class="w-16 h-16 sm:w-20 sm:h-20 shrink-0 border {{ $loop->first ? 'border-2 border-black' : 'border-gray-200' }} rounded-sm bg-white p-1 hover:border-black transition-all"
                                aria-label="View image {{ $loop->iteration }}">
                            <img src="{{ media_url($image->path) }}" alt="{{ $image->alt ?: $product->name }}" class="w-full h-full object-contain" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                        </button>
                    @empty
                        <span class="w-16 h-16 sm:w-20 sm:h-20 shrink-0 border border-gray-200 rounded-sm bg-white p-1">
                            <img src="{{ media_url($mainImage) }}" alt="{{ $product->name }}" class="w-full h-full object-contain" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                        </span>
                    @endforelse
                </div>

                <!-- Main Product Packshot -->
                <div class="relative flex-1 border border-gray-100 rounded-sm bg-[#fafafa] overflow-hidden group flex items-center justify-center min-h-[380px] sm:min-h-[480px]">
                    <!-- Badges -->
                    <div class="absolute top-4 left-4 z-10 flex flex-col gap-1.5 items-start pointer-events-none">
                        @if ($product->is_exclusive)
                            <span class="bg-black text-white text-[10px] font-bold px-2 py-0.5 tracking-wider uppercase rounded-[1px]">{{ __('ui.online_only') }}</span>
                        @endif
                        @if ($product->is_new)
                            <span class="bg-white text-black border border-black text-[10px] font-bold px-2 py-0.5 tracking-wider uppercase rounded-[1px]">{{ __('ui.new') }}</span>
                        @endif
                        @if ($product->is_bestseller)
                            <span class="bg-[#1A3066] text-white text-[10px] font-bold px-2 py-0.5 tracking-wider uppercase rounded-[1px]">Best Seller</span>
                        @endif
                        @if ($hasDiscount)
                            <span class="bg-[#BBA08B] text-white text-[10px] font-bold px-2 py-0.5 tracking-wider uppercase rounded-[1px]">
                                Save {{ $currency }} {{ number_format($product->compare_at_price - $product->price, 0) }}
                            </span>
                        @endif
                    </div>

                    <div class="w-full h-full flex items-center justify-center p-6 sm:p-10">
                        <img id="pdp-main-image"
                             src="{{ media_url($mainImage) }}"
                             alt="{{ $product->name }}"
                             class="max-h-[460px] w-auto max-w-full object-contain transition-transform duration-300 group-hover:scale-105"
                             onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Product Info & Buy Box -->
        <div class="lg:col-span-5 flex flex-col">
            <!-- Brand Link -->
            @if ($product->brand)
                <a class="text-xs sm:text-sm font-bold uppercase tracking-wider text-black hover:underline mb-1"
                   href="{{ route('brands.show', ['slug' => $product->brand->slug]) }}">
                    {{ $product->brand->name }}
                </a>
            @endif

            <!-- Product Title -->
            <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black tracking-tight mb-2 leading-tight">
                {{ $product->name }}
            </h1>

            <!-- Rating & Reviews Counter -->
            <div class="flex items-center gap-2 pb-3 mb-4 border-b border-gray-200 text-xs">
                <div class="flex items-center text-amber-500">
                    @include('components.stars', ['rating' => $rating])
                    <span class="font-bold text-black ml-1.5">{{ number_format($rating, 1) }}</span>
                </div>
                <span class="text-gray-300">&bull;</span>
                <a class="text-neutral-500 hover:text-black underline" href="#reviews">
                    ({{ number_format($reviewCount) }})
                </a>
                <span class="text-gray-300">&bull;</span>
                <a class="text-neutral-500 hover:text-black underline" href="#write-review">{{ __('ui.write_review') }}</a>
            </div>

            <!-- Price & Size/Variant -->
            <div class="mb-4">
                <div class="flex items-baseline gap-3">
                    <span class="text-xl sm:text-2xl font-bold text-black">
                        {{ $currency }} {{ number_format($product->price, 2) }}
                    </span>
                    @if ($hasDiscount)
                        <span class="text-xs text-neutral-400 line-through">
                            Real value {{ $currency }} {{ number_format($product->compare_at_price, 2) }}
                        </span>
                    @endif
                </div>
                @if ($product->size || $product->sku)
                    <p class="text-xs text-neutral-500 mt-1">
                        {{ $product->size ?: 'Standard Size' }}
                        @if ($product->sku) &middot; SKU: {{ $product->sku }} @endif
                    </p>
                @endif
                @if ($stock <= 0)
                    <p class="text-xs text-red-600 font-semibold mt-1.5">Out of stock</p>
                @elseif ($stock <= 5)
                    <p class="text-xs text-amber-700 font-semibold mt-1.5">Only {{ $stock }} left</p>
                @endif
            </div>

            <!-- Shade Selector (if available) -->
            @if ($product->shades->isNotEmpty())
                <div class="mb-5">
                    <span class="block text-xs font-bold uppercase tracking-wider text-black mb-2">
                        Shade: <span class="font-normal text-neutral-600" id="selected-shade-name">{{ $product->shades->first()->name }}</span>
                    </span>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($product->shades as $shade)
                            <label class="cursor-pointer">
                                <input type="radio" name="shade" value="{{ $shade->name }}" class="peer sr-only" @checked($loop->first)>
                                <span class="flex items-center gap-1.5 border border-gray-300 rounded-sm px-2.5 py-1.5 text-xs text-black hover:border-black peer-checked:border-2 peer-checked:border-black peer-checked:font-bold">
                                    @if ($shade->hex_color)
                                        <span class="w-3.5 h-3.5 rounded-full border border-gray-300" style="background-color: {{ $shade->hex_color }}"></span>
                                    @endif
                                    {{ $shade->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quantity & Add to Basket Row -->
            <div class="flex items-stretch gap-3 mb-4">
                <!-- Quantity Selector -->
                <div class="flex items-center border border-gray-300 rounded-sm h-12 shrink-0{{ $stock <= 0 ? ' opacity-50 pointer-events-none' : '' }}">
                    <button type="button" data-qty-minus class="w-9 h-full flex items-center justify-center text-black hover:bg-gray-100 disabled:opacity-40" aria-label="Decrease quantity">−</button>
                    <input data-qty-input type="number" min="1" max="{{ $maxQty }}" value="1"
                           class="w-10 h-full text-center text-xs font-bold text-black bg-transparent border-0 focus:ring-0 p-0"
                           aria-label="Quantity">
                    <button type="button" data-qty-plus class="w-9 h-full flex items-center justify-center text-black hover:bg-gray-100 disabled:opacity-40" aria-label="Increase quantity">+</button>
                </div>

                <!-- ADD TO BASKET CTA -->
                <button type="button"
                        data-add-to-bag="{{ $product->id }}"
                        @disabled($stock <= 0)
                        class="flex-1 h-12 bg-black text-white text-xs sm:text-sm font-bold uppercase tracking-wider rounded-sm hover:bg-neutral-800 active:bg-neutral-900 transition-colors shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ $stock > 0 ? __('messages.product.add_to_basket') : __('messages.product.out_of_stock') }}
                </button>

                <!-- Wishlist Heart Button -->
                <button type="button"
                        data-wishlist-toggle="{{ $product->id }}"
                        class="h-12 w-12 shrink-0 border border-black rounded-sm text-black hover:bg-gray-50 transition-colors flex items-center justify-center"
                        aria-label="Add {{ $product->name }} to wishlist">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <!-- MY SEPHORA Loyalty Value Prop -->
            <div class="bg-[#faf8f5] border border-amber-200/80 rounded-sm p-3 mb-5 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-black text-white text-[9px] font-black flex items-center justify-center shrink-0">
                    PASS
                </div>
                <p class="text-xs text-neutral-800">
                    {!! __('messages.product.pass_loyalty_text', ['points' => $loyaltyPoints]) !!}
                </p>
            </div>

            <!-- Delivery & Fulfillment Promises Box -->
            <div class="border border-gray-200 rounded-sm p-4 space-y-2.5 text-xs text-neutral-700 mb-6 bg-white">
                <div class="flex items-center gap-2 text-black font-semibold">
                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span>{{ __('messages.product.delivery_available') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    <span>{{ __('messages.product.standard_delivery_text') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    <span>{{ __('messages.product.express_delivery_text') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    <span>{{ __('messages.product.free_returns_text') }}</span>
                </div>
                <div class="pt-2 border-t border-gray-100">
                    <a href="/stores" class="text-xs font-bold text-black uppercase underline hover:opacity-75">
                        {{ __('messages.product.check_in_store') }}
                    </a>
                </div>
            </div>

            <!-- Accordions: Description, How to Use, Ingredients -->
            <div class="border-t border-gray-200 divide-y divide-gray-200">
                @if ($product->description)
                    <details class="group py-3.5" open>
                        <summary class="flex items-center justify-between cursor-pointer list-none text-xs font-bold uppercase tracking-wider text-black">
                            <span>{{ __('messages.product.description') }}</span>
                            <span class="group-open:rotate-180 transition-transform">&dtrif;</span>
                        </summary>
                        <div class="text-xs text-neutral-600 leading-relaxed mt-2.5">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </details>
                @endif

                @if ($product->how_to_use)
                    <details class="group py-3.5">
                        <summary class="flex items-center justify-between cursor-pointer list-none text-xs font-bold uppercase tracking-wider text-black">
                            <span>{{ __('messages.product.how_to_use') }}</span>
                            <span class="group-open:rotate-180 transition-transform">&dtrif;</span>
                        </summary>
                        <div class="text-xs text-neutral-600 leading-relaxed mt-2.5">
                            {!! nl2br(e($product->how_to_use)) !!}
                        </div>
                    </details>
                @endif

                @if ($product->ingredients)
                    <details class="group py-3.5">
                        <summary class="flex items-center justify-between cursor-pointer list-none text-xs font-bold uppercase tracking-wider text-black">
                            <span>{{ __('messages.product.ingredients') }}</span>
                            <span class="group-open:rotate-180 transition-transform">&dtrif;</span>
                        </summary>
                        <div class="text-xs text-neutral-600 leading-relaxed mt-2.5">
                            {!! nl2br(e($product->ingredients)) !!}
                        </div>
                    </details>
                @endif
            </div>

        </div>

    </div>

    <!-- Reviews Section -->
    <section id="reviews" class="py-10 border-b border-gray-200">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4">
                <h2 class="text-lg sm:text-xl font-bold uppercase tracking-tight text-black mb-3">{{ __('messages.product.customer_reviews') }}</h2>
                <div class="flex items-baseline gap-3 mb-2">
                    <span class="text-3xl font-extrabold text-black">{{ number_format($rating, 1) }}</span>
                    <div>
                        <div class="text-amber-500 text-sm">@include('components.stars', ['rating' => $rating])</div>
                        <p class="text-xs text-neutral-500 mt-0.5">Based on {{ number_format($reviewCount) }} review{{ $reviewCount === 1 ? '' : 's' }}</p>
                    </div>
                </div>
                <p class="text-xs text-neutral-400 mt-2">Verified buyer reviews moderated according to Sephora UAE review guidelines.</p>
            </div>

            <div class="lg:col-span-8 space-y-4">
                @if (session('review_status'))
                    <div class="border border-black bg-neutral-50 p-3 text-xs text-black" role="status">
                        {{ session('review_status') }}
                    </div>
                @endif

                @forelse ($product->reviews as $review)
                    <article class="border border-gray-100 rounded-sm bg-white p-4">
                        <header class="flex flex-wrap items-center justify-between gap-2 mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-black">{{ $review->author_name ?: 'Verified Client' }}</span>
                                <span class="text-amber-500 text-xs">@include('components.stars', ['rating' => (float) $review->rating])</span>
                            </div>
                            <time class="text-[11px] text-neutral-400" datetime="{{ $review->created_at?->toDateString() }}">
                                {{ $review->created_at?->format('d M Y') }}
                            </time>
                        </header>
                        @if ($review->title)
                            <h4 class="text-xs font-bold text-black mb-1">{{ $review->title }}</h4>
                        @endif
                        <p class="text-xs text-neutral-600 leading-relaxed">{{ $review->body }}</p>
                    </article>
                @empty
                    <div class="border border-gray-200 rounded-sm bg-gray-50/50 p-6 text-center">
                        <p class="text-xs font-bold text-black">No customer reviews yet.</p>
                        <p class="text-xs text-neutral-500 mt-1">Be the first to share your experience with this beauty icon.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Write Review Form -->
        <div id="write-review" class="mt-8 max-w-2xl">
            <h3 class="text-sm font-bold uppercase tracking-wider text-black mb-3">{{ __('ui.write_review') }}</h3>
            @auth
                @if ($errors->any())
                    <div class="mb-4 border border-red-500 bg-red-50 p-3" role="alert">
                        <ul class="list-disc list-inside text-xs text-red-700 space-y-1">
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
                            <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1" for="review-rating">Rating *</label>
                            <select id="review-rating" name="rating" required class="w-full h-10 border border-gray-300 rounded-sm px-3 text-xs bg-white text-black focus:outline-none focus:border-black">
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" @selected(old('rating') === (string) $i)>{{ $i }} star{{ $i === 1 ? '' : 's' }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1" for="review-title">Title</label>
                            <input id="review-title" name="title" type="text" maxlength="120" value="{{ old('title') }}"
                                   class="w-full h-10 border border-gray-300 rounded-sm px-3 text-xs bg-white text-black focus:outline-none focus:border-black"
                                   placeholder="Sum it up in a few words">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1" for="review-body">Your review *</label>
                        <textarea id="review-body" name="body" rows="3" required minlength="10" maxlength="2000"
                                  class="w-full border border-gray-300 rounded-sm p-3 text-xs bg-white text-black focus:outline-none focus:border-black"
                                  placeholder="What did you love about this product?">{{ old('body') }}</textarea>
                    </div>
                    <button type="submit" class="bg-black text-white text-xs font-bold uppercase tracking-wider px-6 py-2.5 rounded-sm hover:bg-neutral-800 transition-colors">
                        Submit review
                    </button>
                </form>
            @else
                <div class="border border-gray-200 rounded-sm bg-neutral-50 p-4">
                    <p class="text-xs text-neutral-600">
                        <a class="text-black underline font-bold" href="{{ route('login') }}">Sign in</a> to write a review for this product.
                    </p>
                </div>
            @endauth
        </div>
    </section>

    <!-- Complete Your Look / Related Products -->
    @if ($related->isNotEmpty())
        <section class="py-10">
            <div class="flex items-end justify-between gap-3 mb-6">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-widest text-neutral-500">Pair It With</span>
                    <h2 class="text-xl sm:text-2xl font-bold uppercase tracking-tight text-black mt-0.5">Complete Your Look</h2>
                </div>
                @if ($primaryCategory)
                    <a class="text-xs font-bold uppercase tracking-wider underline text-black hover:text-neutral-600" href="{{ route('shop.category', ['slug' => $primaryCategory->slug]) }}">
                        Shop {{ $primaryCategory->name }} &rarr;
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-5">
                @foreach ($related as $item)
                    <x-product-card :product="$item" />
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
                other.classList.remove('border-black', 'border-2');
                other.classList.add('border-gray-200');
            });

            thumb.classList.remove('border-gray-200');
            thumb.classList.add('border-black', 'border-2');
        });
    });
})();
</script>
@endsection
