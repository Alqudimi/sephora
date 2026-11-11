@extends('layouts.app')

@section('title', __('messages.errors.not_found') . ' | ' . __('messages.app_name'))
@section('body_class', 'bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white')

@section('content')
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl flex items-center justify-center">
<div class="text-center max-w-xl">
<div class="inline-block mb-4">
<span class="font-label-caps text-label-caps uppercase tracking-[0.2em] text-outline border-b border-outline-variant pb-1">{{ __('ui.error_404') }}</span>
</div>
<h1 class="font-display-hero text-primary font-serif tracking-tight mb-4">{{ __('messages.errors.oops') }}</h1>
<p class="font-headline-md text-headline-md font-serif text-primary mb-3">{{ __('messages.errors.404_subtitle') }}</p>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-8">
    {{ __('messages.errors.404_text') }}
</p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-3">
<a class="w-full sm:w-auto h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-[0.16em] hover:bg-surface-container-lowest hover:text-primary border border-transparent hover:border-primary transition-all duration-200 flex items-center justify-center" href="{{ route('home') }}">{{ __('messages.errors.continue_shopping') }}</a>
<a class="w-full sm:w-auto h-12 px-8 bg-surface-container-lowest text-primary font-label-caps text-label-caps uppercase tracking-[0.16em] hover:bg-surface-container-low border border-outline-variant transition-all duration-200 flex items-center justify-center" href="{{ route('shop.bestsellers') }}">{{ __('messages.errors.shop_bestsellers') }}</a>
</div>
</div>
</main>
@endsection
