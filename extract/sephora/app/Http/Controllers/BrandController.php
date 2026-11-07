<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('name')->get()->groupBy(fn ($b) => strtoupper(substr($b->name, 0, 1)));

        return view('pages.brands', ['groupedBrands' => $brands]);
    }

    public function show(string $slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $products = Product::active()->where('brand_id', $brand->id)->with(['images'])->orderBy('sort_order')->get();

        if ($slug === 'sephora-collection') {
            return view('shop.sephora-collection', ['brand' => $brand, 'products' => $products]);
        }

        return view('shop.brand', ['brand' => $brand, 'products' => $products]);
    }
}
