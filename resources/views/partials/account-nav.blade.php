@php
    $current = $active ?? 'dashboard';
    $navItems = [
        ['route' => 'account.dashboard', 'key' => 'dashboard', 'label' => 'My Account'],
        ['route' => 'account.orders', 'key' => 'orders', 'label' => 'Orders'],
        ['route' => 'account.addresses', 'key' => 'addresses', 'label' => 'Addresses'],
        ['route' => 'account.wishlist', 'key' => 'wishlist', 'label' => 'Wishlist'],
        ['route' => 'account.settings', 'key' => 'settings', 'label' => 'Settings'],
        ['route' => 'account.country-language', 'key' => 'country-language', 'label' => 'Country & Language'],
        ['route' => 'account.security', 'key' => 'security', 'label' => 'Security'],
        ['route' => 'account.privacy', 'key' => 'privacy', 'label' => 'Privacy'],
        ['route' => 'account.contact', 'key' => 'contact', 'label' => 'Contact Us'],
    ];
@endphp
<nav aria-label="Account navigation" class="flex items-center gap-2 pb-4 border-b border-outline-variant mb-8 overflow-x-auto whitespace-nowrap md:flex-wrap">
    @foreach ($navItems as $item)
        @php $isActive = ($current === $item['key']); @endphp
        <a href="{{ route($item['route']) }}"
           @if($isActive) aria-current="page" @endif
           class="h-10 sm:h-11 px-4 sm:px-5 flex items-center shrink-0 font-label-caps text-label-caps uppercase tracking-wider border transition-colors {{ $isActive ? 'bg-primary text-on-primary border-primary font-bold' : 'bg-surface-container-lowest text-on-surface border-outline-variant hover:border-primary' }}">
            {{ $item['label'] }}
        </a>
    @endforeach
</nav>

