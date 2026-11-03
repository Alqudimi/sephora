@extends('layouts.app')

@section('title', 'Good Girl Blush Eau de Parfum Gift Set - Carolina Herrera | SEPHORA Middle East')
@section('body_class', 'bg-background text-on-surface antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col font-body-md text-body-md')

@section('content')
<main class="flex-grow max-w-[1440px] mx-auto w-full px-margin-mobile md:px-margin-tablet lg:px-margin pt-4 pb-16">
<!-- 3. Breadcrumb Navigation -->
<nav aria-label="Breadcrumb" class="py-3 text-on-surface-variant font-body-sm text-body-sm flex items-center flex-wrap gap-2 mb-2">
<a class="hover:text-primary transition-colors" href="/">Home</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="/shop/fragrance">Fragrance</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="#">Gift Sets</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="#">For Her</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-semibold truncate max-w-xs md:max-w-none">Good Girl Blush Eau de Parfum Gift Set</span>
</nav>
<!-- 4. GWP Promo Banner -->
<div class="mb-8 border border-tertiary-fixed-dim bg-primary text-on-primary p-4 md:p-5 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-tertiary-fixed text-[28px] flex-shrink-0">featured_seasonal_and_gifts</span>
<div>
<span class="font-label-caps text-label-caps text-tertiary-fixed uppercase tracking-wider block mb-0.5">Unlock your gifts</span>
<p class="font-body-md text-body-md text-surface-bright">
<span class="font-bold">Explore. Stack. Repeat.</span> Enjoy a complimentary Fragrance Discovery Collection when you spend 650 AED or more on fragrance purchases online.
          </p>
</div>
</div>
<a class="inline-block border border-tertiary-fixed text-tertiary-fixed hover:bg-tertiary-fixed hover:text-primary font-label-caps text-label-caps uppercase px-4 py-2 text-center whitespace-nowrap transition-colors duration-200" href="#">
        Discover Gift
      </a>
</div>
<!-- 5. Main PDP Section (2-Column Architectural Layout) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 pb-16 border-b border-outline-variant">
<!-- Left Column: Product Gallery & Visuals (7 Cols) -->
<div class="lg:col-span-7 flex flex-col gap-6">
<div class="flex flex-col-reverse md:flex-row gap-4">
<!-- Thumbnail Vertical Stack -->
<div class="flex md:flex-col gap-3 overflow-x-auto md:overflow-visible no-scrollbar flex-shrink-0">
<button class="thumb-btn thumb-active w-18 h-18 md:w-20 md:h-20 border border-outline-variant bg-surface-container-lowest p-1 cursor-pointer transition-all duration-150" onclick="changeImage('{{ asset('images/content/img_d5515c46c027760d.jpg') }}', this)">
<img alt="Good Girl Blush Gift Set Packshot" class="w-full h-full object-cover" src="{{ asset('images/content/img_d5515c46c027760d.jpg') }}"/>
</button>
<button class="thumb-btn w-18 h-18 md:w-20 md:h-20 border border-outline-variant bg-surface-container-lowest p-1 cursor-pointer hover:border-primary transition-all duration-150" onclick="changeImage('{{ asset('images/content/img_04e46c9360601e2d.jpg') }}', this)">
<img alt="Editorial Karlie Kloss Campaign" class="w-full h-full object-cover" src="{{ asset('images/content/img_04e46c9360601e2d.jpg') }}"/>
</button>
<button class="thumb-btn w-18 h-18 md:w-20 md:h-20 border border-outline-variant bg-surface-container-lowest p-1 cursor-pointer hover:border-primary transition-all duration-150" onclick="changeImage('{{ asset('images/content/img_b19222a911ea8693.jpg') }}', this)">
<img alt="Product unpackaged view" class="w-full h-full object-cover" src="{{ asset('images/content/img_b19222a911ea8693.jpg') }}"/>
</button>
<button class="thumb-btn w-18 h-18 md:w-20 md:h-20 border border-outline-variant bg-surface-container-lowest p-1 cursor-pointer hover:border-primary transition-all duration-150" onclick="changeImage('{{ asset('images/content/img_e12faed332fa8e3b.jpg') }}', this)">
<img alt="Good Girl Blush Bottle Single" class="w-full h-full object-cover" src="{{ asset('images/content/img_e12faed332fa8e3b.jpg') }}"/>
</button>
</div>
<!-- Main Image Display Vitrine -->
<div class="relative flex-1 bg-surface-container-lowest border border-outline-variant overflow-hidden group">
<!-- Badges Cluster -->
<div class="absolute top-4 left-4 z-10 flex flex-col gap-1.5 items-start">
<span class="bg-secondary text-on-secondary font-label-caps text-label-caps px-2.5 py-1 tracking-wider uppercase">LIMITED EDITION</span>
<span class="bg-primary text-on-primary font-label-caps text-label-caps px-2.5 py-1 tracking-wider uppercase">EXCLUSIVE</span>
<span class="bg-surface text-on-surface border border-primary font-label-caps text-label-caps px-2 py-0.5 tracking-wider uppercase">NEW</span>
</div>
<!-- Main Packshot Image with Smooth Micro-Lift Zoom -->
<div class="aspect-square w-full flex items-center justify-center p-6 bg-surface-bright">
<img alt="Good Girl Blush Eau de Parfum Gift Set main showcase" class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-105" id="main-product-image" src="{{ asset('images/content/img_d5515c46c027760d.jpg') }}"/>
</div>
<!-- Quick zoom hint -->
<div class="absolute bottom-4 right-4 bg-surface-container-lowest/90 px-2.5 py-1.5 border border-outline-variant text-on-surface-variant font-label-caps text-label-caps flex items-center gap-1.5 pointer-events-none">
<span class="material-symbols-outlined text-[16px]">zoom_in</span>
<span>ROLL TO ZOOM</span>
</div>
</div>
</div>
<!-- Editorial Campaign Highlight Banner -->
<div class="border border-outline-variant bg-surface-container-low p-4 flex items-center gap-4">
<div class="w-20 h-20 md:w-24 md:h-24 flex-shrink-0 border border-outline-variant overflow-hidden">
<img alt="Karlie Kloss Good Girl Blush Campaign" class="w-full h-full object-cover" src="{{ asset('images/content/img_04e46c9360601e2d.jpg') }}"/>
</div>
<div>
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest block mb-1">Couture Campaign</span>
<h4 class="font-headline-sm text-headline-sm text-primary mb-1">Empowering &amp; Romantic</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">
              Karlie Kloss embodies the duality of modern womanhood with Good Girl Blush—soft yet fiercely confident.
            </p>
</div>
</div>
</div>
<!-- Right Column: Purchasing Details & Actions (5 Cols) -->
<div class="lg:col-span-5 flex flex-col">
<!-- Brand Link -->
<a class="font-label-caps text-label-caps tracking-widest uppercase text-on-surface-variant hover:text-primary transition-colors underline decoration-1 underline-offset-4 mb-2" href="/">
          CAROLINA HERRERA
        </a>
<!-- Product Title -->
<h1 class="font-headline-md text-headline-md text-primary mb-3">
          Good Girl Blush Eau de Parfum Gift Set
        </h1>
<!-- Reviews & Rating Cluster -->
<div class="flex items-center gap-3 pb-4 mb-5 border-b border-outline-variant">
<div class="flex items-center text-primary">
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[18px]">star_half</span>
<span class="font-bold text-sm ml-1.5">4.6</span>
</div>
<span class="text-outline-variant">|</span>
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary underline" href="#reviews">168 reviews</a>
<span class="text-outline-variant">|</span>
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary underline" href="#write-review">Write a review</a>
</div>
<!-- Pricing Cluster -->
<div class="mb-5">
<div class="flex items-baseline gap-3">
<span class="font-price-aed-lg text-price-aed-lg text-primary">AED 700.00</span>
<span class="font-body-md text-body-md line-through text-outline">Real value AED 1,000.00</span>
<span class="bg-secondary-fixed text-on-secondary-fixed-variant font-label-tag text-label-tag px-2 py-0.5 tracking-wider uppercase font-bold">
              SAVE 300 AED
            </span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant block mt-1">All taxes &amp; VAT included</span>
</div>
<!-- Buy Now Pay Later (Tabby & Tamara) Installments -->
<div class="bg-surface-container-low border border-outline-variant p-3.5 mb-6 space-y-2">
<div class="flex items-center justify-between text-body-sm font-body-sm">
<div class="flex items-center gap-2">
<span class="bg-emerald-600 text-white font-bold text-[9px] px-1.5 py-0.5 tracking-tight uppercase">tabby</span>
<span>or 4 interest-free payments of <strong>AED 175.00</strong></span>
</div>
<a class="text-outline hover:text-primary underline text-[11px]" href="#">Learn more</a>
</div>
<div class="h-[1px] bg-outline-variant/60"></div>
<div class="flex items-center justify-between text-body-sm font-body-sm">
<div class="flex items-center gap-2">
<span class="bg-orange-500 text-white font-bold text-[9px] px-1.5 py-0.5 tracking-tight uppercase">tamara</span>
<span>or split in 4 payments of <strong>AED 175.00</strong></span>
</div>
<a class="text-outline hover:text-primary underline text-[11px]" href="#">Learn more</a>
</div>
</div>
<!-- Variant / Size Selector -->
<div class="mb-6">
<div class="flex justify-between items-center mb-2">
<span class="font-label-caps text-label-caps text-primary uppercase">Size / Configuration</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">In Stock Online</span>
</div>
<button class="w-full text-left p-3 border-2 border-primary bg-surface-container-lowest font-body-md text-body-md flex items-center justify-between">
<span class="font-semibold text-primary">1 Size: 80ml EDP + 100ml Body Lotion + 10ml Travel Spray</span>
<span class="material-symbols-outlined text-primary text-[20px]">check</span>
</button>
</div>
<!-- Quantity & Add to Bag Actions -->
<div class="flex flex-col sm:flex-row gap-3 mb-4">
<!-- Quantity Counter -->
<div class="flex items-center border border-primary h-12 bg-surface-container-lowest justify-between px-3 w-full sm:w-32 flex-shrink-0">
<button aria-label="Decrease quantity" class="text-primary hover:text-secondary p-1" onclick="decrementQty()">
<span class="material-symbols-outlined text-[18px]">remove</span>
</button>
<span class="font-title-md text-title-md font-bold" id="qty-val">1</span>
<input id="qty-hidden" name="qty" type="hidden" value="1"/>
<button aria-label="Increase quantity" class="text-primary hover:text-secondary p-1" onclick="incrementQty()">
<span class="material-symbols-outlined text-[18px]">add</span>
</button>
</div>
<!-- Primary Add to Bag Button -->
<button class="flex-1 bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary font-label-caps text-label-caps uppercase h-12 flex items-center justify-center gap-2 tracking-widest transition-colors duration-200" data-add-to-bag="{{ $product->id }}" type="button">
<span class="material-symbols-outlined text-[20px]">shopping_bag</span>
<span>ADD TO BAG - AED {{ number_format($product->price, 2) }}</span>
</button>
<!-- Wishlist Button -->
<button class="h-12 w-12 border border-primary bg-surface-container-lowest hover:bg-primary hover:text-on-primary text-primary flex items-center justify-center flex-shrink-0 transition-colors duration-200" data-wishlist-toggle="{{ $product->id }}" title="Save to Wishlist" type="button">
<span class="material-symbols-outlined text-[22px]">favorite</span>
</button>
</div>
<!-- Beauty Pass Points Perk -->
<div class="border border-tertiary-fixed-dim bg-surface-container-low px-3.5 py-2.5 mb-6 flex items-center gap-2.5">
<span class="material-symbols-outlined text-tertiary-container text-[20px]">stars</span>
<span class="font-body-sm text-body-sm text-on-surface">
<strong>+70 Beauty Pass Points</strong> will be credited to your tier balance upon purchase.
          </span>
</div>
<!-- Fulfillment Perks List -->
<div class="border-t border-outline-variant pt-5 space-y-3 font-body-sm text-body-sm text-on-surface">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[20px]">local_shipping</span>
<span><strong>Free Standard Delivery</strong> (2-3 business days across UAE)</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[20px]">bolt</span>
<span><strong>Same-Day Express</strong> available in Dubai &amp; Abu Dhabi for orders before 2 PM</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[20px]">storefront</span>
<span><strong>Complimentary Click &amp; Collect</strong> ready in 2 Hours at The Dubai Mall &amp; 30+ stores</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary text-[20px]">redeem</span>
<span><strong>2 Free Deluxe Mini Samples</strong> carefully chosen with every order</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[20px]">featured_seasonal_and_gifts</span>
<span><strong>Complimentary Iconic Sephora</strong> black &amp; white striped gift packaging</span>
</div>
</div>
</div>
</div>
<!-- 6. Product Information Tabs / Accordions -->
<section class="py-12 border-b border-outline-variant">
<div class="max-w-4xl mx-auto">
<h2 class="font-headline-sm text-headline-sm uppercase tracking-widest text-primary text-center mb-8">Product Specifications &amp; Artistry</h2>
<div class="space-y-4">
<!-- Accordion 1: Description -->
<div class="border border-outline-variant bg-surface-container-lowest">
<button class="w-full p-5 text-left flex justify-between items-center font-title-lg text-title-lg uppercase tracking-wider" onclick="toggleAccordion('acc-desc')">
<span>Description</span>
<span class="material-symbols-outlined" id="acc-desc-icon">expand_more</span>
</button>
<div class="px-5 pb-5 pt-0 font-body-md text-body-md text-on-surface-variant space-y-3" id="acc-desc">
<p>
                A blooming reinvention of Carolina Herrera’s iconic fragrance, <strong>Good Girl Blush Eau de Parfum</strong> celebrates the multifaceted facets of modern femininity with its romantic floral bouquet and sensual double-dose vanilla base.
              </p>
<p>
                Encased in the signature stiletto bottle redesigned in a radiant, powdered blush pink with a sky-high gold stiletto heel, this opulent holiday gift set includes an 80ml Eau de Parfum, a rich perfumed body lotion, and a portable 10ml travel spray for effortless fragrance reapplication wherever glamour takes you.
              </p>
</div>
</div>
<!-- Accordion 2: Set Includes -->
<div class="border border-outline-variant bg-surface-container-lowest">
<button class="w-full p-5 text-left flex justify-between items-center font-title-lg text-title-lg uppercase tracking-wider" onclick="toggleAccordion('acc-set')">
<span>Set Includes</span>
<span class="material-symbols-outlined" id="acc-set-icon">expand_more</span>
</button>
<div class="hidden px-5 pb-5 pt-0 font-body-md text-body-md text-on-surface-variant" id="acc-set">
<ul class="list-disc list-inside space-y-2">
<li><strong>Good Girl Blush Eau de Parfum 80ml:</strong> The full-size statement stiletto flacon.</li>
<li><strong>Good Girl Blush Body Lotion 100ml:</strong> Ultra-hydrating, delicately perfumed body emulsion that softens and layers fragrance longevity.</li>
<li><strong>Good Girl Blush Travel Spray 10ml:</strong> Sleek handbag-ready stiletto travel flacon.</li>
</ul>
</div>
</div>
<!-- Accordion 3: Fragrance Family & Olfactory Notes -->
<div class="border border-outline-variant bg-surface-container-lowest">
<button class="w-full p-5 text-left flex justify-between items-center font-title-lg text-title-lg uppercase tracking-wider" onclick="toggleAccordion('acc-notes')">
<span>Fragrance Family &amp; Olfactory Pyramid</span>
<span class="material-symbols-outlined" id="acc-notes-icon">expand_more</span>
</button>
<div class="hidden px-5 pb-5 pt-0 font-body-md text-body-md text-on-surface-variant space-y-3" id="acc-notes">
<div>
<span class="font-bold text-primary">Fragrance Family:</span> Floral Amber
              </div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
<div class="p-3 bg-surface-bright border border-outline-variant">
<span class="font-label-caps text-label-caps text-primary uppercase block mb-1">Top Notes</span>
<p class="font-body-sm text-body-sm">Italian Bergamot, Bitter Almond &amp; Sparkling Mandarin</p>
</div>
<div class="p-3 bg-surface-bright border border-outline-variant">
<span class="font-label-caps text-label-caps text-primary uppercase block mb-1">Heart Notes</span>
<p class="font-body-sm text-body-sm">Exotic Ylang-Ylang, Romantic Peony &amp; Upcycled Rose Water</p>
</div>
<div class="p-3 bg-surface-bright border border-outline-variant">
<span class="font-label-caps text-label-caps text-primary uppercase block mb-1">Base Notes</span>
<p class="font-body-sm text-body-sm">Madagascar Bourbon Vanilla &amp; Roasted Tonka Bean</p>
</div>
</div>
</div>
</div>
<!-- Accordion 4: How To Use -->
<div class="border border-outline-variant bg-surface-container-lowest">
<button class="w-full p-5 text-left flex justify-between items-center font-title-lg text-title-lg uppercase tracking-wider" onclick="toggleAccordion('acc-use')">
<span>How To Use &amp; Layer</span>
<span class="material-symbols-outlined" id="acc-use-icon">expand_more</span>
</button>
<div class="hidden px-5 pb-5 pt-0 font-body-md text-body-md text-on-surface-variant space-y-2" id="acc-use">
<p>1. <strong>Prep &amp; Hydrate:</strong> Smooth Good Girl Blush Body Lotion over cleansed skin, paying special attention to collarbones, wrists, and shoulders to lock in moisture.</p>
<p>2. <strong>Mist Pulse Points:</strong> Spray the Good Girl Blush Eau de Parfum onto pulse points (neck, décolletage, behind ears, and inside elbows) from a distance of 15cm.</p>
<p>3. <strong>Touch Up On The Go:</strong> Slip the 10ml travel spray into your clutch to refresh the floral aura throughout the evening without rubbing wrists together.</p>
</div>
</div>
<!-- Accordion 5: Ingredients -->
<div class="border border-outline-variant bg-surface-container-lowest">
<button class="w-full p-5 text-left flex justify-between items-center font-title-lg text-title-lg uppercase tracking-wider" onclick="toggleAccordion('acc-ingredients')">
<span>Ingredients</span>
<span class="material-symbols-outlined" id="acc-ingredients-icon">expand_more</span>
</button>
<div class="hidden px-5 pb-5 pt-0 font-body-sm text-body-sm text-on-surface-variant leading-relaxed" id="acc-ingredients">
<p>
                ALCOHOL DENAT., PARFUM (FRAGRANCE), AQUA (WATER), HYDROXYCITRONELLAL, LINALOOL, BENZYL SALICYLATE, BUTYL METHOXYDIBENZOYLMETHANE, LIMONENE, GERANIOL, COUMARIN, CITRONELLOL, BENZYL BENZOATE, TRIS(TETRAMETHYLHYDROXYPIPERIDINOL) CITRATE, CITRAL, BENZYL ALCOHOL, CI 14700 (RED 4), CI 19140 (YELLOW 5), CI 60730 (EXT. VIOLET 2).
              </p>
</div>
</div>
</div>
</div>
</section>
<!-- 7. Frequently Bought Together / Complete The Routine -->
<section class="py-12 border-b border-outline-variant">
<div class="flex items-center justify-between mb-8">
<div>
<span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest block mb-1">Stack Your Scent</span>
<h3 class="font-headline-sm text-headline-sm text-primary">Complete The Routine</h3>
</div>
<a class="font-label-caps text-label-caps uppercase text-primary hover:text-secondary underline" href="#">View Fragrance Routine</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Item 1: Hair Mist -->
<div class="border border-outline-variant bg-surface-container-lowest p-4 flex flex-col justify-between group hover:border-primary transition-colors">
<div class="aspect-square bg-surface-bright p-4 mb-4 relative overflow-hidden">
<img alt="Good Girl Blush Hair Mist" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_ea1368a5898c8aa5.jpg') }}"/>
<span class="absolute top-2 left-2 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5">HAIR RITUAL</span>
</div>
<div>
<span class="font-label-caps text-label-caps text-on-surface-variant uppercase block">Carolina Herrera</span>
<h4 class="font-title-md text-title-md text-primary truncate mb-1">Good Girl Blush Hair Mist 30ml</h4>
<div class="font-price-aed-md text-price-aed-md text-primary mb-3">AED 245.00</div>
<button class="w-full border border-primary bg-surface-container-lowest text-primary hover:bg-primary hover:text-on-primary py-2.5 font-label-caps text-label-caps uppercase transition-colors">
              Add to Bag
            </button>
</div>
</div>
<!-- Item 2: Eau de Parfum 50ml -->
<div class="border border-outline-variant bg-surface-container-lowest p-4 flex flex-col justify-between group hover:border-primary transition-colors">
<div class="aspect-square bg-surface-bright p-4 mb-4 relative overflow-hidden">
<img alt="Good Girl Blush EDP 50ml" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_e12faed332fa8e3b.jpg') }}"/>
<span class="absolute top-2 left-2 bg-primary text-on-primary font-label-tag text-label-tag px-2 py-0.5">BESTSELLER</span>
</div>
<div>
<span class="font-label-caps text-label-caps text-on-surface-variant uppercase block">Carolina Herrera</span>
<h4 class="font-title-md text-title-md text-primary truncate mb-1">Good Girl Blush Eau de Parfum 50ml</h4>
<div class="font-price-aed-md text-price-aed-md text-primary mb-3">AED 540.00</div>
<button class="w-full border border-primary bg-surface-container-lowest text-primary hover:bg-primary hover:text-on-primary py-2.5 font-label-caps text-label-caps uppercase transition-colors">
              Add to Bag
            </button>
</div>
</div>
<!-- Item 3: Good Girl Classic Gift Set -->
<div class="border border-outline-variant bg-surface-container-lowest p-4 flex flex-col justify-between group hover:border-primary transition-colors">
<div class="aspect-square bg-surface-bright p-4 mb-4 relative overflow-hidden">
<img alt="Good Girl Classic Gift Set" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_4370ee2033cc2dbe.jpg') }}"/>
<span class="absolute top-2 left-2 bg-secondary text-on-secondary font-label-tag text-label-tag px-2 py-0.5">LIMITED EDITION</span>
</div>
<div>
<span class="font-label-caps text-label-caps text-on-surface-variant uppercase block">Carolina Herrera</span>
<h4 class="font-title-md text-title-md text-primary truncate mb-1">Good Girl Classic Gift Set</h4>
<div class="font-price-aed-md text-price-aed-md text-primary mb-3">AED 680.00</div>
<button class="w-full border border-primary bg-surface-container-lowest text-primary hover:bg-primary hover:text-on-primary py-2.5 font-label-caps text-label-caps uppercase transition-colors">
              Add to Bag
            </button>
</div>
</div>
</div>
</section>
<!-- 8. Recommended For You / Customers Also Viewed -->
<section class="py-12 border-b border-outline-variant">
<div class="flex items-center justify-between mb-8">
<div>
<span class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest block mb-1">Curated Selection</span>
<h3 class="font-headline-sm text-headline-sm text-primary">Customers Also Viewed</h3>
</div>
<div class="flex gap-2">
<button class="w-10 h-10 border border-outline-variant hover:border-primary flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">chevron_left</span>
</button>
<button class="w-10 h-10 border border-outline-variant hover:border-primary flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">chevron_right</span>
</button>
</div>
</div>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
<!-- Item 1: Dior J'adore -->
<div class="border border-outline-variant bg-surface-container-lowest p-3 flex flex-col justify-between group hover:border-primary transition-colors">
<div class="aspect-square bg-surface-bright p-2 mb-3 relative overflow-hidden">
<img alt="Dior J’adore Eau De Parfum Set" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_588a27163ab88e65.jpg') }}"/>
<span class="absolute top-1 left-1 bg-primary text-on-primary font-label-tag text-[9px] px-1.5 py-0.5">EXCLUSIVE</span>
</div>
<div>
<span class="font-label-caps text-[10px] text-on-surface-variant uppercase block">DIOR</span>
<h5 class="font-title-md text-[13px] text-primary truncate mb-1">J’adore Eau De Parfum Set</h5>
<div class="font-price-aed-md text-[14px] text-primary mb-2">AED 620.00</div>
<button class="w-full border border-primary text-primary hover:bg-primary hover:text-on-primary py-1.5 font-label-caps text-[10px] uppercase transition-colors">
              Add to Bag
            </button>
</div>
</div>
<!-- Item 2: Givenchy L'Interdit -->
<div class="border border-outline-variant bg-surface-container-lowest p-3 flex flex-col justify-between group hover:border-primary transition-colors">
<div class="aspect-square bg-surface-bright p-2 mb-3 relative overflow-hidden">
<img alt="Givenchy L'Interdit Festive Set" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_3c09c1251af35f37.jpg') }}"/>
<span class="absolute top-1 left-1 bg-secondary text-on-secondary font-label-tag text-[9px] px-1.5 py-0.5">HOT OFFER</span>
</div>
<div>
<span class="font-label-caps text-[10px] text-on-surface-variant uppercase block">GIVENCHY</span>
<h5 class="font-title-md text-[13px] text-primary truncate mb-1">L'Interdit Festive Set</h5>
<div class="font-price-aed-md text-[14px] text-primary mb-2">AED 575.00</div>
<button class="w-full border border-primary text-primary hover:bg-primary hover:text-on-primary py-1.5 font-label-caps text-[10px] uppercase transition-colors">
              Add to Bag
            </button>
</div>
</div>
<!-- Item 3: Guerlain Aqua Allegoria -->
<div class="border border-outline-variant bg-surface-container-lowest p-3 flex flex-col justify-between group hover:border-primary transition-colors">
<div class="aspect-square bg-surface-bright p-2 mb-3 relative overflow-hidden">
<img alt="Guerlain Aqua Allegoria Florabloom Gift Set" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_3946389e4113b552.jpg') }}"/>
</div>
<div>
<span class="font-label-caps text-[10px] text-on-surface-variant uppercase block">GUERLAIN</span>
<h5 class="font-title-md text-[13px] text-primary truncate mb-1">Florabloom Gift Set</h5>
<div class="font-price-aed-md text-[14px] text-primary mb-2">AED 590.00</div>
<button class="w-full border border-primary text-primary hover:bg-primary hover:text-on-primary py-1.5 font-label-caps text-[10px] uppercase transition-colors">
              Add to Bag
            </button>
</div>
</div>
<!-- Item 4: Valentino Born in Roma -->
<div class="border border-outline-variant bg-surface-container-lowest p-3 flex flex-col justify-between group hover:border-primary transition-colors">
<div class="aspect-square bg-surface-bright p-2 mb-3 relative overflow-hidden">
<img alt="Valentino Born in Roma Donna Set" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_30130f7adff18a2f.jpg') }}"/>
<span class="absolute top-1 left-1 bg-primary text-on-primary font-label-tag text-[9px] px-1.5 py-0.5">NEW</span>
</div>
<div>
<span class="font-label-caps text-[10px] text-on-surface-variant uppercase block">VALENTINO</span>
<h5 class="font-title-md text-[13px] text-primary truncate mb-1">Born in Roma Donna Set</h5>
<div class="font-price-aed-md text-[14px] text-primary mb-2">AED 555.00</div>
<button class="w-full border border-primary text-primary hover:bg-primary hover:text-on-primary py-1.5 font-label-caps text-[10px] uppercase transition-colors">
              Add to Bag
            </button>
</div>
</div>
<!-- Item 5: YSL MYSLF -->
<div class="border border-outline-variant bg-surface-container-lowest p-3 flex flex-col justify-between group hover:border-primary transition-colors">
<div class="aspect-square bg-surface-bright p-2 mb-3 relative overflow-hidden">
<img alt="YSL MYSLF Eau de Parfum Set" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ asset('images/content/img_41f402aad3099449.jpg') }}"/>
</div>
<div>
<span class="font-label-caps text-[10px] text-on-surface-variant uppercase block">YVES SAINT LAURENT</span>
<h5 class="font-title-md text-[13px] text-primary truncate mb-1">MYSLF EDP Gift Set</h5>
<div class="font-price-aed-md text-[14px] text-primary mb-2">AED 520.00</div>
<button class="w-full border border-primary text-primary hover:bg-primary hover:text-on-primary py-1.5 font-label-caps text-[10px] uppercase transition-colors">
              Add to Bag
            </button>
</div>
</div>
</div>
</section>
<!-- 9. Sephora Trust Badges Strip -->
<section class="py-12 border-b border-outline-variant">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">local_shipping</span>
<h4 class="font-title-md text-title-md uppercase text-primary">Free Delivery</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Over 250 AED across UAE</p>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">verified</span>
<h4 class="font-title-md text-title-md uppercase text-primary">100% Authentic</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Direct from official luxury houses</p>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">assignment_return</span>
<h4 class="font-title-md text-title-md uppercase text-primary">Easy Returns</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">In any UAE store or online pickup</p>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[32px] text-primary mb-2">support_agent</span>
<h4 class="font-title-md text-title-md uppercase text-primary">Customer Service</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Call Toll-Free: 800-7374672</p>
</div>
</div>
</section>
<!-- 10. Sephora Newsletter Subscription -->
<section class="py-12 text-center max-w-xl mx-auto">
<h3 class="font-headline-md text-headline-md text-primary mb-2">Subscribe to the Sephora newsletter!</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6">
        Get VIP access to exclusive private sales, luxury fragrance launches, and complimentary samples.
      </p>
<form class="flex flex-col sm:flex-row gap-2" onsubmit="event.preventDefault(); alert('Subscribed to Sephora Middle East!');" data-newsletter-form>
<input class="flex-1 bg-surface-container-lowest border border-outline focus:border-primary focus:ring-0 rounded-none px-4 py-3 font-body-md text-body-md" placeholder="Enter your email address" required="" type="email"/>
<button class="bg-primary text-on-primary hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary font-label-caps text-label-caps uppercase px-6 py-3 tracking-widest transition-colors duration-200" type="submit">
          Subscribe
        </button>
</form>
</section>
</main>
@endsection

@push('scripts')
<script>
function changeImage(imgSrc, element) {
      const mainImg = document.getElementById('main-product-image');
      if (mainImg) {
        mainImg.src = imgSrc;
      }
      document.querySelectorAll('.thumb-btn').forEach(btn => {
        btn.classList.remove('thumb-active');
        btn.classList.add('border-outline-variant');
      });
      if (element) {
        element.classList.add('thumb-active');
        element.classList.remove('border-outline-variant');
      }
    }

    function toggleAccordion(id) {
      const el = document.getElementById(id);
      const icon = document.getElementById(id + '-icon');
      if (el) {
        const isHidden = el.classList.contains('hidden');
        if (isHidden) {
          el.classList.remove('hidden');
          if (icon) icon.innerText = 'expand_less';
        } else {
          el.classList.add('hidden');
          if (icon) icon.innerText = 'expand_more';
        }
      }
    }

    let currentQty = 1;
    function incrementQty() {
      currentQty++;
      document.getElementById('qty-val').innerText = currentQty;
    }

    function decrementQty() {
      if (currentQty > 1) {
        currentQty--;
        document.getElementById('qty-val').innerText = currentQty;
      }
    }
</script>
@endpush