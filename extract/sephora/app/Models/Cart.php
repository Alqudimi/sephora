<?php

namespace App\Models;

use App\Services\Commerce\OrderTotals;
use App\Services\Commerce\ShippingCalculator;
use App\Support\CommerceSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
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
     * Resolve the cart that belongs to the current session, creating it on
     * first use. The unique index on session_id is the source of truth, so a
     * concurrent request that loses the insert race simply re-reads the row
     * instead of throwing.
     */
    public static function current(): self
    {
        $sessionId = Session::getId();

        $cart = static::query()->where('session_id', $sessionId)->first();

        if (! $cart) {
            try {
                $cart = static::create(['session_id' => $sessionId, 'user_id' => Auth::id()]);
            } catch (QueryException $e) {
                $cart = static::query()->where('session_id', $sessionId)->firstOrFail();
            }
        }

        if (Auth::check()) {
            // Fold every other cart this user owns (e.g. an old browser
            // session) into the current one so quantities cannot diverge.
            $others = static::query()
                ->where('user_id', Auth::id())
                ->whereKeyNot($cart->getKey())
                ->get();

            foreach ($others as $other) {
                static::mergeCarts($other, $cart);
            }

            if ($cart->user_id !== Auth::id()) {
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
            ->whereKeyNot($guestCart->getKey())
            ->first();

        if ($userCart) {
            static::mergeCarts($guestCart, $userCart);
        } else {
            $guestCart->update(['user_id' => $userId]);
        }
    }

    /**
     * Move all items from $from into $to, merging quantities and clamping to
     * live stock. Then delete the now-empty cart.
     */
    private static function mergeCarts(self $from, self $to): void
    {
        $max = CommerceSettings::maxQuantityPerItem();

        foreach ($from->items()->with('product')->get() as $item) {
            $available = (int) ($item->product?->stock ?? 0);
            if ($available <= 0 || ! $item->product?->is_active) {
                $item->delete();

                continue;
            }

            $existing = $to->items()
                ->where('product_id', $item->product_id)
                ->where('shade_name', $item->shade_name)
                ->first();

            if ($existing) {
                $existing->update([
                    'quantity' => min($max, $available, $existing->quantity + $item->quantity),
                ]);
                $item->delete();
            } else {
                $item->update([
                    'cart_id' => $to->id,
                    'quantity' => min($item->quantity, $max, $available),
                ]);
            }
        }

        $from->delete();
    }

    public function subtotal(): float
    {
        return round($this->items->sum(fn ($i) => ($i->product?->price ?? 0) * $i->quantity), 2);
    }

    public function count(): int
    {
        return (int) $this->items->sum('quantity');
    }

    public function freeShippingThreshold(): float
    {
        return CommerceSettings::freeShippingThreshold();
    }

    /**
     * Delivery fee for a given method/payment combination. Kept on the model
     * so every surface (bag, checkout, confirmation) uses the same rules.
     */
    public function shippingFee(string $deliveryMethod = 'standard', ?string $paymentMethod = null): float
    {
        return app(ShippingCalculator::class)->fee($deliveryMethod, $this->subtotal(), $paymentMethod);
    }

    /**
     * Full money breakdown (VAT inclusive) for a delivery/payment choice.
     */
    public function totals(string $deliveryMethod = 'standard', ?string $paymentMethod = null, float $discount = 0.0): OrderTotals
    {
        return OrderTotals::calculate(
            $this->subtotal(),
            $discount,
            $this->shippingFee($deliveryMethod, $paymentMethod),
        );
    }
}
