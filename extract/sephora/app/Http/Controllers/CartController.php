<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Support\CommerceSettings;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::current()->loadMissing('items.product.images', 'items.product.brand');
        $totals = $cart->totals();

        return view('shop.cart', [
            'cart' => $cart,
            'items' => $cart->items,
            'subtotal' => $totals->subtotal,
            'shippingFee' => $totals->shipping,
            'taxAmount' => $totals->taxAmount,
            'total' => $totals->total,
            'freeShippingThreshold' => $cart->freeShippingThreshold(),
        ]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:20',
            'shade' => 'nullable|string|max:120',
        ]);

        $product = Product::query()->whereKey($validated['product_id'])->where('is_active', true)->first();

        if (! $product) {
            return $this->respond($request, false, 'This product is no longer available.', 422);
        }

        $available = (int) $product->stock;
        if ($available <= 0) {
            return $this->respond($request, false, 'This product is out of stock.', 422);
        }

        $max = min($available, CommerceSettings::maxQuantityPerItem());
        $quantity = min((int) ($validated['quantity'] ?? 1), $max);
        $cart = Cart::current();

        $existing = $cart->items()
            ->where('product_id', $product->id)
            ->where('shade_name', $validated['shade'] ?? null)
            ->first();

        if ($existing) {
            $newQuantity = min($max, $existing->quantity + $quantity);
            if ($newQuantity === $existing->quantity) {
                return $this->respond($request, false, "You already have the maximum available quantity of {$product->name}.", 422);
            }
            $existing->update(['quantity' => $newQuantity]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'shade_name' => $validated['shade'] ?? null,
                'quantity' => $quantity,
            ]);
        }

        $cart->refresh()->loadMissing('items.product');

        return $this->respond($request, true, 'Added to bag', 200, [
            'count' => $cart->count(),
            'subtotal' => round($cart->subtotal(), 2),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        $cart = Cart::current();
        $item = $cart->items()->with('product')->where('id', $validated['item_id'])->first();

        if (! $item) {
            return $this->respond($request, false, 'This bag item no longer exists.', 404);
        }

        $max = min((int) ($item->product?->stock ?? 0), CommerceSettings::maxQuantityPerItem());

        if ($max <= 0) {
            $item->delete();

            return $this->respond($request, false, 'This product is out of stock and was removed from your bag.', 422);
        }

        $quantity = min($validated['quantity'], $max);
        $item->update(['quantity' => $quantity]);

        $cart->refresh()->loadMissing('items.product');
        $totals = $cart->totals();

        return $this->respond($request, true, $quantity < $validated['quantity']
            ? "Only {$max} available. Quantity updated."
            : 'Bag updated.', 200, [
                'reload' => true,
                'quantity' => $quantity,
                'clamped' => $quantity < $validated['quantity'],
                'subtotal' => round($totals->subtotal, 2),
                'total' => round($totals->total, 2),
            ]);
    }

    public function remove(Request $request)
    {
        $validated = $request->validate(['item_id' => 'required|integer']);
        $cart = Cart::current();
        $cart->items()->where('id', $validated['item_id'])->delete();

        return $this->respond($request, true, 'Item removed.', 200, ['reload' => true]);
    }

    public function clear()
    {
        Cart::current()->items()->delete();

        return $this->respond(request(), true, 'Bag cleared.', 200, ['reload' => true]);
    }

    /**
     * JSON for AJAX callers, a flash + redirect for progressive-enhancement
     * form posts.
     */
    private function respond(Request $request, bool $success, string $message, int $status, array $extra = [])
    {
        if ($request->expectsJson()) {
            return response()->json(array_merge([
                'success' => $success,
                'message' => $message,
            ], $extra), $status);
        }

        $redirect = $success ? back() : back()->withInput();

        return $redirect->with($success ? 'status' : 'error', $message);
    }
}
