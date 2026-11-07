<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Order · {{ $order->order_number }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; }
        .card { max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 16px 24px; font-size: 15px; letter-spacing: 1px; text-transform: uppercase; }
        .body { padding: 20px 24px; font-size: 13px; line-height: 1.7; }
        .kv b { display: inline-block; min-width: 130px; }
        ul { padding-left: 18px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="head">New order received — {{ $order->order_number }}</div>
        <div class="body">
            <div class="kv">
                <div><b>Customer:</b> {{ $order->customer_name }}</div>
                <div><b>Phone:</b> {{ $order->customer_phone }}</div>
                <div><b>Email:</b> {{ $order->customer_email ?? '—' }}</div>
                <div><b>Delivery:</b> {{ str_replace('_', ' ', $order->delivery_method) }}</div>
                <div><b>Payment:</b> {{ $order->payment_method }} ({{ $order->payment_status }})</div>
                <div><b>Total:</b> AED {{ number_format($order->total, 2) }}</div>
            </div>
            <p style="margin-top:16px;"><b>Items:</b></p>
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->quantity }} × {{ $item->product_name }} — AED {{ number_format($item->line_total, 2) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
