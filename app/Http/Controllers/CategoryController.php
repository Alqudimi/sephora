<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function makeup(Request $r)
    {
        [$c, $p] = $this->categoryProducts('makeup', $this->parseFilters($r));

        return view('shop.makeup', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function skincare(Request $r)
    {
        [$c, $p] = $this->categoryProducts('skincare', $this->parseFilters($r));

        return view('shop.skincare', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function fragrance(Request $r)
    {
        [$c, $p] = $this->categoryProducts('fragrance', $this->parseFilters($r));

        return view('shop.fragrance', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function bathBody(Request $r)
    {
        [$c, $p] = $this->categoryProducts('bath-body', $this->parseFilters($r));

        return view('shop.bath-body', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function hair(Request $r)
    {
        [$c, $p] = $this->categoryProducts('hair', $this->parseFilters($r));

        return view('shop.hair', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function lips(Request $r)
    {
        [$c, $p] = $this->categoryProducts('lips', $this->parseFilters($r));

        return view('shop.lips', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function face(Request $r)
    {
        [$c, $p] = $this->categoryProducts('face', $this->parseFilters($r));

        return view('shop.face', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function palettes(Request $r)
    {
        [$c, $p] = $this->categoryProducts('makeup-palettes', $this->parseFilters($r));

        return view('shop.palettes', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function bestsellers(Request $r)
    {
        [$c, $p] = $this->categoryProducts('bestsellers', $this->parseFilters($r));

        return view('shop.category', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function newness(Request $r)
    {
        [$c, $p] = $this->categoryProducts('new', $this->parseFilters($r));

        return view('shop.new', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function gifts(Request $r)
    {
        [$c, $p] = $this->categoryProducts('gifts', $this->parseFilters($r));

        return view('shop.gifts', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function minis(Request $r)
    {
        [$c, $p] = $this->categoryProducts('minis-more', $this->parseFilters($r));

        return view('shop.minis', ['category' => $c, 'products' => $p, 'filters' => $this->parseFilters($r)]);
    }

    public function show(Request $request, string $slug)
    {
        [$category, $products] = $this->categoryProducts($slug, $this->parseFilters($request));
        $view = 'shop.'.str_replace('-', '', $slug);
        if (view()->exists($view)) {
            return view($view, ['category' => $category, 'products' => $products, 'filters' => $this->parseFilters($request)]);
        }

        return view('shop.category', ['category' => $category, 'products' => $products, 'filters' => $this->parseFilters($request)]);
    }

    /**
     * Products for a category page in design order (with optional filters).
     *
     * @return array{0: Category, 1: Collection}
     */
    private function categoryProducts(string $slug, array $filters = []): array
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = Product::active()
            ->with(['brand', 'images'])
            ->whereHas('categories', fn ($q) => $q->where('categories.id', $category->id));

        if (! empty($filters['brand'])) {
            $query->whereHas('brand', fn ($q) => $q->where('slug', $filters['brand']));
        }
        if (! empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }
        if (! empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }
        if (! empty($filters['clean'])) {
            $query->where('is_clean', true);
        }
        if (! empty($filters['new'])) {
            $query->where('is_new', true);
        }
        if (! empty($filters['q'])) {
            $term = '%'.$filters['q'].'%';
            $query->where(fn ($w) => $w->where('name', 'like', $term)->orWhereHas('brand', fn ($b) => $b->where('name', 'like', $term)));
        }

        $query->sorted($filters['sort'] ?? 'featured');

        return [$category, $query->get()];
    }

    private function parseFilters(Request $request): array
    {
        return [
            'brand' => $request->input('brand'),
            'min_price' => $request->filled('min_price') ? (float) $request->input('min_price') : null,
            'max_price' => $request->filled('max_price') ? (float) $request->input('max_price') : null,
            'clean' => $request->boolean('clean'),
            'new' => $request->boolean('new'),
            'q' => $request->input('q'),
            'sort' => $request->input('sort', 'featured'),
        ];
    }
}
