@extends('admin.layout')

@php
    $isEdit = $category->exists;
@endphp

@section('title', $isEdit ? 'Edit Category' : 'New Category')

@section('content')
<div class="max-w-3xl">
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">
            {{ $isEdit ? 'Edit: ' . $category->name : 'Add New Category' }}
        </h1>
        <a class="border border-outline px-5 h-11 inline-flex items-center font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-colors" href="{{ route('admin.categories') }}">
            Back to categories
        </a>
    </div>

    @if ($errors->any())
        <div class="border border-secondary bg-surface-container-lowest p-4 mb-6" role="alert">
            <p class="font-label-caps text-label-caps uppercase tracking-wider text-secondary font-bold mb-2">{{ __('ui.fix_following') }}</p>
            <ul class="list-disc list-inside font-body-sm text-body-sm text-secondary space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
          class="space-y-6">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <section class="bg-surface-container-lowest border border-outline-variant p-5 md:p-6 space-y-4">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">Basics</h2>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Name *</span>
                <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                       name="name" maxlength="190" type="text" value="{{ old('name', $category->name) }}" required>
                @error('name')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Slug</span>
                <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                       name="slug" maxlength="190" type="text" value="{{ old('slug', $category->slug) }}" placeholder="auto-generated from name">
                <span class="block font-body-sm text-[12px] text-outline">Leave blank to generate automatically.</span>
                @error('slug')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Parent category</span>
                <select class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none" name="parent_id">
                    <option value="">— None —</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}" @selected((int) old('parent_id', $category->parent_id) === $parent->id)>{{ $parent->name }}</option>
                    @endforeach
                </select>
                @error('parent_id')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Hero title</span>
                <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                       name="hero_title" maxlength="190" type="text" value="{{ old('hero_title', $category->hero_title) }}">
                @error('hero_title')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Hero subtitle</span>
                <textarea class="w-full px-4 py-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none min-h-24"
                          name="hero_subtitle" maxlength="1000">{{ old('hero_subtitle', $category->hero_subtitle) }}</textarea>
                @error('hero_subtitle')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Hero image path (public disk)</span>
                <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                       name="hero_image" maxlength="500" type="text" value="{{ old('hero_image', $category->hero_image) }}" placeholder="images/categories/hero.webp">
                @error('hero_image')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Description</span>
                <textarea class="w-full px-4 py-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none min-h-28"
                          name="description" maxlength="5000">{{ old('description', $category->description) }}</textarea>
                @error('description')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>
        </section>

        <section class="bg-surface-container-lowest border border-outline-variant p-5 md:p-6 space-y-4">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">Display</h2>

            <label class="flex items-center gap-3 font-body-md text-body-md text-primary">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))>
                <span>Live (visible in storefront)</span>
            </label>

            <label class="flex items-center gap-3 font-body-md text-body-md text-primary">
                <input type="checkbox" name="show_in_nav" value="1" @checked(old('show_in_nav', $category->show_in_nav))>
                <span>Show in navigation</span>
            </label>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Sort order</span>
                <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                       name="sort_order" type="number" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
                @error('sort_order')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>
        </section>

        <div class="flex items-center gap-3">
            <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-6 h-11 hover:bg-secondary transition-colors" type="submit">
                {{ $isEdit ? 'Save changes' : 'Create category' }}
            </button>
            <a class="border border-outline px-6 h-11 inline-flex items-center font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-colors" href="{{ route('admin.categories') }}">{{ __('ui.cancel') }}</a>
        </div>
    </form>
</div>
@endsection