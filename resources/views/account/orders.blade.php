@extends('layouts.app')
@section('title', 'My Orders | SEPHORA')
@section('body_class', 'bg-surface text-on-surface antialiased font-body-md text-body-md selection:bg-primary selection:text-on-primary')
@section('content')
<header class="bg-surface-container-lowest sticky top-0 z-50 border-b border-outline-variant">
<div class="flex flex-col w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin">
<!-- Top Row: Logo, Search, Trailing Actions -->
<div class="flex items-center justify-between py-4 gap-6">
<!-- Left: Search Box (on_left style) -->
<div class="flex-1 max-w-md hidden md:flex items-center">
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-xl pointer-events-none">search</span>
<input class="w-full bg-surface-container-low border border-outline-variant pl-10 pr-4 py-2 text-sm text-on-surface placeholder:text-outline focus:outline-none focus:border-primary focus:bg-surface-container-lowest transition-all" placeholder="Search..." type="text"/>
</div>
</div>
<!-- Center: Sephora Brand Logo -->
<div class="flex-shrink-0 text-center mx-auto md:mx-0">
<a class="font-display-hero text-headline-md tracking-widest uppercase font-bold text-primary inline-block" href="/">
            SEPHORA
          </a>
</div>
<!-- Right: Actions & Country Selector -->
<div class="flex items-center gap-5 justify-end flex-1">
<!-- Stores & Services -->
<a class="hidden lg:flex items-center gap-2 text-on-surface hover:text-primary transition-colors cursor-pointer group" href="/stores">
<span class="material-symbols-outlined text-xl">location_on</span>
<span class="font-label-caps text-label-caps tracking-wider text-xs">Stores &amp; Services</span>
</a>
<div class="h-4 w-[1px] bg-outline-variant hidden lg:block"></div>
<!-- Country Indicator UAE -->
<div class="hidden sm:flex items-center gap-2 cursor-pointer hover:opacity-80 transition-opacity">
<span class="inline-flex items-center justify-center w-5 h-3.5 bg-neutral-100 border border-neutral-300 overflow-hidden rounded-[1px] shadow-sm">
<span class="w-1.5 h-full bg-red-600 inline-block"></span>
<span class="flex-1 flex flex-col h-full">
<span class="h-1 bg-green-700 w-full inline-block"></span>
<span class="h-1 bg-white w-full inline-block"></span>
<span class="h-1 bg-black w-full inline-block"></span>
</span>
</span>
<span class="font-label-caps text-label-caps text-[10px]">UAE | AED</span>
</div>
<!-- Account Icon (Active context: My Account) -->
<a class="flex items-center justify-center p-1.5 text-primary border-b-2 border-primary cursor-pointer transition-all" href="/my-account" title="My Account">
<span class="material-symbols-outlined text-2xl font-bold" style="font-variation-settings: 'FILL' 1;">person</span>
</a>
<!-- Wishlist Favorite Icon -->
<a class="flex items-center justify-center p-1.5 text-on-surface-variant hover:text-primary transition-colors cursor-pointer" href="/my-account/wishlist" title="Wishlist">
<span class="material-symbols-outlined text-2xl">favorite</span>
</a>
<!-- Shopping Bag Icon -->
<a class="flex items-center justify-center p-1.5 text-on-surface-variant hover:text-primary transition-colors relative cursor-pointer" href="/cart" title="Bag">
<span class="material-symbols-outlined text-2xl">shopping_bag</span>
<span class="absolute 1 top-0 right-0 bg-primary text-on-primary text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center leading-none" data-bag-count>@if(!empty($bagCount)){{ $bagCount }}@else 0 @endif</span></a>
</div>
</div>
<!-- Bottom Row: Navigation Links Hierarchy -->
<nav class="border-t border-outline-variant overflow-x-auto custom-scrollbar py-2.5">
<ul class="flex items-center justify-between min-w-max gap-6 text-xs uppercase tracking-wider font-semibold font-title-md">
<li><a class="text-neutral-500 hover:text-primary transition-colors duration-150" href="/shop/fragrance">Stack Your Scent</a></li>
<li><a class="text-neutral-500 hover:text-primary transition-colors duration-150" href="/shop/gifts">The Holiday Collection</a></li>
<li><a class="text-secondary font-bold hover:opacity-80 transition-opacity" href="/beauty-offers">Beauty Offers</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/new">New</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/makeup">Makeup</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/fragrance">Fragrance</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/skincare">Skincare</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/bath-body">Bath &amp; Body</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/hair">Hair</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/brands/sephora-collection">Sephora Collection</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/brands">Brands</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/bestsellers">Best Sellers</a></li>
<li><a class="text-on-surface-variant hover:text-primary transition-colors duration-150" href="/shop/gifts">Gifts</a></li>
</ul>
</nav>
</div>
</header>
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-tablet lg:px-margin py-space-lg">

<nav class="text-body-sm font-body-sm text-outline mb-4"><a class="hover:text-secondary" href="/">Home</a> / <a class="hover:text-secondary" href="/my-account">My Account</a> / <span class="text-on-surface font-semibold">Orders</span></nav>
<div class="flex items-end justify-between border-b border-primary pb-4 mb-8">
    <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">My Orders</h1>
    <span class="font-body-sm text-body-sm text-outline">{{ $orders->total() }} orders</span>
</div>
@if($orders->isEmpty())
<div class="text-center py-24 space-y-5">
    <span class="material-symbols-outlined text-[64px] text-outline-variant" data-icon="receipt_long">receipt_long</span>
    <h2 class="font-headline-sm text-headline-sm text-primary">No orders yet</h2>
    <p class="font-body-md text-body-md text-on-surface-variant">Your order history and tracking will appear here.</p>
    <a class="inline-block bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest px-10 py-4 hover:bg-surface-container-lowest hover:text-primary hover:border hover:border-primary transition-all" href="/shop/bestsellers">Start Shopping</a>
</div>
@else
<div class="space-y-4">
    @foreach($orders as $order)
    <article class="bg-surface-container-lowest card-border p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
            <div>
                <span class="font-label-caps text-label-caps uppercase text-outline tracking-wider font-bold">{{ $order->placed_at?->format('d M Y') }}</span>
                <h3 class="font-title-lg text-title-lg text-primary mt-0.5">{{ $order->order_number }}</h3>
            </div>
            <span class="font-label-tag text-label-tag uppercase px-3 py-1.5 font-bold {{ $order->status === 'delivered' ? 'bg-[#1b6b45] text-white' : ($order->status === 'cancelled' ? 'bg-error text-on-error' : 'bg-primary text-on-primary') }}">{{ $order->status_label }}</span>
        </div>
        <div class="flex items-center gap-3 mb-4">
            @foreach($order->items->take(4) as $item)
            <img alt="{{ $item->product_name }}" class="w-14 h-14 object-contain bg-surface-container-low" src="{{ asset($item->image_path ?? 'images/placeholder.webp') }}"/>
            @endforeach
            @if($order->items->count() > 4)<span class="font-body-sm text-body-sm text-outline">+{{ $order->items->count() - 4 }} more</span>@endif
        </div>
        <div class="flex items-center justify-between border-t border-outline-variant pt-4">
            <span class="font-body-md text-body-md text-on-surface-variant">{{ $order->items->count() }} item(s)</span>
            <div class="flex items-center gap-6">
                <span class="font-price-aed-lg text-price-aed-lg font-bold text-primary">AED {{ number_format($order->total, 2) }}</span>
                <a class="font-label-caps text-label-caps uppercase underline text-primary hover:text-secondary" href="{{ route('account.orders.show', $order->order_number) }}">View Details</a>
            </div>
        </div>
    </article>
    @endforeach
</div>
{{ $orders->links() }}
@endif

</main>
<footer class="bg-primary text-on-primary w-full border-t border-outline-variant px-margin-mobile md:px-margin-tablet lg:px-margin py-space-xl mt-auto">
<div class="max-w-[1440px] mx-auto">
<!-- Upper Footer Grid -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 pb-12 border-b border-neutral-800 text-xs">
<!-- Column 1: Top Categories -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">Top Categories</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/shop/makeup">Makeup</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/fragrance">Fragrance</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/skincare">Skincare</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/bath-body">Bath &amp; Body</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/shop/hair">Hair</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/brands/sephora-collection">Sephora Collection</a></li>
</ul>
</div>
<!-- Column 2: Top Brands -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">Top Brands</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="#">Huda Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Kayali</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Rare Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Fenty Beauty</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Glow Recipe</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Sol De Janeiro</a></li>
</ul>
</div>
<!-- Column 3: My Sephora -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">My Sephora</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="text-on-primary font-bold underline" href="/my-account">My Account</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/my-account">Beauty Pass Program</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Order History</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/my-account/wishlist">My Wishlist</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Beauty Preferences</a></li>
</ul>
</div>
<!-- Column 4: Customer Service -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">Customer Service</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/faq">Help &amp; FAQs</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Track Order</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Delivery &amp; Returns</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Store Locator</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/contact-us">Contact Us</a></li>
</ul>
</div>
<!-- Column 5: About Sephora -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">About Sephora</h5>
<ul class="space-y-2 text-on-primary-container">
<li><a class="hover:text-on-primary transition-colors" href="/stores">About Us</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/stores">Careers</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Terms &amp; Conditions</a></li>
<li><a class="hover:text-on-primary transition-colors" href="/terms-and-conditions">Privacy Policy</a></li>
<li><a class="hover:text-on-primary transition-colors" href="#">Beauty Services</a></li>
</ul>
</div>
<!-- Column 6: Region & Social -->
<div>
<h5 class="font-title-md text-title-md text-on-primary mb-4 tracking-wider uppercase font-semibold">Location &amp; Language</h5>
<div class="mb-4">
<span class="text-on-primary-container block mb-1">United Arab Emirates</span>
<span class="font-semibold text-on-primary">AED - English</span>
</div>
<h5 class="font-label-caps text-label-caps uppercase text-on-primary mb-3">Connect With Us</h5>
<div class="flex items-center gap-3 text-on-primary-container">
<a class="hover:text-on-primary transition-colors" href="#" title="Instagram">
<span class="material-symbols-outlined text-lg">photo_camera</span>
</a>
<a class="hover:text-on-primary transition-colors" href="#" title="Facebook">
<span class="material-symbols-outlined text-lg">public</span>
</a>
<a class="hover:text-on-primary transition-colors" href="#" title="YouTube">
<span class="material-symbols-outlined text-lg">smart_display</span>
</a>
<a class="hover:text-on-primary transition-colors" href="#" title="App">
<span class="material-symbols-outlined text-lg">smartphone</span>
</a>
</div>
</div>
</div>
<!-- Lower Footer: Payment methods & Copyright -->
<div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
<div class="flex items-center gap-3">
<span class="font-display-hero text-headline-sm uppercase tracking-widest text-on-primary">
            SEPHORA
          </span>
<span class="text-neutral-500 text-xs hidden md:inline">|</span>
<p class="font-body-sm text-body-sm text-neutral-400">
            © 2024 SEPHORA Middle East. All Rights Reserved. Pure Luxury &amp; Authentic Beauty.
          </p>
</div>
<!-- Payment Badges -->
<div class="flex items-center gap-3 text-[10px] font-bold tracking-widest text-neutral-400 uppercase">
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">VISA</span>
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">MASTERCARD</span>
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">APPLE PAY</span>
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">TABBY</span>
<span class="px-2 py-1 bg-neutral-900 border border-neutral-800">TAMARA</span>
</div>
</div>
</div>
</footer>
@endsection
