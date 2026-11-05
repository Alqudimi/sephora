@extends('admin.layout')

@section('title', 'Categories')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Categories</h1>
        <p class="font-body-sm text-body-sm text-outline mt-1">{{ number_format($categories->total()) }} categories</p>
    </div>
    <a class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-5 h-11 inline-flex items-center hover:bg-surface-container-lowest hover:text-primary border border-primary transition-all" href="{{ route('admin.categories.create') }}">
        + Add Category
    </a>
</div>

<div class="overflow-x-auto border border-outline-variant bg-surface-container-lowest">
    <table class="w-full text-left font-body-sm text-body-sm">
        <thead class="bg-surface-container-high text-primary font-label-caps text-label-caps uppercase tracking-wider">
            <tr>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Slug</th>
                <th class="px-4 py-3">Parent</th>
                <th class="px-4 py-3">Products</th>
                <th class="px-4 py-3">Nav</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant">
            @forelse ($categories as $category)
                <tr>
                    <td class="px-4 py-3 font-semibold text-primary">{{ $category->name }}</td>
                    <td class="px-4 py-3 text-outline">{{ $category->slug }}</td>
                    <td class="px-4 py-3">{{ $category->parent?->name ?? '—' }}</td>
                    <td class="px-4 py-3">{{ number_format($category->products_count) }}</td>
                    <td class="px-4 py-3">{{ $category->show_in_nav ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-3">
                        <span class="font-label-tag text-label-tag uppercase px-2 py-0.5 font-bold {{ $category->is_active ? 'bg-[#1b6b45] text-white' : 'bg-surface-container-high text-on-surface' }}">
                            {{ $category->is_active ? 'Live' : 'Hidden' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-3">
                            <a class="underline hover:text-secondary" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete {{ addslashes($category->name) }}? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button class="underline text-error hover:no-underline" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-16 text-center">
                        <span class="material-symbols-outlined text-[40px] text-outline-variant">category</span>
                        <p class="font-body-md text-body-md text-primary mt-2">No categories yet.</p>
                        <a class="inline-block mt-3 underline text-primary hover:text-secondary" href="{{ route('admin.categories.create') }}">Create the first category</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('admin.partials.pagination', ['paginator' => $categories])
@endsection