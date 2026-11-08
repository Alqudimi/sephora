
<!-- BEGIN: MainFooter -->
<footer class="bg-black text-white text-xs pt-12 pb-8 mt-12 border-t border-gray-800">
    <div class="max-w-[1440px] mx-auto px-4 md:px-8 space-y-10">
        <!-- Newsletter Row -->
        <div class="flex flex-col md:flex-row items-center justify-between pb-8 border-b border-gray-800 gap-4">
            <div class="text-center md:text-left">
                <h3 class="text-base font-bold tracking-tight">Stay Connected with Sephora</h3>
                <p class="text-gray-400 text-xs mt-1">Sign up for exclusive offers, new product launches &amp; beauty advice.</p>
            </div>
            <form class="flex flex-col sm:flex-row w-full md:w-auto max-w-md gap-2.5" data-newsletter-form>
                <input
                    class="bg-[#222] border border-[#333] text-white px-3.5 py-2.5 text-xs rounded focus:outline-none focus:border-white flex-1 min-w-0"
                    placeholder="Enter your email"
                    type="email"
                    required
                />
                <button class="bg-white text-black font-bold uppercase tracking-wider px-6 py-2.5 rounded text-xs hover:bg-gray-200 shrink-0 transition-colors" type="submit">
                    Sign Up
                </button>
            </form>
        </div>

        <!-- Footer Columns -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 text-gray-400">
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">About Sephora</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="<?php echo e(route('home')); ?>">About Us</a></li>
                    <li><a class="hover:text-white transition-colors" href="/stores">Careers</a></li>
                    <li><a class="hover:text-white transition-colors" href="/stores">Store Locator</a></li>
                    <li><a class="hover:text-white transition-colors" href="/my-account">Beauty Pass Program</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">Customer Service</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="<?php echo e(route('faq')); ?>">Help &amp; FAQs</a></li>
                    <li><a class="hover:text-white transition-colors" href="<?php echo e(route('faq.delivery')); ?>">Delivery Information</a></li>
                    <li><a class="hover:text-white transition-colors" href="<?php echo e(route('faq.cancellation')); ?>">Returns &amp; Exchanges</a></li>
                    <li><a class="hover:text-white transition-colors" href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">Terms &amp; Privacy</h4>
                <ul class="space-y-2">
                    <li><a class="hover:text-white transition-colors" href="<?php echo e(route('terms')); ?>">Terms &amp; Conditions</a></li>
                    <li><a class="hover:text-white transition-colors" href="<?php echo e(route('terms')); ?>#privacy">Privacy Policy</a></li>
                    <li><a class="hover:text-white transition-colors" href="<?php echo e(route('terms')); ?>#cookies">Cookie Settings</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-3">Payment Methods</h4>
                <div class="flex flex-wrap gap-2 pt-1 text-gray-400">
                    <span class="px-2 py-1 bg-[#1a1a1a] rounded text-[10px] border border-gray-800">VISA</span>
                    <span class="px-2 py-1 bg-[#1a1a1a] rounded text-[10px] border border-gray-800">MasterCard</span>
                    <span class="px-2 py-1 bg-[#1a1a1a] rounded text-[10px] border border-gray-800">Apple Pay</span>
                    <span class="px-2 py-1 bg-[#1a1a1a] rounded text-[10px] border border-gray-800">Tabby</span>
                    <span class="px-2 py-1 bg-[#1a1a1a] rounded text-[10px] border border-gray-800">Tamara</span>
                </div>
            </div>
        </div>

        <!-- Copyright Bottom Bar -->
        <div class="pt-6 border-t border-gray-900 flex flex-col sm:flex-row items-center justify-between text-gray-500 text-[11px] gap-4 text-center sm:text-left">
            <p>&copy; <?php echo e(date('Y')); ?> Sephora Middle East. All rights reserved.</p>
            <p class="flex items-center gap-2">
                <span>United Arab Emirates</span>
                <span class="w-1 h-1 bg-gray-600 rounded-full"></span>
                <a href="/my-account/settings/country-and-language" class="hover:text-gray-300 transition-colors">English / AED</a>
            </p>
        </div>
    </div>
</footer>
<!-- END: MainFooter -->
<?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/partials/footer.blade.php ENDPATH**/ ?>