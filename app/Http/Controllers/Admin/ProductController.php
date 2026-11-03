<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['brand', 'images'])
            ->when($request->input('q'), fn ($q, $t) => $q->where('name', 'like', "%{$t}%"))
            ->orderBy('sort_order')
            ->paginate(20);

        return view('admin.products', ['products' => $products]);
    }

    public function create()
    {
        return view('admin.product-form', [
            'product' => new Product,
            'brands' => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = $this->uniqueSlug($validated['name']);
        $product = Product::create($validated);
        $this->syncRelations($request, $product);

        return redirect()->route('admin.products')->with('saved', true);
    }

    public function edit(Product $product)
    {
        return view('admin.product-form', [
            'product' => $product->load(['images', 'categories']),
            'brands' => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validated($request);
        $product->update($validated);
        $this->syncRelations($request, $product);

        return redirect()->route('admin.products')->with('saved', true);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products')->with('deleted', true);
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:190',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'size' => 'nullable|string|max:100',
            'badge' => 'nullable|string|max:60',
            'description' => 'nullable|string|max:5000',
            'stock' => 'required|integer|min:0',
            'is_bestseller' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'is_clean' => 'nullable|boolean',
            'is_exclusive' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'image_path' => 'nullable|string|max:500',
        ]);
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
        if ($request->filled('image_path')) {
            // Replace the primary image instead of stacking duplicates on
            // every save.
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'sort_order' => 0],
                ['path' => $request->input('image_path'), 'alt' => $product->name],
            );
        }

        // Always sync categories (covers removals too).
        $product->categories()->sync($request->input('categories', []));
    }
}
