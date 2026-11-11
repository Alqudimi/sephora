@extends('layouts.app')

@section('title', __('messages.auth.forgot_password') . ' | ' . __('messages.app_name'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl">
<div class="max-w-xl mx-auto">
<nav class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider mb-8">
<a class="hover:text-primary transition-colors" href="/">{{ __('messages.home') }}</a>
<span>/</span>
<a class="hover:text-primary transition-colors" href="{{ route('login') }}">{{ __('messages.auth.login') }}</a>
<span>/</span>
<span class="text-primary font-bold">{{ __('messages.auth.forgot_password') }}</span>
</nav>

<section class="bg-surface-container-lowest p-8 md:p-12 border border-primary">
<div class="mb-8">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-1">
            {{ __('messages.auth.reset_password') }}
          </span>
<h1 class="font-headline-md text-headline-md font-serif text-primary">
            {{ __('messages.auth.reset_password') }}
          </h1>
<p class="font-body-md text-body-md text-outline mt-1">
            {{ __('messages.auth.reset_intro') }}
          </p>
</div>

@if (session('reset_link_sent'))
<div class="border border-secondary bg-surface-container-low p-4 mb-6 flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px]">mark_email_read</span>
<p class="font-body-sm text-body-sm text-primary">
                {{ __('messages.auth.reset_link_sent') }}
              </p>
</div>
@endif

<form class="space-y-6" method="POST" action="{{ route('password.email') }}">
@csrf
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="forgot-email">
              {{ __('messages.auth.email') }} <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('email') border-secondary @enderror" id="forgot-email" placeholder="{{ __('ui.email_placeholder') }}" required="" type="email" name="email" value="{{ old('email') }}"/>
@error('email')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
<span>{{ __('messages.auth.send_reset_link') }}</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</button>
</form>

<p class="font-body-sm text-body-sm text-outline text-center mt-6">
<a class="text-primary font-bold underline" href="{{ route('login') }}">{{ __('messages.auth.back_to_sign_in') }}</a>
</p>
</section>
</div>
</main>
@endsection
