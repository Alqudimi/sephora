<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund confirmation · {{ $order->order_number }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; }
        .card { max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 20px 28px; }
        .head h1 { font-size: 18px; letter-spacing: 2px; text-transform: uppercase; margin: 0; }
        .body { padding: 24px 28px; }
        .body h2 { font-size: 16px; margin: 0 0 8px; }
        p { font-size: 13px; line-height: 1.6; color: #444; margin: 0 0 12px; }
        .amount { background: #f9f9f9; border: 1px dashed #ccc; padding: 14px 18px; margin: 16px 0; font-size: 15px; }
        .amount strong { font-size: 20px; }
        .foot { padding: 16px 28px; font-size: 11px; color: #999; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="head">
            <h1>Sephora UAE — Refund Confirmation</h1>
        </div>
        <div class="body">
            <h2>Hello {{ $order->customer_name }},</h2>
            <p>
                Your refund for order <strong>{{ $order->order_number }}</strong> has been processed.
            </p>

            <div class="amount">
                Refund amount: <strong>AED {{ number_format((float) $order->refund_amount, 2) }}</strong>
                @if ($order->refund_reference)
                    <br><span style="font-size:12px;color:#888;">Reference: {{ $order->refund_reference }}</span>
                @endif
            </div>

            <p>
                Depending on your bank or payment provider, the amount will appear on your statement
                within 5–10 business days. Cash-on-delivery refunds are transferred to the IBAN
                registered on your account.
            </p>

            <p>We are sorry this order did not work out and hope to see you again soon.</p>
        </div>
        <div class="foot">
            Order {{ $order->order_number }} · Placed {{ optional($order->placed_at)->format('d M Y') }}<br>
            This is an automated message from SEPHORA UAE.
        </div>
    </div>
</body>
</html>
