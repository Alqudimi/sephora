@extends('layouts.app')

@section('title', 'Country & Language | SEPHORA UAE')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@php
    $languages = [
        'en' => ['label' => 'English', 'native' => 'English', 'note' => 'Default storefront language'],
        'ar' => ['label' => 'Arabic', 'native' => 'العربية', 'note' => 'Arabic storefront content is rolling out'],
        'fr' => ['label' => 'French', 'native' => 'Français', 'note' => 'French storefront content is rolling out'],
    ];
    $current = old('preferred_language', $user->preferred_language ?: 'en');
@endphp

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">Home</a> /
        <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">My Account</a> /
        <a class="hover:text-secondary" href="{{ route('account.settings') }}">Settings</a> /
        <span class="text-on-surface font-semibold">Country &amp; Language</span>
    </nav>

    <div class="flex flex-wrap items-center gap-2 pb-6 border-b border-outline-variant mb-8">
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.dashboard') }}">My Account</a>
        <a class="h-11 px-5 flex items-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider border border-primary" href="{{ route('account.settings') }}" aria-current="page">Settings</a>
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.country-language') }}">Country &amp; Language</a>
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.contact') }}">Contact Us</a>
    </div>

    <div class="mb-8 max-w-3xl">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Country &amp; language</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Choose the language you prefer for your account and storefront experience.</p>
    </div>

    @if (session('language_saved'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">Your language preference has been saved.</div>
    @endif

    @if ($errors->any())
        <div class="border border-secondary bg-surface-container-lowest px-4 py-3 mb-6" role="alert">
            <p class="font-label-caps text-label-caps uppercase tracking-wider text-secondary font-bold mb-1">Please check your selection</p>
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
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-1">Storefront language</h2>
            <p class="font-body-sm text-body-sm text-outline mb-4">Your selection is stored on your account and applied to future visits.</p>

            <fieldset class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <legend class="sr-only">Preferred language</legend>
                @foreach ($languages as $value => $language)
                    <label class="border px-4 py-4 cursor-pointer transition-colors {{ $current === $value ? 'border-primary bg-surface-container-low' : 'border-outline-variant hover:border-primary' }}">
                        <span class="flex items-center justify-between gap-2">
                            <span class="font-title-md text-title-md text-primary">{{ $language['label'] }}</span>
                            <input type="radio" name="preferred_language" value="{{ $value }}" @checked($current === $value)
                                   class="h-4 w-4 border-outline text-primary focus:ring-primary">
                        </span>
                        <span class="block font-body-sm text-body-sm text-on-surface-variant mt-1">{{ $language['native'] }}</span>
                        <span class="block font-body-sm text-[12px] text-outline mt-1">{{ $language['note'] }}</span>
                    </label>
                @endforeach
            </fieldset>
            @error('preferred_language')<span class="block font-body-sm text-body-sm text-secondary mt-3">{{ $message }}</span>@enderror
        </section>

        <section class="border border-outline-variant bg-surface-container-low p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">Country &amp; currency</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4 font-body-sm text-body-sm">
                <div>
                    <dt class="text-outline uppercase text-[12px]">Country</dt>
                    <dd class="font-title-md text-title-md text-primary mt-1">United Arab Emirates</dd>
                </div>
                <div>
                    <dt class="text-outline uppercase text-[12px]">Currency</dt>
                    <dd class="font-title-md text-title-md text-primary mt-1">{{ config('commerce.currency', 'AED') }}</dd>
                </div>
                <div>
                    <dt class="text-outline uppercase text-[12px]">Prices include</dt>
                    <dd class="font-title-md text-title-md text-primary mt-1">5% VAT</dd>
                </div>
            </dl>
            <p class="font-body-sm text-body-sm text-outline mt-4">To shop in another country, use the region selector in the site header.</p>
        </section>

        <div class="flex flex-wrap gap-3">
            <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-8 h-12 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">Save language</button>
            <a class="border border-outline px-8 h-12 inline-flex items-center font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-colors" href="{{ route('account.settings') }}">Back to settings</a>
        </div>
    </form>
</main>
@endsection
