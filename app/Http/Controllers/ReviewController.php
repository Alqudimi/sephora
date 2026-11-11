<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a customer review. Reviews are moderated (is_approved = false)
     * before they appear on the storefront.
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'title' => ['nullable', 'string', 'max:120'],
            'body' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $hasPurchased = $request->user()->orders()
            ->whereIn('status', ['processing', 'shipped', 'out_for_delivery', 'delivered'])
            ->whereHas('items', fn ($q) => $q->where('product_id', $product->id))
            ->exists();

        $product->allReviews()->create([
            'user_id' => $request->user()->id,
            'author_name' => $request->user()->name,
            'rating' => $validated['rating'],
            'title' => $validated['title'] ?? null,
            'body' => $validated['body'],
            'is_approved' => false,
            'is_verified_purchase' => $hasPurchased,
        ]);

        return redirect()
            ->route('product.show', ['slug' => $product->slug])
            ->with('review_status', __('runtime.review_received'));
    }
}
