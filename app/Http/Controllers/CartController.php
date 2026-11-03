<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::current()->loadMissing('items.product.images', 'items.product.brand');
        return view('shop.cart', [
            'cart' => $cart,
            'items' => $cart->items,
            'subtotal' => $cart->subtotal(),
            'shippingFee' => $cart->shippingFee(),
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

        $product = Product::findOrFail($validated['product_id']);
        $cart = Cart::current();

        $existing = $cart->items()
            ->where('product_id', $product->id)
            ->where('shade_name', $validated['shade'] ?? null)
            ->first();

        if ($existing) {
            $existing->update(['quantity' => min(20, $existing->quantity + ($validated['quantity'] ?? 1))]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'shade_name' => $validated['shade'] ?? null,
                'quantity' => $validated['quantity'] ?? 1,
            ]);
        }

        $cart->refresh();
        return response()->json([
            'success' => true,
            'count' => $cart->count(),
            'message' => 'Added to bag',
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        $cart = Cart::current();
        $item = $cart->items()->where('id', $validated['item_id'])->first();

        if ($item) {
            $item->update(['quantity' => $validated['quantity']]);
        }

        return response()->json(['success' => true, 'reload' => true]);
    }

    public function remove(Request $request)
    {
        $validated = $request->validate(['item_id' => 'required|integer']);
        $cart = Cart::current();
        $cart->items()->where('id', $validated['item_id'])->delete();
        return response()->json(['success' => true, 'reload' => true]);
    }

    public function clear()
    {
        Cart::current()->items()->delete();
        return response()->json(['success' => true, 'reload' => true]);
    }
}
