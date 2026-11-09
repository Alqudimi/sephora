<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SEPHORA UAE</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; }
        .card { max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 28px; text-align: center; }
        .head h1 { font-size: 20px; letter-spacing: 3px; text-transform: uppercase; margin: 0; }
        .body { padding: 32px 28px; text-align: center; }
        h2 { font-size: 18px; margin: 0 0 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        p { font-size: 14px; line-height: 1.6; color: #444; margin: 0 0 16px; }
        .voucher-box { background: #000000; color: #ffffff; padding: 20px; margin: 24px 0; border: 1px solid #000000; }
        .voucher-label { font-size: 11px; letter-spacing: 2px; text-transform: uppercase; color: #aaa; margin-bottom: 6px; }
        .voucher-code { font-size: 24px; font-weight: bold; letter-spacing: 4px; color: #ffffff; font-family: monospace; }
        .btn { display: inline-block; background: #000000; color: #ffffff; padding: 14px 28px; text-decoration: none; font-size: 12px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; margin-top: 12px; }
        .foot { padding: 20px 28px; font-size: 11px; color: #999; border-top: 1px solid #eee; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="head">
            <h1>SEPHORA UAE</h1>
        </div>
        <div class="body">
            <h2>Welcome to the Inner Circle</h2>
            <p>
                You are now part of our exclusive beauty community in the United Arab Emirates.
                Enjoy early access to coveted launches, private beauty offers, and trend reports.
            </p>

            <div class="voucher-box">
                <div class="voucher-label">Your Welcome Privilege · 10% Off</div>
                <div class="voucher-code">WELCOME10</div>
            </div>

            <p style="font-size: 12px; color: #777;">
                Use code <strong>WELCOME10</strong> at online checkout on orders of 200 AED or more.
            </p>

            <a href="{{ config('app.url') }}" class="btn">Discover What's New</a>
        </div>
        <div class="foot">
            Sent to {{ $subscriber->email }} · You are receiving this because you subscribed to Sephora UAE updates.<br>
            © {{ date('Y') }} SEPHORA UAE. All rights reserved.
        </div>
    </div>
</body>
</html>

