@extends('layouts.app')

@section('title', __('messages.auth.reset_password') . ' | ' . __('messages.app_name'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl">
<div class="max-w-xl mx-auto">
<nav class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider mb-8">
<a class="hover:text-primary transition-colors" href="/">{{ __('messages.home') }}</a>
<span>/</span>
<a class="hover:text-primary transition-colors" href="{{ route('login') }}">{{ __('messages.auth.login') }}</a>
<span>/</span>
<span class="text-primary font-bold">{{ __('messages.auth.reset_password') }}</span>
</nav>

<section class="bg-surface-container-lowest p-8 md:p-12 border border-primary">
<div class="mb-8">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-1">
            {{ __('messages.account.change_password') }}
          </span>
<h1 class="font-headline-md text-headline-md font-serif text-primary">
            {{ __('messages.auth.reset_password') }}
          </h1>
<p class="font-body-md text-body-md text-outline mt-1">
            {{ __('messages.auth.reset_intro') }}
          </p>
</div>

<form class="space-y-6" method="POST" action="{{ route('password.update') }}">
@csrf
<input type="hidden" name="token" value="{{ $token }}"/>

<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reset-email">
              {{ __('messages.auth.email') }} <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('email') border-secondary @enderror" id="reset-email" placeholder="name@domain.com" required="" type="email" name="email" value="{{ old('email', $email) }}"/>
@error('email')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reset-password">
              {{ __('messages.account.new_password') }} <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('password') border-secondary @enderror" id="reset-password" placeholder="••••••••" required="" type="password" name="password"/>
@error('password')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reset-password-confirm">
              {{ __('messages.auth.confirm_password') }} <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant" id="reset-password-confirm" placeholder="••••••••" required="" type="password" name="password_confirmation"/>
</div>

<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
<span>{{ __('messages.auth.update_password') }}</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</button>
</form>

@if (session('password_reset'))
<div class="border border-secondary bg-surface-container-low p-4 mt-6 flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px]">check_circle</span>
<p class="font-body-sm text-body-sm text-primary">
                {{ __('messages.account.settings_saved_notice') }}
              </p>
</div>
@endif
</section>
</div>
</main>
@endsection
