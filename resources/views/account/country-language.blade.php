@extends('layouts.app')

@section('title', __('messages.nav.country_language') . ' | ' . __('messages.app_name'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@php
    $languages = [
        'en' => ['label' => 'English', 'native' => 'English', 'note' => 'Default storefront language'],
        'ar' => ['label' => 'العربية', 'native' => 'العربية', 'note' => 'واجهة المتجر بالكامل باللغة العربية مع دعم RTL'],
        'fr' => ['label' => 'Français', 'native' => 'Français', 'note' => 'French storefront content is rolling out'],
    ];
    $current = old('preferred_language', $user->preferred_language ?: 'en');
@endphp

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">{{ __('messages.home') }}</a> /
        <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">{{ __('messages.account.my_account') }}</a> /
        <a class="hover:text-secondary" href="{{ route('account.settings') }}">{{ __('messages.account.settings') }}</a> /
        <span class="text-on-surface font-semibold">{{ __('messages.nav.country_language') }}</span>
    </nav>

    @include('partials.account-nav', ['active' => 'country-language'])

    <div class="mb-8 max-w-3xl">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ __('messages.nav.country_language') }}</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">{{ __('messages.account.language_preference_desc') }}</p>
    </div>

    @if (session('language_saved'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">{{ __('messages.account.language_saved') }}</div>
    @endif

    @if ($errors->any())
        <div class="border border-secondary bg-surface-container-lowest px-4 py-3 mb-6" role="alert">
            <p class="font-label-caps text-label-caps uppercase tracking-wider text-secondary font-bold mb-1">{{ __('messages.errors.validation_failed') }}</p>
            <ul class="list-disc list-inside font-body-sm text-body-sm text-secondary space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('account.country-language.update') }}" class="max-w-4xl space-y-6">
        @csrf

        <section class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-1">{{ __('messages.account.language_preference') }}</h2>
            <p class="font-body-sm text-body-sm text-outline mb-4">{{ __('messages.account.language_preference_desc') }}</p>

            <fieldset class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <legend class="sr-only">{{ __('messages.account.language_preference') }}</legend>
                @foreach ($languages as $value => $language)
                    <label class="border px-4 py-4 cursor-pointer transition-colors {{ $current === $value ? 'border-primary bg-surface-container-low' : 'border-outline-variant hover:border-primary' }}">
                        <span class="flex items-center justify-between gap-2">
                            <span class="font-title-md text-title-md text-primary">{{ $language['label'] }}</span>
                            <input type="radio" name="preferred_language" value="{{ $value }}" @checked($current === $value) class="text-primary focus:ring-0">
                        </span>
                        <span class="block font-label-tag text-label-tag uppercase tracking-wider text-outline mt-1">{{ $language['native'] }}</span>
                        <span class="block font-body-sm text-body-sm text-on-surface-variant mt-2">{{ $language['note'] }}</span>
                    </label>
                @endforeach
            </fieldset>
        </section>

        <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 h-12 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" type="submit">
            {{ __('messages.account.save_changes') }}
        </button>
    </form>
</main>
@endsection
