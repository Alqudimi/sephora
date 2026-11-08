{{--
    Shared storefront header: announcement bar, main header, category navigation
    with luxury multi-column mega menus and compact editorial dropdowns,
    and the mobile off-canvas menu.
--}}
@php
    $cartBadgeCount = (int) ($cartCount ?? $bagCount ?? 0);
    $wishlistBadgeCount = (int) ($wishlistCount ?? 0);
@endphp

<!-- BEGIN: AnnouncementBar -->
<div class="bg-black text-white text-[11px] sm:text-[12px] py-2 px-3 sm:px-4 text-center font-normal tracking-wide border-b border-neutral-800" data-purpose="top-announcement">
    <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-4 divide-y sm:divide-y-0 sm:divide-x divide-neutral-700">
        <span class="flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <strong>FREE DELIVERY</strong> on orders above 250 AED
        </span>
        <span class="hidden sm:inline-flex items-center gap-1.5 pl-4 text-neutral-300">
            <strong>3 FREE SAMPLES</strong> with every order
        </span>
        <span class="hidden md:inline-flex items-center gap-1.5 pl-4 text-neutral-300">
            <strong>100% AUTHENTIC</strong> guaranteed
        </span>
        <a class="underline font-bold text-white hover:text-neutral-300 pl-0 sm:pl-4 transition-colors whitespace-nowrap inline-block" href="/shop/fragrance">
            STACK YOUR SCENT &rarr;
        </a>
    </div>
</div>
<!-- END: AnnouncementBar -->

<!-- BEGIN: MainHeader -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-50" data-site-header>
    <div class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-3 sm:py-3.5 flex items-center justify-between gap-2 sm:gap-4 lg:gap-8">
        <!-- Mobile menu trigger -->
        <button
            aria-controls="mobile-menu"
            aria-expanded="false"
            aria-label="Open menu"
            class="lg:hidden p-1.5 -ml-1 text-black hover:opacity-70 transition-opacity shrink-0 min-w-[36px] min-h-[36px] flex items-center justify-center"
            data-mobile-menu-toggle
            type="button"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <!-- Enhanced Logo -->
        <div class="flex items-center shrink-0">
            <a class="logo-font text-lg sm:text-2xl md:text-3xl text-black hover:opacity-90 tracking-[0.18em] sm:tracking-[0.25em] font-bold" href="/">
                SEPHORA
            </a>
        </div>

        <!-- Enhanced Search Input (desktop) -->
        <form action="/search" class="flex-1 max-w-2xl hidden md:block min-w-0" method="GET" role="search">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <input
                    class="w-full pl-10 pr-4 py-2 bg-[#f0f2f4] rounded-sm text-sm border-0 focus:ring-1 focus:ring-black placeholder-gray-500 text-gray-800 transition-colors"
                    name="q"
                    placeholder="Search for products, brands, or categories..."
                    type="search"
                    value="{{ request('q') }}"
                />
            </div>
        </form>

        <!-- Enhanced Right Utility Actions -->
        <div class="flex items-center space-x-2 sm:space-x-4 md:space-x-5 shrink-0 text-sm">
            <!-- Stores & Services -->
            <a class="hidden lg:flex items-center gap-2 hover:opacity-75 transition-opacity text-gray-900 font-medium shrink-0" href="/stores">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="text-[13px] tracking-tight whitespace-nowrap">Stores & Services</span>
            </a>

            <!-- Divider Line -->
            <div class="hidden lg:block h-5 w-px bg-gray-200 shrink-0"></div>

            <!-- Country Flag UAE -->
            <a href="/my-account/settings/country-and-language" aria-label="Select Country and Currency" class="hidden lg:flex items-center gap-1.5 hover:opacity-85 transition-opacity rounded-full px-2.5 py-1 border border-gray-200 bg-gray-50/70 text-gray-800 shrink-0">
                <span class="inline-flex w-4 h-3 overflow-hidden rounded-[2px] border border-gray-300 shrink-0">
                    <svg viewBox="0 0 600 300" class="w-full h-full object-cover">
                        <rect width="600" height="100" fill="#00732f" />
                        <rect y="100" width="600" height="100" fill="#ffffff" />
                        <rect y="200" width="600" height="100" fill="#000000" />
                        <rect width="150" height="300" fill="#ff0000" />
                    </svg>
                </span>
                <span class="text-[12px] font-semibold tracking-tight">UAE &middot; AED</span>
            </a>

            <!-- Account / Sign In -->
            <a aria-label="Account" class="p-1 hover:opacity-70 transition-opacity text-gray-900 shrink-0" href="/my-account">
                <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>

            <!-- Wishlist -->
            <a aria-label="Wishlist" class="relative p-1 hover:opacity-70 transition-opacity text-gray-900 shrink-0" href="/my-account/wishlist">
                <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="absolute -top-0.5 -right-0.5 min-w-[15px] h-3.5 px-0.5 bg-black text-white text-[8px] font-bold rounded-full flex items-center justify-center leading-none {{ $wishlistBadgeCount > 0 ? '' : 'hidden' }}" data-wishlist-count>{{ $wishlistBadgeCount }}</span>
            </a>

            <!-- Shopping Bag -->
            <a aria-label="Shopping Bag" class="relative p-1 hover:opacity-70 transition-opacity text-gray-900 shrink-0" href="/cart">
                <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="absolute -top-0.5 -right-0.5 min-w-[15px] h-3.5 px-0.5 bg-black text-white text-[8px] font-bold rounded-full flex items-center justify-center leading-none {{ $cartBadgeCount > 0 ? '' : 'hidden' }}" data-bag-count>{{ $cartBadgeCount }}</span>
            </a>
        </div>
    </div>

    <!-- Mobile Search Row -->
    <form action="/search" class="px-3 pb-3 md:hidden" method="GET" role="search">
        <div class="relative w-full">
            <input
                class="w-full pl-9 pr-3 py-1.5 bg-[#f0f2f4] rounded-sm text-sm border-0 focus:ring-1 focus:ring-black placeholder-gray-500"
                name="q"
                placeholder="Search products or brands..."
                type="search"
                value="{{ request('q') }}"
            />
            <svg class="w-4 h-4 text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
    </form>
</header>
<!-- END: MainHeader -->

<!-- BEGIN: NavigationBar with Expanding Mega Menus & Dropdowns -->
<nav aria-label="Primary" class="border-b border-gray-200 bg-white relative z-40">
    <div class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-6 lg:px-8 flex items-stretch justify-between gap-1 xl:gap-2 text-gray-700 h-11 overflow-x-auto lg:overflow-visible custom-scrollbar scrollbar-hidden">

        {{-- 1. The Holiday Collection (Compact Seasonal Panel) --}}
        <div class="relative group flex items-center h-full shrink-0">
            <a href="/shop/gifts"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-bold text-[#b45309] hover:text-[#78350f] transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-[#b45309] after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>The Holiday Collection</span>
                <svg class="w-3 h-3 text-amber-500/70 group-hover:text-amber-800 transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Compact Seasonal Dropdown -->
            <div class="absolute top-full left-0 w-64 pt-1 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="bg-white rounded-b-md border border-t-2 border-gray-200 border-t-[#b45309] shadow-2xl overflow-hidden py-1 divide-y divide-gray-100">
                    <div class="px-4 py-2 bg-gradient-to-r from-amber-50/80 to-transparent">
                        <span class="text-[10px] font-black uppercase tracking-widest text-[#b45309]">Holiday Gifts Campaign</span>
                    </div>
                    <div class="py-1">
                        <a href="/shop/makeup" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>Makeup</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/fragrance" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>Fragrance</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/skincare" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>Skincare</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/hair" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>Hair</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/brands/sephora-collection" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>Sephora Collection</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/gifts" class="flex items-center justify-between px-4 py-2.5 text-xs font-bold text-black hover:bg-neutral-100 transition-colors border-t border-gray-100">
                            <span>View All</span>
                            <span class="text-black text-xs font-bold">&rarr;</span>
                        </a>
                    </div>
                    <div class="p-2.5 bg-neutral-50">
                        <a href="/shop/gifts" class="block w-full py-1.5 px-3 border border-black text-black hover:bg-black hover:text-white text-center text-xs font-bold uppercase tracking-wider transition-colors">
                            SHOP ALL
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Stack Your Scent (Compact Editorial Fragrance Panel) --}}
        <div class="relative group flex items-center h-full shrink-0">
            <a href="/shop/fragrance"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>Stack Your Scent</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Compact Editorial Dropdown -->
            <div class="absolute top-full left-0 w-64 pt-1 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="bg-white rounded-b-md border border-t-2 border-gray-200 border-t-black shadow-2xl overflow-hidden py-1 divide-y divide-gray-100">
                    <div class="px-4 py-2 bg-neutral-50/70">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500">Curated Scent Layering</span>
                    </div>
                    <div class="py-1">
                        <a href="/shop/fragrance?family=fruity" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>Fruity Gourmands</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/fragrance?family=musky" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>Skin Musks</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/fragrance?family=fresh" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>Lavender Blends</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/fragrance" class="flex items-center justify-between px-4 py-2.5 text-xs font-bold text-black hover:bg-neutral-100 transition-colors border-t border-gray-100">
                            <span>View All</span>
                            <span class="text-black text-xs font-bold">&rarr;</span>
                        </a>
                    </div>
                    <div class="p-2.5 bg-neutral-50">
                        <a href="/shop/fragrance" class="block w-full py-1.5 px-3 border border-black text-black hover:bg-black hover:text-white text-center text-xs font-bold uppercase tracking-wider transition-colors">
                            SHOP ALL
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Beauty Offers (Direct Link - No Dropdown) --}}
        <div class="flex items-center h-full shrink-0">
            <a href="/beauty-offers"
               class="h-full flex items-center px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 hover:after:w-full after:transition-all after:duration-150">
                <span>Beauty Offers</span>
            </a>
        </div>

        {{-- 4. New (Discovery Panel with Categories, Brands & Promos) --}}
        <div class="group flex items-center h-full shrink-0">
            <a href="/shop/new"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>New</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                    <div class="grid grid-cols-12 gap-6 lg:gap-8 items-start">
                        <!-- Column 1: Shortcuts / Categories -->
                        <div class="col-span-12 md:col-span-3 space-y-2 border-b md:border-b-0 md:border-r border-gray-100 pb-4 md:pb-0 md:pr-6">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-3">Just Dropped</h3>
                            <ul class="space-y-1.5 text-xs">
                                <li><a href="/shop/new" class="font-bold text-black hover:underline block py-0.5">View All</a></li>
                                <li><a href="/shop/new?cat=makeup" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">New in Makeup</a></li>
                                <li><a href="/shop/new?cat=fragrance" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">New in Fragrance</a></li>
                                <li><a href="/shop/new?cat=skincare" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">New in Skincare</a></li>
                                <li><a href="/shop/new?cat=hair" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">New in Haircare</a></li>
                                <li><a href="/brands/sephora-collection?new=1" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">New in Sephora Collection</a></li>
                            </ul>
                        </div>

                        <!-- Column 2: New in Brands -->
                        <div class="col-span-12 md:col-span-4 border-b md:border-b-0 md:border-r border-gray-100 pb-4 md:pb-0 md:pr-6">
                            <a href="/brands" class="text-xs font-bold uppercase tracking-wider text-black mb-3 inline-flex items-center gap-1 hover:underline">
                                <span>New in Brands</span>
                                <span class="text-xs">&rarr;</span>
                            </a>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-1.5 text-xs text-gray-600 mt-2">
                                <a href="/search?q=Haus+Labs" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">Haus Labs By Lady Gaga</a>
                                <a href="/search?q=BBB+London" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">BBB London</a>
                                <a href="/search?q=Oribe" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">Oribe</a>
                                <a href="/search?q=Moonglaze" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">Moonglaze</a>
                                <a href="/search?q=Mediheal" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">Mediheal</a>
                                <a href="/search?q=Starface" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">Starface</a>
                                <a href="/search?q=Tweezerman" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">Tweezerman</a>
                                <a href="/search?q=Hello+Sunday" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">Hello Sunday</a>
                                <a href="/search?q=Estrid" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">Estrid</a>
                                <a href="/search?q=One+Size" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">One Size</a>
                            </div>
                        </div>

                        <!-- Column 3: Promotional Units (Kayali, YSL, YTTP) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-5 space-y-3">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 block">Featured Highlights</span>
                            <div class="grid grid-cols-3 gap-3">
                                <a href="/brands/kayali" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[4/3] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/products/Kayali_VIAB_BrandHighlight.jpg') }}" alt="Kayali" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[11px] text-black truncate">Kayali</p>
                                    <span class="text-[10px] text-gray-500 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">Shop Now &rsaquo;</span>
                                </a>
                                <a href="/brands/yves-saint-laurent" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[4/3] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/products/YSL_Libre_-_Brand_Highlight.jpg') }}" alt="Yves Saint Laurent" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[11px] text-black truncate">Yves Saint Laurent</p>
                                    <span class="text-[10px] text-gray-500 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">Shop Now &rsaquo;</span>
                                </a>
                                <a href="/brands/youth-to-the-people" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[4/3] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/products/YTTP_-_Brand_Highlights_-_1744x992.jpg') }}" alt="Youth To The People" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[11px] text-black truncate">Youth To The People</p>
                                    <span class="text-[10px] text-gray-500 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">Shop Now &rsaquo;</span>
                                </a>
                            </div>
                            <div class="pt-2 text-right">
                                <a href="/shop/new" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    SHOP ALL
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. Makeup (Large Multi-Column Mega Menu) --}}
        <div class="group flex items-center h-full shrink-0">
            <a href="/shop/makeup"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>Makeup</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/shop/gifts?category=makeup" class="text-black hover:underline">Makeup Gifts</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/new?category=makeup" class="text-black hover:underline">New Arrivals</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/bestsellers?category=makeup" class="text-black hover:underline">Bestsellers</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection" class="text-black hover:underline">Sephora Collection Makeup</a>
                    </div>

                    <div class="grid grid-cols-12 gap-6 items-start">
                        <!-- Column 1: Face, Makeup Remover, Makeup Sets -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">Face</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/foundation" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Foundation</a></li>
                                    <li><a href="/shop/primer-setting-spray" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Primer &amp; Setting Spray</a></li>
                                    <li><a href="/shop/concealers-correctors" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Concealers &amp; Correctors</a></li>
                                    <li><a href="/shop/highlighters" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Highlighters</a></li>
                                    <li><a href="/shop/bb-cc-cream" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">BB &amp; CC cream</a></li>
                                    <li><a href="/shop/blush" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Blush</a></li>
                                    <li><a href="/shop/bronzer" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Bronzer</a></li>
                                    <li><a href="/shop/contour" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Contour</a></li>
                                    <li><a href="/shop/powder" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Powder</a></li>
                                    <li><a href="/shop/tinted-moisturizer" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Tinted Moisturizer</a></li>
                                    <li><a href="/shop/face-palette" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Face Palette</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-1.5">
                                <a href="/shop/makeup?sub=remover" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Makeup Remover</a>
                                <a href="/shop/makeup?sub=sets" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Makeup Sets</a>
                            </div>
                        </div>

                        <!-- Column 2: Eyes, Lips, Makeup Palettes -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">Eyes</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/eyeshadow" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Eyeshadow</a></li>
                                    <li><a href="/shop/mascara" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Mascara</a></li>
                                    <li><a href="/shop/makeup-palettes" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Eye Palette</a></li>
                                    <li><a href="/shop/eyeliners" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Eyeliners</a></li>
                                    <li><a href="/shop/lashes" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Lashes</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">Lips</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/lipsticks" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Lipsticks</a></li>
                                    <li><a href="/shop/gloss" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Gloss</a></li>
                                    <li><a href="/shop/lip-liner" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Lip Liner</a></li>
                                    <li><a href="/shop/lip-balm" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Lip Balm</a></li>
                                    <li><a href="/shop/plumpers" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Plumpers</a></li>
                                    <li><a href="/shop/liquid-lipstick" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Liquid Lipstick</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/makeup-palettes" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Makeup Palettes</a>
                            </div>
                        </div>

                        <!-- Column 3: Brows, Brushes & Sponges, Standalone links -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">Brows</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/brow-pencil-powder" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Brow Pencil &amp; Powder</a></li>
                                    <li><a href="/shop/brow-gel-mascara" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Brow Gel &amp; Mascara</a></li>
                                    <li><a href="/shop/brow-kit" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Brow Kit</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">Brushes &amp; Sponges</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/makeup?sub=face-brushes" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Face Brushes</a></li>
                                    <li><a href="/shop/makeup?sub=brow-brush" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Brow Brush</a></li>
                                    <li><a href="/shop/makeup?sub=eye-brushes" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Eye Brushes</a></li>
                                    <li><a href="/shop/makeup?sub=brush-sets" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Makeup Brush Sets</a></li>
                                    <li><a href="/shop/makeup?sub=sponges" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Sponges &amp; Applicators</a></li>
                                    <li><a href="/shop/makeup?sub=brush-cleaners" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Brush Cleaners</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-1.5">
                                <a href="/shop/makeup?sub=accessories" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Makeup Accessories</a>
                                <a href="/shop/makeup?sub=nails" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Nails</a>
                                <a href="/shop/gifts/minis-more" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Travel Size</a>
                            </div>
                        </div>

                        <!-- Column 4: Promotional Area (Huda Beauty) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-l border-gray-100 pl-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/products/Hudabeauty_SME_Banners_BrandPDPHighlight__4_.jpg') }}" alt="Huda Beauty" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">Huda Beauty</h4>
                                <a href="/brands/huda-beauty" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>Shop Now</span>
                                    <span>&rsaquo;</span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/shop/makeup" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    SHOP ALL
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 6. Fragrance (Wide Multi-Column Mega Menu) --}}
        <div class="group flex items-center h-full shrink-0">
            <a href="/shop/fragrance"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>Fragrance</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/shop/new?category=fragrance" class="text-black hover:underline">New Arrivals</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/bestsellers?category=fragrance" class="text-black hover:underline">Bestsellers</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/fragrance?type=niche" class="text-black hover:underline">Niche Collection</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/fragrance?type=refillable" class="text-black hover:underline">Spray Refill Repeat</a>
                    </div>

                    <div class="grid grid-cols-12 gap-6 items-start">
                        <!-- Column 1: For Her & For Him -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">For Her</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/eau-de-parfum" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Eau de Parfum</a></li>
                                    <li><a href="/shop/eau-de-toilette" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Eau de Toilette</a></li>
                                    <li><a href="/shop/fragrance-mists" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Fragrance Mist</a></li>
                                    <li><a href="/shop/perfume-extract" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Perfume Extract</a></li>
                                    <li><a href="/shop/scented-body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Scented Body Care</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/for-him" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">For Him</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/fragrance-for-him-eau-de-parfum" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Eau de Parfum</a></li>
                                    <li><a href="/shop/fragrance-for-him-eau-de-toilette" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Eau de Toilette</a></li>
                                    <li><a href="/shop/bath-body" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Bath &amp; Shower</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: By Fragrance Family -->
                        <div class="col-span-12 md:col-span-3 space-y-2">
                            <a href="/shop/by-fragrance-family" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">By Fragrance Family</a>
                            <ul class="space-y-1 text-xs text-gray-600">
                                <li><a href="/shop/floral" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Floral</a></li>
                                <li><a href="/shop/fresh" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Fresh</a></li>
                                <li><a href="/shop/oriental" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Oriental</a></li>
                                <li><a href="/shop/woody-oud" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Woody &amp; Oud</a></li>
                                <li><a href="/shop/fruity" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Fruity</a></li>
                                <li><a href="/shop/amber" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Amber</a></li>
                                <li><a href="/shop/by-fragrance-family" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Vanilla</a></li>
                                <li><a href="/shop/by-fragrance-family" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Musky</a></li>
                            </ul>
                        </div>

                        <!-- Column 3: Standalone categories -->
                        <div class="col-span-12 md:col-span-3 space-y-3">
                            <a href="/shop/scented-candles" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Home Fragrance</a>
                            <a href="/shop/travel-size" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Travel Size</a>
                            <a href="/shop/gift-sets" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Gift Sets</a>
                        </div>

                        <!-- Column 4: Promotional Area (Kilian Paris) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-l border-gray-100 pl-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/hero/maison_francis_kurkdjian_baccarat_rouge_540_eau_de_parfum_bottle_iconic_red.webp') }}" alt="Kilian Paris" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">Kilian Paris</h4>
                                <a href="/search?q=Kilian" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>Shop Now</span>
                                    <span>&rsaquo;</span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/shop/fragrance" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    SHOP ALL
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 7. Skincare (Large Mega Menu) --}}
        <div class="group flex items-center h-full shrink-0">
            <a href="/shop/skincare"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>Skincare</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/shop/gifts?category=skincare" class="text-black hover:underline">Skincare Gifts</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/new?category=skincare" class="text-black hover:underline">New Arrivals</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/bestsellers?category=skincare" class="text-black hover:underline">Bestsellers</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection" class="text-black hover:underline">Sephora Collection Skincare</a>
                    </div>

                    <div class="grid grid-cols-12 gap-6 items-start">
                        <!-- Column 1: All Things Skin -->
                        <div class="col-span-12 md:col-span-4 space-y-3">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">All Things Skin</h3>
                            <div class="space-y-2 text-xs">
                                <div>
                                    <span class="font-bold text-gray-900 block py-0.5">Moisturizers</span>
                                    <div class="pl-2 space-y-0.5 text-gray-600">
                                        <a href="/shop/day-cream" class="hover:text-black block py-0.5">Day Cream</a>
                                        <a href="/shop/night-cream" class="hover:text-black block py-0.5">Night Cream</a>
                                    </div>
                                </div>
                                <a href="/shop/skincare" class="font-bold text-gray-900 block py-0.5 hover:underline">Serum &amp; Face Oils</a>
                                <a href="/shop/eye-cream" class="font-bold text-gray-900 block py-0.5 hover:underline">Eye Cream</a>
                                <div>
                                    <a href="/shop/cleansers-makeup-removers" class="font-bold text-gray-900 block py-0.5 hover:underline">Cleansers</a>
                                    <div class="pl-2 space-y-0.5 text-gray-600">
                                        <a href="/shop/face-wash-cleansers" class="hover:text-black block py-0.5">Face Wash &amp; Cleansers</a>
                                        <a href="/shop/skincare-cleansers-makeup-removers-makeup-removers" class="hover:text-black block py-0.5">Makeup Removers</a>
                                        <a href="/shop/micellar-water" class="hover:text-black block py-0.5">Micellar Water</a>
                                        <a href="/shop/face-wipes" class="hover:text-black block py-0.5">Face Wipes</a>
                                        <a href="/shop/cleansers-makeup-removers" class="hover:text-black block py-0.5">Cleansing Balms</a>
                                        <a href="/shop/cleansers-makeup-removers" class="hover:text-black block py-0.5">Cleansing Oil</a>
                                    </div>
                                </div>
                                <div>
                                    <a href="/shop/masks" class="font-bold text-gray-900 block py-0.5 hover:underline">Masks</a>
                                    <div class="pl-2 space-y-0.5 text-gray-600">
                                        <a href="/shop/cream-masks" class="hover:text-black block py-0.5">Cream Masks</a>
                                        <a href="/shop/sheet-masks" class="hover:text-black block py-0.5">Sheet Masks</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Skin Concerns -->
                        <div class="col-span-12 md:col-span-3 space-y-2">
                            <a href="/shop/skincare-shop-by-concern" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Skin Concerns</a>
                            <ul class="space-y-1 text-xs text-gray-600">
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Acne &amp; Blemish</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Anti-Aging</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Dark Spots</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Pore Care</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Dryness</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Mattifying</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Fine Lines &amp; Wrinkle</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Dullness</a></li>
                            </ul>
                        </div>

                        <!-- Column 3: Lip Care, Suncare, Sets & Accessories -->
                        <div class="col-span-12 md:col-span-2 space-y-4">
                            <div>
                                <a href="/shop/lip-care" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Lip Care</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/lip-care" class="hover:text-black block py-0.5">Balms</a></li>
                                    <li><a href="/shop/lip-care" class="hover:text-black block py-0.5">Lip Oil</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/skincare-sun-care" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Suncare</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/skincare-sun-care" class="hover:text-black block py-0.5">Face Sunscreen</a></li>
                                    <li><a href="/shop/skincare-sun-care" class="hover:text-black block py-0.5">Body Sunscreen</a></li>
                                    <li><a href="/shop/skincare-sun-care" class="hover:text-black block py-0.5">Body Self Tanning</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-1.5">
                                <a href="/shop/set" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Sets</a>
                                <a href="/shop/face-accessories" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Face Accessories</a>
                            </div>
                        </div>

                        <!-- Column 4: Promotional Area (Anua) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-l border-gray-100 pl-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/hero/drunk_elephant_protini_polypeptide_cream_teal_and_white_jar_luxury_skincare.webp') }}" alt="Anua" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">Anua</h4>
                                <a href="/search?q=Anua" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>Shop Now</span>
                                    <span>&rsaquo;</span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/shop/skincare" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    SHOP ALL
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 8. Bath & Body (Medium-sized Category Panel) --}}
        <div class="group flex items-center h-full shrink-0">
            <a href="/shop/bath-body"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>Bath &amp; Body</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                    <div class="grid grid-cols-12 gap-6 lg:gap-8 items-start">
                        <!-- Column 1: Bath and Shower & Body Care -->
                        <div class="col-span-12 md:col-span-4 space-y-4">
                            <div>
                                <a href="/shop/bath-and-shower" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Bath and Shower</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/bath-and-shower" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Body Wash &amp; Shower Gel</a></li>
                                    <li><a href="/shop/bath-and-shower" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Scrub &amp; Exfoliants</a></li>
                                    <li><a href="/shop/bath-and-shower" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Body Mist</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/body-care" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Body Care</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Body Lotion</a></li>
                                    <li><a href="/shop/body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Hand Care</a></li>
                                    <li><a href="/shop/body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Deodorant</a></li>
                                    <li><a href="/shop/body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Foot Care</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: Sun Care, Candles and Scents, Accessories -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <a href="/shop/sun-care" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Sun Care</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/sun-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Face Sunscreen</a></li>
                                    <li><a href="/shop/sun-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Body Sunscreen</a></li>
                                    <li><a href="/shop/sun-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Body Self Tanning</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-2">
                                <a href="/shop/scented-candles" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Candles and Scents</a>
                                <a href="/shop/body-accessories" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Body Accessories</a>
                            </div>
                        </div>

                        <!-- Column 3: Promotional Units (Sol De Janeiro & Touchland) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-5 flex flex-col justify-between border-l border-gray-100 pl-6 space-y-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="group/promo block border border-gray-200 rounded p-2.5 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/hero/sol_de_janeiro_brazilian_bum_bum_cream_vibrant_yellow_jar_with_white_cap_luxury.webp') }}" alt="Sol De Janeiro" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <h4 class="font-bold text-[11px] text-black truncate">Sol De Janeiro</h4>
                                    <a href="/search?q=Sol+De+Janeiro" class="text-[10px] text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">
                                        <span>Shop Now</span>
                                        <span>&rsaquo;</span>
                                    </a>
                                </div>
                                <div class="group/promo block border border-gray-200 rounded p-2.5 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/products/Touchland-PDP-BrandHighlight-1744x992-April25.png') }}" alt="Touchland" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <h4 class="font-bold text-[11px] text-black truncate">Touchland</h4>
                                    <a href="/search?q=Touchland" class="text-[10px] text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">
                                        <span>Shop Now</span>
                                        <span>&rsaquo;</span>
                                    </a>
                                </div>
                            </div>
                            <div class="text-right pt-2">
                                <a href="/shop/bath-body" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    SHOP ALL
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 9. Hair (Large Categorized Panel) --}}
        <div class="group flex items-center h-full shrink-0">
            <a href="/shop/hair"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>Hair</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/shop/gifts?category=hair" class="text-black hover:underline">Haircare Gifts</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/new?category=hair" class="text-black hover:underline">New Arrivals</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/bestsellers?category=hair" class="text-black hover:underline">Bestsellers</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection" class="text-black hover:underline">Sephora Collection Haircare</a>
                    </div>

                    <div class="grid grid-cols-12 gap-6 items-start">
                        <!-- Column 1: Want Great Hair? & Hair Type -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-1.5">Want Great Hair?</h3>
                                <a href="/shop/shampoo-conditioner" class="font-bold text-gray-900 text-xs block py-0.5 hover:underline">Shampoo &amp; Conditioner</a>
                                <ul class="pl-2 space-y-1 text-xs text-gray-600 mt-1">
                                    <li><a href="/shop/shampoo" class="hover:text-black block py-0.5">Shampoo</a></li>
                                    <li><a href="/shop/conditioner" class="hover:text-black block py-0.5">Conditioner</a></li>
                                    <li><a href="/shop/dry-shampoo" class="hover:text-black block py-0.5">Dry Shampoo</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/hair-type" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Hair Type</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/dry-damaged" class="hover:text-black block py-0.5">Dry &amp; Damaged</a></li>
                                    <li><a href="/shop/normal" class="hover:text-black block py-0.5">Normal</a></li>
                                    <li><a href="/shop/hair-type" class="hover:text-black block py-0.5">Thin</a></li>
                                    <li><a href="/shop/color-care" class="hover:text-black block py-0.5">Color Care</a></li>
                                    <li><a href="/shop/curly-frizzy" class="hover:text-black block py-0.5">Curly &amp; Frizzy</a></li>
                                    <li><a href="/shop/hair-type" class="hover:text-black block py-0.5">Oily / Combination</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: Treatments & Tools -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <a href="/shop/treatments" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Treatments</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/hair-mask" class="hover:text-black block py-0.5">Hair Mask</a></li>
                                    <li><a href="/shop/leave-in-cream-treatment" class="hover:text-black block py-0.5">Leave-in Conditioner</a></li>
                                    <li><a href="/shop/serum-oil" class="hover:text-black block py-0.5">Hair Oil</a></li>
                                    <li><a href="/shop/treatments" class="hover:text-black block py-0.5">Hair Serum</a></li>
                                    <li><a href="/shop/hair-loss" class="hover:text-black block py-0.5">Hair Thinning &amp; Hair Loss</a></li>
                                    <li><a href="/shop/treatments" class="hover:text-black block py-0.5">Hair Spray</a></li>
                                    <li><a href="/shop/treatments" class="hover:text-black block py-0.5">Cream</a></li>
                                    <li><a href="/shop/hair-shampoo-conditioner-hair-mist" class="hover:text-black block py-0.5">Hair Mist</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/tools-accessories" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Tools &amp; Accessories</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/tools-accessories" class="hover:text-black block py-0.5">Brushes and Combs</a></li>
                                    <li><a href="/shop/tools-accessories" class="hover:text-black block py-0.5">Hair Dryer</a></li>
                                    <li><a href="/shop/tools-accessories" class="hover:text-black block py-0.5">Straightener and Curling Irons</a></li>
                                    <li><a href="/shop/tools-accessories" class="hover:text-black block py-0.5">Hair Accessories</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 3: Shop By Concern & Sets -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <a href="/shop/hair-shop-by-concern" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">Shop By Concern</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/color-care" class="hover:text-black block py-0.5">Color Care</a></li>
                                    <li><a href="/shop/dryness" class="hover:text-black block py-0.5">Dryness</a></li>
                                    <li><a href="/shop/scalp-care" class="hover:text-black block py-0.5">Scalp</a></li>
                                    <li><a href="/shop/hair-shop-by-concern" class="hover:text-black block py-0.5">Volume</a></li>
                                    <li><a href="/shop/frizz" class="hover:text-black block py-0.5">Frizz</a></li>
                                    <li><a href="/shop/hair-loss" class="hover:text-black block py-0.5">Anti-Hair Loss</a></li>
                                    <li><a href="/shop/damaged-hair" class="hover:text-black block py-0.5">Damaged Hair</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-1.5">
                                <a href="/shop/hair-sets" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Sets</a>
                                <a href="/shop/travel-size" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Travel Size</a>
                            </div>
                        </div>

                        <!-- Column 4: Promotional Area (Virtue) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-l border-gray-100 pl-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/products/Virtue_-_Brand_Highlights_-_1744x992.jpg') }}" alt="Virtue" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">Virtue</h4>
                                <a href="/search?q=Virtue" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>Shop Now</span>
                                    <span>&rsaquo;</span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/shop/hair" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    SHOP ALL
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 10. Sephora Collection (Brand Mega Menu) --}}
        <div class="group flex items-center h-full shrink-0">
            <a href="/brands/sephora-collection"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>Sephora Collection</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/brands/sephora-collection" class="text-black hover:underline">Sephora Collection Festive Shop</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection?new=1" class="text-black hover:underline">New Arrivals</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection?bestseller=1" class="text-black hover:underline">Bestsellers</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection" class="text-black hover:underline">Cheek &amp; Lip Tint Hydrate Collection</a>
                    </div>

                    <div class="grid grid-cols-12 gap-6 items-start">
                        <!-- Column 1: Makeup & Haircare -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">Makeup</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/brands/sephora-collection?type=eyes" class="hover:text-black block py-0.5">Eyes</a></li>
                                    <li><a href="/brands/sephora-collection?type=face" class="hover:text-black block py-0.5">Face</a></li>
                                    <li><a href="/brands/sephora-collection?type=lips" class="hover:text-black block py-0.5">Lips</a></li>
                                    <li><a href="/brands/sephora-collection?type=brows" class="hover:text-black block py-0.5">Brows</a></li>
                                    <li><a href="/brands/sephora-collection?type=accessories" class="hover:text-black block py-0.5">Makeup Accessories</a></li>
                                    <li><a href="/brands/sephora-collection?type=sets" class="hover:text-black block py-0.5">Makeup Sets</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">Haircare</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/brands/sephora-collection?type=shampoos" class="hover:text-black block py-0.5">Shampoos</a></li>
                                    <li><a href="/brands/sephora-collection?type=conditioners" class="hover:text-black block py-0.5">Conditioners</a></li>
                                    <li><a href="/brands/sephora-collection?type=masks-serums" class="hover:text-black block py-0.5">Hair Mask and Serums</a></li>
                                    <li><a href="/brands/sephora-collection?type=hair-accessories" class="hover:text-black block py-0.5">Hair Accessories</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: Skincare & Brushes/Sponges -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">Skincare</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/brands/sephora-collection?type=serums" class="hover:text-black block py-0.5">Skin+Serums</a></li>
                                    <li><a href="/brands/sephora-collection?type=cleansers" class="hover:text-black block py-0.5">Makeup Removers and Cleansers</a></li>
                                    <li><a href="/brands/sephora-collection?type=moisturizers" class="hover:text-black block py-0.5">Moisturizers</a></li>
                                    <li><a href="/brands/sephora-collection?type=eye-creams" class="hover:text-black block py-0.5">Eye Creams</a></li>
                                    <li><a href="/brands/sephora-collection?type=colorful" class="hover:text-black block py-0.5">Colorful Skincare</a></li>
                                    <li><a href="/brands/sephora-collection?type=masks" class="hover:text-black block py-0.5">Masks</a></li>
                                    <li><a href="/brands/sephora-collection?type=skin-accessories" class="hover:text-black block py-0.5">Skincare Accessories</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">Brushes and Sponges</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/brands/sephora-collection?type=pro-brushes" class="hover:text-black block py-0.5">Pro Brushes</a></li>
                                    <li><a href="/brands/sephora-collection?type=classic-brushes" class="hover:text-black block py-0.5">Classic Brushes</a></li>
                                    <li><a href="/brands/sephora-collection?type=sponges" class="hover:text-black block py-0.5">Sponges</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 3: Standalone categories -->
                        <div class="col-span-12 md:col-span-3 space-y-3">
                            <a href="/brands/sephora-collection?type=accessories" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Accessories</a>
                            <a href="/brands/sephora-collection?type=nails" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Nails</a>
                            <a href="/brands/sephora-collection?type=gift-sets" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Value and Gift Sets</a>
                            <a href="/brands/sephora-collection?type=bath-body" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Bath and Body</a>
                        </div>

                        <!-- Column 4: Promotional Area + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-l border-gray-100 pl-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/products/Sephora-ME-GWP-1472x1196-eng.jpg') }}" alt="Sephora Collection" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">Sephora Collection</h4>
                                <a href="/brands/sephora-collection" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>Shop Now</span>
                                    <span>&rsaquo;</span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/brands/sephora-collection" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    SHOP ALL
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 11. Brands (Directory with A-Z, Featured, Trending & Promos) --}}
        <div class="group flex items-center h-full shrink-0">
            <a href="/brands"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>Brands</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                    <div class="grid grid-cols-12 gap-6 items-start">
                        <!-- Column 1: Permanent Brand Links -->
                        <div class="col-span-12 md:col-span-2 space-y-2 border-b md:border-b-0 md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-3">Directory</h3>
                            <a href="/brands" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Brands A to Z</a>
                            <a href="/brands/sephora-collection" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">Sephora Collection</a>
                        </div>

                        <!-- Column 2: Featured Brands -->
                        <div class="col-span-12 md:col-span-3 space-y-2 border-b md:border-b-0 md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-3">Featured Brands</h3>
                            <ul class="space-y-1.5 text-xs text-gray-600">
                                <li><a href="/brands/huda-beauty" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Huda Beauty</a></li>
                                <li><a href="/brands/kayali" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Kayali</a></li>
                                <li><a href="/search?q=Saie" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Saie</a></li>
                                <li><a href="/search?q=Fugazzi" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Fugazzi Fragrances</a></li>
                                <li><a href="/brands/glow-recipe" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Glow Recipe</a></li>
                                <li><a href="/brands/gisou" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Gisou</a></li>
                            </ul>
                        </div>

                        <!-- Column 3: Trending Brands -->
                        <div class="col-span-12 md:col-span-3 space-y-2 border-b md:border-b-0 md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-3">Trending Brands</h3>
                            <ul class="space-y-1.5 text-xs text-gray-600">
                                <li><a href="/search?q=Makeup+by+Mario" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Makeup by Mario</a></li>
                                <li><a href="/search?q=Patrick+Ta" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Patrick Ta</a></li>
                                <li><a href="/search?q=Phlur" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Phlur</a></li>
                                <li><a href="/search?q=Sol+De+Janeiro" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">Sol De Janeiro</a></li>
                                <li><a href="/brands/k18" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">K18</a></li>
                            </ul>
                        </div>

                        <!-- Column 4: Promotional Units (Tarte, Tatcha, Patrick Ta) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-4 space-y-3">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 block">Promotions</span>
                            <div class="grid grid-cols-3 gap-2.5">
                                <a href="/brands/tarte" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-square bg-gray-100 overflow-hidden mb-1 rounded-sm">
                                        <img src="{{ asset('images/products/tarte_hol26_brand_highlight_1744x992_en-3.jpg') }}" alt="Tarte" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[10px] text-black truncate">Tarte</p>
                                    <span class="text-[9px] text-gray-500 group-hover/promo:text-black font-semibold uppercase block mt-0.5">Shop Now</span>
                                </a>
                                <a href="/search?q=Tatcha" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-square bg-gray-100 overflow-hidden mb-1 rounded-sm">
                                        <img src="{{ asset('images/products/793888679344_TATCHA_Brightening_20Serum_pdp_gwp_eligible_296x296_en.jpg') }}" alt="Tatcha" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[10px] text-black truncate">Tatcha</p>
                                    <span class="text-[9px] text-gray-500 group-hover/promo:text-black font-semibold uppercase block mt-0.5">Shop Now</span>
                                </a>
                                <a href="/search?q=Patrick+Ta" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-square bg-gray-100 overflow-hidden mb-1 rounded-sm">
                                        <img src="{{ asset('images/hero/luxury_beauty_services_at_sephora_professional_makeup_artist_applying_glam.webp') }}" alt="Patrick Ta" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[10px] text-black truncate">Patrick Ta</p>
                                    <span class="text-[9px] text-gray-500 group-hover/promo:text-black font-semibold uppercase block mt-0.5">Shop Now</span>
                                </a>
                            </div>
                            <div class="text-right pt-2">
                                <a href="/brands" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    SHOP ALL
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 12. Gifts (Short Gifts Panel with 2 Browsing Paths) --}}
        <div class="relative group flex items-center h-full shrink-0">
            <a href="/shop/gifts"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>Gifts</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Compact Dropdown -->
            <div class="absolute top-full right-0 w-64 pt-1 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="bg-white rounded-b-md border border-t-2 border-gray-200 border-t-black shadow-2xl overflow-hidden py-1 divide-y divide-gray-100">
                    <div class="py-1">
                        <a href="/shop/gifts?type=sets" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>Gift Sets</span>
                            <span class="text-gray-400 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/gifts/minis-more" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>Minis &amp; More</span>
                            <span class="text-gray-400 text-xs">&rsaquo;</span>
                        </a>
                    </div>
                    <div class="py-1.5">
                        <div class="px-4 py-1 text-[10px] font-bold uppercase tracking-wider text-gray-400">By Category</div>
                        <a href="/shop/gifts?category=makeup" class="flex items-center justify-between px-4 py-1.5 text-xs text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors pl-6">
                            <span>Makeup</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/gifts?category=skincare" class="flex items-center justify-between px-4 py-1.5 text-xs text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors pl-6">
                            <span>Skincare</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/gifts?category=fragrance" class="flex items-center justify-between px-4 py-1.5 text-xs text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors pl-6">
                            <span>Fragrance</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/gifts?category=hair" class="flex items-center justify-between px-4 py-1.5 text-xs text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors pl-6">
                            <span>Hair</span>
                            <span class="text-gray-300 text-xs">&rsaquo;</span>
                        </a>
                    </div>
                    <div class="p-2.5 bg-neutral-50">
                        <a href="/shop/gifts" class="block w-full py-1.5 px-3 border border-black text-black hover:bg-black hover:text-white text-center text-xs font-bold uppercase tracking-wider transition-colors">
                            SHOP ALL
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 13. Clean (Clean at Sephora) --}}
        <div class="relative group flex items-center h-full shrink-0">
            <a href="/clean-at-sephora"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-emerald-800 hover:text-emerald-950 transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-emerald-700 after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span class="inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"></path></svg>
                    Clean
                </span>
                <svg class="w-3 h-3 text-emerald-600/70 group-hover:text-emerald-900 transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Compact Dropdown -->
            <div class="absolute top-full right-0 w-64 pt-1 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-left">
                <div class="bg-white rounded-b-md border border-t-2 border-gray-200 border-t-emerald-700 shadow-2xl overflow-hidden py-1 divide-y divide-gray-100">
                    <div class="px-4 py-2 bg-emerald-50/60">
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-800">Clean at Sephora</span>
                        <p class="text-[11px] text-gray-500 mt-0.5">Formulated without parabens, sulfates &amp; harmful phthalates.</p>
                    </div>
                    <div class="py-1">
                        <a href="/shop/skincare?clean=1" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>Clean Skincare</span>
                            <span class="text-gray-400 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/makeup?clean=1" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>Clean Makeup</span>
                            <span class="text-gray-400 text-xs">&rsaquo;</span>
                        </a>
                        <a href="/shop/hair?clean=1" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>Clean Haircare</span>
                            <span class="text-gray-400 text-xs">&rsaquo;</span>
                        </a>
                    </div>
                    <div class="p-2.5 bg-neutral-50">
                        <a href="/clean-at-sephora" class="block w-full py-1.5 px-3 border border-emerald-800 text-emerald-900 hover:bg-emerald-800 hover:text-white text-center text-xs font-bold uppercase tracking-wider transition-colors">
                            EXPLORE CLEAN
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</nav>
<!-- END: NavigationBar -->

<!-- BEGIN: MobileMenu -->
<div aria-hidden="true" class="fixed inset-0 z-[70] invisible lg:hidden" data-mobile-menu id="mobile-menu">
    <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-300" data-mobile-menu-close data-mobile-menu-backdrop></div>
    <aside aria-label="Browse menu" aria-modal="true" class="absolute inset-y-0 left-0 w-[85%] max-w-sm bg-white shadow-2xl flex flex-col -translate-x-full transition-transform duration-300 ease-out" data-mobile-menu-panel role="dialog">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
            <a class="logo-font text-xl text-black tracking-[0.25em] font-bold" href="/">SEPHORA</a>
            <button aria-label="Close menu" class="p-2 -mr-2 text-black hover:opacity-70 transition-opacity" data-mobile-menu-close type="button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>
        <nav aria-label="Mobile" class="flex-1 overflow-y-auto px-5 py-3 divide-y divide-gray-100">

            {{-- 1. The Holiday Collection --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-bold text-[#b45309] cursor-pointer list-none py-1">
                    <span>The Holiday Collection</span>
                    <svg class="w-4 h-4 text-amber-600 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-amber-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/makeup" class="block py-1 text-gray-700 hover:text-black">Makeup</a>
                    <a href="/shop/fragrance" class="block py-1 text-gray-700 hover:text-black">Fragrance</a>
                    <a href="/shop/skincare" class="block py-1 text-gray-700 hover:text-black">Skincare</a>
                    <a href="/shop/hair" class="block py-1 text-gray-700 hover:text-black">Hair</a>
                    <a href="/brands/sephora-collection" class="block py-1 text-gray-700 hover:text-black">Sephora Collection</a>
                    <a href="/shop/gifts" class="block py-1 font-bold text-black border-t border-gray-100 pt-1.5">View All &rarr;</a>
                    <a href="/shop/gifts" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-1">SHOP ALL</a>
                </div>
            </details>

            {{-- 2. Stack Your Scent --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>Stack Your Scent</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/fragrance?family=fruity" class="block py-1 text-gray-700 hover:text-black">Fruity Gourmands</a>
                    <a href="/shop/fragrance?family=musky" class="block py-1 text-gray-700 hover:text-black">Skin Musks</a>
                    <a href="/shop/fragrance?family=fresh" class="block py-1 text-gray-700 hover:text-black">Lavender Blends</a>
                    <a href="/shop/fragrance" class="block py-1 font-bold text-black border-t border-gray-100 pt-1.5">View All &rarr;</a>
                    <a href="/shop/fragrance" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-1">SHOP ALL</a>
                </div>
            </details>

            {{-- 3. Beauty Offers (Direct Link) --}}
            <a class="block py-3 text-sm font-semibold text-gray-900 hover:text-black hover:translate-x-1 transition-all" href="/beauty-offers">
                Beauty Offers
            </a>

            {{-- 4. New --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>New</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/new" class="block py-1 font-bold text-black">View All</a>
                    <a href="/shop/new?cat=makeup" class="block py-1 text-gray-700 hover:text-black">New in Makeup</a>
                    <a href="/shop/new?cat=fragrance" class="block py-1 text-gray-700 hover:text-black">New in Fragrance</a>
                    <a href="/shop/new?cat=skincare" class="block py-1 text-gray-700 hover:text-black">New in Skincare</a>
                    <a href="/shop/new?cat=hair" class="block py-1 text-gray-700 hover:text-black">New in Haircare</a>
                    <a href="/brands/sephora-collection?new=1" class="block py-1 text-gray-700 hover:text-black">New in Sephora Collection</a>
                    <div class="pt-2 border-t border-gray-100">
                        <span class="font-bold text-[11px] uppercase tracking-wider text-black block mb-1">New in Brands</span>
                        <div class="grid grid-cols-2 gap-1 text-[11px] text-gray-600">
                            <a href="/search?q=Haus+Labs" class="block py-0.5">Haus Labs</a>
                            <a href="/search?q=Oribe" class="block py-0.5">Oribe</a>
                            <a href="/search?q=Mediheal" class="block py-0.5">Mediheal</a>
                            <a href="/search?q=Tweezerman" class="block py-0.5">Tweezerman</a>
                            <a href="/search?q=Estrid" class="block py-0.5">Estrid</a>
                            <a href="/search?q=BBB+London" class="block py-0.5">BBB London</a>
                            <a href="/search?q=Moonglaze" class="block py-0.5">Moonglaze</a>
                            <a href="/search?q=Starface" class="block py-0.5">Starface</a>
                            <a href="/search?q=Hello+Sunday" class="block py-0.5">Hello Sunday</a>
                            <a href="/search?q=One+Size" class="block py-0.5">One Size</a>
                        </div>
                    </div>
                    <a href="/shop/new" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">SHOP ALL</a>
                </div>
            </details>

            {{-- 5. Makeup --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>Makeup</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <div class="flex flex-wrap gap-2 pb-1 text-[11px] font-bold">
                        <a href="/shop/gifts?category=makeup" class="text-black underline">Makeup Gifts</a>
                        <a href="/shop/new?category=makeup" class="text-black underline">New Arrivals</a>
                        <a href="/shop/bestsellers?category=makeup" class="text-black underline">Bestsellers</a>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">Face</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/face?type=foundation" class="block py-0.5">Foundation</a>
                            <a href="/shop/face?type=primer" class="block py-0.5">Primer</a>
                            <a href="/shop/face?type=concealer" class="block py-0.5">Concealers</a>
                            <a href="/shop/face?type=highlighter" class="block py-0.5">Highlighters</a>
                            <a href="/shop/face?type=bb-cc" class="block py-0.5">BB &amp; CC cream</a>
                            <a href="/shop/face?type=blush" class="block py-0.5">Blush</a>
                            <a href="/shop/face?type=bronzer" class="block py-0.5">Bronzer</a>
                            <a href="/shop/face?type=contour" class="block py-0.5">Contour</a>
                            <a href="/shop/face?type=powder" class="block py-0.5">Powder</a>
                            <a href="/shop/face?type=palette" class="block py-0.5">Face Palette</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">Eyes &amp; Lips</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/makeup?sub=eyeshadow" class="block py-0.5">Eyeshadow</a>
                            <a href="/shop/makeup?sub=mascara" class="block py-0.5">Mascara</a>
                            <a href="/shop/makeup-palettes" class="block py-0.5">Eye Palette</a>
                            <a href="/shop/makeup?sub=eyeliner" class="block py-0.5">Eyeliners</a>
                            <a href="/shop/lips?type=lipstick" class="block py-0.5">Lipsticks</a>
                            <a href="/shop/lips?type=gloss" class="block py-0.5">Gloss</a>
                            <a href="/shop/lips?type=lip-liner" class="block py-0.5">Lip Liner</a>
                            <a href="/shop/lips?type=lip-balm" class="block py-0.5">Lip Balm</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">Brows &amp; Brushes</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/makeup?sub=brow-pencil" class="block py-0.5">Brow Pencil</a>
                            <a href="/shop/makeup?sub=brow-gel" class="block py-0.5">Brow Gel</a>
                            <a href="/shop/makeup?sub=face-brushes" class="block py-0.5">Face Brushes</a>
                            <a href="/shop/makeup?sub=sponges" class="block py-0.5">Sponges</a>
                        </div>
                    </div>
                    <a href="/shop/makeup" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">SHOP ALL</a>
                </div>
            </details>

            {{-- 6. Fragrance --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>Fragrance</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">For Her &amp; Him</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/fragrance?for=her&type=edp" class="block py-0.5">For Her: EDP</a>
                            <a href="/shop/fragrance?for=her&type=edt" class="block py-0.5">For Her: EDT</a>
                            <a href="/shop/fragrance?for=her&type=mist" class="block py-0.5">Fragrance Mist</a>
                            <a href="/shop/fragrance?for=him&type=edp" class="block py-0.5">For Him: EDP</a>
                            <a href="/shop/fragrance?for=him&type=edt" class="block py-0.5">For Him: EDT</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">By Fragrance Family</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/fragrance?family=floral" class="block py-0.5">Floral</a>
                            <a href="/shop/fragrance?family=fresh" class="block py-0.5">Fresh</a>
                            <a href="/shop/fragrance?family=oriental" class="block py-0.5">Oriental</a>
                            <a href="/shop/fragrance?family=woody-oud" class="block py-0.5">Woody &amp; Oud</a>
                            <a href="/shop/fragrance?family=fruity" class="block py-0.5">Fruity</a>
                            <a href="/shop/fragrance?family=amber" class="block py-0.5">Amber</a>
                        </div>
                    </div>
                    <div class="pt-1 border-t border-gray-100 flex flex-wrap gap-3">
                        <a href="/shop/fragrance?sub=home" class="font-bold text-black">Home Fragrance</a>
                        <a href="/shop/gifts/minis-more" class="font-bold text-black">Travel Size</a>
                        <a href="/shop/gifts?category=fragrance" class="font-bold text-black">Gift Sets</a>
                    </div>
                    <a href="/shop/fragrance" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">SHOP ALL</a>
                </div>
            </details>

            {{-- 7. Skincare --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>Skincare</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">All Things Skin</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/skincare?type=day-cream" class="block py-0.5">Day Cream</a>
                            <a href="/shop/skincare?type=night-cream" class="block py-0.5">Night Cream</a>
                            <a href="/shop/skincare?type=serum-oils" class="block py-0.5">Serum &amp; Oils</a>
                            <a href="/shop/skincare?type=eye-cream" class="block py-0.5">Eye Cream</a>
                            <a href="/shop/skincare?type=face-wash" class="block py-0.5">Cleansers</a>
                            <a href="/shop/skincare?type=sheet-masks" class="block py-0.5">Masks</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">Skin Concerns</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/skincare?concern=acne" class="block py-0.5">Acne &amp; Blemish</a>
                            <a href="/shop/skincare?concern=anti-aging" class="block py-0.5">Anti-Aging</a>
                            <a href="/shop/skincare?concern=dark-spots" class="block py-0.5">Dark Spots</a>
                            <a href="/shop/skincare?concern=pore-care" class="block py-0.5">Pore Care</a>
                            <a href="/shop/skincare?concern=dryness" class="block py-0.5">Dryness</a>
                            <a href="/shop/skincare?concern=fine-lines" class="block py-0.5">Fine Lines</a>
                        </div>
                    </div>
                    <a href="/shop/skincare" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">SHOP ALL</a>
                </div>
            </details>

            {{-- 8. Bath & Body --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>Bath &amp; Body</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/bath-body?type=shower-gel" class="block py-1 text-gray-700">Body Wash &amp; Shower Gel</a>
                    <a href="/shop/bath-body?type=scrubs" class="block py-1 text-gray-700">Scrub &amp; Exfoliants</a>
                    <a href="/shop/bath-body?type=body-mist" class="block py-1 text-gray-700">Body Mist</a>
                    <a href="/shop/bath-body?type=lotion" class="block py-1 text-gray-700">Body Lotion</a>
                    <a href="/shop/bath-body?type=hand-care" class="block py-1 text-gray-700">Hand Care</a>
                    <a href="/shop/bath-body?type=candles" class="block py-1 font-bold text-black">Candles and Scents</a>
                    <a href="/shop/bath-body" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">SHOP ALL</a>
                </div>
            </details>

            {{-- 9. Hair --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>Hair</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">Want Great Hair?</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/hair?type=shampoo" class="block py-0.5">Shampoo</a>
                            <a href="/shop/hair?type=conditioner" class="block py-0.5">Conditioner</a>
                            <a href="/shop/hair?type=dry-shampoo" class="block py-0.5">Dry Shampoo</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">Hair Type &amp; Concern</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/hair?type=dry-damaged" class="block py-0.5">Dry &amp; Damaged</a>
                            <a href="/shop/hair?type=curly-frizzy" class="block py-0.5">Curly &amp; Frizzy</a>
                            <a href="/shop/hair?concern=color-care" class="block py-0.5">Color Care</a>
                            <a href="/shop/hair?concern=scalp" class="block py-0.5">Scalp Care</a>
                        </div>
                    </div>
                    <a href="/shop/hair" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">SHOP ALL</a>
                </div>
            </details>

            {{-- 10. Sephora Collection --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>Sephora Collection</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/brands/sephora-collection?type=makeup" class="block py-1 text-gray-700">Makeup</a>
                    <a href="/brands/sephora-collection?type=haircare" class="block py-1 text-gray-700">Haircare</a>
                    <a href="/brands/sephora-collection?type=skincare" class="block py-1 text-gray-700">Skincare</a>
                    <a href="/brands/sephora-collection?type=brushes" class="block py-1 text-gray-700">Brushes and Sponges</a>
                    <a href="/brands/sephora-collection?type=gift-sets" class="block py-1 text-gray-700">Value and Gift Sets</a>
                    <a href="/brands/sephora-collection" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">SHOP ALL</a>
                </div>
            </details>

            {{-- 11. Brands --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>Brands</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <a href="/brands" class="block py-1 font-bold text-black">Brands A to Z &rarr;</a>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">Featured Brands</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/brands/huda-beauty" class="block py-0.5">Huda Beauty</a>
                            <a href="/brands/kayali" class="block py-0.5">Kayali</a>
                            <a href="/search?q=Saie" class="block py-0.5">Saie</a>
                            <a href="/brands/glow-recipe" class="block py-0.5">Glow Recipe</a>
                            <a href="/brands/gisou" class="block py-0.5">Gisou</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">Trending Brands</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/search?q=Makeup+by+Mario" class="block py-0.5">Makeup by Mario</a>
                            <a href="/search?q=Patrick+Ta" class="block py-0.5">Patrick Ta</a>
                            <a href="/search?q=Phlur" class="block py-0.5">Phlur</a>
                            <a href="/brands/k18" class="block py-0.5">K18</a>
                        </div>
                    </div>
                    <a href="/brands" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">SHOP ALL</a>
                </div>
            </details>

            {{-- 12. Gifts --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>Gifts</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/gifts?type=sets" class="block py-1 font-semibold text-black">Gift Sets</a>
                    <a href="/shop/gifts/minis-more" class="block py-1 font-semibold text-black">Minis &amp; More</a>
                    <div class="pt-1 border-t border-gray-100">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-1">By Category</span>
                        <a href="/shop/gifts?category=makeup" class="block py-0.5 text-gray-600">Makeup</a>
                        <a href="/shop/gifts?category=skincare" class="block py-0.5 text-gray-600">Skincare</a>
                        <a href="/shop/gifts?category=fragrance" class="block py-0.5 text-gray-600">Fragrance</a>
                        <a href="/shop/gifts?category=hair" class="block py-0.5 text-gray-600">Hair</a>
                    </div>
                    <a href="/shop/gifts" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-1">SHOP ALL</a>
                </div>
            </details>

            {{-- 13. Clean --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-emerald-800 cursor-pointer list-none py-1 hover:text-emerald-950">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"></path></svg>
                        Clean at Sephora
                    </span>
                    <svg class="w-4 h-4 text-emerald-600 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ml-3 pl-3 border-l-2 border-emerald-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/skincare?clean=1" class="block py-1 text-gray-700">Clean Skincare</a>
                    <a href="/shop/makeup?clean=1" class="block py-1 text-gray-700">Clean Makeup</a>
                    <a href="/shop/hair?clean=1" class="block py-1 text-gray-700">Clean Haircare</a>
                    <a href="/clean-at-sephora" class="block py-1.5 px-3 bg-emerald-800 text-white text-center font-bold uppercase rounded-sm mt-1">EXPLORE CLEAN</a>
                </div>
            </details>

        </nav>
        <div class="border-t border-gray-200 px-5 py-4 space-y-2 bg-gray-50 text-sm">
            <a class="flex items-center gap-3 py-2 text-gray-900 font-medium" href="/stores">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>Stores &amp; Services</span>
            </a>
            <a class="flex items-center gap-3 py-2 text-gray-900 font-medium" href="/my-account">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>My Account</span>
            </a>
            <a class="flex items-center gap-3 py-2 text-gray-900 font-medium" href="/my-account/settings/country-and-language">
                <span class="inline-flex w-5 h-3.5 overflow-hidden rounded-[2px] border border-gray-300 shrink-0">
                    <svg viewBox="0 0 600 300" class="w-full h-full object-cover">
                        <rect width="600" height="100" fill="#00732f" />
                        <rect y="100" width="600" height="100" fill="#ffffff" />
                        <rect y="200" width="600" height="100" fill="#000000" />
                        <rect width="150" height="300" fill="#ff0000" />
                    </svg>
                </span>
                <span>United Arab Emirates (AED)</span>
            </a>
        </div>
    </aside>
</div>
<!-- END: MobileMenu -->
