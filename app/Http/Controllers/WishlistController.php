<?php

namespace App\Http\Controllers;

use App\Models\WishlistItem;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        if (! auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please sign in to save items to your wishlist.',
                'redirect' => route('login'),
            ]);
        }

        $existing = WishlistItem::where('user_id', auth()->id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($existing) {
            $existing->delete();
            $added = false;
        } else {
            WishlistItem::create([
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
            ]);
            $added = true;
        }

        return response()->json([
            'success' => true,
            'added' => $added,
            'count' => auth()->user()->wishlistItems()->count(),
        ]);
    }

    public function index()
    {
        $products = auth()->user()->wishlist()->with(['brand', 'images'])->get();

        return view('account.wishlist', ['products' => $products]);
    }
}
