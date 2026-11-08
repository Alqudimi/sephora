@extends('layouts.app')

@section('title', 'Account Security | SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">Home</a> /
        <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">My Account</a> /
        <span class="text-on-surface font-semibold">Security</span>
    </nav>

    @include('partials.account-nav', ['active' => 'security'])

    <div class="mb-8 max-w-3xl">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Account security</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Protect your account with a time-based one-time code from an authenticator app.</p>
    </div>

    @if (session('two_factor_required'))
        <div class="border border-secondary bg-[#fff5f5] text-secondary px-4 py-3 mb-6 font-body-sm text-body-sm" role="alert">
            Two-step verification is required before you can open the admin panel.
        </div>
    @endif

    @if (session('two_factor_disabled'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">
            Two-step verification has been disabled for your account.
        </div>
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

    @if (! empty($recoveryCodes))
        <section class="border border-secondary bg-surface-container-lowest p-5 md:p-6 mb-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-bold mb-2">Save your recovery codes</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
                Each code works once if you lose access to your authenticator app. Store them somewhere safe — they will not be shown again.
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
                        <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold">Two-step verification</h2>
                        <span class="inline-flex items-center px-2.5 py-1 bg-[#eef7f1] text-[#1b6b45] font-label-caps text-[11px] uppercase tracking-wider border border-[#1b6b45]">Enabled</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                        You will be asked for a six-digit code whenever you sign in.
                        <strong class="text-on-surface">{{ count($user->two_factor_recovery_codes ?? []) }}</strong> unused recovery codes remain.
                    </p>

                    @if ($user->isStaff())
                        <p class="font-body-sm text-body-sm text-outline mt-4 border-t border-outline-variant pt-4">
                            Two-step verification is mandatory for staff accounts and cannot be disabled here.
                        </p>
                    @else
                        <form method="POST" action="{{ route('account.security.disable') }}" class="mt-5 border-t border-outline-variant pt-5 space-y-3">
                            @csrf
                            <label class="block" for="disable-password">
                                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold mb-1.5">Confirm your password to disable</span>
                                <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none"
                                       id="disable-password" name="password" type="password" autocomplete="current-password" required>
                            </label>
                            <button class="h-11 px-6 border border-secondary text-secondary font-label-caps text-label-caps uppercase tracking-wider hover:bg-secondary hover:text-on-primary transition-colors" type="submit">
                                Disable two-step verification
                            </button>
                        </form>
                    @endif
                </div>
            @elseif ($user->two_factor_secret)
                <div class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                    <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">Finish setting up two-step verification</h2>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
                        Add this key to your authenticator app manually, then enter the six-digit code it shows.
                    </p>

                    <div class="border border-outline-variant bg-surface-container-low px-4 py-3 mb-4">
                        <span class="block font-label-caps text-label-caps uppercase text-outline font-bold mb-1">Setup key</span>
                        <code class="block font-mono text-[15px] text-on-surface break-all">{{ $user->two_factor_secret }}</code>
                    </div>

                    <p class="font-body-sm text-body-sm text-outline mb-5 break-all">
                        Account: {{ $user->email }} &middot; Type: time-based (TOTP) &middot; Period: 30 seconds &middot; Digits: 6
                    </p>

                    <form method="POST" action="{{ route('account.security.confirm') }}" class="space-y-4">
                        @csrf

                        <label class="block" for="confirm-code">
                            <span class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2">Six-digit code</span>
                            <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md tracking-[0.4em] focus:border-primary focus:outline-none"
                                   id="confirm-code" name="code" type="text" inputmode="numeric" autocomplete="one-time-code"
                                   pattern="[0-9]{6}" maxlength="6" placeholder="000000" required>
                        </label>

                        <button class="h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">
                            Verify and enable
                        </button>
                    </form>
                </div>
            @else
                <div class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                    <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">Two-step verification is off</h2>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-5">
                        Add a second step to sign-in with any TOTP authenticator app. After enabling, you will also receive eight one-time recovery codes.
                    </p>

                    <form method="POST" action="{{ route('account.security.enable') }}">
                        @csrf
                        <button class="h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">
                            Set up two-step verification
                        </button>
                    </form>
                </div>
            @endif
        </section>

        <aside class="space-y-4">
            <section class="border border-outline-variant bg-surface-container-low p-5 font-body-sm text-body-sm">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Why this matters</h2>
                <p class="text-on-surface-variant">A password alone can be reused or stolen. A one-time code keeps your orders, addresses and admin tools protected even if someone learns your password.</p>
            </section>

            @if ($user->isStaff())
                <section class="border border-outline-variant bg-surface-container-lowest p-5 font-body-sm text-body-sm">
                    <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">Staff requirement</h2>
                    <p class="text-on-surface-variant">All admin, manager and support accounts must enable two-step verification before entering the admin panel.</p>
                </section>
            @endif
        </aside>
    </div>
</main>
@endsection
