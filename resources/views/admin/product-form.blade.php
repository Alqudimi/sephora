@extends('admin.layout')
@section('title', isset($product->id) && $product->id ? 'Edit Product' : 'New Product')
@section('content')
<h1 class="font-headline-md text-headline-md font-bold text-primary uppercase mb-8">{{ isset($product->id) && $product->id ? 'Edit: ' . $product->name : 'Add New Product' }}</h1>
<form class="bg-surface-container-lowest card-border p-8 grid grid-cols-1 md:grid-cols-2 gap-5 max-w-4xl" method="POST" action="{{ isset($product->id) && $product->id ? route('admin.products.update', $product) : route('admin.products.store') }}">
    @csrf
    @if(isset($product->id) && $product->id) @method('PUT') @endif
    <label class="space-y-1.5 md:col-span-2"><span class="font-label-caps text-label-caps uppercase text-outline font-bold">Product Name *</span>
        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary" name="name" required value="{{ old('name', $product->name) }}" type="text"/></label>
    <label class="space-y-1.5"><span class="font-label-caps text-label-caps uppercase text-outline font-bold">Brand</span>
        <select class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary" name="brand_id">
            <option value="">—</option>
            @foreach($brands as $b)<option value="{{ $b->id }}" {{ old('brand_id', $product->brand_id) == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>@endforeach
        </select></label>
    <label class="space-y-1.5"><span class="font-label-caps text-label-caps uppercase text-outline font-bold">Price (AED) *</span>
        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary" name="price" required step="0.01" type="number" value="{{ old('price', $product->price) }}"/></label>
    <label class="space-y-1.5"><span class="font-label-caps text-label-caps uppercase text-outline font-bold">Compare-at Price</span>
        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary" name="compare_at_price" step="0.01" type="number" value="{{ old('compare_at_price', $product->compare_at_price) }}"/></label>
    <label class="space-y-1.5"><span class="font-label-caps text-label-caps uppercase text-outline font-bold">Stock *</span>
        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary" name="stock" required type="number" value="{{ old('stock', $product->stock ?? 100) }}"/></label>
    <label class="space-y-1.5"><span class="font-label-caps text-label-caps uppercase text-outline font-bold">Badge</span>
        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary" name="badge" placeholder="e.g. Best Seller" type="text" value="{{ old('badge', $product->badge) }}"/></label>
    <label class="space-y-1.5"><span class="font-label-caps text-label-caps uppercase text-outline font-bold">Image Path (public)</span>
        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary" name="image_path" placeholder="images/products/product_001.webp" type="text" value="{{ old('image_path') }}"/></label>
    <label class="space-y-1.5 md:col-span-2"><span class="font-label-caps text-label-caps uppercase text-outline font-bold">Description</span>
        <textarea class="w-full px-4 py-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary min-h-28" name="description">{{ old('description', $product->description) }}</textarea></label>
    <div class="md:col-span-2 grid grid-cols-2 md:grid-cols-5 gap-3">
        @foreach(['is_bestseller' => 'Best Seller', 'is_new' => 'New', 'is_clean' => 'Clean', 'is_exclusive' => 'Exclusive', 'is_active' => 'Active'] as $field => $label)
        <label class="flex items-center gap-2 font-body-sm text-body-sm"><input class="w-4 h-4" name="{{ $field }}" type="checkbox" value="1" {{ old($field, $product->{{$field}} ?? true) ? 'checked' : '' }}/> {{ $label }}</label>
        @endforeach
    </div>
    <div class="md:col-span-2 flex gap-3">
        <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 h-12 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" type="submit">Save Product</button>
        <a class="border border-outline px-10 h-12 flex items-center font-label-caps text-label-caps uppercase tracking-widest hover:border-primary" href="{{ route('admin.products') }}">Cancel</a>
    </div>
</form>
@endsection
