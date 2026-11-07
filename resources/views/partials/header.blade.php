{{--
    Shared storefront header: announcement bar, main header, category navigation
    and the mobile off-canvas menu. Counts are shared by AppServiceProvider.
    Design inspired by Chrome devtools extraction with improved visual polish.
    Hover dropdown menus added for primary navigation items.
--}}
@php
    $cartBadgeCount = (int) ($cartCount ?? $bagCount ?? 0);
    $wishlistBadgeCount = (int) ($wishlistCount ?? 0);
    $primaryNav = [
        ['label' => 'Stack Your Scent', 'href' => '/shop/fragrance', 'has_dropdown' => false],
        ['label' => 'The Holiday Collection', 'href' => '/shop/gifts', 'has_dropdown' => false],
        ['label' => 'Beauty Offers', 'href' => '/beauty-offers', 'has_dropdown' => false],
        ['label' => 'New', 'href' => '/shop/new', 'has_dropdown' => false],
        ['label' => 'Makeup', 'href' => '/shop/makeup', 'has_dropdown' => true],
        ['label' => 'Fragrance', 'href' => '/shop/fragrance', 'has_dropdown' => true],
        ['label' => 'Skincare', 'href' => '/shop/bath-body', 'has_dropdown' => true],
        ['label' => 'Hair', 'href' => '/shop/hair', 'has_dropdown' => true],
        ['label' => 'Sephora Collection', 'href' => '/brands/sephora-collection', 'has_dropdown' => false],
        ['label' => 'Brands', 'href' => '/brands', 'has_dropdown' => true],
        ['label' => 'Best Sellers', 'href' => '/shop/bestsellers', 'has_dropdown' => false],
        ['label' => 'Gifts', 'href' => '/shop/gifts', 'has_dropdown' => false],
    ];
@endphp

<!-- BEGIN: AnnouncementBar -->
<div class="bg-[#f2efe9] text-black text-[12px] md:text-[13px] py-2 px-4 text-center font-normal tracking-tight border-b border-neutral-200" data-purpose="top-announcement">
    <p>
        <span class="font-bold">Want to turn heads?</span>
        Your signature scent starts here. Discover the collection and layer without limits
        <a class="underline font-bold hover:text-gray-700 ml-1" href="/shop/bestsellers">SHOP NOW</a>
    </p>
</div>
<!-- END: AnnouncementBar -->

<!-- BEGIN: MainHeader -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-50" data-site-header>
    <div class="max-w-[1440px] mx-auto px-4 md:px-8 py-3.5 flex items-center justify-between gap-3 sm:gap-4 lg:gap-8">
        <!-- Mobile menu trigger -->
        <button
            aria-controls="mobile-menu"
            aria-expanded="false"
            aria-label="Open menu"
            class="lg:hidden -ml-1 p-1 text-black hover:opacity-70 transition-opacity shrink-0"
            data-mobile-menu-toggle
            type="button"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <!-- Enhanced Logo -->
        <div class="flex items-center shrink-0">
            <a class="logo-font text-xl sm:text-2xl md:text-3xl text-black hover:opacity-90 tracking-[0.25em] pl-1 font-bold" href="/">
                SEPHORA
            </a>
        </div>

        <!-- Enhanced Search Input (desktop) -->
        <form action="/search" class="flex-1 max-w-2xl hidden md:block" method="GET" role="search">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                        <path d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <input
                    class="w-full pl-10 pr-4 py-2 bg-[#f0f2f4] rounded-sm text-sm border-0 focus:ring-1 focus:ring-black placeholder-gray-500 text-gray-800 transition-colors"
                    name="q"
                    placeholder="Search..."
                    type="search"
                    value="{{ request('q') }}"
                />
            </div>
        </form>

        <!-- Enhanced Right Utility Actions -->
        <div class="flex items-center space-x-3 sm:space-x-5 md:space-x-6 shrink-0 text-sm">
            <!-- Stores & Services -->
            <a class="hidden lg:flex items-center gap-2 hover:opacity-75 transition-opacity text-gray-900 font-medium" href="/stores">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="text-[13px] tracking-tight">Stores & Services</span>
            </a>

            <!-- Enhanced Divider Line -->
            <div class="hidden lg:block h-px w-1/6 bg-gradient-to-r from-gray-300 to-transparent"></div>

            <!-- Country Flag UAE (inspired by extracted design) -->
            <button aria-label="Select Country" class="hidden lg:flex items-center gap-2 hover:opacity-85 transition-opacity rounded-full px-2 py-1.5 border border-gray-200 shadow-sm" type="button">
                <div class="w-2 h-full rounded-full bg-[#ff0000]"></div>
                <div class="flex-1 flex flex-col h-px">
                    <div class="h-1/3 bg-[#00732f]"></div>
                    <div class="h-1/3 bg-[#ffffff]"></div>
                    <div class="h-1/3 bg-[#000000]"></div>
                </div>
            </button>

            <!-- Account / Sign In -->
            <a aria-label="Account" class="flex items-center gap-1.5 hover:opacity-70 transition-opacity text-gray-900" href="/my-account">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewbox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>

            <!-- Wishlist -->
            <a aria-label="Wishlist" class="relative flex items-center gap-1.5 hover:opacity-70 transition-opacity text-gray-900" href="/my-account/wishlist">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewbox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="absolute -top-0.5 -right-1 min-w-[14px] h-3 px-0.5 bg-black text-white text-[8px] font-bold rounded-full flex items-center justify-center leading-none {{ $wishlistBadgeCount > 0 ? '' : 'hidden' }}" data-wishlist-count>{{ $wishlistBadgeCount }}</span>
            </a>

            <!-- Shopping Bag -->
            <a aria-label="Shopping Bag" class="relative flex items-center gap-1.5 hover:opacity-70 transition-opacity text-gray-900" href="/cart">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewbox="0 0 24 24">
                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="absolute -top-0.5 -right-1 min-w-[14px] h-3 px-0.5 bg-black text-white text-[8px] font-bold rounded-full flex items-center justify-center leading-none {{ $cartBadgeCount > 0 ? '' : 'hidden' }}" data-bag-count>{{ $cartBadgeCount }}</span>
            </a>
        </div>
    </div>

    <!-- Mobile Search Row -->
    <form action="/search" class="px-4 pb-3 md:hidden" method="GET" role="search">
        <div class="relative w-full">
            <input
                class="w-full pl-9 pr-3 py-1.5 bg-[#f0f2f4] rounded-sm text-sm border-0 focus:ring-1 focus:ring-black placeholder-gray-500"
                name="q"
                placeholder="Search..."
                type="search"
                value="{{ request('q') }}"
            />
            <svg class="w-4 h-4 text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                <path d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
    </form>
</header>
<!-- END: MainHeader -->

<!-- BEGIN: NavigationBar with Dropdowns -->
<nav aria-label="Primary" class="border-b border-gray-200 bg-white overflow-x-auto custom-scrollbar scrollbar-hidden">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8 py-2.5 flex items-center gap-5 lg:gap-7 min-w-max text-gray-700">
        @foreach ($primaryNav as $link)
            @if ($link['has_dropdown'])
            <!-- Dropdown Item -->
            <div group-hover="block" class="relative sephora-nav-item-dropdown hover:text-black">
                <a href="{{ $link['href'] }}" class="sephora-nav-item-dropdown-link flex items-center gap-2 rounded-md px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    <span>{{ $link['label'] }}</span>
                    <svg class="w-4 h-4 shrink-0 rotate-180 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24">
                        <path d="M5 15l7-7 7 7" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
                <!-- Dropdown Menu -->
                <div class="absolute top-full left-0 mt-2 w-48 rounded-md bg-white shadow-lg py-1 pl-1 origin-top-right shadow-md opacity-0 visibility-hidden transition-all duration-200 group-hover:opacity-100 group-hover:visibility-hidden">
                    <a href="#" class="block px-2 py-1.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Sub Category 1</a>
                    <a href="#" class="block px-2 py-1.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Sub Category 2</a>
                    <a href="#" class="block px-2 py-1.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Sub Category 3</a>
                </div>
            </div>
            @else
            <!-- Regular Nav Item -->
            <a href="{{ $link['href'] }}" class="sephora-nav-item {{ $link['class'] }}" tabindex="true">{{ $link['label'] }}</a>
            @endif
        @endforeach
    </div>
</nav>
<!-- END: NavigationBar -->

<!-- BEGIN: MobileMenu -->
<div aria-hidden="true" class="fixed inset-0 z-[70] invisible lg:hidden" data-mobile-menu id="mobile-menu">
    <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-300" data-mobile-menu-close data-mobile-menu-backdrop></div>
    <aside aria-label="Browse menu" aria-modal="true" class="absolute inset-y-0 left-0 w-[85%] max-w-sm bg-white shadow-2xl flex flex-col -translate-x-full transition-transform duration-300 ease-out" data-mobile-menu-panel role="dialog">
        <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200">
            <a class="logo-font text-xl text-black tracking-[0.25em] font-bold" href="/">SEPHORA</a>
            <button aria-label="Close menu" class="p-1 text-black hover:opacity-70 transition-opacity" data-mobile-menu-close type="button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                    <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>
        <nav aria-label="Mobile" class="flex-1 overflow-y-auto px-4 py-3">
            @foreach ($primaryNav as $link)
                <a class="block py-2.5 text-sm border-b border-gray-100 last:border-b-0 {{ $link['class'] }}" href="{{ $link['href'] }}">{{ $link['label'] }}</a>
            @endforeach
        </nav>
        <div class="border-t border-gray-200 px-4 py-3 space-y-1 text-sm">
            <a class="flex items-center gap-3 py-2 text-gray-900 font-medium" href="/stores">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                Stores & Services
            </a>
            <a class="flex items-center gap-3 py-2 text-gray-900 font-medium" href="/my-account">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewbox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                My Account
            </a>
        </div>
    </aside>
</div>
<!-- END: MobileMenu -->