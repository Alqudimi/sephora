@extends('layouts.app')

@section('title', 'Gift Cards At Sephora | Sephora UAE Official Online Store')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md min-h-screen flex flex-col selection:bg-primary selection:text-on-primary')

@section('head')
@endsection

@section('content')
<!-- MAIN CANVAS -->
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-md md:py-space-lg">
<!-- 3. BREADCRUMB -->
<nav class="flex items-center space-x-2 font-label-caps text-label-caps text-on-surface-variant mb-6 uppercase tracking-widest">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-bold">Gift Cards At Sephora</span>
</nav>
<!-- 4. HERO HEADER & INTRO -->
<div class="text-center max-w-3xl mx-auto pt-2 pb-8">
<div class="inline-flex items-center gap-2 border border-primary px-3.5 py-1 mb-4">
<span class="material-symbols-outlined text-[14px] text-primary">card_giftcard</span>
<span class="font-label-caps text-label-caps tracking-widest uppercase font-bold text-primary">GIFT SOMETHING BEAUTIFUL</span>
</div>
<h1 class="font-headline-lg text-headline-lg md:text-display-hero text-primary tracking-tight font-bold mb-4 uppercase">
        GIFT CARDS AT SEPHORA
      </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl mx-auto font-light">
        The ultimate passport to beauty luxury. Perfect for birthdays, celebrations, or an effortless prestige indulgence.
      </p>
<!-- Announcement Callout Box -->
<div class="mt-8 bg-surface-container-lowest border-2 border-primary p-4 md:p-5 flex items-center justify-center gap-3 text-left">
<span class="material-symbols-outlined text-secondary text-[24px] flex-shrink-0">verified</span>
<p class="font-body-md text-body-md font-medium text-on-surface">
<strong class="font-bold text-primary">You asked, We listened</strong> — Gift Cards bought in Sephora stores can now be redeemed online at the checkout step!
        </p>
</div>
</div>
<!-- 5. DUAL SHOWCASE / FEATURED HERO BANNER -->
<section class="grid grid-cols-1 lg:grid-cols-12 gap-gutter my-space-lg items-stretch">
<!-- Left: Iconic Striped Sephora Gift Card Presentation -->
<div class="lg:col-span-7 bg-surface-container-lowest border border-primary overflow-hidden flex flex-col justify-between group">
<div class="relative overflow-hidden bg-primary aspect-[16/9]">
<img alt="Sephora Gift Card luxury black and white striped shopping card on marble podium" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 ease-out" src="{{ asset('images/content/img_b1cfece087ddc206.jpg') }}"/>
<div class="absolute top-4 left-4 bg-primary text-on-primary font-label-tag text-label-tag px-3 py-1 uppercase tracking-widest">
            OFFICIAL GIFT CARD
          </div>
</div>
<div class="p-6 md:p-8 border-t border-outline-variant bg-surface-container-lowest">
<h2 class="font-headline-sm text-headline-sm text-primary mb-2">The Quintessential Beauty Gesture</h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
            Available in any custom amount from AED 100 to AED 5,000. Valid across hundreds of coveted international brands in makeup, skincare, and bespoke niche fragrance.
          </p>
<div class="flex flex-wrap items-center gap-4">
<a class="inline-flex items-center justify-center h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all duration-200" href="#balance-module">
              CHECK CARD BALANCE
            </a>
<a class="inline-flex items-center justify-center h-12 px-6 bg-transparent text-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-primary hover:text-on-primary transition-all duration-200" href="#stores">
              FIND A STORE
            </a>
</div>
</div>
</div>
<!-- Right: Physical & Digital Experience & 3 Pillars -->
<div class="lg:col-span-5 flex flex-col justify-between space-y-gutter">
<div class="bg-surface-container-lowest border border-outline-variant overflow-hidden group">
<div class="relative aspect-[16/9] overflow-hidden">
<img alt="Sephora luxury gift packaging envelope with gold ribbons" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 ease-out" src="{{ asset('images/content/img_394b44c9b6270c9c.jpg') }}"/>
<div class="absolute bottom-3 left-3 bg-surface-container-lowest/90 backdrop-blur-none px-3 py-1 font-label-caps text-label-caps text-primary border border-primary">
              IN-STORE &amp; DIGITAL COMPATIBLE
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
<h3 class="font-title-lg text-title-lg text-primary uppercase tracking-wide">Buy a Gift Card</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Pick one up at any Sephora store near you and top it up!</p>
</div>
</div>
<div class="h-[1px] bg-surface-container w-full"></div>
<div class="flex items-start gap-4">
<div class="w-10 h-10 flex-shrink-0 bg-primary text-on-primary flex items-center justify-center font-bold">
              2
            </div>
<div>
<h3 class="font-title-lg text-title-lg text-primary uppercase tracking-wide">Give the Gift of Beauty</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Share it with someone special for any occasion or just because.</p>
</div>
</div>
<div class="h-[1px] bg-surface-container w-full"></div>
<div class="flex items-start gap-4">
<div class="w-10 h-10 flex-shrink-0 bg-primary text-on-primary flex items-center justify-center font-bold">
              3
            </div>
<div>
<h3 class="font-title-lg text-title-lg text-primary uppercase tracking-wide">Redeem Online or In-Store</h3>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Use the card at checkout on the app or website or at your favourite store - simple and instant.</p>
</div>
</div>
</div>
</div>
</section>
<!-- 6. INTERACTIVE BALANCE CHECKER MODULE -->
<section class="my-space-xl bg-surface-container-lowest border-2 border-primary p-6 md:p-12 relative overflow-hidden" id="balance-module">
<div class="max-w-3xl mx-auto">
<div class="text-center mb-8">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-bold mb-1 block">INSTANT VERIFICATION</span>
<h2 class="font-headline-lg text-headline-lg text-primary font-bold uppercase mb-2">Check Your Gift Card Balance</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">
            Have a gift card? Check your gift card balance here instantly and enjoy your shopping!
          </p>
</div>
<form class="space-y-6" id="balance-form" onsubmit="event.preventDefault(); simulateBalanceCheck();">
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
<!-- 16-digit card number input -->
<div class="md:col-span-2">
<label class="block font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant mb-2" for="card-number">
                16-Digit Card Number <span class="text-secondary">*</span>
</label>
<div class="relative">
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 font-mono text-title-md text-primary tracking-widest placeholder:text-outline-variant transition-colors" id="card-number" maxlength="19" placeholder="6036 1234 5678 9012" required="" type="text"/>
<span class="absolute right-3.5 top-3 text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]">credit_card</span>
</span>
</div>
<p class="font-body-sm text-body-sm text-outline mt-1.5">Found on the reverse side of your physical card or in your e-voucher email.</p>
</div>
<!-- 4-digit PIN -->
<div class="md:col-span-1">
<label class="block font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant mb-2" for="card-pin">
                4-Digit PIN <span class="text-secondary">*</span>
</label>
<div class="relative">
<input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 font-mono text-title-md text-primary tracking-widest placeholder:text-outline-variant transition-colors" id="card-pin" maxlength="4" placeholder="••••" required="" type="password"/>
<span class="absolute right-3.5 top-3 text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]">lock</span>
</span>
</div>
<p class="font-body-sm text-body-sm text-outline mt-1.5">Scratch gently to reveal.</p>
</div>
</div>
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-surface-container">
<button class="w-full sm:w-auto h-12 px-10 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all duration-200 cursor-pointer flex items-center justify-center gap-2" type="submit">
<span>CHECK YOUR BALANCE</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</button>
<a class="font-label-caps text-label-caps text-primary hover:text-secondary underline tracking-widest uppercase flex items-center gap-1.5" href="/" id="stores">
<span class="material-symbols-outlined text-[16px]">storefront</span>
<span>Find a Store to Purchase</span>
</a>
</div>
<!-- Result Simulation Box (Hidden by default) -->
<div class="hidden p-5 bg-surface border border-primary mt-4" id="balance-result">
<div class="flex items-center justify-between">
<div>
<span class="font-label-tag text-label-tag uppercase tracking-widest text-outline">CURRENT CARD BALANCE</span>
<div class="font-price-aed-lg text-display-hero-mobile text-primary font-bold mt-1" id="balance-value">AED —</div>
<div class="font-body-sm text-body-sm text-on-surface-variant mt-1" id="balance-meta">Enter your 16-digit card number above.</div>
</div>
<a class="h-10 px-6 bg-secondary text-on-secondary font-label-caps text-label-caps uppercase tracking-widest flex items-center hover:opacity-90" href="/shop/bestsellers">
                SHOP NOW
              </a>
</div>
</div>
</form>
</div>
</section>
<!-- 7. HOW TO USE & REDEEM STEPS (Visual 3-Step Guide) -->
<section class="my-space-xl">
<div class="text-center mb-10">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-outline font-bold">SIMPLE &amp; INSTANT</span>
<h2 class="font-headline-lg text-headline-lg text-primary uppercase font-bold mt-1">How Sephora Gift Cards Work</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Step 1 -->
<div class="bg-surface-container-lowest border border-outline-variant p-8 flex flex-col justify-between hover:border-primary transition-colors">
<div>
<div class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center font-headline-sm text-headline-sm font-bold mb-6">
              01
            </div>
<h3 class="font-title-lg text-title-lg text-primary uppercase mb-3">Choose Your Amount</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              Select any denomination starting from 100 AED up to 5,000 AED. Custom amounts are available at cash desks in any Sephora store across the United Arab Emirates.
            </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps uppercase">
<span class="material-symbols-outlined text-[18px]">payments</span>
<span>Flexible top-up values</span>
</div>
</div>
<!-- Step 2 -->
<div class="bg-surface-container-lowest border border-outline-variant p-8 flex flex-col justify-between hover:border-primary transition-colors">
<div>
<div class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center font-headline-sm text-headline-sm font-bold mb-6">
              02
            </div>
<h3 class="font-title-lg text-title-lg text-primary uppercase mb-3">Select In-Store or Digital</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              Opt for the signature monochrome striped physical card enclosed in a luxurious keepsake envelope, or dispatch an instant e-gift voucher straight to their phone or inbox.
            </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps uppercase">
<span class="material-symbols-outlined text-[18px]">mail</span>
<span>Instant delivery or physical gift</span>
</div>
</div>
<!-- Step 3 -->
<div class="bg-surface-container-lowest border border-outline-variant p-8 flex flex-col justify-between hover:border-primary transition-colors">
<div>
<div class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center font-headline-sm text-headline-sm font-bold mb-6">
              03
            </div>
<h3 class="font-title-lg text-title-lg text-primary uppercase mb-3">Seamless Checkout</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              Redeem in seconds! Apply the 16-digit card code during online checkout on Sephora.me or the Sephora UAE App, or present the barcode to the beauty advisor at store payment terminals.
            </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps uppercase">
<span class="material-symbols-outlined text-[18px]">shopping_bag</span>
<span>Online &amp; in-store redemption</span>
</div>
</div>
</div>
</section>
<!-- 8. EXPANDABLE FREQUENTLY ASKED QUESTIONS (FAQ Accordion) -->
<section class="my-space-xl max-w-4xl mx-auto">
<div class="border-b border-primary pb-4 mb-8 flex items-baseline justify-between">
<div>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-outline">ASSISTANCE &amp; POLICY</span>
<h2 class="font-headline-lg text-headline-lg text-primary uppercase font-bold mt-1">Frequently Asked Questions</h2>
</div>
<span class="font-label-caps text-label-caps text-on-surface-variant hidden sm:inline">12 TOPICS</span>
</div>
<div class="divide-y divide-outline-variant border-y border-outline-variant">
<!-- FAQ Item 1 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              I’ve received a gift card: What are the terms and conditions?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            Sephora Gift Cards issued in the UAE are valid for 12 months from the date of issuance or activation. They can be redeemed for merchandise across all official Sephora standalone stores within the UAE, as well as on Sephora.me and the mobile app. Gift Cards cannot be refunded or exchanged for cash.
          </div>
</details>
<!-- FAQ Item 2 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              How do I check my gift card’s balance and its validity period?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            You can verify your current balance and expiration date directly using our interactive Balance Checker tool above, at the checkout page by entering your 16-digit card code, or by asking any Sephora Beauty Advisor at our cash desks in-store.
          </div>
</details>
<!-- FAQ Item 3 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              How do I use my gift card online/in store?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
<strong>Online:</strong> During Step 3 (Payment) of checkout, select "Sephora Gift Card", type in your 16-digit card number and 4-digit PIN, then click "Apply". If the purchase amount exceeds your card balance, you can pay the remainder via Credit Card, Apple Pay, or Tabby.<br/>
<strong>In-Store:</strong> Simply show your physical gift card or digital barcode email/SMS to the Beauty Advisor at the cash desk before finalizing payment.
          </div>
</details>
<!-- FAQ Item 4 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              Will I earn beauty pass points with my Sephora gift card?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            Yes! When you redeem your Gift Card to purchase beauty products, you will accumulate Beauty Pass points on the dirham value of your purchase according to your membership tier (White, Black, or Gold). Points are not awarded at the initial moment of purchasing or topping up the gift card itself.
          </div>
</details>
<!-- FAQ Item 5 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              Returns and Refunds
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            Products purchased using a Sephora Gift Card follow our standard 14-day return policy. If eligible for a return in unused condition with receipt, the refunded amount will be re-credited to an electronic merchandise credit card or replacement gift card. Cash refunds are strictly prohibited.
          </div>
</details>
<!-- FAQ Item 6 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              How do I get a Sephora gift card?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            You can purchase physical gift cards at any Sephora store located in Dubai Mall, Mall of the Emirates, Yas Mall, Galleria Mall Abu Dhabi, and all other UAE locations. Digital e-gift cards can also be purchased through selected corporate partnership channels.
          </div>
</details>
<!-- FAQ Item 7 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              My Sephora gift card was lost, stolen, or damaged what should I do?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            Please treat your gift card like cash. Sephora is not responsible for lost or stolen cards. However, if your card is damaged and the 16-digit card number alongside original purchase receipt is legible, our Customer Care team or store managers may assist in transferring remaining verified balances to a replacement card.
          </div>
</details>
<!-- FAQ Item 8 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              Can I offer a beauty service as a gift?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            Yes! You can load a gift card with the exact amount required for Benefit Brow Bar waxing, Sephora Beauty Studio makeovers, or express skin treatments, allowing your recipient to book and pay for their desired atelier service.
          </div>
</details>
<!-- FAQ Item 9 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              Can I pay a beauty service with a gift card?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            Absolutely. Sephora Gift Cards can be applied toward both product purchases and in-store Beauty Hub services across all participating Sephora UAE boutiques.
          </div>
</details>
<!-- FAQ Item 10 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              Can I extend the validity of my gift card?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            Under UAE retail regulations, cards maintain an active lifespan of 365 calendar days from the date of activation. Extensions cannot be processed once the card has officially expired, so we recommend enjoying your beauty shopping well before the expiry period.
          </div>
</details>
<!-- FAQ Item 11 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              Can I top up my gift card?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            Yes! You can top up an existing active Sephora physical gift card at any store checkout counter across the UAE. Digital e-gift vouchers cannot be topped up and are single-lifecycle codes.
          </div>
</details>
<!-- FAQ Item 12 -->
<details class="group py-5 cursor-pointer">
<summary class="flex items-center justify-between list-none">
<h3 class="font-title-lg text-title-lg text-primary font-semibold pr-4">
              I’m having issues with using my gift card, who can help?
            </h3>
<span class="material-symbols-outlined text-[22px] text-primary transition-transform duration-200 group-open:rotate-180">
              expand_more
            </span>
</summary>
<div class="mt-4 font-body-md text-body-md text-on-surface-variant leading-relaxed pl-1">
            Our dedicated Sephora UAE Concierge is at your disposal. You can call us toll-free at <strong>800 SEPHORA (800 7374672)</strong> from 9:00 AM to 9:00 PM daily, or initiate a live chat session via our mobile app for immediate validation assistance.
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
<h4 class="font-title-md text-title-md text-primary uppercase font-bold">Free Delivery</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">On all orders over 250 AED</p>
</div>
<!-- 2 -->
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">verified</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold">100% Authentic</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Direct from luxury ateliers</p>
</div>
<!-- 3 -->
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">sync</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold">Easy Returns</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">In any UAE Sephora store</p>
</div>
<!-- 4 -->
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">stars</span>
<h4 class="font-title-md text-title-md text-primary uppercase font-bold">Beauty Pass Points</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Earn points on every dirham spent</p>
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
        body: JSON.stringify({ card_number: cardNum }),
      })
      .then(r => r.json())
      .then(res => {
        resultBox.classList.remove('hidden');
        const digits = cardNum.replace(/\D/g, '');
        if (res.valid) {
          balanceValue.textContent = 'AED ' + res.balance;
          balanceMeta.textContent = 'Card # ' + digits.slice(0,4) + ' \u2022\u2022\u2022\u2022 \u2022\u2022\u2022\u2022 ' + digits.slice(-4) + ' | ' + res.message;
        } else {
          balanceValue.textContent = '\u2014';
          balanceMeta.textContent = res.message;
        }
        resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      })
      .catch(() => window.sephoraToast('Network error', 'error'));
    }
  </script>
@endsection

@push('scripts')
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

    // Interactive Balance Check Simulation
    function simulateBalanceCheck() {
      const cardNum = document.getElementById('card-number').value;
      const cardPin = document.getElementById('card-pin').value;
      const resultBox = document.getElementById('balance-result');
      
      if (cardNum && cardPin) {
        resultBox.classList.remove('hidden');
        resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    }
</script>
@endpush