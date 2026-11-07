@extends('layouts.app')

@section('title', 'Cancellation & Refund | Sephora UAE Client Concierge')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@section('head')
@endsection

@section('content')
<!-- 1. TOP ANNOUNCEMENT BAR -->
<aside aria-label="Announcement" class="bg-primary text-on-primary py-2 px-4 text-center">
<div class="max-w-[1440px] mx-auto flex items-center justify-center space-x-2">
<span class="font-label-caps text-label-caps tracking-[0.18em] font-semibold text-center">
        WANT TO TURN HEADS? YOUR SIGNATURE SCENT STARTS HERE. DISCOVER THE COLLECTION AND LAYER WITHOUT LIMITS - <a class="underline underline-offset-4 hover:text-on-primary-container transition-colors" href="#fragrance">SHOP NOW →</a>
</span>
</div>
</aside>
<!-- 2. BRAND HEADER & NAVIGATION -->
<!-- MAIN CANVAS -->
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-8">
<!-- 3. BREADCRUMB & PAGE HEADER -->
<section class="border-b border-outline-variant pb-8 mb-8">
<!-- Breadcrumb -->
<nav aria-label="Breadcrumb" class="mb-4">
<ol class="flex items-center space-x-2 font-label-caps text-label-caps tracking-widest text-on-surface-variant">
<li><a class="hover:text-primary transition-colors" href="/">Home</a></li>
<li><span>/</span></li>
<li><a class="hover:text-primary transition-colors" href="/faq">Frequently Asked Questions</a></li>
<li><span>/</span></li>
<li class="text-primary font-bold">Cancellation &amp; Refund</li>
</ol>
</nav>
<!-- Editorial Header Block -->
<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
<div class="max-w-3xl">
<div class="inline-block bg-primary text-on-primary px-3 py-1 font-label-caps text-label-caps tracking-widest font-bold mb-3">
            SEPHORA CLIENT CONCIERGE &amp; SUPPORT
          </div>
<h1 class="font-display-hero text-headline-md md:text-headline-lg lg:text-[42px] font-normal tracking-tight text-primary leading-tight mb-3">
            Frequently Asked Questions — Cancellation &amp; Refund
          </h1>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            Find complete guidelines on order cancellations, 14-day store returns, courier collections, refunds across payment methods, and Beauty Pass point balance restorations across the United Arab Emirates.
          </p>
</div>
<!-- Status Badges -->
<div class="flex flex-row lg:flex-col items-start lg:items-end gap-2 border-t lg:border-t-0 border-outline-variant pt-4 lg:pt-0">
<span class="inline-flex items-center px-2.5 py-1 border border-primary text-primary font-label-caps text-label-caps font-bold">
<span class="w-1.5 h-1.5 bg-secondary rounded-full mr-2"></span>
            REGION: UAE (7 EMIRATES)
          </span>
<span class="inline-flex items-center px-2.5 py-1 bg-surface-container-high text-on-surface font-label-caps text-label-caps font-bold">
            CURRENCY: AED
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
<span class="font-label-tag text-label-tag text-secondary font-bold">IN-STORE &amp; ONLINE</span>
</div>
<h3 class="font-title-lg text-title-lg text-primary mb-2">14-Day Store &amp; Online Returns</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
            Free instant returns across all 32 Sephora stores in the UAE with original invoice or complimentary doorstep courier pickup.
          </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between text-primary">
<span class="font-label-caps text-label-caps font-bold">NO PROCESSING FEES</span>
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
<h3 class="font-title-lg text-title-lg text-primary mb-2">Instant Refund for Cancellations</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
            Zero deduction on cancelled items. Pre-authorization releases instantly or reflects within 24–48 hours based on your UAE bank.
          </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between text-primary">
<span class="font-label-caps text-label-caps font-bold">CARDS, APPLE PAY &amp; COD</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</div>
</div>
<!-- Card 3 -->
<div class="border border-primary bg-surface-container-lowest p-6 flex flex-col justify-between hover:border-black transition-all">
<div>
<div class="flex items-center justify-between mb-4">
<span class="material-symbols-outlined text-primary text-3xl">verified</span>
<span class="font-label-tag text-label-tag text-secondary font-bold">VIP MEMBERSHIP</span>
</div>
<h3 class="font-title-lg text-title-lg text-primary mb-2">Beauty Pass Point Protection</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
            Points reinstated automatically upon return or cancellation validation. Zero tier loss on returned orders.
          </p>
</div>
<div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between text-primary">
<span class="font-label-caps text-label-caps font-bold">WHITE, BLACK &amp; GOLD TIERS</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</div>
</div>
</section>
<!-- 5. MAIN CONTENT LAYOUT: SIDEBAR + FAQS -->
<div class="grid grid-cols-12 gap-8 items-start mb-16">
<!-- LEFT SIDEBAR: FAQ CATEGORIES -->
<aside class="col-span-12 lg:col-span-4 sticky top-28 space-y-6">
<div class="border border-outline-variant bg-surface-container-lowest p-5">
<h2 class="font-title-lg text-title-lg text-primary mb-4 pb-3 border-b border-outline-variant tracking-wider uppercase font-bold">
            FAQ Categories
          </h2>
<ul class="space-y-1">
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>My Sephora</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/stores">
<span>Stores &amp; Services</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>Online Account</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>Online Shopping</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>Products</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>Payment Methods</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>Offers, Samples &amp; Gifts</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>Delivery</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<!-- Active Nav Item -->
<li>
<a class="flex items-center justify-between px-3 py-2.5 bg-primary text-on-primary font-title-md text-title-md font-bold" href="/faq/cancellation-and-refund">
<span>Cancellation &amp; Refund</span>
<span class="material-symbols-outlined text-sm text-on-primary">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>Health &amp; Safety</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/faq">
<span>Corporate Information</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
<li>
<a class="flex items-center justify-between px-3 py-2.5 font-title-md text-title-md text-on-surface hover:bg-surface-container transition-colors" href="/gift-card-info">
<span>Gift Cards</span>
<span class="material-symbols-outlined text-sm text-outline">chevron_right</span>
</a>
</li>
</ul>
</div>
<!-- Immediate Help Quick Banner -->
<div class="border border-outline-variant bg-surface-container-low p-5">
<div class="flex items-center space-x-2 text-secondary mb-2">
<span class="material-symbols-outlined text-lg">support_agent</span>
<span class="font-label-caps text-label-caps font-bold">NEED IMMEDIATE GUIDANCE?</span>
</div>
<h4 class="font-title-lg text-title-lg text-primary mb-1">Toll-Free UAE Concierge</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            Our luxury beauty advisors are available 7 days a week, 10:00 AM – 10:00 PM GST.
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
<h2 class="font-display-hero text-headline-sm md:text-headline-md text-primary">Cancellation</h2>
</div>
<span class="font-label-caps text-label-caps font-bold bg-surface-container-high px-2.5 py-1 text-on-surface">4 QUESTIONS</span>
</div>
<div class="border border-outline-variant divide-y divide-outline-variant bg-surface-container-lowest">
<!-- Question 1 -->
<details class="group p-5 transition-all" open="">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">What happens if I don't pick up my Click &amp; Collect order?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  Your Click &amp; Collect parcel will be held at your chosen Sephora UAE boutique for exactly <strong>7 consecutive days</strong> starting from the moment you receive your collection notification email or SMS.
                </p>
<p>
                  If the order is not collected within this 7-day period, the store team will automatically return the merchandise to stock and initiate an order cancellation. Any payment charged will be automatically refunded through your original payment method. For card payments, bank clearing typically completes within 3–7 business days depending on your financial institution.
                </p>
</div>
</details>
<!-- Question 2 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">How do I cancel or modify an appointment?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  Beauty Bar appointments, fragrance layer consultations, and Brow Bar bookings can be modified or cancelled seamlessly up to <strong>2 hours prior</strong> to the scheduled time:
                </p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li>Directly through your online <strong>Beauty Pass profile</strong> under "My Bookings".</li>
<li>Via the booking confirmation email link.</li>
<li>By calling the host store directly or reaching our client concierge at <strong>800 7374672</strong>.</li>
</ul>
<p>There are no penalties or fees for rescheduled appointments.</p>
</div>
</details>
<!-- Question 3 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">What happens if I am not home when my order is delivered?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  Our premier UAE courier partners make up to <strong>three separate delivery attempts</strong> before returning a shipment to our fulfillment hub. Prior to each attempt, you will receive an SMS and WhatsApp alert containing a real-time tracking link with options to:
                </p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li>Reschedule delivery for an alternate date or time slot.</li>
<li>Specify leave-at-door instructions (for pre-paid orders).</li>
<li>Redirect delivery to an alternate UAE residential or corporate address.</li>
</ul>
<p>
                  If an order cannot be delivered after three attempts, it is automatically marked as cancelled and refunded in full.
                </p>
</div>
</details>
<!-- Question 4 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">What happens to my points when my order is cancelled or returned?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  Your Beauty Pass tier balance adjusts in real-time in alignment with your final net spend:
                </p>
<ul class="list-disc pl-5 space-y-1.5">
<li><strong>Points Earned:</strong> Points accrued on cancelled items or returned merchandise will be deducted from your Beauty Pass balance once the cancellation or return is finalized.</li>
<li><strong>Points Redeemed:</strong> If you redeemed Beauty Pass loyalty points or 200-point 10% vouchers on an order that was subsequently cancelled, those points and voucher privileges will be restored to your account within 24 hours.</li>
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
<h2 class="font-display-hero text-headline-sm md:text-headline-md text-primary">Refund &amp; Return Policy</h2>
</div>
<span class="font-label-caps text-label-caps font-bold bg-surface-container-high px-2.5 py-1 text-on-surface">11 QUESTIONS</span>
</div>
<div class="border border-outline-variant divide-y divide-outline-variant bg-surface-container-lowest">
<!-- R1 -->
<details class="group p-5 transition-all" open="">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">What is your return policy?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  We offer a comprehensive <strong>14-day return and exchange policy</strong> from the date of physical receipt or store purchase across the United Arab Emirates.
                </p>
<p class="mb-3">To be eligible for a full refund or exchange:</p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li>Items must be entirely unused, in original pristine saleable condition, with all hygienic seals, cellophanes, and packaging intact.</li>
<li>Proof of purchase is required (printed receipt, digital tax invoice, or Order History confirmation email).</li>
<li>Gifts with Purchase (GWP) and complimentary samples associated with returned products must also be returned in unused condition.</li>
</ul>
<p class="text-body-sm text-outline">Note: For hygienic reasons, makeup applicators and unsealed skincare jars cannot be returned unless verified as defective.</p>
</div>
</details>
<!-- R2 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">My order has been cancelled due to the unavailability of a product. Have I been charged?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
<strong>No.</strong> When you place an online order with Sephora UAE, your card is not immediately captured; an authorization hold is placed temporarily. 
                </p>
<p>
                  If an item is flagged out of stock during parcel assembly, your card is charged solely for the fulfilled items. The authorization hold for the unavailable item will be released immediately. In accordance with UAE banking cycles, the balance hold disappears from pending transactions within 24 to 48 business hours.
                </p>
</div>
</details>
<!-- R3 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">What do I do if I receive the wrong item, a damaged/defective item or have a problem with an item ordered?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  Please notify our Client Concierge team within <strong>48 hours</strong> of receiving the shipment. You may contact us at <a class="text-primary font-bold underline" href="mailto:customercare@sephora.ae">customercare@sephora.ae</a> or via toll-free phone at <strong>800 7374672</strong>.
                </p>
<p class="mb-3">Please include:</p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li>Your order reference number (#SEPH-AE-XXXXX).</li>
<li>High-resolution photographs displaying the damaged box, shipping label, and product defect.</li>
</ul>
<p>
                  We will arrange a complimentary white-glove collection and ship an immediate replacement or issue a 100% refund, including delivery charges.
                </p>
</div>
</details>
<!-- R4 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">How can I return a product in store?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  You can return products bought online or at any branch directly to <strong>any of the 32 Sephora stores</strong> across Dubai, Abu Dhabi, Sharjah, Al Ain, Ajman, and Ras Al Khaimah.
                </p>
<ol class="list-decimal pl-5 space-y-1.5 mb-3">
<li>Present the item in its original unopened condition.</li>
<li>Show your electronic Tax Invoice (accessible in your mobile account or order confirmation email).</li>
<li>Our store beauty advisor will authenticate the item and process an instant refund to your card or provide an exchange immediately.</li>
</ol>
</div>
</details>
<!-- R5 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">How do I return my Click &amp; Collect order?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  Click &amp; Collect orders can be returned either immediately at the checkout desk when collecting, or within 14 days at <strong>any Sephora store</strong> in the UAE. Simply present your collection confirmation email or tax invoice.
                </p>
</div>
</details>
<!-- R6 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">How are Cash on Delivery orders refunded?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">For orders completed via Cash on Delivery (COD), returns processed through courier pickup offer two flexible refund methods:</p>
<ul class="list-disc pl-5 space-y-1.5 mb-3">
<li><strong>Sephora Online Store Voucher:</strong> Issued instantly upon warehouse inspection, valid for 12 months on all luxury brands online.</li>
<li><strong>Direct Bank Transfer:</strong> We transfer funds to your UAE bank account. You will receive a secure portal link to provide your IBAN, recipient name, and bank code. Transfers clear within 5–7 banking days.</li>
</ul>
<p class="text-body-sm text-outline">Alternatively, return the item to any UAE Sephora retail boutique to receive an immediate electronic store gift card.</p>
</div>
</details>
<!-- R7 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">How will I be refunded for items purchased via gift card?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  If you paid using a physical Sephora Gift Card or digital e-Gift Card, refunds are credited back to an <strong>electronic voucher or newly loaded digital Gift Card</strong> with the equivalent balance. If you split payment between a Gift Card and a credit card, the amount paid by card is returned to the card, and the remainder is credited back to a Gift Card.
                </p>
</div>
</details>
<!-- R8 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">Are delivery charges refundable?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  Standard delivery fees (AED 20 for orders under AED 250) and Cash on Delivery service fees are non-refundable for voluntary change-of-mind returns. However, if the return is a result of a <strong>Sephora fulfillment error, package defect, or transit damage</strong>, all shipping fees will be reimbursed in full.
                </p>
</div>
</details>
<!-- R9 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">What should I do if have lost my invoice/receipt?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  If you have misplaced your physical receipt, simply sign in to your online Sephora account and navigate to <strong>My Account &gt; Order History</strong> to view and download your original Tax Invoice. If you made the purchase in-store as a Beauty Pass member, store advisors can instantly look up your transaction history using your mobile phone number.
                </p>
</div>
</details>
<!-- R10 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">Can engraved products be returned?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p>
                  Due to their bespoke and tailored nature, <strong>customized and personalized items—such as laser-engraved fragrance flacons and monogrammed lipstick casings—cannot be returned or exchanged</strong>, unless there is an evident manufacturing defect or typing error produced by Sephora.
                </p>
</div>
</details>
<!-- R11 -->
<details class="group p-5 transition-all">
<summary class="flex justify-between items-center cursor-pointer list-none font-title-lg text-title-lg text-primary hover:text-secondary transition-colors">
<span class="pr-4">How do I return a product delivered to Kuwait, Qatar, Bahrain, or Oman?</span>
<span class="material-symbols-outlined text-outline group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="mt-4 pt-4 border-t border-surface-container text-body-md text-on-surface-variant leading-relaxed">
<p class="mb-3">
                  For cross-border regional orders fulfilled across the GCC, customers must arrange returns through our dedicated regional concierge team within 14 days of delivery.
                </p>
<p class="mb-3">
                  Reach out to your territory support desk (phone contacts detailed in the concierge section below). Our logistics team will issue an international prepaid airway bill (AWB) and schedule courier pickup from your location.
                </p>
<p class="text-body-sm text-outline">Note: Cross-border shipments cannot be returned directly at regional retail stores of a different country.</p>
</div>
</details>
</div>
</div>
</section>
</div>
<!-- 6. DEDICATED CLIENT CONCIERGE CONTACT BOX -->
<section class="border border-primary bg-surface-container-lowest p-8 lg:p-10 mb-16">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- Left: Email Us Directly -->
<div class="lg:col-span-6 lg:border-r lg:border-outline-variant lg:pr-8">
<div class="inline-block bg-primary text-on-primary px-3 py-1 font-label-caps text-label-caps tracking-widest font-bold mb-4">
            SEPHORA CLIENT CONCIERGE
          </div>
<h3 class="font-display-hero text-headline-sm md:text-headline-md text-primary mb-2">Email Us Directly</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
            For returns validation, order cancellation queries, or invoice generation, submit a written inquiry to our dedicated UAE concierge.
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
            WRITE TO US
          </a>
</div>
<!-- Right: Dedicated Contact Numbers -->
<div class="lg:col-span-6 lg:pl-4">
<div class="flex items-center justify-between mb-4">
<h3 class="font-title-lg text-title-lg text-primary uppercase font-bold tracking-wider">Contact Numbers</h3>
<span class="font-label-caps text-label-caps text-outline font-bold">10:00 AM - 10:00 PM (GST) DAILY</span>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<!-- UAE -->
<div class="border border-primary bg-primary text-on-primary p-4">
<span class="font-label-caps text-label-caps opacity-80 block mb-1">UNITED ARAB EMIRATES (TOLL FREE)</span>
<a class="font-title-lg text-title-lg font-bold tracking-wide hover:underline" href="tel:8007374672">800 7374672</a>
</div>
<!-- Saudi Arabia -->
<div class="border border-outline-variant bg-surface-container-lowest p-4">
<span class="font-label-caps text-label-caps text-on-surface-variant block mb-1">SAUDI ARABIA</span>
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
<h4 class="font-title-md text-title-md font-bold uppercase text-primary">Free Delivery</h4>
<span class="font-body-sm text-body-sm text-outline">Over 250 AED</span>
</div>
<!-- Badge 2 -->
<div class="flex flex-col items-center justify-center p-3 border-l border-outline-variant">
<span class="material-symbols-outlined text-3xl text-primary mb-2">verified</span>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary">100% Authentic</h4>
<span class="font-body-sm text-body-sm text-outline">Direct luxury source</span>
</div>
<!-- Badge 3 -->
<div class="flex flex-col items-center justify-center p-3 border-l-0 md:border-l border-outline-variant">
<span class="material-symbols-outlined text-3xl text-primary mb-2">cached</span>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary">Easy Returns</h4>
<span class="font-body-sm text-body-sm text-outline">In any UAE store</span>
</div>
<!-- Badge 4 -->
<div class="flex flex-col items-center justify-center p-3 border-l border-outline-variant">
<span class="material-symbols-outlined text-3xl text-primary mb-2">loyalty</span>
<h4 class="font-title-md text-title-md font-bold uppercase text-primary">Beauty Pass</h4>
<span class="font-body-sm text-body-sm text-outline">Earn points on every AED</span>
</div>
</div>
</section>
<!-- 8. NEWSLETTER SUBSCRIPTION -->
<section class="border border-outline-variant bg-surface-container-low p-8 mb-16 text-center max-w-3xl mx-auto">
<h3 class="font-display-hero text-headline-sm md:text-headline-md text-primary mb-2">Subscribe to the Sephora newsletter!</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
        Receive privileged previews of seasonal collections, invitations to private masterclasses, and tailored beauty recommendations.
      </p>
<form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" onsubmit="event.preventDefault(); alert('Subscribed successfully');" data-newsletter-form>
<input class="flex-1 bg-surface-container-lowest border border-outline text-on-surface placeholder:text-outline text-body-sm px-4 py-3 rounded-none focus:border-primary focus:ring-0 outline-none" placeholder="Enter your email address" required="" type="email"/>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-6 py-3 font-bold tracking-widest hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" type="submit">
          SUBSCRIBE
        </button>
</form>
</section>
</main>
<!-- 9. FOOTER (SHARED COMPONENT EXECUTION) -->
@endsection
