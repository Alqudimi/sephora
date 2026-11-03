{{--
    Shared storefront header: announcement bar, main header, category navigation
    and the mobile off-canvas menu. Counts are shared by AppServiceProvider.
--}}
@php
    $cartBadgeCount = (int) ($cartCount ?? $bagCount ?? 0);
    $wishlistBadgeCount = (int) ($wishlistCount ?? 0);
    $primaryNav = [
        ['label' => 'Stack Your Scent', 'href' => '/shop/fragrance', 'class' => 'text-[#b87d60] font-semibold'],
        ['label' => 'The Holiday Collection', 'href' => '/shop/gifts', 'class' => 'text-[#204070] font-semibold'],
        ['label' => 'Beauty Offers', 'href' => '/beauty-offers', 'class' => ''],
        ['label' => 'New', 'href' => '/shop/new', 'class' => 'font-semibold text-black'],
        ['label' => 'Makeup', 'href' => '/shop/makeup', 'class' => ''],
        ['label' => 'Fragrance', 'href' => '/shop/fragrance', 'class' => ''],
        ['label' => 'Skincare', 'href' => '/shop/skincare', 'class' => ''],
        ['label' => 'Bath & Body', 'href' => '/shop/bath-body', 'class' => ''],
        ['label' => 'Hair', 'href' => '/shop/hair', 'class' => ''],
        ['label' => 'Sephora Collection', 'href' => '/brands/sephora-collection', 'class' => 'font-medium'],
        ['label' => 'Brands', 'href' => '/brands', 'class' => ''],
        ['label' => 'Best Sellers', 'href' => '/shop/bestsellers', 'class' => ''],
        ['label' => 'Gifts', 'href' => '/shop/gifts', 'class' => ''],
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

        <!-- Sephora Wordmark Logo -->
        <div class="flex items-center shrink-0">
            <a class="logo-font text-xl sm:text-2xl md:text-3xl text-black hover:opacity-90 tracking-[0.25em] pl-1 font-bold" href="/">
                SEPHORA
            </a>
        </div>

        <!-- Search Input (desktop) -->
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

        <!-- Right Utility Actions -->
        <div class="flex items-center space-x-3 sm:space-x-5 md:space-x-6 shrink-0 text-sm">
            <!-- Stores & Services -->
            <a class="hidden lg:flex items-center gap-2 hover:opacity-75 transition-opacity text-gray-900 font-medium" href="/stores">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="text-[13px] tracking-tight">Stores &amp; Services</span>
            </a>

            <!-- Divider Line -->
            <div class="hidden lg:block h-6 w-px bg-gray-300"></div>

            <!-- Country Flag UAE -->
            <button aria-label="Select Country" class="hidden sm:flex items-center hover:opacity-85" type="button">
                <span class="w-6 h-6 rounded-full overflow-hidden flex border border-gray-200 shadow-sm">
                    <span class="w-2 bg-[#ff0000] h-full"></span>
                    <span class="flex-1 flex flex-col h-full">
                        <span class="h-1/3 bg-[#00732f]"></span>
                        <span class="h-1/3 bg-[#ffffff]"></span>
                        <span class="h-1/3 bg-[#000000]"></span>
                    </span>
                </span>
            </button>

            <!-- Account / Sign In -->
            <a aria-label="Account" class="flex items-center text-black hover:opacity-70 transition-opacity" href="/my-account">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewbox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>

            <!-- Wishlist -->
            <a aria-label="Wishlist" class="relative flex items-center text-black hover:opacity-70 transition-opacity" href="/my-account/wishlist">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewbox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="absolute -top-1.5 -right-2 min-w-[16px] h-4 px-1 bg-black text-white text-[9px] font-bold rounded-full flex items-center justify-center leading-none {{ $wishlistBadgeCount > 0 ? '' : 'hidden' }}" data-wishlist-count>{{ $wishlistBadgeCount }}</span>
            </a>

            <!-- Shopping Bag -->
            <a aria-label="Shopping Bag" class="relative flex items-center text-black hover:opacity-70 transition-opacity" href="/cart">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewbox="0 0 24 24">
                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="absolute -top-1.5 -right-2 min-w-[16px] h-4 px-1 bg-black text-white text-[9px] font-bold rounded-full flex items-center justify-center leading-none {{ $cartBadgeCount > 0 ? '' : 'hidden' }}" data-bag-count>{{ $cartBadgeCount }}</span>
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

<!-- BEGIN: NavigationBar -->
<nav aria-label="Primary" class="border-b border-gray-200 bg-white overflow-x-auto custom-scrollbar scrollbar-hidden">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8 py-2.5 flex items-center gap-5 lg:gap-7 min-w-max text-gray-700">
        @foreach ($primaryNav as $link)
            <a class="sephora-nav-item {{ $link['class'] }}" href="{{ $link['href'] }}">{{ $link['label'] }}</a>
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
                Stores &amp; Services
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
