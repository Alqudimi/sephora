@extends('layouts.app')

@section('title', 'Contact Us | SEPHORA Middle East - Client Concierge')
@section('body_class', 'bg-background text-on-surface antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col')

@section('head')
<style>
.material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      display: inline-block;
      vertical-align: middle;
      line-height: 1;
    }
    /* Architectural Hairline Crisp Rules */
    * {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    input::placeholder, textarea::placeholder {
      color: #7e7576;
      font-family: 'Manrope', sans-serif;
      font-size: 13px;
    }
</style>
@endsection

@section('content')
<!-- 1. Top Announcement Bar -->
<div class="w-full bg-primary text-on-primary py-2 px-margin-mobile md:px-margin text-center tracking-widest text-[11px] font-bold font-label-caps uppercase flex items-center justify-center gap-2">
<span>WANT TO TURN HEADS? YOUR SIGNATURE SCENT STARTS HERE. DISCOVER THE COLLECTION AND LAYER WITHOUT LIMITS -</span>
<a class="underline hover:opacity-80 transition-opacity" href="/shop/bestsellers">SHOP NOW →</a>
</div>
<!-- 2. Official Desktop Navigation & Header (TopNavBar Anchor Implementation) -->
<header class="w-full bg-surface-container-lowest border-b border-outline-variant">
<div class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- Main Upper Nav Bar -->
<div class="flex items-center justify-between h-20 gap-8">
<!-- Search Bar (on_left per Shared Component JSON) -->
<div class="flex-1 max-w-md hidden md:block">
<div class="relative flex items-center">
<input class="w-full h-11 pl-11 pr-4 bg-surface rounded-full border border-outline-variant focus:border-primary focus:ring-0 text-body-sm font-body-sm transition-all" placeholder="Search FAQs, order status, contact..." type="text"/>
<span class="material-symbols-outlined absolute left-3.5 text-on-surface-variant pointer-events-none text-[20px]">
              search
            </span>
</div>
</div>
<!-- Sephora Brand Logo Center -->
<div class="flex justify-center items-center flex-1 md:flex-initial">
<a class="font-display-hero text-headline-md tracking-widest uppercase font-bold text-primary" href="/">
            SEPHORA
          </a>
</div>
<!-- Trailing Icon Actions Cluster: Stores, UAE Flag, Sign In, Wishlist, Bag -->
<div class="flex items-center justify-end gap-6 flex-1 text-primary">
<!-- Stores & Services -->
<a class="hidden lg:flex items-center gap-1.5 text-on-surface hover:text-primary transition-colors cursor-pointer" href="/stores">
<span class="material-symbols-outlined text-[20px]">location_on</span>
<span class="font-label-caps text-label-caps uppercase font-bold tracking-wider">STORES &amp; SERVICES</span>
</a>
<!-- UAE Country & Currency Selector -->
<div class="hidden sm:flex items-center gap-1.5 cursor-pointer py-1 px-2 border border-outline-variant rounded hover:border-primary transition-colors">
<div class="w-4 h-3 flex flex-col justify-between overflow-hidden shadow-xs border border-surface-dim">
<span class="bg-[#00732f] h-1 w-full block"></span>
<span class="bg-[#ffffff] h-1 w-full block"></span>
<span class="bg-[#000000] h-1 w-full block"></span>
</div>
<span class="font-label-caps text-[10px] font-bold text-on-surface">UAE / AED</span>
</div>
<!-- Account / Sign In -->
<a class="flex items-center gap-1 text-on-surface hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined text-[22px]">person</span>
<span class="hidden xl:inline font-label-caps text-label-caps uppercase font-bold">SIGN IN</span>
</a>
<!-- Favorites / Wishlist -->
<a class="flex items-center text-on-surface hover:text-primary transition-colors relative" href="/my-account/wishlist" title="Wishlist">
<span class="material-symbols-outlined text-[22px]">favorite</span>
</a>
<!-- Bag with Counter -->
<a class="flex items-center text-on-surface hover:text-primary transition-colors relative" href="/cart" title="Shopping Bag">
<span class="material-symbols-outlined text-[22px]">shopping_bag</span>
<span class="absolute -top-1.5 -right-2 bg-secondary text-on-secondary text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center font-body-sm" data-bag-count>@if(!empty($bagCount)){{ $bagCount }}@else 0 @endif</span></a>
</div>
</div>
<!-- Secondary Luxury Category Navigation Bar -->
<nav class="hidden md:flex items-center justify-between border-t border-outline-variant py-3 overflow-x-auto text-[13px] tracking-wider uppercase font-body-sm font-semibold">
<a class="text-secondary hover:text-secondary-container transition-colors whitespace-nowrap" href="/shop/gifts">The Holiday Collection</a>
<a class="flex items-center gap-1.5 text-primary hover:text-secondary transition-colors whitespace-nowrap" href="#">
<span>Beauty Offers</span>
<span class="bg-secondary text-on-secondary font-bold text-[9px] px-1.5 py-0.5 rounded-none tracking-widest">SALE</span>
</a>
<a class="text-on-surface hover:text-primary transition-colors whitespace-nowrap" href="/shop/new">New</a>
<a class="text-on-surface hover:text-primary transition-colors whitespace-nowrap" href="/shop/makeup">Makeup</a>
<a class="text-on-surface hover:text-primary transition-colors whitespace-nowrap" href="/shop/fragrance">Fragrance</a>
<a class="text-on-surface hover:text-primary transition-colors whitespace-nowrap" href="/shop/skincare">Skincare</a>
<a class="text-on-surface hover:text-primary transition-colors whitespace-nowrap" href="/shop/bath-body">Bath &amp; Body</a>
<a class="text-on-surface hover:text-primary transition-colors whitespace-nowrap" href="/shop/hair">Hair</a>
<a class="text-on-surface hover:text-primary transition-colors whitespace-nowrap" href="/brands/sephora-collection">Sephora Collection</a>
<a class="text-on-surface hover:text-primary transition-colors whitespace-nowrap" href="/brands">Brands</a>
<a class="text-on-surface hover:text-primary transition-colors whitespace-nowrap" href="/shop/bestsellers">Best Sellers</a>
</nav>
</div>
</header>
<!-- 3. Breadcrumbs & Account Sub-navigation Banner -->
<section class="w-full bg-surface-container-low border-b border-outline-variant">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-4">
<!-- Breadcrumb Path -->
<nav class="flex items-center gap-2 text-body-sm font-body-sm text-on-surface-variant mb-3">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span class="text-[10px] text-outline">/</span>
<a class="hover:text-primary transition-colors" href="/my-account">My Account</a>
<span class="text-[10px] text-outline">/</span>
<span class="font-bold text-primary">Contact Us</span>
</nav>
<!-- Account Navigation Pills -->
<div class="flex items-center gap-3 overflow-x-auto pb-1 text-body-sm font-body-sm">
<a class="px-4 py-2 bg-surface-container-lowest border border-outline-variant hover:border-primary text-on-surface transition-colors whitespace-nowrap font-medium" href="/my-account">
          My Account
        </a>
<a class="px-4 py-2 bg-surface-container-lowest border border-outline-variant hover:border-primary text-on-surface transition-colors whitespace-nowrap font-medium" href="#">
          MY SEPHORA
        </a>
<a class="px-4 py-2 bg-surface-container-lowest border border-outline-variant hover:border-primary text-on-surface transition-colors whitespace-nowrap font-medium" href="#">
          Settings
        </a>
<a class="px-4 py-2 bg-surface-container-lowest border border-outline-variant hover:border-primary text-on-surface transition-colors whitespace-nowrap font-medium" href="/faq">
          Help &amp; FAQs
        </a>
<!-- Active Tab with black underline/solid indicator -->
<a class="px-4 py-2 bg-primary text-on-primary border border-primary font-bold tracking-wider transition-colors whitespace-nowrap" href="/contact-us">
          Contact Us
        </a>
</div>
</div>
</section>
<!-- Main Canvas Container -->
<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-10 flex-1">
<!-- 4. Page Header & Live Advisory Alert -->
<header class="mb-10 text-center max-w-3xl mx-auto">
<span class="inline-block font-label-caps text-label-caps font-bold tracking-widest text-on-surface-variant uppercase mb-2">
        SEPHORA CLIENT CONCIERGE &amp; SUPPORT
      </span>
<h1 class="font-headline-lg text-headline-lg font-bold text-primary tracking-tight mb-4">
        Contact Us
      </h1>
<p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto mb-6">
        Our Beauty Advisors are dedicated to curating an effortless luxury shopping experience. Reach out anytime for beauty consultations, order tracking, or regional assistance.
      </p>
<!-- Live Volume Advisory Notice Banner -->
<div class="p-4 bg-surface-container-lowest border border-outline-variant text-left flex items-start gap-3.5 shadow-none">
<span class="material-symbols-outlined text-secondary text-[22px] flex-shrink-0 mt-0.5">
          info
        </span>
<div class="font-body-sm text-body-sm text-on-surface">
<strong class="font-bold block text-primary mb-0.5">Festive Season Service Notice:</strong>
          Due to a high volume of orders during the festive season, there may be slight delays in our usual response time. We appreciate your patience and understanding.
        </div>
</div>
</header>
<!-- 5. Main Content Area - Split Two-Column Architectural Layout -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- COLUMN A: Interactive Contact / Inquiry Form (7 Columns) -->
<section class="lg:col-span-7 bg-surface-container-lowest border border-outline-variant p-6 sm:p-10">
<div class="border-b border-outline-variant pb-6 mb-8">
<div class="flex items-center justify-between mb-1">
<h2 class="font-headline-sm text-headline-sm font-bold text-primary">
              Send Us a Message
            </h2>
<span class="font-label-tag text-label-tag text-on-surface-variant uppercase tracking-widest">
              DIRECT DISPATCH
            </span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant">
            Fill in your details below and our customer care team will respond within 24 hours.
          </p>
</div>
<form class="space-y-6" id="contact-form" onsubmit="event.preventDefault(); showConfirmation();">
<!-- Inquiry Category Dropdown -->
<div>
<label class="block font-label-caps text-label-caps uppercase font-bold text-on-surface mb-2" for="topic">
              Inquiry Topic <span class="text-secondary">*</span>
</label>
<div class="relative">
<select class="w-full h-12 bg-surface-container-lowest border border-outline-variant rounded-none px-4 text-body-md font-body-md text-on-surface focus:border-primary focus:ring-0 cursor-pointer appearance-none" id="topic" required="">
<option disabled="" selected="" value="">Select an inquiry topic...</option>
<option value="order">Order Status &amp; Tracking</option>
<option value="delivery">Delivery &amp; Shipping Information</option>
<option value="returns">Returns &amp; Refunds</option>
<option value="loyalty">Beauty Pass &amp; Loyalty Points</option>
<option value="booking">In-Store Beauty Studio Booking</option>
<option value="product">Product Consultation &amp; Ingredients</option>
<option value="general">General Client Inquiries</option>
</select>
<span class="material-symbols-outlined absolute right-4 top-3 text-on-surface-variant pointer-events-none">
                expand_more
              </span>
</div>
</div>
<!-- Name & Email Row -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
<div>
<label class="block font-label-caps text-label-caps uppercase font-bold text-on-surface mb-2" for="full-name">
                Full Name <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 bg-surface-container-lowest border border-outline-variant rounded-none px-4 text-body-md font-body-md text-on-surface focus:border-primary focus:ring-0" id="full-name" placeholder="e.g. Layla Al-Mansoor" required="" type="text"/>
</div>
<div>
<label class="block font-label-caps text-label-caps uppercase font-bold text-on-surface mb-2" for="email">
                Email Address <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 bg-surface-container-lowest border border-outline-variant rounded-none px-4 text-body-md font-body-md text-on-surface focus:border-primary focus:ring-0" id="email" placeholder="client@luxury.ae" required="" type="email"/>
<span class="block text-[11px] text-on-surface-variant mt-1 font-body-sm">
                Order confirmation email if applicable
              </span>
</div>
</div>
<!-- Phone Number & Order Number -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
<div>
<label class="block font-label-caps text-label-caps uppercase font-bold text-on-surface mb-2" for="phone">
                Phone Number <span class="text-secondary">*</span>
</label>
<div class="flex">
<span class="h-12 inline-flex items-center px-3.5 bg-surface-container-high border border-r-0 border-outline-variant text-body-sm font-bold text-on-surface">
                  +971
                </span>
<input class="flex-1 h-12 bg-surface-container-lowest border border-outline-variant rounded-none px-4 text-body-md font-body-md text-on-surface focus:border-primary focus:ring-0" id="phone" placeholder="50 123 4567" required="" type="tel"/>
</div>
</div>
<div>
<label class="block font-label-caps text-label-caps uppercase font-bold text-on-surface mb-2" for="order-num">
                Order Number <span class="text-outline-variant font-normal">(Optional)</span>
</label>
<input class="w-full h-12 bg-surface-container-lowest border border-outline-variant rounded-none px-4 text-body-md font-body-md text-on-surface focus:border-primary focus:ring-0 uppercase tracking-wider" id="order-num" placeholder="e.g. SEPH-AE-889421" type="text"/>
</div>
</div>
<!-- Subject Line -->
<div>
<label class="block font-label-caps text-label-caps uppercase font-bold text-on-surface mb-2" for="subject">
              Subject <span class="text-secondary">*</span>
</label>
<input class="w-full h-12 bg-surface-container-lowest border border-outline-variant rounded-none px-4 text-body-md font-body-md text-on-surface focus:border-primary focus:ring-0" id="subject" placeholder="Summary of your request" required="" type="text"/>
</div>
<!-- Message Textarea -->
<div>
<label class="block font-label-caps text-label-caps uppercase font-bold text-on-surface mb-2" for="message">
              Message <span class="text-secondary">*</span>
</label>
<textarea class="w-full bg-surface-container-lowest border border-outline-variant rounded-none p-4 text-body-md font-body-md text-on-surface focus:border-primary focus:ring-0" id="message" placeholder="Please describe your inquiry in detail. Include any relevant reference codes or product names..." required="" rows="5"></textarea>
</div>
<!-- File Attachment (Luxury Museum-grade upload area) -->
<div>
<span class="block font-label-caps text-label-caps uppercase font-bold text-on-surface mb-2">
              Attachments <span class="text-outline-variant font-normal">(Optional)</span>
</span>
<label class="flex flex-col items-center justify-center w-full h-24 border border-dashed border-outline hover:border-primary cursor-pointer bg-surface-container-lowest transition-colors px-4">
<div class="flex items-center gap-2 text-on-surface-variant">
<span class="material-symbols-outlined text-[24px]">attach_file</span>
<span class="font-body-sm text-body-sm font-semibold text-primary">Upload photos or receipts</span>
<span class="text-outline-variant text-[11px] font-body-sm">(Max 5MB • JPG, PNG, PDF)</span>
</div>
<input class="hidden" type="file"/>
</label>
</div>
<!-- Submit CTA Button -->
<div class="pt-2">
<button class="w-full h-14 bg-primary text-on-primary font-label-caps text-label-caps tracking-widest uppercase font-bold hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all duration-200 flex items-center justify-center gap-2 group" type="submit">
<span>SUBMIT MESSAGE</span>
<span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">
                arrow_forward
              </span>
</button>
</div>
<div class="hidden p-4 bg-primary text-on-primary text-body-sm font-body-sm text-center" id="confirmation-toast">
            ✓ Thank you. Your message has been received by our Dubai Concierge Team. Expect a response within 24 hours.
          </div>
</form>
</section>
<!-- COLUMN B: Regional Contact Hub & Direct Support Channels (5 Columns) -->
<aside class="lg:col-span-5 space-y-6">
<!-- Operating Hours Banner -->
<div class="bg-primary text-on-primary p-6 border border-primary">
<div class="flex items-center gap-3 mb-2">
<span class="material-symbols-outlined text-[24px] text-tertiary-fixed">
              schedule
            </span>
<h3 class="font-title-lg text-title-lg tracking-wide uppercase font-bold">
              Call Us
            </h3>
</div>
<p class="font-body-md text-body-md text-surface-container-high">
            Call us between 10:00 am - 10:00 pm (GST) Daily
          </p>
<p class="font-body-sm text-body-sm text-on-primary-container mt-1">
            Dedicated multilingual advisors: English &amp; Arabic
          </p>
</div>
<!-- United Arab Emirates Toll-Free (Highlighted Premier Card) -->
<div class="bg-surface-container-lowest border-2 border-primary p-6 relative">
<div class="flex items-start justify-between">
<div>
<span class="bg-primary text-on-primary font-label-caps text-[9px] font-bold px-2 py-0.5 uppercase tracking-widest inline-block mb-2">
                UAE PRIORITY LINE
              </span>
<h4 class="font-title-md text-title-md font-bold text-primary">
                United Arab Emirates (Toll Free)
              </h4>
<a class="font-headline-sm text-headline-sm font-bold text-primary tracking-wider hover:text-secondary block mt-1" href="tel:8007374672">
                800 7374672
              </a>
</div>
<a class="w-12 h-12 bg-primary text-on-primary flex items-center justify-center hover:bg-secondary transition-colors" href="tel:8007374672" title="Call UAE Support">
<span class="material-symbols-outlined text-[20px]">call</span>
</a>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-3 border-t border-outline-variant pt-3">
            Toll-free across all Emirates (Dubai, Abu Dhabi, Sharjah, Ajman, RAK, Fujairah, UAQ).
          </p>
</div>
<!-- GCC Regional Direct Numbers Card Grid -->
<div class="bg-surface-container-lowest border border-outline-variant p-6">
<div class="flex items-center justify-between border-b border-outline-variant pb-3 mb-4">
<h4 class="font-title-md text-title-md font-bold text-primary uppercase tracking-wide">
              Contact Numbers (GCC Regional)
            </h4>
<span class="material-symbols-outlined text-outline text-[20px]">public</span>
</div>
<div class="space-y-3.5 divide-y divide-surface-container-high font-body-sm">
<!-- Saudi Arabia -->
<div class="flex items-center justify-between pt-2">
<div>
<span class="font-bold text-primary block">Saudi Arabia</span>
<span class="text-on-surface-variant text-body-sm">+966 11 479 7382</span>
</div>
<a class="text-primary hover:text-secondary p-1" href="tel:+966114797382">
<span class="material-symbols-outlined text-[18px]">call</span>
</a>
</div>
<!-- Kuwait -->
<div class="flex items-center justify-between pt-3">
<div>
<span class="font-bold text-primary block">Kuwait</span>
<span class="text-on-surface-variant text-body-sm">+965 2220 8178</span>
</div>
<a class="text-primary hover:text-secondary p-1" href="tel:+96522208178">
<span class="material-symbols-outlined text-[18px]">call</span>
</a>
</div>
<!-- Bahrain -->
<div class="flex items-center justify-between pt-3">
<div>
<span class="font-bold text-primary block">Bahrain</span>
<span class="text-on-surface-variant text-body-sm">+973 1663 9148</span>
</div>
<a class="text-primary hover:text-secondary p-1" href="tel:+97316639148">
<span class="material-symbols-outlined text-[18px]">call</span>
</a>
</div>
<!-- Oman -->
<div class="flex items-center justify-between pt-3">
<div>
<span class="font-bold text-primary block">Oman</span>
<span class="text-on-surface-variant text-body-sm">+968 2103 0711</span>
</div>
<a class="text-primary hover:text-secondary p-1" href="tel:+96821030711">
<span class="material-symbols-outlined text-[18px]">call</span>
</a>
</div>
<!-- Qatar -->
<div class="flex items-center justify-between pt-3">
<div>
<span class="font-bold text-primary block">Qatar</span>
<span class="text-on-surface-variant text-body-sm">+974 4419 6648</span>
</div>
<a class="text-primary hover:text-secondary p-1" href="tel:+97444196648">
<span class="material-symbols-outlined text-[18px]">call</span>
</a>
</div>
</div>
</div>
<!-- Direct Email Card with One-Click Copy -->
<div class="bg-surface-container-lowest border border-outline-variant p-6">
<div class="flex items-start justify-between mb-3">
<div>
<span class="font-label-tag text-label-tag text-on-surface-variant uppercase tracking-widest block mb-1">
                DIRECT INBOX
              </span>
<h4 class="font-title-md text-title-md font-bold text-primary">
                Email us at
              </h4>
</div>
<span class="material-symbols-outlined text-outline text-[20px]">mail</span>
</div>
<div class="flex items-center justify-between bg-surface-container-low border border-outline-variant p-3 mt-2">
<span class="font-body-md text-body-md font-bold text-primary tracking-wide break-all" id="target-email">
              customercare@sephora.ae
            </span>
<button class="ml-3 px-3 py-1.5 bg-primary text-on-primary font-label-caps text-[10px] tracking-wider uppercase font-bold hover:bg-on-surface transition-colors flex-shrink-0" id="copy-btn" onclick="copyEmail()" type="button">
              COPY
            </button>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-2 flex items-center gap-1.5">
<span class="w-1.5 h-1.5 bg-green-600 rounded-full inline-block"></span>
            Average response within 12 hours
          </p>
</div>
<!-- Social Media Concierge Channels & Privacy Notice -->
<div class="bg-surface-container-lowest border border-outline-variant p-6">
<h4 class="font-title-md text-title-md font-bold text-primary uppercase tracking-wide mb-3">
            Follow Us &amp; Social Inquiries
          </h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            Connect with our Middle East beauty community for daily trend forecasts and quick DM support:
          </p>
<!-- Social Icons Cluster -->
<div class="flex items-center gap-3">
<a class="w-10 h-10 border border-outline-variant flex items-center justify-center text-primary hover:bg-primary hover:text-on-primary transition-colors" href="https://www.instagram.com/sephoramiddleeast/" target="_blank" title="Instagram">
<span class="font-body-sm font-bold text-xs">IG</span>
</a>
<a class="w-10 h-10 border border-outline-variant flex items-center justify-center text-primary hover:bg-primary hover:text-on-primary transition-colors" href="https://tiktok.com/@sephoramiddleeast" target="_blank" title="TikTok">
<span class="font-body-sm font-bold text-xs">TT</span>
</a>
<a class="w-10 h-10 border border-outline-variant flex items-center justify-center text-primary hover:bg-primary hover:text-on-primary transition-colors" href="https://www.snapchat.com/add/Sephoramesnaps" target="_blank" title="Snapchat">
<span class="font-body-sm font-bold text-xs">SC</span>
</a>
<a class="w-10 h-10 border border-outline-variant flex items-center justify-center text-primary hover:bg-primary hover:text-on-primary transition-colors" href="https://www.youtube.com/user/SEPHORAME" target="_blank" title="YouTube">
<span class="font-body-sm font-bold text-xs">YT</span>
</a>
<a class="w-10 h-10 border border-outline-variant flex items-center justify-center text-primary hover:bg-primary hover:text-on-primary transition-colors" href="https://www.facebook.com/sephoramiddleeast" target="_blank" title="Facebook">
<span class="font-body-sm font-bold text-xs">FB</span>
</a>
</div>
<!-- Data Privacy Link Box -->
<div class="mt-6 pt-4 border-t border-outline-variant flex items-center justify-between text-body-sm">
<span class="text-on-surface-variant">Read more about our</span>
<a class="font-bold text-primary underline hover:text-secondary uppercase tracking-wider text-xs" href="#">
              DATA PRIVACY
            </a>
</div>
</div>
</aside>
</div>
<!-- Store Experience Vitrine (Contextual In-Store Beauty Studio Anchor) -->
<section class="mt-14 border border-outline-variant bg-surface-container-lowest p-8 flex flex-col md:flex-row items-center gap-8">
<div class="w-full md:w-1/2 overflow-hidden border border-outline-variant">
<img class="w-full h-72 object-cover transition-transform duration-500 hover:scale-105" data-alt="A grand, high-fashion Sephora flagship store interior in Dubai featuring ultra-modern white and black illuminated beauty studio mirrors, rows of luxury prestige cosmetics and fragrances under brilliant gallery lighting. Elegant beauty advisors assist clients with personalized consultations in a spacious, opulent cosmetic boutique atmosphere." src="{{ asset('images/content/img_ff9118a61bf276d1.jpg') }}"/>
</div>
<div class="w-full md:w-1/2 space-y-4">
<span class="bg-primary text-on-primary font-label-caps text-[10px] font-bold px-2 py-0.5 uppercase tracking-widest inline-block">
          IN-STORE BEAUTY SERVICES
        </span>
<h3 class="font-headline-sm text-headline-sm font-bold text-primary">
          Prefer an In-Person Consultation?
        </h3>
<p class="font-body-md text-body-md text-on-surface-variant">
          Visit any of our 45+ retail flagships across Dubai Mall, Mall of the Emirates, Yas Mall Abu Dhabi, and beyond. Book bespoke 15-minute express touch-ups or comprehensive 60-minute full glam masterclasses with our Sephora Pro Artists.
        </p>
<div class="pt-2">
<a class="inline-flex items-center gap-2 px-6 py-3 border border-primary text-primary font-label-caps text-label-caps font-bold uppercase tracking-widest hover:bg-primary hover:text-on-primary transition-colors" href="/">
<span>FIND NEAREST STORE &amp; STUDIO</span>
<span class="material-symbols-outlined text-[16px]">location_on</span>
</a>
</div>
</div>
</section>
<!-- 6. Trust Badges Section -->
<section class="mt-14 pt-10 border-t border-outline-variant">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
<!-- Badge 1: Free Delivery -->
<div class="border border-outline-variant p-6 text-center bg-surface-container-lowest hover:border-primary transition-colors">
<span class="material-symbols-outlined text-[32px] text-primary mb-3">local_shipping</span>
<h4 class="font-title-md text-title-md font-bold text-primary mb-1">Free Delivery</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Over 250 AED across UAE</p>
</div>
<!-- Badge 2: 100% Authentic -->
<div class="border border-outline-variant p-6 text-center bg-surface-container-lowest hover:border-primary transition-colors">
<span class="material-symbols-outlined text-[32px] text-primary mb-3">verified</span>
<h4 class="font-title-md text-title-md font-bold text-primary mb-1">100% Authentic</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Direct luxury prestige brands</p>
</div>
<!-- Badge 3: Easy Returns -->
<div class="border border-outline-variant p-6 text-center bg-surface-container-lowest hover:border-primary transition-colors">
<span class="material-symbols-outlined text-[32px] text-primary mb-3">replay</span>
<h4 class="font-title-md text-title-md font-bold text-primary mb-1">Easy Returns</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">In any UAE store within 14 days</p>
</div>
<!-- Badge 4: Customer Care -->
<div class="border border-outline-variant p-6 text-center bg-surface-container-lowest hover:border-primary transition-colors">
<span class="material-symbols-outlined text-[32px] text-primary mb-3">loyalty</span>
<h4 class="font-title-md text-title-md font-bold text-primary mb-1">Beauty Pass</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Earn points on every dirham</p>
</div>
</div>
</section>
</main>
<!-- 7. Newsletter Subscription Bar -->
<section class="w-full bg-surface-container-high border-t border-b border-outline-variant py-8">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin flex flex-col md:flex-row items-center justify-between gap-6">
<div class="text-center md:text-left">
<h4 class="font-title-lg text-title-lg font-bold text-primary uppercase tracking-wide">
          Subscribe to the Sephora newsletter!
        </h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
          Receive exclusive VIP previews, beauty masterclasses invitations, and new drops.
        </p>
</div>
<form class="flex w-full md:w-auto max-w-md items-center gap-0" onsubmit="event.preventDefault(); alert('Subscribed to Sephora Newsletter.');" data-newsletter-form>
<input class="h-12 w-full md:w-72 bg-surface-container-lowest border border-outline-variant px-4 text-body-sm font-body-sm focus:border-primary focus:ring-0 rounded-none" placeholder="Enter your email address" required="" type="email"/>
<button class="h-12 px-6 bg-primary text-on-primary font-label-caps text-label-caps font-bold tracking-widest uppercase hover:bg-secondary transition-colors rounded-none flex-shrink-0" type="submit">
          SUBSCRIBE
        </button>
</form>
</div>
</section>
<!-- 8. Comprehensive Desktop Footer (Footer Anchor Implementation) -->
<footer class="w-full bg-primary text-on-primary pt-14 pb-8 border-t border-outline-variant">
<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- Footer Multi-Column Directory Grid -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-8 pb-12 border-b border-surface-container-low text-body-sm">
<!-- Col 1: Top Categories -->
<div>
<h5 class="font-title-md text-title-md uppercase tracking-wider text-on-primary font-bold mb-4">
            Top Categories
          </h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/shop/gifts">The Holiday Collection</a></li>
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
<h5 class="font-title-md text-title-md uppercase tracking-wider text-on-primary font-bold mb-4">
            Top Brands
          </h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">Huda Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Kayali</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Makeup by Mario</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Sol De Janeiro</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Patrick Ta</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Haus Labs</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Glow Recipe</a></li>
</ul>
</div>
<!-- Col 3: My Sephora -->
<div>
<h5 class="font-title-md text-title-md uppercase tracking-wider text-on-primary font-bold mb-4">
            My Sephora
          </h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/my-account">My Account</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/my-account">Beauty Pass Program</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Order Status</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">My Favorites</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Beauty Studio Bookings</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Personal Offers</a></li>
</ul>
</div>
<!-- Col 4: Help & FAQs -->
<div>
<h5 class="font-title-md text-title-md uppercase tracking-wider text-on-primary font-bold mb-4">
            Help &amp; FAQs
          </h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">Customer Service</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Track Order</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Delivery &amp; Returns</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Store Locator</a></li>
<li><a class="text-on-primary font-bold underline transition-colors" href="/contact-us">Contact Us</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Terms &amp; Conditions</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Privacy Policy</a></li>
</ul>
</div>
<!-- Col 5: About Sephora -->
<div>
<h5 class="font-title-md text-title-md uppercase tracking-wider text-on-primary font-bold mb-4">
            About Sephora
          </h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">About Sephora Middle East</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Sustainability &amp; Care</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Careers</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Download Mobile App</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Sephora Stand Up</a></li>
</ul>
</div>
</div>
<!-- Payment Gateways & Regional Credibility -->
<div class="py-8 flex flex-col md:flex-row items-center justify-between gap-6 border-b border-surface-container-low">
<div class="flex items-center gap-3">
<span class="font-label-caps text-[10px] uppercase font-bold text-on-primary-container tracking-wider">
            ACCEPTED PAYMENT METHODS:
          </span>
<div class="flex items-center gap-2">
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-bold text-[10px] tracking-tighter">VISA</span>
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-bold text-[10px] tracking-tighter">MASTERCARD</span>
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-bold text-[10px] tracking-tighter">APPLE PAY</span>
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-bold text-[10px] tracking-tighter">TABBY</span>
<span class="px-2 py-1 bg-surface-container-lowest text-primary font-bold text-[10px] tracking-tighter">TAMARA</span>
</div>
</div>
<div class="flex items-center gap-4 text-body-sm text-on-primary-container">
<span>Country: <strong class="text-on-primary">United Arab Emirates (UAE)</strong></span>
<span>•</span>
<span>Currency: <strong class="text-on-primary">AED</strong></span>
</div>
</div>
<!-- Copyright & Brand Legal Anchor -->
<div class="pt-6 flex flex-col md:flex-row items-center justify-between gap-4 text-[11px] font-body-sm text-on-primary-container">
<div class="flex items-center gap-3">
<span class="font-display-hero text-headline-sm uppercase tracking-widest text-on-primary font-bold">
            SEPHORA
          </span>
<span>© 2024 SEPHORA Middle East. All Rights Reserved. Pure Luxury &amp; Authentic Beauty.</span>
</div>
<p class="tracking-wider">
          Dubai • Abu Dhabi • Sharjah • Riyadh • Kuwait City • Manama • Muscat • Doha
        </p>
</div>
</div>
</footer>
<!-- Micro-interactions Script -->
<script>
    function copyEmail() {
      const email = document.getElementById('target-email').innerText.trim();
      navigator.clipboard.writeText(email).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerText = 'COPIED!';
        btn.classList.add('bg-secondary');
        setTimeout(() => {
          btn.innerText = 'COPY';
          btn.classList.remove('bg-secondary');
        }, 2000);
      });
    }

    function showConfirmation() {
      const toast = document.getElementById('confirmation-toast');
      toast.classList.remove('hidden');
      setTimeout(() => {
        toast.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }, 100);
    }
  </script>
@endsection

@push('scripts')
<script>
function copyEmail() {
      const email = document.getElementById('target-email').innerText.trim();
      navigator.clipboard.writeText(email).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerText = 'COPIED!';
        btn.classList.add('bg-secondary');
        setTimeout(() => {
          btn.innerText = 'COPY';
          btn.classList.remove('bg-secondary');
        }, 2000);
      });
    }

    function showConfirmation() {
      const toast = document.getElementById('confirmation-toast');
      toast.classList.remove('hidden');
      setTimeout(() => {
        toast.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }, 100);
    }
</script>
@endpush