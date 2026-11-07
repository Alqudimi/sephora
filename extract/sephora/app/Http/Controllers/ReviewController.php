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

        $product->allReviews()->create([
            'user_id' => $request->user()->id,
            'author_name' => $request->user()->name,
            'rating' => $validated['rating'],
            'title' => $validated['title'] ?? null,
            'body' => $validated['body'],
            'is_approved' => false,
        ]);

        return redirect()
            ->route('product.show', ['slug' => $product->slug])
            ->with('review_status', 'Thank you! Your review has been received and will appear after moderation.');
    }
}
