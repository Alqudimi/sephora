@extends('layouts.app')

@section('title', __('meta.client_concierge'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="{{ __('ui.breadcrumb') }}" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">{{ __('ui.home') }}</a> /
        <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">{{ __('ui.my_account') }}</a> /
        <span class="text-on-surface font-semibold">{{ __('ui.contact_us') }}</span>
    </nav>

    @include('partials.account-nav', ['active' => 'contact'])

    <div class="mb-8 max-w-3xl">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ __('content.t_9bf5aa98f550') }}</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">{{ __('content.t_66fa02bbc520') }}</p>
    </div>

    @if (session('contact_success'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">
            {{ __('content.t_3940bb2945b7') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="border border-secondary bg-surface-container-lowest px-4 py-3 mb-6" role="alert">
            <p class="font-label-caps text-label-caps uppercase tracking-wider text-secondary font-bold mb-1">{{ __('content.t_2b42305acc0b') }}</p>
            <ul class="list-disc list-inside font-body-sm text-body-sm text-secondary space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-{{ __('ui.items_count_label', ['count' => '8']) }}-start">
        <form method="POST" action="{{ route('account.contact.store') }}" class="lg:col-span-2 border border-outline-variant bg-surface-container-lowest p-5 md:p-6 space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('content.t_c3a94deb80cf') }}</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('name') border-secondary @enderror"
                           name="name" required maxlength="120" type="text" value="{{ old('name', auth()->user()->name) }}">
                    @error('name')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('ui.email_required') }}</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('email') border-secondary @enderror"
                           name="email" required maxlength="190" type="email" value="{{ old('email', auth()->user()->email) }}">
                    @error('email')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('ui.phone') }}</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('phone') border-secondary @enderror"
                           name="phone" maxlength="40" type="tel" value="{{ old('phone', auth()->user()->phone) }}">
                    @error('phone')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('ui.subject') }}</span>
                    <select class="w-full h-12 px-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none" name="subject">
                        @foreach ([['Order enquiry', 'order_enquiry'], ['Delivery and tracking', 'delivery_tracking'], ['Returns and refunds', 'returns_refunds'], ['Product advice', 'product_advice'], ['Account and loyalty', 'account_loyalty'], ['Something else', 'something_else']] as [$subject, $subjectKey])
                            <option value="{{ $subject }}" @selected(old('subject') === $subject)>{{ __('ui.' . $subjectKey) }}</option>
                        @endforeach
                    </select>
                    @error('subject')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>
            </div>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">{{ __('ui.message_required') }}</span>
                <textarea class="w-full px-4 py-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none min-h-40 @error('message') border-secondary @enderror"
                          name="message" required maxlength="4000" placeholder="{{ __('content.t_e468c15f3c27') }}">{{ old('message') }}</textarea>
                @error('message')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>

            <div class="flex flex-wrap items-center gap-3">
                <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-8 h-12 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">{{ __('content.t_c70a890d1411') }}</button>
                <span class="font-body-sm text-body-sm text-outline">{{ __('content.t_657248f07499') }}</span>
            </div>
        </form>

        <aside class="space-y-4">
            <section class="border border-outline-variant bg-surface-container-low p-5 font-body-sm text-body-sm">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">{{ __('content.t_69b82d3770fa') }}</h2>
                <p class="text-on-surface-variant">{{ __('content.t_e6dfa9b28394') }} <a class="text-primary underline" href="tel:8007374672">800 7374672</a></p>
                <p class="text-on-surface-variant mt-1">{{ __('ui.email_label') }} <a class="text-primary underline" href="mailto:concierge@sephora.ae">concierge@sephora.ae</a></p>
                <p class="text-on-surface-variant mt-1">{{ __('content.t_1979ea45203d') }}</p>
            </section>

            <section class="border border-outline-variant bg-surface-container-lowest p-5 font-body-sm text-body-sm">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">{{ __('content.t_88a09039e843') }}</h2>
                <ul class="space-y-2">
                    <li><a class="text-primary underline hover:text-secondary" href="/faq/delivery">{{ __('content.t_ef33222a6c96') }}</a></li>
                    <li><a class="text-primary underline hover:text-secondary" href="/faq/cancellation-and-refund">{{ __('content.t_3322a2092ac9') }}</a></li>
                    <li><a class="text-primary underline hover:text-secondary" href="/faq">{{ __('content.t_f17e3c7971f6') }}</a></li>
                </ul>
            </section>
        </aside>
    </div>
</main>
@endsection
