@extends('layouts.app')

@section('title', 'Delivery FAQs | Sephora UAE Official')
@section('body_class', 'bg-surface text-on-surface antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col font-body-md text-body-md')

@section('head')
@endsection

@section('content')
<!-- TOP ANNOUNCEMENT BAR -->
<aside class="bg-primary text-on-primary py-2.5 px-4 text-center cursor-pointer transition-opacity duration-150 hover:opacity-95">
<div class="max-w-[1440px] mx-auto flex items-center justify-center gap-2">
<span class="font-label-caps text-label-caps tracking-widest font-bold">
        WANT TO TURN HEADS? YOUR SIGNATURE SCENT STARTS HERE. DISCOVER THE COLLECTION AND LAYER WITHOUT LIMITS - SHOP NOW →
      </span>
</div>
</aside>
<!-- TOP NAV BAR (Shared Component Execution) -->
<!-- BREADCRUMB & HERO INTRO -->
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- Breadcrumb -->
<nav class="flex items-center space-x-2 text-on-surface-variant font-body-sm text-body-sm mb-6">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="/faq">Frequently Asked Questions</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-semibold">Delivery</span>
</nav>
<!-- Header Section -->
<section class="border-b border-primary pb-8 mb-10">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<span class="inline-block bg-primary text-on-primary font-label-caps text-label-caps px-2.5 py-1 tracking-widest uppercase mb-3">
            SEPHORA CLIENT CONCIERGE &amp; SUPPORT
          </span>
<h1 class="font-headline-lg text-headline-lg text-primary tracking-tight">
            Frequently Asked Questions — Delivery
          </h1>
<p class="text-on-surface-variant font-body-lg text-body-lg max-w-3xl mt-3 leading-relaxed">
            Find comprehensive information about our delivery timelines, courier services, same-day options, Click &amp; Collect pickup, and tracking across the United Arab Emirates.
          </p>
</div>
<div class="flex items-center gap-3">
<span class="border border-outline px-3 py-1.5 font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant bg-surface-container-lowest">
            Region: UAE (7 Emirates)
          </span>
<span class="border border-outline px-3 py-1.5 font-label-caps text-label-caps uppercase tracking-wider text-on-surface-variant bg-surface-container-lowest">
            Currency: AED
          </span>
</div>
</div>
</section>
<!-- CONTENT GRID: CATEGORY SIDEBAR + ACCORDION VITRINES -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- LEFT SIDEBAR: TOPIC EXPLORER -->
<aside class="lg:col-span-3 bg-surface-container-lowest border border-outline-variant p-6 sticky top-28">
<h2 class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant border-b border-outline-variant pb-3 mb-4">
          FAQ Categories
        </h2>
<nav class="space-y-1">
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md bg-primary text-on-primary font-bold" href="/faq">
<span>Delivery</span>
<span class="material-symbols-outlined text-[16px]">chevron_right</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>My Sephora</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/stores">
<span>Stores &amp; Services</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>Online Account</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>Online Shopping</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>Products</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>Payment Methods</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>Offers, Samples &amp; Gifts</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq/cancellation-and-refund">
<span>Cancellation &amp; Refund</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>Health &amp; Safety</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/faq">
<span>Corporate Information</span>
</a>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition-colors" href="/gift-card-info">
<span>Gift Cards</span>
</a>
</nav>
<!-- Quick Help Card -->
<div class="mt-8 pt-6 border-t border-outline-variant">
<p class="font-label-caps text-label-caps uppercase tracking-wider text-outline mb-2">Need Immediate Guidance?</p>
<p class="font-title-md text-title-md text-primary font-bold mb-3">Toll-Free UAE Concierge</p>
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
<span class="font-label-caps text-label-caps text-outline uppercase tracking-wider block mb-1">Standard Shipping</span>
<p class="font-title-lg text-title-lg text-primary">Free on Orders &gt; 250 AED</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">1–2 business days across all 7 Emirates.</p>
</div>
<div class="bg-surface-container-lowest p-5 border border-outline-variant">
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-wider block mb-1">Express &amp; Same-Day</span>
<p class="font-title-lg text-title-lg text-primary">Order by 2:00 PM</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Delivered to your door in Dubai &amp; Abu Dhabi.</p>
</div>
<div class="bg-surface-container-lowest p-5 border border-outline-variant">
<span class="font-label-caps text-label-caps text-outline uppercase tracking-wider block mb-1">Click &amp; Collect</span>
<p class="font-title-lg text-title-lg text-primary">Ready in 2 Hours</p>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Free collection at 32 flagship stores.</p>
</div>
</div>
<!-- 1. STANDARD DELIVERY -->
<div class="border border-outline-variant bg-surface-container-lowest">
<div class="bg-surface-container-high px-6 py-4 flex items-center justify-between border-b border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[24px]">local_shipping</span>
<h2 class="font-headline-sm text-headline-sm text-primary">Standard Delivery</h2>
</div>
<span class="font-label-caps text-label-caps tracking-widest uppercase text-outline">8 Questions</span>
</div>
<div class="divide-y divide-outline-variant">
<!-- Q1 -->
<details class="group p-6" open="">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>Can I choose a delivery time slot?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed space-y-2">
<p>Our dedicated courier service will reach out to you via SMS and WhatsApp on the morning of delivery with a live tracking link. Through this notification, you can confirm your preferred delivery window (Morning: 9am–2pm or Evening: 2pm–8pm) or provide alternate gate security instructions.</p>
<p class="text-outline text-body-sm font-body-sm">Note: Standard orders are scheduled Monday through Saturday across Dubai, Abu Dhabi, Sharjah, Ajman, Fujairah, Ras Al Khaimah, and Umm Al Quwain.</p>
</div>
</details>
<!-- Q2 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>What do I do if I missed the delivery of my order?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>If you miss our courier dispatch, there is no need to worry. The driver will attempt a secondary delivery on the following business day at no additional charge. You will receive an SMS containing a direct dispatch link allowing you to reschedule the delivery date or update the drop-off address within the same Emirate.</p>
</div>
</details>
<!-- Q3 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>What should I do if my order has not arrived?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>If your package has exceeded the stated 1–2 business day timeline, please verify the courier status link provided in your Sephora dispatch email. Alternatively, reach out directly to our Client Support Concierge at <strong class="text-primary font-bold">800 7374672</strong> or email <strong class="text-primary font-bold">customercare@sephora.ae</strong> with your order number. Our team resolves dispatch escalations within 1–2 business days.</p>
</div>
</details>
<!-- Q4 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>How can I track my order?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Once your order has been packed and handed over to our courier partners from our central UAE fulfillment hub, you will receive an automated dispatch notification containing your airway tracking reference number. You can also view live status updates anytime under <em>My Sephora → Order History</em>.</p>
</div>
</details>
<!-- Q5 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>Can I pay with foreign currency for Cash on Delivery?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>No. For orders placed under Cash on Delivery (COD) within the United Arab Emirates, couriers strictly accept United Arab Emirates Dirhams (AED) in exact or change amounts. Foreign currencies, traveler cheques, or international checks are not accepted upon doorstep arrival.</p>
</div>
</details>
<!-- Q6 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>What are the delivery costs and timelines?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed space-y-2">
<p><strong class="text-primary font-bold">Orders of 250 AED and above:</strong> Complimentary Standard Delivery across all seven Emirates (1–2 business days).</p>
<p><strong class="text-primary font-bold">Orders below 250 AED:</strong> A standard delivery fee of 20 AED is applied at final checkout.</p>
<p class="text-outline text-body-sm font-body-sm">Gold &amp; Black Beauty Pass members enjoy free delivery on all qualifying transactions.</p>
</div>
</details>
<!-- Q7 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>How are Cash on Delivery orders refunded?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>For returned items paid via Cash on Delivery, your refund is instantly credited as a Sephora Online Store Credit Voucher valid for 12 months. If you return the item directly to any of our 32 Sephora UAE stores, you may also opt for an immediate in-store gift card or instant exchange upon presenting your valid order invoice.</p>
</div>
</details>
<!-- Q8 -->
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>What happens if I am not home when my order is delivered?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Our courier representative will telephone or message your registered UAE mobile number. If unreachable, a doorstep card is logged and the courier will schedule a retry. After three consecutive unsuccessful attempts, the parcel is securely returned to our warehouse and a refund is processed to your original payment method.</p>
</div>
</details>
</div>
</div>
<!-- 2. SAME-DAY DELIVERY -->
<div class="border border-outline-variant bg-surface-container-lowest">
<div class="bg-surface-container-high px-6 py-4 flex items-center justify-between border-b border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[24px]">electric_bolt</span>
<h2 class="font-headline-sm text-headline-sm text-primary">Same-Day Delivery</h2>
</div>
<span class="font-label-caps text-label-caps tracking-widest uppercase text-outline">4 Questions</span>
</div>
<div class="divide-y divide-outline-variant">
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>Can I choose a delivery time slot?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Same-day orders placed prior to the daily 2:00 PM cutoff will be dispatched in the evening wave, delivered between 4:00 PM and 9:00 PM. You can choose from available evening intervals during checkout if you reside in central Dubai or Abu Dhabi metro zones.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>What should I do if my order has not arrived?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>For urgent inquiries regarding same-day orders after 8:00 PM, please phone our VIP Concierge hotlines directly at <strong>800 7374672</strong>. Our evening logistics dispatch unit monitors same-day courier fleets in real time.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>How can I track my order?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Same-Day orders feature live GPS courier tracking once the driver departs the local boutique or central hub. An active live-map tracking SMS is generated the moment your parcel enters the transit vehicle.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>What are the delivery costs and timelines?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Same-day service carries a flat 25 AED priority dispatch fee. Orders placed after the 2:00 PM cutoff automatically rollover to priority delivery for the following morning.</p>
</div>
</details>
</div>
</div>
<!-- 3. PICKUP POINT DELIVERY -->
<div class="border border-outline-variant bg-surface-container-lowest">
<div class="bg-surface-container-high px-6 py-4 flex items-center justify-between border-b border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[24px]">store</span>
<h2 class="font-headline-sm text-headline-sm text-primary">Pickup Point Delivery</h2>
</div>
<span class="font-label-caps text-label-caps tracking-widest uppercase text-outline">3 Questions</span>
</div>
<div class="divide-y divide-outline-variant">
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>What should I do if my order has not arrived?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>You will receive an SMS with a one-time collection PIN once your parcel is placed in the designated automated locker or collection point partner. If you haven't received your PIN within 48 hours of shipment notification, contact our support team immediately.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>How can I track my order?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Tracking follows the standard procedure via the air-waybill link provided upon checkout completion, updating when the parcel arrives at your chosen collection kiosk.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>What are the delivery costs and timelines?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Pickup point delivery is complimentary for all orders above 200 AED, or 15 AED for lower-value baskets, delivering within 1–2 business days.</p>
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
<span>What is Click &amp; Collect?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Click &amp; Collect is our complimentary omni-channel service that allows you to shop your favorite beauty selections online at sephora.me and collect your packaged order directly from your chosen Sephora store in as little as 2 hours.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>Where do I go in the store to collect my order?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Head directly to the dedicated <strong class="text-primary font-bold">Beauty Concierge Cash Desk</strong> or inform any Beauty Advisor upon arrival. Simply present your collection confirmation email or SMS containing your Order Ready code alongside a valid Emirates ID or Passport.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>Which stores offer Click &amp; Collect?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Click &amp; Collect is available across all 32 Sephora UAE retail boutiques, including The Dubai Mall Flagship, Mall of the Emirates, Dubai Hills Mall, Yas Mall Abu Dhabi, Galleria Al Maryah Island, City Centre Mirdif, and Al Zahia Sharjah.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>When should I place my order so that I can collect it on the same day?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Please place your Click &amp; Collect order at least 3 hours prior to store closing. Orders submitted after 7:30 PM will be processed and prepared for collection the following morning at store opening (10:00 AM).</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>How long will the store hold my Click &amp; Collect order?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Stores will securely retain your order for <strong class="text-primary font-bold">7 consecutive days</strong> starting from the moment you receive your "Ready for Pickup" notification. If you do not collect your order within this period, the items will be returned to stock and a full refund will be automatically issued.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>Can I pay for my Click &amp; Collect order in cash at the store?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>No. Click &amp; Collect orders must be fully prepaid online during checkout via Credit/Debit card, Apple Pay, Tabby, Tamara, or Sephora Online Gift Cards. Cash payment at the store counter is not permitted for web-reserved packages.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>Can I use my promo code or gift card for Click &amp; Collect?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Yes. All valid Sephora UAE promotional vouchers, Beauty Pass coupon codes, and e-gift cards can be applied at digital checkout before selecting Click &amp; Collect pickup.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>Will I get free samples and gift with purchase with Click &amp; Collect?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Yes! Every Click &amp; Collect order is carefully packed with complimentary prestige beauty samples matching your basket selection, including any eligible tier-based Deluxe Gifts with Purchase.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>How do I return my Click &amp; Collect order?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Returns can be handled instantly in any Sephora store within 14 days of pickup. Simply bring the unused items in their original luxury packaging alongside your digital purchase invoice for an immediate exchange or refund.</p>
</div>
</details>
</div>
</div>
<!-- 5. EXPRESS DELIVERY & FAILED DELIVERIES -->
<div class="border border-outline-variant bg-surface-container-lowest">
<div class="bg-surface-container-high px-6 py-4 flex items-center justify-between border-b border-outline-variant">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[24px]">priority_high</span>
<h2 class="font-headline-sm text-headline-sm text-primary">Express &amp; Failed Deliveries</h2>
</div>
<span class="font-label-caps text-label-caps tracking-widest uppercase text-outline">2 Questions</span>
</div>
<div class="divide-y divide-outline-variant">
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>Express delivery options and immediate dispatch policies</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Express dispatch guarantees priority warehouse picking and immediate fulfillment via dedicated private courier. Available on designated weekdays for orders within prime metropolitan zones of Dubai and Abu Dhabi.</p>
</div>
</details>
<details class="group p-6">
<summary class="flex items-center justify-between cursor-pointer list-none select-none font-title-lg text-title-lg text-primary">
<span>What happens if I am not home when my order is delivered?</span>
<span class="material-symbols-outlined toggle-icon text-[20px] transition-transform duration-200">expand_more</span>
</summary>
<div class="mt-4 pt-2 font-body-md text-body-md text-on-surface-variant leading-relaxed">
<p>Courier personnel will telephone and leave a message. Rescheduling is available via link up to 3 times before the parcel returns to our distribution center.</p>
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
            SEPHORA CLIENT CONCIERGE
          </span>
<h3 class="font-headline-md text-headline-md text-primary mb-3">Email Us Directly</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
            Have a question about an ongoing dispatch, customs clearance, or address change? Our dedicated team replies within 12 hours.
          </p>
<div class="bg-surface-container-low border border-outline-variant p-4 mb-4 flex items-center justify-between">
<span class="font-title-md text-title-md text-primary select-all" id="emailAddress">customercare@sephora.ae</span>
<button class="font-label-caps text-label-caps uppercase tracking-wider font-bold text-primary hover:text-secondary border-b border-primary pb-0.5 ml-2" onclick="navigator.clipboard.writeText('customercare@sephora.ae'); alert('Email copied to clipboard!');">
              COPY
            </button>
</div>
<a class="inline-block w-full text-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest py-3.5 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all duration-150" href="mailto:customercare@sephora.ae">
            WRITE TO US
          </a>
</div>
<!-- Right: Regional Contact Phone Directory -->
<div class="lg:col-span-7">
<div class="flex items-center justify-between mb-4">
<h3 class="font-headline-md text-headline-md text-primary">Dedicated Contact Numbers</h3>
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
<span class="font-label-caps text-label-caps uppercase tracking-wider text-outline block">Kingdom of Saudi Arabia</span>
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
<span class="font-title-md text-title-md text-primary uppercase tracking-wider">Free Delivery</span>
<span class="font-body-sm text-body-sm text-outline mt-0.5">Over 250 AED</span>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">verified</span>
<span class="font-title-md text-title-md text-primary uppercase tracking-wider">100% Authentic</span>
<span class="font-body-sm text-body-sm text-outline mt-0.5">Direct luxury source</span>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">replay</span>
<span class="font-title-md text-title-md text-primary uppercase tracking-wider">Easy Returns</span>
<span class="font-body-sm text-body-sm text-outline mt-0.5">In any UAE store</span>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">stars</span>
<span class="font-title-md text-title-md text-primary uppercase tracking-wider">Beauty Pass</span>
<span class="font-body-sm text-body-sm text-outline mt-0.5">Earn points on every AED</span>
</div>
</div>
</section>
</main>
<!-- NEWSLETTER SIGNUP ROW -->
<section class="bg-surface-container border-t border-outline-variant py-10">
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin flex flex-col md:flex-row items-center justify-between gap-6">
<div>
<h4 class="font-headline-sm text-headline-sm text-primary uppercase tracking-wider">Subscribe to the Sephora Newsletter</h4>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Get exclusive beauty offers, VIP perks, and early access delivered to your inbox.</p>
</div>
<form class="flex w-full md:w-auto max-w-md items-center" onsubmit="event.preventDefault(); alert('Subscribed to Sephora VIP newsletter!');" data-newsletter-form>
<input class="w-full md:w-80 px-4 py-3 border border-outline bg-surface-container-lowest text-primary font-body-sm text-body-sm placeholder:text-outline focus:border-primary focus:ring-0 outline-none" placeholder="Enter your email address" required="" type="email"/>
<button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 py-3.5 hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors whitespace-nowrap" type="submit">
          Subscribe
        </button>
</form>
</div>
</section>
<!-- FOOTER (Shared Component Exact Execution) -->
@endsection
