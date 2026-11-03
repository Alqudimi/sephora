@extends('layouts.app')

@section('title', 'Session Expired | SEPHORA UAE')
@section('body_class', 'bg-background text-on-surface antialiased selection:bg-primary selection:text-on-primary min-h-screen flex flex-col font-body-md text-body-md')

@section('content')
<main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl flex items-center justify-center">
<div class="text-center max-w-xl">
<div class="inline-block mb-4">
<span class="font-label-caps text-label-caps uppercase tracking-[0.2em] text-outline border-b border-outline-variant pb-1">Error 419</span>
</div>
<h1 class="font-display-hero text-primary font-serif tracking-tight mb-4">Session Expired</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant mb-8">
            For your security, the session has timed out. Please go back and try again.
          </p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-3">
<a class="w-full sm:w-auto h-12 px-8 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-[0.16em] hover:bg-surface-container-lowest hover:text-primary border border-transparent hover:border-primary transition-all duration-200 flex items-center justify-center" href="{{ route('home') }}">Back to Home</a>
</div>
</div>
</main>
@endsection
