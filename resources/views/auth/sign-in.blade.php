@extends('layouts.app')

@section('title', 'Sephora UAE Sign In & Register Rebuild')
@section('body_class', 'bg-background text-on-surface antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col justify-between font-body-md text-body-md')

@section('head')
<style>
.material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }
    input:focus {
      outline: none !important;
    }
</style>
@endsection

@section('content')
<!-- ========================================================= -->
<!-- 1. TOP ANNOUNCEMENT BAR                                   -->
<!-- ========================================================= -->
<aside class="w-full bg-primary text-on-primary py-2.5 px-4 text-center select-none relative z-50">
<div class="max-w-[1440px] mx-auto flex items-center justify-center gap-2 cursor-pointer group">
<p class="font-label-caps text-label-caps uppercase tracking-widest text-[11px] text-on-primary">
        WANT TO TURN HEADS? YOUR SIGNATURE SCENT STARTS HERE. DISCOVER THE COLLECTION AND LAYER WITHOUT LIMITS - <span class="underline decoration-1 underline-offset-4 group-hover:text-secondary-fixed transition-colors">SHOP NOW →</span>
</p>
</div>
</aside>
<!-- ========================================================= -->
<!-- 2. TOPBAR NAVIGATION (COMPONENTS_3 TopNavBar)             -->
<!-- ========================================================= -->
<header class="w-full bg-surface-container-lowest border-b border-outline-variant sticky top-0 z-40">
<div class="flex flex-col w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- Upper Utility & Brand Row -->
<div class="flex items-center justify-between py-4 border-b border-surface-container gap-4">
<!-- Search bar on left (as per JSON search_bar: "on_left") -->
<div class="w-72 lg:w-96 relative">
<div class="relative flex items-center">
<span class="absolute left-3 text-outline pointer-events-none flex items-center">
<span class="material-symbols-outlined text-[18px]">search</span>
</span>
<input class="w-full pl-9 pr-3 py-2 bg-surface-container-lowest border border-outline-variant text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:border-primary transition-colors rounded-none" placeholder="Search brand, product, category..." type="text"/>
</div>
</div>
<!-- Center Brand Logo -->
<div class="text-center">
<a class="font-display-hero text-headline-md tracking-widest uppercase font-bold text-primary block leading-none hover:opacity-85 transition-opacity" href="/">
            SEPHORA
          </a>
</div>
<!-- Trailing Actions Cluster -->
<div class="flex items-center space-x-6 text-on-surface">
<!-- Stores & Services -->
<a class="hidden xl:flex items-center gap-1.5 font-label-caps text-label-caps text-on-surface hover:text-secondary transition-colors cursor-pointer" href="/stores">
<span class="material-symbols-outlined text-[18px]">storefront</span>
<span>Stores &amp; Services</span>
</a>
<!-- Regional Selector -->
<div class="hidden md:flex items-center gap-1.5 font-label-caps text-label-caps text-on-surface cursor-pointer hover:text-secondary transition-colors">
<span class="material-symbols-outlined text-[18px]">flag</span>
<span>UAE | AED</span>
</div>
<!-- Account / Sign In (Active destination) -->
<a class="flex items-center gap-1 font-label-caps text-label-caps text-primary border-b border-primary pb-0.5 cursor-pointer" href="#">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">person</span>
<span class="font-bold">Sign In</span>
</a>
<!-- Wishlist -->
<a class="cursor-pointer text-on-surface hover:text-secondary transition-colors" href="/my-account/wishlist" title="Wishlist">
<span class="material-symbols-outlined text-[20px]">favorite</span>
</a>
<!-- Bag with Cart Counter -->
<a class="cursor-pointer text-on-surface hover:text-secondary transition-colors relative flex items-center" href="/cart" title="Shopping Bag">
<span class="material-symbols-outlined text-[22px]">shopping_bag</span>
<span class="absolute -top-1 -right-2 bg-primary text-on-primary font-label-tag text-label-tag w-4 h-4 flex items-center justify-center rounded-full leading-none" data-bag-count>@if(!empty($bagCount)){{ $bagCount }}@else 0 @endif</span></a>
</div>
</div>
<!-- Lower Category Nav Links Bar (JSON exact links) -->
<nav aria-label="Main Navigation" class="flex items-center justify-center space-x-8 py-3 overflow-x-auto text-center">
<a class="font-title-md text-title-md text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap cursor-pointer" href="/shop/fragrance">Fragrance</a>
<a class="font-title-md text-title-md text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap cursor-pointer" href="/shop/makeup">Makeup</a>
<a class="font-title-md text-title-md text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap cursor-pointer" href="/shop/skincare">Skincare</a>
<a class="font-title-md text-title-md text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap cursor-pointer" href="#">Haircare</a>
<a class="font-title-md text-title-md text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap flex items-center gap-1.5 cursor-pointer" href="#">
<span>Beauty Offers</span>
<span class="bg-secondary text-on-primary font-label-tag text-label-tag px-1.5 py-0.2 uppercase font-bold tracking-widest leading-normal">SALE</span>
</a>
<a class="font-title-md text-title-md text-on-surface-variant hover:text-primary tracking-wider transition-colors duration-150 whitespace-nowrap cursor-pointer" href="/brands">Brands</a>
</nav>
</div>
</header>
<!-- ========================================================= -->
<!-- 3. BREADCRUMBS                                            -->
<!-- ========================================================= -->
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin pt-6 pb-2">
<nav class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span>/</span>
<span class="text-primary font-bold">Sign In</span>
</nav>
</div>
<!-- ========================================================= -->
<!-- 4. PAGE HEADER & TITLE                                    -->
<!-- ========================================================= -->
<section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin text-center pt-6 pb-10">
<div class="inline-block mb-3">
<span class="font-label-caps text-label-caps uppercase tracking-[0.2em] text-outline border-b border-outline-variant pb-1">
        SEPHORA CLIENT CONCIERGE &amp; ACCESS
      </span>
</div>
<h1 class="font-headline-lg text-headline-lg lg:text-display-hero text-primary tracking-tight font-serif mb-4">
      Welcome Back
    </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto font-normal">
      Sign in using your email address and password to access your personalized beauty universe, track purchases, and redeem exclusive rewards.
    </p>
</section>
<!-- ========================================================= -->
<!-- 5. MAIN CONTENT - DUAL COLUMN SPLIT                      -->
<!-- ========================================================= -->
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin mb-space-xl">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
<!-- LEFT COLUMN: Client Sign In -->
<section class="lg:col-span-6 bg-surface-container-lowest p-8 md:p-12 border border-primary relative">
<div class="mb-8">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-1">
            Registered Member
          </span>
<h2 class="font-headline-md text-headline-md font-serif text-primary">
            Sign In to Your Account
          </h2>
<p class="font-body-md text-body-md text-outline mt-1">
            Enter your registered credentials to access your Beauty Pass dashboard.
          </p>
</div>
<form class="space-y-6" method="POST" action="{{ route('login.attempt') }}">
@csrf
@if(session('status'))<p class="text-secondary font-body-sm">{{ session('status') }}</p>@endif
@if(session('password_reset'))<p class="text-secondary font-body-sm mb-2">Your password has been updated. Please sign in.</p>@endif
@auth
<meta http-equiv="refresh" content="0;url={{ route('account.dashboard') }}"/>
@endauth
<!-- Email Input -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2" for="signin-email">
              Email Address <span class="text-secondary">*</span>
</label>
<div class="relative">
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant" id="signin-email" placeholder="name@domain.com" required="" type="email" name="email" value="{{ old('email') }}"/>
</div>
</div>
<!-- Password Input -->
<div>
<div class="flex items-center justify-between mb-2">
<label class="font-label-caps text-label-caps uppercase text-on-surface tracking-wider" for="signin-password">
                Password <span class="text-secondary">*</span>
</label>
<a class="font-label-caps text-label-caps text-outline hover:text-primary underline tracking-wider transition-colors" href="{{ route('password.request') }}">
                Forgot Password?
              </a>
</div>
<div class="relative">
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary focus:ring-0 rounded-none transition-all placeholder:text-outline-variant" id="signin-password" placeholder="••••••••••••" required="" type="password" name="password"/>
</div>
</div>
<!-- Checkbox Options -->
<div class="flex items-center justify-between pt-1">
<label class="flex items-center gap-3 cursor-pointer group select-none">
<input class="w-4 h-4 rounded-none border border-outline text-primary focus:ring-0 focus:ring-offset-0 cursor-pointer checked:bg-primary checked:border-primary" type="checkbox" name="remember" value="1" />
<span class="font-body-sm text-body-sm text-on-surface-variant group-hover:text-primary transition-colors">
                Remember my email on this device
              </span>
</label>
</div>
<!-- Primary Submit Button -->
@if ($errors->any())
    <div class="bg-error-container text-on-error-container px-4 py-3 font-body-sm space-y-1">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    @if (session('auth_error'))
    <div class="bg-error-container text-on-error-container px-4 py-3 font-body-sm">{{ session('auth_error') }}</div>
    @endif
<button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer" type="submit">
<span>SIGN IN</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</button>
</form>
<!-- Social Divider -->
<div class="relative my-8">
<div class="absolute inset-0 flex items-center">
<div class="w-full border-t border-outline-variant"></div>
</div>
<div class="relative flex justify-center text-center">
<span class="bg-surface-container-lowest px-4 font-label-caps text-label-caps uppercase tracking-wider text-outline">
              Or sign in with
            </span>
</div>
</div>
<!-- Social Buttons -->
<div class="grid grid-cols-2 gap-4">
<button class="h-12 border border-outline-variant hover:border-primary bg-surface-container-lowest flex items-center justify-center gap-2 font-label-caps text-label-caps text-primary uppercase tracking-wider transition-colors cursor-pointer" type="button">
<svg class="w-4 h-4 fill-current" viewbox="0 0 170 170">
<path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.75 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.35.13-9.16-1.9-14.42-6.08-3.69-3.04-7.67-7.79-11.93-14.25-5.87-8.91-10.45-19.16-13.73-30.74-3.28-11.59-4.92-22.39-4.92-32.41 0-14.34 3.73-26.31 11.19-35.91 7.46-9.6 16.71-14.54 27.75-14.81 4.79 0 10.37 1.34 16.76 4.02 6.39 2.68 10.34 4.09 11.86 4.23 1.94-.37 6.06-1.85 12.35-4.44 6.29-2.6 11.75-3.8 16.38-3.6 12.06.66 21.72 5.08 28.98 13.27-10.63 6.43-15.82 15.26-15.58 26.5.25 8.78 3.65 16.14 10.2 22.08 6.55 5.94 14.34 9.4 23.36 10.37-2.45 7.47-5.59 15.26-9.41 23.38zM119.22 31.81c0-7.39 2.64-14.29 7.92-20.7 5.28-6.41 11.83-10.36 19.65-11.85.25 1.01.37 2.08.37 3.22 0 7.23-2.77 14.25-8.31 21.05-5.54 6.8-12.06 10.74-19.56 11.82-.07-1.1-.07-2.28-.07-3.54z"></path>
</svg>
<span>Apple</span>
</button>
<button class="h-12 border border-outline-variant hover:border-primary bg-surface-container-lowest flex items-center justify-center gap-2 font-label-caps text-label-caps text-primary uppercase tracking-wider transition-colors cursor-pointer" type="button">
<svg class="w-4 h-4 fill-current" viewbox="0 0 24 24">
<path d="M12.24 10.285V13.4h6.887C18.2 16.038 15.56 18 12.24 18c-3.315 0-6-2.685-6-6s2.685-6 6-6c1.656 0 3.16.678 4.248 1.774l2.368-2.368C17.392 3.864 14.992 3 12.24 3 7.27 3 3.24 7.03 3.24 12s4.03 9 9 9c5.228 0 8.71-3.674 8.71-8.868 0-.61-.06-1.196-.16-1.847H12.24z"></path>
</svg>
<span>Google</span>
</button>
</div>
<p class="font-body-sm text-body-sm text-outline text-center mt-6">
          By signing in, you agree to Sephora Middle East's
          <a class="underline text-on-surface hover:text-secondary" href="/terms-and-conditions">Terms of Use</a> and
          <a class="underline text-on-surface hover:text-secondary" href="/terms-and-conditions">Privacy Policy</a>.
        </p>
<p class="font-body-sm text-body-sm text-outline text-center mt-3">
          New to Sephora?
<a class="text-primary font-bold underline" href="{{ route('register') }}">Create your account</a>
</p>
</section>
<!-- RIGHT COLUMN: Join MY SEPHORA (Card Vitrine Showcase) -->
<section class="lg:col-span-6 bg-surface-container-low p-8 md:p-12 border border-outline-variant flex flex-col justify-between h-full">
<div>
<!-- Header and Loyalty Badge -->
<div class="flex items-center justify-between border-b border-outline-variant pb-6 mb-8">
<div>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold block mb-1">
                New to Sephora?
              </span>
<h2 class="font-headline-md text-headline-md font-serif text-primary">
                Join MY SEPHORA
              </h2>
</div>
<span class="bg-primary text-tertiary-fixed-dim px-3 py-1 font-label-caps text-label-caps uppercase tracking-widest font-bold">
              VIP PRIVILEGES
            </span>
</div>
<!-- Luxury Beauty Pass Physical Card Vitrine using the provided reference Image -->
<div class="relative w-full mb-8 bg-surface-container p-4 border border-outline-variant group overflow-hidden">
<div class="relative aspect-[16/10] overflow-hidden bg-surface-container-highest">
<img alt="SEPHORA VIP Beauty Pass Black Tier card with opulent gold trim and metallic detailing" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('images/content/img_4c436417accfce85.jpg') }}"/>
</div>
<div class="mt-3 flex items-center justify-between font-label-tag text-label-tag uppercase tracking-widest text-outline">
<span>SEPHORA BEAUTY PASS CARD</span>
<span class="text-primary font-bold">BLACK &amp; GOLD TIERS</span>
</div>
</div>
<!-- Benefits List -->
<div class="space-y-6 mb-8">
<h3 class="font-title-lg text-title-lg text-primary tracking-wide">
              Unlock Exclusive Beauty Privileges
            </h3>
<!-- Benefit 1 -->
<div class="flex items-start gap-4">
<div class="w-8 h-8 rounded-none bg-primary text-on-primary flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-[18px]">verified</span>
</div>
<div>
<h4 class="font-title-md text-title-md text-primary font-bold">Personalize Your Experience</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                  Track orders in real-time, curate private wishlists, store delivery addresses, and enjoy seamless 1-click express checkout.
                </p>
</div>
</div>
<!-- Benefit 2 -->
<div class="flex items-start gap-4">
<div class="w-8 h-8 rounded-none bg-primary text-on-primary flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-[18px]">featured_seasonal_and_gifts</span>
</div>
<div>
<h4 class="font-title-md text-title-md text-primary font-bold">Tailored Beauty Curations</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                  Receive personalized skincare and fragrance routines, deluxe complimentary birthday gifts, and invite-only previews for luxury drops.
                </p>
</div>
</div>
<!-- Benefit 3 -->
<div class="flex items-start gap-4">
<div class="w-8 h-8 rounded-none bg-primary text-on-primary flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-[18px]">workspace_premium</span>
</div>
<div>
<h4 class="font-title-md text-title-md text-primary font-bold">MY SEPHORA Rewards Program</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                  Earn 1 Beauty Pass point for every 10 AED spent. Seamlessly upgrade to Black and Gold VIP status for bespoke perks and private boutique masterclasses.
                </p>
</div>
</div>
</div>
</div>
<!-- Call to Action -->
<div>
<a class="w-full h-12 bg-surface-container-lowest text-primary border border-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-primary hover:text-on-primary transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer mb-6" href="{{ route('register') }}">
<span>CREATE AN ACCOUNT</span>
<span class="transition-transform group-hover:translate-x-1">→</span>
</a>
<!-- Guest Order Lookup -->
<div class="pt-6 border-t border-outline-variant flex flex-col sm:flex-row items-center justify-between text-center sm:text-left gap-2">
<div>
<span class="font-label-caps text-label-caps uppercase text-on-surface font-bold block">Guest Checkout Lookup</span>
<p class="font-body-sm text-body-sm text-outline">Looking for an order placed without an account?</p>
</div>
<a class="font-label-caps text-label-caps uppercase tracking-wider text-primary hover:text-secondary underline whitespace-nowrap" href="#">
              Track Guest Order →
            </a>
</div>
</div>
</section>
</div>
</main>
<!-- ========================================================= -->
<!-- 6. TRUST & COMMITMENT BADGES                              -->
<!-- ========================================================= -->
<section class="w-full bg-surface-container-lowest border-y border-outline-variant py-8">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
<!-- Feature 1 -->
<div class="flex items-center gap-4">
<div class="w-12 h-12 border border-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-[24px]">local_shipping</span>
</div>
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">Free Delivery</h4>
<p class="font-body-sm text-body-sm text-outline">Complimentary on orders over 250 AED</p>
</div>
</div>
<!-- Feature 2 -->
<div class="flex items-center gap-4">
<div class="w-12 h-12 border border-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-[24px]">verified_user</span>
</div>
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">100% Authentic</h4>
<p class="font-body-sm text-body-sm text-outline">Direct from luxury world beauty brands</p>
</div>
</div>
<!-- Feature 3 -->
<div class="flex items-center gap-4">
<div class="w-12 h-12 border border-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-[24px]">swap_horiz</span>
</div>
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">Easy Returns</h4>
<p class="font-body-sm text-body-sm text-outline">Complimentary returns in any UAE store</p>
</div>
</div>
<!-- Feature 4 -->
<div class="flex items-center gap-4">
<div class="w-12 h-12 border border-primary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-[24px]">support_agent</span>
</div>
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider font-bold text-primary">Beauty Concierge</h4>
<p class="font-body-sm text-body-sm text-outline">Call Toll-Free 800 7374672</p>
</div>
</div>
</div>
</section>
<!-- ========================================================= -->
<!-- 7. NEWSLETTER SUBSCRIPTION VITRINE                        -->
<!-- ========================================================= -->
<section class="w-full bg-surface-container-low py-12 border-b border-outline-variant">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin flex flex-col md:flex-row items-center justify-between gap-6">
<div class="max-w-xl text-center md:text-left">
<h3 class="font-headline-sm text-headline-sm font-serif text-primary">
          Subscribe to the Sephora newsletter!
        </h3>
<p class="font-body-md text-body-md text-outline mt-1">
          Receive exclusive previews of prestige fragrance drops, private VIP sales, and masterclasses.
        </p>
</div>
<form class="w-full md:w-auto flex flex-col sm:flex-row gap-2 shrink-0 max-w-md" data-newsletter-form>
<input class="h-12 px-4 bg-surface-container-lowest border border-outline font-body-sm text-body-sm text-on-surface focus:border-primary rounded-none min-w-[260px]" placeholder="Enter your email" type="email"/>
<button class="h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all cursor-pointer" type="submit">
          SUBSCRIBE
        </button>
</form>
</div>
</section>
<!-- ========================================================= -->
<!-- 8. FOOTER (COMPONENTS_3 Footer verbatim instructions)      -->
<!-- ========================================================= -->
<footer class="w-full bg-primary text-on-primary border-t border-outline-variant dark:border-outline px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl">
<div class="max-w-[1440px] mx-auto">
<!-- Upper Section: Brand + Columns -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 pb-12 border-b border-surface-container-highest/20">
<!-- Col 1: Top Categories -->
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider text-on-primary mb-4 font-bold">Top Categories</h4>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">Fragrance For Her</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Niche Perfumes</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Face Foundations</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Hydrating Serums</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Hair Oils &amp; Masks</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/brands/sephora-collection">Sephora Collection</a></li>
</ul>
</div>
<!-- Col 2: Top Brands -->
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider text-on-primary mb-4 font-bold">Top Brands</h4>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">Huda Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Kayali</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Makeup by Mario</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Patrick Ta</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Sol De Janeiro</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Haus Labs</a></li>
</ul>
</div>
<!-- Col 3: My Sephora -->
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider text-on-primary mb-4 font-bold">My Sephora</h4>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="text-on-primary font-bold underline" href="/my-account">Beauty Pass Program</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">VIP Gold Privileges</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/sign-in">Sign In / Register</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Order Status</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">My Favorites List</a></li>
</ul>
</div>
<!-- Col 4: Help & FAQs (JSON links) -->
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider text-on-primary mb-4 font-bold">Customer Service</h4>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">Customer Service</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Track Order</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Delivery &amp; Returns</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Store Locator</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Book a Beauty Service</a></li>
</ul>
</div>
<!-- Col 5: Legal & Policy -->
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider text-on-primary mb-4 font-bold">About Sephora</h4>
<ul class="space-y-2.5 font-body-sm text-body-sm text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">The Sephora Heritage</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Careers at Sephora</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Terms &amp; Conditions</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Privacy Policy</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Cookie Preferences</a></li>
</ul>
</div>
<!-- Col 6: Region & Social -->
<div>
<h4 class="font-title-md text-title-md uppercase tracking-wider text-on-primary mb-4 font-bold">Region &amp; Country</h4>
<div class="mb-4">
<p class="font-label-caps text-label-caps text-on-primary uppercase">United Arab Emirates</p>
<p class="font-body-sm text-body-sm text-on-primary-container mt-1">AED Currency - English</p>
</div>
<div class="pt-2">
<span class="font-label-caps text-label-caps uppercase text-on-primary block mb-2">Connect With Us</span>
<div class="flex items-center space-x-3 text-on-primary-container">
<a class="hover:text-on-primary transition-colors" href="#" title="Instagram">
<span class="material-symbols-outlined text-[20px]">photo_camera</span>
</a>
<a class="hover:text-on-primary transition-colors" href="#" title="YouTube">
<span class="material-symbols-outlined text-[20px]">smart_display</span>
</a>
<a class="hover:text-on-primary transition-colors" href="#" title="Boutiques">
<span class="material-symbols-outlined text-[20px]">location_on</span>
</a>
</div>
</div>
</div>
</div>
<!-- Lower Section: Badges & Exact Copyright from JSON -->
<div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
<!-- Logo Stamp -->
<div>
<span class="font-display-hero text-headline-sm uppercase tracking-widest text-on-primary font-bold">
            SEPHORA
          </span>
<p class="font-body-sm text-body-sm text-on-primary-container mt-1">
            © 2024 SEPHORA Middle East. All Rights Reserved. Pure Luxury &amp; Authentic Beauty.
          </p>
</div>
<!-- Accepted Payment Methods -->
<div class="flex flex-wrap items-center justify-center gap-3">
<span class="border border-surface-container-highest/30 px-2.5 py-1 font-label-tag text-label-tag text-on-primary uppercase tracking-widest">VISA</span>
<span class="border border-surface-container-highest/30 px-2.5 py-1 font-label-tag text-label-tag text-on-primary uppercase tracking-widest">MASTERCARD</span>
<span class="border border-surface-container-highest/30 px-2.5 py-1 font-label-tag text-label-tag text-on-primary uppercase tracking-widest">APPLE PAY</span>
<span class="border border-surface-container-highest/30 px-2.5 py-1 font-label-tag text-label-tag text-on-primary uppercase tracking-widest">TABBY</span>
<span class="border border-surface-container-highest/30 px-2.5 py-1 font-label-tag text-label-tag text-on-primary uppercase tracking-widest">TAMARA</span>
</div>
</div>
</div>
</footer>
@endsection
