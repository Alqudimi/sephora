@extends('layouts.app')

@section('title', 'Forgot Password | SEPHORA UAE')
@section('body_class', 'bg-background text-on-surface antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col justify-between font-body-md text-body-md')

@section('content')
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl">
<div class="max-w-xl mx-auto">
<nav class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider mb-8">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<a class="hover:text-primary transition-colors" href="{{ route('login') }}">Sign In</a>
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

@if (session('reset_link_sent'))
<div class="border border-secondary bg-surface-container-low p-4 mb-6 flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px]">mark_email_read</span>
<p class="font-body-sm text-body-sm text-primary">
                If an account exists for this email, a reset link has been sent. Please check your inbox and spam folder.
              </p>
</div>
@endif

<form class="space-y-6" method="POST" action="{{ route('password.email') }}">
@csrf
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="forgot-email">
              Email Address <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('email') border-secondary @enderror" id="forgot-email" placeholder="name@domain.com" required="" type="email" name="email" value="{{ old('email') }}"/>
@error('email')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
<span>Send Reset Link</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</button>
</form>

<p class="font-body-sm text-body-sm text-outline text-center mt-6">
<a class="text-primary font-bold underline" href="{{ route('login') }}">Back to Sign In</a>
</p>
</section>
</div>
</main>
@endsection
