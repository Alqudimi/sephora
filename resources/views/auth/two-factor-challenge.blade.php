@extends('layouts.app')

@section('title', __('messages.auth.two_step_verification') . ' | ' . __('messages.app_name'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="w-full max-w-[720px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-caps text-label-caps text-outline uppercase tracking-wider mb-8">
        <a class="hover:text-primary transition-colors" href="/">{{ __('messages.home') }}</a>
        <span>/</span>
        <span class="text-primary font-bold">{{ __('messages.auth.two_step_verification') }}</span>
    </nav>

    <section class="bg-surface-container-lowest border border-primary p-8 md:p-12">
        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest font-bold block mb-2">{{ __('messages.account.security') }}</span>
        <h1 class="font-headline-md text-headline-md font-serif text-primary mb-3">{{ __('messages.auth.two_factor_enter_code') }}</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mb-6">
            {{ __('messages.auth.two_factor_instructions') }}
        </p>

        @if ($errors->any())
            <div class="border border-secondary bg-surface-container-low px-4 py-3 mb-6" role="alert">
                <ul class="list-disc list-inside font-body-sm text-body-sm text-secondary space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('two-factor.challenge.store') }}" class="space-y-5">
            @csrf

            <label class="block" for="two-factor-code">
                <span class="block font-label-caps text-label-caps uppercase text-on-surface tracking-wider mb-2">{{ __('messages.auth.two_factor_enter_code') }}</span>
                <input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md tracking-[0.4em] focus:border-primary focus:ring-0 rounded-none transition-all"
                       id="two-factor-code" name="code" type="text" inputmode="numeric" autocomplete="one-time-code"
                       pattern="[0-9]{6}" maxlength="6" placeholder="000000" autofocus>
            </label>

            <button class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps tracking-[0.16em] uppercase hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary border border-transparent transition-all duration-200" type="submit">
                {{ __('messages.auth.verify_continue') }}
            </button>
        </form>

        <details class="mt-8 border-t border-outline-variant pt-5">
            <summary class="cursor-pointer font-label-caps text-label-caps uppercase tracking-wider text-primary">{{ __('messages.auth.use_recovery_instead') }}</summary>

            <form method="POST" action="{{ route('two-factor.challenge.store') }}" class="space-y-4 mt-4">
                @csrf

                <label class="block" for="two-factor-recovery">
                    <span class="block font-body-sm text-body-sm text-on-surface-variant mb-2">{{ __('messages.auth.use_recovery_desc') }}</span>
                    <input class="w-full h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md uppercase tracking-widest focus:border-primary focus:ring-0 rounded-none transition-all"
                           id="two-factor-recovery" name="recovery_code" type="text" autocomplete="off" maxlength="9" placeholder="XXXX-XXXX">
                </label>

                <button class="h-11 px-6 border border-primary text-primary font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary hover:text-on-primary transition-colors" type="submit">
                    {{ __('messages.auth.use_recovery_btn') }}
                </button>
            </form>
        </details>

        <p class="font-body-sm text-body-sm text-outline mt-8">
            <a class="underline hover:text-primary" href="{{ route('login') }}">{{ __('messages.auth.back_to_sign_in') }}</a>
        </p>
    </section>
</main>
@endsection
