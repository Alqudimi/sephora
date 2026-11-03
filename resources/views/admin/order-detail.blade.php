@extends('admin.layout')
@section('title', 'Order ' . $order->order_number)
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase">{{ $order->order_number }}</h1>
    <form class="flex gap-3 items-center" method="POST" action="{{ route('admin.orders.status', $order) }}">
        @csrf @method('PATCH')
        <select class="h-11 px-3 bg-surface-container-lowest border border-outline font-body-sm" name="status">
            @foreach(['pending','processing','shipped','out_for_delivery','delivered','cancelled'] as $s)
            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
            @endforeach
        </select>
        <select class="h-11 px-3 bg-surface-container-lowest border border-outline font-body-sm" name="payment_status">
            @foreach(['pending','paid','refunded','failed'] as $s)
            <option value="{{ $s }}" {{ $order->payment_status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button class="bg-primary text-on-primary font-label-caps uppercase px-5 h-11 text-label-caps" type="submit">Update</button>
    </form>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-surface-container-lowest card-border p-6 space-y-4">
        @foreach($order->items as $item)
        <div class="flex items-center gap-4 pb-4 border-b border-outline-variant last:border-0 last:pb-0">
            <img alt="" class="w-14 h-14 object-contain bg-surface-container-low" src="{{ asset($item->image_path ?? 'images/placeholder.webp') }}"/>
            <div class="flex-1">
                <p class="font-title-md text-title-md text-primary">{{ $item->product_name }}</p>
                <p class="font-body-sm text-body-sm text-outline">{{ $item->brand_name }} · Qty {{ $item->quantity }}</p>
            </div>
            <span class="font-price-aed-md font-bold text-primary">AED {{ number_format($item->line_total, 2) }}</span>
        </div>
        @endforeach
    </div>
    <aside class="space-y-6">
        <div class="bg-surface-container-lowest card-border p-6 font-body-md text-body-md">
            <h3 class="font-headline-sm text-headline-sm text-primary uppercase mb-4">Customer</h3>
            <p class="text-on-surface-variant leading-relaxed">{{ $order->customer_name }}<br/>{{ $order->customer_phone }}<br/>{{ $order->customer_email }}<br/><br/>{{ $order->shipping_address }}<br/>{{ $order->area }}, {{ $order->emirate }}</p>
        </div>
        <div class="bg-surface-container-lowest card-border p-6 font-body-md text-body-md">
            <h3 class="font-headline-sm text-headline-sm text-primary uppercase mb-4">Totals</h3>
            <div class="flex justify-between"><span class="text-on-surface-variant">Subtotal</span><span>AED {{ number_format($order->subtotal, 2) }}</span></div>
            <div class="flex justify-between"><span class="text-on-surface-variant">Delivery</span><span>AED {{ number_format($order->shipping_fee, 2) }}</span></div>
            <div class="flex justify-between font-bold text-primary border-t border-primary pt-2 mt-2"><span>Total</span><span>AED {{ number_format($order->total, 2) }}</span></div>
        </div>
    </aside>
</div>
@endsection
