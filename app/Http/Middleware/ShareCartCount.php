<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShareCartCount
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            view()->share('bagCount', $this->bagCount($request));
        } catch (\Throwable) {
            view()->share('bagCount', 0);
        }

        return $next($request);
    }

    /**
     * Single aggregate query — avoids eager-loading products/images on
     * every request.
     */
    private function bagCount(Request $request): int
    {
        $sessionId = $request->hasSession() ? $request->session()->getId() : null;

        if ($sessionId === null) {
            return 0;
        }

        $cart = Cart::query()
            ->where('session_id', $sessionId)
            ->when(auth()->check(), fn ($q) => $q->orWhere('user_id', auth()->id()))
            ->first();

        if (! $cart) {
            return 0;
        }

        return (int) $cart->items()->sum('quantity');
    }
}
