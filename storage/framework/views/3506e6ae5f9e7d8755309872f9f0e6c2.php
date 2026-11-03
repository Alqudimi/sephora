<?php $__env->startSection('title', 'Order Confirmed | SEPHORA UAE'); ?>
<?php $__env->startSection('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary'); ?>
<?php $__env->startSection('content'); ?>
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<div class="max-w-3xl mx-auto text-center py-12">
    <div class="w-20 h-20 rounded-full bg-primary text-on-primary flex items-center justify-center mx-auto mb-8">
        <span class="material-symbols-outlined text-[40px]" data-icon="check_circle">check_circle</span>
    </div>
    <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-2">Order Confirmed</span>
    <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase mb-3">Thank You, <?php echo e($order->customer_name); ?>!</h1>
    <p class="font-body-md text-body-md text-on-surface-variant max-w-lg mx-auto mb-2">Your order <strong class="text-primary"><?php echo e($order->order_number); ?></strong> has been received and is being prepared with care.</p>
    <p class="font-body-sm text-body-sm text-outline mb-10">A confirmation has been sent to <?php echo e($order->customer_email ?? 'your email'); ?>.</p>
    <div class="bg-surface-container-lowest card-border p-6 text-left space-y-4 mb-10">
        <div class="flex justify-between font-body-md text-body-md">
            <span class="text-on-surface-variant">Date</span>
            <span class="text-on-surface font-semibold"><?php echo e($order->placed_at?->format('d F Y, h:i A')); ?></span>
        </div>
        <div class="flex justify-between font-body-md text-body-md">
            <span class="text-on-surface-variant">Delivery</span>
            <span class="text-on-surface font-semibold uppercase"><?php echo e(str_replace('_', ' & ', $order->delivery_method)); ?></span>
        </div>
        <div class="flex justify-between font-body-md text-body-md">
            <span class="text-on-surface-variant">Payment</span>
            <span class="text-on-surface font-semibold uppercase"><?php echo e($order->payment_method === 'cod' ? 'Cash on Delivery' : ucfirst($order->payment_method)); ?></span>
        </div>
        <div class="border-t border-outline-variant pt-4 space-y-3">
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center gap-4">
                <img alt="<?php echo e($item->product_name); ?>" class="w-14 h-14 object-contain bg-surface-container-low" src="<?php echo e(asset($item->image_path ?? 'images/placeholder.webp')); ?>"/>
                <div class="flex-1">
                    <p class="font-title-md text-title-md text-primary leading-tight"><?php echo e($item->product_name); ?></p>
                    <p class="font-body-sm text-body-sm text-outline"><?php echo e($item->brand_name); ?> &middot; Qty <?php echo e($item->quantity); ?></p>
                </div>
                <span class="font-price-aed-md text-price-aed-md font-bold text-primary">AED <?php echo e(number_format($item->line_total, 2)); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="border-t border-primary pt-4 flex justify-between items-baseline">
            <span class="font-title-lg text-title-lg text-primary">Total Paid</span>
            <span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED <?php echo e(number_format($order->total, 2)); ?></span>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <?php if(auth()->guard()->check()): ?>
        <a class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="<?php echo e(route('account.orders')); ?>">Track My Order</a>
        <?php else: ?>
        <a class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="/sign-in">Sign In to Track</a>
        <?php endif; ?>
        <a class="border border-primary text-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-primary hover:text-on-primary transition-all" href="/">Continue Shopping</a>
    </div>
</div>

</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/shop/confirmation.blade.php ENDPATH**/ ?>