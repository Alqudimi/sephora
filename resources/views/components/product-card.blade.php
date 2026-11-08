@props([
    'product',
    'badge' => null,
    'showAddButton' => true,
])

@php
    $hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
    $brandName = $product->brand?->name ?? 'Sephora';
    $rating = (float) ($product->rating > 0 ? $product->rating : ($product->reviews?->avg('rating') ?? 4.5));
    $reviewsCount = max((int) $product->reviews_count, $product->reviews?->count() ?? 12);
    $imageUrl = media_url($product->first_image ?? 'images/placeholder.webp');
    $productUrl = route('product.show', ['slug' => $product->slug]);
@endphp

<article class="product-card group relative flex flex-col justify-between bg-white border border-gray-100 hover:border-gray-300 rounded-sm hover:shadow-md transition-all duration-200 p-2 sm:p-3 text-left">
    <!-- Image Box -->
    <div class="relative w-full aspect-square bg-[#fafafa] rounded-sm overflow-hidden flex items-center justify-center">
        <!-- Badges (Top-Left) -->
        <div class="absolute top-2 left-2 flex flex-col gap-1 z-10 pointer-events-none">
            @if ($badge)
                <span class="bg-black text-white text-[9px] font-bold px-1.5 py-0.5 uppercase tracking-wider rounded-[1px]">
                    {{ $badge }}
                </span>
            @elseif ($product->is_new)
                <span class="bg-black text-white text-[9px] font-bold px-1.5 py-0.5 uppercase tracking-wider rounded-[1px]">
                    NEW
                </span>
            @elseif ($product->is_exclusive)
                <span class="bg-white text-black border border-black text-[9px] font-bold px-1.5 py-0.5 uppercase tracking-wider rounded-[1px]">
                    ONLINE ONLY
                </span>
            @elseif ($hasDiscount)
                <span class="bg-[#1A3066] text-white text-[9px] font-bold px-1.5 py-0.5 uppercase tracking-wider rounded-[1px]">
                    VALUE SET
                </span>
            @endif
        </div>

        <!-- Wishlist Button (Top-Right) -->
        <button
            aria-label="Add {{ $product->name }} to wishlist"
            class="absolute top-2 right-2 text-neutral-400 hover:text-black z-10 p-1.5 bg-white/90 rounded-full shadow-sm hover:shadow transition-colors"
            data-wishlist-toggle="{{ $product->id }}"
            type="button"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <!-- Product Image -->
        <a aria-label="View {{ $product->name }}" class="block w-full h-full p-2.5 flex items-center justify-center" href="{{ $productUrl }}">
            <img
                alt="{{ $product->name }}"
                class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                loading="lazy"
                src="{{ $imageUrl }}"
                onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';"
            />
        </a>
    </div>

    <!-- Product Details -->
    <div class="pt-2.5 flex flex-col flex-grow min-w-0">
        <!-- Brand -->
        <p class="text-[11px] sm:text-xs font-bold text-black uppercase tracking-wider truncate">
            {{ $brandName }}
        </p>

        <!-- Product Title -->
        <a class="mt-0.5 min-w-0 group-hover:underline" href="{{ $productUrl }}">
            <h4 class="text-xs sm:text-[13px] text-neutral-800 line-clamp-2 font-normal leading-snug">
                {{ $product->name }}
            </h4>
        </a>

        <!-- Rating & Reviews Count -->
        <div class="flex items-center gap-1 mt-1.5 text-xs text-amber-500">
            @include('components.stars', ['rating' => $rating])
            <span class="text-neutral-500 text-[11px] font-medium">({{ number_format($reviewsCount) }})</span>
        </div>

        <!-- Variant indicator -->
        <p class="text-[11px] text-neutral-500 mt-1 font-normal">
            {{ $product->shade_count > 1 ? $product->shade_count . ' Shades' : '1 Size' }}
        </p>

        <!-- Price Layout -->
        <div class="mt-auto pt-2 flex flex-col">
            @if ($hasDiscount)
                <span class="text-[11px] text-neutral-500 line-through">
                    Real value AED {{ number_format($product->compare_at_price, 2) }}
                </span>
                <span class="text-xs sm:text-sm font-bold text-black">
                    AED {{ number_format($product->price, 2) }}
                </span>
            @else
                <span class="text-xs sm:text-sm font-bold text-black">
                    AED {{ number_format($product->price, 2) }}
                </span>
            @endif
        </div>
    </div>

    <!-- Add To Basket Button -->
    @if ($showAddButton)
        <button
            class="mt-2.5 w-full py-2 bg-black text-white text-[11px] sm:text-xs font-semibold uppercase tracking-wider rounded-sm hover:bg-neutral-800 active:bg-neutral-900 transition-colors shadow-sm"
            data-add-to-bag="{{ $product->id }}"
            type="button"
        >
            ADD TO BASKET
        </button>
    @endif
</article>

