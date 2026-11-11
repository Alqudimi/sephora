{{--
    Shared storefront header: announcement bar, main header, category navigation
    with luxury multi-column mega menus and compact editorial dropdowns,
    and the mobile off-canvas menu.
--}}
@php
    $cartBadgeCount = (int) ($cartCount ?? $bagCount ?? 0);
    $wishlistBadgeCount = (int) ($wishlistCount ?? 0);
    $announcementEnabled = \App\Models\Setting::get('announcement_enabled', '1') !== '0';
    $announcementBold = __($announcementSettingBold = \App\Models\Setting::get('announcement_bold', __('messages.nav.holiday_collection')));
    $announcementMessage = __($announcementSettingMessage = \App\Models\Setting::get('announcement_message', __('messages.homepage.holiday_subtitle')));
    $announcementAction = __($announcementSettingAction = \App\Models\Setting::get('announcement_action_text', __('messages.shop_all')));
    $announcementLink = \App\Models\Setting::get('announcement_action_link', '/shop/gifts');
    $announcementBg = \App\Models\Setting::get('announcement_bg_color', '#1A3066');
    $announcementColor = \App\Models\Setting::get('announcement_text_color', '#FFFFFF');
@endphp

@if ($announcementEnabled)
<!-- BEGIN: AnnouncementBar -->
<div class="text-[13px] sm:text-[14px] py-2.5 px-4 text-center font-normal tracking-normal border-b border-black/10" style="background-color: {{ $announcementBg }}; color: {{ $announcementColor }};" data-purpose="top-announcement">
    <div class="max-w-[1440px] mx-auto flex items-center justify-center gap-3 sm:gap-4 flex-wrap">
        <span class="font-normal opacity-95">
            @if ($announcementBold)<strong class="font-bold">{{ $announcementBold }}</strong> &nbsp;|&nbsp; @endif
            {{ $announcementMessage }}
        </span>
        @if ($announcementAction && $announcementLink)
            <a class="underline font-bold hover:opacity-80 uppercase tracking-wider text-[12px] sm:text-[13px] transition-colors whitespace-nowrap inline-flex items-center gap-1" style="color: {{ $announcementColor }};" href="{{ $announcementLink }}">
                {{ $announcementAction }}
            </a>
        @endif
    </div>
</div>
<!-- END: AnnouncementBar -->
@endif

<!-- BEGIN: MainHeader -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-50" data-site-header>
    <div class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-8 py-3 sm:py-3.5 flex items-center justify-between gap-2 sm:gap-4 lg:gap-8">
        <!-- Mobile menu trigger -->
        <button
            aria-controls="mobile-menu"
            aria-expanded="false"
            aria-label="{{ __('nav_menu.open_menu') }}"
            class="lg:hidden p-1.5 -ms-1 text-black hover:opacity-70 transition-opacity shrink-0 min-w-[36px] min-h-[36px] flex items-center justify-center"
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
                <div class="absolute inset-y-0 start-0 ps-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <input
                    class="w-full ps-10 pe-4 py-2 bg-[#F2F2F2] rounded-sm text-sm border-0 focus:ring-1 focus:ring-black placeholder-gray-500 text-gray-800 transition-colors"
                    name="q"
                    placeholder="{{ __('messages.nav.search_placeholder') }}"
                    type="search"
                    value="{{ request('q') }}"
                />
            </div>
        </form>

        <!-- Enhanced Right Utility Actions -->
        <div class="flex items-center gap-2 sm:gap-4 md:gap-5 shrink-0 text-sm">
            <!-- Stores & Services -->
            <a class="hidden lg:flex items-center gap-2 hover:opacity-75 transition-opacity text-gray-900 font-medium shrink-0" href="/stores">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="text-[13px] tracking-tight whitespace-nowrap">{{ __('messages.nav.stores_services') }}</span>
            </a>

            <!-- Divider Line -->
            <div class="hidden lg:block h-5 w-px bg-gray-200 shrink-0"></div>

            <!-- Quick Language Switcher Button (English / العربية) -->
            @php
                $targetLang = app()->getLocale() === 'ar' ? 'en' : 'ar';
                $targetLabel = app()->getLocale() === 'ar' ? 'English' : 'العربية';
            @endphp
            <a href="{{ route('locale.switch', ['lang' => $targetLang]) }}" aria-label="{{ __('nav_menu.switch_language_to', ['lang' => $targetLabel]) }}" class="hidden lg:flex items-center gap-1.5 hover:bg-gray-100 transition-colors rounded-full px-3 py-1 border border-gray-300 bg-white text-gray-900 font-bold text-xs shrink-0">
                <span class="inline-flex w-4 h-3 overflow-hidden rounded-[2px] border border-gray-200 shrink-0">
                    <svg viewBox="0 0 600 300" class="w-full h-full object-cover">
                        <rect width="600" height="100" fill="#00732f" />
                        <rect y="100" width="600" height="100" fill="#ffffff" />
                        <rect y="200" width="600" height="100" fill="#000000" />
                        <rect width="150" height="300" fill="#ff0000" />
                    </svg>
                </span>
                <span>{{ $targetLabel }}</span>
            </a>

            <!-- Account / Sign In -->
            <a aria-label="{{ __('nav_menu.account') }}" class="p-1 hover:opacity-70 transition-opacity text-gray-900 shrink-0" href="/my-account">
                <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>

            <!-- Wishlist -->
            <a aria-label="{{ __('nav_menu.wishlist') }}" class="relative p-1 hover:opacity-70 transition-opacity text-gray-900 shrink-0" href="/my-account/wishlist">
                <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="absolute -top-0.5 -end-0.5 min-w-[15px] h-3.5 px-0.5 bg-black text-white text-[8px] font-bold rounded-full flex items-center justify-center leading-none {{ $wishlistBadgeCount > 0 ? '' : 'hidden' }}" data-wishlist-count>{{ $wishlistBadgeCount }}</span>
            </a>

            <!-- Shopping Bag -->
            <a aria-label="{{ __('nav_menu.shopping_bag') }}" class="relative p-1 hover:opacity-70 transition-opacity text-gray-900 shrink-0" href="/cart">
                <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="absolute -top-0.5 -end-0.5 min-w-[15px] h-3.5 px-0.5 bg-black text-white text-[8px] font-bold rounded-full flex items-center justify-center leading-none {{ $cartBadgeCount > 0 ? '' : 'hidden' }}" data-bag-count>{{ $cartBadgeCount }}</span>
            </a>
        </div>
    </div>

    <!-- Mobile Search Row -->
    <form action="/search" class="px-3 pb-3 md:hidden" method="GET" role="search">
        <div class="relative w-full">
            <input
                class="w-full ps-9 pe-3 py-1.5 bg-[#F2F2F2] rounded-sm text-sm border-0 focus:ring-1 focus:ring-black placeholder-gray-500"
                name="q"
                placeholder="{{ __('messages.nav.search_placeholder') }}"
                type="search"
                value="{{ request('q') }}"
            />
            <svg class="w-4 h-4 text-gray-400 absolute start-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
    </form>
</header>
<!-- END: MainHeader -->

<!-- BEGIN: NavigationBar with Expanding Mega Menus & Dropdowns -->
<nav aria-label="{{ __('nav_menu.primary_nav') }}" class="border-b border-gray-200 bg-white relative z-40">
    <div class="max-w-[1440px] mx-auto px-3 sm:px-4 md:px-6 lg:px-8 flex items-stretch justify-between gap-1 xl:gap-2 text-gray-700 h-11 overflow-x-auto lg:overflow-visible custom-scrollbar scrollbar-hidden">

        {{-- 1. The Holiday Collection (Official Deep Navy #1A3066) --}}
        <div class="relative group flex items-center h-full shrink-0">
            <a href="/shop/gifts"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-bold text-[#1A3066] hover:text-[#0f1f45] transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-[#1A3066] after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>{{ __('messages.nav.holiday_collection') }}</span>
                <svg class="w-3 h-3 text-[#1A3066]/70 group-hover:text-[#1A3066] transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Compact Seasonal Dropdown -->
            <div class="absolute top-full start-0 w-64 pt-1 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="bg-white rounded-b-md border border-t-2 border-gray-200 border-t-[#1A3066] shadow-2xl overflow-hidden py-1 divide-y divide-gray-100">
                    <div class="px-4 py-2 bg-gradient-to-r from-blue-50/80 to-transparent">
                        <span class="text-[10px] font-black uppercase tracking-widest text-[#1A3066]">{{ __('nav_menu.holiday_gifts_campaign') }}</span>
                    </div>
                    <div class="py-1">
                        <a href="/shop/makeup" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>{{ __('nav_menu.makeup') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/fragrance" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>{{ __('nav_menu.fragrance') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/skincare" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>{{ __('nav_menu.skincare') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/hair" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>{{ __('nav_menu.hair') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/brands/sephora-collection" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>{{ __('nav_menu.sephora_collection') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/gifts" class="flex items-center justify-between px-4 py-2.5 text-xs font-bold text-black hover:bg-neutral-100 transition-colors border-t border-gray-100">
                            <span>{{ __('nav_menu.view_all') }}</span>
                            <span class="text-black text-xs font-bold">&rarr;</span>
                        </a>
                    </div>
                    <div class="p-2.5 bg-neutral-50">
                        <a href="/shop/gifts" class="block w-full py-1.5 px-3 border border-black text-black hover:bg-black hover:text-white text-center text-xs font-bold uppercase tracking-wider transition-colors">
                            {{ __('nav_menu.shop_all') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Stack Your Scent (Official Warm Bronze #BBA08B) --}}
        <div class="relative group flex items-center h-full shrink-0">
            <a href="/shop/fragrance"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-bold text-[#BBA08B] hover:text-[#9e836e] transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-[#BBA08B] after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>{{ __('messages.nav.stack_your_scent') }}</span>
                <svg class="w-3 h-3 text-[#BBA08B]/80 group-hover:text-[#BBA08B] transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Compact Editorial Dropdown -->
            <div class="absolute top-full start-0 w-64 pt-1 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="bg-white rounded-b-md border border-t-2 border-gray-200 border-t-[#BBA08B] shadow-2xl overflow-hidden py-1 divide-y divide-gray-100">
                    <div class="px-4 py-2 bg-[#BBA08B]/10">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#BBA08B]">{{ __('nav_menu.curated_scent_layering') }}</span>
                    </div>
                    <div class="py-1">
                        <a href="/shop/fragrance?family=fruity" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>{{ __('nav_menu.fruity_gourmands') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/fragrance?family=musky" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>{{ __('nav_menu.skin_musks') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/fragrance?family=fresh" class="flex items-center justify-between px-4 py-2 text-xs font-medium text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors">
                            <span>{{ __('nav_menu.lavender_blends') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/fragrance" class="flex items-center justify-between px-4 py-2.5 text-xs font-bold text-black hover:bg-neutral-100 transition-colors border-t border-gray-100">
                            <span>{{ __('nav_menu.view_all') }}</span>
                            <span class="text-black text-xs font-bold">&rarr;</span>
                        </a>
                    </div>
                    <div class="p-2.5 bg-neutral-50">
                        <a href="/shop/fragrance" class="block w-full py-1.5 px-3 border border-black text-black hover:bg-black hover:text-white text-center text-xs font-bold uppercase tracking-wider transition-colors">
                            {{ __('nav_menu.shop_all') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Beauty Offers (Direct Link - No Dropdown) --}}
        <div class="flex items-center h-full shrink-0">
            <a href="/beauty-offers"
               class="h-full flex items-center px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 hover:after:w-full after:transition-all after:duration-150">
                <span>{{ __('messages.nav.beauty_offers') }}</span>
            </a>
        </div>

        {{-- 4. New (Discovery Panel with Categories, Brands & Promos) --}}
        <div class="group flex items-center h-full shrink-0">
            <a href="/shop/new"
               class="h-full flex items-center gap-1 px-1.5 xl:px-2 text-[12px] xl:text-[13px] font-semibold text-gray-800 hover:text-black transition-colors whitespace-nowrap relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-black after:w-0 group-hover:after:w-full after:transition-all after:duration-150">
                <span>{{ __('messages.nav.new') }}</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                    <div class="grid grid-cols-12 gap-6 lg:gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">
                        <!-- Column 1: Shortcuts / Categories -->
                        <div class="col-span-12 md:col-span-3 space-y-2 border-b md:border-b-0 md:border-e border-gray-100 pb-4 md:pb-0 md:pe-6">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-3">{{ __('nav_menu.just_dropped') }}</h3>
                            <ul class="space-y-1.5 text-xs">
                                <li><a href="/shop/new" class="font-bold text-black hover:underline block py-0.5">{{ __('nav_menu.view_all') }}</a></li>
                                <li><a href="/shop/new?cat=makeup" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.new_in_makeup') }}</a></li>
                                <li><a href="/shop/new?cat=fragrance" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.new_in_fragrance') }}</a></li>
                                <li><a href="/shop/new?cat=skincare" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.new_in_skincare') }}</a></li>
                                <li><a href="/shop/new?cat=hair" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.new_in_haircare') }}</a></li>
                                <li><a href="/brands/sephora-collection?new=1" class="text-gray-600 hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.new_in_sephora_collection') }}</a></li>
                            </ul>
                        </div>

                        <!-- Column 2: New in Brands -->
                        <div class="col-span-12 md:col-span-4 border-b md:border-b-0 md:border-e border-gray-100 pb-4 md:pb-0 md:pe-6">
                            <a href="/brands" class="text-xs font-bold uppercase tracking-wider text-black mb-3 inline-flex items-center gap-1 hover:underline">
                                <span>{{ __('nav_menu.new_in_brands') }}</span>
                                <span class="text-xs">&rarr;</span>
                            </a>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-1.5 text-xs text-gray-600 mt-2">
                                <a href="/search?q=Haus+Labs" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_haus_labs_full') }}</a>
                                <a href="/search?q=BBB+London" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_bbb_london') }}</a>
                                <a href="/search?q=Oribe" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_oribe') }}</a>
                                <a href="/search?q=Moonglaze" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_moonglaze') }}</a>
                                <a href="/search?q=Mediheal" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_mediheal') }}</a>
                                <a href="/search?q=Starface" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_starface') }}</a>
                                <a href="/search?q=Tweezerman" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_tweezerman') }}</a>
                                <a href="/search?q=Hello+Sunday" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_hello_sunday') }}</a>
                                <a href="/search?q=Estrid" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_estrid') }}</a>
                                <a href="/search?q=One+Size" class="hover:text-black hover:translate-x-0.5 transition-transform py-0.5">{{ __('nav_menu.brand_one_size') }}</a>
                            </div>
                        </div>

                        <!-- Column 3: Promotional Units (Kayali, YSL, YTTP) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-5 space-y-3">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 block">{{ __('nav_menu.featured_highlights') }}</span>
                            <div class="grid grid-cols-3 gap-3">
                                <a href="/brands/kayali" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[4/3] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/products/Kayali_VIAB_BrandHighlight.jpg') }}" alt="{{ __('nav_menu.brand_kayali') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[11px] text-black truncate">{{ __('nav_menu.brand_kayali') }}</p>
                                    <span class="text-[10px] text-gray-500 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">{{ __('nav_menu.shop_now') }} <span class="inline-block rtl:rotate-180"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span></span>
                                </a>
                                <a href="/brands/yves-saint-laurent" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[4/3] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/products/YSL_Libre_-_Brand_Highlight.jpg') }}" alt="{{ __('nav_menu.brand_ysl') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[11px] text-black truncate">{{ __('nav_menu.brand_ysl') }}</p>
                                    <span class="text-[10px] text-gray-500 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">{{ __('nav_menu.shop_now') }} <span class="inline-block rtl:rotate-180"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span></span>
                                </a>
                                <a href="/brands/youth-to-the-people" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[4/3] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/products/YTTP_-_Brand_Highlights_-_1744x992.jpg') }}" alt="{{ __('nav_menu.brand_yttp') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[11px] text-black truncate">{{ __('nav_menu.brand_yttp') }}</p>
                                    <span class="text-[10px] text-gray-500 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">{{ __('nav_menu.shop_now') }} <span class="inline-block rtl:rotate-180"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span></span>
                                </a>
                            </div>
                            <div class="pt-2 text-right">
                                <a href="/shop/new" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    {{ __('nav_menu.shop_all') }}
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
                <span>{{ __('messages.nav.makeup') }}</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/shop/gifts?category=makeup" class="text-black hover:underline">{{ __('nav_menu.makeup_gifts') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/new?category=makeup" class="text-black hover:underline">{{ __('nav_menu.new_arrivals') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/bestsellers?category=makeup" class="text-black hover:underline">{{ __('nav_menu.bestsellers') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection" class="text-black hover:underline">{{ __('nav_menu.sephora_collection_makeup') }}</a>
                    </div>

                    <div class="grid grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '6']) }}-start">
                        <!-- Column 1: Face, Makeup Remover, Makeup Sets -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.face') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/foundation" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.foundation') }}</a></li>
                                    <li><a href="/shop/primer-setting-spray" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.primer_setting_spray') }}</a></li>
                                    <li><a href="/shop/concealers-correctors" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.concealers_correctors') }}</a></li>
                                    <li><a href="/shop/highlighters" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.highlighters') }}</a></li>
                                    <li><a href="/shop/bb-cc-cream" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.bb_cc_cream') }}</a></li>
                                    <li><a href="/shop/blush" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.blush') }}</a></li>
                                    <li><a href="/shop/bronzer" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.bronzer') }}</a></li>
                                    <li><a href="/shop/contour" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.contour') }}</a></li>
                                    <li><a href="/shop/powder" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.powder') }}</a></li>
                                    <li><a href="/shop/tinted-moisturizer" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.tinted_moisturizer') }}</a></li>
                                    <li><a href="/shop/face-palette" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.face_palette') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-1.5">
                                <a href="/shop/makeup?sub=remover" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.makeup_remover') }}</a>
                                <a href="/shop/makeup?sub=sets" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.makeup_sets') }}</a>
                            </div>
                        </div>

                        <!-- Column 2: Eyes, Lips, Makeup Palettes -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.eyes') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/eyeshadow" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.eyeshadow') }}</a></li>
                                    <li><a href="/shop/mascara" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.mascara') }}</a></li>
                                    <li><a href="/shop/makeup-palettes" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.eye_palette') }}</a></li>
                                    <li><a href="/shop/eyeliners" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.eyeliners') }}</a></li>
                                    <li><a href="/shop/lashes" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.lashes') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.lips') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/lipsticks" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.lipsticks') }}</a></li>
                                    <li><a href="/shop/gloss" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.gloss') }}</a></li>
                                    <li><a href="/shop/lip-liner" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.lip_liner') }}</a></li>
                                    <li><a href="/shop/lip-balm" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.lip_balm') }}</a></li>
                                    <li><a href="/shop/plumpers" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.plumpers') }}</a></li>
                                    <li><a href="/shop/liquid-lipstick" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.liquid_lipstick') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/makeup-palettes" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.makeup_palettes') }}</a>
                            </div>
                        </div>

                        <!-- Column 3: Brows, Brushes & Sponges, Standalone links -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.brows') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/brow-pencil-powder" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brow_pencil_powder') }}</a></li>
                                    <li><a href="/shop/brow-gel-mascara" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brow_gel_mascara') }}</a></li>
                                    <li><a href="/shop/brow-kit" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brow_kit') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.brushes_sponges') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/makeup?sub=face-brushes" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.face_brushes') }}</a></li>
                                    <li><a href="/shop/makeup?sub=brow-brush" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brow_brush') }}</a></li>
                                    <li><a href="/shop/makeup?sub=eye-brushes" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.eye_brushes') }}</a></li>
                                    <li><a href="/shop/makeup?sub=brush-sets" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.makeup_brush_sets') }}</a></li>
                                    <li><a href="/shop/makeup?sub=sponges" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.sponges_applicators') }}</a></li>
                                    <li><a href="/shop/makeup?sub=brush-cleaners" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brush_cleaners') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-1.5">
                                <a href="/shop/makeup?sub=accessories" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.makeup_accessories') }}</a>
                                <a href="/shop/makeup?sub=nails" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.nails') }}</a>
                                <a href="/shop/gifts/minis-more" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.travel_size') }}</a>
                            </div>
                        </div>

                        <!-- Column 4: Promotional Area (Huda Beauty) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-s border-gray-100 ps-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/products/Hudabeauty_SME_Banners_BrandPDPHighlight__4_.jpg') }}" alt="{{ __('nav_menu.brand_huda_beauty') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">{{ __('nav_menu.brand_huda_beauty') }}</h4>
                                <a href="/brands/huda-beauty" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>{{ __('nav_menu.shop_now') }}</span>
                                    <span><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/shop/makeup" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    {{ __('nav_menu.shop_all') }}
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
                <span>{{ __('messages.nav.fragrance') }}</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/shop/new?category=fragrance" class="text-black hover:underline">{{ __('nav_menu.new_arrivals') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/bestsellers?category=fragrance" class="text-black hover:underline">{{ __('nav_menu.bestsellers') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/fragrance?type=niche" class="text-black hover:underline">{{ __('nav_menu.niche_collection') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/fragrance?type=refillable" class="text-black hover:underline">{{ __('nav_menu.spray_refill_repeat') }}</a>
                    </div>

                    <div class="grid grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '6']) }}-start">
                        <!-- Column 1: For Her & For Him -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.for_her') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/eau-de-parfum" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.eau_de_parfum') }}</a></li>
                                    <li><a href="/shop/eau-de-toilette" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.eau_de_toilette') }}</a></li>
                                    <li><a href="/shop/fragrance-mists" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.fragrance_mist') }}</a></li>
                                    <li><a href="/shop/perfume-extract" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.perfume_extract') }}</a></li>
                                    <li><a href="/shop/scented-body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.scented_body_care') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/for-him" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.for_him') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/fragrance-for-him-eau-de-parfum" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.eau_de_parfum') }}</a></li>
                                    <li><a href="/shop/fragrance-for-him-eau-de-toilette" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.eau_de_toilette') }}</a></li>
                                    <li><a href="/shop/bath-body" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.bath_and_shower') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: By Fragrance Family -->
                        <div class="col-span-12 md:col-span-3 space-y-2">
                            <a href="/shop/by-fragrance-family" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.by_fragrance_family') }}</a>
                            <ul class="space-y-1 text-xs text-gray-600">
                                <li><a href="/shop/floral" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.floral') }}</a></li>
                                <li><a href="/shop/fresh" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.fresh') }}</a></li>
                                <li><a href="/shop/oriental" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.oriental') }}</a></li>
                                <li><a href="/shop/woody-oud" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.woody_oud') }}</a></li>
                                <li><a href="/shop/fruity" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.fruity') }}</a></li>
                                <li><a href="/shop/amber" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.amber') }}</a></li>
                                <li><a href="/shop/by-fragrance-family" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.vanilla') }}</a></li>
                                <li><a href="/shop/by-fragrance-family" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.musky') }}</a></li>
                            </ul>
                        </div>

                        <!-- Column 3: Standalone categories -->
                        <div class="col-span-12 md:col-span-3 space-y-3">
                            <a href="/shop/scented-candles" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.home_fragrance') }}</a>
                            <a href="/shop/travel-size" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.travel_size') }}</a>
                            <a href="/shop/gift-sets" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.gift_sets') }}</a>
                        </div>

                        <!-- Column 4: Promotional Area (Kilian Paris) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-s border-gray-100 ps-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/hero/maison_francis_kurkdjian_baccarat_rouge_540_eau_de_parfum_bottle_iconic_red.webp') }}" alt="{{ __('nav_menu.brand_kilian') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">{{ __('nav_menu.brand_kilian') }}</h4>
                                <a href="/search?q=Kilian" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>{{ __('nav_menu.shop_now') }}</span>
                                    <span><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/shop/fragrance" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    {{ __('nav_menu.shop_all') }}
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
                <span>{{ __('messages.nav.skincare') }}</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/shop/gifts?category=skincare" class="text-black hover:underline">{{ __('nav_menu.skincare_gifts') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/new?category=skincare" class="text-black hover:underline">{{ __('nav_menu.new_arrivals') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/bestsellers?category=skincare" class="text-black hover:underline">{{ __('nav_menu.bestsellers') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection" class="text-black hover:underline">{{ __('nav_menu.sephora_collection_skincare') }}</a>
                    </div>

                    <div class="grid grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '6']) }}-start">
                        <!-- Column 1: All Things Skin -->
                        <div class="col-span-12 md:col-span-4 space-y-3">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.all_things_skin') }}</h3>
                            <div class="space-y-2 text-xs">
                                <div>
                                    <span class="font-bold text-gray-900 block py-0.5">{{ __('nav_menu.moisturizers') }}</span>
                                    <div class="ps-2 space-y-0.5 text-gray-600">
                                        <a href="/shop/day-cream" class="hover:text-black block py-0.5">{{ __('nav_menu.day_cream') }}</a>
                                        <a href="/shop/night-cream" class="hover:text-black block py-0.5">{{ __('nav_menu.night_cream') }}</a>
                                    </div>
                                </div>
                                <a href="/shop/skincare" class="font-bold text-gray-900 block py-0.5 hover:underline">{{ __('nav_menu.serum_face_oils') }}</a>
                                <a href="/shop/eye-cream" class="font-bold text-gray-900 block py-0.5 hover:underline">{{ __('nav_menu.eye_cream') }}</a>
                                <div>
                                    <a href="/shop/cleansers-makeup-removers" class="font-bold text-gray-900 block py-0.5 hover:underline">{{ __('nav_menu.cleansers') }}</a>
                                    <div class="ps-2 space-y-0.5 text-gray-600">
                                        <a href="/shop/face-wash-cleansers" class="hover:text-black block py-0.5">{{ __('nav_menu.face_wash_cleansers') }}</a>
                                        <a href="/shop/skincare-cleansers-makeup-removers-makeup-removers" class="hover:text-black block py-0.5">{{ __('nav_menu.makeup_removers') }}</a>
                                        <a href="/shop/micellar-water" class="hover:text-black block py-0.5">{{ __('nav_menu.micellar_water') }}</a>
                                        <a href="/shop/face-wipes" class="hover:text-black block py-0.5">{{ __('nav_menu.face_wipes') }}</a>
                                        <a href="/shop/cleansers-makeup-removers" class="hover:text-black block py-0.5">{{ __('nav_menu.cleansing_balms') }}</a>
                                        <a href="/shop/cleansers-makeup-removers" class="hover:text-black block py-0.5">{{ __('nav_menu.cleansing_oil') }}</a>
                                    </div>
                                </div>
                                <div>
                                    <a href="/shop/masks" class="font-bold text-gray-900 block py-0.5 hover:underline">{{ __('nav_menu.masks') }}</a>
                                    <div class="ps-2 space-y-0.5 text-gray-600">
                                        <a href="/shop/cream-masks" class="hover:text-black block py-0.5">{{ __('nav_menu.cream_masks') }}</a>
                                        <a href="/shop/sheet-masks" class="hover:text-black block py-0.5">{{ __('nav_menu.sheet_masks') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Skin Concerns -->
                        <div class="col-span-12 md:col-span-3 space-y-2">
                            <a href="/shop/skincare-shop-by-concern" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.skin_concerns') }}</a>
                            <ul class="space-y-1 text-xs text-gray-600">
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.acne_blemish') }}</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.anti_aging') }}</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.dark_spots') }}</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.pore_care') }}</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.dryness') }}</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.mattifying') }}</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.fine_lines_wrinkle') }}</a></li>
                                <li><a href="/shop/skincare-shop-by-concern" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.dullness') }}</a></li>
                            </ul>
                        </div>

                        <!-- Column 3: Lip Care, Suncare, Sets & Accessories -->
                        <div class="col-span-12 md:col-span-2 space-y-4">
                            <div>
                                <a href="/shop/lip-care" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.lip_care') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/lip-care" class="hover:text-black block py-0.5">{{ __('nav_menu.balms') }}</a></li>
                                    <li><a href="/shop/lip-care" class="hover:text-black block py-0.5">{{ __('nav_menu.lip_oil') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/skincare-sun-care" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.suncare') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/skincare-sun-care" class="hover:text-black block py-0.5">{{ __('nav_menu.face_sunscreen') }}</a></li>
                                    <li><a href="/shop/skincare-sun-care" class="hover:text-black block py-0.5">{{ __('nav_menu.body_sunscreen') }}</a></li>
                                    <li><a href="/shop/skincare-sun-care" class="hover:text-black block py-0.5">{{ __('nav_menu.body_self_tanning') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-1.5">
                                <a href="/shop/set" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.sets') }}</a>
                                <a href="/shop/face-accessories" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.face_accessories') }}</a>
                            </div>
                        </div>

                        <!-- Column 4: Promotional Area (Anua) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-s border-gray-100 ps-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/hero/drunk_elephant_protini_polypeptide_cream_teal_and_white_jar_luxury_skincare.webp') }}" alt="{{ __('nav_menu.brand_anua') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">{{ __('nav_menu.brand_anua') }}</h4>
                                <a href="/search?q=Anua" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>{{ __('nav_menu.shop_now') }}</span>
                                    <span><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/shop/skincare" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    {{ __('nav_menu.shop_all') }}
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
                <span>{{ __('nav_menu.bath_body') }}</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                    <div class="grid grid-cols-12 gap-6 lg:gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">
                        <!-- Column 1: Bath and Shower & Body Care -->
                        <div class="col-span-12 md:col-span-4 space-y-4">
                            <div>
                                <a href="/shop/bath-and-shower" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.bath_and_shower_alt') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/bath-and-shower" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.body_wash_shower_gel') }}</a></li>
                                    <li><a href="/shop/bath-and-shower" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.scrub_exfoliants') }}</a></li>
                                    <li><a href="/shop/bath-and-shower" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.body_mist') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/body-care" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.body_care') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.body_lotion') }}</a></li>
                                    <li><a href="/shop/body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.hand_care') }}</a></li>
                                    <li><a href="/shop/body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.deodorant') }}</a></li>
                                    <li><a href="/shop/body-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.foot_care') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: Sun Care, Candles and Scents, Accessories -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <a href="/shop/sun-care" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.sun_care') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/sun-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.face_sunscreen') }}</a></li>
                                    <li><a href="/shop/sun-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.body_sunscreen') }}</a></li>
                                    <li><a href="/shop/sun-care" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.body_self_tanning') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-2">
                                <a href="/shop/scented-candles" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.candles_scents') }}</a>
                                <a href="/shop/body-accessories" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.body_accessories') }}</a>
                            </div>
                        </div>

                        <!-- Column 3: Promotional Units (Sol De Janeiro & Touchland) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-5 flex flex-col justify-between border-s border-gray-100 ps-6 space-y-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="group/promo block border border-gray-200 rounded p-2.5 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/hero/sol_de_janeiro_brazilian_bum_bum_cream_vibrant_yellow_jar_with_white_cap_luxury.webp') }}" alt="{{ __('nav_menu.brand_sol_de_janeiro') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <h4 class="font-bold text-[11px] text-black truncate">{{ __('nav_menu.brand_sol_de_janeiro') }}</h4>
                                    <a href="/search?q=Sol+De+Janeiro" class="text-[10px] text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">
                                        <span>{{ __('nav_menu.shop_now') }}</span>
                                        <span><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                                    </a>
                                </div>
                                <div class="group/promo block border border-gray-200 rounded p-2.5 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-1.5 rounded-sm">
                                        <img src="{{ asset('images/products/Touchland-PDP-BrandHighlight-1744x992-April25.png') }}" alt="{{ __('nav_menu.brand_touchland') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <h4 class="font-bold text-[11px] text-black truncate">{{ __('nav_menu.brand_touchland') }}</h4>
                                    <a href="/search?q=Touchland" class="text-[10px] text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-0.5 mt-0.5">
                                        <span>{{ __('nav_menu.shop_now') }}</span>
                                        <span><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                                    </a>
                                </div>
                            </div>
                            <div class="text-right pt-2">
                                <a href="/shop/bath-body" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    {{ __('nav_menu.shop_all') }}
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
                <span>{{ __('messages.nav.hair') }}</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/shop/gifts?category=hair" class="text-black hover:underline">{{ __('nav_menu.haircare_gifts') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/new?category=hair" class="text-black hover:underline">{{ __('nav_menu.new_arrivals') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/shop/bestsellers?category=hair" class="text-black hover:underline">{{ __('nav_menu.bestsellers') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection" class="text-black hover:underline">{{ __('nav_menu.sephora_collection_haircare') }}</a>
                    </div>

                    <div class="grid grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '6']) }}-start">
                        <!-- Column 1: Want Great Hair? & Hair Type -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-1.5">{{ __('nav_menu.want_great_hair') }}</h3>
                                <a href="/shop/shampoo-conditioner" class="font-bold text-gray-900 text-xs block py-0.5 hover:underline">{{ __('nav_menu.shampoo_conditioner') }}</a>
                                <ul class="ps-2 space-y-1 text-xs text-gray-600 mt-1">
                                    <li><a href="/shop/shampoo" class="hover:text-black block py-0.5">{{ __('nav_menu.shampoo') }}</a></li>
                                    <li><a href="/shop/conditioner" class="hover:text-black block py-0.5">{{ __('nav_menu.conditioner') }}</a></li>
                                    <li><a href="/shop/dry-shampoo" class="hover:text-black block py-0.5">{{ __('nav_menu.dry_shampoo') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/hair-type" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.hair_type') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/dry-damaged" class="hover:text-black block py-0.5">{{ __('nav_menu.dry_damaged') }}</a></li>
                                    <li><a href="/shop/normal" class="hover:text-black block py-0.5">{{ __('nav_menu.normal') }}</a></li>
                                    <li><a href="/shop/hair-type" class="hover:text-black block py-0.5">{{ __('nav_menu.thin') }}</a></li>
                                    <li><a href="/shop/color-care" class="hover:text-black block py-0.5">{{ __('nav_menu.color_care') }}</a></li>
                                    <li><a href="/shop/curly-frizzy" class="hover:text-black block py-0.5">{{ __('nav_menu.curly_frizzy') }}</a></li>
                                    <li><a href="/shop/hair-type" class="hover:text-black block py-0.5">{{ __('nav_menu.oily_combination') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: Treatments & Tools -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <a href="/shop/treatments" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.treatments') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/hair-mask" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_mask') }}</a></li>
                                    <li><a href="/shop/leave-in-cream-treatment" class="hover:text-black block py-0.5">{{ __('nav_menu.leave_in_conditioner') }}</a></li>
                                    <li><a href="/shop/serum-oil" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_oil') }}</a></li>
                                    <li><a href="/shop/treatments" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_serum') }}</a></li>
                                    <li><a href="/shop/hair-loss" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_thinning_loss') }}</a></li>
                                    <li><a href="/shop/treatments" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_spray') }}</a></li>
                                    <li><a href="/shop/treatments" class="hover:text-black block py-0.5">{{ __('nav_menu.cream') }}</a></li>
                                    <li><a href="/shop/hair-shampoo-conditioner-hair-mist" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_mist') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <a href="/shop/tools-accessories" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.tools_accessories') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/tools-accessories" class="hover:text-black block py-0.5">{{ __('nav_menu.brushes_combs') }}</a></li>
                                    <li><a href="/shop/tools-accessories" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_dryer') }}</a></li>
                                    <li><a href="/shop/tools-accessories" class="hover:text-black block py-0.5">{{ __('nav_menu.straightener_curling') }}</a></li>
                                    <li><a href="/shop/tools-accessories" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_accessories') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 3: Shop By Concern & Sets -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <a href="/shop/hair-shop-by-concern" class="text-xs font-bold uppercase tracking-wider text-black mb-2 block hover:underline">{{ __('nav_menu.shop_by_concern') }}</a>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/shop/color-care" class="hover:text-black block py-0.5">{{ __('nav_menu.color_care') }}</a></li>
                                    <li><a href="/shop/dryness" class="hover:text-black block py-0.5">{{ __('nav_menu.dryness') }}</a></li>
                                    <li><a href="/shop/scalp-care" class="hover:text-black block py-0.5">{{ __('nav_menu.scalp') }}</a></li>
                                    <li><a href="/shop/hair-shop-by-concern" class="hover:text-black block py-0.5">{{ __('nav_menu.volume') }}</a></li>
                                    <li><a href="/shop/frizz" class="hover:text-black block py-0.5">{{ __('nav_menu.frizz') }}</a></li>
                                    <li><a href="/shop/hair-loss" class="hover:text-black block py-0.5">{{ __('nav_menu.anti_hair_loss') }}</a></li>
                                    <li><a href="/shop/damaged-hair" class="hover:text-black block py-0.5">{{ __('nav_menu.damaged_hair') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100 space-y-1.5">
                                <a href="/shop/hair-sets" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.sets') }}</a>
                                <a href="/shop/travel-size" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.travel_size') }}</a>
                            </div>
                        </div>

                        <!-- Column 4: Promotional Area (Virtue) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-s border-gray-100 ps-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/products/Virtue_-_Brand_Highlights_-_1744x992.jpg') }}" alt="{{ __('nav_menu.brand_virtue') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">{{ __('nav_menu.brand_virtue') }}</h4>
                                <a href="/search?q=Virtue" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>{{ __('nav_menu.shop_now') }}</span>
                                    <span><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/shop/hair" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    {{ __('nav_menu.shop_all') }}
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
                <span>{{ __('messages.nav.sephora_collection') }}</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <!-- Top Quick Shortcuts Bar -->
                    <div class="flex items-center gap-6 pb-3 mb-6 border-b border-gray-200 text-xs font-bold uppercase tracking-wider">
                        <a href="/brands/sephora-collection" class="text-black hover:underline">{{ __('nav_menu.sephora_festive_shop') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection?new=1" class="text-black hover:underline">{{ __('nav_menu.new_arrivals') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection?bestseller=1" class="text-black hover:underline">{{ __('nav_menu.bestsellers') }}</a>
                        <span class="text-gray-300">&bull;</span>
                        <a href="/brands/sephora-collection" class="text-black hover:underline">{{ __('nav_menu.cheek_lip_tint_collection') }}</a>
                    </div>

                    <div class="grid grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '6']) }}-start">
                        <!-- Column 1: Makeup & Haircare -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.makeup') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/brands/sephora-collection?type=eyes" class="hover:text-black block py-0.5">{{ __('nav_menu.eyes') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=face" class="hover:text-black block py-0.5">{{ __('nav_menu.face') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=lips" class="hover:text-black block py-0.5">{{ __('nav_menu.lips') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=brows" class="hover:text-black block py-0.5">{{ __('nav_menu.brows') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=accessories" class="hover:text-black block py-0.5">{{ __('nav_menu.makeup_accessories') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=sets" class="hover:text-black block py-0.5">{{ __('nav_menu.makeup_sets') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.haircare') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/brands/sephora-collection?type=shampoos" class="hover:text-black block py-0.5">{{ __('nav_menu.shampoos') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=conditioners" class="hover:text-black block py-0.5">{{ __('nav_menu.conditioners') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=masks-serums" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_mask_serums') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=hair-accessories" class="hover:text-black block py-0.5">{{ __('nav_menu.hair_accessories') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: Skincare & Brushes/Sponges -->
                        <div class="col-span-12 md:col-span-3 space-y-4">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.skincare') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/brands/sephora-collection?type=serums" class="hover:text-black block py-0.5">{{ __('nav_menu.skin_serums') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=cleansers" class="hover:text-black block py-0.5">{{ __('nav_menu.makeup_removers_cleansers') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=moisturizers" class="hover:text-black block py-0.5">{{ __('nav_menu.moisturizers') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=eye-creams" class="hover:text-black block py-0.5">{{ __('nav_menu.eye_creams') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=colorful" class="hover:text-black block py-0.5">{{ __('nav_menu.colorful_skincare') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=masks" class="hover:text-black block py-0.5">{{ __('nav_menu.masks') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=skin-accessories" class="hover:text-black block py-0.5">{{ __('nav_menu.skincare_accessories') }}</a></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-gray-100">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-2">{{ __('nav_menu.brushes_and_sponges') }}</h3>
                                <ul class="space-y-1 text-xs text-gray-600">
                                    <li><a href="/brands/sephora-collection?type=pro-brushes" class="hover:text-black block py-0.5">{{ __('nav_menu.pro_brushes') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=classic-brushes" class="hover:text-black block py-0.5">{{ __('nav_menu.classic_brushes') }}</a></li>
                                    <li><a href="/brands/sephora-collection?type=sponges" class="hover:text-black block py-0.5">{{ __('nav_menu.sponges') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 3: Standalone categories -->
                        <div class="col-span-12 md:col-span-3 space-y-3">
                            <a href="/brands/sephora-collection?type=accessories" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.accessories') }}</a>
                            <a href="/brands/sephora-collection?type=nails" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.nails') }}</a>
                            <a href="/brands/sephora-collection?type=gift-sets" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.value_gift_sets') }}</a>
                            <a href="/brands/sephora-collection?type=bath-body" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.bath_and_body') }}</a>
                        </div>

                        <!-- Column 4: Promotional Area + SHOP ALL -->
                        <div class="col-span-12 md:col-span-3 flex flex-col justify-between border-s border-gray-100 ps-6 space-y-4">
                            <div class="group/promo block border border-gray-200 rounded p-3 hover:border-black transition-colors bg-neutral-50/50">
                                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-2 rounded-sm">
                                    <img src="{{ asset('images/products/Sephora-ME-GWP-1472x1196-eng.jpg') }}" alt="{{ __('nav_menu.sephora_collection') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                </div>
                                <h4 class="font-bold text-xs text-black">{{ __('nav_menu.sephora_collection') }}</h4>
                                <a href="/brands/sephora-collection" class="text-xs text-gray-600 group-hover/promo:text-black font-semibold uppercase flex items-center gap-1 mt-1">
                                    <span>{{ __('nav_menu.shop_now') }}</span>
                                    <span><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                                </a>
                            </div>
                            <div class="text-right pt-4">
                                <a href="/brands/sephora-collection" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    {{ __('nav_menu.shop_all') }}
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
                <span>{{ __('messages.nav.brands_list') }}</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Full-Width Mega Menu -->
            <div class="absolute top-full left-0 right-0 w-full bg-white shadow-2xl border-t border-b border-gray-200 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                    <div class="grid grid-cols-12 gap-{{ __('ui.items_count_label', ['count' => '6']) }}-start">
                        <!-- Column 1: Permanent Brand Links -->
                        <div class="col-span-12 md:col-span-2 space-y-2 border-b md:border-b-0 md:border-e border-gray-100 pb-4 md:pb-0 md:pe-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-3">{{ __('nav_menu.directory') }}</h3>
                            <a href="/brands" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.brands_a_to_z') }}</a>
                            <a href="/brands/sephora-collection" class="font-bold text-xs uppercase tracking-wider text-black block hover:underline">{{ __('nav_menu.sephora_collection') }}</a>
                        </div>

                        <!-- Column 2: Featured Brands -->
                        <div class="col-span-12 md:col-span-3 space-y-2 border-b md:border-b-0 md:border-e border-gray-100 pb-4 md:pb-0 md:pe-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-3">{{ __('nav_menu.featured_brands') }}</h3>
                            <ul class="space-y-1.5 text-xs text-gray-600">
                                <li><a href="/brands/huda-beauty" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_huda_beauty') }}</a></li>
                                <li><a href="/brands/kayali" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_kayali') }}</a></li>
                                <li><a href="/search?q=Saie" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_saie') }}</a></li>
                                <li><a href="/search?q=Fugazzi" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_fugazzi') }}</a></li>
                                <li><a href="/brands/glow-recipe" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_glow_recipe') }}</a></li>
                                <li><a href="/brands/gisou" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_gisou') }}</a></li>
                            </ul>
                        </div>

                        <!-- Column 3: Trending Brands -->
                        <div class="col-span-12 md:col-span-3 space-y-2 border-b md:border-b-0 md:border-e border-gray-100 pb-4 md:pb-0 md:pe-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-black mb-3">{{ __('nav_menu.trending_brands') }}</h3>
                            <ul class="space-y-1.5 text-xs text-gray-600">
                                <li><a href="/search?q=Makeup+by+Mario" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_makeup_by_mario') }}</a></li>
                                <li><a href="/search?q=Patrick+Ta" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_patrick_ta') }}</a></li>
                                <li><a href="/search?q=Phlur" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_phlur') }}</a></li>
                                <li><a href="/search?q=Sol+De+Janeiro" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_sol_de_janeiro') }}</a></li>
                                <li><a href="/brands/k18" class="hover:text-black hover:translate-x-0.5 transition-transform block py-0.5">{{ __('nav_menu.brand_k18') }}</a></li>
                            </ul>
                        </div>

                        <!-- Column 4: Promotional Units (Tarte, Tatcha, Patrick Ta) + SHOP ALL -->
                        <div class="col-span-12 md:col-span-4 space-y-3">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 block">{{ __('nav_menu.promotions') }}</span>
                            <div class="grid grid-cols-3 gap-2.5">
                                <a href="/brands/tarte" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-square bg-gray-100 overflow-hidden mb-1 rounded-sm">
                                        <img src="{{ asset('images/products/tarte_hol26_brand_highlight_1744x992_en-3.jpg') }}" alt="{{ __('nav_menu.brand_tarte') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[10px] text-black truncate">{{ __('nav_menu.brand_tarte') }}</p>
                                    <span class="text-[9px] text-gray-500 group-hover/promo:text-black font-semibold uppercase block mt-0.5">{{ __('nav_menu.shop_now') }}</span>
                                </a>
                                <a href="/search?q=Tatcha" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-square bg-gray-100 overflow-hidden mb-1 rounded-sm">
                                        <img src="{{ asset('images/products/793888679344_TATCHA_Brightening_20Serum_pdp_gwp_eligible_296x296_en.jpg') }}" alt="{{ __('nav_menu.brand_tatcha') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[10px] text-black truncate">{{ __('nav_menu.brand_tatcha') }}</p>
                                    <span class="text-[9px] text-gray-500 group-hover/promo:text-black font-semibold uppercase block mt-0.5">{{ __('nav_menu.shop_now') }}</span>
                                </a>
                                <a href="/search?q=Patrick+Ta" class="group/promo block border border-gray-200 rounded p-2 hover:border-black transition-colors bg-neutral-50/50">
                                    <div class="aspect-square bg-gray-100 overflow-hidden mb-1 rounded-sm">
                                        <img src="{{ asset('images/hero/luxury_beauty_services_at_sephora_professional_makeup_artist_applying_glam.webp') }}" alt="{{ __('nav_menu.brand_patrick_ta') }}" class="w-full h-full object-cover group-hover/promo:scale-105 transition-transform duration-300" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                                    </div>
                                    <p class="font-bold text-[10px] text-black truncate">{{ __('nav_menu.brand_patrick_ta') }}</p>
                                    <span class="text-[9px] text-gray-500 group-hover/promo:text-black font-semibold uppercase block mt-0.5">{{ __('nav_menu.shop_now') }}</span>
                                </a>
                            </div>
                            <div class="text-right pt-2">
                                <a href="/brands" class="inline-block py-2 px-6 border border-gray-300 hover:border-black text-black text-xs font-bold uppercase tracking-wider transition-colors hover:bg-black hover:text-white">
                                    {{ __('nav_menu.shop_all') }}
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
                <span>{{ __('messages.nav.gifts') }}</span>
                <svg class="w-3 h-3 text-gray-400 group-hover:text-black transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Compact Dropdown -->
            <div class="absolute top-full end-0 w-64 pt-1 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="bg-white rounded-b-md border border-t-2 border-gray-200 border-t-black shadow-2xl overflow-hidden py-1 divide-y divide-gray-100">
                    <div class="py-1">
                        <a href="/shop/gifts?type=sets" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>{{ __('nav_menu.gift_sets') }}</span>
                            <span class="text-gray-400 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/gifts/minis-more" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>{{ __('nav_menu.minis_more') }}</span>
                            <span class="text-gray-400 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                    </div>
                    <div class="py-1.5">
                        <div class="px-4 py-1 text-[10px] font-bold uppercase tracking-wider text-gray-400">{{ __('nav_menu.by_category') }}</div>
                        <a href="/shop/gifts?category=makeup" class="flex items-center justify-between px-4 py-1.5 text-xs text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors ps-6">
                            <span>{{ __('nav_menu.makeup') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/gifts?category=skincare" class="flex items-center justify-between px-4 py-1.5 text-xs text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors ps-6">
                            <span>{{ __('nav_menu.skincare') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/gifts?category=fragrance" class="flex items-center justify-between px-4 py-1.5 text-xs text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors ps-6">
                            <span>{{ __('nav_menu.fragrance') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/gifts?category=hair" class="flex items-center justify-between px-4 py-1.5 text-xs text-gray-700 hover:bg-neutral-50 hover:text-black transition-colors ps-6">
                            <span>{{ __('nav_menu.hair') }}</span>
                            <span class="text-gray-300 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                    </div>
                    <div class="p-2.5 bg-neutral-50">
                        <a href="/shop/gifts" class="block w-full py-1.5 px-3 border border-black text-black hover:bg-black hover:text-white text-center text-xs font-bold uppercase tracking-wider transition-colors">
                            {{ __('nav_menu.shop_all') }}
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
                    {{ __('nav_menu.clean') }}
                </span>
                <svg class="w-3 h-3 text-emerald-600/70 group-hover:text-emerald-900 transition-transform duration-200 group-hover:rotate-180 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </a>

            <!-- Compact Dropdown -->
            <div class="absolute top-full end-0 w-64 pt-1 opacity-0 invisible -translate-y-1 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out z-[90] pointer-events-none before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-4 text-start">
                <div class="bg-white rounded-b-md border border-t-2 border-gray-200 border-t-emerald-700 shadow-2xl overflow-hidden py-1 divide-y divide-gray-100">
                    <div class="px-4 py-2 bg-emerald-50/60">
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-800">{{ __('nav_menu.clean_at_sephora') }}</span>
                        <p class="text-[11px] text-gray-500 mt-0.5">{{ __('nav_menu.clean_desc') }}</p>
                    </div>
                    <div class="py-1">
                        <a href="/shop/skincare?clean=1" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>{{ __('nav_menu.clean_skincare') }}</span>
                            <span class="text-gray-400 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/makeup?clean=1" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>{{ __('nav_menu.clean_makeup') }}</span>
                            <span class="text-gray-400 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                        <a href="/shop/hair?clean=1" class="flex items-center justify-between px-4 py-2 text-xs font-semibold text-black hover:bg-neutral-50 transition-colors">
                            <span>{{ __('nav_menu.clean_haircare') }}</span>
                            <span class="text-gray-400 text-xs"><span class="inline-block rtl:rotate-180">&rsaquo;</span></span>
                        </a>
                    </div>
                    <div class="p-2.5 bg-neutral-50">
                        <a href="/clean-at-sephora" class="block w-full py-1.5 px-3 border border-emerald-800 text-emerald-900 hover:bg-emerald-800 hover:text-white text-center text-xs font-bold uppercase tracking-wider transition-colors">
                            {{ __('nav_menu.explore_clean') }}
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
    <aside aria-label="{{ __('nav_menu.browse_menu') }}" aria-modal="true" class="absolute inset-y-0 start-0 w-[85%] max-w-sm bg-white shadow-2xl flex flex-col {{ app()->getLocale() === 'ar' ? 'translate-x-full' : '-translate-x-full' }} transition-transform duration-300 ease-out" data-mobile-menu-panel role="dialog">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
            <a class="logo-font text-xl text-black tracking-[0.25em] font-bold" href="/">SEPHORA</a>
            <button aria-label="{{ __('nav_menu.close_menu') }}" class="p-2 -me-2 text-black hover:opacity-70 transition-opacity" data-mobile-menu-close type="button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>
        <nav aria-label="{{ __('nav_menu.mobile_nav') }}" class="flex-1 overflow-y-auto px-5 py-3 divide-y divide-gray-100">

            {{-- 1. The Holiday Collection --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-bold text-[#b45309] cursor-pointer list-none py-1">
                    <span>{{ __('messages.nav.holiday_collection') }}</span>
                    <svg class="w-4 h-4 text-amber-600 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-amber-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/makeup" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.makeup') }}</a>
                    <a href="/shop/fragrance" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.fragrance') }}</a>
                    <a href="/shop/skincare" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.skincare') }}</a>
                    <a href="/shop/hair" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.hair') }}</a>
                    <a href="/brands/sephora-collection" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.sephora_collection') }}</a>
                    <a href="/shop/gifts" class="block py-1 font-bold text-black border-t border-gray-100 pt-1.5">{{ __('nav_menu.view_all') }} <span class="inline-block rtl:rotate-180">&rarr;</span></a>
                    <a href="/shop/gifts" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-1">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 2. Stack Your Scent --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.stack_your_scent') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/fragrance?family=fruity" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.fruity_gourmands') }}</a>
                    <a href="/shop/fragrance?family=musky" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.skin_musks') }}</a>
                    <a href="/shop/fragrance?family=fresh" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.lavender_blends') }}</a>
                    <a href="/shop/fragrance" class="block py-1 font-bold text-black border-t border-gray-100 pt-1.5">{{ __('nav_menu.view_all') }} <span class="inline-block rtl:rotate-180">&rarr;</span></a>
                    <a href="/shop/fragrance" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-1">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 3. Beauty Offers (Direct Link) --}}
            <a class="block py-3 text-sm font-semibold text-gray-900 hover:text-black hover:translate-x-1 transition-all" href="/beauty-offers">
                {{ __('messages.nav.beauty_offers') }}
            </a>

            {{-- 4. New --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.new') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/new" class="block py-1 font-bold text-black">{{ __('nav_menu.view_all') }}</a>
                    <a href="/shop/new?cat=makeup" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.new_in_makeup') }}</a>
                    <a href="/shop/new?cat=fragrance" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.new_in_fragrance') }}</a>
                    <a href="/shop/new?cat=skincare" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.new_in_skincare') }}</a>
                    <a href="/shop/new?cat=hair" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.new_in_haircare') }}</a>
                    <a href="/brands/sephora-collection?new=1" class="block py-1 text-gray-700 hover:text-black">{{ __('nav_menu.new_in_sephora_collection') }}</a>
                    <div class="pt-2 border-t border-gray-100">
                        <span class="font-bold text-[11px] uppercase tracking-wider text-black block mb-1">{{ __('nav_menu.new_in_brands') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-[11px] text-gray-600">
                            <a href="/search?q=Haus+Labs" class="block py-0.5">{{ __('nav_menu.brand_haus_labs') }}</a>
                            <a href="/search?q=Oribe" class="block py-0.5">{{ __('nav_menu.brand_oribe') }}</a>
                            <a href="/search?q=Mediheal" class="block py-0.5">{{ __('nav_menu.brand_mediheal') }}</a>
                            <a href="/search?q=Tweezerman" class="block py-0.5">{{ __('nav_menu.brand_tweezerman') }}</a>
                            <a href="/search?q=Estrid" class="block py-0.5">{{ __('nav_menu.brand_estrid') }}</a>
                            <a href="/search?q=BBB+London" class="block py-0.5">{{ __('nav_menu.brand_bbb_london') }}</a>
                            <a href="/search?q=Moonglaze" class="block py-0.5">{{ __('nav_menu.brand_moonglaze') }}</a>
                            <a href="/search?q=Starface" class="block py-0.5">{{ __('nav_menu.brand_starface') }}</a>
                            <a href="/search?q=Hello+Sunday" class="block py-0.5">{{ __('nav_menu.brand_hello_sunday') }}</a>
                            <a href="/search?q=One+Size" class="block py-0.5">{{ __('nav_menu.brand_one_size') }}</a>
                        </div>
                    </div>
                    <a href="/shop/new" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 5. Makeup --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.makeup') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <div class="flex flex-wrap gap-2 pb-1 text-[11px] font-bold">
                        <a href="/shop/gifts?category=makeup" class="text-black underline">{{ __('nav_menu.makeup_gifts') }}</a>
                        <a href="/shop/new?category=makeup" class="text-black underline">{{ __('nav_menu.new_arrivals') }}</a>
                        <a href="/shop/bestsellers?category=makeup" class="text-black underline">{{ __('nav_menu.bestsellers') }}</a>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.face') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/face?type=foundation" class="block py-0.5">{{ __('nav_menu.foundation') }}</a>
                            <a href="/shop/face?type=primer" class="block py-0.5">{{ __('nav_menu.primer') }}</a>
                            <a href="/shop/face?type=concealer" class="block py-0.5">{{ __('nav_menu.concealers') }}</a>
                            <a href="/shop/face?type=highlighter" class="block py-0.5">{{ __('nav_menu.highlighters') }}</a>
                            <a href="/shop/face?type=bb-cc" class="block py-0.5">{{ __('nav_menu.bb_cc_cream') }}</a>
                            <a href="/shop/face?type=blush" class="block py-0.5">{{ __('nav_menu.blush') }}</a>
                            <a href="/shop/face?type=bronzer" class="block py-0.5">{{ __('nav_menu.bronzer') }}</a>
                            <a href="/shop/face?type=contour" class="block py-0.5">{{ __('nav_menu.contour') }}</a>
                            <a href="/shop/face?type=powder" class="block py-0.5">{{ __('nav_menu.powder') }}</a>
                            <a href="/shop/face?type=palette" class="block py-0.5">{{ __('nav_menu.face_palette') }}</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.eyes_and_lips') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/makeup?sub=eyeshadow" class="block py-0.5">{{ __('nav_menu.eyeshadow') }}</a>
                            <a href="/shop/makeup?sub=mascara" class="block py-0.5">{{ __('nav_menu.mascara') }}</a>
                            <a href="/shop/makeup-palettes" class="block py-0.5">{{ __('nav_menu.eye_palette') }}</a>
                            <a href="/shop/makeup?sub=eyeliner" class="block py-0.5">{{ __('nav_menu.eyeliners') }}</a>
                            <a href="/shop/lips?type=lipstick" class="block py-0.5">{{ __('nav_menu.lipsticks') }}</a>
                            <a href="/shop/lips?type=gloss" class="block py-0.5">{{ __('nav_menu.gloss') }}</a>
                            <a href="/shop/lips?type=lip-liner" class="block py-0.5">{{ __('nav_menu.lip_liner') }}</a>
                            <a href="/shop/lips?type=lip-balm" class="block py-0.5">{{ __('nav_menu.lip_balm') }}</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.brows_and_brushes') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/makeup?sub=brow-pencil" class="block py-0.5">{{ __('nav_menu.brow_pencil') }}</a>
                            <a href="/shop/makeup?sub=brow-gel" class="block py-0.5">{{ __('nav_menu.brow_gel') }}</a>
                            <a href="/shop/makeup?sub=face-brushes" class="block py-0.5">{{ __('nav_menu.face_brushes') }}</a>
                            <a href="/shop/makeup?sub=sponges" class="block py-0.5">{{ __('nav_menu.sponges') }}</a>
                        </div>
                    </div>
                    <a href="/shop/makeup" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 6. Fragrance --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.fragrance') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.for_her_him') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/fragrance?for=her&type=edp" class="block py-0.5">{{ __('nav_menu.for_her_edp') }}</a>
                            <a href="/shop/fragrance?for=her&type=edt" class="block py-0.5">{{ __('nav_menu.for_her_edt') }}</a>
                            <a href="/shop/fragrance?for=her&type=mist" class="block py-0.5">{{ __('nav_menu.fragrance_mist') }}</a>
                            <a href="/shop/fragrance?for=him&type=edp" class="block py-0.5">{{ __('nav_menu.for_him_edp') }}</a>
                            <a href="/shop/fragrance?for=him&type=edt" class="block py-0.5">{{ __('nav_menu.for_him_edt') }}</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.by_fragrance_family') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/fragrance?family=floral" class="block py-0.5">{{ __('nav_menu.floral') }}</a>
                            <a href="/shop/fragrance?family=fresh" class="block py-0.5">{{ __('nav_menu.fresh') }}</a>
                            <a href="/shop/fragrance?family=oriental" class="block py-0.5">{{ __('nav_menu.oriental') }}</a>
                            <a href="/shop/fragrance?family=woody-oud" class="block py-0.5">{{ __('nav_menu.woody_oud') }}</a>
                            <a href="/shop/fragrance?family=fruity" class="block py-0.5">{{ __('nav_menu.fruity') }}</a>
                            <a href="/shop/fragrance?family=amber" class="block py-0.5">{{ __('nav_menu.amber') }}</a>
                        </div>
                    </div>
                    <div class="pt-1 border-t border-gray-100 flex flex-wrap gap-3">
                        <a href="/shop/fragrance?sub=home" class="font-bold text-black">{{ __('nav_menu.home_fragrance') }}</a>
                        <a href="/shop/gifts/minis-more" class="font-bold text-black">{{ __('nav_menu.travel_size') }}</a>
                        <a href="/shop/gifts?category=fragrance" class="font-bold text-black">{{ __('nav_menu.gift_sets') }}</a>
                    </div>
                    <a href="/shop/fragrance" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 7. Skincare --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.skincare') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.all_things_skin') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/skincare?type=day-cream" class="block py-0.5">{{ __('nav_menu.day_cream') }}</a>
                            <a href="/shop/skincare?type=night-cream" class="block py-0.5">{{ __('nav_menu.night_cream') }}</a>
                            <a href="/shop/skincare?type=serum-oils" class="block py-0.5">{{ __('nav_menu.serum_oils') }}</a>
                            <a href="/shop/skincare?type=eye-cream" class="block py-0.5">{{ __('nav_menu.eye_cream') }}</a>
                            <a href="/shop/skincare?type=face-wash" class="block py-0.5">{{ __('nav_menu.cleansers') }}</a>
                            <a href="/shop/skincare?type=sheet-masks" class="block py-0.5">{{ __('nav_menu.masks') }}</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.skin_concerns') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/skincare?concern=acne" class="block py-0.5">{{ __('nav_menu.acne_blemish') }}</a>
                            <a href="/shop/skincare?concern=anti-aging" class="block py-0.5">{{ __('nav_menu.anti_aging') }}</a>
                            <a href="/shop/skincare?concern=dark-spots" class="block py-0.5">{{ __('nav_menu.dark_spots') }}</a>
                            <a href="/shop/skincare?concern=pore-care" class="block py-0.5">{{ __('nav_menu.pore_care') }}</a>
                            <a href="/shop/skincare?concern=dryness" class="block py-0.5">{{ __('nav_menu.dryness') }}</a>
                            <a href="/shop/skincare?concern=fine-lines" class="block py-0.5">{{ __('nav_menu.fine_lines') }}</a>
                        </div>
                    </div>
                    <a href="/shop/skincare" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 8. Bath & Body --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.bath_body') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/bath-body?type=shower-gel" class="block py-1 text-gray-700">{{ __('nav_menu.body_wash_shower_gel') }}</a>
                    <a href="/shop/bath-body?type=scrubs" class="block py-1 text-gray-700">{{ __('nav_menu.scrub_exfoliants') }}</a>
                    <a href="/shop/bath-body?type=body-mist" class="block py-1 text-gray-700">{{ __('nav_menu.body_mist') }}</a>
                    <a href="/shop/bath-body?type=lotion" class="block py-1 text-gray-700">{{ __('nav_menu.body_lotion') }}</a>
                    <a href="/shop/bath-body?type=hand-care" class="block py-1 text-gray-700">{{ __('nav_menu.hand_care') }}</a>
                    <a href="/shop/bath-body?type=candles" class="block py-1 font-bold text-black">{{ __('nav_menu.candles_scents') }}</a>
                    <a href="/shop/bath-body" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 9. Hair --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.hair') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.want_great_hair') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/hair?type=shampoo" class="block py-0.5">{{ __('nav_menu.shampoo') }}</a>
                            <a href="/shop/hair?type=conditioner" class="block py-0.5">{{ __('nav_menu.conditioner') }}</a>
                            <a href="/shop/hair?type=dry-shampoo" class="block py-0.5">{{ __('nav_menu.dry_shampoo') }}</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.hair_type_concern') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/shop/hair?type=dry-damaged" class="block py-0.5">{{ __('nav_menu.dry_damaged') }}</a>
                            <a href="/shop/hair?type=curly-frizzy" class="block py-0.5">{{ __('nav_menu.curly_frizzy') }}</a>
                            <a href="/shop/hair?concern=color-care" class="block py-0.5">{{ __('nav_menu.color_care') }}</a>
                            <a href="/shop/hair?concern=scalp" class="block py-0.5">{{ __('nav_menu.scalp_care') }}</a>
                        </div>
                    </div>
                    <a href="/shop/hair" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 10. Sephora Collection --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.sephora_collection') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/brands/sephora-collection?type=makeup" class="block py-1 text-gray-700">{{ __('nav_menu.makeup') }}</a>
                    <a href="/brands/sephora-collection?type=haircare" class="block py-1 text-gray-700">{{ __('nav_menu.haircare') }}</a>
                    <a href="/brands/sephora-collection?type=skincare" class="block py-1 text-gray-700">{{ __('nav_menu.skincare') }}</a>
                    <a href="/brands/sephora-collection?type=brushes" class="block py-1 text-gray-700">{{ __('nav_menu.brushes_and_sponges') }}</a>
                    <a href="/brands/sephora-collection?type=gift-sets" class="block py-1 text-gray-700">{{ __('nav_menu.value_gift_sets') }}</a>
                    <a href="/brands/sephora-collection" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 11. Brands --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.brands_list') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-2 pb-1 text-xs">
                    <a href="/brands" class="block py-1 font-bold text-black">{{ __('nav_menu.brands_a_to_z') }} <span class="inline-block rtl:rotate-180">&rarr;</span></a>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.featured_brands') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/brands/huda-beauty" class="block py-0.5">{{ __('nav_menu.brand_huda_beauty') }}</a>
                            <a href="/brands/kayali" class="block py-0.5">{{ __('nav_menu.brand_kayali') }}</a>
                            <a href="/search?q=Saie" class="block py-0.5">{{ __('nav_menu.brand_saie') }}</a>
                            <a href="/brands/glow-recipe" class="block py-0.5">{{ __('nav_menu.brand_glow_recipe') }}</a>
                            <a href="/brands/gisou" class="block py-0.5">{{ __('nav_menu.brand_gisou') }}</a>
                        </div>
                    </div>
                    <div>
                        <span class="font-bold text-black uppercase tracking-wider block mb-1">{{ __('nav_menu.trending_brands') }}</span>
                        <div class="grid grid-cols-2 gap-1 text-gray-600">
                            <a href="/search?q=Makeup+by+Mario" class="block py-0.5">{{ __('nav_menu.brand_makeup_by_mario') }}</a>
                            <a href="/search?q=Patrick+Ta" class="block py-0.5">{{ __('nav_menu.brand_patrick_ta') }}</a>
                            <a href="/search?q=Phlur" class="block py-0.5">{{ __('nav_menu.brand_phlur') }}</a>
                            <a href="/brands/k18" class="block py-0.5">{{ __('nav_menu.brand_k18') }}</a>
                        </div>
                    </div>
                    <a href="/brands" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-2">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 12. Gifts --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-gray-900 cursor-pointer list-none py-1 hover:text-black">
                    <span>{{ __('messages.nav.gifts') }}</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-gray-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/gifts?type=sets" class="block py-1 font-semibold text-black">{{ __('nav_menu.gift_sets') }}</a>
                    <a href="/shop/gifts/minis-more" class="block py-1 font-semibold text-black">{{ __('nav_menu.minis_more') }}</a>
                    <div class="pt-1 border-t border-gray-100">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-1">{{ __('nav_menu.by_category') }}</span>
                        <a href="/shop/gifts?category=makeup" class="block py-0.5 text-gray-600">{{ __('nav_menu.makeup') }}</a>
                        <a href="/shop/gifts?category=skincare" class="block py-0.5 text-gray-600">{{ __('nav_menu.skincare') }}</a>
                        <a href="/shop/gifts?category=fragrance" class="block py-0.5 text-gray-600">{{ __('nav_menu.fragrance') }}</a>
                        <a href="/shop/gifts?category=hair" class="block py-0.5 text-gray-600">{{ __('nav_menu.hair') }}</a>
                    </div>
                    <a href="/shop/gifts" class="block py-1.5 px-3 bg-black text-white text-center font-bold uppercase rounded-sm mt-1">{{ __('nav_menu.shop_all') }}</a>
                </div>
            </details>

            {{-- 13. Clean --}}
            <details class="group/mob py-2.5">
                <summary class="flex items-center justify-between text-sm font-semibold text-emerald-800 cursor-pointer list-none py-1 hover:text-emerald-950">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"></path></svg>
                        {{ __('nav_menu.clean_at_sephora') }}
                    </span>
                    <svg class="w-4 h-4 text-emerald-600 transition-transform duration-200 group-open/mob:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </summary>
                <div class="mt-2 ms-3 ps-3 border-s-2 border-emerald-200 space-y-1.5 pb-1 text-xs">
                    <a href="/shop/skincare?clean=1" class="block py-1 text-gray-700">{{ __('nav_menu.clean_skincare') }}</a>
                    <a href="/shop/makeup?clean=1" class="block py-1 text-gray-700">{{ __('nav_menu.clean_makeup') }}</a>
                    <a href="/shop/hair?clean=1" class="block py-1 text-gray-700">{{ __('nav_menu.clean_haircare') }}</a>
                    <a href="/clean-at-sephora" class="block py-1.5 px-3 bg-emerald-800 text-white text-center font-bold uppercase rounded-sm mt-1">{{ __('nav_menu.explore_clean') }}</a>
                </div>
            </details>

        </nav>
        <div class="border-t border-gray-200 px-5 py-4 space-y-2 bg-gray-50 text-sm">
            <a class="flex items-center gap-3 py-2 text-gray-900 font-medium" href="/stores">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>{{ __('nav_menu.stores_and_services') }}</span>
            </a>
            <a class="flex items-center gap-3 py-2 text-gray-900 font-medium" href="/my-account">
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>{{ __('nav_menu.my_account') }}</span>
            </a>
            <a class="flex items-center gap-3 py-2 text-gray-900 font-bold" href="{{ route('locale.switch', ['lang' => $targetLang]) }}">
                <span class="inline-flex w-5 h-3.5 overflow-hidden rounded-[2px] border border-gray-300 shrink-0">
                    <svg viewBox="0 0 600 300" class="w-full h-full object-cover">
                        <rect width="600" height="100" fill="#00732f" />
                        <rect y="100" width="600" height="100" fill="#ffffff" />
                        <rect y="200" width="600" height="100" fill="#000000" />
                        <rect width="150" height="300" fill="#ff0000" />
                    </svg>
                </span>
                <span>{{ __('nav_menu.switch_language_to', ['lang' => $targetLabel]) }}</span>
            </a>
        </div>
    </aside>
</div>
<!-- END: MobileMenu -->
