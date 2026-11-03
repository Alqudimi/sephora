<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SEPHORA | Makeup, Skincare, Fragrance & More')</title>
    <meta name="description" content="@yield('meta_description', 'Shop makeup, skincare, fragrance & more at Sephora UAE. Free delivery on orders over 250 AED. 100% authentic products from official brands.')">

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
    @yield('scripts')
    @stack('scripts')
</body>
</html>
