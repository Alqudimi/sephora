@extends('layouts.app')

@section('title', __('meta.faq'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<main class="w-full">
<!-- Hero Intro Section -->
<section class="bg-surface-container-lowest border-b border-outline-variant py-10 md:py-16">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- Breadcrumb -->
<nav class="flex items-center gap-2 mb-6">
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a>
<span class="text-outline-variant text-[12px]">/</span>
<span class="font-body-sm text-body-sm text-primary font-bold">{{ __('ui.faq') }}</span>
</nav>
<!-- Editorial Hero Title -->
<div class="max-w-3xl">
<span class="bg-primary text-on-primary px-2.5 py-1 font-label-tag text-label-tag uppercase tracking-widest inline-block mb-3">
            {{ __('content.t_84d3e9880e34') }}
          </span>
<h1 class="font-headline-lg text-headline-lg md:text-display-hero text-primary tracking-tight font-bold mb-4">{{ __('ui.faq') }}</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
            {{ __('content.t_e1c4afab8b01') }}
          </p>
</div>
<!-- Search FAQ Input Box -->
<div class="mt-8 max-w-3xl">
<div class="relative flex items-stretch border-2 border-primary bg-surface-container-lowest">
<span class="material-symbols-outlined self-center ml-4 text-outline text-[24px]">search</span>
<input class="w-full bg-transparent border-0 px-4 py-4 text-on-surface font-body-md text-body-md focus:ring-0 placeholder:text-outline" id="faqSearchInput" placeholder="{{ __('content.t_131f9e0a2537') }}" type="text"/>
<button class="bg-primary hover:bg-neutral-800 text-on-primary px-8 font-label-caps text-label-caps tracking-widest uppercase transition-colors flex items-center justify-center">{{ __('ui.search') }}</button>
</div>
<div class="flex flex-wrap gap-2 mt-{{ __('ui.items_count_label', ['count' => '3']) }}-center">
<span class="font-label-caps text-label-caps text-outline uppercase">{{ __('content.t_8e0fe5a1ac63') }}</span>
<button class="text-on-surface hover:text-primary border border-outline-variant px-2.5 py-0.5 font-label-tag text-label-tag bg-surface-container-low transition-colors">{{ __('content.t_feed8ebda059') }}</button>
<button class="text-on-surface hover:text-primary border border-outline-variant px-2.5 py-0.5 font-label-tag text-label-tag bg-surface-container-low transition-colors">{{ __('ui.beauty_pass_points') }}</button>
<button class="text-on-surface hover:text-primary border border-outline-variant px-2.5 py-0.5 font-label-tag text-label-tag bg-surface-container-low transition-colors">{{ __('content.t_4c834b2a77fe') }}</button>
<button class="text-on-surface hover:text-primary border border-outline-variant px-2.5 py-0.5 font-label-tag text-label-tag bg-surface-container-low transition-colors">{{ __('content.t_d7a59de2f92e') }}</button>
</div>
</div>
</div>
</section>
<!-- ========================================== -->
<!-- 4. FAQ CATEGORY NAVIGATION BENTO GRID    -->
<!-- ========================================== -->
<section class="py-12 md:py-16 bg-background border-b border-outline-variant">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="flex items-center justify-between mb-8 pb-3 border-b border-primary">
<div>
<span class="font-label-caps text-label-caps text-outline uppercase tracking-widest block">{{ __('content.t_75cdcd8296a2') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase font-bold tracking-wider">
              {{ __('content.t_af053cb0cd01') }}
            </h2>
</div>
<span class="font-label-caps text-label-caps text-outline uppercase">{{ __('content.t_217aed3df5ee') }}</span>
</div>
<!-- 13 Official Category Cards Grid -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3.5 md:gap-4">
<!-- Category 1: MY SEPHORA -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#my-sephora">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">stars</span>
<span class="font-label-tag text-label-tag text-secondary font-bold">01</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('content.t_a4231e2500a9') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_6828c0892ba6') }}</p>
</div>
</a>
<!-- Category 2: Stores -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#stores">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">storefront</span>
<span class="font-label-tag text-label-tag text-outline">02</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('ui.stores') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_31c2c2d48617') }}</p>
</div>
</a>
<!-- Category 3: Services -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#services">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">auto_awesome</span>
<span class="font-label-tag text-label-tag text-outline">03</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('ui.services') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_538d6f50404f') }}</p>
</div>
</a>
<!-- Category 4: Online Account -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#online-account">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">manage_accounts</span>
<span class="font-label-tag text-label-tag text-outline">04</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('content.t_e94aa6260312') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_2c620dba8eeb') }}</p>
</div>
</a>
<!-- Category 5: Online Shopping -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#online-shopping">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">shopping_cart</span>
<span class="font-label-tag text-label-tag text-outline">05</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('content.t_57cc0a7b1b8f') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_bd2d27277528') }}</p>
</div>
</a>
<!-- Category 6: Products -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#products">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">verified</span>
<span class="font-label-tag text-label-tag text-outline">06</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('ui.products') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_a9d6f1caecd7') }}</p>
</div>
</a>
<!-- Category 7: Payment -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#payment">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">credit_card</span>
<span class="font-label-tag text-label-tag text-outline">07</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('ui.payment') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_a34626686862') }}</p>
</div>
</a>
<!-- Category 8: Offers, Samples & Gifts -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#offers-samples">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">redeem</span>
<span class="font-label-tag text-label-tag text-outline">08</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('content.t_672200de3a97') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_25441a1b5e99') }}</p>
</div>
</a>
<!-- Category 9: Delivery -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#delivery">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">local_shipping</span>
<span class="font-label-tag text-label-tag text-outline">09</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('ui.delivery') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_e93e1a14ccec') }}</p>
</div>
</a>
<!-- Category 10: Cancellation & Refund -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#cancellation-refund">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">assignment_return</span>
<span class="font-label-tag text-label-tag text-outline">10</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('ui.cancellation_refund') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_16f9224792f5') }}</p>
</div>
</a>
<!-- Category 11: Health & Safety -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#health-safety">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">sanitizer</span>
<span class="font-label-tag text-label-tag text-outline">11</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('content.t_fd9c888975e8') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_7283e3cfab13') }}</p>
</div>
</a>
<!-- Category 12: Corporate Information -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#corporate-information">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">corporate_fare</span>
<span class="font-label-tag text-label-tag text-outline">12</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('content.t_dea335290fc6') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_a14d9d9f5093') }}</p>
</div>
</a>
<!-- Category 13: Gift Cards -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44 col-span-2 sm:col-span-1" href="#gift-cards">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">card_giftcard</span>
<span class="font-label-tag text-label-tag text-outline">13</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">{{ __('ui.gift_cards') }}</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">{{ __('content.t_a6a56c272d69') }}</p>
</div>
</a>
</div>
</div>
</section>
<!-- ========================================== -->
<!-- 5. TOP QUESTIONS / TRENDING ACCORDION      -->
<!-- ========================================== -->
<section class="py-12 md:py-16 bg-surface-container-lowest">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="flex items-center justify-between mb-8 pb-3 border-b border-primary">
<div>
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest block font-bold">{{ __('content.t_3bb37ce6edd3') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase font-bold tracking-wider">
              {{ __('content.t_a853b2bbf481') }}
            </h2>
</div>
<span class="font-label-caps text-label-caps text-outline uppercase hidden sm:inline">{{ __('content.t_36385ec9c7c0') }}</span>
</div>
<!-- Accordion Container -->
<div class="space-y-4 max-w-4xl" id="accordionContainer">
<!-- Accordion Item 1 (DEFAULT OPEN) -->
<div class="border border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>{{ __('content.t_e069b31db99b') }}</span>
<span class="material-symbols-outlined text-primary transition-transform duration-200 shrink-0 transform rotate-180">expand_more</span>
</button>
<div class="px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p class="mb-3">
                {{ __('content.t_b739901782d0') }}
              </p>
<div class="bg-surface-container-low p-4 border border-outline-variant flex flex-col sm:flex-row sm:items-center justify-between gap-4">
<div>
<span class="font-label-caps text-label-caps text-outline uppercase block">{{ __('content.t_42b85c4c8636') }}</span>
<p class="text-primary font-bold text-body-md">{{ __('content.t_ea9eb44cf9a6') }} <span class="font-mono text-secondary">customercare@sephora.ae</span></p>
</div>
<div class="flex items-center gap-3">
<button class="border border-primary bg-surface-container-lowest hover:bg-primary hover:text-on-primary text-primary px-4 py-2 font-label-caps text-label-caps tracking-widest uppercase transition-colors" onclick="copyToClipboard('customercare@sephora.ae')">
                    {{ __('ui.copy') }}
                  </button>
<a class="bg-primary text-on-primary hover:bg-neutral-800 px-5 py-2 font-label-caps text-label-caps tracking-widest uppercase transition-colors" href="#contact-section">
                    {{ __('content.t_8c8146bc6b2d') }}
                  </a>
</div>
</div>
</div>
</div>
<!-- Accordion Item 2 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>{{ __('content.t_14afa7dd1476') }}</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                {{ __('content.long_bd7abbe37a93) }} <strong>{{ __('content.t_b32a5969f15d') }}</strong>.
              </p>
</div>
</div>
<!-- Accordion Item 3 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>{{ __('content.t_8634ff02efa2') }}</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                {{ __('content.t_0ab02c418173') }} <strong>{{ __('content.t_1d01c362549f') }}</strong> {{ __('content.long_1b2f2fb56274) }}
              </p>
</div>
</div>
<!-- Accordion Item 4 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>{{ __('content.t_bcd0295e146d') }}</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                {{ __('content.t_7adaecad8168') }}
              </p>
</div>
</div>
<!-- Accordion Item 5 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>{{ __('content.t_30af5d813dd6') }}</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                {{ __('content.t_989970830f62') }} <strong>{{ __('ui.stores_services') }}</strong> {{ __('content.t_a3fc8af4ac3f') }}
              </p>
</div>
</div>
<!-- Accordion Item 6 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>{{ __('content.t_2a31f36005df') }}</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                {{ __('content.long_604db2ddb43f) }}
              </p>
</div>
</div>
<!-- Accordion Item 7 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>{{ __('content.t_1be739cb6f41') }}</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                {{ __('content.t_f315aec1f36d') }}
              </p>
</div>
</div>
</div>
</div>
</section>
<!-- ========================================== -->
<!-- 6. DEDICATED CUSTOMER SUPPORT PANEL       -->
<!-- ========================================== -->
<section class="py-12 md:py-16 bg-surface-container-low border-b border-outline-variant" id="contact-section">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="bg-surface-container-lowest border border-primary p-6 md:p-10 lg:p-12">
<div class="flex flex-col lg:flex-row lg:items-start justify-between gap-8 pb-10 border-b border-outline-variant">
<!-- Left Header -->
<div class="max-w-xl">
<span class="bg-secondary text-on-secondary px-2.5 py-0.5 font-label-tag text-label-tag uppercase tracking-widest inline-block mb-3">
                {{ __('content.t_51aa9f6e94e1') }}
              </span>
<h2 class="font-headline-md text-headline-md text-primary font-bold uppercase mb-2">
                {{ __('content.t_e4d3525ca7a9') }}
              </h2>
<p class="font-body-md text-body-md text-on-surface-variant">
                {{ __('content.t_f06285167b2f') }}
              </p>
<div class="flex items-center gap-2 mt-4 text-primary">
<span class="material-symbols-outlined text-[20px] text-secondary">schedule</span>
<span class="font-label-caps text-label-caps tracking-wider uppercase font-bold">
                  {{ __('content.long_725823585035) }}
                </span>
</div>
</div>
<!-- Email & Direct Actions -->
<div class="bg-surface-container p-6 border border-outline-variant flex flex-col justify-between max-w-md w-full">
<span class="font-label-caps text-label-caps text-outline uppercase block mb-1">{{ __('content.t_3653a49c649a') }}</span>
<a class="font-title-lg text-title-lg text-primary font-bold hover:text-secondary mb-4 break-all" href="mailto:customercare@sephora.ae">
                customercare@sephora.ae
              </a>
<div class="flex items-center gap-3">
<button class="flex-1 border border-primary bg-surface-container-lowest hover:bg-primary hover:text-on-primary text-primary py-2.5 px-4 font-label-caps text-label-caps tracking-widest uppercase transition-colors" onclick="copyToClipboard('customercare@sephora.ae')">
                  {{ __('ui.copy') }}
                </button>
<a class="flex-1 text-center bg-primary hover:bg-neutral-800 text-on-primary py-2.5 px-4 font-label-caps text-label-caps tracking-widest uppercase transition-colors" href="/">
                  {{ __('content.t_8c8146bc6b2d') }}
                </a>
</div>
</div>
</div>
<!-- Regional Call Center Numbers Grid -->
<div class="pt-10">
<h3 class="font-title-lg text-title-lg text-primary uppercase font-bold tracking-wider mb-6">
              {{ __('content.t_6bc9a03dea02') }}
            </h3>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
<!-- UAE -->
<div class="border-l-2 border-primary pl-4 py-1">
<span class="font-label-caps text-label-caps text-outline block uppercase">{{ __('content.t_d115b8d5acb8') }}</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:8007374672">
                  8007374672
                </a>
<span class="font-label-tag text-[9px] text-secondary font-bold uppercase tracking-wider">{{ __('content.t_5906bc0d825e') }}</span>
</div>
<!-- Saudi Arabia -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">{{ __('content.t_6f49c31192f5') }}</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+966114797382">
                  +966 11 479 7382
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">{{ __('ui.international') }}</span>
</div>
<!-- Kuwait -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">{{ __('ui.kuwait') }}</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+96522208178">
                  +965 2220 8178
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">{{ __('content.t_c52e783d55ae') }}</span>
</div>
<!-- Bahrain -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">{{ __('ui.bahrain') }}</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+97316639148">
                  +973 1663 9148
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">{{ __('content.t_c52e783d55ae') }}</span>
</div>
<!-- Oman -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">{{ __('ui.oman') }}</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+96821030711">
                  +968 2103 0711
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">{{ __('content.t_c52e783d55ae') }}</span>
</div>
<!-- Qatar -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">{{ __('ui.qatar') }}</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+97444196648">
                  +974 4419 6648
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">{{ __('content.t_c52e783d55ae') }}</span>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- ========================================== -->
<!-- 7. TRUST & GUARANTEE SERVICE PILLARS      -->
<!-- ========================================== -->
<section class="border-b border-outline-variant bg-surface-container-lowest py-8">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-outline-variant">
<div class="flex flex-col items-center justify-center p-3">
<span class="material-symbols-outlined text-primary text-[32px] mb-2">local_shipping</span>
<h4 class="font-title-md text-title-md text-primary font-bold uppercase">{{ __('ui.free_delivery') }}</h4>
<p class="font-body-sm text-body-sm text-outline">{{ __('content.t_d76dbfd4ac0b') }}</p>
</div>
<div class="flex flex-col items-center justify-center p-3 pt-6 md:pt-3">
<span class="material-symbols-outlined text-primary text-[32px] mb-2">verified_user</span>
<h4 class="font-title-md text-title-md text-primary font-bold uppercase">{{ __('ui.secure_payment') }}</h4>
<p class="font-body-sm text-body-sm text-outline">{{ __('content.t_0d9411173996') }}</p>
</div>
<div class="flex flex-col items-center justify-center p-3 pt-6 md:pt-3">
<span class="material-symbols-outlined text-primary text-[32px] mb-2">replay</span>
<h4 class="font-title-md text-title-md text-primary font-bold uppercase">{{ __('ui.easy_returns') }}</h4>
<p class="font-body-sm text-body-sm text-outline">{{ __('content.t_de87fa640461') }}</p>
</div>
<div class="flex flex-col items-center justify-center p-3 pt-6 md:pt-3">
<span class="material-symbols-outlined text-primary text-[32px] mb-2">support_agent</span>
<h4 class="font-title-md text-title-md text-primary font-bold uppercase">{{ __('ui.customer_service') }}</h4>
<p class="font-body-sm text-body-sm text-outline">{{ __('content.t_4f20581dfe8e') }}</p>
</div>
</div>
</div>
</section>
</main>
<!-- ========================================== -->
<!-- 8. OFFICIAL FOOTER (SHARED COMPONENT)     -->
<!-- ========================================== -->
<!-- ========================================== -->
<!-- TOAST NOTIFICATION CONTAINER               -->
<!-- ========================================== -->
<div class="fixed bottom-6 right-6 bg-primary text-on-primary border border-surface-container-lowest px-5 py-3 shadow-2xl transition-all duration-300 opacity-0 pointer-events-none translate-y-4 z-50" id="copyToast">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-[20px]">check_circle</span>
<span class="font-label-caps text-label-caps uppercase tracking-wider">{{ __('content.t_13902280590d') }}</span>
</div>
</div>
<!-- Inline Script for Accordion, Search Filter, and Clipboard -->
<script>
    function toggleAccordion(button) {
      const parent = button.parentElement;
      const content = button.nextElementSibling;
      const icon = button.querySelector('.material-symbols-outlined');
      
      const isOpen = !content.classList.contains('hidden');

      if (isOpen) {
        content.classList.add('hidden');
        icon.classList.remove('rotate-180');
        parent.classList.remove('border-primary');
        parent.classList.add('border-outline-variant');
      } else {
        content.classList.remove('hidden');
        icon.classList.add('rotate-180');
        parent.classList.add('border-primary');
        parent.classList.remove('border-outline-variant');
      }
    }

    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        const toast = document.getElementById('copyToast');
        toast.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
        toast.classList.add('opacity-100', 'translate-y-0');
        
        setTimeout(() => {
          toast.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
          toast.classList.remove('opacity-100', 'translate-y-0');
        }, 2800);
      });
    }

    // Dynamic Filter for FAQ items
    const faqInput = document.getElementById('faqSearchInput');
    if (faqInput) {
      faqInput.addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        const items = document.querySelectorAll('#accordionContainer > div');
        
        items.forEach(item => {
          const text = item.innerText.toLowerCase();
          if (text.includes(term)) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    }
  </script>
@endsection

@push('scripts')
<script>
function toggleAccordion(button) {
      const parent = button.parentElement;
      const content = button.nextElementSibling;
      const icon = button.querySelector('.material-symbols-outlined');
      
      const isOpen = !content.classList.contains('hidden');

      if (isOpen) {
        content.classList.add('hidden');
        icon.classList.remove('rotate-180');
        parent.classList.remove('border-primary');
        parent.classList.add('border-outline-variant');
      } else {
        content.classList.remove('hidden');
        icon.classList.add('rotate-180');
        parent.classList.add('border-primary');
        parent.classList.remove('border-outline-variant');
      }
    }

    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        const toast = document.getElementById('copyToast');
        toast.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
        toast.classList.add('opacity-100', 'translate-y-0');
        
        setTimeout(() => {
          toast.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
          toast.classList.remove('opacity-100', 'translate-y-0');
        }, 2800);
      });
    }

    // Dynamic Filter for FAQ items
    const faqInput = document.getElementById('faqSearchInput');
    if (faqInput) {
      faqInput.addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        const items = document.querySelectorAll('#accordionContainer > div');
        
        items.forEach(item => {
          const text = item.innerText.toLowerCase();
          if (text.includes(term)) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    }
</script>
@endpush
