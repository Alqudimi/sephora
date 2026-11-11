@extends('layouts.app')

@section('title', 'Frequently Asked Questions | SEPHORA Middle East')
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
            SEPHORA CLIENT CONCIERGE &amp; SUPPORT
          </span>
<h1 class="font-headline-lg text-headline-lg md:text-display-hero text-primary tracking-tight font-bold mb-4">{{ __('ui.faq') }}</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
            Find answers to all your beauty shopping, order tracking, Beauty Pass, and customer service inquiries. Experience seamless luxury support across the United Arab Emirates.
          </p>
</div>
<!-- Search FAQ Input Box -->
<div class="mt-8 max-w-3xl">
<div class="relative flex items-stretch border-2 border-primary bg-surface-container-lowest">
<span class="material-symbols-outlined self-center ml-4 text-outline text-[24px]">search</span>
<input class="w-full bg-transparent border-0 px-4 py-4 text-on-surface font-body-md text-body-md focus:ring-0 placeholder:text-outline" id="faqSearchInput" placeholder="How can we help you today? Type keywords like delivery, refund, beauty pass..." type="text"/>
<button class="bg-primary hover:bg-neutral-800 text-on-primary px-8 font-label-caps text-label-caps tracking-widest uppercase transition-colors flex items-center justify-center">{{ __('ui.search') }}</button>
</div>
<div class="flex flex-wrap gap-2 mt-3 items-center">
<span class="font-label-caps text-label-caps text-outline uppercase">Quick Queries:</span>
<button class="text-on-surface hover:text-primary border border-outline-variant px-2.5 py-0.5 font-label-tag text-label-tag bg-surface-container-low transition-colors">Order Tracking</button>
<button class="text-on-surface hover:text-primary border border-outline-variant px-2.5 py-0.5 font-label-tag text-label-tag bg-surface-container-low transition-colors">{{ __('ui.beauty_pass_points') }}</button>
<button class="text-on-surface hover:text-primary border border-outline-variant px-2.5 py-0.5 font-label-tag text-label-tag bg-surface-container-low transition-colors">Tabby &amp; Tamara</button>
<button class="text-on-surface hover:text-primary border border-outline-variant px-2.5 py-0.5 font-label-tag text-label-tag bg-surface-container-low transition-colors">Store Returns</button>
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
<span class="font-label-caps text-label-caps text-outline uppercase tracking-widest block">Explore Topics</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase font-bold tracking-wider">
              Browse by Category
            </h2>
</div>
<span class="font-label-caps text-label-caps text-outline uppercase">13 Essential Categories</span>
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
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">MY SEPHORA</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">Beauty Pass, points, tier perks &amp; rewards</p>
</div>
</a>
<!-- Category 2: Stores -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#stores">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">storefront</span>
<span class="font-label-tag text-label-tag text-outline">02</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">Stores</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">UAE boutique locations, Mall hours &amp; events</p>
</div>
</a>
<!-- Category 3: Services -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#services">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">auto_awesome</span>
<span class="font-label-tag text-label-tag text-outline">03</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">Services</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">Brow bar appointments, skin diagnostics &amp; makeup</p>
</div>
</a>
<!-- Category 4: Online Account -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#online-account">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">manage_accounts</span>
<span class="font-label-tag text-label-tag text-outline">04</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">Online Account</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">Login, password recovery &amp; address book</p>
</div>
</a>
<!-- Category 5: Online Shopping -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#online-shopping">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">shopping_cart</span>
<span class="font-label-tag text-label-tag text-outline">05</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">Online Shopping</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">Placing orders, bag management &amp; stock alerts</p>
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
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">100% authenticity, formulas &amp; shade matching</p>
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
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">Apple Pay, Tabby, Tamara &amp; Cash on Delivery</p>
</div>
</a>
<!-- Category 8: Offers, Samples & Gifts -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#offers-samples">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">redeem</span>
<span class="font-label-tag text-label-tag text-outline">08</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">Offers, Samples &amp; Gifts</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">Promo codes, deluxe miniatures &amp; GWP thresholds</p>
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
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">UAE same-day &amp; 1-2 day express shipping</p>
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
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">14-day store &amp; online returns, refund timelines</p>
</div>
</a>
<!-- Category 11: Health & Safety -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#health-safety">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">sanitizer</span>
<span class="font-label-tag text-label-tag text-outline">11</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">Health &amp; Safety</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">Clean beauty certifications &amp; store sanitation</p>
</div>
</a>
<!-- Category 12: Corporate Information -->
<a class="group bg-surface-container-lowest border border-outline-variant p-5 hover:border-primary transition-all duration-200 flex flex-col justify-between h-44" href="#corporate-information">
<div class="flex items-start justify-between">
<span class="material-symbols-outlined text-primary text-[28px] group-hover:scale-105 transition-transform">corporate_fare</span>
<span class="font-label-tag text-label-tag text-outline">12</span>
</div>
<div>
<h3 class="font-title-md text-title-md text-primary font-bold group-hover:underline">Corporate Information</h3>
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">Sephora Middle East careers, PR &amp; legal governance</p>
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
<p class="font-body-sm text-body-sm text-outline mt-1 line-clamp-2">Check balance, online activation &amp; e-cards</p>
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
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest block font-bold">Frequently Consulted</span>
<h2 class="font-headline-sm text-headline-sm text-primary uppercase font-bold tracking-wider">
              Top Questions
            </h2>
</div>
<span class="font-label-caps text-label-caps text-outline uppercase hidden sm:inline">Official Answers &amp; Solutions</span>
</div>
<!-- Accordion Container -->
<div class="space-y-4 max-w-4xl" id="accordionContainer">
<!-- Accordion Item 1 (DEFAULT OPEN) -->
<div class="border border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>I think points may be missing on my account. What should I do?</span>
<span class="material-symbols-outlined text-primary transition-transform duration-200 shrink-0 transform rotate-180">expand_more</span>
</button>
<div class="px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p class="mb-3">
                Points from in-store purchases typically update within 24 to 48 hours, while online purchase points are credited immediately upon dispatch of your parcel. If your points have not reflected after this timeframe, please verify that your Beauty Pass card number is accurately linked to your online profile under Account Settings.
              </p>
<div class="bg-surface-container-low p-4 border border-outline-variant flex flex-col sm:flex-row sm:items-center justify-between gap-4">
<div>
<span class="font-label-caps text-label-caps text-outline uppercase block">Need manual verification?</span>
<p class="text-primary font-bold text-body-md">Email us at: <span class="font-mono text-secondary">customercare@sephora.ae</span></p>
</div>
<div class="flex items-center gap-3">
<button class="border border-primary bg-surface-container-lowest hover:bg-primary hover:text-on-primary text-primary px-4 py-2 font-label-caps text-label-caps tracking-widest uppercase transition-colors" onclick="copyToClipboard('customercare@sephora.ae')">
                    COPY
                  </button>
<a class="bg-primary text-on-primary hover:bg-neutral-800 px-5 py-2 font-label-caps text-label-caps tracking-widest uppercase transition-colors" href="#contact-section">
                    WRITE TO US
                  </a>
</div>
</div>
</div>
</div>
<!-- Accordion Item 2 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>How do I track my order delivery in UAE?</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                Once your order departs our Dubai fulfillment hub, you will receive an automated SMS and email containing your carrier tracking code (via Aramex or Fetchr). Deliveries within Dubai and Abu Dhabi arrive within 1-2 business days. You can also monitor real-time tracking by visiting your <strong>Online Account &gt; Order History</strong>.
              </p>
</div>
</div>
<!-- Accordion Item 3 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>Can I return an item purchased online at a Sephora store in UAE?</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                Yes! Any item purchased online at sephora.me can be returned within <strong>14 calendar days</strong> of receipt at any official Sephora boutique in the United Arab Emirates (including The Dubai Mall, Mall of the Emirates, Yas Mall, and Galleria Al Maryah). Items must be in their original packaging, unopened, unused, and accompanied by the digital e-invoice or printed delivery note.
              </p>
</div>
</div>
<!-- Accordion Item 4 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>How does Tabby and Tamara split in 4 work at checkout?</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                Both Tabby and Tamara allow you to split your purchase amount into 4 equal interest-free monthly installments. At checkout, select either Tabby or Tamara as your payment provider. You will pay 25% today upon checkout confirmation, and the remaining 3 installments will be charged automatically every 30 days. No hidden fees or interest apply if paid on schedule. Valid for UAE residents with a valid Emirates ID.
              </p>
</div>
</div>
<!-- Accordion Item 5 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>How do I book an in-store beauty or brow service?</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                You can book an appointment at the Benefit BrowBar, receive a customized 45-minute Full Glam Makeover, or book a Complimentary 15-minute Skin Consultation via the <strong>{{ __('ui.stores_services') }}</strong> tab in our header menu, or by contacting your preferred Sephora boutique directly via phone. Beauty Pass Gold members receive complimentary priority bookings.
              </p>
</div>
</div>
<!-- Accordion Item 6 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>What should I do if my promo code or free gift is not applying?</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                Ensure that your basket meets the qualifying spend threshold (typically minimum 250 AED or higher for deluxe gifts with purchase). Check for brand exclusions: some prestige houses and already discounted holiday sets are exempt from sitewide percentage promo codes. Remember that promotional codes are case-sensitive and only one code may be applied per transaction.
              </p>
</div>
</div>
<!-- Accordion Item 7 -->
<div class="border border-outline-variant hover:border-primary bg-surface-container-lowest transition-all">
<button class="w-full py-5 px-6 text-left flex items-center justify-between gap-4 font-title-lg text-title-lg text-primary font-bold focus:outline-none" onclick="toggleAccordion(this)" type="button">
<span>How do I check my Sephora Gift Card balance and validity?</span>
<span class="material-symbols-outlined text-outline transition-transform duration-200 shrink-0">expand_more</span>
</button>
<div class="hidden px-6 pb-6 pt-0 border-t border-surface-container text-on-surface-variant font-body-md text-body-md leading-relaxed">
<p>
                Sephora UAE gift cards remain valid for 1 full calendar year from the date of issue. You can verify your live balance at any Sephora cash register in the UAE or directly online by entering your 16-digit card number and security PIN in the Gift Card module under Checkout &gt; Payment Methods.
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
                LIVE CONCIERGE SUPPORT
              </span>
<h2 class="font-headline-md text-headline-md text-primary font-bold uppercase mb-2">
                Still need assistance? We are here to help.
              </h2>
<p class="font-body-md text-body-md text-on-surface-variant">
                Our client service advisors are dedicated to ensuring your Sephora experience is exceptional.
              </p>
<div class="flex items-center gap-2 mt-4 text-primary">
<span class="material-symbols-outlined text-[20px] text-secondary">schedule</span>
<span class="font-label-caps text-label-caps tracking-wider uppercase font-bold">
                  Call us between 10:00 am - 10:00 pm (GST) Daily
                </span>
</div>
</div>
<!-- Email & Direct Actions -->
<div class="bg-surface-container p-6 border border-outline-variant flex flex-col justify-between max-w-md w-full">
<span class="font-label-caps text-label-caps text-outline uppercase block mb-1">Email us at</span>
<a class="font-title-lg text-title-lg text-primary font-bold hover:text-secondary mb-4 break-all" href="mailto:customercare@sephora.ae">
                customercare@sephora.ae
              </a>
<div class="flex items-center gap-3">
<button class="flex-1 border border-primary bg-surface-container-lowest hover:bg-primary hover:text-on-primary text-primary py-2.5 px-4 font-label-caps text-label-caps tracking-widest uppercase transition-colors" onclick="copyToClipboard('customercare@sephora.ae')">
                  COPY
                </button>
<a class="flex-1 text-center bg-primary hover:bg-neutral-800 text-on-primary py-2.5 px-4 font-label-caps text-label-caps tracking-widest uppercase transition-colors" href="/">
                  WRITE TO US
                </a>
</div>
</div>
</div>
<!-- Regional Call Center Numbers Grid -->
<div class="pt-10">
<h3 class="font-title-lg text-title-lg text-primary uppercase font-bold tracking-wider mb-6">
              Contact Numbers Across Middle East
            </h3>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
<!-- UAE -->
<div class="border-l-2 border-primary pl-4 py-1">
<span class="font-label-caps text-label-caps text-outline block uppercase">United Arab Emirates</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:8007374672">
                  8007374672
                </a>
<span class="font-label-tag text-[9px] text-secondary font-bold uppercase tracking-wider">TOLL FREE</span>
</div>
<!-- Saudi Arabia -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">Saudi Arabia</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+966114797382">
                  +966 11 479 7382
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">INTERNATIONAL</span>
</div>
<!-- Kuwait -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">Kuwait</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+96522208178">
                  +965 2220 8178
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">DIRECT LINE</span>
</div>
<!-- Bahrain -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">Bahrain</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+97316639148">
                  +973 1663 9148
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">DIRECT LINE</span>
</div>
<!-- Oman -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">Oman</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+96821030711">
                  +968 2103 0711
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">DIRECT LINE</span>
</div>
<!-- Qatar -->
<div class="border-l-2 border-outline-variant pl-4 py-1 hover:border-primary transition-colors">
<span class="font-label-caps text-label-caps text-outline block uppercase">Qatar</span>
<a class="font-price-aed-md text-price-aed-md text-primary font-bold block mt-1 hover:text-secondary" href="tel:+97444196648">
                  +974 4419 6648
                </a>
<span class="font-label-tag text-[9px] text-outline uppercase tracking-wider">DIRECT LINE</span>
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
<p class="font-body-sm text-body-sm text-outline">Over 250 AED</p>
</div>
<div class="flex flex-col items-center justify-center p-3 pt-6 md:pt-3">
<span class="material-symbols-outlined text-primary text-[32px] mb-2">verified_user</span>
<h4 class="font-title-md text-title-md text-primary font-bold uppercase">{{ __('ui.secure_payment') }}</h4>
<p class="font-body-sm text-body-sm text-outline">100% Encrypted Transactions</p>
</div>
<div class="flex flex-col items-center justify-center p-3 pt-6 md:pt-3">
<span class="material-symbols-outlined text-primary text-[32px] mb-2">replay</span>
<h4 class="font-title-md text-title-md text-primary font-bold uppercase">{{ __('ui.easy_returns') }}</h4>
<p class="font-body-sm text-body-sm text-outline">In any UAE store</p>
</div>
<div class="flex flex-col items-center justify-center p-3 pt-6 md:pt-3">
<span class="material-symbols-outlined text-primary text-[32px] mb-2">support_agent</span>
<h4 class="font-title-md text-title-md text-primary font-bold uppercase">{{ __('ui.customer_service') }}</h4>
<p class="font-body-sm text-body-sm text-outline">Questions? Daily 10am – 10pm</p>
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
<span class="font-label-caps text-label-caps uppercase tracking-wider">Email copied to clipboard!</span>
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