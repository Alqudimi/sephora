{{-- Shared storefront footer: newsletter signup, app download, customer service, payment methods and legal bar. --}}
<!-- BEGIN: MainFooter -->
<footer class="bg-black text-white text-xs pt-12 pb-8 mt-12 border-t border-neutral-800" data-purpose="site-footer">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8 space-y-10">

        <!-- Newsletter Bar -->
        <div class="flex flex-col md:flex-row items-center justify-between pb-8 border-b border-neutral-800 gap-6">
            <div class="text-center md:text-left max-w-xl">
                <h3 class="text-lg sm:text-xl font-bold tracking-tight text-white">{{ __('messages.footer.newsletter_heading') }}</h3>
                <p class="text-neutral-400 text-xs mt-1">{{ __('messages.footer.newsletter_text') }}</p>
            </div>
            <form class="flex flex-col sm:flex-row w-full md:w-auto max-w-md gap-2" data-newsletter-form>
                <input
                    class="bg-neutral-900 border border-neutral-700 text-white px-4 py-2.5 text-xs rounded-sm focus:outline-none focus:border-white flex-1 min-w-0 placeholder-neutral-500"
                    placeholder="{{ __('messages.footer.email_placeholder') }}"
                    type="email"
                    required
                />
                <button class="bg-white text-black font-bold uppercase tracking-wider px-6 py-2.5 rounded-sm text-xs hover:bg-neutral-200 shrink-0 transition-colors" type="submit">
                    {{ __('messages.footer.subscribe') }}
                </button>
            </form>
        </div>

        @php
            $socialInstagram = \App\Models\Setting::get('social_instagram', 'https://instagram.com/sephoramiddleeast');
            $socialFacebook = \App\Models\Setting::get('social_facebook', 'https://facebook.com/sephoramiddleeast');
            $socialYoutube = \App\Models\Setting::get('social_youtube', 'https://youtube.com/sephoramiddleeast');
            $socialTiktok = \App\Models\Setting::get('social_tiktok', 'https://tiktok.com/@sephoramiddleeast');
        @endphp
        <!-- Social Media & Country Selector Bar -->
        <div class="flex flex-col sm:flex-row items-center justify-between pb-6 border-b border-neutral-800 gap-4">
            <div class="flex items-center gap-4">
                <span class="text-[11px] font-bold text-neutral-400 uppercase tracking-wider">{{ __('messages.footer.follow_us') }}</span>
                <div class="flex items-center gap-3 text-neutral-300">
                    <!-- Instagram -->
                    <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors" aria-label="Instagram">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <!-- Facebook -->
                    <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors" aria-label="Facebook">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.667 5H18V0h-3.808C10.597 0 9 1.583 9 4.615V8z"/></svg>
                    </a>
                    <!-- YouTube -->
                    <a href="{{ $socialYoutube }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors" aria-label="YouTube">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    </a>
                    <!-- TikTok -->
                    <a href="{{ $socialTiktok }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors" aria-label="TikTok">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Country & Language Selector -->
            @php
                $footerTargetLang = app()->getLocale() === 'ar' ? 'en' : 'ar';
                $footerTargetLabel = app()->getLocale() === 'ar' ? 'English' : 'العربية';
            @endphp
            <div class="flex items-center gap-3 text-neutral-300">
                <span class="inline-flex w-4 h-3 overflow-hidden rounded-[2px] border border-gray-600">
                    <svg viewBox="0 0 600 300" class="w-full h-full object-cover">
                        <rect width="600" height="100" fill="#00732f" />
                        <rect y="100" width="600" height="100" fill="#ffffff" />
                        <rect y="200" width="600" height="100" fill="#000000" />
                        <rect width="150" height="300" fill="#ff0000" />
                    </svg>
                </span>
                <span class="text-xs font-semibold">{{ __('messages.footer.country') }}</span>
                <span class="text-neutral-600">|</span>
                <a href="{{ route('locale.switch', ['lang' => $footerTargetLang]) }}" class="text-xs font-bold text-white hover:underline">
                    {{ $footerTargetLabel }}
                </a>
            </div>
        </div>

        <!-- 5-Column Sitemap Links -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 sm:gap-8 text-neutral-400">
            <!-- 1. Top Categories -->
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">{{ __('messages.footer.top_categories') }}</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="/shop/makeup">{{ __('messages.nav.makeup') }}</a></li>
                    <li><a class="hover:text-white transition-colors" href="/shop/fragrance">{{ __('messages.nav.fragrance') }}</a></li>
                    <li><a class="hover:text-white transition-colors" href="/shop/skincare">{{ __('messages.nav.skincare') }}</a></li>
                    <li><a class="hover:text-white transition-colors" href="/shop/sephora-collection">{{ __('messages.nav.sephora_collection') }}</a></li>
                    <li><a class="hover:text-white transition-colors" href="/shop/hair">{{ __('messages.nav.hair') }}</a></li>
                    <li><a class="hover:text-white transition-colors" href="/shop/bath-body">{{ __('messages.nav.bath_body') }}</a></li>
                </ul>
            </div>

            <!-- 2. Top Brands -->
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">{{ __('messages.footer.top_brands') }}</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="/brands/fenty-beauty">Fenty Beauty</a></li>
                    <li><a class="hover:text-white transition-colors" href="/brands/huda-beauty">Huda Beauty</a></li>
                    <li><a class="hover:text-white transition-colors" href="/brands/kayali">Kayali</a></li>
                    <li><a class="hover:text-white transition-colors" href="/brands/tarte">Tarte</a></li>
                    <li><a class="hover:text-white transition-colors" href="/brands/nars">NARS</a></li>
                    <li><a class="hover:text-white transition-colors" href="/brands/sephora-collection">Sephora Collection</a></li>
                </ul>
            </div>

            <!-- 3. My Sephora -->
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">{{ __('messages.footer.my_sephora') }}</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="/my-account">My Account</a></li>
                    <li><a class="hover:text-white transition-colors" href="/my-account/orders">Order History</a></li>
                    <li><a class="hover:text-white transition-colors" href="/my-account/wishlist">My Wishlist</a></li>
                    <li><a class="hover:text-white transition-colors" href="/gift-cards">Gift Cards</a></li>
                    <li><a class="hover:text-white transition-colors" href="/beauty-offers">Beauty Offers</a></li>
                </ul>
            </div>

            <!-- 4. Help & FAQs -->
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">{{ __('messages.footer.help_faqs') }}</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a class="hover:text-white transition-colors" href="/stores">Stores &amp; Services</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('faq.delivery') }}">Delivery &amp; Shipping</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('faq.cancellation') }}">Returns &amp; Refunds</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('faq') }}">FAQs</a></li>
                </ul>
            </div>

            <!-- 5. About Sephora -->
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">About Sephora</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="{{ route('home') }}">About Sephora UAE</a></li>
                    <li><a class="hover:text-white transition-colors" href="/clean-at-sephora">Clean at Sephora</a></li>
                    <li><a class="hover:text-white transition-colors" href="/stores">Our Boutiques</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('terms') }}">Terms &amp; Conditions</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('terms') }}#privacy">Privacy Notice</a></li>
                </ul>
            </div>
        </div>

        <!-- Legal & Copyright Bar -->
        <div class="pt-6 border-t border-neutral-900 flex flex-col sm:flex-row items-center justify-between text-neutral-500 text-[11px] gap-4 text-center sm:text-left">
            <p>Sephora Middle East &copy; {{ date('Y') }}. All rights reserved.</p>
            <div class="flex items-center gap-4 flex-wrap justify-center sm:justify-end">
                <a href="{{ route('terms') }}" class="hover:text-neutral-300 transition-colors">Terms &amp; Conditions</a>
                <span class="w-1 h-1 bg-neutral-700 rounded-full"></span>
                <a href="{{ route('terms') }}#privacy" class="hover:text-neutral-300 transition-colors">Privacy Policy</a>
                <span class="w-1 h-1 bg-neutral-700 rounded-full"></span>
                <a href="{{ route('terms') }}#cookies" class="hover:text-neutral-300 transition-colors">Cookie Preferences</a>
            </div>
        </div>
    </div>
</footer>
<!-- END: MainFooter -->
