@extends('layouts.app')

@section('title', 'SEPHORA | My Account - Pure Luxury & Authentic Beauty')
@section('body_class', 'bg-surface text-on-surface font-body-md text-body-md antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col')

@section('head')
<style>
.material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
      display: inline-block;
      vertical-align: middle;
      line-height: 1;
    }
    .custom-scrollbar::-webkit-scrollbar {
      height: 2px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: #000000;
    }
</style>
@endsection

@section('content')
<!-- Top Announcement Bar -->
<div class="bg-primary text-on-primary py-2.5 px-4 text-center border-b border-primary">
<div class="max-w-[1440px] mx-auto flex items-center justify-center gap-2">
<span class="font-body-sm text-body-sm tracking-wide">
        Want to turn heads? Your signature scent starts here. Discover the collection and layer without limits
      </span>
<a class="font-label-caps text-label-caps underline hover:text-outline-variant transition-colors ml-1 uppercase" href="/shop/bestsellers">
        SHOP NOW →
      </a>
</div>
</div>
<!-- Main Navigation Header (TopNavBar Component) -->
<header class="bg-surface-container-lowest sticky top-0 z-50 border-b border-outline-variant">
<div class="flex flex-col w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- Top Row: Logo, Search, Trailing Actions -->
<div class="flex items-center justify-between py-4 gap-6">
<!-- Left: Search Box (on_left style) -->
<div class="flex-1 max-w-md hidden md:flex items-center">
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-xl pointer-events-none">search</span>
<input class="w-full bg-surface-container-low border border-outline-variant pl-10 pr-4 py-2 text-sm text-on-surface placeholder:text-outline focus:outline-none focus:border-primary focus:bg-surface-container-lowest transition-all" placeholder="Search..." type="text"/>
</div>
</div>
<!-- Center: Sephora Brand Logo -->
<div class="flex-shrink-0 text-center mx-auto md:mx-0">
<a class="font-display-hero text-headline-md tracking-widest uppercase font-bold text-primary inline-block" href="/">
            SEPHORA
          </a>
</div>
<!-- Right: Actions & Country Selector -->
<div class="flex items-center gap-5 justify-end flex-1">
<!-- Stores & Services -->
<a class="hidden lg:flex items-center gap-2 text-on-surface hover:text-primary transition-colors cursor-pointer group" href="/stores">
<span class="material-symbols-outlined text-xl">location_on</span>
<span class="font-label-caps text-label-caps tracking-wider text-xs">Stores &amp; Services</span>
</a>
<div class="h-4 w-[1px] bg-outline-variant hidden lg:block"></div>
<!-- Country Indicator UAE -->
<div class="hidden sm:flex items-center gap-2 cursor-pointer hover:opacity-80 transition-opacity">
<span class="inline-flex items-center justify-center w-5 h-3.5 bg-neutral-100 border border-neutral-300 overflow-hidden rounded-[1px] shadow-sm">
<span class="w-1.5 h-full bg-red-600 inline-block"></span>
<span class="flex-1 flex flex-col h-full">
<span class="h-1 bg-green-700 w-full inline-block"></span>
<span class="h-1 bg-white w-full inline-block"></span>
<span class="h-1 bg-black w-full inline-block"></span>
</span>
</span>
<span class="font-label-caps text-label-caps text-[10px]">UAE | AED</span>
</div>
<!-- Account Icon (Active context: My Account) -->
<a class="flex items-center justify-center p-1.5 text-primary border-b-2 border-primary cursor-pointer transition-all" href="/my-account" title="My Account">
<span class="material-symbols-outlined text-2xl font-bold" style="font-variation-settings: 'FILL' 1;">person</span>
</a>
<!-- Wishlist Favorite Icon -->
<a class="flex items-center justify-center p-1.5 text-on-surface-variant hover:text-primary transition-colors cursor-pointer" href="/my-account/wishlist" title="Wishlist">
<span class="material-symbols-outlined text-2xl">favorite</span>
</a>
<!-- Shopping Bag Icon -->
<a class="flex items-center justify-center p-1.5 text-on-surface-variant hover:text-primary transition-colors relative cursor-pointer" href="/cart" title="Bag">
<span class="material-symbols-outlined text-2xl">shopping_bag</span>
<span class="absolute 1 top-0 right-0 bg-primary text-on-primary text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center leading-none" data-bag-count>@if(!empty($bagCount)){{ $bagCount }}@else 0 @endif</span></a>
</div>
</div>
<!-- Bottom Row: Navigation Links Hierarchy -->
<nav class="border-t border-outline-variant overflow-x-auto custom-scrollbar py-2.5">
<ul class="flex items-center justify-between min-w-max gap-6 text-xs uppercase tracking-wider font-semibold font-title-md">
<li><a class="text-neutral-500 hover:text-primary transition-colors duration-150" href="/shop/fragrance">Stack Your Scent</a></li>
<li><a class="text-neutral-500 hover:text-primary transition-colors duration-150" href="/shop/gifts">The Holiday Collection</a></li>
<li><a class="text-secondary font-bold hover:opacity-80 transition-opacity" href="/beauty-offers">Beauty Offers</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/new">New</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/makeup">Makeup</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/fragrance">Fragrance</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/skincare">Skincare</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/bath-body">Bath &amp; Body</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/hair">Hair</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/brands/sephora-collection">Sephora Collection</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/brands">Brands</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/bestsellers">Best Sellers</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/gifts">Gifts</a></li>
</ul>
</nav>
</div>
</header>
<!-- Main Content Canvas -->
<main class="flex-1 w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- Breadcrumbs -->
<div class="flex items-center gap-2 mb-6 font-body-sm text-body-sm text-outline">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<span class="text-primary font-semibold underline decoration-1 underline-offset-4">My Account</span>
</div>
<!-- Account Navigation Sub-Tabs Bar -->
<div class="flex items-center flex-wrap gap-3 pb-8 border-b border-outline-variant mb-8">
<a class="px-6 py-2.5 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider text-xs border border-primary transition-colors" href="/my-account">
        My Account
      </a>
<a class="px-6 py-2.5 bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider text-xs border border-outline-variant hover:border-primary transition-colors" href="#">
        MY SEPHORA
      </a>
<a class="px-6 py-2.5 bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider text-xs border border-outline-variant hover:border-primary transition-colors" href="#">
        Settings
      </a>
<a class="px-6 py-2.5 bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider text-xs border border-outline-variant hover:border-primary transition-colors" href="/faq">
        Help &amp; FAQs
      </a>
<a class="px-6 py-2.5 bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider text-xs border border-outline-variant hover:border-primary transition-colors" href="/contact-us">
        Contact Us
      </a>
</div>
<!-- Hero Promo Card: MY SEPHORA The Loyalty Program -->
<section class="bg-[#f7f6f4] border border-[#e4e1dc] mb-10 overflow-hidden">
<div class="grid grid-cols-1 md:grid-cols-12 min-h-[380px]">
<!-- Left Image Column (Reference exact editorial photo) -->
<div class="md:col-span-6 relative overflow-hidden bg-neutral-200">
<img alt="Three radiant, smiling women showing cosmetics in a modern luxury beauty campaign" class="w-full h-full object-cover object-center min-h-[320px] md:min-h-full" src="{{ asset('images/content/img_0a702b66b8439fb5.jpg') }}"/>
<div class="absolute inset-0 bg-primary/5 pointer-events-none"></div>
</div>
<!-- Right Content Column -->
<div class="md:col-span-6 p-8 md:p-14 flex flex-col justify-center bg-[#f7f6f4]">
<!-- MY SEPHORA Loyalty Program Emblem -->
<div class="flex items-center gap-3.5 mb-6">
<div class="flex flex-col gap-1 w-6">
<span class="h-1.5 w-full bg-primary inline-block"></span>
<span class="h-1.5 w-full bg-primary inline-block"></span>
<span class="h-1.5 w-full bg-primary inline-block"></span>
</div>
<div>
<h2 class="font-display-hero text-2xl tracking-[0.2em] uppercase font-bold text-primary leading-tight">
                MY SEPHORA
              </h2>
<p class="font-label-caps text-[10px] tracking-[0.25em] text-outline uppercase font-semibold">
                THE LOYALTY PROGRAM
              </p>
</div>
</div>
<!-- Description -->
<p class="font-body-lg text-on-surface-variant max-w-lg mb-8 leading-relaxed">
            Create a Sephora account to track orders, enjoy personalized offers, and unlock exclusive gifts and rewards with MY SEPHORA.
          </p>
<!-- CTAs -->
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
<button class="px-8 py-3.5 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest font-bold border border-primary hover:bg-neutral-800 transition-colors duration-200 text-center">
              SIGN IN
            </button>
<button class="px-8 py-3.5 bg-transparent text-primary font-label-caps text-label-caps uppercase tracking-widest font-bold border border-primary hover:bg-white transition-colors duration-200 text-center">
              CREATE ACCOUNT
            </button>
</div>
</div>
</div>
</section>
<!-- Account Quick Navigation Grid (Feature Cards) -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
<!-- Card 1: MY SEPHORA -->
<a class="group p-6 bg-surface-container-lowest border border-outline-variant hover:border-primary transition-all duration-200 flex items-start gap-4" href="#">
<div class="w-12 h-12 flex-shrink-0 border border-outline-variant flex items-center justify-center group-hover:border-primary transition-colors">
<span class="material-symbols-outlined text-2xl text-primary">credit_card</span>
</div>
<div>
<h3 class="font-title-lg text-title-lg text-primary mb-1 uppercase tracking-wider group-hover:underline">
            MY SEPHORA
          </h3>
<p class="font-body-sm text-on-surface-variant leading-relaxed">
            Discover our renewed Loyalty Program and exclusive benefits.
          </p>
</div>
</a>
<!-- Card 2: Settings -->
<a class="group p-6 bg-surface-container-lowest border border-outline-variant hover:border-primary transition-all duration-200 flex items-start gap-4" href="#">
<div class="w-12 h-12 flex-shrink-0 border border-outline-variant flex items-center justify-center group-hover:border-primary transition-colors">
<span class="material-symbols-outlined text-2xl text-primary">tune</span>
</div>
<div>
<h3 class="font-title-lg text-title-lg text-primary mb-1 uppercase tracking-wider group-hover:underline">
            Settings
          </h3>
<p class="font-body-sm text-on-surface-variant leading-relaxed">
            Manage and update your account settings, addresses, and preferences.
          </p>
</div>
</a>
<!-- Card 3: Frequently Asked Questions -->
<a class="group p-6 bg-surface-container-lowest border border-outline-variant hover:border-primary transition-all duration-200 flex items-start gap-4" href="#">
<div class="w-12 h-12 flex-shrink-0 border border-outline-variant flex items-center justify-center group-hover:border-primary transition-colors">
<span class="material-symbols-outlined text-2xl text-primary">info</span>
</div>
<div>
<h3 class="font-title-lg text-title-lg text-primary mb-1 uppercase tracking-wider group-hover:underline">
            Frequently Asked Questions
          </h3>
<p class="font-body-sm text-on-surface-variant leading-relaxed">
            Get answers to all your important questions regarding delivery and orders.
          </p>
</div>
</a>
</section>
<!-- Secondary Row Card: Contact Us & Data Privacy notice -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-14">
<!-- Card 4: Contact Us -->
<a class="group p-6 bg-surface-container-lowest border border-outline-variant hover:border-primary transition-all duration-200 flex items-start gap-4" href="#">
<div class="w-12 h-12 flex-shrink-0 border border-outline-variant flex items-center justify-center group-hover:border-primary transition-colors">
<span class="material-symbols-outlined text-2xl text-primary">chat</span>
</div>
<div>
<h3 class="font-title-lg text-title-lg text-primary mb-1 uppercase tracking-wider group-hover:underline">
            Contact Us
          </h3>
<p class="font-body-sm text-on-surface-variant leading-relaxed">
            Contact Sephora client advisors via live chat, call, or email.
          </p>
</div>
</a>
<!-- Privacy Link Callout Box -->
<div class="md:col-span-2 p-6 bg-surface-container-low border border-outline-variant flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-xl text-primary">lock</span>
<span class="font-body-sm text-on-surface-variant">
            Your personal information and beauty journey are safely guarded with end-to-end security.
          </span>
</div>
<a class="font-label-caps text-label-caps text-primary underline underline-offset-4 hover:text-secondary uppercase whitespace-nowrap font-bold" href="#">
          Read more about our DATA PRIVACY →
        </a>
</div>
</section>
<!-- Trust Badges & Guarantees Bar -->
<section class="border-t border-b border-outline-variant py-8 mb-14">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
<div class="flex items-center gap-3.5">
<span class="material-symbols-outlined text-3xl text-primary font-light">local_shipping</span>
<div>
<h4 class="font-label-caps text-label-caps uppercase text-primary font-bold">Free Delivery</h4>
<p class="font-body-sm text-body-sm text-outline">Over 250 AED</p>
</div>
</div>
<div class="flex items-center gap-3.5">
<span class="material-symbols-outlined text-3xl text-primary font-light">verified</span>
<div>
<h4 class="font-label-caps text-label-caps uppercase text-primary font-bold">100% Authentic</h4>
<p class="font-body-sm text-body-sm text-outline">Direct from global brands</p>
</div>
</div>
<div class="flex items-center gap-3.5">
<span class="material-symbols-outlined text-3xl text-primary font-light">autorenew</span>
<div>
<h4 class="font-label-caps text-label-caps uppercase text-primary font-bold">Easy Returns</h4>
<p class="font-body-sm text-body-sm text-outline">In any UAE store</p>
</div>
</div>
<div class="flex items-center gap-3.5">
<span class="material-symbols-outlined text-3xl text-primary font-light">support_agent</span>
<div>
<h4 class="font-label-caps text-label-caps uppercase text-primary font-bold">Customer Service</h4>
<p class="font-body-sm text-body-sm text-outline">Questions? 800 7374672</p>
</div>
</div>
</div>
</section>
<!-- Sephora Newsletter Subscription Bar -->
<section class="bg-surface-container-low border border-outline-variant p-8 md:p-10 mb-14">
<div class="max-w-3xl mx-auto text-center">
<h3 class="font-headline-sm text-headline-sm text-primary mb-2">
          Subscribe to the Sephora newsletter!
        </h3>
<p class="font-body-sm text-on-surface-variant mb-6">
          Receive exclusive previews of prestige fragrance drops, private VIP sales, and masterclasses.
        </p>
<form class="flex flex-col sm:flex-row gap-2 max-w-md mx-auto" onsubmit="event.preventDefault();" data-newsletter-form>
<input class="flex-1 bg-surface-container-lowest border border-outline-variant px-4 py-3 text-sm focus:border-primary focus:outline-none" placeholder="Enter your email address" required="" type="email"/>
<button class="px-8 py-3 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider font-bold hover:bg-neutral-800 transition-colors" type="submit">
            Subscribe
          </button>
</form>
</div>
</section>
</main>
<!-- Comprehensive Sephora Footer (Footer Component from Shared JSON) -->
<footer class="bg-primary text-on-primary w-full border-t border-outline-variant px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl mt-auto">
<div class="max-w-[1440px] mx-auto">
<!-- Upper Footer Grid -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 pb-12 border-b border-neutral-800 text-xs">
<!-- Column 1: Top Categories -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">Top Categories</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/shop/makeup">Makeup</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/fragrance">Fragrance</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/skincare">Skincare</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/bath-body">Bath &amp; Body</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/hair">Hair</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/brands/sephora-collection">Sephora Collection</a></li>
</ul>
</div>
<!-- Column 2: Top Brands -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">Top Brands</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">Huda Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Kayali</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Rare Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Fenty Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Glow Recipe</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Sol De Janeiro</a></li>
</ul>
</div>
<!-- Column 3: My Sephora -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">My Sephora</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="text-on-primary font-bold underline" href="/my-account">My Account</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/my-account">Beauty Pass Program</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Order History</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/my-account/wishlist">My Wishlist</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Beauty Preferences</a></li>
</ul>
</div>
<!-- Column 4: Customer Service -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">Customer Service</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/faq">Help &amp; FAQs</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Track Order</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Delivery &amp; Returns</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Store Locator</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/contact-us">Contact Us</a></li>
</ul>
</div>
<!-- Column 5: About Sephora -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">About Sephora</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/stores">About Us</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Careers</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Terms &amp; Conditions</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Privacy Policy</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Beauty Services</a></li>
</ul>
</div>
<!-- Column 6: Region & Social -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">Location &amp; Language</h5>
<div class="mb-4">
<span class="text-on-primary-container block mb-1">United Arab Emirates</span>
<span class="font-semibold text-on-primary">AED - English</span>
</div>
<h5 class="font-label-caps text-label-caps uppercase text-on-primary mb-3">Connect With Us</h5>
<div class="flex items-center gap-3 text-on-primary-container">
<a class="hover:text-on-primary transition-colors" href="#" title="Instagram">
<span class="material-symbols-outlined text-lg">photo_camera</span>
</a>
<a class="hover:text-on-primary transition-colors" href="#" title="Facebook">
<span class="material-symbols-outlined text-lg">public</span>
</a>
<a class="hover:text-on-primary transition-colors" href="#" title="YouTube">
<span class="material-symbols-outlined text-lg">smart_display</span>
</a>
<a class="hover:text-on-primary transition-colors" href="#" title="App">
<span class="material-symbols-outlined text-lg">smartphone</span>
</a>
</div>
</div>
</div>
<!-- Lower Footer: Payment methods & Copyright -->
<div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
<div class="flex items-center gap-3">
<span class="font-display-hero text-headline-sm uppercase tracking-widest text-on-primary">
            SEPHORA
          </span>
<span class="text-neutral-500 text-xs hidden md:inline">|</span>
<p class="font-body-sm text-body-sm text-neutral-400">
            © 2024 SEPHORA Middle East. All Rights Reserved. Pure Luxury &amp; Authentic Beauty.
          </p>
</div>
<!-- Payment Badges -->
<div class="flex items-center gap-3 text-[10px] font-bold tracking-widest text-neutral-400 uppercase">
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">VISA</span>
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">MASTERCARD</span>
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">APPLE PAY</span>
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">TABBY</span>
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">TAMARA</span>
</div>
</div>
</div>
</footer>
@endsection
