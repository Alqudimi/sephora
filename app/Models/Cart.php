<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    protected $fillable = ['session_id', 'user_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get or create the current cart (session based, linked to user when logged in).
     */
    public static function current(): self
    {
        $sessionId = Session::getId();

        $cart = static::where('session_id', $sessionId)->first();

        if (! $cart) {
            $cart = static::create(['session_id' => $sessionId, 'user_id' => Auth::id()]);
        } elseif (Auth::check() && $cart->user_id !== Auth::id()) {
            // merge guest cart into user's cart
            $userCart = static::where('user_id', Auth::id())->where('id', '!=', $cart->id)->first();
            if ($userCart) {
                static::mergeCarts($cart, $userCart);
                $cart = $userCart;
            } else {
                $cart->update(['user_id' => Auth::id()]);
            }
        }

        return $cart->loadMissing('items.product.images', 'items.product.brand');
    }

    /**
     * Claim a guest cart for a user right before the session is regenerated
     * at login/register time (the old session id is about to disappear).
     */
    public static function claimGuestCart(string $sessionId, int $userId): void
    {
        $guestCart = static::query()
            ->where('session_id', $sessionId)
            ->whereNull('user_id')
            ->first();

        if (! $guestCart) {
            return;
        }

        $userCart = static::query()
            ->where('user_id', $userId)
            ->where('id', '!=', $guestCart->id)
            ->first();

        if ($userCart) {
            static::mergeCarts($guestCart, $userCart);
        } else {
            $guestCart->update(['user_id' => $userId]);
        }
    }

    /**
     * Move all items from $from into $to (merging quantities, capped at 20),
     * then delete $from.
     */
    private static function mergeCarts(self $from, self $to): void
    {
        foreach ($from->items as $item) {
            $existing = $to->items()
                ->where('product_id', $item->product_id)
                ->where('shade_name', $item->shade_name)
                ->first();

            if ($existing) {
                $existing->update(['quantity' => min(20, $existing->quantity + $item->quantity)]);
            } else {
                $item->update(['cart_id' => $to->id]);
            }
        }

        $from->delete();
    }

    public function subtotal(): float
    {
        return $this->items->sum(fn ($i) => ($i->product?->price ?? 0) * $i->quantity);
    }

    public function count(): int
    {
        return $this->items->sum('quantity');
    }

    public function freeShippingThreshold(): float
    {
        return (float) Setting::get('free_shipping_threshold', 250);
    }

    public function shippingFee(): float
    {
        return $this->subtotal() >= $this->freeShippingThreshold() ? 0 : (float) Setting::get('shipping_fee', 25);
    }
}
