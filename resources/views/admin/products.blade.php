@extends('admin.layout')
@section('title', 'Products')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Products</h1>
    <a class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 py-3 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="{{ route('admin.products.create') }}">+ Add Product</a>
</div>
<form class="mb-4 flex gap-2 max-w-md" method="GET">
    <input class="h-11 px-4 bg-surface-container-lowest border border-outline font-body-sm text-body-sm focus:border-primary flex-1" name="q" placeholder="Search products..." value="{{ request('q') }}" type="text"/>
    <button class="bg-primary text-on-primary font-label-caps uppercase px-5 text-label-caps" type="submit">Search</button>
</form>
<div class="bg-surface-container-lowest card-border overflow-x-auto">
    <table class="w-full text-left font-body-sm text-body-sm min-w-[800px]">
        <thead class="bg-surface-container text-on-surface-variant font-label-caps text-label-caps uppercase">
            <tr><th class="px-4 py-3">Image</th><th class="px-4 py-3">Product</th><th class="px-4 py-3">Brand</th><th class="px-4 py-3">Price</th><th class="px-4 py-3">Stock</th><th class="px-4 py-3">Status</th><th class="px-4 py-3"></th></tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-t border-outline-variant">
                <td class="px-4 py-2"><img alt="" class="w-12 h-12 object-contain bg-surface-container-low" src="{{ asset($product->first_image) }}"/></td>
                <td class="px-4 py-3 font-semibold text-primary max-w-xs truncate">{{ $product->name }}</td>
                <td class="px-4 py-3">{{ $product->brand?->name }}</td>
                <td class="px-4 py-3 font-bold">AED {{ number_format($product->price, 2) }}</td>
                <td class="px-4 py-3">{{ $product->stock }}</td>
                <td class="px-4 py-3"><span class="font-label-tag uppercase px-2 py-0.5 font-bold {{ $product->is_active ? 'bg-[#1b6b45] text-white' : 'bg-surface-container-high text-on-surface' }}">{{ $product->is_active ? 'Live' : 'Hidden' }}</span></td>
                <td class="px-4 py-3 flex gap-3">
                    <a class="underline hover:text-secondary" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onconfirm="return confirm('Delete this product?')">
                        @csrf @method('DELETE')
                        <button class="underline text-error" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $products->links() }}
@endsection
