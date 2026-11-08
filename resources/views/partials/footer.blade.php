{{-- Shared storefront footer: newsletter signup, app download, customer service, payment methods and legal bar. --}}
<!-- BEGIN: MainFooter -->
<footer class="bg-black text-white text-xs pt-12 pb-8 mt-12 border-t border-neutral-800" data-purpose="site-footer">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8 space-y-10">

        <!-- Newsletter Row -->
        <div class="flex flex-col md:flex-row items-center justify-between pb-8 border-b border-neutral-800 gap-6">
            <div class="text-center md:text-left max-w-xl">
                <span class="text-[10px] font-black uppercase tracking-widest text-neutral-400">BEAUTY INSIDER NEWSLETTER</span>
                <h3 class="text-lg sm:text-xl font-bold tracking-tight text-white mt-0.5">Stay In The Beauty Loop</h3>
                <p class="text-neutral-400 text-xs mt-1">Sign up for exclusive offers, early VIP launches, personalized beauty recommendations &amp; event invites.</p>
            </div>
            <form class="flex flex-col sm:flex-row w-full md:w-auto max-w-md gap-2" data-newsletter-form>
                <input
                    class="bg-neutral-900 border border-neutral-700 text-white px-4 py-2.5 text-xs rounded-sm focus:outline-none focus:border-white flex-1 min-w-0 placeholder-neutral-500"
                    placeholder="Enter your email address..."
                    type="email"
                    required
                />
                <button class="bg-white text-black font-bold uppercase tracking-wider px-6 py-2.5 rounded-sm text-xs hover:bg-neutral-200 shrink-0 transition-colors" type="submit">
                    SUBSCRIBE
                </button>
            </form>
        </div>

        <!-- Concierge & Mobile App Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-8 border-b border-neutral-800">
            <!-- Client Concierge -->
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-full bg-neutral-900 border border-neutral-800 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-bold text-xs uppercase tracking-wider">Client Concierge (UAE)</h4>
                    <p class="text-neutral-300 text-xs mt-0.5">Call toll-free: <a href="tel:8007374672" class="font-bold underline text-white">800-SEPHORA (800 737 4672)</a></p>
                    <p class="text-neutral-500 text-[11px] mt-0.5">Everyday: 9:00 AM – 9:00 PM (GST)</p>
                </div>
            </div>

            <!-- Sephora App -->
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-full bg-neutral-900 border border-neutral-800 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-bold text-xs uppercase tracking-wider">Download Sephora App</h4>
                    <p class="text-neutral-400 text-xs mt-0.5">Get 10% off your first app purchase with code <strong class="text-white">APP10</strong>.</p>
                    <div class="flex items-center gap-2 mt-2">
                        <a href="/download-app" class="px-2.5 py-1 bg-neutral-900 hover:bg-neutral-800 border border-neutral-700 rounded text-[10px] text-neutral-300 font-medium">iOS App Store</a>
                        <a href="/download-app" class="px-2.5 py-1 bg-neutral-900 hover:bg-neutral-800 border border-neutral-700 rounded text-[10px] text-neutral-300 font-medium">Google Play</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Columns -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 text-neutral-400">
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">About Sephora</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="{{ route('home') }}">About Sephora UAE</a></li>
                    <li><a class="hover:text-white transition-colors" href="/stores">Stores &amp; Services</a></li>
                    <li><a class="hover:text-white transition-colors" href="/my-account">Beauty Pass Loyalty Program</a></li>
                    <li><a class="hover:text-white transition-colors" href="/clean-at-sephora">Clean at Sephora</a></li>
                    <li><a class="hover:text-white transition-colors" href="/gift-card-info">Gift Cards</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">Customer Service</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="{{ route('faq') }}">Help &amp; FAQs</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('faq.delivery') }}">Delivery &amp; Shipping Rates</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('faq.cancellation') }}">Returns &amp; Exchanges</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a class="hover:text-white transition-colors" href="/my-account">Track My Order</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">Legal &amp; Privacy</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="{{ route('terms') }}">Terms &amp; Conditions</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('terms') }}#privacy">Privacy Notice</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('terms') }}#cookies">Cookie Preferences</a></li>
                    <li><a class="hover:text-white transition-colors" href="{{ route('terms') }}#supply-chain">Supply Chain Transparency</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">Payment Methods</h4>
                <p class="text-[11px] text-neutral-400 mb-2.5">100% secure payment across the UAE:</p>
                <div class="flex flex-wrap gap-1.5 text-neutral-300">
                    <span class="px-2 py-1 bg-neutral-900 rounded text-[10px] border border-neutral-800 font-bold">VISA</span>
                    <span class="px-2 py-1 bg-neutral-900 rounded text-[10px] border border-neutral-800 font-bold">MasterCard</span>
                    <span class="px-2 py-1 bg-neutral-900 rounded text-[10px] border border-neutral-800 font-bold">Apple Pay</span>
                    <span class="px-2 py-1 bg-neutral-900 rounded text-[10px] border border-neutral-800 font-bold text-[#34e0a1]">Tabby</span>
                    <span class="px-2 py-1 bg-neutral-900 rounded text-[10px] border border-neutral-800 font-bold text-[#ff9900]">Tamara</span>
                    <span class="px-2 py-1 bg-neutral-900 rounded text-[10px] border border-neutral-800 text-neutral-400">Cash on Delivery</span>
                </div>
            </div>
        </div>

        <!-- Copyright Bottom Bar -->
        <div class="pt-6 border-t border-neutral-900 flex flex-col sm:flex-row items-center justify-between text-neutral-500 text-[11px] gap-4 text-center sm:text-left">
            <p>&copy; {{ date('Y') }} Sephora Middle East FZE. All rights reserved.</p>
            <p class="flex items-center gap-2">
                <span class="inline-flex w-3.5 h-2.5 overflow-hidden rounded-[1px] border border-neutral-700">
                    <svg viewBox="0 0 600 300" class="w-full h-full object-cover">
                        <rect width="600" height="100" fill="#00732f" />
                        <rect y="100" width="600" height="100" fill="#ffffff" />
                        <rect y="200" width="600" height="100" fill="#000000" />
                        <rect width="150" height="300" fill="#ff0000" />
                    </svg>
                </span>
                <span>United Arab Emirates</span>
                <span class="w-1 h-1 bg-neutral-700 rounded-full"></span>
                <a href="/my-account/settings/country-and-language" class="hover:text-neutral-300 transition-colors font-medium">English / AED</a>
            </p>
        </div>
    </div>
</footer>
<!-- END: MainFooter -->
