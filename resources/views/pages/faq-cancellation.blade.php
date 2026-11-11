@extends('layouts.app')

@section('title', __('meta.cancellation_refund'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- MAIN CANVAS -->
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- 3. BREADCRUMB & PAGE HEADER -->
<section class="border-b border-outline-variant pb-8 mb-8">
<!-- Breadcrumb -->
<nav aria-label="{{ __('ui.breadcrumb') }}" class="mb-4">
<ol class="flex items-center space-x-2 font-label-caps text-label-caps tracking-widest text-on-surface-variant">
<li><a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a></li>
<li><span>/</span></li>
<li><a class="hover:text-primary transition-colors" href="/faq">{{ __('ui.faq') }}</a></li>
<li><span>/</span></li>
<li class="text-primary font-bold">{{ __('ui.cancellation_refund') }}</li>
</ol>
</nav>
<!-- Editorial Header Block -->
<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
<div class="max-w-3xl">
<div class="inline-block bg-primary text-on-primary px-3 py-1 font-label-caps text-label-caps tracking-widest font-bold mb-3">
            {{ __('content.t_84d3e9880e34') }}
          </div>
<h1 class="font-display-hero text-headline-md md:text-headline-lg lg:text-[42px] font-normal tracking-tight text-primary leading-tight mb-3">
            {{ __('content.t_d37f93556461') }}
          </h1>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            {{ __('content.t_5ea90db605f5') }}
          </p>
</div>
<!-- Status Badges -->
<div class="flex flex-row lg:flex-col items-start lg:items-end gap-2 border-t lg:border-t-0 border-outline-variant pt-4 lg:pt-0">
<span class="inline-flex items-center px-2.5 py-1 border border-primary text-primary font-label-caps text-label-caps font-bold">
<span class="w-1.5 h-1.5 bg-secondary rounded-full mr-2"></span>
            {{ __('content.long_1068075c1633) }}
          </span>
<span class="inline-flex items-center px-2.5 py-1 bg-surface-container-high text-on-surface font-label-caps text-label-caps font-bold">
            {{ __('content.t_4d93a8863522') }}
          </span>
</div>
</div>
</section>
<!-- 4. QUICK POLICY HIGHLIGHT CARDS (3-COLUMN VITRINE) -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
<!-- Card 1 -->
<div class="border border-primary bg-surface-container-lowest p-6 flex flex-col justify-between hover:border-black transition-all">
<div>
<div class="flex items-center justify-between mb-4">
<span class="material-symbols-outlined text-primary text-3xl">cached</span>
<span class="font-label-tag text-label-tag text-secondary font-bold">{{ __('content.t_f21afec40955') }}</span>
</div>
<h3 class="font-title-lg text-title-lg text-primary mb-2">{{ __('content.t_f84b2b8eb50c') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
            {{ __('content.t_591e59345e2d') }}
          </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between text-primary">
<span class="font-label-caps text-label-caps font-bold">{{ __('content.t_41f7d44910ea') }}</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</div>
</div>
<!-- Card 2 -->
<div class="border border-primary bg-surface-container-lowest p-6 flex flex-col justify-between hover:border-black transition-all">
<div>
<div class="flex items-center justify-between mb-4">
<span class="material-symbols-outlined text-primary text-3xl">credit_card</span>
<span class="font-label-tag text-label-tag text-secondary font-bold">GUARANTEED</span>
</div>
<h3 class="font-title-lg text-title-lg text-primary mb-2">{{ __('content.t_19b713875b32') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
            {{ __('content.t_1b8edd0f399b') }}
          </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between text-primary">
<span class="font-label-caps text-label-caps font-bold">{{ __('content.t_7610c8cd7601') }}</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</div>
</div>
<!-- Card 3 -->
<div class="border border-primary bg-surface-container-lowest p-6 flex flex-col justify-between hover:border-black transition-all">
<div>
<div class="flex items-center justify-between mb-4">
<span class="material-symbols-outlined text-primary text-3xl">verified</span>
<span class="font-label-tag text-label-tag text-secondary font-bold">{{ __('content.t_e507af037bac') }}</span>
</div>
<h3 class="font-title-lg text-title-lg text-primary mb-2">{{ __('content.t_bbaec6f109eb') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
            {{ __('content.t_eb1ab7ceb816') }}
          </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between text-primary">
<span class="font-label-caps text-label-caps font-bold">{{ __('content.t_5dbbfac292f3') }}</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</div>
</div>
</section>
<!-- 5. MAIN CONTENT LAYOUT: SIDEBAR + FAQS -->
<div class="grid grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start mb-16">
<!-- LEFT SIDEBAR: FAQ CATEGORIES -->
<aside class="col-span-12 lg:col-span-4 sticky top-28 space-y-6">
<div class="border border-outline-variant bg-surface-container-lowest p-5">
<h2 class="font-title-lg text-title-lg text-primary mb-4 pb-3 border-b border-outline-variant tracking-wider uppercase font-bold">
            {{ __('content.t_4377957ea24e') }}
          </h2>
<ul class="space-y-1">
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>{{ __('content.t_6e6fc2347007') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/stores">
<span>{{ __('ui.stores_services') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>{{ __('content.t_e94aa6260312') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>{{ __('content.t_57cc0a7b1b8f') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>{{ __('ui.products') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>{{ __('ui.payment_methods') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>{{ __('content.t_672200de3a97') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>{{ __('ui.delivery') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<!-- Active Nav Item -->
<li>
<a class="flex items-center justify-between px-3 py-2.5 bg-primary text-on-primary font-title-md text-title-md font-bold" href="/faq/cancellation-and-refund">
<span>{{ __('ui.cancellation_refund') }}</span>
<span class="material-symbols-outlined text-sm text-on-primary">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>{{ __('content.t_fd9c888975e8') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>{{ __('content.t_dea335290fc6') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/gift-card-info">
<span>{{ __('ui.gift_cards') }}</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
</ul>
</div>
<!-- Immediate Help Quick Banner -->
<div class="border border-outline-variant bg-surface-container-low p-5">
<div class="flex items-center space-x-2 text-secondary mb-2">
<span class="material-symbols-outlined text-lg">support_agent</span>
<span class="font-label-caps text-label-caps font-bold">{{ __('content.t_4c3859719bdb') }}</span>
</div>
<h4 class="font-title-lg text-title-lg text-primary mb-1">{{ __('content.t_d984e5464133') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            {{ __('content.t_e673a485ecce') }}
          </p>
<a class="inline-flex items-center justify-center w-full bg-primary text-on-primary py-2.5 font-label-caps text-label-caps font-bold hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="tel:8007374672">
            CALL 800 7374672
          </a>
</div>
</aside>
<!-- RIGHT MAIN AREA: ALL FAQ ACCORDIONS -->
<section class="col-span-12 lg:col-span-8 space-y-12">
<!-- SECTION 1: CANCELLATION (4 QUESTIONS) -->
<div>
<div class="flex items-center justify-between border-b-2 border-primary pb-3 mb-6">
<div class="flex items-center space-x-3">
<span class="material-symbols-outlined text-2xl text-primary">cancel</span>
<h2 class="font-display-hero text-headline-sm md:text-headline-md text-primary">{{ __('ui.cancellation_label') }}</h2>
</div>
<span class="font-label-caps text-label-caps font-bold bg-surface-container-high px-2.5 py-1 text-on-surface">4 QUESTIONS</span>
</div>
<div class="border border-outline-variant divide-y divide-outline-variant bg-surface-container-lowest">
<!-- Question 1 -->
<details class="group p-5 transition-all" open="">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_67b7482be1e9') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  {{ __('content.t_b0c2223cb6c7') }} <strong>{{ __('content.t_5740f0a440b5') }}</strong> {{ __('content.t_24bbcf2d3998') }}
                </p>
<p>
                  {{ __('content.t_9fd38760d2c8') }}
                </p>
</div>
</details>
<!-- Question 2 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_518944c41fe5') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  {{ __('content.t_b0a6bcb5b3ea') }} <strong>{{ __('content.t_a477be62832c') }}</strong> {{ __('content.t_4688140e938f') }}
                </p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li>{{ __('content.t_cb60732179ce') }} <strong>{{ __('content.t_f149628ea80b') }}</strong> {{ __('content.t_c2b4b50f5bf1') }}</li>
<li>{{ __('content.t_ca3bc4d20fba') }}</li>
<li>{{ __('content.t_75b027a20726') }} <strong>800 7374672</strong>.</li>
</ul>
<p>{{ __('content.t_1c58abeb66d8') }}</p>
</div>
</details>
<!-- Question 3 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_65e46bf6431d') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  {{ __('content.t_970004efbc51') }} <strong>{{ __('content.t_f30255c8a15f') }}</strong> {{ __('content.t_af129b106ff8') }}
                </p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li>{{ __('content.t_b3c0fdc9e0ba') }}</li>
<li>{{ __('content.long_ab120edfb137) }}</li>
<li>{{ __('content.t_70eaed8ecf9c') }}</li>
</ul>
<p>
                  {{ __('content.t_16fc944ca5d7') }}
                </p>
</div>
</details>
<!-- Question 4 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_273b8538ca35') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  {{ __('content.t_317253bac5e3') }}
                </p>
<ul class="list-disc pl-5 space-y-1.5">
<li><strong>{{ __('content.t_35e0f3b736d0') }}</strong> {{ __('content.t_3f0218ac4269') }}</li>
<li><strong>{{ __('content.t_d90294cd6a58') }}</strong> {{ __('content.t_7bfd787144a1') }}</li>
</ul>
</div>
</details>
</div>
</div>
<!-- SECTION 2: REFUND & RETURN POLICY (11 QUESTIONS) -->
<div>
<div class="flex items-center justify-between border-b-2 border-primary pb-3 mb-6">
<div class="flex items-center space-x-3">
<span class="material-symbols-outlined text-2xl text-primary">assignment_return</span>
<h2 class="font-display-hero text-headline-sm md:text-headline-md text-primary">{{ __('content.t_d979bb6563ba') }}</h2>
</div>
<span class="font-label-caps text-label-caps font-bold bg-surface-container-high px-2.5 py-1 text-on-surface">11 QUESTIONS</span>
</div>
<div class="border border-outline-variant divide-y divide-outline-variant bg-surface-container-lowest">
<!-- R1 -->
<details class="group p-5 transition-all" open="">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_d7f6a3782086') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  {{ __('content.t_267dde213d8c') }} <strong>{{ __('content.t_090ed38acdf5') }}</strong> {{ __('content.t_4ad599040d09') }}
                </p>
<p class="mb-3">{{ __('content.t_ce5551efbe46') }}</p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li>{{ __('content.t_d148bfee6f0a') }}</li>
<li>{{ __('content.long_709af5f44ddd) }}</li>
<li>{{ __('content.long_1619f3a90bae) }}</li>
</ul>
<p class="text-body-sm text-outline">{{ __('content.t_0a2824d15c1e') }}</p>
</div>
</details>
<!-- R2 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_e8a6b3b2c9ef') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
<strong>{{ __('ui.no_word') }}</strong> {{ __('content.t_be877becee5f') }}
                </p>
<p>
                  {{ __('content.t_4f75cb23a83c') }}
                </p>
</div>
</details>
<!-- R3 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_8acf5aee9e0f') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  {{ __('content.t_69a311991e64') }} <strong>{{ __('ui.hours_count', ['count' => 48]) }}</strong> {{ __('content.t_0ad5a89c8269') }} <a class="text-primary font-bold underline" href="mailto:customercare@sephora.ae">customercare@sephora.ae</a> {{ __('content.t_096d01a7b7d5') }} <strong>800 7374672</strong>.
                </p>
<p class="mb-3">{{ __('content.t_e30ee432addb') }}</p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li>{{ __('content.long_5b0956850b1d) }}</li>
<li>{{ __('content.t_80bcc306a74d') }}</li>
</ul>
<p>
                  {{ __('content.t_c24c5798cea9') }}
                </p>
</div>
</details>
<!-- R4 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_28d1b53f560d') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  {{ __('content.t_b4515182f14f') }} <strong>{{ __('content.t_f92be87d9d4e') }}</strong> {{ __('content.t_9d81b1090ece') }}
                </p>
<ol class="list-decimal pl-5 space-y-1.5 mb-3">
<li>{{ __('content.t_cd01e1a04953') }}</li>
<li>{{ __('content.long_18d1e343c8af) }}</li>
<li>{{ __('content.t_8cc6dda63da0') }}</li>
</ol>
</div>
</details>
<!-- R5 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_6cd75ee07073') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  {{ __('content.t_a8e51f4d5d88') }} <strong>{{ __('content.t_6007efe696d5') }}</strong> {{ __('content.t_d50f9957fdfd') }}
                </p>
</div>
</details>
<!-- R6 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_d11b627a1b8c') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">{{ __('content.long_48c9f7215ec0) }}</p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li><strong>{{ __('content.t_5fa3a10ad4f9') }}</strong> {{ __('content.t_e1657f6eb5fa') }}</li>
<li><strong>{{ __('content.t_afd50bdaffe8') }}</strong> {{ __('content.t_0702ee29b2c1') }}</li>
</ul>
<p class="text-body-sm text-outline">{{ __('content.t_eff2f381fec2') }}</p>
</div>
</details>
<!-- R7 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_7654b3378c70') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  {{ __('content.t_d83837ff3651') }} <strong>{{ __('content.t_0f01bc9d0b38') }}</strong> {{ __('content.t_ac5c10931920') }}
                </p>
</div>
</details>
<!-- R8 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_3b65eba8688d') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  {{ __('content.long_26766fee2e28) }} <strong>{{ __('content.t_17df9d14c1cf') }}</strong>{{ __('content.t_4b74db11d63a') }}
                </p>
</div>
</details>
<!-- R9 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_c017505c44f5') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  {{ __('content.t_cd22d7a08031') }} <strong>{{ __('content.t_b575c7b48133') }}</strong> {{ __('content.t_4c92f032d0a3') }}
                </p>
</div>
</details>
<!-- R10 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_37ac29bec7ef') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  {{ __('content.t_445b99d4b96a') }} <strong>{{ __('content.t_c0ede9cee6cd') }}</strong>{{ __('content.t_76f0d9078990') }}
                </p>
</div>
</details>
<!-- R11 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">{{ __('content.t_0ee393d8edd5') }}</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  {{ __('content.t_4e4ab1b0eb4d') }}
                </p>
<p class="mb-3">
                  {{ __('content.long_3941a4435def) }}
                </p>
<p class="text-body-sm text-outline">{{ __('content.t_8789584a5ba4') }}</p>
</div>
</details>
</div>
</div>
</section>
</div>
<!-- 6. DEDICATED CLIENT CONCIERGE CONTACT BOX -->
<section class="border border-primary bg-surface-container-lowest p-8 lg:p-10 mb-16">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">
<!-- Left: Email Us Directly -->
<div class="lg:col-span-6 lg:border-r lg:border-outline-variant lg:pr-8">
<div class="inline-block bg-primary text-on-primary px-3 py-1 font-label-caps text-label-caps tracking-widest font-bold mb-4">
            {{ __('content.t_9e526c6056a9') }}
          </div>
<h3 class="font-display-hero text-headline-sm md:text-headline-md text-primary mb-2">{{ __('content.t_7bce4491e911') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
            {{ __('content.t_84dd85fe65cf') }}
          </p>
<div class="border border-outline bg-surface-container-low p-4 flex flex-col sm:flex-row items-center justify-between gap-4 mb-4">
<div class="flex items-center space-x-3">
<span class="material-symbols-outlined text-primary">mail</span>
<span class="font-title-lg text-title-lg font-bold text-primary select-all">customercare@sephora.ae</span>
</div>
<button class="w-full sm:w-auto bg-surface-container-lowest border border-primary px-4 py-2 font-label-caps text-label-caps font-bold hover:bg-primary hover:text-on-primary transition-colors" onclick="navigator.clipboard.writeText('customercare@sephora.ae'); alert('Email copied to clipboard');">
              COPY
            </button>
</div>
<a class="inline-flex items-center justify-center w-full bg-primary text-on-primary py-3 font-label-caps text-label-caps font-bold tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="/">
            {{ __('content.t_8c8146bc6b2d') }}
          </a>
</div>
<!-- Right: Dedicated Contact Numbers -->
<div class="lg:col-span-6 lg:pl-4">
<div class="flex items-center justify-between mb-4">
<h3 class="font-title-lg text-title-lg text-primary uppercase font-bold tracking-wider">{{ __('content.t_4dc26af4d57c') }}</h3>
<span class="font-label-caps text-label-caps text-outline font-bold">{{ __('content.long_1e47ea6aa1c1) }}</span>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<!-- UAE -->
<div class="border border-primary bg-primary text-on-primary p-4">
<span class="font-label-caps text-label-caps opacity-80 block mb-1">{{ __('content.long_7fac051c7625) }}</span>
<a class="font-title-lg text-title-lg font-bold tracking-wide hover:underline" href="tel:8007374672">800 7374672</a>
</div>
<!-- Saudi Arabia -->
<div class="border border-outline-variant bg-surface-container-lowest p-4">
<span class="font-label-caps text-label-caps text-on-surface-variant block mb-1">{{ __('content.t_4fa5dbd0adc1') }}</span>
<a class="font-title-lg text-title-lg font-bold text-primary hover:underline" href="tel:+966114797382">+966 11 479 7382</a>
</div>
<!-- Kuwait -->
<div class="border border-outline-variant bg-surface-container-lowest p-4">
<span class="font-label-caps text-label-caps text-on-surface-variant block mb-1">KUWAIT</span>
<a class="font-title-lg text-title-lg font-bold text-primary hover:underline" href="tel:+96522208178">+965 2220 8178</a>
</div>
<!-- Bahrain -->
<div class="border border-outline-variant bg-surface-container-lowest p-4">
<span class="font-label-caps text-label-caps text-on-surface-variant block mb-1">BAHRAIN</span>
<a class="font-title-lg text-title-lg font-bold text-primary hover:underline" href="tel:+97316639148">+973 1663 9148</a>
</div>
<!-- Oman -->
<div class="border border-outline-variant bg-surface-container-lowest p-4">
<span class="font-label-caps text-label-caps text-on-surface-variant block mb-1">OMAN</span>
<a class="font-title-lg text-title-lg font-bold text-primary hover:underline" href="tel:+96821030711">+968 2103 0711</a>
</div>
<!-- Qatar -->
<div class="border border-outline-variant bg-surface-container-lowest p-4">
<span class="font-label-caps text-label-caps text-on-surface-variant block mb-1">QATAR</span>
<a class="font-title-lg text-title-lg font-bold text-primary hover:underline" href="tel:+97444196648">+974 4419 6648</a>
</div>
</div>
</div>
</div>
</section>
<!-- 7. TRUST BADGES ROW -->
<section class="border-t border-b border-primary py-8 mb-16">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
<!-- Badge 1 -->
<div class="flex flex-col items-center justify-center p-3">
<span class="material-symbols-outlined text-3xl text-primary mb-2">local_shipping</span>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary">{{ __('ui.free_delivery') }}</h4>
<span class="font-body-sm text-body-sm text-outline">{{ __('content.t_d76dbfd4ac0b') }}</span>
</div>
<!-- Badge 2 -->
<div class="flex flex-col items-center justify-center p-3 border-l border-outline-variant">
<span class="material-symbols-outlined text-3xl text-primary mb-2">verified</span>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary">{{ __('ui.authentic') }}</h4>
<span class="font-body-sm text-body-sm text-outline">{{ __('content.t_9ae5bfb10a03') }}</span>
</div>
<!-- Badge 3 -->
<div class="flex flex-col items-center justify-center p-3 border-l-0 md:border-l border-outline-variant">
<span class="material-symbols-outlined text-3xl text-primary mb-2">cached</span>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary">{{ __('ui.easy_returns') }}</h4>
<span class="font-body-sm text-body-sm text-outline">{{ __('content.t_de87fa640461') }}</span>
</div>
<!-- Badge 4 -->
<div class="flex flex-col items-center justify-center p-3 border-l border-outline-variant">
<span class="material-symbols-outlined text-3xl text-primary mb-2">loyalty</span>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary">{{ __('content.t_302ae874320b') }}</h4>
<span class="font-body-sm text-body-sm text-outline">{{ __('content.t_82fc6901998f') }}</span>
</div>
</div>
</section>
<!-- 8. NEWSLETTER SUBSCRIPTION -->
<section class="border border-outline-variant bg-surface-container-low p-8 mb-16 text-center max-w-3xl mx-auto">
<h3 class="font-display-hero text-headline-sm md:text-headline-md text-primary mb-2">{{ __('content.t_518c2ee6743f') }}</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
        {{ __('content.t_9bad8ffc08ee') }}
      </p>
<form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" onsubmit="event.preventDefault(); alert('Subscribed successfully');" data-newsletter-form>
<input class="flex-1 bg-surface-container-lowest border border-outline text-on-surface placeholder:text-outline text-body-sm px-4 py-3 rounded-none focus:border-primary focus:ring-0 outline-none" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-6 py-3 font-bold tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" type="submit">
          {{ __('ui.subscribe_caps') }}
        </button>
</form>
</section>
</main>
<!-- 9. FOOTER (SHARED COMPONENT EXECUTION) -->
@endsection
