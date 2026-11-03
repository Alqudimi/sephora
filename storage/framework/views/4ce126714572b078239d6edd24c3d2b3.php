<?php $__env->startSection('title', 'Create Account | SEPHORA UAE'); ?>
<?php $__env->startSection('body_class', 'bg-background text-on-surface antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col justify-between font-body-md text-body-md'); ?>

<?php $__env->startSection('head'); ?>
<style>
.material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }
    input:focus {
      outline: none !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- TOP ANNOUNCEMENT BAR -->
<aside class="w-full bg-primary text-on-primary py-2.5 px-4 text-center select-none relative z-50">
<div class="max-w-[1440px] mx-auto flex items-center justify-center gap-2">
<p class="font-label-caps text-label-caps uppercase tracking-widest text-[11px] text-on-primary">
        JOIN THE BEAUTY PASS PROGRAM - EARN 1 POINT FOR EVERY 10 AED SPENT
</p>
</div>
</aside>

<!-- BREADCRUMB -->
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-6 pb-2">
<nav class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<span class="text-primary font-bold">Create Account</span>
</nav>
</div>

<!-- PAGE HEADER -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin text-center pt-6 pb-10">
<div class="inline-block mb-3">
<span class="font-label-caps text-label-caps uppercase tracking-[0.2em] text-outline border-b border-outline-variant pb-1">
        SEPHORA BEAUTY PASS MEMBERSHIP
      </span>
</div>
<h1 class="font-headline-lg text-headline-lg lg:text-display-hero text-primary tracking-tight font-serif mb-4">
      Join Sephora UAE
    </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto font-normal">
      Create your account to unlock personalized beauty recommendations, order tracking, and exclusive member rewards.
    </p>
</section>

<!-- MAIN CONTENT -->
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin mb-space-xl">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

<!-- LEFT COLUMN: Registration Form -->
<section class="lg:col-span-6 bg-surface-container-lowest p-8 md:p-12 border border-primary relative">
<div class="mb-8">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-1">
            New Member
          </span>
<h2 class="font-headline-md text-headline-md font-serif text-primary">
            Create Your Account
          </h2>
<p class="font-body-md text-body-md text-outline mt-1">
            Complete the form to start your beauty journey.
          </p>
</div>

<form class="space-y-6" method="POST" action="<?php echo e(route('register')); ?>">
<?php echo csrf_field(); ?>

<!-- Name -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-name">
              Full Name <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-secondary <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="reg-name" placeholder="Your full name" required="" type="text" name="name" value="<?php echo e(old('name')); ?>"/>
<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<p class="text-secondary font-body-sm mt-1"><?php echo e($message); ?></p>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Email -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-email">
              Email Address <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-secondary <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="reg-email" placeholder="name@domain.com" required="" type="email" name="email" value="<?php echo e(old('email')); ?>"/>
<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<p class="text-secondary font-body-sm mt-1"><?php echo e($message); ?></p>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Phone -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-phone">
              UAE Mobile <span class="text-outline font-body-sm">(optional)</span>
</label>
<div class="flex">
<span class="inline-flex items-center px-3 border border-r-0 border-outline bg-surface-container-low font-body-md text-on-surface">+971</span>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-secondary <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="reg-phone" placeholder="50 123 4567" type="tel" name="phone" value="<?php echo e(old('phone')); ?>"/>
</div>
<?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<p class="text-secondary font-body-sm mt-1"><?php echo e($message); ?></p>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Password -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-password">
              Password <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-secondary <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="reg-password" placeholder="Minimum 8 characters" required="" type="password" name="password"/>
<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<p class="text-secondary font-body-sm mt-1"><?php echo e($message); ?></p>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<!-- Password Confirmation -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-password-confirm">
              Confirm Password <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-secondary <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="reg-password-confirm" placeholder="Repeat your password" required="" type="password" name="password_confirmation"/>
</div>

<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
<span>Create My Account</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</button>
</form>

<p class="font-body-sm text-body-sm text-outline text-center mt-6">
            Already a member?
<a class="text-primary font-bold underline" href="<?php echo e(route('login')); ?>">Sign In</a>
</p>
</section>

<!-- RIGHT COLUMN: Beauty Pass benefits (mirrors sign-in page promo column) -->
<section class="lg:col-span-6 flex flex-col gap-space-md">
<div class="bg-surface-container-lowest border border-outline-variant p-8">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-bold block mb-2">Beauty Pass Rewards</span>
<h3 class="font-headline-md text-headline-md font-serif text-primary mb-3">Why Join Sephora?</h3>
<ul class="space-y-4">
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">stars</span>
<div>
<p class="font-title-md text-title-md text-primary">Earn Points On Every Order</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Collect 1 point per 10 AED and unlock Black &amp; Gold VIP tiers.</p>
</div>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">local_shipping</span>
<div>
<p class="font-title-md text-title-md text-primary">Free Delivery Over 250 AED</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Complimentary standard shipping across the Emirates.</p>
</div>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">redeem</span>
<div>
<p class="font-title-md text-title-md text-primary">Exclusive Member Gifts</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Deluxe samples, birthday gifts and early access to launches.</p>
</div>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">favorite</span>
<div>
<p class="font-title-md text-title-md text-primary">Personal Wishlist</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Save your favourite products and shop them anytime.</p>
</div>
</li>
</ul>
</div>
</section>
</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/auth/register.blade.php ENDPATH**/ ?>