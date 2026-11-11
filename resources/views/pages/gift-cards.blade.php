@extends('layouts.app')

@section('title', __('meta.gift_cards'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased min-h-screen flex flex-col selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- MAIN CANVAS -->
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-md md:py-space-lg">
<!-- 3. BREADCRUMB -->
<nav class="flex items-center space-x-2 font-label-caps text-label-caps text-on-surface-variant mb-6 uppercase tracking-widest">
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-bold">{{ __('content.t_7eda08b0b56f') }}</span>
</nav>
<!-- 4. HERO HEADER & INTRO -->
<div class="text-center max-w-3xl mx-auto pt-2 pb-8">
<div class="inline-flex items-center gap-2 border border-primary px-3.5 py-1 mb-4">
<span class="material-symbols-outlined text-[14px] text-primary">card_giftcard</span>
<span class="font-label-caps text-label-caps tracking-widest uppercase font-bold text-primary">{{ __('content.t_7716ea4630c6') }}</span>
</div>
<h1 class="font-headline-lg text-headline-lg md:text-display-hero text-primary tracking-tight font-bold mb-4 uppercase">
        {{ __('content.t_2f8bf50e0dd7') }}
      </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl mx-auto font-light">
        {{ __('content.t_39bde0924b38') }}
      </p>
<!-- Announcement Callout Box -->
<div class="mt-8 bg-surface-container-lowest border-2 border-primary p-4 md:p-5 flex items-center justify-center gap-3 text-left">
<span class="material-symbols-outlined text-secondary text-[24px] flex-shrink-0">verified</span>
<p class="font-body-md text-body-md font-medium text-on-surface">
<strong class="font-bold text-primary">{{ __('content.t_afa6e50bb7af') }}</strong> {{ __('content.t_29920ad7763f') }}
        </p>
</div>
</div>
<!-- 5. DUAL SHOWCASE / FEATURED HERO BANNER -->
<section class="grid grid-cols-1 lg:grid-cols-12 gap-gutter my-space-lg items-stretch">
<!-- Left: Iconic Striped Sephora Gift Card Presentation -->
<div class="lg:col-span-7 bg-surface-container-lowest border border-primary overflow-hidden flex flex-col justify-between group">
<div class="relative overflow-hidden bg-primary aspect-[16/9]">
<img alt="{{ __('content.t_fceeba409a87') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 ease-out" src="{{ asset('images/content/img_b1cfece087ddc206.jpg') }}"/>
<div class="absolute top-4 left-4 bg-primary text-on-primary font-label-tag text-label-tag px-3 py-1 uppercase tracking-widest">
            {{ __('content.t_d12f9c16ea92') }}
          </div>
</div>
<div class="p-6 md:p-8 border-t border-outline-variant bg-surface-container-lowest">
<h2 class="font-headline-sm text-headline-sm text-primary mb-2">{{ __('content.t_20f99dba3567') }}</h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
            {{ __('content.t_660732403864') }}
          </p>
<div class="flex flex-wrap items-center gap-4">
<a class="inline-flex items-center justify-center h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all duration-200" href="#balance-module">
              {{ __('content.t_32f4504fa488') }}
            </a>
<a class="inline-flex items-center justify-center h-12 px-6 bg-transparent text-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-primary hover:text-on-primary transition-all duration-200" href="#stores">
              {{ __('content.t_4c037fba544e') }}
            </a>
</div>
</div>
</div>
<!-- Right: Physical & Digital Experience & 3 Pillars -->
<div class="lg:col-span-5 flex flex-col justify-between space-y-gutter">
<div class="bg-surface-container-lowest border border-outline-variant overflow-hidden group">
<div class="relative aspect-[16/9] overflow-hidden">
<img alt="{{ __('content.t_77fd2bd4635e') }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 ease-out" src="{{ asset('images/content/img_394b44c9b6270c9c.jpg') }}"/>
<div class="absolute bottom-3 left-3 bg-surface-container-lowest/90 backdrop-blur-none px-3 py-1 font-label-caps text-label-caps text-primary border border-primary">
              {{ __('content.t_15d1c4f7e21a') }}
            </div>
</div>
</div>
<!-- 3 Pillars of Sephora Gift Cards -->
<div class="bg-surface-container-lowest border border-primary p-6 md:p-7 flex-grow flex flex-col justify-around space-y-6">
<div class="flex items-start gap-4">
<div class="w-10 h-10 flex-shrink-0 bg-primary text-on-primary flex items-center justify-center font-bold">
              1
            </div>
<div>
<h3 class="font-title-lg text-title-lg text-primary uppercase tracking-wide">{{ __('content.t_26b44a0416d7') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_025810d12044') }}</p>
</div>
</div>
<div class="h-[1px] bg-surface-container w-full"></div>
<div class="flex items-start gap-4">
<div class="w-10 h-10 flex-shrink-0 bg-primary text-on-primary flex items-center justify-center font-bold">
              2
            </div>
<div>
<h3 class="font-title-lg text-title-lg text-primary uppercase tracking-wide">{{ __('content.t_f962ea088391') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_8fdacd9fa699') }}</p>
</div>
</div>
<div class="h-[1px] bg-surface-container w-full"></div>
<div class="flex items-start gap-4">
<div class="w-10 h-10 flex-shrink-0 bg-primary text-on-primary flex items-center justify-center font-bold">
              3
            </div>
<div>
<h3 class="font-title-lg text-title-lg text-primary uppercase tracking-wide">{{ __('content.t_b82627d186dc') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_39e1647d6283') }}</p>
</div>
</div>
</div>
</div>
</section>
<!-- 6. INTERACTIVE BALANCE CHECKER MODULE -->
<section class="my-space-xl bg-surface-container-lowest border-2 border-primary p-6 md:p-12 relative overflow-hidden" id="balance-module">
<div class="max-w-3xl mx-auto">
<div class="text-center mb-8">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-bold mb-1 block">{{ __('content.t_994fdb363109') }}</span>
<h2 class="font-headline-lg text-headline-lg text-primary font-bold uppercase mb-2">{{ __('content.t_0dccdae55d78') }}</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">
            {{ __('content.t_ee3f377cebf4') }}
          </p>
</div>
<form class="space-y-6" id="balance-form" onsubmit="event.preventDefault(); simulateBalanceCheck();">
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
<!-- 16-digit card number input -->
<div class="md:col-span-2">
<label class="block font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant mb-2" for="card-number">
                {{ __('content.t_c58da805744f') }} <span class="text-secondary">*</span>
</label>
<div class="relative">
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 font-mono text-title-md text-primary tracking-widest placeholder:text-outline-variant transition-colors" id="card-number" maxlength="19" placeholder="6036 1234 5678 9012" required="" type="text"/>
<span class="absolute right-3.5 top-3 text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]">credit_card</span>
</span>
</div>
<p class="font-body-sm text-body-sm text-outline mt-1.5">{{ __('content.t_63901d3e481d') }}</p>
</div>
<!-- 4-digit PIN -->
<div class="md:col-span-1">
<label class="block font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant mb-2" for="card-pin">
                {{ __('content.t_dba9f0567585') }} <span class="text-secondary">*</span>
</label>
<div class="relative">
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 font-mono text-title-md text-primary tracking-widest placeholder:text-outline-variant transition-colors" id="card-pin" maxlength="4" placeholder="••••" required="" type="password"/>
<span class="absolute right-3.5 top-3 text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]">lock</span>
</span>
</div>
<p class="font-body-sm text-body-sm text-outline mt-1.5">{{ __('content.t_34ba2513ed3a') }}</p>
</div>
</div>
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-surface-container">
<button class="w-full sm:w-auto h-12 px-10 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all duration-200 cursor-pointer flex items-center justify-center gap-2" type="submit">
<span>{{ __('content.t_50baae95d4c4') }}</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</button>
<a class="font-label-caps text-label-caps text-primary hover:text-secondary underline tracking-widest uppercase flex items-center gap-1.5" href="/" id="stores">
<span class="material-symbols-outlined text-[16px]">storefront</span>
<span>{{ __('content.t_8534e87c8d6b') }}</span>
</a>
</div>
<!-- Result Simulation Box (Hidden by default) -->
<div class="hidden p-5 bg-surface border border-primary mt-4" id="balance-result">
<div class="flex items-center justify-between">
<div>
<span class="font-label-tag text-label-tag uppercase tracking-widest text-outline">{{ __('content.t_b8d4a100e29b') }}</span>
<div class="font-price-aed-lg text-display-hero-mobile text-primary font-bold mt-1" id="balance-value">AED —</div>
<div class="font-body-sm text-body-sm text-on-surface-variant mt-1" id="balance-meta">{{ __('content.t_9ca061e2fe4b') }}</div>
</div>
<a class="h-10 px-6 bg-secondary text-on-secondary font-label-caps text-label-caps uppercase tracking-widest flex items-center hover:opacity-90" href="/shop/bestsellers">
                {{ __('content.t_b6f0837261c6') }}
              </a>
</div>
</div>
</form>
</div>
</section>
<!-- 7. HOW TO USE & REDEEM STEPS (Visual 3-Step Guide) -->
<section class="my-space-xl">
<div class="text-center mb-10">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-outline font-bold">{{ __('content.t_9ab1ac74fcaf') }}</span>
<h2 class="font-headline-lg text-headline-lg text-primary uppercase font-bold mt-1">{{ __('content.t_1ff843b41933') }}</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Step 1 -->
<div class="bg-surface-container-lowest border border-outline-variant p-8 flex flex-col justify-between hover:border-primary transition-colors">
<div>
<div class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center font-headline-sm text-headline-sm font-bold mb-6">
              01
            </div>
<h3 class="font-title-lg text-title-lg text-primary uppercase mb-3">{{ __('content.t_a64d43752ba5') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              {{ __('content.t_d01ab43a68d5') }}
            </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps uppercase">
<span class="material-symbols-outlined text-[18px]">payments</span>
<span>{{ __('content.t_735c35a94565') }}</span>
</div>
</div>
<!-- Step 2 -->
<div class="bg-surface-container-lowest border border-outline-variant p-8 flex flex-col justify-between hover:border-primary transition-colors">
<div>
<div class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center font-headline-sm text-headline-sm font-bold mb-6">
              02
            </div>
<h3 class="font-title-lg text-title-lg text-primary uppercase mb-3">{{ __('content.t_bffa0011a818') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              {{ __('content.t_42cb634ed73b') }}
            </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps uppercase">
<span class="material-symbols-outlined text-[18px]">mail</span>
<span>{{ __('content.t_7ca8a3a62fc4') }}</span>
</div>
</div>
<!-- Step 3 -->
<div class="bg-surface-container-lowest border border-outline-variant p-8 flex flex-col justify-between hover:border-primary transition-colors">
<div>
<div class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center font-headline-sm text-headline-sm font-bold mb-6">
              03
            </div>
<h3 class="font-title-lg text-title-lg text-primary uppercase mb-3">{{ __('content.t_ffe7438d64c1') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              {{ __('content.t_6530b403310e') }}
            </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps uppercase">
<span class="material-symbols-outlined text-[18px]">shopping_bag</span>
<span>{{ __('content.t_4f0122ce6bc9') }}</span>
</div>
</div>
</div>
</section>
<!-- 8. EXPANDABLE FREQUENTLY ASKED QUESTIONS (FAQ Accordion) -->
<section class="my-space-xl max-w-4xl mx-auto">
<div class="border-b border-primary pb-4 mb-8 flex items-baseline justify-between">
<div>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-outline">{{ __('content.t_4765a20619c3') }}</span>
<h2 class="font-headline-lg text-headline-lg text-primary uppercase font-bold mt-1">{{ __('ui.faq') }}</h2>
</div>
<span class="font-label-caps text-label-caps text-on-surface-variant hidden sm:inline">12 TOPICS</span>
</div>
<div class="divide-y divide-outline-variant border-y border-outline-variant">
<!-- FAQ Item 1 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_11643728e5dc') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_e4778054c102') }}
          </div>
</details>
<!-- FAQ Item 2 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_dce82c37496d') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_b2c207180465') }}
          </div>
</details>
<!-- FAQ Item 3 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_896b45c33cee') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
<strong>{{ __('ui.online') }}</strong> {{ __('content.long_23fbaa3ff97d) }}<br/>
<strong>{{ __('content.t_995319c342d6') }}</strong> {{ __('content.t_29807615cecf') }}
          </div>
</details>
<!-- FAQ Item 4 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_856d42bc5da3') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.long_03ec8f443408) }}
          </div>
</details>
<!-- FAQ Item 5 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_c41acc0436c0') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_9e73a7bb629f') }}
          </div>
</details>
<!-- FAQ Item 6 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_39aefb5da70b') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_b34450d01bdb') }}
          </div>
</details>
<!-- FAQ Item 7 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_45c4930dc41e') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_0aa68ba96032') }}
          </div>
</details>
<!-- FAQ Item 8 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_f77a857cf184') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_d7832dadee0c') }}
          </div>
</details>
<!-- FAQ Item 9 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_3c985d80df6a') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_c1e096eb8c88') }}
          </div>
</details>
<!-- FAQ Item 10 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_09f5b4c67a0d') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_0dbfa53e7466') }}
          </div>
</details>
<!-- FAQ Item 11 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_3fdc018822c0') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_a579cb0e2bc0') }}
          </div>
</details>
<!-- FAQ Item 12 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              {{ __('content.t_252eac24ce31') }}
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            {{ __('content.t_eb3dba60619f') }} <strong>800 SEPHORA (800 7374672)</strong> {{ __('content.t_62554a17a360') }}
          </div>
</details>
</div>
</section>
<!-- 9. TRUST BADGES -->
<section class="my-space-xl border-y border-outline-variant py-8 bg-surface-container-lowest">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
<!-- 1 -->
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">local_shipping</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold">{{ __('ui.free_delivery') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">{{ __('content.t_5ae4fa42fde1') }}</p>
</div>
<!-- 2 -->
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">verified</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold">{{ __('ui.authentic') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">{{ __('content.t_e414293259ed') }}</p>
</div>
<!-- 3 -->
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">sync</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold">{{ __('ui.easy_returns') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">{{ __('content.t_3bf5a2803a2f') }}</p>
</div>
<!-- 4 -->
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">stars</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold">{{ __('ui.beauty_pass_points') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">{{ __('content.t_c5bdd6223bae') }}</p>
</div>
</div>
</section>
</main>
<!-- 10. NEWSLETTER & FOOTER (Shared Component Anchor Protocol) -->
<!-- Micro-interactions logic -->
<script>
    // Format card number with spaces as typed
    const cardInput = document.getElementById('card-number');
    if (cardInput) {
      cardInput.addEventListener('input', function(e) {
        let val = e.target.value.replace(/\D/g, '');
        let formatted = val.match(/.{1,4}/g)?.join(' ') || val;
        e.target.value = formatted.substring(0, 19);
      });
    }

    // Real balance check via the backend endpoint
    function simulateBalanceCheck() {
      const cardNum = document.getElementById('card-number').value;
      const cardPin = document.getElementById('card-pin') ? document.getElementById('card-pin').value : '';
      const resultBox = document.getElementById('balance-result');
      const balanceValue = document.getElementById('balance-value');
      const balanceMeta = document.getElementById('balance-meta');
      const csrf = document.querySelector('meta[name="csrf-token"]');

      if (!cardNum) return;

      fetch('/gift-card/balance', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf ? csrf.content : '',
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
        body: JSON.stringify({
          card_number: cardNum,
          card_pin: cardPin
        }),
      })
      .then(r => r.json())
      .then(res => {
        resultBox.classList.remove('hidden');
        const digits = cardNum.replace(/\D/g, '');
        if (res.valid) {
          balanceValue.textContent = (res.currency || 'AED') + ' ' + res.balance;
          balanceMeta.textContent = 'Card # ' + digits.slice(0,4) + ' \u2022\u2022\u2022\u2022 \u2022\u2022\u2022\u2022 ' + digits.slice(-4) + ' | ' + res.message;
        } else {
          balanceValue.textContent = '\u2014';
          balanceMeta.textContent = res.message;
        }
        resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      })
      .catch(() => {
        if (window.sephoraToast) {
          window.sephoraToast('Network error verifying card', 'error');
        } else {
          alert('Network error verifying card. Please try again.');
        }
      });
    }
  </script>
@endsection