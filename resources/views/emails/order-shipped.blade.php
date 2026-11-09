<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your order is on its way · {{ $order->order_number }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; }
        .card { max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 20px 28px; }
        .head h1 { font-size: 18px; letter-spacing: 2px; text-transform: uppercase; margin: 0; }
        .body { padding: 24px 28px; }
        .body h2 { font-size: 16px; margin: 0 0 8px; }
        p { font-size: 13px; line-height: 1.6; color: #444; margin: 0 0 12px; }
        .track { background: #f9f9f9; border: 1px dashed #ccc; padding: 14px 18px; margin: 16px 0; font-size: 14px; }
        .track strong { letter-spacing: 1px; }
        .foot { padding: 16px 28px; font-size: 11px; color: #999; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="head">
            <h1>Sephora UAE — Order Shipped</h1>
        </div>
        <div class="body">
            <h2>Great news, {{ $order->customer_name }}!</h2>
            <p>
                Your order <strong>{{ $order->order_number }}</strong> has left our fulfilment centre
                and is on its way to you.
            </p>

            @if ($order->tracking_number)
                <div class="track">
                    @if ($order->courier_label)
                        Courier: <strong>{{ $order->courier_label }}</strong><br>
                    @endif
                    Tracking number: <strong>{{ $order->tracking_number }}</strong>
                </div>

                @if ($order->tracking_url)
                    <p style="text-align: center; margin: 20px 0;">
                        <a href="{{ $order->tracking_url }}" target="_blank" style="display: inline-block; background: #000000; color: #ffffff; padding: 12px 24px; text-decoration: none; font-size: 13px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase;">Track Your Shipment →</a>
                    </p>
                @else
                    <p>Use this number with your courier to follow every step of the delivery.</p>
                @endif
            @endif

            @if ($order->delivery_method === 'click_collect' && $order->store)
                <p>Once the parcel arrives at <strong>{{ $order->store->name }}</strong> we will send you a pick-up reminder.</p>
            @else
                <p>Estimated delivery is within 2–3 business days. If you are not home, the courier will try again or leave the parcel with your building's concierge.</p>
            @endif

            <p>Thank you for shopping with Sephora UAE.</p>
        </div>
        <div class="foot">
            Order {{ $order->order_number }} · Placed {{ optional($order->placed_at)->format('d M Y') }}<br>
            This is an automated message from SEPHORA UAE.
        </div>
    </div>
</body>
</html>
