<?php $__env->startSection('title', 'Search | SEPHORA UAE'); ?>
<?php $__env->startSection('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary'); ?>

<?php $__env->startSection('content'); ?>
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<div class="flex items-end justify-between border-b border-primary pb-4 mb-8">
    <div>
        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest block font-bold">Search Results</span>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase"><?php echo e($products->count()); ?> result<?php echo e($products->count() === 1 ? '' : 's'); ?> for &ldquo;<?php echo e($query); ?>&rdquo;</h1>
    </div>
    <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary transition-colors" href="/">Back to Home</a>
</div>

<?php if($products->isEmpty()): ?>
<div class="text-center py-24 space-y-6">
    <span class="material-symbols-outlined text-[64px] text-outline-variant" data-icon="search">search</span>
    <h2 class="font-headline-sm text-headline-sm text-primary">No results found</h2>
    <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto">Try different keywords or browse our most-loved categories.</p>
    <div class="flex justify-center gap-3">
        <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary" href="/shop/makeup">Makeup</a>
        <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary" href="/shop/skincare">Skincare</a>
        <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary" href="/shop/fragrance">Fragrance</a>
    </div>
</div>
<?php else: ?>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <article class="bg-surface-container-lowest card-border p-4 flex flex-col justify-between group relative" onclick="window.location='/p/<?php echo e($product->slug); ?>'">
        <div class="relative">
            <?php if($product->badge): ?>
            <span class="absolute top-0 left-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase z-10 font-bold"><?php echo e($product->badge); ?></span>
            <?php endif; ?>
            <button class="absolute top-0 right-0 z-10 text-on-surface hover:text-secondary p-1" data-wishlist-toggle="<?php echo e($product->id); ?>" title="Add to Wishlist" type="button">
                <span class="material-symbols-outlined text-[20px]" data-icon="favorite_border">favorite_border</span>
            </button>
            <div class="w-full aspect-square overflow-hidden mb-4 bg-surface-container-low flex items-center justify-center">
                <img alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="<?php echo e(asset($product->first_image)); ?>"/>
            </div>
        </div>
        <div class="flex flex-col flex-1">
            <span class="font-label-caps text-label-caps uppercase text-outline tracking-wider font-bold mb-1"><?php echo e($product->brand?->name); ?></span>
            <h3 class="font-title-md text-[14px] text-primary line-clamp-2 leading-tight mb-2 group-hover:underline"><?php echo e($product->name); ?></h3>
            <div class="flex items-center gap-1.5 mb-3">
                <?php echo $__env->make('components.stars-m3', ['rating' => $product->rating], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <span class="text-outline text-[12px] font-body-sm">(<?php echo e(number_format($product->reviews_count)); ?>)</span>
            </div>
            <div class="mt-auto">
                <p class="font-price-aed-lg text-price-aed-lg font-bold text-primary mb-3">AED <?php echo e(number_format($product->price, 2)); ?></p>
                <button class="w-full h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" data-add-to-bag="<?php echo e($product->id); ?>" type="button">Add to Bag</button>
            </div>
        </div>
    </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/shop/search.blade.php ENDPATH**/ ?>