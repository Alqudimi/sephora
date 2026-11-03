<?php $__env->startSection('title', 'Forgot Password | SEPHORA UAE'); ?>
<?php $__env->startSection('body_class', 'bg-background text-on-surface antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col justify-between font-body-md text-body-md'); ?>

<?php $__env->startSection('content'); ?>
<!-- TOP ANNOUNCEMENT BAR -->
<aside class="w-full bg-primary text-on-primary py-2.5 px-4 text-center select-none relative z-50">
<div class="max-w-[1440px] mx-auto flex items-center justify-center gap-2">
<p class="font-label-caps text-label-caps uppercase tracking-widest text-[11px] text-on-primary">
        SEPHORA CLIENT CONCIERGE - PASSWORD ASSISTANCE
</p>
</div>
</aside>

<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl">
<div class="max-w-xl mx-auto">
<nav class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider mb-8">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<a class="hover:text-primary transition-colors" href="<?php echo e(route('login')); ?>">Sign In</a>
<span>/</span>
<span class="text-primary font-bold">Forgot Password</span>
</nav>

<section class="bg-surface-container-lowest p-8 md:p-12 border border-primary">
<div class="mb-8">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-1">
            Password Recovery
          </span>
<h1 class="font-headline-md text-headline-md font-serif text-primary">
            Reset Your Password
          </h1>
<p class="font-body-md text-body-md text-outline mt-1">
            Enter the email address linked to your Beauty Pass account and we will send you a secure reset link.
          </p>
</div>

<?php if(session('reset_link_sent')): ?>
<div class="border border-secondary bg-surface-container-low p-4 mb-6 flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px]">mark_email_read</span>
<p class="font-body-sm text-body-sm text-primary">
                If an account exists for this email, a reset link has been sent. Please check your inbox and spam folder.
              </p>
</div>
<?php endif; ?>

<form class="space-y-6" method="POST" action="<?php echo e(route('password.email')); ?>">
<?php echo csrf_field(); ?>
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="forgot-email">
              Email Address <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-secondary <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="forgot-email" placeholder="name@domain.com" required="" type="email" name="email" value="<?php echo e(old('email')); ?>"/>
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

<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
<span>Send Reset Link</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</button>
</form>

<p class="font-body-sm text-body-sm text-outline text-center mt-6">
<a class="text-primary font-bold underline" href="<?php echo e(route('login')); ?>">Back to Sign In</a>
</p>
</section>
</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>