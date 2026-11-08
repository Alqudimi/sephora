<?php
    $currency = config('commerce.currency', 'AED');
    $total = $products->total();
    $heroTitle = $category->hero_title ?: $category->name;
    $heroSubtitle = $category->hero_subtitle ?: $category->description;
    $minBound = (int) floor((float) ($priceBounds->min_price ?? 0));
    $maxBound = (int) ceil((float) ($priceBounds->max_price ?? 0));

    $activeFilters = [];
    if ($filters['brand']) {
        $brandName = optional($brands->firstWhere('slug', $filters['brand']))->name ?: $filters['brand'];
        $activeFilters[] = ['label' => $brandName, 'key' => 'brand'];
    }
    if ($filters['min_price'] !== null || $filters['max_price'] !== null) {
        $activeFilters[] = [
            'label' => 'Price ' . ($filters['min_price'] !== null ? $currency . ' ' . number_format($filters['min_price'], 0) : '0')
                . ' – ' . ($filters['max_price'] !== null ? $currency . ' ' . number_format($filters['max_price'], 0) : 'any'),
            'key' => 'price',
        ];
    }
    if ($filters['clean']) {
        $activeFilters[] = ['label' => 'Clean beauty', 'key' => 'clean'];
    }
    if ($filters['new']) {
        $activeFilters[] = ['label' => 'New arrivals', 'key' => 'new'];
    }
    if ($filters['in_stock']) {
        $activeFilters[] = ['label' => 'In stock', 'key' => 'in_stock'];
    }
    if ($filters['q']) {
        $activeFilters[] = ['label' => 'Search: “' . $filters['q'] . '”', 'key' => 'q'];
    }

?>

<?php $__env->startSection('title', $heroTitle . ' | SEPHORA UAE'); ?>
<?php $__env->startSection('meta_description', Str::limit(strip_tags($heroSubtitle ?: 'Shop ' . $category->name . ' at SEPHORA UAE. 100% authentic products with free delivery over AED 250.'), 155)); ?>
<?php $__env->startSection('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary'); ?>

<?php
    $canonicalUrl = $category->slug === 'all' ? route('shop.all') : route('shop.category', ['slug' => $category->slug]);
?>

<?php $__env->startSection('head'); ?>
    <link rel="canonical" href="<?php echo e($canonicalUrl); ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SEPHORA UAE">
    <meta property="og:title" content="<?php echo e($heroTitle); ?> | SEPHORA UAE">
    <meta property="og:description" content="<?php echo e(Str::limit(strip_tags($heroSubtitle ?: 'Shop ' . $category->name . ' at SEPHORA UAE. 100% authentic products with free delivery over AED 250.'), 200)); ?>">
    <meta property="og:url" content="<?php echo e($canonicalUrl); ?>">
    <meta property="og:image" content="<?php echo e($category->hero_image ? media_url($category->hero_image) : asset('images/placeholder.webp')); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($heroTitle); ?> | SEPHORA UAE">
    <meta name="twitter:description" content="<?php echo e(Str::limit(strip_tags($heroSubtitle ?: 'Shop ' . $category->name . ' at SEPHORA UAE. 100% authentic products with free delivery over AED 250.'), 200)); ?>">
    <meta name="twitter:image" content="<?php echo e($category->hero_image ? media_url($category->hero_image) : asset('images/placeholder.webp')); ?>">
    <?php
        $breadcrumbJson = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $category->name, 'item' => $canonicalUrl],
            ],
        ];
    ?>
    <script type="application/ld+json"><?php echo json_encode($breadcrumbJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG); ?></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-on-surface-variant flex items-center flex-wrap gap-2 mb-6">
        <a class="hover:text-primary transition-colors" href="/">Home</a>
        <span class="text-outline-variant">/</span>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->slug !== 'all'): ?>
            <a class="hover:text-primary transition-colors" href="<?php echo e(route('shop.all')); ?>">Shop</a>
            <span class="text-outline-variant">/</span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <span class="text-primary font-semibold"><?php echo e($category->name); ?></span>
    </nav>

    
    <section class="relative mb-8 overflow-hidden border border-outline-variant bg-primary text-on-primary">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->hero_image): ?>
            <img src="<?php echo e(media_url($category->hero_image)); ?>" alt="" class="absolute inset-0 w-full h-full object-cover opacity-40" loading="lazy" onerror="this.onerror=null;this.src='<?php echo e(asset('images/placeholder.webp')); ?>';">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div class="relative px-6 py-10 md:px-10 md:py-14 max-w-3xl">
            <span class="font-label-caps text-label-caps uppercase tracking-[0.25em] text-on-primary/70 block mb-2">SEPHORA UAE</span>
            <h1 class="font-headline-md text-headline-md md:text-[40px] leading-tight font-bold uppercase mb-3"><?php echo e($heroTitle); ?></h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heroSubtitle): ?>
                <p class="font-body-md text-body-md text-on-primary/80 max-w-xl"><?php echo e(Str::limit(strip_tags($heroSubtitle), 220)); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <p class="font-body-sm text-body-sm text-on-primary/60 mt-4"><?php echo e(number_format($total)); ?> product<?php echo e($total === 1 ? '' : 's'); ?></p>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        
        <aside class="lg:col-span-3">
            <details open class="lg:block border border-outline-variant bg-surface-container-lowest">
                <summary class="lg:hidden cursor-pointer list-none flex items-center justify-between px-4 py-4 font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">
                    Filters
                    <span class="material-symbols-outlined text-[20px]">tune</span>
                </summary>

                <form method="GET" action="<?php echo e(route('shop.category', ['slug' => $category->slug])); ?>" class="p-4 md:p-5 space-y-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->filled('sort')): ?>
                        <input type="hidden" name="sort" value="<?php echo e($filters['sort']); ?>">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div>
                        <label for="filter-brand" class="block font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Brand</label>
                        <select id="filter-brand" name="brand" class="w-full h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary">
                            <option value="">All brands</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($brand->slug); ?>" <?php if($filters['brand'] === $brand->slug): echo 'selected'; endif; ?>>
                                    <?php echo e($brand->name); ?> (<?php echo e($brand->products_count); ?>)
                                </option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>

                    <div>
                        <span class="block font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Price (<?php echo e($currency); ?>)</span>
                        <div class="flex items-center gap-2">
                            <label class="sr-only" for="filter-min-price">Minimum price</label>
                            <input id="filter-min-price" name="min_price" type="number" inputmode="numeric" min="0" max="<?php echo e($maxBound); ?>"
                                   value="<?php echo e($filters['min_price'] !== null ? (int) $filters['min_price'] : ''); ?>"
                                   placeholder="<?php echo e($minBound); ?>"
                                   class="w-full h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary">
                            <span class="text-outline">–</span>
                            <label class="sr-only" for="filter-max-price">Maximum price</label>
                            <input id="filter-max-price" name="max_price" type="number" inputmode="numeric" min="0" max="<?php echo e($maxBound); ?>"
                                   value="<?php echo e($filters['max_price'] !== null ? (int) $filters['max_price'] : ''); ?>"
                                   placeholder="<?php echo e($maxBound); ?>"
                                   class="w-full h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary">
                        </div>
                    </div>

                    <fieldset>
                        <legend class="block font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Refine</legend>
                        <div class="space-y-2.5">
                            <label class="flex items-center gap-2.5 cursor-pointer font-body-sm text-body-sm text-on-surface-variant">
                                <input type="checkbox" name="clean" value="1" <?php if($filters['clean']): echo 'checked'; endif; ?> class="h-4 w-4 border-outline text-primary focus:ring-primary">
                                Clean beauty
                            </label>
                            <label class="flex items-center gap-2.5 cursor-pointer font-body-sm text-body-sm text-on-surface-variant">
                                <input type="checkbox" name="new" value="1" <?php if($filters['new']): echo 'checked'; endif; ?> class="h-4 w-4 border-outline text-primary focus:ring-primary">
                                New arrivals
                            </label>
                            <label class="flex items-center gap-2.5 cursor-pointer font-body-sm text-body-sm text-on-surface-variant">
                                <input type="checkbox" name="in_stock" value="1" <?php if($filters['in_stock']): echo 'checked'; endif; ?> class="h-4 w-4 border-outline text-primary focus:ring-primary">
                                In stock only
                            </label>
                        </div>
                    </fieldset>

                    <div>
                        <label for="filter-q" class="block font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Search in <?php echo e($category->name); ?></label>
                        <input id="filter-q" name="q" type="search" value="<?php echo e($filters['q']); ?>" placeholder="Product or brand"
                               class="w-full h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary">
                    </div>

                    <div class="flex flex-col gap-2 pt-2">
                        <button type="submit" class="h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all">
                            Apply filters
                        </button>
                        <a href="<?php echo e(route('shop.category', ['slug' => $category->slug])); ?>"
                           class="h-11 flex items-center justify-center border border-outline-variant text-primary font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-all">
                            Clear all
                        </a>
                    </div>
                </form>
            </details>
        </aside>

        
        <div class="lg:col-span-9">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Showing <strong class="text-primary"><?php echo e($products->firstItem() ?? 0); ?>–<?php echo e($products->lastItem() ?? 0); ?></strong>
                    of <strong class="text-primary"><?php echo e(number_format($total)); ?></strong>
                    <?php echo e(Str::plural('product', $total)); ?>

                </p>

                <form method="GET" action="<?php echo e(route('shop.category', ['slug' => $category->slug])); ?>" class="flex items-center gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = request()->except(['sort', 'page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_scalar($value) && $value !== ''): ?>
                            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <label for="sort" class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant whitespace-nowrap">Sort by</label>
                    <select id="sort" name="sort" class="h-11 border border-outline-variant bg-surface-container-lowest px-3 font-body-sm text-body-sm text-primary focus:outline-none focus:border-primary" onchange="this.form.submit()">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sortOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($value); ?>" <?php if($filters['sort'] === $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <noscript>
                        <button type="submit" class="h-11 px-3 border border-primary text-primary font-label-caps text-label-caps uppercase">Go</button>
                    </noscript>
                </form>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeFilters): ?>
                <div class="flex flex-wrap items-center gap-2 mb-5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $activeFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $removeQuery = $chip['key'] === 'price'
                                ? ['min_price' => null, 'max_price' => null, 'page' => null]
                                : [$chip['key'] => null, 'page' => null];
                        ?>
                        <a href="<?php echo e(request()->fullUrlWithQuery($removeQuery)); ?>"
                           class="inline-flex items-center gap-1.5 border border-outline-variant bg-surface-container-low px-3 py-1.5 font-body-sm text-body-sm text-primary hover:border-primary transition-colors">
                            <?php echo e($chip['label']); ?>

                            <span class="material-symbols-outlined text-[16px]">close</span>
                            <span class="sr-only">Remove filter</span>
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <a href="<?php echo e(route('shop.category', ['slug' => $category->slug])); ?>" class="font-body-sm text-body-sm text-secondary underline ml-1">Clear all</a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->isEmpty()): ?>
                <div class="border border-outline-variant bg-surface-container-lowest text-center py-20 px-6">
                    <span class="material-symbols-outlined text-[40px] text-outline-variant">search_off</span>
                    <h2 class="font-headline-sm text-headline-sm text-primary mt-3 mb-2">No products match these filters</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-5">Try removing a filter or browsing the full category.</p>
                    <a href="<?php echo e(route('shop.category', ['slug' => $category->slug])); ?>"
                       class="inline-block bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 py-3 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all">
                        Show all <?php echo e($category->name); ?>

                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
                            $inStock = (int) $product->stock > 0;
                        ?>
                        <article class="group border border-outline-variant bg-surface-container-lowest flex flex-col">
                            <div class="relative">
                                <a href="<?php echo e(route('product.show', ['slug' => $product->slug])); ?>" class="block" aria-label="View <?php echo e($product->name); ?>">
                                    <div class="aspect-square bg-surface-bright flex items-center justify-center p-4 overflow-hidden">
                                        <img src="<?php echo e(media_url($product->first_image)); ?>" alt="<?php echo e($product->name); ?>"
                                             class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300" loading="lazy"
                                             onerror="this.onerror=null;this.src='<?php echo e(asset('images/placeholder.webp')); ?>';">
                                    </div>
                                </a>

                                <div class="absolute top-2 left-2 flex flex-col gap-1 items-start">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_exclusive): ?>
                                        <span class="bg-secondary text-on-secondary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">Exclusive</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_new): ?>
                                        <span class="bg-surface text-on-surface border border-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">New</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_bestseller): ?>
                                        <span class="bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider">Best Seller</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->badge): ?>
                                        <span class="bg-surface-container-low text-primary border border-outline-variant font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider"><?php echo e($product->badge); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasDiscount): ?>
                                        <span class="bg-secondary-fixed text-on-secondary-fixed-variant font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-wider font-bold">Sale</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <button type="button" data-wishlist-toggle="<?php echo e($product->id); ?>"
                                        class="absolute top-2 right-2 w-9 h-9 flex items-center justify-center bg-surface-container-lowest/90 border border-outline-variant text-primary hover:border-primary transition-colors"
                                        aria-label="Add <?php echo e($product->name); ?> to wishlist">
                                    <span class="material-symbols-outlined text-[20px]">favorite_border</span>
                                </button>
                            </div>

                            <div class="p-3 md:p-4 flex flex-col flex-1">
                                <span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant"><?php echo e($product->brand?->name); ?></span>
                                <a href="<?php echo e(route('product.show', ['slug' => $product->slug])); ?>"
                                   class="font-title-md text-body-sm font-bold text-primary leading-snug line-clamp-2 mt-0.5 hover:underline">
                                    <?php echo e($product->name); ?>

                                </a>

                                <div class="flex items-center gap-1.5 mt-1.5">
                                    <?php echo $__env->make('components.stars-m3', ['rating' => (float) $product->rating], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    <span class="font-body-sm text-[12px] text-outline">(<?php echo e(number_format((int) $product->reviews_count)); ?>)</span>
                                </div>

                                <div class="mt-auto pt-3">
                                    <div class="flex flex-wrap items-baseline gap-2 mb-2.5">
                                        <span class="font-price-aed-md text-price-aed-md font-bold text-primary"><?php echo e($currency); ?> <?php echo e(number_format($product->price, 2)); ?></span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasDiscount): ?>
                                            <span class="font-body-sm text-[13px] line-through text-outline"><?php echo e($currency); ?> <?php echo e(number_format($product->compare_at_price, 2)); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <button type="button" data-add-to-bag="<?php echo e($product->id); ?>" <?php if(! $inStock): echo 'disabled'; endif; ?>
                                            class="w-full h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                        <?php echo e($inStock ? 'Add to bag' : 'Sold out'); ?>

                                    </button>
                                </div>
                            </div>
                        </article>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->hasPages()): ?>
                    <nav aria-label="Pagination" class="mt-10 flex flex-wrap items-center justify-center gap-1.5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->onFirstPage()): ?>
                            <span class="h-10 px-3 flex items-center border border-outline-variant text-outline font-body-sm text-body-sm cursor-not-allowed" aria-disabled="true">
                                <span class="material-symbols-outlined text-[18px] mr-1">chevron_left</span> Previous
                            </span>
                        <?php else: ?>
                            <a href="<?php echo e($products->previousPageUrl()); ?>" rel="prev"
                               class="h-10 px-3 flex items-center border border-outline-variant text-primary font-body-sm text-body-sm hover:border-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px] mr-1">chevron_left</span> Previous
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page === $products->currentPage()): ?>
                                <span aria-current="page" class="h-10 w-10 flex items-center justify-center bg-primary text-on-primary border border-primary font-body-sm text-body-sm font-bold"><?php echo e($page); ?></span>
                            <?php else: ?>
                                <a href="<?php echo e($url); ?>" class="h-10 w-10 flex items-center justify-center border border-outline-variant text-primary font-body-sm text-body-sm hover:border-primary transition-colors"><?php echo e($page); ?></a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->hasMorePages()): ?>
                            <a href="<?php echo e($products->nextPageUrl()); ?>" rel="next"
                               class="h-10 px-3 flex items-center border border-outline-variant text-primary font-body-sm text-body-sm hover:border-primary transition-colors">
                                Next <span class="material-symbols-outlined text-[18px] ml-1">chevron_right</span>
                            </a>
                        <?php else: ?>
                            <span class="h-10 px-3 flex items-center border border-outline-variant text-outline font-body-sm text-body-sm cursor-not-allowed" aria-disabled="true">
                                Next <span class="material-symbols-outlined text-[18px] ml-1">chevron_right</span>
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </nav>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/shop/category.blade.php ENDPATH**/ ?>