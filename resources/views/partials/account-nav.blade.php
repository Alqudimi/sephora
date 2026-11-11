@php
    $current = $active ?? 'dashboard';
    $navItems = [
        ['route' => 'account.dashboard', 'key' => 'dashboard', 'label' => __('messages.account.my_account')],
        ['route' => 'account.orders', 'key' => 'orders', 'label' => __('messages.account.orders')],
        ['route' => 'account.addresses', 'key' => 'addresses', 'label' => __('messages.account.addresses')],
        ['route' => 'account.wishlist', 'key' => 'wishlist', 'label' => __('messages.account.wishlist')],
        ['route' => 'account.settings', 'key' => 'settings', 'label' => __('messages.account.settings')],
        ['route' => 'account.country-language', 'key' => 'country-language', 'label' => __('messages.account.country_language')],
        ['route' => 'account.security', 'key' => 'security', 'label' => __('messages.account.security')],
        ['route' => 'account.privacy', 'key' => 'privacy', 'label' => __('messages.account.privacy')],
        ['route' => 'account.contact', 'key' => 'contact', 'label' => __('messages.contact')],
    ];
@endphp
<nav aria-label="{{ __('nav_menu.account_nav') }}" class="flex items-center gap-2 pb-4 border-b border-outline-variant mb-8 overflow-x-auto whitespace-nowrap md:flex-wrap">
    @foreach ($navItems as $item)
        @php $isActive = ($current === $item['key']); @endphp
        <a href="{{ route($item['route']) }}"
           @if($isActive) aria-current="page" @endif
           class="h-10 sm:h-11 px-4 sm:px-5 flex items-center shrink-0 font-label-caps text-label-caps uppercase tracking-wider border transition-colors {{ $isActive ? 'bg-primary text-on-primary border-primary font-bold' : 'bg-surface-container-lowest text-on-surface border-outline-variant hover:border-primary' }}">
            {{ $item['label'] }}
        </a>
    @endforeach
</nav>

