@extends('layouts.app')

@section('title', __('meta.account_settings'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@php
    $genders = [
        'female' => 'female',
        'male' => 'male',
        'other' => 'other',
        'prefer_not' => 'prefer_not',
    ];
@endphp

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="{{ __('ui.breadcrumb') }}" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">{{ __('ui.home') }}</a> /
        <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">{{ __('ui.my_account') }}</a> /
        <span class="text-on-surface font-semibold">{{ __('ui.settings') }}</span>
    </nav>

    @include('partials.account-nav', ['active' => 'settings'])

    <div class="mb-8 max-w-3xl">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ __('ui.settings') }}</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">{{ __('content.t_d2110dac15d4') }}</p>
    </div>

    @if (session('settings_saved'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">{{ __('content.t_9ae18f367a83') }}</div>
    @endif

    @if ($errors->any())
        <div class="border border-secondary bg-surface-container-lowest px-4 py-3 mb-6" role="alert">
            <p class="font-label-caps text-label-caps uppercase tracking-wider text-secondary font-bold mb-1">{{ __('ui.fix_following') }}</p>
            <ul class="list-disc list-inside font-body-sm text-body-sm text-secondary space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('account.settings.update') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-{{ __('ui.items_count_label', ['count' => '6']) }}-start">
        @csrf

        <div class="lg:col-span-2 space-y-6">
            {{-- Profile --}}
            <section class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-4">{{ __('content.t_b1b9e593871d') }}</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="space-y-1.5 sm:col-span-2">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('content.t_ca27b75468f7') }}</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('name') border-secondary @enderror"
                               name="name" required maxlength="120" type="text" value="{{ old('name', $user->name) }}">
                        @error('name')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('ui.email_required') }}</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('email') border-secondary @enderror"
                               name="email" required maxlength="190" type="email" value="{{ old('email', $user->email) }}">
                        @error('email')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                        @if (! $user->hasVerifiedEmail())
                            <span class="block font-body-sm text-[12px] text-secondary">{{ __('content.t_539e425b62cb') }}</span>
                        @endif
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('content.t_e59c8a1b8866') }}</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('phone') border-secondary @enderror"
                               name="phone" maxlength="40" type="tel" placeholder="+971 50 000 0000" value="{{ old('phone', $user->phone) }}">
                        @error('phone')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('content.t_9518425f4174') }}</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('date_of_birth') border-secondary @enderror"
                               name="date_of_birth" type="date" max="{{ now()->subDay()->toDateString() }}"
                               value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}">
                        @error('date_of_birth')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('ui.gender') }}</span>
                        <select class="w-full h-12 px-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none" name="gender">
                            <option value="">{{ __('content.t_0e4b2056bcb8') }}</option>
                            @foreach ($genders as $value => $label)
                                <option value="{{ $value }}" @selected(old('gender', $user->gender) === $value)>{{ __('ui.' . $label) }}</option>
                            @endforeach
                        </select>
                        @error('gender')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5 sm:col-span-2">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('content.t_4261236b260d') }}</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('preferred_store') border-secondary @enderror"
                               name="preferred_store" maxlength="120" type="text" placeholder="{{ __('content.t_55024355c0be') }}" value="{{ old('preferred_store', $user->preferred_store) }}">
                        @error('preferred_store')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>
                </div>
            </section>

            {{-- Password --}}
            <section class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-1">{{ __('content.t_8c684290ce0b') }}</h2>
                <p class="font-body-sm text-body-sm text-outline mb-4">{{ __('content.t_156e4751361c') }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="space-y-1.5 sm:col-span-2">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('content.t_19dff4dad0a7') }}</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('current_password') border-secondary @enderror"
                               name="current_password" type="password" autocomplete="current-password">
                        @error('current_password')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('content.t_d850ee188c7c') }}</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('new_password') border-secondary @enderror"
                               name="new_password" type="password" minlength="8" autocomplete="new-password">
                        @error('new_password')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                    </label>

                    <label class="space-y-1.5">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('content.t_f85039fd8e49') }}</span>
                        <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                               name="new_password_confirmation" type="password" minlength="8" autocomplete="new-password">
                    </label>
                </div>
            </section>

            {{-- Marketing --}}
            <section class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-1">{{ __('content.t_2561bda56d58') }}</h2>
                <p class="font-body-sm text-body-sm text-outline mb-4">{{ __('content.t_160bfc963fac') }}</p>

                <label class="flex items-start gap-3 cursor-pointer">
                    <input class="mt-1 w-4 h-4 rounded-none border border-outline text-primary focus:ring-0 focus:ring-offset-0 cursor-pointer checked:bg-primary checked:border-primary"
                           name="marketing_email" type="checkbox" value="1"
                           @checked(old('marketing_email', $user->marketing_preferences['email'] ?? false))>
                    <span class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_3a842a4264ac') }}</span>
                </label>
                @error('marketing_email')<span class="block font-body-sm text-body-sm text-secondary mt-1">{{ $message }}</span>@enderror
            </section>

            <div class="flex flex-wrap gap-3">
                <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-8 h-12 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">{{ __('content.t_179359b39edb') }}</button>
                <a class="border border-outline px-8 h-12 inline-flex items-center font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-colors" href="{{ route('account.dashboard') }}">{{ __('ui.cancel') }}</a>
            </div>
        </div>

        <aside class="space-y-4">
            <section class="border border-outline-variant bg-surface-container-low p-5 font-body-sm text-body-sm">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">{{ __('ui.account') }}</h2>
                <p class="text-on-surface-variant">Member since {{ $user->created_at?->format('F Y') }}</p>
                <p class="text-on-surface-variant mt-1">{{ __('content.t_95831d2220ef') }} <strong class="text-primary">{{ $user->loyalty_tier ? ucfirst($user->loyalty_tier) : 'Member' }}</strong></p>
                <p class="text-on-surface-variant mt-1">{{ number_format((int) $user->loyalty_points) }} loyalty points</p>
            </section>

            <a class="block border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.country-language') }}">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">{{ __('ui.country_language') }}</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Currently: {{ strtoupper($user->preferred_language ?: 'en') }}</p>
            </a>

            <a class="block border border-outline-variant bg-surface-container-lowest p-5 hover:border-primary transition-colors" href="{{ route('account.addresses') }}">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">{{ __('content.t_dfa849391290') }}</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ __('content.t_38df781b37c5') }}</p>
            </a>
        </aside>
    </form>
</main>
@endsection
