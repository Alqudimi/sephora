@extends('layouts.app')

@section('title', __('meta.account_security'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">{{ __('ui.home') }}</a> /
        <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">{{ __('ui.my_account') }}</a> /
        <span class="text-on-surface font-semibold">{{ __('ui.security') }}</span>
    </nav>

    @include('partials.account-nav', ['active' => 'security'])

    <div class="mb-8 max-w-3xl">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ __('content.t_0afc739d8f3d') }}</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">{{ __('content.t_cc2098ff250c') }}</p>
    </div>

    @if (session('two_factor_required'))
        <div class="border border-secondary bg-[#fff5f5] text-secondary px-4 py-3 mb-6 font-body-sm text-body-sm" role="alert">
            {{ __('content.t_74b9d41ffd89') }}
        </div>
    @endif

    @if (session('two_factor_disabled'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">
            {{ __('content.t_e1117ea786a4') }}
        </div>
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

    @if (! empty($recoveryCodes))
        <section class="border border-secondary bg-surface-container-lowest p-5 md:p-6 mb-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-bold mb-2">{{ __('content.t_6001f0a06476') }}</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
                {{ __('content.t_dc1054896fb1') }}
            </p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                @foreach ($recoveryCodes as $recoveryCode)
                    <code class="block border border-outline-variant bg-surface-container-low px-3 py-2 font-mono text-[13px] text-on-surface text-center">{{ $recoveryCode }}</code>
                @endforeach
            </div>
        </section>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <section class="lg:col-span-2 space-y-6">
            @if ($user->hasTwoFactorEnabled())
                <div class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">{{ __('content.t_2a0b5e8fabe4') }}</h2>
                        <span class="inline-flex items-center px-2.5 py-1 bg-[#eef7f1] text-[#1b6b45] font-label-caps text-[11px] uppercase tracking-wider border border-[#1b6b45]">{{ __('ui.enabled') }}</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                        {{ __('content.t_cb29f19ab7fa') }}
                        <strong class="text-on-surface">{{ count($user->two_factor_recovery_codes ?? []) }}</strong> {{ __('content.t_eeea3ba23b41') }}
                    </p>

                    @if ($user->isStaff())
                        <p class="font-body-sm text-body-sm text-outline mt-4 border-t border-outline-variant pt-4">
                            {{ __('content.t_972c8a95a0db') }}
                        </p>
                    @else
                        <form method="POST" action="{{ route('account.security.disable') }}" class="mt-5 border-t border-outline-variant pt-5 space-y-3">
                            @csrf
                            <label class="block" for="disable-password">
                                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold mb-1.5">{{ __('content.t_0922127bdfc3') }}</span>
                                <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                                       id="disable-password" name="password" type="password" autocomplete="current-password" required>
                            </label>
                            <button class="h-11 px-6 border border-secondary text-secondary font-label-caps text-label-caps uppercase tracking-wider hover:bg-secondary hover:text-on-primary transition-colors" type="submit">
                                {{ __('content.t_9f89b4caf818') }}
                            </button>
                        </form>
                    @endif
                </div>
            @elseif ($user->two_factor_secret)
                <div class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                    <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">{{ __('content.t_de33c2719d24') }}</h2>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
                        {{ __('content.t_d3b78cc3c30b') }}
                    </p>

                    <div class="border border-outline-variant bg-surface-container-low px-4 py-3 mb-4">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold mb-1">{{ __('content.t_7ae4d13ffbf8') }}</span>
                        <code class="block font-mono text-[15px] text-on-surface break-all">{{ $user->two_factor_secret }}</code>
                    </div>

                    <p class="font-body-sm text-body-sm text-outline mb-5 break-all">
                        Account: {{ $user->email }} &middot; Type: time-based (TOTP) &middot; Period: 30 seconds &middot; Digits: 6
                    </p>

                    <form method="POST" action="{{ route('account.security.confirm') }}" class="space-y-4">
                        @csrf

                        <label class="block" for="confirm-code">
                            <span class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2">{{ __('content.t_52e07d3b3586') }}</span>
                            <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md tracking-[0.4em] focus:border-primary focus:outline-none"
                                   id="confirm-code" name="code" type="text" inputmode="numeric" autocomplete="one-time-code"
                                   pattern="[0-9]{6}" maxlength="6" placeholder="000000" required>
                        </label>

                        <button class="h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">
                            {{ __('content.t_89677dee33fa') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                    <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">{{ __('content.t_b50cbb6a1de4') }}</h2>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-5">
                        {{ __('content.t_09daa9d87329') }}
                    </p>

                    <form method="POST" action="{{ route('account.security.enable') }}">
                        @csrf
                        <button class="h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">
                            {{ __('content.t_c8716ce56782') }}
                        </button>
                    </form>
                </div>
            @endif
        </section>

        <aside class="space-y-4">
            <section class="border border-outline-variant bg-surface-container-low p-5 font-body-sm text-body-sm">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">{{ __('content.t_76ff2a4c8e80') }}</h2>
                <p class="text-on-surface-variant">{{ __('content.t_2079fc53d55a') }}</p>
            </section>

            @if ($user->isStaff())
                <section class="border border-outline-variant bg-surface-container-lowest p-5 font-body-sm text-body-sm">
                    <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">{{ __('content.t_5fd874e9add1') }}</h2>
                    <p class="text-on-surface-variant">{{ __('content.t_a02f04193541') }}</p>
                </section>
            @endif
        </aside>
    </div>
</main>
@endsection
