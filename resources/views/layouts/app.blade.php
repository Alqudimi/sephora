@php
    $currentLocale = app()->getLocale();
    $isRtl = $currentLocale === 'ar';
    $dirAttribute = $isRtl ? 'rtl' : 'ltr';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $currentLocale ) }}" dir="{{ $dirAttribute }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SEPHORA | Makeup, Skincare, Fragrance & More')</title>
    <meta name="description" content="@yield('meta_description', 'Shop makeup, skincare, fragrance & more at Sephora UAE. Free delivery on orders over 250 AED. 100% authentic products from official brands.')">

    {{-- SEO: pages override via @section('head'), everything else gets sane defaults --}}
    @hasSection('head')
        @yield('head')
    @else
        <link rel="canonical" href="{{ url()->current() }}">
        <meta property="og:site_name" content="SEPHORA UAE">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="@yield('title', 'SEPHORA | Makeup, Skincare, Fragrance & More')">
        <meta property="og:description" content="@yield('meta_description', 'Shop makeup, skincare, fragrance & more at Sephora UAE. Free delivery on orders over 250 AED. 100% authentic products from official brands.')">
        <meta property="og:image" content="{{ asset('images/placeholder.webp') }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title', 'SEPHORA | Makeup, Skincare, Fragrance & More')">
        <meta name="twitter:description" content="@yield('meta_description', 'Shop makeup, skincare, fragrance & more at Sephora UAE. Free delivery on orders over 250 AED. 100% authentic products from official brands.')">
        <meta name="twitter:image" content="{{ asset('images/placeholder.webp') }}">
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'SEPHORA UAE',
            'url' => url('/'),
            'description' => 'Shop makeup, skincare, fragrance & more at Sephora UAE.',
        ], JSON_HEX_TAG | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endif

    {{-- Vite build: Tailwind v3 (combined design config) + app JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Fonts: Bodoni Moda + Manrope + Montserrat (all design families) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Manrope:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    {{-- Material Symbols Outlined (icon system used across design pages) --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">

    @yield('head')
    @stack('styles')
</head>
<body class="@yield('body_class', 'bg-white text-gray-900 font-sans antialiased')">
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
    @include('partials.cookie-banner')
    @yield('scripts')
    @stack('scripts')
</body>
</html>
