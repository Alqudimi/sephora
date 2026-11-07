<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::active()
            ->with([
                'brand',
                'images',
                'shades',
                'categories',
                'reviews' => fn ($query) => $query->latest()->limit(12),
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        $categoryIds = $product->categories->pluck('id');

        $related = Product::active()
            ->whereKeyNot($product->getKey())
            ->where(function ($query) use ($product, $categoryIds) {
                $query->where('brand_id', $product->brand_id);

                if ($categoryIds->isNotEmpty()) {
                    $query->orWhereHas('categories', fn ($category) => $category->whereIn('categories.id', $categoryIds));
                }
            })
            ->with(['brand', 'images'])
            ->inStock()
            ->sorted('rating')
            ->limit(4)
            ->get();

        return view('shop.product', [
            'product' => $product,
            'related' => $related,
        ]);
    }
}
