@extends('layouts.app')

@section('title', __('meta.terms'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- 3. BREADCRUMBS & LUXURY HERO INTRO -->
<section class="w-full bg-surface-container-low border-b border-outline-variant">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8 md:py-12">
<!-- Breadcrumb row -->
<nav aria-label="{{ __('ui.breadcrumb') }}" class="flex items-center space-x-2 text-body-sm font-body-sm text-on-surface-variant mb-6">
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-bold">{{ __('content.t_d35f2b98edf8') }}</span>
</nav>
<div class="max-w-4xl">
<!-- Tag & Overline -->
<div class="flex items-center gap-3 mb-3">
<span class="bg-primary text-on-primary font-label-tag text-label-tag px-2.5 py-1 uppercase tracking-widest">
            {{ __('content.t_b28c1814c518') }}
          </span>
<span class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest text-[11px]">
            {{ __('content.t_24f81de297d5') }}
          </span>
</div>
<!-- Headline -->
<h1 class="font-headline-lg text-headline-lg text-primary tracking-tight mb-4">
          {{ __('content.t_d35f2b98edf8') }}
        </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-6">
          {{ __('content.t_f5f12504f902') }}
        </p>
<!-- Meta badges & tab switcher -->
<div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-outline-variant">
<div class="flex items-center space-x-2 text-body-sm font-body-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[18px] text-primary" data-icon="schedule">schedule</span>
<span>{{ __('content.t_c26d954c5197') }} <strong class="text-primary">{{ __('ui.january_2025') }}</strong></span>
<span class="text-outline-variant">•</span>
<span>{{ __('ui.region_label') }} <strong class="text-primary">{{ __('content.long_4ec77db26501) }}</strong></span>
</div>
<!-- Section Switcher Pills -->
<div class="flex items-center border border-primary p-0.5 bg-surface-container-lowest">
<a class="px-4 py-1.5 font-label-caps text-label-caps tracking-widest uppercase bg-primary text-on-primary font-bold transition-all" href="#terms-of-use">
              {{ __('content.t_97738411d629') }}
            </a>
<a class="px-4 py-1.5 font-label-caps text-label-caps tracking-widest uppercase text-primary hover:bg-surface-container transition-all" href="#terms-of-sale">
              {{ __('content.t_1e0a1aad71b0') }}
            </a>
</div>
</div>
</div>
</div>
</section>
<!-- 4. MAIN CONTENT LAYOUT: DUAL-COLUMN ARCHITECTURAL GRID -->
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-10 md:py-16">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-{{ __('ui.items_count_label', ['count' => '12']) }}-start">
<!-- LEFT COLUMN: STICKY TABLE OF CONTENTS / JUMP NAVIGATOR (4 Columns) -->
<aside class="lg:col-span-4 lg:sticky lg:top-28 space-y-6">
<div class="border border-primary bg-surface-container-lowest p-6">
<div class="flex items-center justify-between pb-4 border-b border-outline-variant mb-4">
<h2 class="font-title-lg text-title-lg text-primary uppercase tracking-widest">
              {{ __('ui.directory') }}
            </h2>
<span class="font-label-tag text-label-tag text-on-surface-variant uppercase">
              {{ __('ui.articles_count', ['count' => 21]) }}
            </span>
</div>
<!-- TOC Block 1: Terms of Use -->
<div class="mb-6">
<a class="block font-label-caps text-label-caps uppercase text-primary font-bold mb-3 tracking-widest hover:text-secondary" href="#terms-of-use">
              {{ __('content.t_721f6464d73a') }}
            </a>
<ul class="space-y-2 text-body-sm font-body-sm text-on-surface-variant pl-3 border-l-2 border-outline-variant">
<li><a class="hover:text-primary transition-colors block py-0.5" href="#use-art-1">{{ __('content.t_889c4b3cdf80') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#use-art-2">{{ __('content.t_16d9c545e173') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#use-art-3">{{ __('content.t_e70d5f83016a') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#use-art-4">{{ __('content.t_7e2a1a96f0e8') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#use-art-5">{{ __('content.t_a02301388cf6') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#use-art-6">{{ __('content.t_abb4581d6751') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#use-art-7">{{ __('content.t_819d9fd8f9d3') }}</a></li>
</ul>
</div>
<!-- TOC Block 2: Terms of Sale -->
<div>
<a class="block font-label-caps text-label-caps uppercase text-primary font-bold mb-3 tracking-widest hover:text-secondary" href="#terms-of-sale">
              {{ __('content.t_2df92cc97a88') }}
            </a>
<ul class="space-y-2 text-body-sm font-body-sm text-on-surface-variant pl-3 border-l-2 border-outline-variant max-h-72 overflow-y-auto pr-2">
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-1">{{ __('content.t_549b3b3bf719') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-2">{{ __('content.t_a630cb249fd4') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-3">{{ __('content.t_f93c43fb2a33') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-4">{{ __('content.long_9e714aed751a) }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-5">{{ __('content.t_76517f449e5c') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-6">{{ __('content.t_76fc944a13bb') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-7">{{ __('content.t_a9ea7eb1e87b') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-8">{{ __('content.t_5e0c699b912f') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-9">{{ __('content.t_7582252c3d85') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-10">{{ __('content.t_0c6d536193ef') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-11">{{ __('content.t_2b2f88ad38b8') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-12">{{ __('content.t_ce6d96a0f97c') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-13">{{ __('content.t_38ce8d4a83f4') }}</a></li>
<li><a class="hover:text-primary transition-colors block py-0.5" href="#sale-art-14">{{ __('content.t_13bcf04d35d3') }}</a></li>
</ul>
</div>
</div>
<!-- Concierge Direct Card -->
<div class="border border-outline-variant bg-surface-container-low p-6">
<div class="flex items-center space-x-3 mb-3">
<span class="material-symbols-outlined text-primary text-[24px]" data-icon="support_agent">support_agent</span>
<h3 class="font-title-md text-title-md uppercase tracking-wider text-primary">{{ __('content.t_8d561bb57e4d') }}</h3>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-4 leading-relaxed">
            {{ __('content.t_c82aa1819c3b') }}
          </p>
<div class="space-y-2 text-body-sm font-body-sm">
<div class="flex items-center justify-between py-1 border-b border-outline-variant">
<span class="text-on-surface-variant">{{ __('content.t_0c891f0ce6ad') }}</span>
<a class="font-bold text-primary hover:text-secondary" href="tel:8007374672">800 7374672</a>
</div>
<div class="flex items-center justify-between py-1 border-b border-outline-variant">
<span class="text-on-surface-variant">{{ __('content.t_c1e3aafb0acf') }}</span>
<a class="font-bold text-primary hover:text-secondary" href="mailto:customercare@sephora.ae">customercare@sephora.ae</a>
</div>
<div class="flex items-center justify-between py-1">
<span class="text-on-surface-variant">{{ __('content.t_fa5ecbc2f1f5') }}</span>
<span class="font-bold text-primary">{{ __('content.t_7074b9485138') }}</span>
</div>
</div>
</div>
</aside>
<!-- RIGHT COLUMN: COMPREHENSIVE DOCUMENTATION & ARTICLES (8 Columns) -->
<section class="lg:col-span-8 space-y-16">
<!-- PART I: TERMS OF USE -->
<div class="space-y-8 scroll-mt-28" id="terms-of-use">
<div class="border-b-2 border-primary pb-4">
<div class="flex items-center space-x-2 text-secondary mb-1">
<span class="material-symbols-outlined text-[20px]" data-icon="gavel">gavel</span>
<span class="font-label-caps text-label-caps tracking-widest uppercase">{{ __('content.t_1d38fcb77908') }}</span>
</div>
<h2 class="font-headline-md text-headline-md text-primary">
              {{ __('content.t_97738411d629') }}
            </h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">
              {{ __('content.t_089a2e02ae0f') }}
            </p>
</div>
<!-- Article 1 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="use-art-1">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_647b3a058ff2') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('ui.article_label', ['number' => 1]) }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.t_782bba5abd7d') }} <a class="text-primary font-bold underline" href="https://www.sephora.me">{{ __('content.t_94d669c60d89') }}</a> {{ __('content.t_bca346f0b39e') }} <strong>{{ __('content.long_d0dbb5f3c8e6) }}</strong>{{ __('content.t_16b10de63396') }}
              </p>
<div class="bg-surface-container-low p-4 border-l-2 border-primary text-body-sm font-body-sm">
<p><strong>{{ __('content.t_6884f8ea247b') }}</strong> {{ __('content.long_4f7a4338ec41) }}</p>
<p class="mt-1"><strong>{{ __('content.long_d3e89e646ce2) }}</strong> 100034872900003</p>
<p class="mt-1"><strong>{{ __('content.t_f884984c3976') }}</strong> {{ __('content.long_a4fcf5793a59) }}</p>
</div>
</div>
</article>
<!-- Article 2 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="use-art-2">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_ed63a504f225') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('ui.article_label', ['number' => 2]) }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.long_22400ae42ae3) }} <strong>{{ __('content.t_9b67ab71e74b') }}</strong>.
              </p>
<ul class="list-disc pl-5 space-y-2 text-body-md">
<li>{{ __('content.t_b5c284486fdd') }}</li>
<li>{{ __('content.t_b2d43cbf8993') }}</li>
<li>{{ __('content.t_bb80ef38eef4') }}</li>
<li>{{ __('content.t_3d7a0e8cc433') }}</li>
</ul>
</div>
</article>
<!-- Article 3 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="use-art-3">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_880f8eee5c59') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('ui.article_label', ['number' => 3]) }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.t_d177af7ed108') }}
              </p>
<div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-body-sm font-body-sm">
<div class="p-3 border border-outline-variant bg-surface-container-low">
<span class="font-bold text-primary block mb-1">{{ __('content.t_4c57cd50acd9') }}</span>
                  {{ __('content.t_446a8aec0a3b') }}
                </div>
<div class="p-3 border border-outline-variant bg-surface-container-low">
<span class="font-bold text-primary block mb-1">{{ __('content.t_18ff910a35b6') }}</span>
                  {{ __('content.t_b3f9e74778d1') }}
                </div>
<div class="p-3 border border-outline-variant bg-surface-container-low">
<span class="font-bold text-primary block mb-1">{{ __('content.t_b980f6f8d4d9') }}</span>
                  {{ __('content.t_24feb8f93d5d') }}
                </div>
<div class="p-3 border border-outline-variant bg-surface-container-low">
<span class="font-bold text-primary block mb-1">{{ __('ui.impersonation') }}</span>
                  {{ __('content.t_c39069b0b5dc') }}
                </div>
</div>
</div>
</article>
<!-- Article 4 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="use-art-4">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_a6cb4dab6abb') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('ui.article_label', ['number' => 4]) }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.long_2797db11a833) }}
              </p>
<p>
                {{ __('content.t_a57f120b8883') }} <a class="text-primary font-bold underline" href="/terms-and-conditions">{{ __('content.t_9c11fe0a7d4e') }}</a> {{ __('ui.portal') }}.
              </p>
</div>
</article>
<!-- Article 5 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="use-art-5">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_2e282069148d') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('ui.article_label', ['number' => 5]) }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.t_41613fc6e8ae') }} <strong>{{ __('content.t_05177045b7e2') }}</strong>{{ __('content.t_3a3969d52dd3') }} <strong>{{ __('content.t_3b2439cc635b') }}</strong>{{ __('content.long_ca88760d9e35) }}
              </p>
<p class="font-bold text-primary">
                {{ __('content.t_9f7ed232c0e5') }}
              </p>
</div>
</article>
<!-- Article 6 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="use-art-6">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_e439014b5473') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('ui.article_label', ['number' => 6]) }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.t_8c35a6cffd2f') }}
              </p>
</div>
</article>
<!-- Article 7 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="use-art-7">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_29d1ecf9eabc') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('ui.article_label', ['number' => 7]) }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.long_84ed46d891a8) }}
              </p>
</div>
</article>
</div>
<!-- PART II: TERMS OF SALE -->
<div class="space-y-8 scroll-mt-28 pt-8 border-t-2 border-outline-variant" id="terms-of-sale">
<div class="border-b-2 border-primary pb-4">
<div class="flex items-center space-x-2 text-secondary mb-1">
<span class="material-symbols-outlined text-[20px]" data-icon="shopping_cart_checkout">{{ __('content.long_48d3e9c39c99) }}</span>
<span class="font-label-caps text-label-caps tracking-widest uppercase">{{ __('content.t_d2db28be1807') }}</span>
</div>
<h2 class="font-headline-md text-headline-md text-primary">
              {{ __('content.t_1e0a1aad71b0') }}
            </h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">
              {{ __('content.t_05f1ecfe74a8') }}
            </p>
</div>
<!-- Sale Article 1 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="sale-art-1">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_ce963d8378d0') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('content.t_d98c24526c27') }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.long_7903fb6d8aa8) }}
              </p>
</div>
</article>
<!-- Sale Article 2 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="sale-art-2">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_027b66a9b462') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('content.t_369a9a4fe4bb') }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.t_0ce0deea6ec0') }}
              </p>
</div>
</article>
<!-- Sale Article 3 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="sale-art-3">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.long_8bedf512c872) }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('content.t_5805f8039f2a') }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.t_295e8a0acaca') }} <strong>{{ __('content.t_5c5874ab60bb') }}</strong> {{ __('content.long_ae800c0011c8) }}
              </p>
<div class="p-4 bg-surface-container border border-outline-variant">
<span class="font-label-caps text-label-caps uppercase text-primary font-bold block mb-1">
                  {{ __('content.t_786de651cbed') }}
                </span>
<p class="text-body-sm font-body-sm">
                  {{ __('content.t_525e95215671') }}
                </p>
</div>
</div>
</article>
<!-- Sale Article 4 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="sale-art-4">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.long_ed0b15ed8eef) }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('content.t_af68d38ac8a6') }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.t_68160d36f5e2') }} <strong>{{ __('content.long_7295fa96d65d) }}</strong> {{ __('content.long_42466b0d0490) }}
              </p>
<div class="space-y-3 pt-2">
<h4 class="font-title-md text-title-md text-primary">{{ __('content.t_0e6ae89a951a') }}</h4>
<div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-center text-body-sm font-body-sm">
<div class="border border-outline-variant p-2 font-bold bg-surface-container-low">{{ __('content.t_a5e7c513c191') }}</div>
<div class="border border-outline-variant p-2 font-bold bg-surface-container-low">{{ __('content.t_51137b2e6c73') }}</div>
<div class="border border-outline-variant p-2 font-bold bg-surface-container-low">{{ __('content.long_36b875335dbd) }}</div>
<div class="border border-outline-variant p-2 font-bold bg-surface-container-low">TAMARA ({{ __('ui.pay_in_three') }})</div>
<div class="border border-outline-variant p-2 font-bold bg-surface-container-low">{{ __('content.long_3e7252379319) }}</div>
<div class="border border-outline-variant p-2 font-bold bg-surface-container-low">{{ __('content.t_003dff3d02b0') }}</div>
</div>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant italic">
                {{ __('content.t_3eb7b2e4eb15') }}
              </p>
</div>
</article>
<!-- Sale Article 5 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="sale-art-5">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_82e4688c143b') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('content.t_ec432199a213') }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.t_050dda265f26') }}
              </p>
<div class="overflow-x-auto">
<table class="w-full text-left text-body-sm font-body-sm border border-outline-variant">
<thead class="bg-surface-container font-label-caps text-label-caps uppercase text-primary">
<tr>
<th class="p-3 border-b border-outline-variant">{{ __('content.t_0d04850eabc1') }}</th>
<th class="p-3 border-b border-outline-variant">{{ __('content.t_376d529e0cab') }}</th>
<th class="p-3 border-b border-outline-variant">{{ __('content.t_3e2448c37615') }}</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<tr>
<td class="p-3 font-bold text-primary">{{ __('content.long_4fd065ba1b5d) }}</td>
<td class="p-3 text-secondary font-bold">{{ __('ui.free') }}</td>
<td class="p-3">{{ __('content.long_d51329c58d79) }}</td>
</tr>
<tr>
<td class="p-3 font-bold text-primary">{{ __('content.long_147948b6452b) }}</td>
<td class="p-3">25 AED</td>
<td class="p-3">{{ __('content.long_830a9824a029) }}</td>
</tr>
<tr>
<td class="p-3 font-bold text-primary">{{ __('content.long_6672ec5fd71a) }}</td>
<td class="p-3">35 AED</td>
<td class="p-3">{{ __('content.t_2a200a107add') }}</td>
</tr>
<tr>
<td class="p-3 font-bold text-primary">{{ __('content.long_69f166d90066) }}</td>
<td class="p-3 text-secondary font-bold">{{ __('ui.free') }}</td>
<td class="p-3">{{ __('content.t_6482dbe711a5') }}</td>
</tr>
</tbody>
</table>
</div>
</div>
</article>
<!-- Sale Article 6 -->
<article class="border border-outline-variant bg-surface-container-lowest p-6 md:p-8 scroll-mt-28" id="sale-art-6">
<div class="flex items-start justify-between mb-4">
<h3 class="font-headline-sm text-headline-sm text-primary">
                {{ __('content.t_5d5f59bb110b') }}
              </h3>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase text-primary">
                {{ __('content.t_d9bb4cdc8846') }}
              </span>
</div>
<div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>
                {{ __('content.t_e126f91666c0') }} <strong>{{ __('content.t_b18ec433c1b6') }}</strong> {{ __('content.t_364916d6e4e0') }}
              </p>
<div class="border border-outline-variant p-4 space-y-3 bg-surface-container-low">
<h4 class="font-title-md text-title-md text-primary">{{ __('content.t_c1bb199b1c9e') }}</h4>
<ul class="list-disc pl-5 space-y-1 text-body-sm font-body-sm text-on-surface-variant">
<li>{{ __('content.t_f6fc8634cf08') }}</li>
<li>{{ __('content.t_06dea5aabef4') }}</li>
<li>{{ __('content.t_903c863f0b1f') }}</li>
</ul>
</div>
<p>
<strong>{{ __('content.t_f2a2f633e964') }}</strong> {{ __('content.t_bc3eb73a7691') }}
              </p>
</div>
</article>
<!-- Sale Article 7 through 14 in clean concise luxury accordion vitrine -->
<div class="space-y-4 pt-4">
<h4 class="font-title-lg text-title-lg text-primary uppercase tracking-wider">
              {{ __('content.t_0c620b19035c') }}
            </h4>
<!-- Article 7 -->
<details class="group border border-outline-variant bg-surface-container-lowest">
<summary class="flex items-center justify-between p-5 cursor-pointer select-none font-headline-sm text-headline-sm text-primary group-open:border-b group-open:border-outline-variant">
<span>{{ __('content.t_30af429443e6') }}</span>
<span class="material-symbols-outlined transition-transform duration-200 group-open:rotate-180" data-icon="expand_more">expand_more</span>
</summary>
<div class="p-6 text-body-md text-body-md text-on-surface-variant space-y-3">
<p>
                  {{ __('content.t_14855ecde40c') }}
                </p>
</div>
</details>
<!-- Article 8 -->
<details class="group border border-outline-variant bg-surface-container-lowest">
<summary class="flex items-center justify-between p-5 cursor-pointer select-none font-headline-sm text-headline-sm text-primary group-open:border-b group-open:border-outline-variant">
<span>{{ __('content.t_a54cfc6f0ce1') }}</span>
<span class="material-symbols-outlined transition-transform duration-200 group-open:rotate-180" data-icon="expand_more">expand_more</span>
</summary>
<div class="p-6 text-body-md text-body-md text-on-surface-variant space-y-3">
<p>
                  {{ __('content.t_4450925f18c6') }}
                </p>
</div>
</details>
<!-- Article 9 -->
<details class="group border border-outline-variant bg-surface-container-lowest">
<summary class="flex items-center justify-between p-5 cursor-pointer select-none font-headline-sm text-headline-sm text-primary group-open:border-b group-open:border-outline-variant">
<span>{{ __('content.t_b36c47032421') }}</span>
<span class="material-symbols-outlined transition-transform duration-200 group-open:rotate-180" data-icon="expand_more">expand_more</span>
</summary>
<div class="p-6 text-body-md text-body-md text-on-surface-variant space-y-3">
<p>
                  {{ __('content.t_84281dc5549e') }}
                </p>
</div>
</details>
<!-- Article 10 -->
<details class="group border border-outline-variant bg-surface-container-lowest">
<summary class="flex items-center justify-between p-5 cursor-pointer select-none font-headline-sm text-headline-sm text-primary group-open:border-b group-open:border-outline-variant">
<span>{{ __('content.t_45f09b54831f') }}</span>
<span class="material-symbols-outlined transition-transform duration-200 group-open:rotate-180" data-icon="expand_more">expand_more</span>
</summary>
<div class="p-6 text-body-md text-body-md text-on-surface-variant space-y-3">
<p>
                  {{ __('content.long_9775aa795635) }} <a class="text-primary font-bold underline" href="mailto:customercare@sephora.ae">customercare@sephora.ae</a>.
                </p>
</div>
</details>
<!-- Article 11 -->
<details class="group border border-outline-variant bg-surface-container-lowest">
<summary class="flex items-center justify-between p-5 cursor-pointer select-none font-headline-sm text-headline-sm text-primary group-open:border-b group-open:border-outline-variant">
<span>{{ __('content.t_f5ed556f7d33') }}</span>
<span class="material-symbols-outlined transition-transform duration-200 group-open:rotate-180" data-icon="expand_more">expand_more</span>
</summary>
<div class="p-6 text-body-md text-body-md text-on-surface-variant space-y-3">
<p>
                  {{ __('content.t_27858b61ab3b') }}
                </p>
</div>
</details>
<!-- Article 12 -->
<details class="group border border-outline-variant bg-surface-container-lowest">
<summary class="flex items-center justify-between p-5 cursor-pointer select-none font-headline-sm text-headline-sm text-primary group-open:border-b group-open:border-outline-variant">
<span>{{ __('content.t_ce6d96a0f97c') }}</span>
<span class="material-symbols-outlined transition-transform duration-200 group-open:rotate-180" data-icon="expand_more">expand_more</span>
</summary>
<div class="p-6 text-body-md text-body-md text-on-surface-variant space-y-3">
<p>
                  {{ __('content.t_9cfd25c3afc4') }}
                </p>
</div>
</details>
<!-- Article 13 -->
<details class="group border border-outline-variant bg-surface-container-lowest">
<summary class="flex items-center justify-between p-5 cursor-pointer select-none font-headline-sm text-headline-sm text-primary group-open:border-b group-open:border-outline-variant">
<span>{{ __('content.t_baac47459e52') }}</span>
<span class="material-symbols-outlined transition-transform duration-200 group-open:rotate-180" data-icon="expand_more">expand_more</span>
</summary>
<div class="p-6 text-body-md text-body-md text-on-surface-variant space-y-3">
<p>
                  {{ __('content.t_255696e50fa0') }}
                </p>
</div>
</details>
<!-- Article 14 -->
<details class="group border border-outline-variant bg-surface-container-lowest">
<summary class="flex items-center justify-between p-5 cursor-pointer select-none font-headline-sm text-headline-sm text-primary group-open:border-b group-open:border-outline-variant">
<span>{{ __('content.t_9ef82739a57b') }}</span>
<span class="material-symbols-outlined transition-transform duration-200 group-open:rotate-180" data-icon="expand_more">expand_more</span>
</summary>
<div class="p-6 text-body-md text-body-md text-on-surface-variant space-y-3">
<p>
                  {{ __('content.t_63ace16a1de6') }}
                </p>
</div>
</details>
</div>
</div>
</section>
</div>
</main>
<!-- 5. CONCIERGE & SUPPORT CONTACT BANNER -->
<section class="w-full bg-surface-container border-y border-outline-variant py-12">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="border border-primary bg-surface-container-lowest p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
<div class="space-y-2 text-center md:text-left">
<span class="font-label-caps text-label-caps tracking-widest uppercase text-secondary font-bold">{{ __('content.t_2024f9606bbf') }}</span>
<h3 class="font-headline-md text-headline-md text-primary">{{ __('content.t_3578581c768f') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant">{{ __('content.t_ba00b290aeba') }}</p>
</div>
<div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
<a class="w-full sm:w-auto px-8 py-3.5 bg-primary text-on-primary font-label-caps text-label-caps tracking-widest text-center hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-colors" href="tel:8007374672">
            CALL 800 7374672
          </a>
<a class="w-full sm:w-auto px-8 py-3.5 border border-primary text-primary font-label-caps text-label-caps tracking-widest text-center hover:bg-primary hover:text-on-primary transition-colors" href="mailto:customercare@sephora.ae">
            {{ __('content.t_c703d15a483e') }}
          </a>
</div>
</div>
</div>
</section>
<!-- 6. TRUST BADGES ROW -->
<section class="w-full bg-surface-container-lowest py-10 border-b border-outline-variant">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
<!-- Badge 1 -->
<div class="flex flex-col items-center space-y-2 p-4">
<span class="material-symbols-outlined text-[32px] text-primary" data-icon="local_shipping">local_shipping</span>
<span class="font-title-md text-title-md text-primary font-bold uppercase tracking-wider">{{ __('ui.free_delivery') }}</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_5ae4fa42fde1') }}</span>
</div>
<!-- Badge 2 -->
<div class="flex flex-col items-center space-y-2 p-4">
<span class="material-symbols-outlined text-[32px] text-primary" data-icon="verified">verified</span>
<span class="font-title-md text-title-md text-primary font-bold uppercase tracking-wider">{{ __('ui.authentic') }}</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_a5381098f41f') }}</span>
</div>
<!-- Badge 3 -->
<div class="flex flex-col items-center space-y-2 p-4">
<span class="material-symbols-outlined text-[32px] text-primary" data-icon="cached">cached</span>
<span class="font-title-md text-title-md text-primary font-bold uppercase tracking-wider">{{ __('ui.easy_returns') }}</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_b13ce43a2f42') }}</span>
</div>
<!-- Badge 4 -->
<div class="flex flex-col items-center space-y-2 p-4">
<span class="material-symbols-outlined text-[32px] text-primary" data-icon="loyalty">loyalty</span>
<span class="font-title-md text-title-md text-primary font-bold uppercase tracking-wider">{{ __('content.t_302ae874320b') }}</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_dabb08c0d20a') }}</span>
</div>
</div>
</div>
</section>
<!-- 7. NEWSLETTER SECTION -->
<section class="w-full bg-surface-container py-12">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="max-w-2xl mx-auto text-center space-y-4">
<h4 class="font-headline-sm text-headline-sm text-primary uppercase tracking-widest">
          {{ __('content.t_98a7b9d37c27') }}
        </h4>
<p class="font-body-md text-body-md text-on-surface-variant">
          {{ __('content.t_0b74e91e68d1') }}
        </p>
<form class="flex flex-col sm:flex-row items-center gap-2 pt-2" onsubmit="event.preventDefault()" data-newsletter-form>
<input class="w-full px-4 py-3.5 bg-surface-container-lowest border border-outline-variant text-body-sm font-body-sm text-primary placeholder-on-surface-variant focus:outline-none focus:border-primary" placeholder="{{ __('content.t_205dfd13124d') }}" required="" type="email"/>
<button class="w-full sm:w-auto px-8 py-3.5 bg-primary text-on-primary font-label-caps text-label-caps tracking-widest whitespace-nowrap hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" type="submit">
            {{ __('ui.subscribe_caps') }}
          </button>
</form>
</div>
</div>
</section>
<!-- 8. OFFICIAL SEPHORA DESKTOP FOOTER (Directly Mapped from Shared Components JSON) -->
@endsection
