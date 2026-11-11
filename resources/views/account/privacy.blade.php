@extends('layouts.app')

@section('title', __('meta.privacy'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">{{ __('ui.home') }}</a> /
        <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">{{ __('ui.my_account') }}</a> /
        <span class="text-on-surface font-semibold">{{ __('ui.privacy') }}</span>
    </nav>

    @include('partials.account-nav', ['active' => 'privacy'])

    <div class="mb-8 max-w-3xl">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ __('content.t_fc6feac41dd0') }}</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">
            Under the UAE Personal Data Protection Law (Federal Decree-Law No. 45 of 2021) you can
            request a copy of your data, review your consent history, and ask us to erase your
            personal information.
        </p>
    </div>

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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <div class="lg:col-span-2 space-y-6">
            {{-- Data export --}}
            <section class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">{{ __('content.t_af53dade8377') }}</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
                    Receive a JSON file containing your profile, addresses, orders, wishlist,
                    reviews and consent history. The file is generated on demand and is not
                    stored on our servers.
                </p>
                <a class="inline-flex h-11 px-5 items-center bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-wider border border-primary hover:bg-secondary hover:border-secondary transition-colors"
                   href="{{ route('account.privacy.export') }}">
                    {{ __('content.t_85176ce073aa') }}
                </a>
            </section>

            {{-- Consent history --}}
            <section class="border border-outline-variant bg-surface-container-lowest p-5 md:p-6">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-2">{{ __('content.t_9f998ba2b5f8') }}</h2>

                @if ($consents->isEmpty())
                    <p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('content.t_e857aa579880') }}</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left font-body-sm text-body-sm">
                            <thead class="border-b border-outline-variant text-outline font-label-caps text-label-caps uppercase">
                                <tr>
                                    <th class="py-2 pr-3">Type</th>
                                    <th class="py-2 pr-3">Version</th>
                                    <th class="py-2 pr-3">{{ __('ui.status') }}</th>
                                    <th class="py-2">{{ __('content.t_6fdd2d93260b') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consents as $consent)
                                    <tr class="border-b border-outline-variant last:border-0">
                                        <td class="py-2 pr-3">{{ ucfirst(str_replace('_', ' ', $consent->type)) }}</td>
                                        <td class="py-2 pr-3">{{ $consent->version }}</td>
                                        <td class="py-2 pr-3">{{ $consent->accepted ? 'Accepted' : 'Withdrawn' }}</td>
                                        <td class="py-2">{{ $consent->accepted_at?->format('d M Y, H:i') ?? '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <p class="font-body-sm text-body-sm text-on-surface-variant mt-4">
                    {{ __('content.t_0754dbeb570b') }}
                    <a class="underline hover:text-secondary" href="{{ route('account.settings') }}">{{ __('content.t_3e3dc940d4ad') }}</a>.
                </p>
            </section>
        </div>

        {{-- Erasure --}}
        <aside class="border border-secondary bg-surface-container-lowest p-5 md:p-6">
            <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-secondary font-bold mb-2">{{ __('content.t_2ae3a019040b') }}</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
                We remove your profile, addresses, wishlist and reviews, and replace the personal
                details on past orders with anonymised values. Order totals are kept for tax and
                accounting obligations. This action cannot be undone.
            </p>

            <form method="POST" action="{{ route('account.privacy.destroy') }}" class="space-y-4">
                @csrf
                @method('DELETE')

                <label class="block space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('content.t_1cd495617ad0') }}</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('password') border-secondary @enderror"
                           name="password" required autocomplete="current-password" type="password">
                    @error('password')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="flex items-start gap-2 font-body-sm text-body-sm text-on-surface-variant">
                    <input class="mt-1" name="confirm" value="1" required type="checkbox">
                    <span>{{ __('content.t_35007df9b75e') }}</span>
                </label>
                @error('confirm')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror

                <button class="w-full h-11 px-5 bg-secondary text-on-secondary font-label-caps text-label-caps uppercase tracking-wider border border-secondary hover:bg-primary hover:border-primary transition-colors"
                        type="submit">
                    {{ __('content.t_2ae3a019040b') }}
                </button>
            </form>
        </aside>
    </div>
</main>
@endsection
