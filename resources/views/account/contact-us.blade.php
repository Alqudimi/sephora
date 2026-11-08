@extends('layouts.app')

@section('title', 'Client Concierge | SEPHORA UAE')
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

    <nav aria-label="Breadcrumb" class="text-body-sm font-body-sm text-outline mb-4">
        <a class="hover:text-secondary" href="/">Home</a> /
        <a class="hover:text-secondary" href="{{ route('account.dashboard') }}">My Account</a> /
        <span class="text-on-surface font-semibold">Contact Us</span>
    </nav>

    @include('partials.account-nav', ['active' => 'contact'])

    <div class="mb-8 max-w-3xl">
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">Client concierge</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">Send us a message and our team will reply within 24 hours. For urgent order issues, call us free on 800 7374672.</p>
    </div>

    @if (session('contact_success'))
        <div class="border border-[#1b6b45] bg-[#eef7f1] text-[#1b6b45] px-4 py-3 mb-6 font-body-sm text-body-sm" role="status">
            Thank you. Your message has been received and our client concierge will reply within 24 hours.
        </div>
    @endif

    @if ($errors->any())
        <div class="border border-secondary bg-surface-container-lowest px-4 py-3 mb-6" role="alert">
            <p class="font-label-caps text-label-caps uppercase tracking-wider text-secondary font-bold mb-1">Please check your message</p>
            <ul class="list-disc list-inside font-body-sm text-body-sm text-secondary space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <form method="POST" action="{{ route('account.contact.store') }}" class="lg:col-span-2 border border-outline-variant bg-surface-container-lowest p-5 md:p-6 space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Your name *</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('name') border-secondary @enderror"
                           name="name" required maxlength="120" type="text" value="{{ old('name', auth()->user()->name) }}">
                    @error('name')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Email *</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('email') border-secondary @enderror"
                           name="email" required maxlength="190" type="email" value="{{ old('email', auth()->user()->email) }}">
                    @error('email')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Phone</span>
                    <input class="w-full h-12 px-4 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none @error('phone') border-secondary @enderror"
                           name="phone" maxlength="40" type="tel" value="{{ old('phone', auth()->user()->phone) }}">
                    @error('phone')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>

                <label class="space-y-1.5">
                    <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Subject</span>
                    <select class="w-full h-12 px-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none" name="subject">
                        @foreach (['Order enquiry', 'Delivery and tracking', 'Returns and refunds', 'Product advice', 'Account and loyalty', 'Something else'] as $subject)
                            <option value="{{ $subject }}" @selected(old('subject') === $subject)>{{ $subject }}</option>
                        @endforeach
                    </select>
                    @error('subject')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
                </label>
            </div>

            <label class="space-y-1.5 block">
                <span class="block font-label-caps text-label-caps uppercase text-outline font-bold">Message *</span>
                <textarea class="w-full px-4 py-3 bg-surface-container-low border border-outline text-on-surface font-body-md focus:border-primary focus:outline-none min-h-40 @error('message') border-secondary @enderror"
                          name="message" required maxlength="4000" placeholder="Tell us how we can help. Include your order number when relevant.">{{ old('message') }}</textarea>
                @error('message')<span class="block font-body-sm text-body-sm text-secondary">{{ $message }}</span>@enderror
            </label>

            <div class="flex flex-wrap items-center gap-3">
                <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-8 h-12 border border-primary hover:bg-surface-container-lowest hover:text-primary transition-all" type="submit">Send message</button>
                <span class="font-body-sm text-body-sm text-outline">We reply within 24 hours, 7 days a week.</span>
            </div>
        </form>

        <aside class="space-y-4">
            <section class="border border-outline-variant bg-surface-container-low p-5 font-body-sm text-body-sm">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">Other ways to reach us</h2>
                <p class="text-on-surface-variant">Toll-free: <a class="text-primary underline" href="tel:8007374672">800 7374672</a></p>
                <p class="text-on-surface-variant mt-1">Email: <a class="text-primary underline" href="mailto:concierge@sephora.ae">concierge@sephora.ae</a></p>
                <p class="text-on-surface-variant mt-1">Daily, 9:00–21:00 GST</p>
            </section>

            <section class="border border-outline-variant bg-surface-container-lowest p-5 font-body-sm text-body-sm">
                <h2 class="font-label-caps text-label-caps uppercase tracking-widest text-primary font-bold mb-3">Quick answers</h2>
                <ul class="space-y-2">
                    <li><a class="text-primary underline hover:text-secondary" href="/faq/delivery">Delivery times and fees</a></li>
                    <li><a class="text-primary underline hover:text-secondary" href="/faq/cancellation-and-refund">Returns and refunds</a></li>
                    <li><a class="text-primary underline hover:text-secondary" href="/faq">All frequently asked questions</a></li>
                </ul>
            </section>
        </aside>
    </div>
</main>
@endsection
