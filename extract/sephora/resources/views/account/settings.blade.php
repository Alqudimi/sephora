@extends('layouts.app')

@section('title', 'Account Settings | SEPHORA UAE')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')

@php
    $genders = [
        'female' => 'Female',
        'male' => 'Male',
        'other' => 'Other',
        'prefer_not' => 'Prefer not to say',
    ];
@endphp

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">Home</a> /
        <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">My Account</a> /
        <span class="text-on-surface font-semibold">Settings</span>
    </nav>

    <div class="flex flex-wrap items-center gap-2 pb-6 border-b border-outline-variant mb-8">
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.dashboard') }}">My Account</a>
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.orders') }}">Orders</a>
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.addresses') }}">Addresses</a>
        <a class="h-11 px-5 flex items-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider border border-primary" href="{{ route('account.settings') }}" aria-current="page">Settings</a>
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.country-language') }}">Country &amp; Language</a>
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.privacy') }}">Privacy</a>
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.security') }}">Security</a>
        <a class="h-11 px-5 flex items-center bg-surface-container-lowest text-on-surface font-label-caps text-label-caps uppercase tracking-wider border border-outline-variant hover:border-primary transition-colors" href="{{ route('account.contact') }}">Contact Us</a>
    </div>

    <div class="mb-8 max-w-3xl">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Settings</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Manage your personal information and sign-in password.</p>
    </div>

    @if (session('settings_saved'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">Your settings have been saved.</div>
    @endif

    @if ($errors->any())
        <div class="border border-secondary bg-surface-container-lowest px-4 py-3 mb-6" role="alert">
            <p class="font-label-caps text-label-caps uppercase tracking-wider text-secondary font-bold mb-1">Please fix the following</p>
            <ul class="list-disc list-inside font-body-sm text-body-sm text-secondary space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('account.settings.update') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        @csrf

        <div class="lg:col-span-2 space-y-6">
            {{-- Profile --}}
            <section class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-4">Personal information</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="space-y-1.5 sm:col-span-2">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Full name *</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('name') border-secondary @enderror"
                               name="name" required maxlength="120" type="text" value="{{ old('name', $user->name) }}">
                        @error('name')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Email *</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('email') border-secondary @enderror"
                               name="email" required maxlength="190" type="email" value="{{ old('email', $user->email) }}">
                        @error('email')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                        @if (! $user->hasVerifiedEmail())
                            <span class="block font-body-sm text-[12px] text-secondary">This address is not verified yet.</span>
                        @endif
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Mobile phone</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('phone') border-secondary @enderror"
                               name="phone" maxlength="40" type="tel" placeholder="+971 50 000 0000" value="{{ old('phone', $user->phone) }}">
                        @error('phone')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Date of birth</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('date_of_birth') border-secondary @enderror"
                               name="date_of_birth" type="date" max="{{ now()->subDay()->toDateString() }}"
                               value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}">
                        @error('date_of_birth')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Gender</span>
                        <select class="w-full h-12 px-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none" name="gender">
                            <option value="">Prefer not to say</option>
                            @foreach ($genders as $value => $label)
                                <option value="{{ $value }}" @selected(old('gender', $user->gender) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('gender')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5 sm:col-span-2">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Preferred store</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('preferred_store') border-secondary @enderror"
                               name="preferred_store" maxlength="120" type="text" placeholder="e.g. Dubai Mall" value="{{ old('preferred_store', $user->preferred_store) }}">
                        @error('preferred_store')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>
                </div>
            </section>

            {{-- Password --}}
            <section class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-1">Change password</h2>
                <p class="font-body-sm text-body-sm text-outline mb-4">Leave these fields empty to keep your current password.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="space-y-1.5 sm:col-span-2">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Current password</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('current_password') border-secondary @enderror"
                               name="current_password" type="password" autocomplete="current-password">
                        @error('current_password')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">New password</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('new_password') border-secondary @enderror"
                               name="new_password" type="password" minlength="8" autocomplete="new-password">
                        @error('new_password')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Confirm new password</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                               name="new_password_confirmation" type="password" minlength="8" autocomplete="new-password">
                    </label>
                </div>
            </section>

            {{-- Marketing --}}
            <section class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-1">Marketing preferences</h2>
                <p class="font-body-sm text-body-sm text-outline mb-4">Choose whether we may email you about new products, offers and events. You can change this at any time.</p>

                <label class="flex items-start gap-3 cursor-pointer">
                    <input class="mt-1 w-4 h-4 rounded-none border border-outline text-primary focus:ring-0 focus:ring-offset-0 cursor-pointer checked:bg-primary checked:border-primary"
                           name="marketing_email" type="checkbox" value="1"
                           @checked(old('marketing_email', $user->marketing_preferences['email'] ?? false))>
                    <span class="font-body-sm text-body-sm text-on-surface-variant">Email me about new arrivals, offers, and Beauty Pass events.</span>
                </label>
                @error('marketing_email')<span class="block font-body-sm text-body-sm text-secondary mt-1">{{ $message }}</span>@enderror
            </section>

            <div class="flex flex-wrap gap-3">
                <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-8 h-12 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">Save changes</button>
                <a class="border border-outline px-8 h-12 inline-flex items-center font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-colors" href="{{ route('account.dashboard') }}">Cancel</a>
            </div>
        </div>

        <aside class="space-y-4">
            <section class="border border-outline-variant bg-surface-container-low p-5 font-body-sm text-body-sm">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Account</h2>
                <p class="text-on-surface-variant">Member since {{ $user->created_at?->format('F Y') }}</p>
                <p class="text-on-surface-variant mt-1">MY SEPHORA tier: <strong class="text-primary">{{ $user->loyalty_tier ? ucfirst($user->loyalty_tier) : 'Member' }}</strong></p>
                <p class="text-on-surface-variant mt-1">{{ number_format((int) $user->loyalty_points) }} loyalty points</p>
            </section>

            <a class="block border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.country-language') }}">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">Country &amp; language</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Currently: {{ strtoupper($user->preferred_language ?: 'en') }}</p>
            </a>

            <a class="block border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.addresses') }}">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">Saved addresses</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Manage delivery addresses used at checkout.</p>
            </a>
        </aside>
    </form>
</main>
@endsection
