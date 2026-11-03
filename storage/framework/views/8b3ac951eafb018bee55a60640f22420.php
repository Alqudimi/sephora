<?php $__env->startSection('title', 'Access Denied | SEPHORA UAE'); ?>
<?php $__env->startSection('body_class', 'bg-background text-on-surface antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col font-body-md text-body-md'); ?>

<?php $__env->startSection('content'); ?>
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl flex items-center justify-center">
<div class="text-center max-w-xl">
<div class="inline-block mb-4">
<span class="font-label-caps text-label-caps uppercase tracking-[0.2em] text-outline border-b border-outline-variant pb-1">Error 403</span>
</div>
<h1 class="font-display-hero text-primary font-serif tracking-tight mb-4">Private Collection</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-8">
            You don't have permission to access this area. If you believe this is a mistake, please contact our client concierge.
          </p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-3">
<a class="w-full sm:w-auto h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-[0.16em] hover:bg-surface-container-lowest hover:text-primary border border-transparent hover:border-primary transition-all duration-200 flex items-center justify-center" href="<?php echo e(route('home')); ?>">Back to Home</a>
</div>
</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/errors/403.blade.php ENDPATH**/ ?>