@extends('layouts.app')

@section('title', 'Reset Password | SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl">
<div class="max-w-xl mx-auto">
<nav class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider mb-8">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<a class="hover:text-primary transition-colors" href="{{ route('login') }}">Sign In</a>
<span>/</span>
<span class="text-primary font-bold">Reset Password</span>
</nav>

<section class="bg-surface-container-lowest p-8 md:p-12 border border-primary">
<div class="mb-8">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-1">
            Choose a New Password
          </span>
<h1 class="font-headline-md text-headline-md font-serif text-primary">
            Reset Your Password
          </h1>
<p class="font-body-md text-body-md text-outline mt-1">
            Create a new password for your Beauty Pass account. Minimum 8 characters.
          </p>
</div>

<form class="space-y-6" method="POST" action="{{ route('password.update') }}">
@csrf
<input type="hidden" name="token" value="{{ $token }}"/>

<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reset-email">
              Email Address <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('email') border-secondary @enderror" id="reset-email" placeholder="name@domain.com" required="" type="email" name="email" value="{{ old('email', $email) }}"/>
@error('email')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reset-password">
              New Password <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('password') border-secondary @enderror" id="reset-password" placeholder="Minimum 8 characters" required="" type="password" name="password"/>
@error('password')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reset-password-confirm">
              Confirm New Password <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant" id="reset-password-confirm" placeholder="Repeat your new password" required="" type="password" name="password_confirmation"/>
</div>

<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
<span>Update Password</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</button>
</form>

@if (session('password_reset'))
<div class="border border-secondary bg-surface-container-low p-4 mt-6 flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px]">check_circle</span>
<p class="font-body-sm text-body-sm text-primary">
                Your password has been updated. You can now sign in with your new password.
              </p>
</div>
@endif
</section>
</div>
</main>
@endsection
