<?php

use App\Http\Controllers\Account\ContactController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WishlistController;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| SEPHORA UAE — Web Routes
|--------------------------------------------------------------------------
*/

// ── Home ──
Route::get('/', [PageController::class, 'home'])->name('home');

// ── Static / content pages ──
Route::get('/beauty-offers', [PageController::class, 'beautyOffers'])->name('beauty-offers');
Route::get('/beauty-offers/offers', [PageController::class, 'beautyOffersAlt'])->name('beauty-offers.alt');
Route::get('/brands', [BrandController::class, 'index'])->name('brands');
Route::get('/brands/{slug}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact');
Route::post('/contact-us', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/stores', [PageController::class, 'stores'])->name('stores');
Route::get('/gift-card-info', [PageController::class, 'giftCards'])->name('gift-cards');
Route::get('/download-app', [PageController::class, 'downloadApp'])->name('download-app');
Route::get('/clean-at-sephora', [PageController::class, 'cleanPlanetAware'])->name('clean');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/faq/delivery', [PageController::class, 'faqDelivery'])->name('faq.delivery');
Route::get('/faq/cancellation-and-refund', [PageController::class, 'faqCancellation'])->name('faq.cancellation');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('terms');

// ── Shop: categories ──
Route::get('/shop/makeup', [CategoryController::class, 'makeup'])->name('shop.makeup');
Route::get('/shop/skincare', [CategoryController::class, 'skincare'])->name('shop.skincare');
Route::get('/shop/fragrance', [CategoryController::class, 'fragrance'])->name('shop.fragrance');
Route::get('/shop/bath-body', [CategoryController::class, 'bathBody'])->name('shop.bath-body');
Route::get('/shop/hair', [CategoryController::class, 'hair'])->name('shop.hair');
Route::get('/shop/lips', [CategoryController::class, 'lips'])->name('shop.lips');
Route::get('/shop/face', [CategoryController::class, 'face'])->name('shop.face');
Route::get('/shop/makeup-palettes', [CategoryController::class, 'palettes'])->name('shop.palettes');
Route::get('/shop/bestsellers', [CategoryController::class, 'bestsellers'])->name('shop.bestsellers');
Route::get('/shop/new', [CategoryController::class, 'newness'])->name('shop.new');
Route::get('/shop/gifts', [CategoryController::class, 'gifts'])->name('shop.gifts');
Route::get('/shop/gifts/minis-more', [CategoryController::class, 'minis'])->name('shop.minis');
Route::get('/shop/{slug}', [CategoryController::class, 'show'])->name('shop.category');

// ── Products ──
Route::get('/p/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// ── Cart ──
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->middleware('throttle:cart')->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->middleware('throttle:cart')->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->middleware('throttle:cart')->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->middleware('throttle:cart')->name('cart.clear');

// ── Wishlist ──
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->middleware('throttle:cart')->name('wishlist.toggle');

// ── Newsletter ──
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->middleware('throttle:forms')->name('newsletter.subscribe');

// ── Gift card balance ──
Route::post('/gift-card/balance', [PageController::class, 'giftCardBalance'])->middleware('throttle:forms')->name('gift-card.balance');

// ── Auth (custom, matching design) ──
Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/sign-in', [LoginController::class, 'login'])->middleware('throttle:login')->name('login.attempt');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:forms')->name('register');

    // Password reset
    Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->middleware('throttle:forms')->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->middleware('throttle:forms')->name('password.update');
});
Route::post('/sign-out', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ── Checkout ──
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->middleware('throttle:checkout')->name('checkout.place');
Route::post('/checkout/coupon', [CheckoutController::class, 'applyCoupon'])->middleware('throttle:forms')->name('checkout.coupon.apply');
Route::post('/checkout/coupon/remove', [CheckoutController::class, 'removeCoupon'])->middleware('throttle:forms')->name('checkout.coupon.remove');
Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
Route::get('/order/{order}', [CheckoutController::class, 'confirmationGuest'])->name('checkout.confirmation.guest');

// ── My Account ──
Route::middleware('auth')->prefix('my-account')->name('account.')->group(function () {
    Route::get('/', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [AccountController::class, 'orderShow'])->name('orders.show');
    Route::get('/settings', [AccountController::class, 'settings'])->name('settings');
    Route::post('/settings', [AccountController::class, 'updateSettings'])->name('settings.update');
    Route::get('/settings/country-and-language', [AccountController::class, 'countryLanguage'])->name('country-language');
    Route::post('/settings/country-and-language', [AccountController::class, 'updateCountryLanguage'])->name('country-language.update');
    Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('/addresses', [AccountController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [AccountController::class, 'storeAddress'])->name('addresses.store');
});

// ── Sitemap (cached 60 minutes) ──
Route::get('/sitemap.xml', function () {
    $xml = Cache::remember('sitemap.xml', now()->addMinutes(60), function () {
        $routes = [
            '/', '/shop/makeup', '/shop/skincare', '/shop/fragrance', '/shop/bath-body',
            '/shop/hair', '/shop/lips', '/shop/face', '/shop/makeup-palettes',
            '/shop/bestsellers', '/shop/new', '/shop/gifts', '/shop/gifts/minis-more',
            '/brands', '/brands/sephora-collection', '/beauty-offers', '/stores',
            '/gift-card-info', '/download-app', '/clean-at-sephora', '/faq',
            '/faq/delivery', '/faq/cancellation-and-refund', '/terms-and-conditions',
            '/contact-us', '/sign-in',
        ];
        foreach (Product::active()->select('slug')->get() as $p) {
            $routes[] = '/p/'.$p->slug;
        }
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        foreach ($routes as $r) {
            $xml .= '  <url><loc>'.url($r)."</loc></url>\n";
        }

        return $xml.'</urlset>';
    });

    return response($xml, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');

// ── Admin panel ──
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
});
