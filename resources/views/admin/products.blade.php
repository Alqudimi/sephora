@extends('admin.layout')
@section('title', __('meta.products'))
@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ __('ui.products') }}</h1>
        <p class="font-body-sm text-body-sm text-outline mt-1">{{ number_format($products->total()) }} products in the catalog</p>
    </div>
    <a class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-5 h-11 inline-flex items-center hover:bg-surface-container-lowest hover:text-primary border border-primary transition-all" href="{{ route('admin.products.create') }}">
        {{ __('content.t_3c36081df152') }}
    </a>
</div>

<form class="mb-5 flex flex-col sm:flex-row gap-2 max-w-2xl" method="GET">
    <label class="sr-only" for="product-search">{{ __('content.t_4412bfe59cdf') }}</label>
    <input id="product-search" class="h-11 px-4 bg-surface-container-lowest border border-outline font-body-sm text-body-sm focus:border-primary flex-1 min-w-0"
           name="q" placeholder="{{ __('content.t_b760db0d88b6') }}" value="{{ request('q') }}" type="text">
    <label class="sr-only" for="product-status">{{ __('ui.status') }}</label>
    <select id="product-status" name="status" class="h-11 px-3 bg-surface-container-lowest border border-outline font-body-sm text-body-sm focus:border-primary">
        <option value="">{{ __('content.t_6405179d241b') }}</option>
        <option value="active" @selected(request('status') === 'active')>{{ __('ui.live') }}</option>
        <option value="hidden" @selected(request('status') === 'hidden')>{{ __('ui.hidden') }}</option>
    </select>
    <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase px-5 h-11 hover:bg-secondary transition-colors" type="submit">{{ __('ui.filter') }}</button>
    @if (request()->filled('q') || request()->filled('status'))
        <a class="h-11 px-4 inline-flex items-center border border-outline-variant font-label-caps text-label-caps uppercase text-primary hover:border-primary transition-colors" href="{{ route('admin.products') }}">{{ __('ui.clear') }}</a>
    @endif
</form>

<div class="bg-surface-container-lowest border border-outline-variant overflow-x-auto">
    <table class="w-full text-left font-body-sm text-body-sm min-w-[820px]">
        <thead class="bg-surface-container text-on-surface-variant font-label-caps text-label-caps uppercase">
            <tr>
                <th class="px-4 py-3">{{ __('ui.image') }}</th>
                <th class="px-4 py-3">{{ __('ui.product') }}</th>
                <th class="px-4 py-3">{{ __('ui.brand') }}</th>
                <th class="px-4 py-3">{{ __('ui.price') }}</th>
                <th class="px-4 py-3">{{ __('ui.stock') }}</th>
                <th class="px-4 py-3">{{ __('ui.status') }}</th>
                <th class="px-4 py-3 text-right">{{ __('ui.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr class="border-t border-outline-variant hover:bg-surface-container-low/60">
                    <td class="px-4 py-2">
                        <img alt="" class="w-12 h-12 object-contain bg-surface-container-low" src="{{ media_url($product->first_image) }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';">
                    </td>
                    <td class="px-4 py-3">
                        <span class="block font-semibold text-primary max-w-xs truncate">{{ $product->name }}</span>
                        @if ($product->sku)
                            <span class="block text-[12px] text-outline">SKU: {{ $product->sku }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $product->brand?->name ?? '—' }}</td>
                    <td class="px-4 py-3 font-bold whitespace-nowrap">AED {{ number_format($product->price, 2) }}</td>
                    <td class="px-4 py-3 {{ $product->stock <= 0 ? 'text-secondary font-bold' : '' }}">{{ $product->stock }}</td>
                    <td class="px-4 py-3">
                        <span class="font-label-tag text-label-tag uppercase px-2 py-0.5 font-bold {{ $product->is_active ? 'bg-[#1b6b45] text-white' : 'bg-surface-container-high text-on-surface' }}">
                            {{ $product->is_active ? 'Live' : 'Hidden' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-3">
                            <a class="underline hover:text-secondary" href="{{ route('admin.products.edit', $product) }}">{{ __('ui.edit') }}</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete {{ addslashes($product->name) }}? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button class="underline text-error hover:no-underline" type="submit">{{ __('ui.delete') }}</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-16 text-center">
                        <span class="material-symbols-outlined text-[40px] text-outline-variant">inventory_2</span>
                        <p class="font-body-md text-body-md text-primary mt-2">{{ __('ui.no_products_search') }}</p>
                        <a class="inline-block mt-3 underline text-primary hover:text-secondary" href="{{ route('admin.products') }}">{{ __('ui.clear_filters') }}</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('admin.partials.pagination', ['paginator' => $products])
@endsection
