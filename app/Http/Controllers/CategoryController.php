<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private const PER_PAGE = 12;

    private const SORT_OPTIONS = [
        'featured' => 'Recommended',
        'newest' => 'Newest Arrivals',
        'price_asc' => 'Price: Low to High',
        'price_desc' => 'Price: High to Low',
        'rating' => 'Top Rated',
    ];

    public function makeup(Request $request)
    {
        return $this->render($request, 'makeup');
    }

    public function skincare(Request $request)
    {
        return $this->render($request, 'skincare');
    }

    public function fragrance(Request $request)
    {
        return $this->render($request, 'fragrance');
    }

    public function bathBody(Request $request)
    {
        return $this->render($request, 'bath-body');
    }

    public function hair(Request $request)
    {
        return $this->render($request, 'hair');
    }

    public function lips(Request $request)
    {
        return $this->render($request, 'lips');
    }

    public function face(Request $request)
    {
        return $this->render($request, 'face');
    }

    public function palettes(Request $request)
    {
        return $this->render($request, 'makeup-palettes');
    }

    public function bestsellers(Request $request)
    {
        return $this->render($request, 'bestsellers');
    }

    public function newness(Request $request)
    {
        return $this->render($request, 'new');
    }

    public function gifts(Request $request)
    {
        return $this->render($request, 'gifts');
    }

    public function minis(Request $request)
    {
        return $this->render($request, 'minis-more');
    }

    /**
     * All products catalog page: /shop, /shop/all, /products.
     * Allows browsing all 17,742 products with sorting, filtering, and pagination.
     */
    public function all(Request $request)
    {
        $filters = $this->parseFilters($request);

        $base = Product::active();

        // Optional category filter if passed via ?category=slug
        $selectedCategory = null;
        if ($request->filled('category')) {
            $catSlug = (string) $request->input('category');
            $selectedCategory = Category::query()->where('slug', $catSlug)->where('is_active', true)->first();
            if ($selectedCategory) {
                $base->whereHas('categories', fn ($query) => $query->where('categories.id', $selectedCategory->id));
            }
        }

        $perPage = max(12, min(48, (int) $request->input('per_page', 24)));

        $products = (clone $base)
            ->with(['brand', 'images'])
            ->when($filters['brand'], fn ($query, $brand) => $query->whereHas('brand', fn ($b) => $b->where('slug', $brand)))
            ->when($filters['min_price'] !== null, fn ($query) => $query->where('price', '>=', $filters['min_price']))
            ->when($filters['max_price'] !== null, fn ($query) => $query->where('price', '<=', $filters['max_price']))
            ->when($filters['clean'], fn ($query) => $query->where('is_clean', true))
            ->when($filters['new'], fn ($query) => $query->where('is_new', true))
            ->when($filters['in_stock'], fn ($query) => $query->where('stock', '>', 0))
            ->when($filters['q'], function ($query, $term) {
                $like = '%'.$term.'%';
                $query->where(fn ($inner) => $inner
                    ->where('name', 'like', $like)
                    ->orWhereHas('brand', fn ($brand) => $brand->where('name', 'like', $like)));
            })
            ->sorted($filters['sort'])
            ->paginate($perPage)
            ->withQueryString();

        $brands = Brand::query()
            ->whereHas('products', fn ($query) => $query->where('is_active', true))
            ->withCount(['products' => fn ($query) => $query->where('is_active', true)])
            ->orderBy('name')
            ->get();

        $priceBounds = (clone $base)
            ->selectRaw('MIN(price) as min_price, MAX(price) as max_price')
            ->first();

        $category = new Category([
            'name' => $selectedCategory ? $selectedCategory->name : 'All Products',
            'slug' => 'all',
            'hero_title' => $selectedCategory ? $selectedCategory->name : 'All Products',
            'hero_subtitle' => $selectedCategory ? $selectedCategory->description : 'Discover the complete Sephora UAE luxury beauty collection of authentic makeup, fragrance, skincare, and haircare.',
            'meta_title' => 'Shop All Products | Sephora UAE',
            'meta_description' => 'Browse all 17,742 authentic beauty products at Sephora UAE. Makeup, Fragrance, Skincare, Haircare, and more.',
        ]);

        return view('shop.category', [
            'category' => $category,
            'products' => $products,
            'filters' => $filters,
            'brands' => $brands,
            'priceBounds' => $priceBounds,
            'sortOptions' => self::SORT_OPTIONS,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    /**
     * Generic category page: /shop/{slug}.
     */
    public function show(Request $request, string $slug)
    {
        if ($slug === 'all') {
            return $this->all($request);
        }

        return $this->render($request, $slug);
    }

    /**
     * Build the listing page for a category with filters, sorting and
     * pagination. All filtering happens server-side; every link keeps the
     * current query string.
     */
    private function render(Request $request, string $slug)
    {
        $category = Category::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $filters = $this->parseFilters($request);

        $base = Product::active()
            ->whereHas('categories', fn ($query) => $query->where('categories.id', $category->id));

        $products = (clone $base)
            ->with(['brand', 'images'])
            ->when($filters['brand'], fn ($query, $brand) => $query->whereHas('brand', fn ($b) => $b->where('slug', $brand)))
            ->when($filters['min_price'] !== null, fn ($query) => $query->where('price', '>=', $filters['min_price']))
            ->when($filters['max_price'] !== null, fn ($query) => $query->where('price', '<=', $filters['max_price']))
            ->when($filters['clean'], fn ($query) => $query->where('is_clean', true))
            ->when($filters['new'], fn ($query) => $query->where('is_new', true))
            ->when($filters['in_stock'], fn ($query) => $query->where('stock', '>', 0))
            ->when($filters['q'], function ($query, $term) {
                $like = '%'.$term.'%';
                $query->where(fn ($inner) => $inner
                    ->where('name', 'like', $like)
                    ->orWhereHas('brand', fn ($brand) => $brand->where('name', 'like', $like)));
            })
            ->sorted($filters['sort'])
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        $brands = Brand::query()
            ->whereHas('products', function ($query) use ($category) {
                $query->where('is_active', true)
                    ->whereHas('categories', fn ($c) => $c->where('categories.id', $category->id));
            })
            ->withCount(['products' => function ($query) use ($category) {
                $query->where('is_active', true)
                    ->whereHas('categories', fn ($c) => $c->where('categories.id', $category->id));
            }])
            ->orderBy('name')
            ->get();

        $priceBounds = (clone $base)
            ->selectRaw('MIN(price) as min_price, MAX(price) as max_price')
            ->first();

        return view('shop.category', [
            'category' => $category,
            'products' => $products,
            'filters' => $filters,
            'brands' => $brands,
            'priceBounds' => $priceBounds,
            'sortOptions' => self::SORT_OPTIONS,
        ]);
    }

    /**
     * @return array{brand: ?string, min_price: ?float, max_price: ?float, clean: bool, new: bool, in_stock: bool, q: ?string, sort: string}
     */
    private function parseFilters(Request $request): array
    {
        $sort = (string) $request->input('sort', 'featured');
        if (! array_key_exists($sort, self::SORT_OPTIONS)) {
            $sort = 'featured';
        }

        $min = $request->filled('min_price') ? max(0, (float) $request->input('min_price')) : null;
        $max = $request->filled('max_price') ? max(0, (float) $request->input('max_price')) : null;

        if ($min !== null && $max !== null && $min > $max) {
            [$min, $max] = [$max, $min];
        }

        return [
            'brand' => $request->filled('brand') ? (string) $request->input('brand') : null,
            'min_price' => $min,
            'max_price' => $max,
            'clean' => $request->boolean('clean'),
            'new' => $request->boolean('new'),
            'in_stock' => $request->boolean('in_stock'),
            'q' => $request->filled('q') ? (string) $request->input('q') : null,
            'sort' => $sort,
        ];
    }
}
