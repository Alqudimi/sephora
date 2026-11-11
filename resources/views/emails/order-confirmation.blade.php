@php($isRtl = app()->getLocale() === 'ar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.order_confirmation.title', ['number' => $order->order_number]) }}</title>
    <style>
        body { font-family: {{ $isRtl ? "'Tahoma', 'Segoe UI', Arial, sans-serif" : 'Arial, Helvetica, sans-serif' }}; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; direction: {{ $isRtl ? 'rtl' : 'ltr' }}; }
        .card { max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 20px 28px; }
        .head h1 { font-size: 18px; letter-spacing: {{ $isRtl ? '0' : '2px' }}; text-transform: uppercase; margin: 0; }
        .body { padding: 24px 28px; }
        .body h2 { font-size: 16px; margin: 0 0 8px; }
        p { font-size: 13px; line-height: 1.6; color: #444; margin: 0 0 12px; }
        table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        th { text-align: {{ $isRtl ? 'right' : 'left' }}; font-size: 11px; text-transform: uppercase; letter-spacing: {{ $isRtl ? '0' : '1px' }}; color: #888; border-bottom: 1px solid #ddd; padding: 8px 6px; }
        td { font-size: 13px; padding: 10px 6px; border-bottom: 1px solid #f0f0f0; vertical-align: top; }
        .totals td { border: none; padding: 4px 6px; }
        .totals .grand td { font-weight: bold; font-size: 15px; border-top: 1px solid #ddd; padding-top: 10px; }
        .btn { display: inline-block; background: #000000; color: #ffffff; font-size: 12px; text-transform: uppercase; letter-spacing: {{ $isRtl ? '0' : '2px' }}; text-decoration: none; padding: 14px 26px; margin-top: 8px; }
        .foot { padding: 16px 28px; font-size: 11px; color: #999; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="head">
            <h1>{{ __('emails.order_confirmation.banner') }}</h1>
        </div>
        <div class="body">
            <h2>{{ __('emails.order_confirmation.greeting', ['name' => $order->customer_name]) }}</h2>
            <p>
                {!! $order->delivery_method === 'click_collect'
                    ? __('emails.order_confirmation.intro_pickup', ['number' => e($order->order_number)])
                    : __('emails.order_confirmation.intro_delivery', ['number' => e($order->order_number)]) !!}
            </p>

            @php($endAlign = $isRtl ? 'left' : 'right')
            <table>
                <tr>
                    <th>{{ __('emails.order_confirmation.col_item') }}</th>
                    <th style="text-align:center;">{{ __('emails.order_confirmation.col_qty') }}</th>
                    <th style="text-align:{{ $endAlign }};">{{ __('emails.order_confirmation.col_price') }}</th>
                </tr>
                @foreach ($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product_name }}</strong><br>
                        <span style="color:#888;font-size:11px;">{{ $item->brand_name }}@if($item->shade_name) · {{ $item->shade_name }}@endif</span>
                    </td>
                    <td style="text-align:center;">{{ $item->quantity }}</td>
                    <td style="text-align:{{ $endAlign }};">{{ __('emails.common.aed') }} {{ number_format($item->line_total, 2) }}</td>
                </tr>
                @endforeach
                <tr class="totals">
                    <td colspan="2" style="text-align:{{ $endAlign }};">{{ __('emails.order_confirmation.subtotal') }}</td>
                    <td style="text-align:{{ $endAlign }};">{{ __('emails.common.aed') }} {{ number_format($order->subtotal, 2) }}</td>
                </tr>
                @if ($order->discount > 0)
                <tr class="totals">
                    <td colspan="2" style="text-align:{{ $endAlign }};">{{ __('emails.order_confirmation.discount', ['code' => $order->coupon_code]) }}</td>
                    <td style="text-align:{{ $endAlign }};">-{{ __('emails.common.aed') }} {{ number_format($order->discount, 2) }}</td>
                </tr>
                @endif
                <tr class="totals">
                    <td colspan="2" style="text-align:{{ $endAlign }};">{{ __('emails.order_confirmation.delivery') }}</td>
                    <td style="text-align:{{ $endAlign }};">{{ $order->shipping_fee == 0 ? __('emails.common.free') : __('emails.common.aed').' '.number_format($order->shipping_fee, 2) }}</td>
                </tr>
                <tr class="totals grand">
                    <td colspan="2" style="text-align:{{ $endAlign }};">{{ __('emails.order_confirmation.total') }}</td>
                    <td style="text-align:{{ $endAlign }};">{{ __('emails.common.aed') }} {{ number_format($order->total, 2) }}</td>
                </tr>
            </table>

            <p>
                {{ __('emails.order_confirmation.payment_method') }} <strong>{{ $order->payment_method_label }}</strong><br>
                {!! __('emails.order_confirmation.loyalty_earned', ['points' => (int) $order->loyalty_points_earned]) !!}
            </p>

            <a class="btn" href="{{ $trackingUrl }}">{{ __('emails.order_confirmation.track_cta') }}</a>
        </div>
        <div class="foot">
            {{ __('emails.common.automated_footer') }}
        </div>
    </div>
</body>
</html>
