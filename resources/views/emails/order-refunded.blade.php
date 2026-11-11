@php($isRtl = app()->getLocale() === 'ar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.order_refunded.title', ['number' => $order->order_number]) }}</title>
    <style>
        body { font-family: {{ $isRtl ? "'Tahoma', 'Segoe UI', Arial, sans-serif" : 'Arial, Helvetica, sans-serif' }}; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; direction: {{ $isRtl ? 'rtl' : 'ltr' }}; }
        .card { max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 20px 28px; }
        .head h1 { font-size: 18px; letter-spacing: {{ $isRtl ? '0' : '2px' }}; text-transform: uppercase; margin: 0; }
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
            <h1>{{ __('emails.order_refunded.banner') }}</h1>
        </div>
        <div class="body">
            <h2>{{ __('emails.order_refunded.greeting', ['name' => $order->customer_name]) }}</h2>
            <p>{!! __('emails.order_refunded.intro', ['number' => e($order->order_number)]) !!}</p>

            <div class="amount">
                {{ __('emails.order_refunded.amount') }} <strong>{{ __('emails.common.aed') }} {{ number_format((float) $order->refund_amount, 2) }}</strong>
                @if ($order->refund_reference)
                    <br><span style="font-size:12px;color:#888;">{{ __('emails.order_refunded.reference', ['ref' => $order->refund_reference]) }}</span>
                @endif
            </div>

            <p>{{ __('emails.order_refunded.timeline_note') }}</p>

            <p>{{ __('emails.order_refunded.closing') }}</p>
        </div>
        <div class="foot">
            {{ __('emails.common.order_placed_footer', ['number' => $order->order_number, 'date' => optional($order->placed_at)->format('d M Y')]) }}<br>
            {{ __('emails.common.automated_footer_caps') }}
        </div>
    </div>
</body>
</html>
