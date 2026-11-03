<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->input('q', ''));
        $q = mb_substr($q, 0, 100); // hard cap: keeps LIKE scans cheap
        $products = collect();

        if ($q !== '') {
            $products = Product::active()
                ->with(['brand', 'images'])
                ->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhereHas('brand', fn ($b) => $b->where('name', 'like', "%{$q}%"));
                })
                ->orderBy('sort_order')
                ->limit(48)
                ->get();
        }

        return view('shop.search', ['query' => $q, 'products' => $products]);
    }
}
