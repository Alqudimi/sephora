@extends('layouts.app')

@section('title', __('messages.auth.login') . ' | ' . __('messages.app_name'))
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

<!-- ========================================================= -->
<!-- 3. BREADCRUMBS                                            -->
<!-- ========================================================= -->
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-6 pb-2">
<nav class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider">
<a class="hover:text-primary transition-colors" href="/">{{ __('messages.home') }}</a>
<span>/</span>
<span class="text-primary font-bold">{{ __('messages.auth.login') }}</span>
</nav>
</div>
<!-- ========================================================= -->
<!-- 4. PAGE HEADER & TITLE                                    -->
<!-- ========================================================= -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin text-center pt-6 pb-10">
<div class="inline-block mb-3">
<span class="font-label-caps text-label-caps uppercase tracking-[0.2em] text-outline border-b border-outline-variant pb-1">
        {{ __('messages.client_concierge') }}
      </span>
</div>
<h1 class="font-headline-lg text-headline-lg lg:text-display-hero text-primary tracking-tight font-serif mb-4">
      {{ __('messages.auth.welcome_back') }}
    </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto font-normal">
      {{ __('messages.auth.sign_in_intro') }}
    </p>
</section>
<!-- ========================================================= -->
<!-- 5. MAIN CONTENT - DUAL COLUMN SPLIT                      -->
<!-- ========================================================= -->
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin mb-space-xl">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
<!-- LEFT COLUMN: Client Sign In -->
<section class="lg:col-span-6 bg-surface-container-lowest p-8 md:p-12 border border-primary relative">
<div class="mb-8">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-1">
            {{ __('messages.auth.registered_member') }}
          </span>
<h2 class="font-headline-md text-headline-md font-serif text-primary">
            {{ __('messages.auth.sign_in_account') }}
          </h2>
<p class="font-body-md text-body-md text-outline mt-1">
            {{ __('messages.auth.enter_credentials') }}
          </p>
</div>
<form class="space-y-6" method="POST" action="{{ route('login.attempt') }}">
@csrf
@if(session('status'))<p class="text-secondary font-body-sm">{{ session('status') }}</p>@endif
@if(session('password_reset'))<p class="text-secondary font-body-sm mb-2">{{ __('content.t_89f53f9f0d0a') }}</p>@endif
@auth
<meta http-equiv="refresh" content="0;url={{ route('account.dashboard') }}"/>
@endauth
<!-- Email Input -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="signin-email">
              {{ __('messages.email') }} <span class="text-secondary">*</span>
</label>
<div class="relative">
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant" id="signin-email" placeholder="name@domain.com" required="" type="email" name="email" value="{{ old('email') }}"/>
</div>
</div>
<!-- Password Input -->
<div>
<div class="flex items-center justify-between mb-2">
<label class="font-label-caps text-label-caps uppercase text-on-surface tracking-wider" for="signin-password">
                {{ __('messages.password') }} <span class="text-secondary">*</span>
</label>
<a class="font-label-caps text-label-caps text-outline hover:text-primary underline tracking-wider transition-colors" href="{{ route('password.request') }}">
                {{ __('messages.auth.forgot_password') }}
              </a>
</div>
<div class="relative">
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant" id="signin-password" placeholder="••••••••••••" required="" type="password" name="password"/>
</div>
</div>
<!-- Checkbox Options -->
<div class="flex items-center justify-between pt-1">
<label class="flex items-center gap-3 cursor-pointer group select-none">
<input class="w-4 h-4 rounded-none border border-outline text-primary focus:ring-0 focus:ring-offset-0 cursor-pointer checked:bg-primary checked:border-primary" type="checkbox" name="remember" value="1" />
<span class="font-body-sm text-body-sm text-on-surface-variant group-hover:text-primary transition-colors">
                {{ __('messages.auth.remember_me') }}
              </span>
</label>
</div>
<!-- Primary Submit Button -->
@if ($errors->any())
    <div class="bg-error-container text-on-error-container px-4 py-3 font-body-sm space-y-1">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    @if (session('auth_error'))
    <div class="bg-error-container text-on-error-container px-4 py-3 font-body-sm">{{ session('auth_error') }}</div>
    @endif
<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
<span>{{ __('messages.auth.login') }}</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</button>
</form>
<!-- Social Divider -->
<div class="relative my-8">
<div class="absolute inset-0 flex items-center">
<div class="w-full border-t border-outline-variant"></div>
</div>
<div class="relative flex justify-center text-center">
<span class="bg-surface-container-lowest px-4 font-label-caps text-label-caps uppercase tracking-wider text-outline">
              {{ __('messages.auth.or_sign_in_with') }}
            </span>
</div>
</div>
<!-- Social Buttons -->
<div class="grid grid-cols-2 gap-4">
<button class="h-12 border border-outline-variant hover:border-primary bg-surface-container-lowest flex items-center justify-center gap-2 font-label-caps text-label-caps text-primary uppercase tracking-wider transition-colors cursor-pointer" type="button">
<svg class="w-4 h-4 fill-current" viewbox="0 0 170 170">
<path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.75 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.35.13-9.16-1.9-14.42-6.08-3.69-3.04-7.67-7.79-11.93-14.25-5.87-8.91-10.45-19.16-13.73-30.74-3.28-11.59-4.92-22.39-4.92-32.41 0-14.34 3.73-26.31 11.19-35.91 7.46-9.6 16.71-14.54 27.75-14.81 4.79 0 10.37 1.34 16.76 4.02 6.39 2.68 10.34 4.09 11.86 4.23 1.94-.37 6.06-1.85 12.35-4.44 6.29-2.6 11.75-3.8 16.38-3.6 12.06.66 21.72 5.08 28.98 13.27-10.63 6.43-15.82 15.26-15.58 26.5.25 8.78 3.65 16.14 10.2 22.08 6.55 5.94 14.34 9.4 23.36 10.37-2.45 7.47-5.59 15.26-9.41 23.38zM119.22 31.81c0-7.39 2.64-14.29 7.92-20.7 5.28-6.41 11.83-10.36 19.65-11.85.25 1.01.37 2.08.37 3.22 0 7.23-2.77 14.25-8.31 21.05-5.54 6.8-12.06 10.74-19.56 11.82-.07-1.1-.07-2.28-.07-3.54z"></path>
</svg>
<span>{{ __('messages.auth.apple') }}</span>
</button>
<button class="h-12 border border-outline-variant hover:border-primary bg-surface-container-lowest flex items-center justify-center gap-2 font-label-caps text-label-caps text-primary uppercase tracking-wider transition-colors cursor-pointer" type="button">
<svg class="w-4 h-4 fill-current" viewbox="0 0 24 24">
<path d="M12.24 10.285V13.4h6.887C18.2 16.038 15.56 18 12.24 18c-3.315 0-6-2.685-6-6s2.685-6 6-6c1.656 0 3.16.678 4.248 1.774l2.368-2.368C17.392 3.864 14.992 3 12.24 3 7.27 3 3.24 7.03 3.24 12s4.03 9 9 9c5.228 0 8.71-3.674 8.71-8.868 0-.61-.06-1.196-.16-1.847H12.24z"></path>
</svg>
<span>{{ __('messages.auth.google') }}</span>
</button>
</div>
<p class="font-body-sm text-body-sm text-outline text-center mt-6">
          {!! __('messages.auth.agree_terms_policy', [
              'terms' => '<a class="underline text-on-surface hover:text-secondary" href="' . route('terms') . '">' . __('messages.terms') . '</a>',
              'privacy' => '<a class="underline text-on-surface hover:text-secondary" href="' . route('terms') . '#privacy">' . __('messages.privacy') . '</a>',
          ]) !!}
        </p>
<p class="font-body-sm text-body-sm text-outline text-center mt-3">
          {{ __('messages.auth.new_to_sephora') }}
<a class="text-primary font-bold underline" href="{{ route('register') }}">{{ __('messages.auth.create_account') }}</a>
</p>
</section>
<!-- RIGHT COLUMN: Join MY SEPHORA (Card Vitrine Showcase) -->
<section class="lg:col-span-6 bg-surface-container-low p-8 md:p-12 border border-outline-variant flex flex-col justify-between h-full">
<div>
<!-- Header and Loyalty Badge -->
<div class="flex items-center justify-between border-b border-outline-variant pb-6 mb-8">
<div>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold block mb-1">
                {{ __('messages.auth.new_to_sephora') }}
              </span>
<h2 class="font-headline-md text-headline-md font-serif text-primary">
                {{ __('messages.auth.join_sephora') }}
              </h2>
</div>
<span class="bg-primary text-tertiary-fixed-dim px-3 py-1 font-label-caps text-label-caps uppercase tracking-widest font-bold">
              {{ __('messages.auth.vip_privileges') }}
            </span>
</div>
<!-- Luxury Beauty Pass Physical Card Vitrine using the provided reference Image -->
<div class="relative w-full mb-8 bg-surface-container p-4 border border-outline-variant group overflow-hidden">
<div class="relative aspect-[16/10] overflow-hidden bg-surface-container-highest">
<img alt="{{ __('content.t_7d1503948035') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_4c436417accfce85.jpg') }}"/>
</div>
<div class="mt-3 flex items-center justify-between font-label-tag text-label-tag uppercase tracking-widest text-outline">
<span>{{ __('messages.auth.beauty_pass_card') }}</span>
<span class="text-primary font-bold">{{ __('messages.auth.black_gold_tiers') }}</span>
</div>
</div>
<!-- Benefits List -->
<div class="space-y-6 mb-8">
<h3 class="font-title-lg text-title-lg text-primary tracking-wide">
              {{ __('messages.auth.unlock_privileges') }}
            </h3>
<!-- Benefit 1 -->
<div class="flex items-start gap-4">
<div class="w-8 h-8 rounded-none bg-primary text-on-primary flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-[18px]">verified</span>
</div>
<div>
<h4 class="font-title-md text-title-md text-primary font-bold">{{ __('messages.auth.benefit1_title') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                  {{ __('messages.auth.benefit1_desc') }}
                </p>
</div>
</div>
<!-- Benefit 2 -->
<div class="flex items-start gap-4">
<div class="w-8 h-8 rounded-none bg-primary text-on-primary flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-[18px]">featured_seasonal_and_gifts</span>
</div>
<div>
<h4 class="font-title-md text-title-md text-primary font-bold">{{ __('messages.auth.benefit2_title') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                  {{ __('messages.auth.benefit2_desc') }}
                </p>
</div>
</div>
<!-- Benefit 3 -->
<div class="flex items-start gap-4">
<div class="w-8 h-8 rounded-none bg-primary text-on-primary flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-[18px]">workspace_premium</span>
</div>
<div>
<h4 class="font-title-md text-title-md text-primary font-bold">{{ __('messages.auth.benefit3_title') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                  {{ __('messages.auth.benefit3_desc') }}
                </p>
</div>
</div>
</div>
</div>
<!-- Call to Action -->
<div>
<a class="w-full h-12 bg-surface-container-lowest text-primary border border-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-primary hover:text-on-primary transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer mb-6" href="{{ route('register') }}">
<span>{{ __('messages.auth.create_account') }}</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</a>
<!-- Guest Order Lookup -->
<div class="pt-6 border-t border-outline-variant flex flex-col sm:flex-row items-center justify-between text-center sm:text-left gap-2">
<div>
<span class="font-label-caps text-label-caps uppercase text-on-surface font-bold block">{{ __('messages.auth.guest_checkout_lookup') }}</span>
<p class="font-body-sm text-body-sm text-outline">{{ __('messages.auth.guest_order_question') }}</p>
</div>
<a class="font-label-caps text-label-caps uppercase tracking-wider text-primary hover:text-secondary underline whitespace-nowrap" href="{{ route('home') }}">
              {{ __('messages.auth.track_guest_order') }} →
            </a>
</div>
</div>
</section>
</div>
</main>
<!-- ========================================================= -->
<!-- 6. TRUST & COMMITMENT BADGES                              -->
<!-- ========================================================= -->
<section class="w-full bg-surface-container-lowest border-y border-outline-variant py-8">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
<!-- Feature 1 -->
<div class="flex items-center gap-4">
<div class="w-12 h-12 border border-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-[24px]">local_shipping</span>
</div>
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">{{ __('messages.free_delivery') }}</h4>
<p class="font-body-sm text-body-sm text-outline">{{ __('messages.product.standard_delivery_text') }}</p>
</div>
</div>
<!-- Feature 2 -->
<div class="flex items-center gap-4">
<div class="w-12 h-12 border border-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-[24px]">verified_user</span>
</div>
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">{{ __('messages.authentic_guarantee') }}</h4>
<p class="font-body-sm text-body-sm text-outline">{{ __('messages.checkout.authentic_guarantee') }}</p>
</div>
</div>
<!-- Feature 3 -->
<div class="flex items-center gap-4">
<div class="w-12 h-12 border border-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-[24px]">swap_horiz</span>
</div>
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">{{ __('messages.easy_returns') }}</h4>
<p class="font-body-sm text-body-sm text-outline">{{ __('messages.product.free_returns_text') }}</p>
</div>
</div>
<!-- Feature 4 -->
<div class="flex items-center gap-4">
<div class="w-12 h-12 border border-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-[24px]">support_agent</span>
</div>
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">{{ __('messages.client_concierge') }}</h4>
<p class="font-body-sm text-body-sm text-outline">{{ __('messages.checkout.concierge') }}</p>
</div>
</div>
</div>
</section>

@endsection
