@extends('layouts.app')
@section('title', __('messages.account.saved_addresses') . ' | ' . __('messages.app_name'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')
@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<nav class="text-body-sm font-body-sm text-outline mb-4">
    <a class="hover:text-secondary" href="/">{{ __('messages.home') }}</a> /
    <a class="hover:text-secondary" href="/my-account">{{ __('messages.account.my_account') }}</a> /
    <span class="text-on-surface font-semibold">{{ __('messages.account.addresses') }}</span>
</nav>

@include('partials.account-nav', ['active' => 'addresses'])

<div class="flex items-end justify-between border-b border-primary pb-4 mb-8">
    <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ __('messages.account.saved_addresses') }}</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($addresses as $address)
    <article class="bg-surface-container-lowest card-border p-6 {{ $address->is_default ? 'border-primary' : '' }}">
        @if($address->is_default)<span class="font-label-tag text-label-tag uppercase bg-primary text-on-primary px-2 py-0.5 font-bold mb-3 inline-block">{{ __('messages.account.default') }}</span>@endif
        <h3 class="font-title-lg text-title-lg text-primary">{{ $address->label ?? __('messages.address') }}</h3>
        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mt-2">
            {{ $address->full_name }}<br/>{{ $address->street_address }}<br/>{{ $address->area }}, {{ $address->emirate }}<br/>{{ $address->phone }}
        </p>
    </article>
    @empty
    <p class="font-body-md text-body-md text-on-surface-variant">{{ __('messages.account.no_addresses') }}</p>
    @endforelse
</div>

<div class="bg-surface-container-lowest card-border p-6 mt-8 max-w-2xl">
    <h2 class="font-headline-sm text-headline-sm text-primary uppercase mb-6">{{ __('messages.account.add_new_address') }}</h2>
    <form class="grid grid-cols-1 md:grid-cols-2 gap-4" method="POST" action="{{ route('account.addresses.store') }}">
        @csrf
        <input class="h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary rounded-none md:col-span-1" name="full_name" placeholder="{{ __('messages.name') }} *" required type="text"/>
        <input class="h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary rounded-none" name="phone" placeholder="{{ __('messages.phone') }} *" required type="tel"/>
        <select class="h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary rounded-none" name="emirate" required>
            <option value="">{{ __('messages.account.select_emirate') }} *</option>
            @foreach(['Dubai','Abu Dhabi','Sharjah','Ajman','Al Ain','Ras Al Khaimah','Fujairah','Umm Al Quwain'] as $em)
            <option value="{{ $em }}">{{ $em }}</option>
            @endforeach
        </select>
        <input class="h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary rounded-none" name="area" placeholder="{{ __('messages.account.area') }}" type="text"/>
        <input class="h-12 px-4 bg-surface-container-lowest border border-outline text-on-surface font-body-md text-body-md focus:border-primary rounded-none md:col-span-2" name="street_address" placeholder="{{ __('messages.account.street_building') }} *" required type="text"/>
        <label class="flex items-center gap-2 font-body-sm text-body-sm text-on-surface-variant md:col-span-2">
            <input class="w-4 h-4" name="is_default" type="checkbox" value="1"/> {{ __('messages.account.set_default') }}
        </label>
        <button class="bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 h-12 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all md:col-span-2" type="submit">{{ __('messages.account.save_address') }}</button>
    </form>
</div>

</main>
@endsection
