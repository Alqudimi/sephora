<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') | Sephora UAE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
</head>
<body class="bg-surface-container-low text-on-surface antialiased font-body-md text-body-md">
<div class="min-h-screen lg:flex">

    {{-- Mobile top bar --}}
    <header class="lg:hidden sticky top-0 z-30 h-16 bg-primary text-on-primary flex items-center justify-between px-4">
        <button type="button"
                data-admin-menu-toggle
                aria-controls="admin-sidebar"
                aria-expanded="false"
                class="w-11 h-11 flex items-center justify-center hover:bg-primary-container transition-colors">
            <span class="material-symbols-outlined">menu</span>
            <span class="sr-only">{{ __('content.t_9c803ed3685c') }}</span>
        </button>
        <a href="{{ route('admin.dashboard') }}" class="font-display-hero text-headline-sm tracking-[0.2em] uppercase font-bold">SEPHORA <span class="text-on-primary/60">{{ __('ui.admin') }}</span></a>
        <a href="/" class="w-11 h-11 flex items-center justify-center hover:bg-primary-container transition-colors" aria-label="{{ __('content.t_1039cd9e38dd') }}">
            <span class="material-symbols-outlined">storefront</span>
        </a>
    </header>

    {{-- Mobile backdrop --}}
    <div data-admin-menu-backdrop class="hidden fixed inset-0 z-40 bg-black/50 lg:hidden"></div>

    {{-- Sidebar --}}
    <aside id="admin-sidebar"
           data-admin-sidebar
           class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full transition-transform duration-200 bg-primary text-on-primary flex flex-col lg:static lg:translate-x-0 lg:w-60 lg:shrink-0"
           aria-label="{{ __('content.t_8ce001cf182b') }}">
        <div class="flex items-center justify-between border-b border-primary-container">
            <a class="font-display-hero text-headline-sm tracking-widest uppercase font-bold px-6 py-6" href="{{ route('admin.dashboard') }}">SEPHORA</a>
            <button type="button" data-admin-menu-close class="lg:hidden w-10 h-10 mr-2 flex items-center justify-center hover:bg-primary-container transition-colors" aria-label="{{ __('content.t_d4edd6c4597b') }}">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <nav class="flex-1 py-4 space-y-1 px-3 overflow-y-auto">
            <a class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary-container' : '' }}" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined text-[20px]">dashboard</span> {{ __('ui.dashboard') }}
            </a>
            <a class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors {{ request()->routeIs('admin.products*') ? 'bg-primary-container' : '' }}" href="{{ route('admin.products') }}">
                <span class="material-symbols-outlined text-[20px]">inventory_2</span>{{ __('ui.products') }}</a>
            <a class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors {{ request()->routeIs('admin.categories*') ? 'bg-primary-container' : '' }}" href="{{ route('admin.categories') }}">
                <span class="material-symbols-outlined text-[20px]">category</span>{{ __('ui.categories') }}</a>
            <a class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors {{ request()->routeIs('admin.orders*') ? 'bg-primary-container' : '' }}" href="{{ route('admin.orders') }}">
                <span class="material-symbols-outlined text-[20px]">receipt_long</span>{{ __('ui.orders') }}</a>
        </nav>

        <div class="p-3 border-t border-primary-container">
            <a class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors" href="/">
                <span class="material-symbols-outlined text-[20px]">storefront</span> {{ __('content.t_5a9417751fdb') }}
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="flex items-center gap-3 px-4 py-3 font-label-caps text-label-caps uppercase tracking-wider hover:bg-primary-container transition-colors w-full" type="submit">
                    <span class="material-symbols-outlined text-[20px]">logout</span> {{ __('content.t_61fd08ff5c37') }}
                </button>
            </form>
        </div>
    </aside>

    {{-- Content --}}
    <main class="flex-1 min-w-0 p-4 md:p-6 lg:p-8">
        @if (session('saved'))
            <div class="bg-[#1b6b45] text-white px-4 py-3 mb-6 font-body-sm" role="status">{{ __('content.t_e25c72b8d7a1') }}</div>
        @endif
        @if (session('deleted'))
            <div class="bg-error text-on-error px-4 py-3 mb-6 font-body-sm" role="status">{{ __('ui.deleted') }}</div>
        @endif
        @yield('content')
    </main>
</div>

<script>
(function () {
    const toggle = document.querySelector('[data-admin-menu-toggle]');
    const sidebar = document.querySelector('[data-admin-sidebar]');
    const backdrop = document.querySelector('[data-admin-menu-backdrop]');
    if (!toggle || !sidebar || !backdrop) return;

    function setOpen(open) {
        sidebar.classList.toggle('-translate-x-full', !open);
        backdrop.classList.toggle('hidden', !open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        document.body.classList.toggle('overflow-hidden', open);
    }

    toggle.addEventListener('click', function () { setOpen(true); });
    backdrop.addEventListener('click', function () { setOpen(false); });
    document.querySelectorAll('[data-admin-menu-close]').forEach(function (el) {
        el.addEventListener('click', function () { setOpen(false); });
    });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') setOpen(false);
    });
})();
</script>
@stack('scripts')
</body>
</html>
