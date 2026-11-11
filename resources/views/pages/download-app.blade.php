@extends('layouts.app')

@section('title', __('meta.download_app'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-6 pb-space-xl">
<!-- 3. Breadcrumb Navigation -->
<nav aria-label="Breadcrumb" class="py-2 mb-6">
<ol class="flex items-center space-x-2 font-body-sm text-body-sm text-outline">
<li>
<a class="hover:text-primary transition-colors duration-150" href="/">{{ __('ui.home') }}</a>
</li>
<li class="select-none text-outline-variant">/</li>
<li class="text-primary font-bold">{{ __('content.t_a666c2c8a472') }}</li>
</ol>
</nav>
<!-- 4. Hero & Main Download Showcase Section -->
<section class="border border-primary bg-surface-container-lowest p-6 md:p-12 mb-space-xl">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-gutter items-center">
<!-- Left Column: Editorial Copy, Badges & CTA -->
<div class="lg:col-span-6 flex flex-col justify-center space-y-6">
<div class="inline-flex items-center gap-2">
<span class="bg-primary text-on-primary font-label-caps text-label-caps px-3 py-1 tracking-widest uppercase">
              {{ __('content.t_034cc4e8c54f') }}
            </span>
<span class="text-secondary font-label-tag text-label-tag font-bold tracking-widest">
              {{ __('content.t_214d73c05516') }}
            </span>
</div>
<div class="space-y-3">
<h1 class="font-headline-lg text-headline-lg font-bold text-primary tracking-tight">
              {{ __('content.t_a666c2c8a472') }}
            </h1>
<p class="font-headline-sm text-headline-sm text-on-surface-variant font-normal">
              {{ __('content.t_bd42cc0d10d0') }}
            </p>
</div>
<p class="font-body-md text-body-md text-outline">
            {{ __('content.t_8bd1c66f6503') }}
          </p>
<!-- Store Download Buttons -->
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-2">
<!-- App Store -->
<a class="flex items-center space-x-3 bg-primary text-on-primary px-6 py-3 min-h-[48px] hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors duration-150 group" href="https://apps.apple.com/ae/app/sephora-uae-beauty-make-up/id1472335881" rel="noopener noreferrer" target="_blank">
<svg class="w-6 h-6 fill-current" viewbox="0 0 24 24">
<path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.37c.61-.75 1.04-1.8 0.92-2.85-.9.04-2 .6-2.64 1.35-.56.64-1.06 1.7-0.93 2.73 1.02.08 2.04-.49 2.65-1.23z"></path>
</svg>
<div class="text-left">
<span class="block text-[10px] leading-none uppercase tracking-wider text-outline-variant group-hover:text-outline">{{ __('content.t_aa63e0133ebc') }}</span>
<span class="block font-bold text-sm tracking-wide">{{ __('content.t_c3e073423922') }}</span>
</div>
</a>
<!-- Google Play Store -->
<a class="flex items-center space-x-3 bg-primary text-on-primary px-6 py-3 min-h-[48px] hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors duration-150 group" href="https://play.google.com/store/apps/details?id=ae.sephora.sephorauae&amp;pli=1" rel="noopener noreferrer" target="_blank">
<svg class="w-6 h-6 fill-current" viewbox="0 0 24 24">
<path d="M3.609 1.814L13.792 12 3.61 22.186c-.37-.367-.61-.884-.61-1.46V3.274c0-.576.24-1.093.609-1.46zm11.266 11.268l2.368 2.368-11.45 6.611 9.082-8.979zm0-2.164L5.793 1.939l11.45 6.611-2.368 2.368zm1.488 1.082l3.864 2.231c.78.451.78 1.187 0 1.638l-3.864 2.231-2.227-2.227 2.227-2.227z"></path>
</svg>
<div class="text-left">
<span class="block text-[10px] leading-none uppercase tracking-wider text-outline-variant group-hover:text-outline">{{ __('content.t_b62795413faf') }}</span>
<span class="block font-bold text-sm tracking-wide">{{ __('content.t_da68b612ec36') }}</span>
</div>
</a>
</div>
<!-- Scan instruction notice -->
<div class="pt-4 border-t border-surface-container-high flex items-center space-x-3 text-outline">
<span class="material-symbols-outlined text-primary text-xl">qr_code_scanner</span>
<span class="font-body-sm text-body-sm">
              {{ __('content.t_37e3844efcf8') }}
            </span>
</div>
</div>
<!-- Right Column: Visual Showcase (Phone Mockup + QR Card) -->
<div class="lg:col-span-6 flex flex-col md:flex-row items-center justify-center gap-6">
<!-- Handheld App Mockup Image -->
<div class="relative w-full max-w-[280px] sm:max-w-[320px] aspect-[9/16] border border-primary bg-surface shadow-none overflow-hidden group">
<img alt="{{ __('content.t_0e7985700cf9') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_3946389e4113b552.jpg') }}"/>
<div class="absolute bottom-3 left-3 right-3 bg-surface-container-lowest/95 border border-primary p-2 text-center">
<span class="font-label-caps text-[9px] uppercase tracking-widest text-primary font-bold">
                {{ __('content.t_79bbf8bb03a6') }}
              </span>
</div>
</div>
<!-- Standalone Printed QR Scanner Card -->
<div class="w-full max-w-[260px] border border-primary bg-surface-container-lowest p-6 flex flex-col items-center text-center space-y-4">
<div class="w-full border-b border-primary pb-2">
<span class="font-display-hero text-title-md font-bold tracking-widest uppercase">SEPHORA</span>
<p class="font-label-caps text-[10px] text-outline tracking-wider uppercase mt-1">{{ __('content.t_04c443816dac') }}</p>
</div>
<!-- Authentic QR Code Image from Source Document -->
<div class="w-44 h-44 border border-outline-variant p-2 bg-surface-container-lowest flex items-center justify-center">
<img alt="{{ __('content.t_f76f31f196f2') }}" class="w-full h-full object-contain" src="{{ asset('images/content/img_9fc7f307517320b3.jpg') }}"/>
</div>
<div class="space-y-1">
<span class="font-title-md text-title-md font-bold block text-primary">{{ __('content.t_e018bd89ba70') }}</span>
<p class="font-body-sm text-body-sm text-outline leading-tight">
                {{ __('content.t_2ca69dc87f5b') }}
              </p>
</div>
<div class="flex items-center justify-center gap-2 pt-1 border-t border-outline-variant w-full">
<span class="font-label-caps text-[9px] text-primary">{{ __('content.t_7d370e7ec90f') }}</span>
</div>
</div>
</div>
</div>
</section>
<!-- 5. App Features & Value Propositions Grid (3 Pillars verbatim from document) -->
<section class="mb-space-xl">
<div class="text-center max-w-2xl mx-auto mb-10">
<span class="font-label-caps text-label-caps text-secondary tracking-widest uppercase font-bold block mb-1">
          {{ __('content.t_d38e0dc33b21') }}
        </span>
<h2 class="font-headline-md text-headline-md font-bold text-primary">
          {{ __('content.t_da534caff852') }}
        </h2>
<div class="w-12 h-0.5 bg-primary mx-auto mt-3"></div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Pillar 1 -->
<div class="border border-primary bg-surface-container-lowest p-8 flex flex-col justify-between hover:border-black transition-all duration-200">
<div class="space-y-4">
<div class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center">
<span class="material-symbols-outlined text-2xl">shopping_bag</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-primary">
              {{ __('content.t_6f2edc364eb3') }}
            </h3>
<p class="font-body-md text-body-md text-outline">
              {{ __('content.t_728fd95200d0') }}
            </p>
</div>
<div class="pt-6 mt-6 border-t border-outline-variant">
<span class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-widest flex items-center gap-1">
              {{ __('content.t_ffe7438d64c1') }} <span class="material-symbols-outlined text-sm">arrow_forward</span>
</span>
</div>
</div>
<!-- Pillar 2 -->
<div class="border border-primary bg-surface-container-lowest p-8 flex flex-col justify-between hover:border-black transition-all duration-200">
<div class="space-y-4">
<div class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center">
<span class="material-symbols-outlined text-2xl">stars</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-primary">
              {{ __('content.t_996243a842d5') }}
            </h3>
<p class="font-body-md text-body-md text-outline">
              {{ __('content.t_a28d4b818632') }}
            </p>
</div>
<div class="pt-6 mt-6 border-t border-outline-variant">
<span class="font-label-caps text-label-caps text-secondary uppercase font-bold tracking-widest flex items-center gap-1">
              {{ __('content.t_b5daaf54366c') }} <span class="material-symbols-outlined text-sm">notifications</span>
</span>
</div>
</div>
<!-- Pillar 3 -->
<div class="border border-primary bg-surface-container-lowest p-8 flex flex-col justify-between hover:border-black transition-all duration-200">
<div class="space-y-4">
<div class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center">
<span class="material-symbols-outlined text-2xl">location_on</span>
</div>
<h3 class="font-title-lg text-title-lg font-bold text-primary">
              {{ __('content.t_956e3b90b58e') }}
            </h3>
<p class="font-body-md text-body-md text-outline">
              {{ __('content.t_aa60b00aba53') }}
            </p>
</div>
<div class="pt-6 mt-6 border-t border-outline-variant">
<span class="font-label-caps text-label-caps text-primary uppercase font-bold tracking-widest flex items-center gap-1">
              {{ __('content.t_f6f2bb183463') }} <span class="material-symbols-outlined text-sm">arrow_forward</span>
</span>
</div>
</div>
</div>
</section>
<!-- 6. Additional App Exclusive Perks Bento Section -->
<section class="border border-outline-variant bg-surface-container-low p-8 md:p-12 mb-space-xl">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-4 border-b border-outline-variant">
<div>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">{{ __('content.t_bae2d3e297b5') }}</span>
<h2 class="font-headline-sm text-headline-sm font-bold text-primary mt-1">{{ __('content.t_f5c5f732a954') }}</h2>
</div>
<p class="font-body-sm text-body-sm text-outline mt-2 md:mt-0">{{ __('content.t_5ed1f33e2c44') }}</p>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Perk 1 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 space-y-3">
<span class="material-symbols-outlined text-primary text-3xl">card_membership</span>
<h4 class="font-title-md text-title-md font-bold text-primary">{{ __('content.t_73ae70805755') }}</h4>
<p class="font-body-sm text-body-sm text-outline">
            {{ __('content.t_3da4c69cb419') }}
          </p>
</div>
<!-- Perk 2 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 space-y-3">
<span class="material-symbols-outlined text-primary text-3xl">local_shipping</span>
<h4 class="font-title-md text-title-md font-bold text-primary">{{ __('content.t_671242deb7ea') }}</h4>
<p class="font-body-sm text-body-sm text-outline">
            {{ __('content.t_d0b5c47a49d6') }}
          </p>
</div>
<!-- Perk 3 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 space-y-3">
<span class="material-symbols-outlined text-secondary text-3xl">redeem</span>
<h4 class="font-title-md text-title-md font-bold text-primary">{{ __('content.t_dd8a4ed7089d') }}</h4>
<p class="font-body-sm text-body-sm text-outline">
            {{ __('content.t_7f85c0520d60') }}
          </p>
</div>
<!-- Perk 4 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 space-y-3">
<span class="material-symbols-outlined text-primary text-3xl">face_retouching_natural</span>
<h4 class="font-title-md text-title-md font-bold text-primary">{{ __('content.t_e1a7df033843') }}</h4>
<p class="font-body-sm text-body-sm text-outline">
            {{ __('content.t_02f44fcb7d5e') }}
          </p>
</div>
</div>
</section>
<!-- 7. Trust & Service Badges (Strictly from Reference Document) -->
<section class="border-t border-b border-primary py-8 mb-space-xl">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
<!-- Badge 1 -->
<div class="flex flex-col items-center space-y-2 border-r border-outline-variant last:border-r-0">
<span class="material-symbols-outlined text-3xl text-primary">local_shipping</span>
<span class="font-title-md text-title-md font-bold text-primary uppercase">{{ __('ui.free_delivery') }}</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('content.t_d76dbfd4ac0b') }}</span>
</div>
<!-- Badge 2 -->
<div class="flex flex-col items-center space-y-2 border-r border-outline-variant last:border-r-0">
<span class="material-symbols-outlined text-3xl text-primary">verified</span>
<span class="font-title-md text-title-md font-bold text-primary uppercase">{{ __('ui.authentic') }}</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('content.t_f6a7f330b15f') }}</span>
</div>
<!-- Badge 3 -->
<div class="flex flex-col items-center space-y-2 border-r border-outline-variant last:border-r-0">
<span class="material-symbols-outlined text-3xl text-primary">sync_alt</span>
<span class="font-title-md text-title-md font-bold text-primary uppercase">{{ __('ui.easy_returns') }}</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('content.t_de87fa640461') }}</span>
</div>
<!-- Badge 4 -->
<div class="flex flex-col items-center space-y-2">
<span class="material-symbols-outlined text-3xl text-primary">support_agent</span>
<span class="font-title-md text-title-md font-bold text-primary uppercase">{{ __('ui.customer_service') }}</span>
<span class="font-body-sm text-body-sm text-outline">{{ __('content.t_bd7a0626d36d') }}</span>
</div>
</div>
</section>
<!-- 8. Newsletter Subscription Banner -->
<section class="bg-surface-container-lowest border border-primary p-8 md:p-12 mb-space-xl">
<div class="max-w-3xl mx-auto text-center space-y-6">
<span class="material-symbols-outlined text-4xl text-primary">mail</span>
<h3 class="font-headline-md text-headline-md font-bold text-primary">
          {{ __('content.t_518c2ee6743f') }}
        </h3>
<p class="font-body-md text-body-md text-outline">
          {{ __('content.t_723b4f888160') }}
        </p>
<form class="flex flex-col sm:flex-row items-center justify-center gap-3 max-w-lg mx-auto" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="w-full sm:flex-1 px-4 py-3 bg-surface-container-lowest border border-outline font-body-sm text-body-sm text-primary placeholder:text-outline focus:outline-none focus:border-primary rounded-none min-h-[48px]" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="w-full sm:w-auto bg-primary text-on-primary font-label-caps text-label-caps px-8 py-3 min-h-[48px] hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors duration-150 uppercase tracking-widest font-bold" type="submit">
            Subscribe
          </button>
</form>
<p class="font-body-sm text-[11px] text-outline">
          {{ __('content.t_d6d3c873f736') }}
        </p>
</div>
</section>
</main>
<!-- 9. Full Sephora UAE Footer (Strictly following Footer Shared Component JSON) -->
@endsection
