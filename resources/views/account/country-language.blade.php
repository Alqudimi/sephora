@extends('layouts.app')

@section('title', 'Country & Language Settings | SEPHORA UAE')
@section('body_class', 'bg-surface text-on-surface antialiased selection:bg-primary selection:text-on-primary')

@section('head')
<style>
.material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      display: inline-block;
      vertical-align: middle;
      line-height: 1;
    }
    .flag-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 0 1px #e3e2e2;
    }
</style>
@endsection

@section('content')
<!-- 1. TOP ANNOUNCEMENT BAR -->
<aside class="w-full bg-primary text-on-primary py-2 px-4 text-center cursor-pointer transition-opacity hover:opacity-95">
<p class="font-label-caps text-label-caps uppercase tracking-widest font-semibold flex items-center justify-center gap-2">
<span>WANT TO TURN HEADS? YOUR SIGNATURE SCENT STARTS HERE. DISCOVER THE COLLECTION AND LAYER WITHOUT LIMITS - SHOP NOW →</span>
</p>
</aside>
<!-- 2. LUXURY DESKTOP HEADER & NAVIGATION (Shared Component TopNavBar Integration) -->
<header class="w-full bg-surface-container-lowest border-b border-outline-variant sticky top-0 z-50">
<div class="flex flex-col w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- Main Upper Bar -->
<div class="flex items-center justify-between py-4 gap-6">
<!-- Left Section: Search Input (Search Bar on Left per JSON spec) -->
<div class="flex-1 max-w-md hidden md:block">
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-3 text-outline text-[20px]">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 text-on-surface font-body-sm text-body-sm placeholder:text-outline transition-colors rounded-none outline-none" placeholder="Search brand, product, category..." type="text"/>
</div>
</div>
<!-- Center Brand: SEPHORA -->
<div class="flex-1 flex justify-center text-center">
<a class="font-display-hero text-headline-md tracking-widest uppercase font-bold text-primary hover:opacity-80 transition-opacity" href="/ae-en">
            SEPHORA
          </a>
</div>
<!-- Trailing Icon Actions: location_on, favorite, shopping_bag, person -->
<div class="flex-1 flex items-center justify-end gap-6 text-primary">
<a class="hidden lg:flex items-center gap-1.5 text-on-surface hover:text-secondary transition-colors duration-200" href="/ae-en/stores">
<span class="material-symbols-outlined text-[20px]">location_on</span>
<span class="font-label-caps text-label-caps">STORES &amp; SERVICES</span>
</a>
<!-- Region / Currency Trigger -->
<a class="hidden sm:flex items-center gap-1.5 border border-outline-variant px-2.5 py-1 text-on-surface hover:border-primary transition-colors" href="/ae-en/my-account/settings/country-and-language">
<span class="inline-block w-4 h-3 bg-red-600 relative overflow-hidden border border-outline-variant">
<span class="absolute inset-x-0 top-0 h-1 bg-green-700"></span>
<span class="absolute inset-x-0 bottom-0 h-1 bg-black"></span>
<span class="absolute left-0 top-0 bottom-0 w-1 bg-red-600"></span>
</span>
<span class="font-label-caps text-label-caps font-bold">UAE | AED</span>
</a>
<!-- Trailing icons array execution -->
<a class="flex items-center gap-1 hover:text-secondary transition-colors" href="/ae-en/my-account" title="My Account">
<span class="material-symbols-outlined text-[22px]">person</span>
<span class="font-label-caps text-label-caps hidden xl:inline">SIGN IN</span>
</a>
<a class="flex items-center hover:text-secondary transition-colors" href="/ae-en/wishlist" title="Wishlist">
<span class="material-symbols-outlined text-[22px]">favorite</span>
</a>
<a class="relative flex items-center hover:text-secondary transition-colors" href="/ae-en/cart" title="Bag">
<span class="material-symbols-outlined text-[22px]">shopping_bag</span>
<span class="absolute -top-1.5 -right-2 bg-primary text-on-primary text-[9px] font-bold h-4 w-4 rounded-full flex items-center justify-center" data-bag-count>@if(!empty($bagCount)){{ $bagCount }}@else 0 @endif</span></a>
</div>
</div>
<!-- Secondary Category Navigation -->
<nav class="hidden md:flex items-center justify-between border-t border-surface-container py-2.5 overflow-x-auto">
<ul class="flex items-center gap-6 list-none p-0 m-0">
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap" href="/ae-en/shop/fragrance/stack-your-scent">
              Stack Your Scent
            </a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap" href="/ae-en/shop/the-holiday-collection">
              The Holiday Collection
            </a>
</li>
<li>
<a class="inline-flex items-center gap-1.5 font-label-caps text-label-caps text-secondary font-bold tracking-wider hover:text-primary transition-colors whitespace-nowrap" href="/ae-en/beauty-offers">
<span>BEAUTY OFFERS</span>
<span class="bg-secondary text-on-secondary px-1 py-0.2 text-[9px] font-extrabold uppercase rounded-none leading-none">HOT</span>
</a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap" href="/ae-en/shop/new">
              New
            </a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap" href="/ae-en/shop/makeup">
              Makeup
            </a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap" href="/ae-en/shop/fragrance">
              Fragrance
            </a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap" href="/ae-en/shop/skincare">
              Skincare
            </a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap" href="/ae-en/shop/bath-body">
              Bath &amp; Body
            </a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap" href="/ae-en/shop/hair">
              Hair
            </a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap font-bold" href="/ae-en/brands/sephora-collection">
              Sephora Collection
            </a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap" href="/ae-en/brands">
              Brands
            </a>
</li>
<li>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap font-bold" href="/ae-en/shop/bestsellers">
              Best Sellers
            </a>
</li>
</ul>
</nav>
</div>
</header>
<!-- 3. BREADCRUMBS & SUB-NAVIGATION TABS -->
<div class="bg-surface-container-low border-b border-outline-variant">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-3">
<!-- Breadcrumb Trail -->
<nav aria-label="Breadcrumb" class="flex items-center gap-2 text-outline font-body-sm text-body-sm">
<a class="hover:text-primary transition-colors" href="/ae-en">Home</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="/ae-en/my-account">My Account</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="/ae-en/my-account/settings">Settings</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-semibold">Country &amp; Language</span>
</nav>
</div>
</div>
<!-- Account Navigation Bar (Tabs) -->
<div class="bg-surface-container-lowest border-b border-outline-variant">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="flex items-center gap-1 sm:gap-2 overflow-x-auto py-2">
<a class="px-5 py-2.5 font-label-caps text-label-caps text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors duration-150 rounded-none whitespace-nowrap" href="/ae-en/my-account">
          My Account
        </a>
<a class="px-5 py-2.5 font-label-caps text-label-caps text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors duration-150 rounded-none whitespace-nowrap" href="/ae-en/my-account/mysephora">
          MY SEPHORA
        </a>
<!-- ACTIVE TAB: Settings -->
<a class="px-5 py-2.5 bg-primary text-on-primary font-label-caps text-label-caps font-bold tracking-widest rounded-none whitespace-nowrap" href="/ae-en/my-account/settings">
          SETTINGS
        </a>
<a class="px-5 py-2.5 font-label-caps text-label-caps text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors duration-150 rounded-none whitespace-nowrap" href="/ae-en/faq">
          HELP &amp; FAQS
        </a>
<a class="px-5 py-2.5 font-label-caps text-label-caps text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors duration-150 rounded-none whitespace-nowrap" href="/ae-en/contact-us">
          CONTACT US
        </a>
</div>
</div>
</div>
<!-- 4. MAIN SETTINGS CONTENT CONTAINER -->
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8 md:py-12">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
<!-- Left Sub-menu / Settings Navigation Bar -->
<aside class="lg:col-span-3">
<div class="border border-outline-variant bg-surface-container-lowest p-6">
<h3 class="font-label-caps text-label-caps text-outline uppercase tracking-widest mb-4">Account Settings</h3>
<ul class="space-y-1 list-none p-0 m-0">
<li>
<a class="flex items-center justify-between py-2.5 px-3 font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/ae-en/my-account/settings/personal-details">
<span>Personal Information</span>
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between py-2.5 px-3 bg-surface-container font-body-sm text-body-sm text-primary font-bold border-l-2 border-primary" href="/ae-en/my-account/settings/country-and-language">
<span>Country &amp; Language</span>
<span class="material-symbols-outlined text-[18px]">check</span>
</a>
</li>
<li>
<a class="flex items-center justify-between py-2.5 px-3 font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/ae-en/my-account/settings/address-book">
<span>Address Book</span>
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between py-2.5 px-3 font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/ae-en/my-account/settings/payment-methods">
<span>Saved Payment Methods</span>
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between py-2.5 px-3 font-body-sm text-body-sm text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/ae-en/my-account/settings/communications-and-subscriptions">
<span>Subscriptions &amp; Alerts</span>
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</a>
</li>
</ul>
<div class="mt-8 pt-6 border-t border-outline-variant">
<div class="flex items-center gap-3 text-outline">
<span class="material-symbols-outlined text-[20px]">shield</span>
<span class="font-label-caps text-label-caps">SEPHORA SAFEGUARD</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-2">
              Your profile is verified with VIP 256-bit encryption.
            </p>
</div>
</div>
</aside>
<!-- Right Main Settings Body -->
<section class="lg:col-span-9">
<!-- Header & Title -->
<div class="border-b border-outline-variant pb-6 mb-8">
<div class="flex items-baseline justify-between flex-wrap gap-2">
<h1 class="font-headline-lg text-headline-lg text-primary tracking-tight">
              Country &amp; Language
            </h1>
<span class="font-label-caps text-label-caps text-secondary font-bold">MIDDLE EAST EDITION</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-3xl">
            Select your preferred delivery country and shopping language across the Sephora Middle East network. Changing your region updates catalog availability, local fulfillment times, and store pricing.
          </p>
</div>
<!-- Privacy & Security Guarantee Banner -->
<div class="border border-outline-variant bg-surface-container-lowest p-4 mb-8 flex items-start sm:items-center justify-between flex-wrap gap-4">
<div class="flex items-center gap-3">
<div class="w-9 h-9 bg-primary text-on-primary flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">lock</span>
</div>
<div>
<p class="font-body-sm text-body-sm font-semibold text-primary">
                Your personal information and beauty journey are safely guarded with end-to-end security.
              </p>
<p class="font-body-sm text-body-sm text-on-surface-variant">
                Read more about our comprehensive Middle East data privacy protocol.
              </p>
</div>
</div>
<a class="font-label-caps text-label-caps text-primary hover:text-secondary underline font-bold tracking-wider inline-flex items-center gap-1 transition-colors" href="/ae-en/data-privacy">
            DATA PRIVACY →
          </a>
</div>
<!-- 5. COUNTRY & REGION SELECTOR SECTION -->
<div class="mb-10">
<div class="flex items-center justify-between mb-4">
<h2 class="font-title-lg text-title-lg text-primary uppercase tracking-wide">
              1. Select Country / Region
            </h2>
<span class="font-label-caps text-label-caps text-outline">6 REGIONAL HUBS AVAILABLE</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<!-- Option 1: UAE (Active / Current Store) -->
<label class="relative block border-2 border-primary bg-surface-container-lowest p-5 cursor-pointer shadow-none">
<input checked="" class="sr-only peer" name="country_selection" type="radio" value="UAE"/>
<div class="flex items-start justify-between">
<div class="flex items-center gap-3">
<!-- UAE Flag Representation -->
<div class="w-8 h-6 relative border border-outline overflow-hidden flex flex-col justify-between">
<span class="h-2 w-full bg-[#00732f]"></span>
<span class="h-2 w-full bg-[#ffffff]"></span>
<span class="h-2 w-full bg-[#000000]"></span>
<span class="absolute left-0 top-0 bottom-0 w-2.5 bg-[#ff0000]"></span>
</div>
<div>
<span class="font-title-md text-title-md text-primary block">United Arab Emirates (UAE)</span>
<span class="font-label-caps text-label-caps text-on-surface-variant block font-bold">AED (Dirhams) • VAT Included</span>
</div>
</div>
<div class="w-5 h-5 border-2 border-primary bg-primary flex items-center justify-center">
<span class="material-symbols-outlined text-on-primary text-[16px]">check</span>
</div>
</div>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center justify-between">
<span class="inline-block bg-primary text-on-primary px-2 py-0.5 font-label-tag text-label-tag font-bold uppercase tracking-wider">
                  Current Store
                </span>
<p class="font-body-sm text-body-sm text-on-surface-variant">Standard &amp; Same-Day Delivery across all 7 Emirates</p>
</div>
</label>
<!-- Option 2: KSA -->
<label class="relative block border border-outline-variant bg-surface-container-lowest p-5 cursor-pointer hover:border-primary transition-colors">
<input class="sr-only peer" name="country_selection" type="radio" value="KSA"/>
<div class="flex items-start justify-between">
<div class="flex items-center gap-3">
<!-- KSA Flag Representation -->
<div class="w-8 h-6 bg-[#006C35] border border-outline relative flex items-center justify-center">
<span class="text-[8px] text-white font-bold leading-none">🇸🇦</span>
</div>
<div>
<span class="font-title-md text-title-md text-primary block">Kingdom of Saudi Arabia (KSA)</span>
<span class="font-label-caps text-label-caps text-on-surface-variant block">SAR (Saudi Riyals)</span>
</div>
</div>
<div class="w-5 h-5 border border-outline-variant bg-surface-container-lowest"></div>
</div>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center justify-between text-outline">
<span class="font-body-sm text-body-sm">Switch to Sephora KSA store</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</div>
</label>
<!-- Option 3: Kuwait -->
<label class="relative block border border-outline-variant bg-surface-container-lowest p-5 cursor-pointer hover:border-primary transition-colors">
<input class="sr-only peer" name="country_selection" type="radio" value="KW"/>
<div class="flex items-start justify-between">
<div class="flex items-center gap-3">
<!-- Kuwait Flag Representation -->
<div class="w-8 h-6 relative border border-outline overflow-hidden flex flex-col justify-between">
<span class="h-2 w-full bg-[#007A3D]"></span>
<span class="h-2 w-full bg-[#FFFFFF]"></span>
<span class="h-2 w-full bg-[#CE1126]"></span>
<span class="absolute left-0 top-0 bottom-0 w-2.5 bg-[#000000]"></span>
</div>
<div>
<span class="font-title-md text-title-md text-primary block">State of Kuwait</span>
<span class="font-label-caps text-label-caps text-on-surface-variant block">KWD (Kuwaiti Dinars)</span>
</div>
</div>
<div class="w-5 h-5 border border-outline-variant bg-surface-container-lowest"></div>
</div>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center justify-between text-outline">
<span class="font-body-sm text-body-sm">Switch to Sephora Kuwait store</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</div>
</label>
<!-- Option 4: Bahrain -->
<label class="relative block border border-outline-variant bg-surface-container-lowest p-5 cursor-pointer hover:border-primary transition-colors">
<input class="sr-only peer" name="country_selection" type="radio" value="BH"/>
<div class="flex items-start justify-between">
<div class="flex items-center gap-3">
<!-- Bahrain Flag Representation -->
<div class="w-8 h-6 relative border border-outline overflow-hidden bg-[#CE1126]">
<span class="absolute left-0 top-0 bottom-0 w-2.5 bg-white"></span>
</div>
<div>
<span class="font-title-md text-title-md text-primary block">Kingdom of Bahrain</span>
<span class="font-label-caps text-label-caps text-on-surface-variant block">BHD (Bahraini Dinars)</span>
</div>
</div>
<div class="w-5 h-5 border border-outline-variant bg-surface-container-lowest"></div>
</div>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center justify-between text-outline">
<span class="font-body-sm text-body-sm">Switch to Sephora Bahrain store</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</div>
</label>
<!-- Option 5: Oman -->
<label class="relative block border border-outline-variant bg-surface-container-lowest p-5 cursor-pointer hover:border-primary transition-colors">
<input class="sr-only peer" name="country_selection" type="radio" value="OM"/>
<div class="flex items-start justify-between">
<div class="flex items-center gap-3">
<!-- Oman Flag Representation -->
<div class="w-8 h-6 relative border border-outline overflow-hidden flex flex-col justify-between">
<span class="h-2 w-full bg-white"></span>
<span class="h-2 w-full bg-[#db1620]"></span>
<span class="h-2 w-full bg-[#008000]"></span>
<span class="absolute left-0 top-0 bottom-0 w-2 bg-[#db1620]"></span>
</div>
<div>
<span class="font-title-md text-title-md text-primary block">Sultanate of Oman</span>
<span class="font-label-caps text-label-caps text-on-surface-variant block">OMR (Omani Rials)</span>
</div>
</div>
<div class="w-5 h-5 border border-outline-variant bg-surface-container-lowest"></div>
</div>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center justify-between text-outline">
<span class="font-body-sm text-body-sm">Switch to Sephora Oman store</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</div>
</label>
<!-- Option 6: Qatar -->
<label class="relative block border border-outline-variant bg-surface-container-lowest p-5 cursor-pointer hover:border-primary transition-colors">
<input class="sr-only peer" name="country_selection" type="radio" value="QA"/>
<div class="flex items-start justify-between">
<div class="flex items-center gap-3">
<!-- Qatar Flag Representation -->
<div class="w-8 h-6 relative border border-outline overflow-hidden bg-[#8D1B3D]">
<span class="absolute left-0 top-0 bottom-0 w-2.5 bg-white"></span>
</div>
<div>
<span class="font-title-md text-title-md text-primary block">State of Qatar</span>
<span class="font-label-caps text-label-caps text-on-surface-variant block">QAR (Qatari Riyals)</span>
</div>
</div>
<div class="w-5 h-5 border border-outline-variant bg-surface-container-lowest"></div>
</div>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center justify-between text-outline">
<span class="font-body-sm text-body-sm">Switch to Sephora Qatar store</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</div>
</label>
</div>
</div>
<!-- 6. LANGUAGE PREFERENCE SECTION -->
<div class="mb-10">
<div class="flex items-center justify-between mb-4">
<h2 class="font-title-lg text-title-lg text-primary uppercase tracking-wide">
              2. Preferred Language
            </h2>
<span class="font-label-caps text-label-caps text-outline">BILINGUAL REGIONAL SUPPORT</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<!-- Language Option: English (Selected) -->
<label class="border-2 border-primary bg-surface-container-lowest p-5 cursor-pointer flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-2">
<div class="flex items-center gap-2">
<span class="font-title-lg text-title-lg text-primary font-bold">English (EN)</span>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase font-bold">Standard</span>
</div>
<div class="w-5 h-5 bg-primary text-on-primary flex items-center justify-center">
<span class="material-symbols-outlined text-[16px]">check</span>
</div>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant">
                  Interface, product descriptions, order notifications and communications in English.
                </p>
</div>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center gap-2 text-on-surface">
<span class="material-symbols-outlined text-[18px]">translate</span>
<span class="font-label-caps text-label-caps">ACTIVE DISPLAY LANGUAGE</span>
</div>
</label>
<!-- Language Option: Arabic -->
<label class="border border-outline-variant bg-surface-container-lowest p-5 cursor-pointer hover:border-primary transition-colors flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-2">
<div class="flex items-center gap-2">
<span class="font-title-lg text-title-lg text-primary font-bold font-sans" dir="rtl">العربية (AR)</span>
<span class="bg-surface-container px-2 py-0.5 font-label-tag text-label-tag uppercase font-bold">RTL</span>
</div>
<div class="w-5 h-5 border border-outline-variant bg-surface-container-lowest"></div>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant" dir="rtl">
                  واجهة المستخدم، تفاصيل المنتجات، الإشعارات باللغة العربية.
                </p>
</div>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center justify-between text-outline">
<span class="font-label-caps text-label-caps">SWITCH TO ARABIC</span>
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</div>
</label>
</div>
<!-- Currency Clarification Notice -->
<div class="mt-4 bg-surface-container-low p-4 border-l-2 border-primary flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[20px]">info</span>
<p class="font-body-sm text-body-sm text-on-surface">
<span class="font-bold">Currency Policy:</span> Currency is tied strictly to your selected destination country (<span class="font-bold">AED - United Arab Emirates Dirham</span>, all taxes and VAT included). International card conversion rates may apply from your issuing bank.
            </p>
</div>
</div>
<!-- 7. ACTION BUTTONS -->
<div class="pt-6 border-t border-outline-variant flex flex-col sm:flex-row items-center gap-4">
<button class="w-full sm:w-auto px-10 py-3.5 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest font-bold hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-primary transition-all duration-200" type="button">
            SAVE PREFERENCES
          </button>
<a class="w-full sm:w-auto px-8 py-3.5 bg-surface-container-lowest text-primary border border-outline font-label-caps text-label-caps uppercase tracking-widest font-bold hover:bg-surface-container text-center transition-all duration-150" href="/ae-en/my-account/settings">
            CANCEL / RETURN TO SETTINGS
          </a>
</div>
</section>
</div>
</main>
<!-- 8. PERKS & VALUE PROPOSITIONS (SEPHORA TRUST BAR) -->
<section class="border-y border-outline-variant bg-surface-container-lowest py-8">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 divide-y sm:divide-y-0 sm:divide-x divide-outline-variant">
<!-- Trust 1 -->
<div class="flex items-center gap-4 pt-4 sm:pt-0 sm:px-4 first:pl-0">
<div class="w-12 h-12 bg-surface-container flex items-center justify-center text-primary flex-shrink-0">
<span class="material-symbols-outlined text-[26px]">local_shipping</span>
</div>
<div>
<h4 class="font-label-caps text-label-caps font-bold tracking-wider text-primary uppercase">FREE DELIVERY</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Over 250 AED across UAE</p>
</div>
</div>
<!-- Trust 2 -->
<div class="flex items-center gap-4 pt-4 sm:pt-0 sm:px-4">
<div class="w-12 h-12 bg-surface-container flex items-center justify-center text-primary flex-shrink-0">
<span class="material-symbols-outlined text-[26px]">verified</span>
</div>
<div>
<h4 class="font-label-caps text-label-caps font-bold tracking-wider text-primary uppercase">100% AUTHENTIC</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Direct from global beauty houses</p>
</div>
</div>
<!-- Trust 3 -->
<div class="flex items-center gap-4 pt-4 sm:pt-0 sm:px-4">
<div class="w-12 h-12 bg-surface-container flex items-center justify-center text-primary flex-shrink-0">
<span class="material-symbols-outlined text-[26px]">published_with_changes</span>
</div>
<div>
<h4 class="font-label-caps text-label-caps font-bold tracking-wider text-primary uppercase">EASY RETURNS</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">In any UAE store within 14 days</p>
</div>
</div>
<!-- Trust 4 -->
<div class="flex items-center gap-4 pt-4 sm:pt-0 sm:px-4">
<div class="w-12 h-12 bg-surface-container flex items-center justify-center text-primary flex-shrink-0">
<span class="material-symbols-outlined text-[26px]">headset_mic</span>
</div>
<div>
<h4 class="font-label-caps text-label-caps font-bold tracking-wider text-primary uppercase">CUSTOMER SERVICE</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Questions? Toll-Free 800 7374672</p>
</div>
</div>
</div>
</div>
</section>
<!-- 9. NEWSLETTER SUBSCRIPTION BOX -->
<section class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-12">
<div class="border border-outline bg-surface-container-lowest p-8 md:p-12 text-center max-w-4xl mx-auto">
<h3 class="font-headline-md text-headline-md text-primary mb-2">
        Subscribe to the Sephora newsletter!
      </h3>
<p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto mb-6">
        Receive exclusive previews of prestige fragrance drops, private VIP sales, and masterclasses across Dubai and Abu Dhabi.
      </p>
<form class="flex flex-col sm:flex-row items-center justify-center gap-2 max-w-md mx-auto" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="w-full px-4 py-3 bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 text-on-surface font-body-sm text-body-sm placeholder:text-outline rounded-none outline-none" placeholder="Enter your email address" required="" type="email"/>
<button class="w-full sm:w-auto px-8 py-3 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest font-bold hover:bg-surface-container-lowest hover:text-primary border border-primary transition-all duration-200 whitespace-nowrap" type="submit">
          SUBSCRIBE
        </button>
</form>
<p class="font-body-sm text-body-sm text-outline mt-3">
        By continuing, you agree to our <a class="underline hover:text-primary" href="/ae-en/terms">Terms &amp; Conditions</a> and <a class="underline hover:text-primary" href="/ae-en/privacy">Privacy Policy</a>.
      </p>
</div>
</section>
<!-- 10. LUXURY BLACK FOOTER (Shared Component Footer Integration) -->
<footer class="w-full bg-primary text-on-primary border-t border-outline-variant py-space-xl">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- Brand Anchor Header -->
<div class="flex flex-col md:flex-row items-start md:items-center justify-between pb-8 border-b border-outline gap-4">
<div>
<span class="font-display-hero text-headline-sm uppercase tracking-widest text-on-primary">
            SEPHORA
          </span>
<span class="block font-label-caps text-label-caps text-on-primary-container tracking-widest mt-1">
            MIDDLE EAST LUXURY DESTINATION
          </span>
</div>
<!-- Social Channels -->
<div class="flex items-center gap-4">
<a class="w-9 h-9 border border-outline flex items-center justify-center text-on-primary hover:border-on-primary transition-colors" href="https://www.instagram.com/sephoramiddleeast/" rel="noopener noreferrer" target="_blank" title="Instagram">
<span class="font-label-caps text-[12px] font-bold">IG</span>
</a>
<a class="w-9 h-9 border border-outline flex items-center justify-center text-on-primary hover:border-on-primary transition-colors" href="https://www.youtube.com/user/SEPHORAME" rel="noopener noreferrer" target="_blank" title="YouTube">
<span class="font-label-caps text-[12px] font-bold">YT</span>
</a>
<a class="w-9 h-9 border border-outline flex items-center justify-center text-on-primary hover:border-on-primary transition-colors" href="https://www.facebook.com/sephoramiddleeast" rel="noopener noreferrer" target="_blank" title="Facebook">
<span class="font-label-caps text-[12px] font-bold">FB</span>
</a>
<a class="w-9 h-9 border border-outline flex items-center justify-center text-on-primary hover:border-on-primary transition-colors" href="https://www.snapchat.com/add/Sephoramesnaps" rel="noopener noreferrer" target="_blank" title="Snapchat">
<span class="font-label-caps text-[12px] font-bold">SC</span>
</a>
</div>
</div>
<!-- 6-Column Links Cluster -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 py-10 border-b border-outline">
<!-- Col 1: Top Categories -->
<div>
<h4 class="font-title-md text-title-md font-bold mb-4 uppercase tracking-wider text-on-primary">Top Categories</h4>
<ul class="space-y-2.5 list-none p-0 m-0">
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/shop/makeup">Makeup</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/shop/fragrance">Fragrance</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/shop/skincare">Skincare</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/shop/bath-body">Bath &amp; Body</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/shop/hair">Hair</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/brands/sephora-collection">Sephora Collection</a></li>
</ul>
</div>
<!-- Col 2: Top Brands -->
<div>
<h4 class="font-title-md text-title-md font-bold mb-4 uppercase tracking-wider text-on-primary">Top Brands</h4>
<ul class="space-y-2.5 list-none p-0 m-0">
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/brands/huda-beauty">Huda Beauty</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/brands/kayali">Kayali</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/brands/rare-beauty">Rare Beauty</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/brands/fenty-beauty">Fenty Beauty</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/brands/glow-recipe">Glow Recipe</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/brands/sol-de-janeiro">Sol De Janeiro</a></li>
</ul>
</div>
<!-- Col 3: My Sephora -->
<div>
<h4 class="font-title-md text-title-md font-bold mb-4 uppercase tracking-wider text-on-primary">My Sephora</h4>
<ul class="space-y-2.5 list-none p-0 m-0">
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/my-account">My Account</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/my-account/mysephora">Beauty Pass Program</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/my-account/orders">Order History</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/wishlist">My Wishlist</a></li>
<!-- Active Sub-link highlighted per JSON instructions -->
<li><a class="font-body-sm text-body-sm text-on-primary font-bold underline" href="/ae-en/my-account/settings">Settings</a></li>
</ul>
</div>
<!-- Col 4: Customer Service -->
<div>
<h4 class="font-title-md text-title-md font-bold mb-4 uppercase tracking-wider text-on-primary">Customer Service</h4>
<ul class="space-y-2.5 list-none p-0 m-0">
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/faq">Help &amp; FAQs</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/track-order">Track Order</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/delivery-returns">Delivery &amp; Returns</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/stores">Store Locator</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/contact-us">Contact Us</a></li>
</ul>
</div>
<!-- Col 5: About Sephora -->
<div>
<h4 class="font-title-md text-title-md font-bold mb-4 uppercase tracking-wider text-on-primary">About Sephora</h4>
<ul class="space-y-2.5 list-none p-0 m-0">
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/about-us">About Us</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/careers">Careers</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/terms-and-conditions">Terms &amp; Conditions</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/privacy-policy">Privacy Policy</a></li>
<li><a class="font-body-sm text-body-sm text-on-primary-container hover:text-on-primary transition-colors" href="/ae-en/services">Beauty Services</a></li>
</ul>
</div>
<!-- Col 6: Location & Language -->
<div>
<h4 class="font-title-md text-title-md font-bold mb-4 uppercase tracking-wider text-on-primary">Location &amp; Language</h4>
<div class="space-y-3">
<p class="font-body-sm text-body-sm text-on-primary-container">
              United Arab Emirates (AED)<br/>
              English Interface
            </p>
<a class="inline-block border border-outline px-3 py-1.5 font-label-caps text-label-caps text-on-primary hover:border-on-primary transition-colors" href="/ae-en/my-account/settings/country-and-language">
              CHANGE REGION
            </a>
<div>
<a class="font-body-sm text-body-sm text-on-primary underline block hover:text-on-primary-container transition-colors" href="/ae-ar">
                تغيير إلى العربية
              </a>
</div>
</div>
</div>
</div>
<!-- Footer Bottom Copyright & Payment Badges -->
<div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
<p class="font-body-sm text-body-sm text-on-primary-container text-center md:text-left">
          © 2024 SEPHORA Middle East. All Rights Reserved. Pure Luxury &amp; Authentic Beauty.
        </p>
<!-- Accepted Payment Methods -->
<div class="flex items-center gap-2 flex-wrap justify-center">
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-label-tag text-label-tag font-bold tracking-wider">VISA</span>
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-label-tag text-label-tag font-bold tracking-wider">MASTERCARD</span>
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-label-tag text-label-tag font-bold tracking-wider">APPLE PAY</span>
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-label-tag text-label-tag font-bold tracking-wider">TABBY</span>
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-label-tag text-label-tag font-bold tracking-wider">TAMARA</span>
</div>
</div>
</div>
</footer>
@endsection
