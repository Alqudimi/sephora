@extends('layouts.app')

@section('title', __('meta.contact'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('head')
@endsection

@section('content')
<!-- 3. BREADCRUMBS -->
<nav aria-label="{{ __('ui.breadcrumb') }}" class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-6 pb-2">
<ol class="flex items-center space-x-2 font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest">
<li><a class="hover:text-primary transition-colors" href="/">{{ __('ui.home') }}</a></li>
<li><span class="text-outline">/</span></li>
<li><a class="hover:text-primary transition-colors" href="/my-account">{{ __('ui.my_account') }}</a></li>
<li><span class="text-outline">/</span></li>
<li class="text-primary font-bold">{{ __('ui.contact_us') }}</li>
</ol>
</nav>
<!-- 4. ACCOUNT NAVIGATION TABS -->
<section class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-4 pb-8">
<div class="flex items-center gap-1 border-b border-primary overflow-x-auto scrollbar-none">
<a class="px-6 py-3 font-label-caps text-label-caps tracking-widest text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors uppercase whitespace-nowrap" href="/my-account">{{ __('ui.my_account') }}</a>
<a class="px-6 py-3 font-label-caps text-label-caps tracking-widest text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors uppercase whitespace-nowrap" href="/">
        {{ __('content.t_a4231e2500a9') }}
      </a>
<a class="px-6 py-3 font-label-caps text-label-caps tracking-widest text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors uppercase whitespace-nowrap" href="/">
        SETTINGS
      </a>
<a class="px-6 py-3 font-label-caps text-label-caps tracking-widest text-on-surface-variant hover:text-primary hover:bg-surface-container transition-colors uppercase whitespace-nowrap" href="/faq">
        {{ __('content.t_95c6f6c30d6f') }}
      </a>
<a class="px-6 py-3 font-label-caps text-label-caps tracking-widest bg-primary text-on-primary font-bold uppercase whitespace-nowrap" href="/contact-us">
        {{ __('content.t_03848e34035c') }}
      </a>
</div>
</section>
<!-- 5. MAIN CONTENT - CONTACT US CONCIERGE HUB -->
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pb-space-xl">
<!-- Hero Header Title & Advisory -->
<div class="mb-8">
<div class="flex flex-col md:flex-row md:items-end justify-between border-b border-primary pb-6">
<div>
<span class="font-label-caps text-label-caps uppercase text-secondary tracking-widest block mb-2 font-bold">{{ __('content.t_cb4397defaee') }}</span>
<h1 class="font-display-hero text-headline-lg lg:text-display-hero text-primary">{{ __('ui.contact_us') }}</h1>
</div>
<p class="font-body-md text-body-md text-on-surface-variant max-w-md mt-4 md:mt-0">
          {{ __('content.t_25ced2ebfabb') }}
        </p>
</div>
<!-- Urgent Delay Advisory Banner -->
<div class="mt-6 border border-primary bg-surface-container-low p-4 md:p-5 flex items-start gap-4">
<span class="material-symbols-outlined text-secondary text-2xl flex-shrink-0">info</span>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase tracking-wider text-primary">{{ __('content.t_0977bddcbc4c') }}</h4>
<p class="font-body-md text-body-md text-on-surface mt-1">
            {{ __('content.t_4b940091b867') }}
          </p>
</div>
</div>
</div>
<!-- Editorial Concierge Cards Bento Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-16">
<!-- COLUMN 1: Regional Phone Lines (5 Cols) -->
<div class="lg:col-span-5 flex flex-col gap-6">
<div class="border border-primary bg-surface-container-lowest p-6 md:p-8">
<div class="flex items-baseline justify-between border-b border-surface-container-highest pb-4 mb-6">
<h2 class="font-headline-sm text-headline-sm text-primary">{{ __('content.t_4dc26af4d57c') }}</h2>
<span class="font-label-tag text-label-tag text-on-surface-variant uppercase tracking-widest">{{ __('content.t_0cee79267b7d') }}</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-6 uppercase tracking-wider font-semibold">
            {{ __('content.long_0facd1f22a69) }}
          </p>
<!-- UAE Highlighted Card -->
<div class="border-2 border-primary bg-surface-container-low p-5 mb-4 relative">
<span class="absolute top-0 right-0 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5 uppercase tracking-widest font-bold">{{ __('content.t_147ae4f3eebd') }}</span>
<div class="flex items-center gap-3 mb-2">
<span class="text-xl">🇦🇪</span>
<span class="font-title-md text-title-md text-primary font-bold">{{ __('content.t_d115b8d5acb8') }}</span>
</div>
<a class="font-price-aed-lg text-price-aed-lg text-primary tracking-widest hover:text-secondary transition-colors block" href="tel:8007374672">
              8007374672
            </a>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_d94b2fd4e3f1') }}</p>
</div>
<!-- Regional Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
<!-- Saudi Arabia -->
<div class="border border-outline-variant p-3 hover:border-primary transition-colors">
<div class="flex items-center gap-2 mb-1">
<span>🇸🇦</span>
<span class="font-label-caps text-label-caps text-on-surface uppercase font-bold">{{ __('content.t_6f49c31192f5') }}</span>
</div>
<a class="font-body-md text-body-md font-bold text-primary hover:text-secondary block" href="tel:+966114797382">
                +966114797382
              </a>
</div>
<!-- Kuwait -->
<div class="border border-outline-variant p-3 hover:border-primary transition-colors">
<div class="flex items-center gap-2 mb-1">
<span>🇰🇼</span>
<span class="font-label-caps text-label-caps text-on-surface uppercase font-bold">Kuwait</span>
</div>
<a class="font-body-md text-body-md font-bold text-primary hover:text-secondary block" href="tel:+96522208178">
                +96522208178
              </a>
</div>
<!-- Bahrain -->
<div class="border border-outline-variant p-3 hover:border-primary transition-colors">
<div class="flex items-center gap-2 mb-1">
<span>🇧🇭</span>
<span class="font-label-caps text-label-caps text-on-surface uppercase font-bold">Bahrain</span>
</div>
<a class="font-body-md text-body-md font-bold text-primary hover:text-secondary block" href="tel:+97316639148">
                +97316639148
              </a>
</div>
<!-- Oman -->
<div class="border border-outline-variant p-3 hover:border-primary transition-colors">
<div class="flex items-center gap-2 mb-1">
<span>🇴🇲</span>
<span class="font-label-caps text-label-caps text-on-surface uppercase font-bold">Oman</span>
</div>
<a class="font-body-md text-body-md font-bold text-primary hover:text-secondary block" href="tel:+96821030711">
                +96821030711
              </a>
</div>
<!-- Qatar -->
<div class="border border-outline-variant p-3 hover:border-primary transition-colors sm:col-span-2">
<div class="flex items-center gap-2 mb-1">
<span>🇶🇦</span>
<span class="font-label-caps text-label-caps text-on-surface uppercase font-bold">Qatar</span>
</div>
<a class="font-body-md text-body-md font-bold text-primary hover:text-secondary block" href="tel:+97444196648">
                +97444196648
              </a>
</div>
</div>
<!-- Quick Email Tray -->
<div class="mt-6 pt-6 border-t border-surface-container-highest">
<span class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest block mb-2">{{ __('content.t_645117049fb7') }}</span>
<div class="flex items-center justify-between bg-surface-container-low border border-outline-variant p-3">
<span class="font-body-sm text-body-sm font-semibold text-primary truncate">customercare@sephora.ae</span>
<button class="font-label-caps text-label-caps uppercase bg-primary text-on-primary px-3 py-1.5 hover:bg-surface hover:text-primary border border-primary transition-all ml-2 flex-shrink-0" onclick="navigator.clipboard.writeText('customercare@sephora.ae'); alert('Email copied to clipboard!');">
                COPY
              </button>
</div>
</div>
</div>
<!-- VIP Beauty Pass Card Inspiration Display -->
<div class="border border-primary bg-primary text-on-primary p-6 relative overflow-hidden">
<div class="flex justify-between items-start mb-6">
<div>
<span class="font-label-caps text-label-caps text-tertiary-fixed-dim uppercase tracking-widest block">{{ __('content.t_841a4e133902') }}</span>
<h3 class="font-headline-sm text-headline-sm text-on-primary mt-1">{{ __('content.t_6f133815925f') }}</h3>
</div>
<span class="material-symbols-outlined text-tertiary-fixed-dim text-3xl">verified</span>
</div>
<p class="font-body-sm text-body-sm text-surface-variant mb-6">
            {{ __('content.t_ef366e772383') }}
          </p>
<div class="flex items-center justify-between border-t border-outline pt-4">
<span class="font-label-caps text-label-caps uppercase tracking-wider text-outline-variant">{{ __('content.t_ac3d63638987') }}</span>
<span class="font-price-aed-md text-price-aed-md text-tertiary-fixed font-bold">{{ __('content.t_dcb88306064f') }}</span>
</div>
</div>
</div>
<!-- COLUMN 2: Concierge Inquiry Form (7 Cols) -->
<div class="lg:col-span-7">
<div class="border border-primary bg-surface-container-lowest p-6 md:p-8">
<div class="border-b border-surface-container-highest pb-4 mb-6">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-1">{{ __('content.t_cbafe5fe1e1c') }}</span>
<h2 class="font-headline-sm text-headline-sm text-primary">{{ __('content.t_3cfb77466ac9') }}</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
              {{ __('content.t_11c94fece7f3') }}
            </p>
</div>
<form class="space-y-6" id="conciergeForm" method="POST" action="{{ route('contact.submit') }}">
    @csrf
    @if(session('contact_success'))
    <div class="bg-[#1b6b45] text-white px-4 py-3 font-body-sm">{{ __('content.t_47abc71be320') }}</div>
    @endif
    @if($errors->any())
    <div class="border border-secondary bg-surface-container-low p-4 text-secondary text-sm">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Full Name -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-2" for="contact-name">
                  {{ __('content.t_64346b483c0a') }} <span class="text-secondary">*</span>
</label>
<input id="contact-name" name="name" value="{{ old('name') }}" class="w-full bg-surface-container-lowest text-on-surface font-body-md text-body-md border border-outline focus:border-primary focus:ring-0 rounded-none p-3 transition-colors" placeholder="{{ __('content.t_5c2afbdedd38') }}" required type="text"/>
</div>
<!-- Email Address -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-2" for="contact-email">
                  {{ __('content.t_09ba557fd106') }} <span class="text-secondary">*</span>
</label>
<input id="contact-email" name="email" value="{{ old('email') }}" class="w-full bg-surface-container-lowest text-on-surface font-body-md text-body-md border border-outline focus:border-primary focus:ring-0 rounded-none p-3 transition-colors" placeholder="{{ __('ui.email_example') }}" required type="email" />
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Phone -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-2" for="contact-phone">
                  {{ __('content.t_ab25d61bb124') }} <span class="text-on-surface-variant text-[10px]">(Optional)</span>
</label>
<input id="contact-phone" name="phone" value="{{ old('phone') }}" class="w-full bg-surface-container-lowest text-on-surface font-body-md text-body-md border border-outline focus:border-primary focus:ring-0 rounded-none p-3 transition-colors" placeholder="+971 50 123 4567" type="tel"/>
</div>
<!-- Topic / Subject Dropdown -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-2" for="contact-subject">
                  {{ __('content.t_9a01561f2467') }} <span class="text-secondary">*</span>
</label>
<select id="contact-subject" name="subject" class="w-full bg-surface-container-lowest text-on-surface font-body-md text-body-md border border-outline focus:border-primary focus:ring-0 rounded-none p-3 transition-colors" required>
<option disabled value="" @selected(!old('subject'))>{{ __('content.t_d5f51ea80cfd') }}</option>
<option value="Delivery & Shipping Status" @selected(old('subject') === 'Delivery & Shipping Status')>{{ __('content.t_a98a99a7c5b5') }}</option>
<option value="Return & Refund Assistance" @selected(old('subject') === 'Return & Refund Assistance')>{{ __('content.t_e59ae2b6b5be') }}</option>
<option value="Beauty Pass Points & Tiers" @selected(old('subject') === 'Beauty Pass Points & Tiers')>{{ __('content.t_37f768508900') }}</option>
<option value="Product Consultation & Formula" @selected(old('subject') === 'Product Consultation & Formula')>{{ __('content.t_376781da6bba') }}</option>
<option value="Store Experience & Appointments" @selected(old('subject') === 'Store Experience & Appointments')>{{ __('content.t_10d4687688c7') }}</option>
<option value="Other Inquiry" @selected(old('subject') === 'Other Inquiry')>{{ __('content.t_63a00a34a39d') }}</option>
</select>
</div>
</div>
<!-- Message Textarea -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-2" for="contact-message">
                {{ __('content.t_8ae188c575e6') }} <span class="text-secondary">*</span>
</label>
<textarea id="contact-message" name="message" class="w-full bg-surface-container-lowest text-on-surface font-body-md text-body-md border border-outline focus:border-primary focus:ring-0 rounded-none p-3 transition-colors" placeholder="{{ __('content.t_bd5500a53985') }}" required rows="5">{{ old('message') }}</textarea>
</div>
<!-- Data Privacy Disclosure -->
<div class="flex items-center justify-between text-on-surface-variant pt-2">
<span class="font-body-sm text-body-sm">
                {{ __('content.t_e1506322eb87') }}
              </span>
<a class="font-label-caps text-label-caps text-primary hover:text-secondary uppercase underline tracking-wider font-bold" href="#privacy">
                {{ __('content.t_cde83aa6f4f1') }}
              </a>
</div>
<!-- Submit Primary CTA -->
<div>
<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest font-bold hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all duration-200" type="submit">
                {{ __('content.t_6422426b4bad') }}
              </button>
</div>
</form>
<!-- Follow Us / Social Channels Bar -->
<div class="mt-10 pt-6 border-t border-surface-container-highest flex flex-col sm:flex-row items-center justify-between gap-4">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">{{ __('content.t_cca2bfb1727c') }}</span>
<div class="flex items-center gap-4">
@php
    $cInstagram = \App\Models\Setting::get('social_instagram', 'https://www.instagram.com/sephoramiddleeast/');
    $cTiktok = \App\Models\Setting::get('social_tiktok', 'https://tiktok.com/@sephoramiddleeast');
    $cYoutube = \App\Models\Setting::get('social_youtube', 'https://www.youtube.com/user/SEPHORAME');
    $cFacebook = \App\Models\Setting::get('social_facebook', 'https://www.facebook.com/sephoramiddleeast');
@endphp
<a class="p-2 border border-outline-variant hover:border-primary hover:text-secondary transition-all" href="{{ $cInstagram }}" rel="noreferrer" target="_blank" title="Instagram">
<span class="font-label-caps text-label-caps uppercase font-bold">Instagram</span>
</a>
<a class="p-2 border border-outline-variant hover:border-primary hover:text-secondary transition-all" href="{{ $cTiktok }}" rel="noreferrer" target="_blank" title="TikTok">
<span class="font-label-caps text-label-caps uppercase font-bold">TikTok</span>
</a>
<a class="p-2 border border-outline-variant hover:border-primary hover:text-secondary transition-all" href="https://www.snapchat.com/add/Sephoramesnaps" rel="noreferrer" target="_blank" title="Snapchat">
<span class="font-label-caps text-label-caps uppercase font-bold">Snapchat</span>
</a>
<a class="p-2 border border-outline-variant hover:border-primary hover:text-secondary transition-all" href="{{ $cYoutube }}" rel="noreferrer" target="_blank" title="YouTube">
<span class="font-label-caps text-label-caps uppercase font-bold">YouTube</span>
</a>
<a class="p-2 border border-outline-variant hover:border-primary hover:text-secondary transition-all" href="{{ $cFacebook }}" rel="noreferrer" target="_blank" title="Facebook">
<span class="font-label-caps text-label-caps uppercase font-bold">Facebook</span>
</a>
</div>
</div>
</div>
</div>
</div>
<!-- 6. LUXURY TRUST VALUE BADGES (4 Columns Grid) -->
<section class="border-t border-b border-primary py-10 mb-16 bg-surface-container-lowest">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
<!-- Badge 1: Delivery -->
<div class="flex items-start gap-4 p-2">
<div class="w-12 h-12 border border-primary flex items-center justify-center flex-shrink-0 bg-surface">
<span class="material-symbols-outlined text-primary text-2xl">local_shipping</span>
</div>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary tracking-wider">{{ __('ui.free_delivery') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_98bff91b1a1b') }}</p>
</div>
</div>
<!-- Badge 2: Authenticity -->
<div class="flex items-start gap-4 p-2">
<div class="w-12 h-12 border border-primary flex items-center justify-center flex-shrink-0 bg-surface">
<span class="material-symbols-outlined text-primary text-2xl">verified_user</span>
</div>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary tracking-wider">{{ __('ui.authentic') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_286e649d3f5e') }}</p>
</div>
</div>
<!-- Badge 3: Easy Returns -->
<div class="flex items-start gap-4 p-2">
<div class="w-12 h-12 border border-primary flex items-center justify-center flex-shrink-0 bg-surface">
<span class="material-symbols-outlined text-primary text-2xl">restart_alt</span>
</div>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary tracking-wider">{{ __('ui.easy_returns') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_cdc080bb65b6') }}</p>
</div>
</div>
<!-- Badge 4: Customer Care -->
<div class="flex items-start gap-4 p-2">
<div class="w-12 h-12 border border-primary flex items-center justify-center flex-shrink-0 bg-surface">
<span class="material-symbols-outlined text-primary text-2xl">support_agent</span>
</div>
<div>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary tracking-wider">{{ __('ui.customer_service') }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_b5d38bb0ba30') }}</p>
</div>
</div>
</div>
</section>
<!-- 7. NEWSLETTER SUBSCRIPTION BOX -->
<section class="border border-primary bg-primary text-on-primary p-8 md:p-12 mb-12">
<div class="max-w-3xl mx-auto text-center">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-tertiary-fixed-dim block mb-2 font-bold">{{ __('content.t_d9f175bc5d52') }}</span>
<h3 class="font-headline-md text-headline-md lg:text-headline-lg text-on-primary mb-3">
          {{ __('content.t_518c2ee6743f') }}
        </h3>
<p class="font-body-md text-body-md text-surface-variant mb-8">
          {{ __('content.t_ef06b10ee560') }}
        </p>
<form class="flex flex-col sm:flex-row gap-0 max-w-xl mx-auto" data-newsletter-form>
<input class="flex-1 bg-surface-container-lowest text-on-surface font-body-md text-body-md border-0 p-4 focus:ring-0 rounded-none placeholder:text-outline" placeholder="{{ __('content.t_c09924a9f455') }}" required="" type="email"/>
<button class="bg-tertiary-fixed text-on-tertiary-fixed font-label-caps text-label-caps uppercase px-8 py-4 font-bold tracking-widest hover:bg-on-primary hover:text-primary transition-colors" type="submit">
            {{ __('ui.subscribe') }}
          </button>
</form>
</div>
</section>
</main>
<!-- 8. SHARED COMPONENT: Footer -->
@endsection
