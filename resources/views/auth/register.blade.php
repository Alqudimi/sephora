@extends('layouts.app')

@section('title', __('messages.auth.register') . ' | ' . __('messages.app_name'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
<style>
.material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }
    input:focus {
      outline: none !important;
    }
</style>
@endsection

@section('content')
<!-- BREADCRUMB -->
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-6 pb-2">
<nav class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider">
<a class="hover:text-primary transition-colors" href="/">{{ __('messages.home') }}</a>
<span>/</span>
<span class="text-primary font-bold">{{ __('messages.auth.register') }}</span>
</nav>
</div>

<!-- PAGE HEADER -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin text-center pt-6 pb-10">
<div class="inline-block mb-3">
<span class="font-label-caps text-label-caps uppercase tracking-[0.2em] text-outline border-b border-outline-variant pb-1">
        {{ __('messages.homepage.loyalty_heading') }}
      </span>
</div>
<h1 class="font-headline-lg text-headline-lg lg:text-display-hero text-primary tracking-tight font-serif mb-4">
      {{ __('messages.auth.join_sephora') }}
    </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto font-normal">
      {{ __('messages.auth.join_intro') }}
    </p>
</section>

<!-- MAIN CONTENT -->
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin mb-space-xl">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-{{ __('ui.items_count_label', ['count' => '12']) }}-start">

<!-- LEFT COLUMN: Registration Form -->
<section class="lg:col-span-6 bg-surface-container-lowest p-8 md:p-12 border border-primary relative">
<div class="mb-8">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-1">
            {{ __('messages.auth.new_member') }}
          </span>
<h2 class="font-headline-md text-headline-md font-serif text-primary">
            {{ __('messages.auth.create_account_heading') }}
          </h2>
<p class="font-body-md text-body-md text-outline mt-1">
            {{ __('messages.auth.complete_form') }}
          </p>
</div>

<form class="space-y-6" method="POST" action="{{ route('register.store') }}">
@csrf

<!-- Name -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-name">
              {{ __('messages.auth.full_name') }} <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('name') border-secondary @enderror" id="reg-name" placeholder="{{ __('content.t_d9047642f7c4') }}" required="" type="text" name="name" value="{{ old('name') }}"/>
@error('name')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<!-- Email -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-email">
              {{ __('messages.email') }} <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('email') border-secondary @enderror" id="reg-email" placeholder="{{ __('ui.email_placeholder') }}" required="" type="email" name="email" value="{{ old('email') }}"/>
@error('email')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<!-- Phone -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-phone">
              {{ __('messages.phone') }} <span class="text-outline font-body-sm">({{ __('messages.optional') }})</span>
</label>
<div class="flex">
<span class="inline-flex items-center px-3 border border-r-0 border-outline bg-surface-container-low font-body-md text-on-surface">+971</span>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('phone') border-secondary @enderror" id="reg-phone" placeholder="50 123 4567" type="tel" name="phone" value="{{ old('phone') }}"/>
</div>
@error('phone')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<!-- Password -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-password">
              {{ __('messages.password') }} <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('password') border-secondary @enderror" id="reg-password" placeholder="{{ __('content.t_77c6662e8b7e') }}" required="" type="password" name="password"/>
@error('password')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror
</div>

<!-- Password Confirmation -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="reg-password-confirm">
              {{ __('messages.auth.confirm_password') }} <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant @error('password') border-secondary @enderror" id="reg-password-confirm" placeholder="{{ __('content.t_148c22e8997d') }}" required="" type="password" name="password_confirmation"/>
</div>

<!-- Marketing opt-in -->
<label class="flex items-start gap-3 cursor-pointer">
<input class="mt-1 w-4 h-4 rounded-none border border-outline text-primary focus:ring-0 focus:ring-offset-0 cursor-pointer checked:bg-primary checked:border-primary" name="marketing_email" type="checkbox" value="1" @checked(old('marketing_email'))/>
<span class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_3a842a4264ac') }} <span class="text-outline">({{ __('messages.optional') }})</span></span>
</label>
@error('marketing_email')
<p class="text-secondary font-body-sm mt-1">{{ $message }}</p>
@enderror

<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
<span>{{ __('messages.auth.register') }}</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</button>
</form>

<p class="font-body-sm text-body-sm text-outline text-center mt-6">
            {{ __('messages.auth.already_member') }}
<a class="text-primary font-bold underline" href="{{ route('login') }}">{{ __('messages.auth.sign_in') }}</a>
</p>
</section>

<!-- RIGHT COLUMN: Beauty Pass benefits (mirrors sign-in page promo column) -->
<section class="lg:col-span-6 flex flex-col gap-space-md">
<div class="bg-surface-container-lowest border border-outline-variant p-8">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-bold block mb-2">{{ __('content.t_b981967c7b0f') }}</span>
<h3 class="font-headline-md text-headline-md font-serif text-primary mb-3">{{ __('content.t_9f1cd69770f7') }}</h3>
<ul class="space-y-4">
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">stars</span>
<div>
<p class="font-title-md text-title-md text-primary">{{ __('content.t_7cc129adfcd2') }}</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_b83cffbbfc96') }}</p>
</div>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">local_shipping</span>
<div>
<p class="font-title-md text-title-md text-primary">{{ __('content.t_1dbbd1b188cb') }}</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_cb5e4595303f') }}</p>
</div>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">redeem</span>
<div>
<p class="font-title-md text-title-md text-primary">{{ __('content.t_70b0687bf8c8') }}</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_aafbfb380b59') }}</p>
</div>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">favorite</span>
<div>
<p class="font-title-md text-title-md text-primary">{{ __('content.t_f49818b2bf68') }}</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_cb2ca6151efd') }}</p>
</div>
</li>
</ul>
</div>
</section>
</div>
</main>
@endsection
