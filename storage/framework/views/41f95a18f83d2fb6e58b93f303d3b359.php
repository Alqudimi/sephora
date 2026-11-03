<?php $__env->startSection('title', 'Best Sellers | Sephora UAE'); ?>
<?php $__env->startSection('body_class', 'font-sans text-sm selection:bg-black selection:text-white'); ?>

<?php $__env->startSection('content'); ?>
<main class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-5">
<!-- Breadcrumb Navigation -->
<nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2" data-purpose="breadcrumbs"><a class="hover:underline" href="/">Home</a>
<span>/</span>
<span class="text-black font-bold underline cursor-default">Best Sellers</span></nav>
<!-- Page Title & Top Filters Controls Bar -->
<div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-gray-200 pb-4 mb-6 gap-4">
<div><h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-black">Best Sellers</h1>
<p class="text-xs sm:text-sm text-gray-500 mt-2 font-normal">582 items</p></div>
<!-- Sort Dropdown -->
<div class="flex items-center self-end sm:self-auto space-x-2">
<label class="text-xs font-medium text-gray-700" for="sort">Sort by:</label>
<div class="relative inline-block">
<select class="appearance-none bg-white border border-gray-300 rounded px-3 py-1.5 pr-8 text-xs font-semibold focus:outline-none focus:border-black cursor-pointer" id="sort">
<option>Recommended</option>
<option>Newest Arrivals</option>
<option>Price: Low to High</option>
<option>Price: High to Low</option>
<option>Top Rated</option>
</select>
<span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none text-gray-500">
<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</span>
</div>
</div>
</div>
<!-- Catalog Two-Column Layout -->
<div class="flex flex-col lg:flex-row items-start gap-8">
<!-- BEGIN: FilterSidebar -->
<aside class="w-full lg:w-64 shrink-0" data-purpose="catalog-filters"><!-- Best Sellers Category Filter Accordion -->
<div class="border border-gray-200 rounded p-4 mb-5">
<div class="flex items-center justify-between font-bold text-sm text-black pb-2 mb-2 border-b border-gray-100 cursor-pointer">
<span>Best Sellers <span class="text-xs font-normal text-gray-500">(582)</span></span>
<svg class="w-4 h-4 text-gray-600 transform rotate-180" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
<ul class="space-y-2.5 text-xs pt-1 pl-1">
<li>
<a class="font-bold text-black flex items-center justify-between" href="#">
<span>All Best Sellers</span>
<span class="text-gray-400 font-normal">(582)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="#">
<span>Bestseller Makeup</span>
<span class="text-gray-400">(214)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="#">
<span>Bestseller Fragrance</span>
<span class="text-gray-400">(168)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="#">
<span>Bestseller Skincare</span>
<span class="text-gray-400">(112)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="#">
<span>Bestseller Haircare</span>
<span class="text-gray-400">(54)</span>
</a>
</li>
<li>
<a class="text-gray-700 hover:text-black flex items-center justify-between" href="#">
<span>Sephora Collection Bestsellers</span>
<span class="text-gray-400">(34)</span>
</a>
</li>
</ul>
</div>
<!-- Refine Heading -->
<h2 class="font-bold text-sm tracking-wider uppercase text-black mb-3">Refine</h2>
<!-- Facet Accordions -->
<div class="border-t border-gray-200 divide-y divide-gray-200">
<!-- Brands Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>Brands</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
<!-- Shades Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>Shades</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
<!-- Price Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>Price</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
<!-- Benefits Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>Benefits</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
<!-- Formulation Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>Formulation</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
<!-- Finish Accordion -->
<button class="w-full py-3.5 flex items-center justify-between text-xs font-semibold text-gray-900 hover:text-black text-left">
<span>Finish</span>
<svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</button>
</div></aside>
<!-- END: FilterSidebar -->
<!-- BEGIN: ProductCatalogGrid -->
<section class="flex-1 w-full" data-purpose="product-grid"><div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
<!-- Product 1: The Ordinary Multi-Peptide Serum -->
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<article onclick="window.location='/p/<?php echo e($products->slug); ?>'" class="product-card border border-gray-200 bg-white rounded-sm p-3.5 flex flex-col justify-between relative group">
<div>
<div class="flex items-start justify-between min-h-[24px] mb-2">
<div class="flex flex-col gap-1 items-start">
<span class="bg-black text-white text-[10px] uppercase font-bold tracking-wider px-2 py-0.5">Best Seller</span>
<span class="bg-black text-white text-[10px] uppercase font-bold tracking-wider px-2 py-0.5">Award Winner</span>
</div>
<button aria-label="Add to wishlist" class="text-gray-400 hover:text-black transition-colors">
<svg class="w-5 h-5 stroke-current" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path>
</svg>
</button>
</div>
<div class="w-full aspect-square flex items-center justify-center p-2 mb-3 overflow-hidden">
<img alt="<?php echo e($products->name); ?>" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300" src="<?php echo e(asset($products->first_image)); ?>"/>
</div>
<h3 class="font-bold text-xs uppercase tracking-wide text-black mb-1">THE ORDINARY</h3>
<p class="text-xs text-gray-700 line-clamp-2 min-h-[32px] mb-1.5 leading-snug">Multi-Peptide Concentrated Serum for Hair Density</p>
<div class="flex items-center text-xs text-amber-500 mb-2">
<span><?php echo $__env->make('components.stars', ['rating' => $products->rating], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
<span class="text-gray-700 text-[11px] font-semibold ml-1"><?php echo e($products->rating); ?></span>
<span class="text-gray-400 text-[11px] ml-0.5">(<?php echo e(number_format($products->reviews_count)); ?>)</span>
</div>
</div>
<div>
<p class="font-bold text-sm text-black mb-3">AED <?php echo e(number_format($products->price, 2)); ?></p>
<button class="add-to-bag-btn w-full bg-black text-white text-xs font-bold uppercase tracking-wider py-2.5 rounded-none" data-add-to-bag="<?php echo e($products->id); ?>">
                ADD TO BAG
              </button>
</div>
</article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<!-- Pagination / Load More Button -->
<div class="mt-12 text-center pb-8">
<p class="text-xs text-gray-500 mb-3">Showing 12 of 582 items</p>
<div class="w-48 h-1 bg-gray-200 mx-auto rounded-full overflow-hidden mb-5">
<div class="w-1/6 h-full bg-black"></div>
</div>
<button class="inline-block border border-black bg-white hover:bg-black hover:text-white px-8 py-3 text-xs uppercase tracking-widest font-bold transition-colors">
            Load More Products
          </button>
</div></section>
<!-- END: ProductCatalogGrid -->
</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/shop/category.blade.php ENDPATH**/ ?>