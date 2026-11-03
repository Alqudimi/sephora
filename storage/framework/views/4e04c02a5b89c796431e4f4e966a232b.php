<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="font-headline-md text-headline-md font-bold text-primary uppercase mb-8">Dashboard</h1>
<div class="grid grid-cols-2 lg:grid-cols-6 gap-4 mb-10">
    <?php $__currentLoopData = ['Orders' => ['orders', 'receipt_long', number_format($stats['orders'])], 'Revenue (AED)' => ['revenue', 'payments', number_format($stats['revenue'], 0)], 'Products' => ['products', 'inventory_2', number_format($stats['products'])], 'Customers' => ['customers', 'group', number_format($stats['customers'])], 'Processing' => ['pending', 'schedule', number_format($stats['pending'])], 'New Messages' => ['messages', 'mail', number_format($stats['messages'])]]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-surface-container-lowest card-border p-5">
        <span class="material-symbols-outlined text-outline text-[22px] mb-2" data-icon="<?php echo e($d[1]); ?>"><?php echo e($d[1]); ?></span>
        <p class="font-price-aed-lg text-price-aed-lg font-bold text-primary"><?php echo e($d[2]); ?></p>
        <p class="font-label-caps text-label-caps uppercase text-outline mt-1"><?php echo e($label); ?></p>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-4">Recent Orders</h2>
<div class="bg-surface-container-lowest card-border overflow-hidden">
    <table class="w-full text-left font-body-sm text-body-sm">
        <thead class="bg-surface-container text-on-surface-variant font-label-caps text-label-caps uppercase">
            <tr><th class="px-4 py-3">Order</th><th class="px-4 py-3">Customer</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Total</th><th class="px-4 py-3"></th></tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-t border-outline-variant">
                <td class="px-4 py-3 font-semibold text-primary"><?php echo e($order->order_number); ?></td>
                <td class="px-4 py-3"><?php echo e($order->customer_name); ?></td>
                <td class="px-4 py-3"><span class="font-label-tag uppercase px-2 py-0.5 font-bold bg-primary text-on-primary"><?php echo e($order->status_label); ?></span></td>
                <td class="px-4 py-3 font-bold">AED <?php echo e(number_format($order->total, 2)); ?></td>
                <td class="px-4 py-3"><a class="underline hover:text-secondary" href="<?php echo e(route('admin.orders.show', $order)); ?>">View</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>