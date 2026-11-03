<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> | Sephora UAE</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
</head>
<body class="bg-surface-container-low text-on-surface antialiased font-body-md text-body-md">
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-60 bg-primary text-on-primary shrink-0 flex flex-col">
        <a class="font-display-hero text-headline-sm tracking-widest uppercase font-bold text-center py-6 border-b border-primary-container" href="/">SEPHORA</a>
        <nav class="flex-1 py-4 space-y-1 px-3">
            <a class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-primary-container' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                <span class="material-symbols-outlined text-[20px]">dashboard</span> Dashboard
            </a>
            <a class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors <?php echo e(request()->routeIs('admin.products*') ? 'bg-primary-container' : ''); ?>" href="<?php echo e(route('admin.products')); ?>">
                <span class="material-symbols-outlined text-[20px]">inventory_2</span> Products
            </a>
            <a class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors <?php echo e(request()->routeIs('admin.orders*') ? 'bg-primary-container' : ''); ?>" href="<?php echo e(route('admin.orders')); ?>">
                <span class="material-symbols-outlined text-[20px]">receipt_long</span> Orders
            </a>
        </nav>
        <div class="p-3 border-t border-primary-container">
            <a class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors" href="/">
                <span class="material-symbols-outlined text-[20px]">storefront</span> View Store
            </a>
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors w-full" type="submit">
                    <span class="material-symbols-outlined text-[20px]">logout</span> Sign Out
                </button>
            </form>
        </div>
    </aside>
    <!-- Content -->
    <main class="flex-1 p-8 overflow-x-auto">
        <?php if(session('saved')): ?><div class="bg-[#1b6b45] text-white px-4 py-3 mb-6 font-body-sm">Saved successfully.</div><?php endif; ?>
        <?php if(session('deleted')): ?><div class="bg-error text-on-error px-4 py-3 mb-6 font-body-sm">Deleted.</div><?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>
</body>
</html>
<?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/admin/layout.blade.php ENDPATH**/ ?>