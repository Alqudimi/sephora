@extends('layouts.app')

@section('title', 'Settings | SEPHORA Middle East')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@section('head')
<style>
.material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
      display: inline-block;
      vertical-align: middle;
      line-height: 1;
    }
    /* Radical sharp styling from Design System */
    * {
      border-radius: 0px !important;
    }
</style>
@endsection

@section('content')
<!-- Top Announcement Bar -->
<div class="w-full bg-primary text-on-primary py-2.5 px-4 text-center">
<p class="font-label-caps text-label-caps tracking-widest uppercase">
      WANT TO TURN HEADS? YOUR SIGNATURE SCENT STARTS HERE. DISCOVER THE COLLECTION AND LAYER WITHOUT LIMITS - 
      <a class="underline hover:opacity-80 transition-opacity ml-1" href="/shop/bestsellers">SHOP NOW →</a>
</p>
</div>
<!-- Shared Top Navigation Header -->
<header class="bg-surface-container-lowest border-b border-outline-variant w-full sticky top-0 z-50">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- Main Middle Row -->
<div class="h-20 flex items-center justify-between gap-6">
<!-- Search bar on left -->
<div class="w-1/3 max-w-[340px]">
<div class="relative flex items-center">
<input class="w-full h-11 pl-4 pr-11 bg-surface-container-lowest border border-outline text-on-surface text-body-sm font-body-sm placeholder:text-outline focus:outline-none focus:border-primary transition-colors" placeholder="Search brand, product, category..." type="text"/>
<button aria-label="Search" class="absolute right-0 top-0 h-11 w-11 flex items-center justify-center text-primary hover:opacity-70 transition-opacity">
<span class="material-symbols-outlined text-[20px]" data-icon="search">search</span>
</button>
</div>
</div>
<!-- Center SEPHORA Logo -->
<div class="flex-1 text-center">
<a class="font-display-hero text-headline-md tracking-[0.28em] uppercase font-bold text-primary inline-block" href="/">
            SEPHORA
          </a>
</div>
<!-- Trailing Utility Actions -->
<div class="w-1/3 flex items-center justify-end space-x-6">
<a class="hidden xl:flex items-center space-x-1.5 text-on-surface hover:text-primary transition-colors" href="/stores">
<span class="material-symbols-outlined text-[20px]" data-icon="location_on">location_on</span>
<span class="font-label-caps text-label-caps uppercase tracking-wider">STORES &amp; SERVICES</span>
</a>
<!-- UAE Region / Currency -->
<div class="flex items-center space-x-2 text-on-surface border-l border-outline-variant pl-4">
<span class="text-sm font-label-caps text-label-caps uppercase tracking-wider font-bold">🇦🇪 UAE | AED</span>
</div>
<!-- Account -->
<a class="flex items-center text-primary font-bold transition-colors" href="/my-account" title="My Account">
<span class="material-symbols-outlined text-[24px]" data-icon="person">person</span>
</a>
<!-- Wishlist -->
<a class="text-on-surface hover:text-primary transition-colors" href="/my-account/wishlist" title="Wishlist">
<span class="material-symbols-outlined text-[22px]" data-icon="favorite">favorite</span>
</a>
<!-- Bag with Badge -->
<a class="text-on-surface hover:text-primary transition-colors relative" href="/cart" title="Shopping Bag">
<span class="material-symbols-outlined text-[23px]" data-icon="shopping_bag">shopping_bag</span>
<span class="absolute -top-1.5 -right-2 bg-primary text-on-primary font-label-tag text-[9px] w-4 h-4 flex items-center justify-center font-bold" data-bag-count>@if(!empty($bagCount)){{ $bagCount }}@else 0 @endif</span></a>
</div>
</div>
<!-- Category Links Navigation -->
<nav class="hidden md:flex items-center justify-between border-t border-outline-variant py-3 overflow-x-auto whitespace-nowrap scrollbar-none">
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/shop/fragrance">Stack Your Scent</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/shop/gifts">The Holiday Collection</a>
<a class="font-title-md text-[13px] tracking-wider text-primary font-bold flex items-center gap-1.5" href="#">
<span>BEAUTY OFFERS</span>
<span class="bg-secondary text-on-secondary font-label-tag text-[9px] px-1.5 py-0.5 tracking-normal">HOT</span>
</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/shop/new">New</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/shop/makeup">Makeup</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/shop/fragrance">Fragrance</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/shop/skincare">Skincare</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/shop/bath-body">Bath &amp; Body</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/shop/hair">Hair</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/brands/sephora-collection">Sephora Collection</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/brands">Brands</a>
<a class="font-title-md text-[13px] tracking-wider text-on-surface-variant hover:text-primary transition-colors" href="/shop/bestsellers">Best Sellers</a>
</nav>
</div>
</header>
<!-- Main Container -->
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- Breadcrumb Trail -->
<nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-on-surface-variant font-label-caps text-label-caps mb-8">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<a class="hover:text-primary transition-colors" href="/my-account">My Account</a>
<span>/</span>
<span class="text-primary font-bold">Settings</span>
</nav>
<!-- Account Sub-Navigation Bar (Pills matching My Account screen) -->
<section class="border-b border-outline-variant pb-6 mb-10">
<div class="flex flex-wrap items-center gap-2">
<a class="h-11 px-6 border border-outline-variant bg-surface-container-lowest text-on-surface font-title-md text-[13px] tracking-wider flex items-center hover:border-primary transition-colors" href="/my-account">
          My Account
        </a>
<a class="h-11 px-6 border border-outline-variant bg-surface-container-lowest text-on-surface font-title-md text-[13px] tracking-wider flex items-center hover:border-primary transition-colors" href="#">
          MY SEPHORA
        </a>
<a class="h-11 px-7 bg-primary text-on-primary font-title-md text-[13px] font-bold tracking-wider flex items-center border border-primary shadow-none" href="#">
          SETTINGS
        </a>
<a class="h-11 px-6 border border-outline-variant bg-surface-container-lowest text-on-surface font-title-md text-[13px] tracking-wider flex items-center hover:border-primary transition-colors" href="/faq">
          HELP &amp; FAQS
        </a>
<a class="h-11 px-6 border border-outline-variant bg-surface-container-lowest text-on-surface font-title-md text-[13px] tracking-wider flex items-center hover:border-primary transition-colors" href="/contact-us">
          CONTACT US
        </a>
</div>
</section>
<!-- Settings Page Header Title -->
<div class="mb-10 max-w-4xl">
<h1 class="font-headline-lg text-headline-lg text-primary tracking-tight mb-2">Settings</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant">
        Manage your personal information, security preferences, language, communications, and saved delivery addresses.
      </p>
</div>
<!-- Data Privacy Reassurance Banner -->
<div class="border border-primary bg-surface-container-low p-4 sm:p-5 mb-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
<div class="flex items-center space-x-3.5">
<span class="material-symbols-outlined text-primary text-[24px]" data-icon="verified_user">verified_user</span>
<p class="font-body-md text-body-md text-on-surface">
          Your personal information and beauty journey are safely guarded with end-to-end encryption and strict confidentiality.
        </p>
</div>
<a class="font-label-caps text-label-caps uppercase tracking-wider text-primary font-bold hover:underline whitespace-nowrap" href="#">
        READ MORE ABOUT OUR DATA PRIVACY →
      </a>
</div>
<!-- Structured Settings Grid (Prestige Asymmetric Layout) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-16">
<!-- Left Column: Personal Profile & Regional Preferences (7 Cols) -->
<div class="lg:col-span-7 space-y-8">
<!-- 1. Personal Information & Profile Card -->
<section class="border border-primary bg-surface-container-lowest p-6 sm:p-8">
<div class="flex items-center justify-between border-b border-outline-variant pb-4 mb-6">
<div class="flex items-center space-x-3">
<span class="material-symbols-outlined text-primary text-[22px]" data-icon="person_outline">person_outline</span>
<h2 class="font-title-lg text-title-lg text-primary uppercase tracking-wider">Personal Information</h2>
</div>
<span class="font-label-tag text-label-tag text-on-surface-variant uppercase tracking-widest">BEAUTY PASS GOLD</span>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
<div>
<label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-1.5">First Name</label>
<input class="w-full h-12 bg-surface-container-lowest border border-outline px-4 font-body-md text-on-surface focus:outline-none focus:border-primary" type="text" value="Fatima"/>
</div>
<div>
<label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-1.5">Last Name</label>
<input class="w-full h-12 bg-surface-container-lowest border border-outline px-4 font-body-md text-on-surface focus:outline-none focus:border-primary" type="text" value="Al-Mansoor"/>
</div>
<div class="sm:col-span-2">
<label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-1.5">Email Address</label>
<input class="w-full h-12 bg-surface-container-lowest border border-outline px-4 font-body-md text-on-surface focus:outline-none focus:border-primary" type="email" value="fatima.almansoor@luxurymail.ae"/>
</div>
<div>
<label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-1.5">Mobile Phone (UAE)</label>
<div class="flex">
<span class="h-12 px-3 border border-r-0 border-outline bg-surface-container-low flex items-center font-body-sm font-bold text-on-surface">+971</span>
<input class="flex-1 h-12 bg-surface-container-lowest border border-outline px-4 font-body-md text-on-surface focus:outline-none focus:border-primary" type="tel" value="50 892 4190"/>
</div>
</div>
<div>
<label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-1.5">Date of Birth (Birthday Gift)</label>
<input class="w-full h-12 bg-surface-container-lowest border border-outline px-4 font-body-md text-on-surface focus:outline-none focus:border-primary" type="text" value="14 / 09 / 1994"/>
</div>
<div class="sm:col-span-2">
<label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-2">Gender Selection</label>
<div class="flex items-center space-x-6">
<label class="flex items-center space-x-2.5 cursor-pointer">
<input checked="" class="w-4 h-4 text-primary focus:ring-0" name="gender" type="radio"/>
<span class="font-body-md text-on-surface">Female</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="w-4 h-4 text-primary focus:ring-0" name="gender" type="radio"/>
<span class="font-body-md text-on-surface">Male</span>
</label>
<label class="flex items-center space-x-2.5 cursor-pointer">
<input class="w-4 h-4 text-primary focus:ring-0" name="gender" type="radio"/>
<span class="font-body-md text-on-surface">Prefer not to say</span>
</label>
</div>
</div>
</div>
<div class="flex justify-end pt-2">
<button class="h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all">
              SAVE CHANGES
            </button>
</div>
</section>
<!-- 2. Country, Language & Currency -->
<section class="border border-outline-variant hover:border-primary bg-surface-container-lowest p-6 sm:p-8 transition-colors">
<div class="flex items-center space-x-3 border-b border-outline-variant pb-4 mb-6">
<span class="material-symbols-outlined text-primary text-[22px]" data-icon="language">language</span>
<h2 class="font-title-lg text-title-lg text-primary uppercase tracking-wider">Country &amp; Language</h2>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
<!-- Country -->
<div class="border border-outline-variant p-4">
<span class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-1">Country</span>
<p class="font-title-md text-title-md text-primary flex items-center justify-between">
<span>United Arab Emirates</span>
<span>🇦🇪</span>
</p>
<span class="block text-body-sm text-outline mt-1 font-body-sm">GCC Hub Store</span>
</div>
<!-- Language -->
<div class="border border-outline-variant p-4">
<span class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-1">Preferred Language</span>
<div class="flex items-center justify-between mt-1">
<span class="font-title-md text-title-md text-primary font-bold">English (EN)</span>
<a class="font-label-caps text-label-caps text-secondary underline hover:opacity-80" href="#">العربية</a>
</div>
<span class="block text-body-sm text-outline mt-1 font-body-sm">Sephora ME Interface</span>
</div>
<!-- Currency -->
<div class="border border-outline-variant p-4">
<span class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-1">Currency</span>
<p class="font-title-md text-title-md text-primary">AED (Dirhams)</p>
<span class="block text-body-sm text-outline mt-1 font-body-sm">All taxes included (VAT)</span>
</div>
</div>
</section>
<!-- 3. Saved Addresses Section -->
<section class="border border-outline-variant hover:border-primary bg-surface-container-lowest p-6 sm:p-8 transition-colors">
<div class="flex items-center justify-between border-b border-outline-variant pb-4 mb-6">
<div class="flex items-center space-x-3">
<span class="material-symbols-outlined text-primary text-[22px]" data-icon="home_pin">home_pin</span>
<h2 class="font-title-lg text-title-lg text-primary uppercase tracking-wider">Saved Delivery Addresses</h2>
</div>
<button class="font-label-caps text-label-caps uppercase text-primary font-bold hover:underline flex items-center space-x-1">
<span class="material-symbols-outlined text-[16px]" data-icon="add">add</span>
<span>ADD ADDRESS</span>
</button>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<!-- Default Address -->
<div class="border border-primary p-5 relative bg-surface">
<span class="inline-block bg-primary text-on-primary font-label-tag text-[9px] px-2 py-0.5 uppercase tracking-wider mb-2 font-bold">DEFAULT ADDRESS</span>
<h3 class="font-title-md text-title-md text-primary font-bold">Villa 42, Al Naseem Luxury Enclave</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Jumeirah 3, Dubai</p>
<p class="font-body-md text-body-md text-on-surface-variant">United Arab Emirates</p>
<p class="font-body-sm text-body-sm text-outline mt-2">Mobile: +971 50 892 4190</p>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center space-x-4">
<a class="font-label-caps text-label-caps uppercase text-primary underline" href="#">Edit</a>
<a class="font-label-caps text-label-caps uppercase text-outline hover:text-error" href="#">Delete</a>
</div>
</div>
<!-- Secondary Address -->
<div class="border border-outline-variant p-5 relative hover:border-outline transition-colors">
<span class="inline-block bg-surface-container-high text-on-surface-variant font-label-tag text-[9px] px-2 py-0.5 uppercase tracking-wider mb-2 font-bold">OFFICE</span>
<h3 class="font-title-md text-title-md text-primary font-bold">Level 28, Gate Prestige Tower 4</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">DIFC, Financial Center, Dubai</p>
<p class="font-body-md text-body-md text-on-surface-variant">United Arab Emirates</p>
<p class="font-body-sm text-body-sm text-outline mt-2">Mobile: +971 50 892 4190</p>
<div class="mt-4 pt-3 border-t border-outline-variant flex items-center space-x-4">
<a class="font-label-caps text-label-caps uppercase text-primary underline" href="#">Set Default</a>
<a class="font-label-caps text-label-caps uppercase text-primary underline" href="#">Edit</a>
<a class="font-label-caps text-label-caps uppercase text-outline hover:text-error" href="#">Delete</a>
</div>
</div>
</div>
</section>
</div>
<!-- Right Column: Subscriptions, Security & Payment (5 Cols) -->
<div class="lg:col-span-5 space-y-8">
<!-- 4. Communications & Subscriptions -->
<section class="border border-primary bg-surface-container-lowest p-6 sm:p-8">
<div class="flex items-center space-x-3 border-b border-outline-variant pb-4 mb-6">
<span class="material-symbols-outlined text-primary text-[22px]" data-icon="mark_email_read">mark_email_read</span>
<h2 class="font-title-lg text-title-lg text-primary uppercase tracking-wider">Communications</h2>
</div>
<div class="space-y-5">
<div class="flex items-start justify-between pb-4 border-b border-outline-variant">
<div>
<p class="font-title-md text-title-md text-primary font-bold">Sephora Newsletter (Email)</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Prestige fragrance drops, seasonal trends, and editor masterclasses.</p>
</div>
<input checked="" class="w-5 h-5 text-primary border-outline focus:ring-0 mt-0.5" type="checkbox"/>
</div>
<div class="flex items-start justify-between pb-4 border-b border-outline-variant">
<div>
<p class="font-title-md text-title-md text-primary font-bold">SMS Notifications</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Order fulfillment updates, delivery dispatches, and flash drops.</p>
</div>
<input checked="" class="w-5 h-5 text-primary border-outline focus:ring-0 mt-0.5" type="checkbox"/>
</div>
<div class="flex items-start justify-between">
<div>
<p class="font-title-md text-title-md text-primary font-bold">Beauty Pass VIP Privileges</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Exclusive invitations to Dubai Mall flagship private masterclasses &amp; gifts.</p>
</div>
<input checked="" class="w-5 h-5 text-primary border-outline focus:ring-0 mt-0.5" type="checkbox"/>
</div>
</div>
</section>
<!-- 5. Password & Security -->
<section class="border border-outline-variant hover:border-primary bg-surface-container-lowest p-6 sm:p-8 transition-colors">
<div class="flex items-center space-x-3 border-b border-outline-variant pb-4 mb-6">
<span class="material-symbols-outlined text-primary text-[22px]" data-icon="lock_outline">lock_outline</span>
<h2 class="font-title-lg text-title-lg text-primary uppercase tracking-wider">Password &amp; Security</h2>
</div>
<div class="space-y-4">
<div>
<label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-1">Current Password</label>
<input class="w-full h-11 bg-surface-container-lowest border border-outline px-4 font-body-md focus:outline-none focus:border-primary" readonly="" type="password" value="••••••••••••"/>
</div>
<div class="pt-2 flex items-center justify-between">
<button class="h-10 px-5 border border-primary text-primary font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary hover:text-on-primary transition-all">
                CHANGE PASSWORD
              </button>
<span class="font-body-sm text-outline flex items-center gap-1">
<span class="material-symbols-outlined text-[16px] text-green-700" data-icon="check_circle">check_circle</span>
                2FA Enabled
              </span>
</div>
<div class="mt-4 pt-4 border-t border-outline-variant">
<p class="font-label-caps text-label-caps uppercase text-on-surface-variant mb-2">Connected Devices</p>
<div class="flex items-center justify-between text-body-sm text-on-surface">
<span>Apple iPhone 15 Pro • Dubai, UAE</span>
<span class="text-outline">Active Now</span>
</div>
</div>
</div>
</section>
<!-- 6. Saved Payment Methods -->
<section class="border border-outline-variant hover:border-primary bg-surface-container-lowest p-6 sm:p-8 transition-colors">
<div class="flex items-center justify-between border-b border-outline-variant pb-4 mb-6">
<div class="flex items-center space-x-3">
<span class="material-symbols-outlined text-primary text-[22px]" data-icon="credit_card">credit_card</span>
<h2 class="font-title-lg text-title-lg text-primary uppercase tracking-wider">Payment Methods</h2>
</div>
<button class="font-label-caps text-label-caps uppercase text-primary font-bold hover:underline">MANAGE</button>
</div>
<div class="space-y-3">
<div class="border border-outline-variant p-3.5 flex items-center justify-between">
<div class="flex items-center space-x-3">
<span class="font-bold text-sm bg-primary text-on-primary px-2 py-1 font-label-tag">APPLE PAY</span>
<span class="font-body-md text-on-surface font-semibold">Apple Pay (Primary)</span>
</div>
<span class="material-symbols-outlined text-[20px] text-green-700" data-icon="verified">verified</span>
</div>
<div class="border border-outline-variant p-3.5 flex items-center justify-between">
<div class="flex items-center space-x-3">
<span class="font-bold text-sm border border-outline px-2 py-0.5 font-label-tag tracking-wider">VISA</span>
<span class="font-body-md text-on-surface">Visa ending in •••• 4082</span>
</div>
<span class="text-body-sm text-outline">Exp 08/27</span>
</div>
</div>
</section>
</div>
</div>
<!-- Sephora Trust Badges: 4 Luxury Value Props Horizontal Row -->
<section class="border-y border-outline-variant py-8 mb-16 bg-surface-container-lowest">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
<!-- 1. Free Delivery -->
<div class="flex flex-col items-center px-4">
<span class="material-symbols-outlined text-primary text-[32px] mb-2" data-icon="local_shipping">local_shipping</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold tracking-wider">FREE DELIVERY</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Over 250 AED across UAE</p>
</div>
<!-- 2. 100% Authentic -->
<div class="flex flex-col items-center px-4 border-l-0 md:border-l border-outline-variant">
<span class="material-symbols-outlined text-primary text-[32px] mb-2" data-icon="verified">verified</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold tracking-wider">100% AUTHENTIC</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Direct from global beauty houses</p>
</div>
<!-- 3. Easy Returns -->
<div class="flex flex-col items-center px-4 border-l-0 md:border-l border-outline-variant">
<span class="material-symbols-outlined text-primary text-[32px] mb-2" data-icon="assignment_return">assignment_return</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold tracking-wider">EASY RETURNS</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">In any UAE store within 14 days</p>
</div>
<!-- 4. Customer Service -->
<div class="flex flex-col items-center px-4 border-l-0 md:border-l border-outline-variant">
<span class="material-symbols-outlined text-primary text-[32px] mb-2" data-icon="support_agent">support_agent</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold tracking-wider">CUSTOMER SERVICE</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Questions? Toll-Free 800 7374672</p>
</div>
</div>
</section>
<!-- Newsletter Subscription Section -->
<section class="border border-primary p-8 md:p-12 mb-16 bg-surface-container-low text-center max-w-4xl mx-auto">
<h3 class="font-headline-md text-headline-md text-primary mb-2">Subscribe to the Sephora newsletter!</h3>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl mx-auto mb-8">
        Receive exclusive previews of prestige fragrance drops, private VIP sales, and masterclasses.
      </p>
<form class="flex flex-col sm:flex-row justify-center max-w-lg mx-auto gap-0" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="flex-1 h-12 bg-surface-container-lowest border border-outline px-4 font-body-md text-on-surface focus:outline-none focus:border-primary" placeholder="Enter your email address" required="" type="email"/>
<button class="h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" type="submit">
          SUBSCRIBE
        </button>
</form>
</section>
</main>
<!-- Luxury Sephora Footer -->
<footer class="bg-primary text-on-primary w-full border-t border-outline-variant">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl">
<!-- Footer Columns -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 pb-12 border-b border-on-primary-container">
<!-- Col 1: Top Categories -->
<div>
<h5 class="font-title-md text-title-md text-on-primary uppercase tracking-wider mb-4 font-bold">Top Categories</h5>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/shop/makeup">Makeup</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/fragrance">Fragrance</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/skincare">Skincare</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/bath-body">Bath &amp; Body</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/hair">Hair</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/brands/sephora-collection">Sephora Collection</a></li>
</ul>
</div>
<!-- Col 2: Top Brands -->
<div>
<h5 class="font-title-md text-title-md text-on-primary uppercase tracking-wider mb-4 font-bold">Top Brands</h5>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">Huda Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Kayali</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Rare Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Fenty Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Glow Recipe</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Sol De Janeiro</a></li>
</ul>
</div>
<!-- Col 3: My Sephora -->
<div>
<h5 class="font-title-md text-title-md text-on-primary uppercase tracking-wider mb-4 font-bold">My Sephora</h5>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/my-account">My Account</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/my-account">Beauty Pass Program</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Order History</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/my-account/wishlist">My Wishlist</a></li>
<li><a class="text-on-primary font-bold underline" href="#">Settings</a></li>
</ul>
</div>
<!-- Col 4: Customer Service -->
<div>
<h5 class="font-title-md text-title-md text-on-primary uppercase tracking-wider mb-4 font-bold">Customer Service</h5>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/faq">Help &amp; FAQs</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Track Order</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Delivery &amp; Returns</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Store Locator</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/contact-us">Contact Us</a></li>
</ul>
</div>
<!-- Col 5: About Sephora -->
<div>
<h5 class="font-title-md text-title-md text-on-primary uppercase tracking-wider mb-4 font-bold">About Sephora</h5>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/stores">About Us</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Careers</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Terms &amp; Conditions</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Privacy Policy</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Beauty Services</a></li>
</ul>
</div>
<!-- Col 6: Location & Language + Social -->
<div>
<h5 class="font-title-md text-title-md text-on-primary uppercase tracking-wider mb-4 font-bold">Location &amp; Language</h5>
<div class="space-y-2 font-body-sm text-body-sm text-on-primary-container mb-6">
<p class="text-on-primary font-semibold">United Arab Emirates</p>
<p>AED - English</p>
<a class="inline-block text-secondary underline hover:opacity-80" href="#">تغيير إلى العربية</a>
</div>
<h5 class="font-label-caps text-label-caps uppercase tracking-wider text-on-primary mb-3">FOLLOW US</h5>
<div class="flex items-center space-x-3 text-on-primary">
<a class="w-8 h-8 border border-on-primary-container flex items-center justify-center hover:border-on-primary transition-colors" href="#" title="Instagram">
<span class="text-xs font-bold">IG</span>
</a>
<a class="w-8 h-8 border border-on-primary-container flex items-center justify-center hover:border-on-primary transition-colors" href="#" title="TikTok">
<span class="text-xs font-bold">TK</span>
</a>
<a class="w-8 h-8 border border-on-primary-container flex items-center justify-center hover:border-on-primary transition-colors" href="#" title="YouTube">
<span class="text-xs font-bold">YT</span>
</a>
<a class="w-8 h-8 border border-on-primary-container flex items-center justify-center hover:border-on-primary transition-colors" href="#" title="Snapchat">
<span class="text-xs font-bold">SC</span>
</a>
</div>
</div>
</div>
<!-- Bottom Bar: Wordmark, Copyright & Payment Icons -->
<div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-6">
<div class="flex flex-col sm:flex-row sm:items-center gap-4 text-center sm:text-left">
<span class="font-display-hero text-headline-sm uppercase tracking-widest text-on-primary font-bold">SEPHORA</span>
<p class="font-body-sm text-body-sm text-on-primary-container">
            © 2024 SEPHORA Middle East. All Rights Reserved. Pure Luxury &amp; Authentic Beauty.
          </p>
</div>
<!-- Payment Icons -->
<div class="flex flex-wrap items-center gap-2">
<span class="px-2.5 py-1 bg-surface-container-lowest text-primary font-label-tag font-bold tracking-wider text-[10px]">VISA</span>
<span class="px-2.5 py-1 bg-surface-container-lowest text-primary font-label-tag font-bold tracking-wider text-[10px]">MASTERCARD</span>
<span class="px-2.5 py-1 bg-surface-container-lowest text-primary font-label-tag font-bold tracking-wider text-[10px]">APPLE PAY</span>
<span class="px-2.5 py-1 bg-surface-container-lowest text-primary font-label-tag font-bold tracking-wider text-[10px]">TABBY</span>
<span class="px-2.5 py-1 bg-surface-container-lowest text-primary font-label-tag font-bold tracking-wider text-[10px]">TAMARA</span>
</div>
</div>
</div>
</footer>
@endsection
