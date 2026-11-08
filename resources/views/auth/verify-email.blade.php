@extends('layouts.app')

@section('title', 'Verify Your Email | SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">
    <div class="max-w-xl mx-auto border border-outline-variant bg-surface-container-lowest p-6 md:p-8">
        <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-outline mb-6">
            <a class="hover:text-secondary" href="/">Home</a> /
            <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">My Account</a> /
            <span class="text-on-surface font-semibold">Verify email</span>
        </nav>

        <span class="material-symbols-outlined text-[36px] text-primary">mark_email_unread</span>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase mt-3">Verify your email</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">
            We sent a verification link to <strong class="text-primary">{{ auth()->user()->email }}</strong>.
            Open the link in that email to confirm the address.

            If you did not receive it, check your spam folder or send a new link below.
        </p>

        @if (session('verification_sent'))
            <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mt-5 font-body-sm text-body-sm" role="status">
                A new verification link has been sent. It may take a minute to arrive.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="mt-6 flex flex-wrap items-center gap-3">
            @csrf
            <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-8 h-12 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">
                Resend verification email
            </button>
            <a class="border border-outline px-8 h-12 inline-flex items-center font-label-caps text-label-caps uppercase tracking-widest hover:border-primary transition-colors" href="{{ route('account.dashboard') }}">
                Back to account
            </a>
        </form>

        <p class="font-body-sm text-body-sm text-outline mt-6">
            Wrong address? <a class="text-primary underline hover:text-secondary" href="{{ route('account.settings') }}">Update it in your settings</a>.
        </p>
    </div>
</main>
@endsection
