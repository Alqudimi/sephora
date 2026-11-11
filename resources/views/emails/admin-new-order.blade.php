@php($isRtl = app()->getLocale() === 'ar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('emails.admin_new_order.title', ['number' => $order->order_number]) }}</title>
    <style>
        body { font-family: {{ $isRtl ? "'Tahoma', 'Segoe UI', Arial, sans-serif" : 'Arial, Helvetica, sans-serif' }}; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; direction: {{ $isRtl ? 'rtl' : 'ltr' }}; }
        .card { max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 16px 24px; font-size: 15px; letter-spacing: {{ $isRtl ? '0' : '1px' }}; text-transform: uppercase; }
        .body { padding: 20px 24px; font-size: 13px; line-height: 1.7; }
        .kv b { display: inline-block; min-width: 130px; }
        ul { padding-{{ $isRtl ? 'right' : 'left' }}: 18px; }
    </style>
</head>
<body>
    @php
        $deliveryKey = 'shop.delivery_methods.' . $order->delivery_method;
        $deliveryLabel = __($deliveryKey) !== $deliveryKey ? __($deliveryKey) : str_replace('_', ' ', $order->delivery_method);
    @endphp
    <div class="card">
        <div class="head">{{ __('emails.admin_new_order.banner', ['number' => $order->order_number]) }}</div>
        <div class="body">
            <div class="kv">
                <div><b>{{ __('emails.admin_new_order.customer') }}</b> {{ $order->customer_name }}</div>
                <div><b>{{ __('emails.admin_new_order.phone') }}</b> <span dir="ltr" style="display:inline-block;">{{ $order->customer_phone }}</span></div>
                <div><b>{{ __('emails.admin_new_order.email') }}</b> {{ $order->customer_email ?? '—' }}</div>
                <div><b>{{ __('emails.admin_new_order.delivery') }}</b> {{ $deliveryLabel }}</div>
                <div><b>{{ __('emails.admin_new_order.payment') }}</b> {{ $order->payment_method_label }} ({{ $order->payment_status }})</div>
                <div><b>{{ __('emails.admin_new_order.total') }}</b> {{ __('emails.common.aed') }} {{ number_format($order->total, 2) }}</div>
            </div>
            <p style="margin-top:16px;"><b>{{ __('emails.admin_new_order.items') }}</b></p>
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->quantity }} × {{ $item->product_name }} — {{ __('emails.common.aed') }} {{ number_format($item->line_total, 2) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
