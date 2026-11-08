@extends('admin.layout')

@php
    $isEdit = $product->exists;
    $selectedCategories = array_map('intval', old('categories', $isEdit ? $product->categories->pluck('id')->all() : []));
    $currentImage = old('image_path', $isEdit ? $product->images->first()?->path : null);
@endphp

@section('title', $isEdit ? 'Edit Product' : 'New Product')

@section('content')
<div class="max-w-5xl">
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">
            {{ $isEdit ? 'Edit: ' . $product->name : 'Add New Product' }}
        </h1>
        <a class="border border-outline px-5 h-11 inline-flex items-center font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-colors" href="{{ route('admin.products') }}">
            Back to products
        </a>
    </div>

    @if ($errors->any())
        <div class="border border-secondary bg-surface-container-lowest p-4 mb-6" role="alert">
            <p class="font-label-caps text-label-caps uppercase tracking-wider text-secondary font-bold mb-2">Please fix the following</p>
            <ul class="list-disc list-inside font-body-sm text-body-sm text-secondary space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <input type="hidden" name="categories_present" value="1">

        {{-- Basics --}}
        <section class="bg-surface-container-lowest border border-outline-variant p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-4">Basics</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="space-y-1.5 md:col-span-2">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Product name *</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('name') border-secondary @enderror"
                           name="name" required maxlength="190" type="text" value="{{ old('name', $product->name) }}">
                    @error('name')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Brand</span>
                    <select class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none" name="brand_id">
                        <option value="">— No brand —</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" @selected((int) old('brand_id', $product->brand_id) === $brand->id)>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Product type</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                           name="type" maxlength="60" type="text" placeholder="e.g. Eau de Parfum" value="{{ old('type', $product->type) }}">
                    @error('type')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">SKU</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                           name="sku" maxlength="80" type="text" value="{{ old('sku', $product->sku) }}">
                    @error('sku')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Size / volume</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                           name="size" maxlength="100" type="text" placeholder="e.g. 50ml" value="{{ old('size', $product->size) }}">
                    @error('size')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Badge</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                           name="badge" maxlength="60" type="text" placeholder="e.g. Best Seller" value="{{ old('badge', $product->badge) }}">
                    @error('badge')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Sort order</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                           name="sort_order" min="0" type="number" value="{{ old('sort_order', $product->sort_order ?? 0) }}">
                    <span class="block font-body-sm text-[12px] text-outline">Lower numbers appear first in listings.</span>
                    @error('sort_order')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>
            </div>
        </section>

        {{-- Pricing and stock --}}
        <section class="bg-surface-container-lowest border border-outline-variant p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-4">Pricing &amp; stock</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Price (AED) *</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('price') border-secondary @enderror"
                           name="price" required min="0" step="0.01" type="number" value="{{ old('price', $product->price) }}">
                    @error('price')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Compare-at price</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                           name="compare_at_price" min="0" step="0.01" type="number" value="{{ old('compare_at_price', $product->compare_at_price) }}">
                    <span class="block font-body-sm text-[12px] text-outline">Leave empty when the product is not on sale.</span>
                    @error('compare_at_price')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Stock *</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('stock') border-secondary @enderror"
                           name="stock" required min="0" type="number" value="{{ old('stock', $product->stock ?? 0) }}">
                    @error('stock')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>
            </div>
        </section>

        {{-- Categories --}}
        <section class="bg-surface-container-lowest border border-outline-variant p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-1">Categories</h2>
            <p class="font-body-sm text-body-sm text-outline mb-4">A product can appear in several categories. Removing every selection hides it from all category listings.</p>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-2.5">
                @foreach ($categories as $category)
                    <label class="flex items-center gap-2.5 border border-outline-variant px-3 py-2.5 cursor-pointer font-body-sm text-body-sm text-on-surface-variant hover:border-primary transition-colors">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                               @checked(in_array($category->id, $selectedCategories, true))
                               class="h-4 w-4 border-outline text-primary focus:ring-primary">
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
            @error('categories')<span class="block font-body-sm text-body-sm text-secondary mt-2">{{ $message }}</span>@enderror
            @error('categories.*')<span class="block font-body-sm text-body-sm text-secondary mt-2">{{ $message }}</span>@enderror
        </section>

        {{-- Media --}}
        <section class="bg-surface-container-lowest border border-outline-variant p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-4">Primary image</h2>
            <div class="grid grid-cols-1 md:grid-cols-[1fr_140px] gap-4 items-start">
                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Image path (public disk)</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                           name="image_path" maxlength="500" type="text" placeholder="images/products/product_001.webp"
                           value="{{ old('image_path', $currentImage) }}">
                    <span class="block font-body-sm text-[12px] text-outline">Relative to <code>public/</code>. Saving the same path updates the existing image instead of duplicating it.</span>
                    @error('image_path')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Upload image (JPEG/PNG/WebP, max 5 MB)</span>
                    <input class="w-full h-12 px-4 py-2 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none file:mr-3 file:border-0 file:bg-primary file:text-on-primary file:px-3 file:py-1"
                           name="image" type="file" accept="image/jpeg,image/png,image/webp">
                    <span class="block font-body-sm text-[12px] text-outline">Uploading replaces the primary image and stores it on the public disk.</span>
                    @error('image')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <div class="w-[140px] h-[140px] border border-outline-variant bg-surface-container-low flex items-center justify-center p-2">
                    @if ($currentImage)
                        <img src="{{ media_url($currentImage) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                    @else
                        <span class="material-symbols-outlined text-[32px] text-outline-variant">image</span>
                    @endif
                </div>
            </div>
        </section>

        {{-- Content --}}
        <section class="bg-surface-container-lowest border border-outline-variant p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-4">Content</h2>
            <div class="space-y-4">
                <label class="space-y-1.5 block">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Description</span>
                    <textarea class="w-full px-4 py-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none min-h-28"
                              name="description" maxlength="5000">{{ old('description', $product->description) }}</textarea>
                    @error('description')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5 block">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">How to use</span>
                    <textarea class="w-full px-4 py-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none min-h-24"
                              name="how_to_use" maxlength="3000">{{ old('how_to_use', $product->how_to_use) }}</textarea>
                    @error('how_to_use')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5 block">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Ingredients</span>
                    <textarea class="w-full px-4 py-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none min-h-24"
                              name="ingredients" maxlength="3000">{{ old('ingredients', $product->ingredients) }}</textarea>
                    @error('ingredients')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>
            </div>
        </section>

        {{-- SEO --}}
        <section class="bg-surface-container-lowest border border-outline-variant p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-4">Search engine listing</h2>
            <div class="space-y-4">
                <label class="space-y-1.5 block">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Meta title</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                           name="meta_title" maxlength="190" type="text" value="{{ old('meta_title', $product->meta_title) }}"
                           placeholder="{{ $product->name ?: 'Product name' }} | SEPHORA UAE">
                    <span class="block font-body-sm text-[12px] text-outline">Aim for 50–60 characters. Falls back to the product name.</span>
                    @error('meta_title')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5 block">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Meta description</span>
                    <textarea class="w-full px-4 py-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none min-h-20"
                              name="meta_description" maxlength="300">{{ old('meta_description', $product->meta_description) }}</textarea>
                    <span class="block font-body-sm text-[12px] text-outline">Aim for 140–160 characters. Falls back to the description.</span>
                    @error('meta_description')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>
            </div>
        </section>

        {{-- Visibility --}}
        <section class="bg-surface-container-lowest border border-outline-variant p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-4">Visibility &amp; merchandising</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                @foreach ([
                    'is_active' => ['Active — visible on the storefront', true],
                    'is_bestseller' => ['Best seller badge', false],
                    'is_new' => ['New arrival badge', false],
                    'is_clean' => ['Clean beauty badge', false],
                    'is_exclusive' => ['Sephora exclusive badge', false],
                ] as $field => [$label, $default])
                    @php
                        $checked = old($field, $isEdit ? (bool) $product->{$field} : $default);
                    @endphp
                    <label class="flex items-center gap-2.5 border border-outline-variant px-3 py-3 cursor-pointer font-body-sm text-body-sm text-on-surface-variant hover:border-primary transition-colors">
                        <input type="checkbox" name="{{ $field }}" value="1" @checked($checked)
                               class="h-4 w-4 border-outline text-primary focus:ring-primary">
                        {{ $label }}
                    </label>
                @endforeach
            </div>
        </section>

        <div class="flex flex-wrap gap-3">
            <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-8 h-12 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">
                {{ $isEdit ? 'Save changes' : 'Create product' }}
            </button>
            <a class="border border-outline px-8 h-12 inline-flex items-center font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-colors" href="{{ route('admin.products') }}">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
