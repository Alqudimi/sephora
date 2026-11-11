@extends('layouts.app')

@section('title', __('meta.delivery_faqs'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- BREADCRUMB & HERO INTRO -->
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- Breadcrumb -->
<nav class="flex items-center space-x-2 text-on-surface-variant font-body-sm text-body-sm mb-6">
<a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="/faq">{{ __('ui.faq') }}</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-semibold">{{ __('ui.delivery') }}</span>
</nav>
<!-- Header Section -->
<section class="border-b border-primary pb-8 mb-10">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<span class="inline-block bg-primary text-on-primary font-label-caps text-label-caps px-2.5 py-1 tracking-widest uppercase mb-3">
            {{ __('content.t_84d3e9880e34') }}
          </span>
<h1 class="font-headline-lg text-headline-lg text-primary tracking-tight">
            {{ __('content.t_853287d7fd4a') }}
          </h1>
<p class="text-on-surface-variant font-body-lg text-body-lg max-w-3xl mt-3 leading-relaxed">
            {{ __('content.t_1a6e9c7d6289') }}
          </p>
</div>
<div class="flex items-center gap-3">
<span class="border border-outline px-3 py-1.5 font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant bg-surface-container-lowest">
            Region: UAE (7 Emirates)
          </span>
<span class="border border-outline px-3 py-1.5 font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant bg-surface-container-lowest">
            {{ __('content.t_b28f47294be7') }}
          </span>
</div>
</div>
</section>
<!-- CONTENT GRID: CATEGORY SIDEBAR + ACCORDION VITRINES -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- LEFT SIDEBAR: TOPIC EXPLORER -->
<aside class="lg:col-span-3 bg-surface-container-lowest border border-outline-variant p-6 sticky top-28">
<h2 class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant border-b border-outline-variant pb-3 mb-4">
          {{ __('content.t_4377957ea24e') }}
        </h2>
<nav class="space-y-1">
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md bg-primary text-on-primary font-bold" href="/faq">
<span>{{ __('ui.delivery') }}</span>
<span class="material-symbols-outlined text-[16px]">chevron_right</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>{{ __('content.t_6e6fc2347007') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/stores">
<span>{{ __('ui.stores_services') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>{{ __('content.t_e94aa6260312') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>{{ __('content.t_57cc0a7b1b8f') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>{{ __('ui.products') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>{{ __('ui.payment_methods') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>{{ __('content.t_672200de3a97') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq/cancellation-and-refund">
<span>{{ __('ui.cancellation_refund') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>{{ __('content.t_fd9c888975e8') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>{{ __('content.t_dea335290fc6') }}</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/gift-card-info">
<span>{{ __('ui.gift_cards') }}</span>
</a>
</nav>
<!-- Quick Help Card -->
<div class="mt-8 pt-6 border-t border-outline-variant">
<p class="font-label-caps text-label-caps uppercase tracking-wider text-outline mb-2">{{ __('content.t_f01566d16332') }}</p>
<p class="font-title-md text-title-md text-primary font-bold mb-3">{{ __('content.t_d984e5464133') }}</p>
<a class="block w-full py-2.5 text-center bg-surface text-primary border border-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary hover:text-on-primary transition-colors" href="tel:8007374672">
            800 7374672
          </a>
</div>
</aside>
<!-- RIGHT COLUMN: DELIVERY CATEGORIES ACCORDIONS -->
<section class="lg:col-span-9 space-y-10">
<!-- FAST STATS BENTO ROW -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
<div class="bg-surface-container-lowest p-5 border border-outline-variant">
<span class="font-label-caps text-label-caps text-outline uppercase tracking-wider block mb-1">{{ __('content.t_e18284b0f29a') }}</span>
<p class="font-title-lg text-title-lg text-primary">{{ __('content.t_4e6e4706c3da') }}</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_9f7387abb13d') }}</p>
</div>
<div class="bg-surface-container-lowest p-5 border border-outline-variant">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider block mb-1">{{ __('content.t_6b7d99273a18') }}</span>
<p class="font-title-lg text-title-lg text-primary">{{ __('content.t_f1ae94b2d38d') }}</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_a21d48cdc7b0') }}</p>
</div>
<div class="bg-surface-container-lowest p-5 border border-outline-variant">
<span class="font-label-caps text-label-caps text-outline uppercase tracking-wider block mb-1">{{ __('content.t_fd3abddeac35') }}</span>
<p class="font-title-lg text-title-lg text-primary">{{ __('content.t_c84ed8224c9d') }}</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_5fce42d16b3a') }}</p>
</div>
</div>
<!-- 1. STANDARD DELIVERY -->
<div class="border border-outline-variant bg-surface-container-lowest">
<div class="bg-surface-container-high px-6 py-4 flex items-center justify-between border-b border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[24px]">local_shipping</span>
<h2 class="font-headline-sm text-headline-sm text-primary">{{ __('content.t_681ef021d630') }}</h2>
</div>
<span class="font-label-caps text-label-caps tracking-widest uppercase text-outline">8 Questions</span>
</div>
<div class="divide-y divide-outline-variant">
<!-- Q1 -->
<details class="group p-6" open="">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_f93c369d816e') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed space-y-2">
<p>Our dedicated courier service will reach out to you via SMS and WhatsApp on the morning of delivery with a live tracking link. Through this notification, you can confirm your preferred delivery window (Morning: 9am–2pm or Evening: 2pm–8pm) or provide alternate gate security instructions.</p>
<p class="text-outline text-body-sm font-body-sm">{{ __('content.t_5e4c8aed925d') }}</p>
</div>
</details>
<!-- Q2 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_d21e2f71bd7b') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_64bb2e3dccb3') }}</p>
</div>
</details>
<!-- Q3 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_e67374d174d0') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_de83f829c362') }} <strong class="text-primary font-bold">800 7374672</strong> {{ __('content.t_b000485a9f30') }} <strong class="text-primary font-bold">customercare@sephora.ae</strong> {{ __('content.t_2f11cd192697') }}</p>
</div>
</details>
<!-- Q4 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_1e1277dbc8a5') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_6e96cf631c49') }} <em>{{ __('content.t_1008ecfecefe') }}</em>.</p>
</div>
</details>
<!-- Q5 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_553e7f30a22d') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>No. For orders placed under Cash on Delivery (COD) within the United Arab Emirates, couriers strictly accept United Arab Emirates Dirhams (AED) in exact or change amounts. Foreign currencies, traveler cheques, or international checks are not accepted upon doorstep arrival.</p>
</div>
</details>
<!-- Q6 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_07b1337170cd') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed space-y-2">
<p><strong class="text-primary font-bold">{{ __('content.t_db1b91148c9e') }}</strong> Complimentary Standard Delivery across all seven Emirates (1–2 business days).</p>
<p><strong class="text-primary font-bold">{{ __('content.t_97758a96c203') }}</strong> {{ __('content.t_9dcf53273b39') }}</p>
<p class="text-outline text-body-sm font-body-sm">{{ __('content.t_fd0d589c2c64') }}</p>
</div>
</details>
<!-- Q7 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_d11b627a1b8c') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_e058d0684c05') }}</p>
</div>
</details>
<!-- Q8 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_65e46bf6431d') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_4676b36a7622') }}</p>
</div>
</details>
</div>
</div>
<!-- 2. SAME-DAY DELIVERY -->
<div class="border border-outline-variant bg-surface-container-lowest">
<div class="bg-surface-container-high px-6 py-4 flex items-center justify-between border-b border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[24px]">electric_bolt</span>
<h2 class="font-headline-sm text-headline-sm text-primary">{{ __('content.t_d51dba2f69ba') }}</h2>
</div>
<span class="font-label-caps text-label-caps tracking-widest uppercase text-outline">4 Questions</span>
</div>
<div class="divide-y divide-outline-variant">
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_f93c369d816e') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_fae8e9cb4784') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_e67374d174d0') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_79cac92e58fe') }} <strong>800 7374672</strong>{{ __('content.t_41e13be826d9') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_1e1277dbc8a5') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_ebe56c25a915') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_07b1337170cd') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_44a4b22a14ae') }}</p>
</div>
</details>
</div>
</div>
<!-- 3. PICKUP POINT DELIVERY -->
<div class="border border-outline-variant bg-surface-container-lowest">
<div class="bg-surface-container-high px-6 py-4 flex items-center justify-between border-b border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[24px]">store</span>
<h2 class="font-headline-sm text-headline-sm text-primary">{{ __('content.t_68791cdc9e7e') }}</h2>
</div>
<span class="font-label-caps text-label-caps tracking-widest uppercase text-outline">3 Questions</span>
</div>
<div class="divide-y divide-outline-variant">
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_e67374d174d0') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_0033534fccc9') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_1e1277dbc8a5') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_2bd2da02c006') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_07b1337170cd') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_d0b8ed399e18') }}</p>
</div>
</details>
</div>
</div>
<!-- 4. CLICK & COLLECT -->
<div class="border border-outline-variant bg-surface-container-lowest">
<div class="bg-surface-container-high px-6 py-4 flex items-center justify-between border-b border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[24px]">shopping_basket</span>
<h2 class="font-headline-sm text-headline-sm text-primary">Click &amp; Collect (Free 2-Hour Pickup)</h2>
</div>
<span class="font-label-caps text-label-caps tracking-widest uppercase text-outline">10 Questions</span>
</div>
<div class="divide-y divide-outline-variant">
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_db04447dfbff') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_04ac3877ed8f') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_a446e490f807') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_6279fe864c52') }} <strong class="text-primary font-bold">{{ __('content.t_337e058ee0cd') }}</strong> {{ __('content.t_cd6f20a1bf37') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_797e577cd3dd') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_e8d647fc6c09') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_4fcb46adac5f') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Please place your Click &amp; Collect order at least 3 hours prior to store closing. Orders submitted after 7:30 PM will be processed and prepared for collection the following morning at store opening (10:00 AM).</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_9cbda536eefc') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_de33cb4c4e42') }} <strong class="text-primary font-bold">{{ __('content.t_5740f0a440b5') }}</strong> {{ __('content.t_96b50b33df3e') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_0c4800cdfa7b') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_ab638bfa16bb') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_ccb4fc7ffcf3') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_fc6fe74c205f') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_95cbb3d3fd2f') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_a8426cbab609') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_6cd75ee07073') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_86016845dcdc') }}</p>
</div>
</details>
</div>
</div>
<!-- 5. EXPRESS DELIVERY & FAILED DELIVERIES -->
<div class="border border-outline-variant bg-surface-container-lowest">
<div class="bg-surface-container-high px-6 py-4 flex items-center justify-between border-b border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[24px]">priority_high</span>
<h2 class="font-headline-sm text-headline-sm text-primary">{{ __('content.t_cc42d874c9a3') }}</h2>
</div>
<span class="font-label-caps text-label-caps tracking-widest uppercase text-outline">2 Questions</span>
</div>
<div class="divide-y divide-outline-variant">
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_8245711d50d4') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_098c4fdc447e') }}</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>{{ __('content.t_65e46bf6431d') }}</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>{{ __('content.t_206e0122fc7a') }}</p>
</div>
</details>
</div>
</div>
</section>
</div>
<!-- CLIENT SUPPORT & DIRECT CONTACT BOX -->
<section class="mt-16 bg-surface-container-lowest border border-primary p-8 md:p-12">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- Left: Email Support -->
<div class="lg:col-span-5 border-b lg:border-b-0 lg:border-r border-outline-variant pb-8 lg:pb-0 lg:pr-8">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-2">
            {{ __('content.t_9e526c6056a9') }}
          </span>
<h3 class="font-headline-md text-headline-md text-primary mb-3">{{ __('content.t_7bce4491e911') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
            {{ __('content.t_a53220385712') }}
          </p>
<div class="bg-surface-container-low border border-outline-variant p-4 mb-4 flex items-center justify-between">
<span class="font-title-md text-title-md text-primary select-all" id="emailAddress">customercare@sephora.ae</span>
<button class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary hover:text-secondary border-b border-primary pb-0.5 ml-2" onclick="navigator.clipboard.writeText('customercare@sephora.ae'); alert('Email copied to clipboard!');">
              COPY
            </button>
</div>
<a class="inline-block w-full text-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest py-3.5 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all duration-150" href="mailto:customercare@sephora.ae">
            {{ __('content.t_8c8146bc6b2d') }}
          </a>
</div>
<!-- Right: Regional Contact Phone Directory -->
<div class="lg:col-span-7">
<div class="flex items-center justify-between mb-4">
<h3 class="font-headline-md text-headline-md text-primary">{{ __('content.t_a74361b2c466') }}</h3>
<span class="font-label-caps text-label-caps text-outline uppercase tracking-wider">
              10:00 AM – 10:00 PM (GST) Daily
            </span>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<!-- UAE -->
<div class="p-4 bg-surface-container border border-primary">
<span class="font-label-caps text-label-caps uppercase tracking-wider text-outline block">United Arab Emirates (Toll Free)</span>
<a class="font-title-lg text-title-lg text-primary hover:underline font-bold block mt-1" href="tel:8007374672">800 7374672</a>
</div>
<!-- KSA -->
<div class="p-4 bg-surface-container-lowest border border-outline-variant">
<span class="font-label-caps text-label-caps uppercase tracking-wider text-outline block">{{ __('content.t_bf54cdcaf104') }}</span>
<a class="font-title-md text-title-md text-primary hover:underline font-semibold block mt-1" href="tel:+966114797382">+966 11 479 7382</a>
</div>
<!-- Kuwait -->
<div class="p-4 bg-surface-container-lowest border border-outline-variant">
<span class="font-label-caps text-label-caps uppercase tracking-wider text-outline block">Kuwait</span>
<a class="font-title-md text-title-md text-primary hover:underline font-semibold block mt-1" href="tel:+96522208178">+965 2220 8178</a>
</div>
<!-- Bahrain -->
<div class="p-4 bg-surface-container-lowest border border-outline-variant">
<span class="font-label-caps text-label-caps uppercase tracking-wider text-outline block">Bahrain</span>
<a class="font-title-md text-title-md text-primary hover:underline font-semibold block mt-1" href="tel:+97316639148">+973 1663 9148</a>
</div>
<!-- Oman -->
<div class="p-4 bg-surface-container-lowest border border-outline-variant">
<span class="font-label-caps text-label-caps uppercase tracking-wider text-outline block">Oman</span>
<a class="font-title-md text-title-md text-primary hover:underline font-semibold block mt-1" href="tel:+96821030711">+968 2103 0711</a>
</div>
<!-- Qatar -->
<div class="p-4 bg-surface-container-lowest border border-outline-variant">
<span class="font-label-caps text-label-caps uppercase tracking-wider text-outline block">Qatar</span>
<a class="font-title-md text-title-md text-primary hover:underline font-semibold block mt-1" href="tel:+97444196648">+974 4419 6648</a>
</div>
</div>
</div>
</div>
</section>
<!-- TRUST BADGES ROW -->
<section class="mt-14 border-y border-outline-variant py-8 bg-surface-container-lowest">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">local_shipping</span>
<span class="font-title-md text-title-md text-primary uppercase tracking-wider">{{ __('ui.free_delivery') }}</span>
<span class="font-body-sm text-body-sm text-outline mt-0.5">{{ __('content.t_d76dbfd4ac0b') }}</span>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">verified</span>
<span class="font-title-md text-title-md text-primary uppercase tracking-wider">{{ __('ui.authentic') }}</span>
<span class="font-body-sm text-body-sm text-outline mt-0.5">{{ __('content.t_9ae5bfb10a03') }}</span>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">replay</span>
<span class="font-title-md text-title-md text-primary uppercase tracking-wider">{{ __('ui.easy_returns') }}</span>
<span class="font-body-sm text-body-sm text-outline mt-0.5">{{ __('content.t_de87fa640461') }}</span>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">stars</span>
<span class="font-title-md text-title-md text-primary uppercase tracking-wider">{{ __('content.t_302ae874320b') }}</span>
<span class="font-body-sm text-body-sm text-outline mt-0.5">{{ __('content.t_82fc6901998f') }}</span>
</div>
</div>
</section>
</main>
<!-- NEWSLETTER SIGNUP ROW -->
<section class="bg-surface-container border-t border-outline-variant py-10">
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin flex flex-col md:flex-row items-center justify-between gap-6">
<div>
<h4 class="font-headline-sm text-headline-sm text-primary uppercase tracking-wider">{{ __('content.t_e01e16e1c2df') }}</h4>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ __('content.t_8682754f79a1') }}</p>
</div>
<form class="flex w-full md:w-auto max-w-md items-center" onsubmit="event.preventDefault(); alert('Subscribed to Sephora VIP newsletter!');" data-newsletter-form>
<input class="w-full md:w-80 px-4 py-3 border border-outline bg-surface-container-lowest text-primary font-body-sm text-body-sm placeholder:text-outline focus:border-primary focus:ring-0 outline-none" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 py-3.5 hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors whitespace-nowrap" type="submit">
          Subscribe
        </button>
</form>
</div>
</section>
<!-- FOOTER (Shared Component Exact Execution) -->
@endsection
