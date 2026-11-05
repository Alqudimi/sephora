<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Category::class);

        $categories = Category::with('parent')
            ->withCount('products')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(30)
            ->withQueryString();

        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        $this->authorize('create', Category::class);

        return view('admin.categories.form', [
            'category' => new Category,
            'parents' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $request->merge([
            'parent_id' => $request->filled('parent_id') ? $request->input('parent_id') : null,
        ]);

        $validated = $this->validated($request);

        if (blank($validated['slug'] ?? null)) {
            $validated['slug'] = $this->uniqueSlug($validated['name']);
        }

        Category::create($validated);

        return redirect()->route('admin.categories')->with('saved', true);
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view('admin.categories.form', [
            'category' => $category,
            'parents' => Category::whereKeyNot($category->id)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $request->merge([
            'parent_id' => $request->filled('parent_id') ? $request->input('parent_id') : null,
        ]);

        $validated = $this->validated($request, $category);

        if (blank($validated['slug'] ?? null)) {
            unset($validated['slug']);
        }

        if (isset($validated['parent_id']) && (int) $validated['parent_id'] === $category->id) {
            return back()->withErrors(['parent_id' => 'A category cannot be its own parent.'])->withInput();
        }

        $category->update($validated);

        return redirect()->route('admin.categories')->with('saved', true);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        if ($category->products()->exists()) {
            return redirect()->route('admin.categories')
                ->withErrors(['category' => 'Cannot delete a category that still has products.']);
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('deleted', true);
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Category $category = null): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:190',
            'slug' => [
                'nullable',
                'string',
                'max:190',
                Rule::unique('categories', 'slug')->ignore($category?->id),
            ],
            'parent_id' => 'nullable|integer|exists:categories,id',
            'hero_title' => 'nullable|string|max:190',
            'hero_subtitle' => 'nullable|string|max:1000',
            'hero_image' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:5000',
            'is_active' => 'nullable|boolean',
            'show_in_nav' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['show_in_nav'] = $request->boolean('show_in_nav');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if (array_key_exists('parent_id', $validated) && $validated['parent_id'] === '') {
            $validated['parent_id'] = null;
        }

        return $validated;
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'category';
        $slug = $base;
        $i = 1;

        while (Category::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
