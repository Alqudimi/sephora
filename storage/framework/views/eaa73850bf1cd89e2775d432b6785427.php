<?php
    $full = (int) floor($rating);
    $half = ($rating - $full) >= 0.5;
    $empty = 5 - $full - ($half ? 1 : 0);
?>
<div class="flex text-primary text-[14px]">
    <?php $__currentLoopData = range(1, min($full, 5)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span class="material-symbols-outlined fill-icon text-[14px]" data-icon="star">star</span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($half && $full < 5): ?>
        <span class="material-symbols-outlined fill-icon text-[14px]" data-icon="star_half">star_half</span>
    <?php endif; ?>
    <?php $__currentLoopData = range(1, max($empty, 0)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span class="material-symbols-outlined text-[14px]" data-icon="star">star</span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/components/stars-m3.blade.php ENDPATH**/ ?>