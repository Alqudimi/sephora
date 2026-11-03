<?php $__env->startSection('title', 'Shopping Bag | SEPHORA UAE'); ?>
<?php $__env->startSection('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary'); ?>

<?php $__env->startSection('content'); ?>
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<!-- Breadcrumbs -->
<nav class="text-body-sm font-body-sm text-outline mb-4" aria-label="Breadcrumb">
    <a class="hover:text-secondary transition-colors" href="/">Home</a>
    <span class="mx-1.5">/</span>
    <span class="text-on-surface font-semibold">Shopping Bag</span>
</nav>

<!-- Page Header -->
<div class="flex items-end justify-between border-b border-primary pb-4 mb-8">
    <div>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Shopping Bag</h1>
        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1"><?php echo e($items->count()); ?> item<?php echo e($items->count() === 1 ? '' : 's'); ?> in your bag</p>
    </div>
    <a class="font-label-caps text-label-caps uppercase underline text-on-surface hover:text-secondary transition-colors" href="/">Continue Shopping</a>
</div>

<?php if($items->isEmpty()): ?>
<!-- Empty State -->
<div class="text-center py-24 space-y-6">
    <span class="material-symbols-outlined text-[64px] text-outline-variant" data-icon="shopping_bag">shopping_bag</span>
    <h2 class="font-headline-sm text-headline-sm text-primary">Your bag is empty</h2>
    <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto">Discover new arrivals, exclusive launches and beauty icons — all in one place.</p>
    <a class="inline-block bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="/shop/bestsellers">Shop Best Sellers</a>
</div>
<?php else: ?>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Items Column -->
    <div class="lg:col-span-8 space-y-4">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="bg-surface-container-lowest card-border p-4 flex gap-4">
            <a class="w-24 h-24 shrink-0 bg-surface-container-low overflow-hidden flex items-center justify-center" href="/p/<?php echo e($item->product->slug); ?>">
                <img alt="<?php echo e($item->product->name); ?>" class="w-full h-full object-contain" src="<?php echo e(asset($item->product->first_image)); ?>"/>
            </a>
            <div class="flex-1 flex flex-col">
                <span class="font-label-caps text-label-caps uppercase text-outline tracking-wider font-bold"><?php echo e($item->product->brand?->name); ?></span>
                <a class="font-title-md text-title-md text-primary hover:underline leading-tight mt-0.5" href="/p/<?php echo e($item->product->slug); ?>"><?php echo e($item->product->name); ?></a>
                <?php if($item->shade_name): ?>
                <span class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Shade: <?php echo e($item->shade_name); ?></span>
                <?php endif; ?>
                <div class="mt-auto flex items-center justify-between pt-3">
                    <div class="flex items-center border border-outline-variant">
                        <button class="px-3 py-1.5 hover:bg-surface-container" data-qty-minus type="button">−</button>
                        <input class="w-10 text-center font-body-md text-body-md text-primary bg-transparent" data-cart-item="<?php echo e($item->id); ?>" data-qty-input type="text" value="<?php echo e($item->quantity); ?>"/>
                        <button class="px-3 py-1.5 hover:bg-surface-container" data-qty-plus type="button">+</button>
                    </div>
                    <span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED <?php echo e(number_format($item->lineTotal(), 2)); ?></span>
                </div>
            </div>
            <button class="text-outline hover:text-secondary transition-colors self-start" data-cart-remove="<?php echo e($item->id); ?>" title="Remove" type="button">
                <span class="material-symbols-outlined text-[20px]" data-icon="close">close</span>
            </button>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Summary Column -->
    <aside class="lg:col-span-4">
        <div class="bg-surface-container-lowest card-border p-6 sticky top-28">
            <h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-6">Order Summary</h2>
            <dl class="space-y-3 font-body-md text-body-md text-on-surface-variant">
                <div class="flex justify-between">
                    <dt>Subtotal</dt>
                    <dd class="text-on-surface font-semibold">AED <?php echo e(number_format($subtotal, 2)); ?></dd>
                </div>
                <div class="flex justify-between">
                    <dt>Delivery</dt>
                    <dd class="text-on-surface font-semibold"><?php echo e($shippingFee == 0 ? 'FREE' : 'AED ' . number_format($shippingFee, 2)); ?></dd>
                </div>
            </dl>
            <?php if($shippingFee > 0): ?>
            <p class="font-body-sm text-body-sm text-secondary mt-3">Add AED <?php echo e(number_format($freeShippingThreshold - $subtotal, 2)); ?> more for free delivery</p>
            <?php endif; ?>
            <div class="border-t border-outline-variant mt-6 pt-4 flex justify-between items-baseline">
                <span class="font-title-lg text-title-lg text-primary">Total</span>
                <span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED <?php echo e(number_format($subtotal + $shippingFee, 2)); ?></span>
            </div>
            <a class="block mt-6 text-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="/checkout">Proceed to Checkout</a>
            <p class="font-body-sm text-body-sm text-outline text-center mt-4 flex items-center justify-center gap-1">
                <span class="material-symbols-outlined text-[16px]" data-icon="lock">lock</span> Secure Checkout
            </p>
        </div>
    </aside>
</div>
<?php endif; ?>

</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/shop/cart.blade.php ENDPATH**/ ?>