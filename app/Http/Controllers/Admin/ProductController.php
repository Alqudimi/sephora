<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private const BOOLEAN_FLAGS = [
        'is_bestseller',
        'is_new',
        'is_clean',
        'is_exclusive',
        'is_active',
    ];

    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);

        $products = Product::with(['brand', 'images'])
            ->when($request->input('q'), function ($query, $term) {
                $like = '%'.$term.'%';
                $query->where(fn ($inner) => $inner
                    ->where('name', 'like', $like)
                    ->orWhere('sku', 'like', $like)
                    ->orWhereHas('brand', fn ($brand) => $brand->where('name', 'like', $like)));
            })
            ->when($request->input('status') === 'active', fn ($query) => $query->where('is_active', true))
            ->when($request->input('status') === 'hidden', fn ($query) => $query->where('is_active', false))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.products', ['products' => $products]);
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('admin.product-form', [
            'product' => new Product,
            'brands' => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $validated = $this->validated($request);
        $validated['slug'] = $this->uniqueSlug($validated['name']);

        $product = Product::create($validated);
        $this->syncRelations($request, $product);

        // Keep the cached sitemap honest with the new catalogue entry.
        Cache::forget('sitemap.xml');

        return redirect()->route('admin.products')->with('saved', true);
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('admin.product-form', [
            'product' => $product->load(['images', 'categories']),
            'brands' => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $this->validated($request);
        $product->update($validated);
        $this->syncRelations($request, $product);

        // Keep the cached sitemap honest with the refreshed catalogue entry.
        Cache::forget('sitemap.xml');

        return redirect()->route('admin.products')->with('saved', true);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        // A removed product must disappear from the cached sitemap.
        Cache::forget('sitemap.xml');

        return redirect()->route('admin.products')->with('deleted', true);
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:190',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'size' => 'nullable|string|max:100',
            'sku' => 'nullable|string|max:80',
            'type' => 'nullable|string|max:60',
            'badge' => 'nullable|string|max:60',
            'description' => 'nullable|string|max:5000',
            'how_to_use' => 'nullable|string|max:3000',
            'ingredients' => 'nullable|string|max:3000',
            'meta_title' => 'nullable|string|max:190',
            'meta_description' => 'nullable|string|max:300',
            'sort_order' => 'nullable|integer|min:0|max:999999',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|file|image|mimes:jpeg,png,webp|max:5120',
            'image_path' => 'nullable|string|max:500',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id',
            'categories_present' => 'nullable|boolean',
            'is_bestseller' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'is_clean' => 'nullable|boolean',
            'is_exclusive' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Checkbox semantics: an unchecked box is absent from the request, so
        // normalise every flag explicitly instead of leaving the old value.
        foreach (self::BOOLEAN_FLAGS as $flag) {
            $validated[$flag] = $request->boolean($flag);
        }

        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        return $validated;
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'product';
        $slug = $base;
        $i = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    private function syncRelations(Request $request, Product $product): void
    {
        $primaryImage = ProductImage::where('product_id', $product->id)
            ->where('sort_order', 0)
            ->first();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');

            if ($primaryImage && $primaryImage->path !== $path && str_starts_with($primaryImage->path, 'products/')) {
                Storage::disk('public')->delete($primaryImage->path);
            }

            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'sort_order' => 0],
                ['path' => $path, 'alt' => $product->name],
            );
        } elseif ($request->filled('image_path')) {
            if ($primaryImage && $primaryImage->path !== $request->input('image_path') && str_starts_with($primaryImage->path, 'products/')) {
                Storage::disk('public')->delete($primaryImage->path);
            }

            // Replace the primary image instead of stacking duplicates on
            // every save.
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'sort_order' => 0],
                ['path' => $request->input('image_path'), 'alt' => $product->name],
            );
        }

        // The form always submits categories_present, so an empty selection
        // intentionally clears categories. Requests without the marker leave
        // existing categories untouched.
        if ($request->boolean('categories_present')) {
            $product->categories()->sync($request->input('categories', []));
        }
    }
}
