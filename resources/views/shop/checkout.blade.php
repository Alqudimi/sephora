@extends('layouts.app')

@section('title', 'Checkout | SEPHORA UAE')
@section('body_class', 'bg-background text-on-surface antialiased font-body-md min-h-screen flex flex-col selection:bg-primary selection:text-on-primary')

@section('content')
<main class="flex-grow max-w-[1440px] w-full mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl">
<!-- Breadcrumb Indicator -->
<div class="mb-space-lg flex items-center justify-between border-b border-primary pb-3">
<div class="flex items-center gap-3">
<h1 class="font-headline-md text-headline-md uppercase tracking-wider text-primary">Checkout</h1>
<span class="text-outline-variant font-headline-sm">|</span>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-bold">United Arab Emirates</span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps">
<span class="material-symbols-outlined text-[16px] text-primary">verified_user</span>
<span>256-BIT ENCRYPTION</span>
</div>
</div>
<!-- 2-Column Responsive Layout -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">
<!-- ================= LEFT COLUMN: MAIN CHECKOUT STEPPER (8 Cols) ================= -->
<div class="lg:col-span-7 xl:col-span-8 flex flex-col gap-space-md">
<!-- STEP 1: RECEIVE YOUR ORDER (ACTIVE ACCORDION) -->
<section class="border border-primary bg-surface-container-lowest transition-all">
<div class="p-space-md md:p-space-lg border-b border-primary flex items-center justify-between bg-surface-container-lowest">
<div class="flex items-center gap-4">
<span class="w-8 h-8 bg-primary text-on-primary flex items-center justify-center font-title-md text-title-md">1</span>
<div>
<h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Receive Your Order</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Please select your prefered delivery method</p>
</div>
</div>
<span class="font-label-caps text-label-caps uppercase text-secondary font-bold tracking-widest">In Progress</span>
</div>
<div class="p-space-md md:p-space-lg space-y-space-lg">
<!-- Delivery Method Tabs -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-3">
<!-- Option A: Standard Home Delivery (Active) -->
<label class="relative border-2 border-primary p-4 cursor-pointer bg-surface-container-lowest flex flex-col justify-between hover:bg-surface-container-low transition-colors">
<input checked="" class="absolute top-4 right-4 text-primary focus:ring-0 w-4 h-4 border-primary" name="delivery_method" type="radio" value="standard"/>
<div>
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined text-primary text-[22px]">local_shipping</span>
<span class="font-title-md text-title-md text-primary font-bold">Home Delivery</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-2">2-3 Business Days</p>
<p class="font-label-caps text-label-caps text-primary tracking-wider font-bold">FREE OVER AED 250</p>
</div>
<div class="mt-4 pt-2 border-t border-primary/10 flex items-center justify-between text-primary">
<span class="font-label-tag text-label-tag uppercase tracking-widest text-secondary font-bold">Standard</span>
<span class="font-title-md text-body-md font-bold">FREE</span>
</div>
</label>
<!-- Option B: Same-Day Delivery -->
<label class="relative border border-outline-variant p-4 cursor-pointer bg-surface-container-lowest flex flex-col justify-between hover:border-primary transition-colors">
<input class="absolute top-4 right-4 text-primary focus:ring-0 w-4 h-4 border-outline-variant" name="delivery_method" type="radio" value="same_day"/>
<div>
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined text-primary text-[22px]">bolt</span>
<span class="font-title-md text-title-md text-primary font-bold">Same-Day Express</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-2">Dubai &amp; Abu Dhabi</p>
<p class="font-label-caps text-label-caps text-on-surface-variant tracking-wider">Orders before 2 PM</p>
</div>
<div class="mt-4 pt-2 border-t border-outline-variant/40 flex items-center justify-between text-primary">
<span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant">Courier</span>
<span class="font-title-md text-body-md font-bold">AED 25.00</span>
</div>
</label>
<!-- Option C: Click & Collect -->
<label class="relative border border-outline-variant p-4 cursor-pointer bg-surface-container-lowest flex flex-col justify-between hover:border-primary transition-colors">
<input class="absolute top-4 right-4 text-primary focus:ring-0 w-4 h-4 border-outline-variant" name="delivery_method" type="radio" value="click_collect"/>
<div>
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined text-primary text-[22px]">storefront</span>
<span class="font-title-md text-title-md text-primary font-bold">Click &amp; Collect</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-2">Ready in 2 Hours</p>
<p class="font-label-caps text-label-caps text-on-surface-variant tracking-wider">The Dubai Mall &amp; more</p>
</div>
<div class="mt-4 pt-2 border-t border-outline-variant/40 flex items-center justify-between text-primary">
<span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant">Boutique</span>
<span class="font-title-md text-body-md font-bold">FREE</span>
</div>
</label>
</div>
<!-- Shipping Address Form -->
<div class="pt-space-sm border-t border-primary/10">
<h3 class="font-title-md text-title-md uppercase tracking-wider text-primary mb-4 flex items-center gap-2">
<span>Shipping Address (United Arab Emirates)</span>
</h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<!-- Full Name -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">Recipient Full Name *</label>
<input class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md focus:outline-none focus:border-primary focus:ring-0 bg-surface-container-lowest" type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}"/>
</div>
<!-- UAE Phone -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">UAE Mobile Phone Number *</label>
<div class="flex">
<span class="inline-flex items-center px-3 border border-r-0 border-outline bg-surface-container-low font-body-md text-on-surface">
                      +971
                    </span>
<input class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md focus:outline-none focus:border-primary focus:ring-0 bg-surface-container-lowest" type="tel" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone ?? '') }}"/>
</div>
</div>
<!-- Emirate Selector -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">Emirate *</label>
<select class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md focus:outline-none focus:border-primary focus:ring-0 bg-surface-container-lowest uppercase" name="emirate">
<option value="">Select Emirate *</option>
@foreach(['Dubai','Abu Dhabi','Sharjah','Ajman','Al Ain','Ras Al Khaimah','Fujairah','Umm Al Quwain'] as $em)
<option value="{{ $em }}" {{ old('emirate', $defaultAddress->emirate ?? 'Dubai') === $em ? 'selected' : '' }}>{{ $em }}</option>
@endforeach
</div>
<!-- Area / District -->
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">District / Area *</label>
<input class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md focus:outline-none focus:border-primary focus:ring-0 bg-surface-container-lowest" type="text" name="area" value="{{ old('area', $defaultAddress->area ?? '') }}" placeholder="e.g. Downtown Dubai, Mohammed Bin Rashid Blvd"/>
</div>
<!-- Street Address & Building -->
<div class="md:col-span-2">
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">Building, Apartment or Villa Number *</label>
<input class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md focus:outline-none focus:border-primary focus:ring-0 bg-surface-container-lowest" type="text" name="street_address" value="{{ old('street_address', $defaultAddress->street_address ?? '') }}" placeholder="e.g. Burj Crown Residences, Suite 1804"/>
</div>
<!-- Delivery Instructions -->
<div class="md:col-span-2">
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">Delivery Notes / Landmark (Optional)</label>
<input class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md focus:outline-none focus:border-primary focus:ring-0 bg-surface-container-lowest" placeholder="e.g. Leave with concierge or security desk" name="delivery_instructions" type="text"/>
</div>
</div>
<!-- Default Checkbox -->
<div class="flex items-center gap-3 mt-4">
<input class="w-4 h-4 text-primary border-primary focus:ring-0" id="save_address" type="checkbox" name="save_address"/>
<label class="font-body-sm text-body-sm text-on-surface" for="save_address">Save this address to my Sephora Beauty Pass account</label>
</div>
<!-- Button CTA -->
<div class="mt-6 flex justify-end">
<button class="w-full md:w-auto px-8 h-12 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-surface-container-lowest hover:text-primary border border-primary transition-all duration-200" type="button">
                  Save &amp; Continue to Shipping
                </button>
</div>
</div>
</div>
</section>
<!-- STEP 2: SHIPPING (Configured Preview) -->
<section class="border border-outline-variant bg-surface-container-lowest transition-all">
<div class="p-space-md md:p-space-lg flex items-center justify-between">
<div class="flex items-center gap-4">
<span class="w-8 h-8 bg-surface-container-low text-primary border border-outline-variant flex items-center justify-center font-title-md text-title-md">2</span>
<div>
<h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Shipping</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Temperature-controlled luxury vehicle dispatched via Sephora Logistics</p>
</div>
</div>
<button class="font-label-caps text-label-caps uppercase underline tracking-wider text-primary hover:opacity-70">Edit</button>
</div>
</section>
<!-- STEP 3: FREE SAMPLES & GIFT BOX (Exclusive Beauty Perks) -->
<section class="border border-primary bg-surface-container-lowest">
<div class="p-space-md md:p-space-lg border-b border-primary flex items-center justify-between bg-surface-container-lowest">
<div class="flex items-center gap-4">
<span class="w-8 h-8 bg-primary text-on-primary flex items-center justify-center font-title-md text-title-md">3</span>
<div>
<h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Free Samples &amp; Gift Box</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Select up to 2 complimentary deluxe miniatures with this order</p>
</div>
</div>
<span class="font-label-caps text-label-caps uppercase text-secondary font-bold tracking-widest">2 of 2 Selected</span>
</div>
<div class="p-space-md md:p-space-lg space-y-space-lg">
<!-- Sample Selection Vitrine Grid -->
<div>
<p class="font-label-caps text-label-caps uppercase text-primary tracking-widest mb-3">Complimentary Deluxe Samples</p>
<div class="grid grid-cols-1 md:grid-cols-3 gap-3">
@foreach ($samples as $i => $sample)
<div class="border-2 {{ old('samples.'.$i) ? 'border-primary' : 'border-outline-variant' }} p-3 {{ old('samples.'.$i) ? 'bg-surface-container-low' : '' }} relative flex flex-col justify-between">
@if (old('samples.'.$i))
<div class="absolute top-2 left-2 bg-primary text-on-primary font-label-tag text-label-tag px-1.5 py-0.5 uppercase">Selected</div>
@endif
<div class="w-full h-32 bg-surface-container-lowest flex items-center justify-center mb-2 overflow-hidden border border-outline-variant">
<img class="h-28 object-contain" alt="{{ $sample->name }}" src="{{ asset($sample->first_image) }}"/>
</div>
<div>
<span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant block">{{ $sample->brand?->name }}</span>
<h4 class="font-title-md text-body-sm font-bold text-primary truncate">{{ $sample->name }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Complimentary deluxe sample</p>
</div>
<label class="mt-3 flex items-center gap-2 font-label-caps text-label-caps uppercase text-primary cursor-pointer">
<input type="checkbox" class="w-4 h-4 text-primary border-primary focus:ring-0" name="samples[]" value="{{ $sample->id }}"/>
<span>Add to my order</span>
</label>
</div>
@endforeach
</div></div>
<div class="flex-grow">
<div class="flex items-center justify-between">
<h4 class="font-title-md text-title-md uppercase tracking-wider text-primary">Sephora Iconic Black &amp; White Striped Gift Box</h4>
<span class="font-label-caps text-label-caps uppercase text-secondary font-bold">Complimentary</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Pack your items in our signature luxury presentation box tied with grosgrain ribbon, including a personalized gold foil message card.</p>
<div class="mt-3 flex items-center gap-3">
<input class="w-4 h-4 text-primary border-primary focus:ring-0" id="gift_box" type="checkbox" name="gift_box"/>
<label class="font-title-md text-body-sm text-primary" for="gift_box">Include Gift Packaging &amp; Card</label>
</div>
<!-- Gift Card Message Textarea -->
<div class="mt-3">
<textarea class="w-full border border-outline p-2.5 font-body-sm text-body-sm focus:outline-none focus:border-primary bg-surface-container-lowest" placeholder="Write your personalized gift message here (Max 200 characters)..." rows="2" name="gift_message" placeholder="Write your personalized gift message here (Max 200 characters)..."></textarea>
</div>
</div>
</div>
</section>
<!-- STEP 4: PAYMENT METHODS (Interactive Gateway Accordion) -->
<section class="border border-primary bg-surface-container-lowest">
<div class="p-space-md md:p-space-lg border-b border-primary flex items-center justify-between bg-surface-container-lowest">
<div class="flex items-center gap-4">
<span class="w-8 h-8 bg-primary text-on-primary flex items-center justify-center font-title-md text-title-md">4</span>
<div>
<h2 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Payment Methods</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Select an encrypted payment option</p>
</div>
</div>
<div class="flex items-center gap-1 text-primary">
<span class="material-symbols-outlined text-[18px]">verified</span>
<span class="font-label-caps text-label-caps uppercase">PCI-DSS Level 1</span>
</div>
</div>
<div class="p-space-md md:p-space-lg space-y-4">
<!-- Apple Pay Option -->
<div class="border border-primary p-4 bg-surface-container-lowest hover:bg-surface-container-low transition-colors">
<label class="flex items-center justify-between cursor-pointer">
<div class="flex items-center gap-3">
<input class="w-4 h-4 text-primary border-primary focus:ring-0" name="payment_method" type="radio" value="apple_pay"/>
<span class="font-title-md text-title-md uppercase tracking-wider text-primary">Apple Pay</span>
</div>
<div class="flex items-center gap-2">
<span class="border border-primary px-3 py-1 font-label-caps text-label-caps uppercase font-bold bg-primary text-on-primary">Pay</span>
<span class="font-label-tag text-label-tag uppercase text-on-surface-variant">1-Click Touch ID</span>
</div>
</label>
</div>
<!-- Credit / Debit Cards Option (Active Form) -->
<div class="border-2 border-primary bg-surface-container-lowest">
<label class="flex items-center justify-between p-4 cursor-pointer border-b border-primary/20 bg-surface-container-low">
<div class="flex items-center gap-3">
<input checked="" class="w-4 h-4 text-primary border-primary focus:ring-0" name="payment_method" type="radio" value="card"/>
<div>
<span class="font-title-md text-title-md uppercase tracking-wider text-primary">Credit or Debit Card</span>
<p class="font-body-sm text-body-sm text-on-surface-variant">Visa, Mastercard, American Express</p>
</div>
</div>
<div class="flex items-center gap-2">
<span class="border border-outline px-2 py-0.5 text-[10px] font-bold tracking-widest">VISA</span>
<span class="border border-outline px-2 py-0.5 text-[10px] font-bold tracking-widest">MC</span>
<span class="border border-outline px-2 py-0.5 text-[10px] font-bold tracking-widest">AMEX</span>
</div>
</label>
<!-- Card Input Details -->
<div class="p-4 space-y-4">
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">Card Number *</label>
<div class="relative">
<input class="w-full h-12 border border-outline pl-3 pr-10 py-2 text-primary font-body-md focus:outline-none focus:border-primary bg-surface-container-lowest" placeholder="4532 •••• •••• 8921" type="text"/>
<span class="material-symbols-outlined absolute right-3 top-3 text-outline">credit_card</span>
</div>
</div>
<div class="grid grid-cols-2 gap-4">
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">Expiration Date *</label>
<input class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md focus:outline-none focus:border-primary bg-surface-container-lowest" placeholder="MM / YY" type="text"/>
</div>
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">CVV / Security Code *</label>
<div class="relative">
<input class="w-full h-12 border border-outline pl-3 pr-10 py-2 text-primary font-body-md focus:outline-none focus:border-primary bg-surface-container-lowest" maxlength="4" placeholder="123" type="password"/>
<span class="material-symbols-outlined absolute right-3 top-3 text-outline">help_outline</span>
</div>
</div>
</div>
<div>
<label class="block font-label-caps text-label-caps uppercase text-on-surface mb-1">Cardholder Name (as shown on card) *</label>
<input class="w-full h-12 border border-outline px-3 py-2 text-primary font-body-md focus:outline-none focus:border-primary uppercase bg-surface-container-lowest" placeholder="FATIMA AL MANSOORI" type="text"/>
</div>
</div>
</div>
<!-- Buy Now Pay Later: Tabby & Tamara -->
<div class="border border-outline-variant p-4 bg-surface-container-lowest hover:border-primary transition-colors">
<label class="flex items-center justify-between cursor-pointer">
<div class="flex items-center gap-3">
<input class="w-4 h-4 text-primary border-primary focus:ring-0" name="payment_method" type="radio" value="tabby"/>
<div>
<span class="font-title-md text-title-md uppercase tracking-wider text-primary">Tabby (Split into 4)</span>
<p class="font-body-sm text-body-sm text-on-surface-variant">Pay 4 interest-free payments of AED 176.25</p>
</div>
</div>
<span class="border border-primary px-2.5 py-1 font-label-caps text-label-caps font-bold bg-[#3EEDB4] text-primary">tabby</span>
</label>
</div>
<div class="border border-outline-variant p-4 bg-surface-container-lowest hover:border-primary transition-colors">
<label class="flex items-center justify-between cursor-pointer">
<div class="flex items-center gap-3">
<input class="w-4 h-4 text-primary border-primary focus:ring-0" name="payment_method" type="radio" value="tamara"/>
<div>
<span class="font-title-md text-title-md uppercase tracking-wider text-primary">Tamara (Split in 4)</span>
<p class="font-body-sm text-body-sm text-on-surface-variant">No interest, no late fees. Sharia-compliant</p>
</div>
</div>
<span class="border border-primary px-2.5 py-1 font-label-caps text-label-caps font-bold bg-[#FF8E5E] text-on-primary">tamara</span>
</label>
</div>
<!-- Cash on Delivery -->
<div class="border border-outline-variant p-4 bg-surface-container-lowest hover:border-primary transition-colors">
<label class="flex items-center justify-between cursor-pointer">
<div class="flex items-center gap-3">
<input class="w-4 h-4 text-primary border-primary focus:ring-0" name="payment_method" type="radio" value="cod"/>
<div>
<span class="font-title-md text-title-md uppercase tracking-wider text-primary">Cash on Delivery (COD)</span>
<p class="font-body-sm text-body-sm text-on-surface-variant">Pay in cash to courier driver upon receipt (AED 20 surcharge applies)</p>
</div>
</div>
<span class="material-symbols-outlined text-outline">payments</span>
</label>
</div>
<!-- Sephora Gift Card & Beauty Pass Points Input -->
<div class="pt-space-sm border-t border-primary/10">
<div class="bg-surface-container-low p-4 border border-outline-variant">
<label class="block font-title-md text-title-md uppercase tracking-wider text-primary mb-2">Redeem Sephora Gift Card or Beauty Pass Voucher</label>
<div class="flex gap-2">
<input class="flex-grow h-12 border border-outline px-3 py-2 text-primary font-body-md focus:outline-none focus:border-primary bg-surface-container-lowest" placeholder="Enter 16-digit Gift Card number / Voucher PIN" type="text"/>
<button class="px-6 h-12 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors" type="button">
                    Redeem
                  </button>
</div>
</div>
</div>
</div>
</section>
</div>
<!-- ================= RIGHT COLUMN: ORDER SUMMARY SIDEBAR (4 Cols - Sticky) ================= -->
<div class="lg:col-span-5 xl:col-span-4 sticky top-28 space-y-space-md">
<!-- Cart Overview Card -->
<div class="border-2 border-primary bg-surface-container-lowest">
<!-- Summary Header -->
<div class="p-space-md border-b border-primary flex items-center justify-between bg-surface-container-lowest">
<h3 class="font-headline-sm text-headline-sm uppercase tracking-wide text-primary">Order Summary</h3>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant font-bold">{{ $items->sum('quantity') }} Items</span>
</div>
<!-- Product Basket List Preview -->
<div class="divide-y divide-primary/10">
@foreach($items as $item)
<div class="p-4 flex gap-4 items-center">
<div class="w-20 h-20 bg-surface-container-low border border-outline-variant flex-shrink-0 flex items-center justify-center p-1">
<img class="w-full h-full object-contain" alt="{{ $item->product->name }}" src="{{ asset($item->product->first_image) }}"/>
</div>
<div class="flex-grow">
<span class="font-label-tag text-label-tag uppercase tracking-widest text-on-surface-variant">{{ $item->product->brand?->name }}</span>
<h4 class="font-title-md text-body-md font-bold text-primary leading-tight">{{ $item->product->name }}</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Qty: {{ $item->quantity }}{{ $item->shade_name ? ' • ' . $item->shade_name : '' }}</p>
<p class="font-price-aed-md text-price-aed-md text-primary mt-1">AED {{ number_format($item->lineTotal(), 2) }}</p>
</div>
</div>
@endforeach
</div>

<div class="p-4 border-t border-b border-primary bg-surface-container-low">
<label class="block font-label-caps text-label-caps uppercase text-primary mb-1.5 tracking-wider">Promo Code or Beauty Pass Voucher</label>
<div class="flex gap-2">
<input class="flex-grow h-11 border border-outline px-3 py-2 text-primary font-body-md uppercase focus:outline-none focus:border-primary bg-surface-container-lowest" placeholder="e.g. VIPGOLD" type="text" id="promo-code-input" name="promo_code" value="{{ $appliedCoupon }}"/>
<button class="px-5 h-11 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider hover:bg-surface-container-lowest hover:text-primary border border-primary transition-colors" type="button" id="promo-apply-btn">
                Apply
              </button>
</div>
<p class="hidden mt-2 font-body-sm text-body-sm" id="promo-feedback"></p>
</div>
<!-- Financial Calculation Breakdown -->
<div class="p-space-md space-y-3">
<div class="flex justify-between font-body-md text-body-md">
<span class="text-on-surface-variant">Subtotal</span>
<span class="font-bold text-primary">AED {{ number_format($subtotal, 2) }}</span>
</div>
@if ($discount > 0)
<div class="flex justify-between font-body-md text-body-md" id="discount-row">
<span class="text-on-surface-variant">Promo ({{ $appliedCoupon }})</span>
<span class="font-bold text-secondary">-AED {{ number_format($discount, 2) }}</span>
</div>
@endif
<div class="flex justify-between font-body-md text-body-md">
<span class="text-on-surface-variant">Standard Delivery (UAE)</span>
<span class="font-bold text-secondary uppercase tracking-wider">{{ $shippingFee == 0 ? 'FREE' : 'AED ' . number_format($shippingFee, 2) }}</span>
</div>
<div class="flex justify-between font-body-md text-body-md">
<span class="text-on-surface-variant">Delivery</span>
<span class="text-on-surface-variant">{{ $shippingFee == 0 ? 'FREE' : 'AED ' . number_format($shippingFee, 2) }}</span>
</div>
<div class="border-t border-primary/20 pt-3 flex justify-between items-baseline">
<div>
<span class="font-title-lg text-title-lg uppercase tracking-wider text-primary block">Total</span>
<span class="font-label-caps text-label-caps text-on-surface-variant">All taxes and duties included</span>
</div>
<div class="text-right">
<span class="font-price-aed-lg text-price-aed-lg text-primary" id="checkout-total">AED {{ number_format($total, 2) }}</span>
</div>
</div>
<!-- Loyalty Points Banner -->
<div class="p-3 bg-surface-container-low border border-primary flex items-center gap-3 mt-2">
<span class="material-symbols-outlined text-secondary text-[20px]">stars</span>
<p class="font-label-caps text-label-caps text-primary tracking-wider uppercase">
<span class="font-bold text-secondary">+{{ (int) floor($total) }} BEAUTY PASS POINTS</span> WILL BE CREDITED
              </p>
</div>
<!-- Primary Checkout CTA -->
<div class="pt-2">
<button class="w-full h-14 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-[0.2em] font-bold border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all duration-200 flex items-center justify-center gap-3" type="submit">
<span class="material-symbols-outlined text-[20px]">lock</span>
<span>Complete Purchase</span>
</button>
</div>
<!-- Security Assurance Notes -->
<div class="pt-3 border-t border-primary/10 space-y-2">
<div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
<span class="material-symbols-outlined text-[16px] text-primary">verified</span>
<span>100% Authentic Brand Guarantee</span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
<span class="material-symbols-outlined text-[16px] text-primary">assignment_return</span>
<span>Complimentary 14-Day Boutique Returns</span>
</div>
<div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
<span class="material-symbols-outlined text-[16px] text-primary">security</span>
<span>Official Sephora UAE Authorized Checkout</span>
</div>
</div>
</div>
</div>
<!-- Need Help Concierge Card -->
<div class="border border-outline-variant p-4 bg-surface-container-lowest">
<div class="flex items-center justify-between">
<div>
<h4 class="font-title-md text-body-md font-bold text-primary uppercase tracking-wider">Need Help?</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Our prestige beauty advisors are available 10 AM – 10 PM</p>
</div>
<a class="font-label-caps text-label-caps uppercase tracking-wider text-primary underline font-bold" href="mailto:customercare@sephora.ae">Contact us</a>
</div>
</div>
</div>
</div>
</main>
@endsection
