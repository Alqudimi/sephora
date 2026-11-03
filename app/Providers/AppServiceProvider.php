<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Setting;
use App\Models\WishlistItem;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewInstance;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
        $this->shareStorefrontCounts();

        // Cached settings lookup (flushed by Setting::set).
        Setting::retrieved(function () {
            //
        });
    }

    /**
     * Expose live bag and wishlist quantities to every view so the shared
     * header badges stay accurate without each controller repeating the query.
     */
    private function shareStorefrontCounts(): void
    {
        View::composer('*', function (ViewInstance $view) {
            $view->with($this->storefrontCounts());
        });
    }

    /**
     * Counts are memoized per request: wildcard composers run for the layout,
     * header, footer and every include.
     */
    private function storefrontCounts(): array
    {
        $request = request();
        $cached = $request->attributes->get('storefront_counts');

        if (is_array($cached)) {
            return $cached;
        }

        $bagCount = view()->shared('bagCount');

        $counts = [
            'cartCount' => $bagCount === null ? $this->cartCount($request) : (int) $bagCount,
            'wishlistCount' => $this->wishlistCount($request),
        ];

        $request->attributes->set('storefront_counts', $counts);

        return $counts;
    }

    private function cartCount(Request $request): int
    {
        if (! $request->hasSession()) {
            return 0;
        }

        $cart = Cart::query()
            ->where('session_id', $request->session()->getId())
            ->when(auth()->check(), fn ($query) => $query->orWhere('user_id', auth()->id()))
            ->first();

        return $cart ? (int) $cart->items()->sum('quantity') : 0;
    }

    private function wishlistCount(Request $request): int
    {
        if (auth()->check()) {
            return WishlistItem::query()->where('user_id', auth()->id())->count();
        }

        if (! $request->hasSession()) {
            return 0;
        }

        $wishlist = $request->session()->get('wishlist');

        return $wishlist instanceof Collection ? $wishlist->count() : 0;
    }

    /**
     * Named rate limiters used by route middleware.
     */
    private function configureRateLimiting(): void
    {
        // Login brute-force protection: 5 attempts / minute per IP+email.
        RateLimiter::for('login', function (Request $request) {
            $email = strtolower((string) $request->input('email', ''));

            return [
                Limit::perMinute(5)->by("login:{$request->ip()}|{$email}"),
                Limit::perHour(30)->by("login-hour:{$request->ip()}"),
            ];
        });

        // Public forms (newsletter, contact, coupon, register, password reset).
        RateLimiter::for('forms', function (Request $request) {
            return Limit::perMinute(6)->by("forms:{$request->ip()}");
        });

        // Cart mutations (add/update/remove/wishlist).
        RateLimiter::for('cart', function (Request $request) {
            return Limit::perMinute(60)->by("cart:{$request->ip()}");
        });

        // Order placement: hard cap per IP per hour (double-submit guard).
        RateLimiter::for('checkout', function (Request $request) {
            return Limit::perHour(10)->by("checkout:{$request->ip()}");
        });
    }
}
