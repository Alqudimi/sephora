<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tax Invoice {{ $order->order_number }} — SEPHORA UAE</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            color: #1a1a1a;
            background: #f6f6f6;
            padding: 24px;
            font-size: 13px;
            line-height: 1.55;
        }
        .sheet {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 48px 56px;
            border: 1px solid #e0e0e0;
        }
        header { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 3px solid #1a1a1a; padding-bottom: 24px; margin-bottom: 32px; }
        .brand { font-size: 28px; font-weight: 700; letter-spacing: 0.22em; text-transform: uppercase; }
        .brand small { display: block; font-size: 10px; font-weight: 400; letter-spacing: 0.08em; color: #666; margin-top: 4px; }
        .doc-title { text-align: right; }
        .doc-title h1 { font-size: 20px; letter-spacing: 0.12em; text-transform: uppercase; }
        .doc-title p { color: #666; }
        .grid { display: flex; gap: 40px; margin-bottom: 32px; }
        .grid > div { flex: 1; }
        h2 { font-size: 11px; text-transform: uppercase; letter-spacing: 0.14em; color: #888; margin-bottom: 8px; border-bottom: 1px solid #e0e0e0; padding-bottom: 4px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 32px; }
        thead th { text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 0.1em; color: #888; border-bottom: 2px solid #1a1a1a; padding: 8px 8px; }
        tbody td { padding: 10px 8px; border-bottom: 1px solid #eee; vertical-align: top; }
        tbody .name { font-weight: 600; }
        tbody .sub { color: #777; font-size: 11px; }
        .num { text-align: right; white-space: nowrap; }
        .totals { margin-left: auto; width: 300px; }
        .totals .row { display: flex; justify-content: space-between; padding: 6px 0; }
        .totals .row.total { border-top: 2px solid #1a1a1a; font-weight: 700; font-size: 15px; padding-top: 10px; margin-top: 6px; }
        .totals .row.discount { color: #e50046; }
        .badges { margin: 24px 0; }
        .badge { display: inline-block; border: 1px solid #ccc; border-radius: 999px; padding: 3px 12px; font-size: 11px; margin-right: 6px; text-transform: capitalize; }
        footer { margin-top: 40px; padding-top: 16px; border-top: 1px solid #e0e0e0; color: #888; font-size: 11px; text-align: center; }
        @media print {
            body { background: #fff; padding: 0; }
            .no-print { display: none; }
            .sheet { border: 0; padding: 24px; }
        }
    </style>
</head>
<body>
    <div class="sheet">
        <header>
            <div class="brand">
                Sephora
                <small>SEPHORA UAE — Beauty Retail FZ-LLC<br>Dubai, United Arab Emirates</small>
            </div>
            <div class="doc-title">
                <h1>Tax Invoice</h1>
                <p>
                    <strong>{{ $order->order_number }}</strong><br>
                    {{ optional($order->placed_at ?? $order->created_at)->format('d M Y, H:i') }}
                </p>
            </div>
        </header>

        <div class="grid">
            <div>
                <h2>Billed to</h2>
                <strong>{{ $order->customer_name }}</strong><br>
                {{ $order->customer_email }}<br>
                {{ $order->customer_phone }}
                @if($order->delivery_method !== 'click_collect')
                    <br><br>{{ $order->shipping_address }}<br>
                    {{ $order->area ? $order->area.', ' : '' }}{{ $order->emirate }}
                @endif
            </div>
            <div>
                <h2>Delivery</h2>
                {{ app(\App\Services\Commerce\ShippingCalculator::class)->label($order->delivery_method) }}<br>
                @if($order->delivery_method === 'click_collect' && $order->store)
                    <strong>{{ $order->store->name }}</strong><br>
                    {{ $order->store->address }}, {{ $order->store->city }}
                @else
                    @if($order->courier_label)
                        Courier: <strong>{{ $order->courier_label }}</strong><br>
                    @endif
                    @if($order->tracking_url)
                        Tracking: <a href="{{ $order->tracking_url }}" target="_blank" style="color:#1a1a1a; text-decoration:underline">{{ $order->tracking_number }}</a>
                    @else
                        Tracking: {{ $order->tracking_number ?? '—' }}
                    @endif
                @endif
            </div>
            <div>
                <h2>Payment</h2>
                {{ $order->payment_method_label }}<br>
                Status: <strong>{{ ucfirst($order->payment_status) }}</strong><br>
                @if($order->payment_reference)
                    Ref: {{ $order->payment_reference }}
                @endif
            </div>
        </div>

        <div class="badges">
            <span class="badge">Order: {{ str($order->status)->headline() }}</span>
            <span class="badge">Payment: {{ $order->payment_status }}</span>
            @if($order->gift_box)<span class="badge">Gift box</span>@endif
            @if($order->loyalty_points_earned)<span class="badge">+{{ $order->loyalty_points_earned }} Beauty Pass points</span>@endif
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width:44%">Item</th>
                    <th>Shade</th>
                    <th class="num">Unit price</th>
                    <th class="num">Qty</th>
                    <th class="num">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <span class="name">{{ $item->product_name }}</span>
                            @if($item->brand_name)<div class="sub">{{ $item->brand_name }}</div>@endif
                        </td>
                        <td>{{ $item->shade_name ?? '—' }}</td>
                        <td class="num">AED {{ number_format($item->unit_price, 2) }}</td>
                        <td class="num">{{ $item->quantity }}</td>
                        <td class="num"><strong>AED {{ number_format($item->line_total, 2) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <div class="row"><span>Subtotal</span><span>AED {{ number_format($order->subtotal, 2) }}</span></div>
            @if($order->discount > 0)
                <div class="row discount"><span>Discount {{ $order->coupon_code ? '('.$order->coupon_code.')' : '' }}</span><span>- AED {{ number_format($order->discount, 2) }}</span></div>
            @endif
            <div class="row"><span>Delivery</span><span>{{ $order->shipping_fee > 0 ? 'AED '.number_format($order->shipping_fee, 2) : 'Free' }}</span></div>
            @if((float) $order->tax_amount > 0)
                <div class="row"><span>Taxable amount (excl. VAT)</span><span>AED {{ number_format($order->subtotal_ex_tax, 2) }}</span></div>
                <div class="row"><span>VAT @ {{ round($order->tax_rate * 100, 2) }}%</span><span>AED {{ number_format($order->tax_amount, 2) }}</span></div>
            @endif
            <div class="row total"><span>Total (VAT inclusive)</span><span>AED {{ number_format($order->total, 2) }}</span></div>
            @if((float) $order->refund_amount > 0)
                <div class="row discount"><span>Refunded</span><span>- AED {{ number_format($order->refund_amount, 2) }}</span></div>
            @endif
        </div>

        @if($order->gift_message)
            <p style="margin-top:24px"><strong>Gift message:</strong> “{{ $order->gift_message }}”</p>
        @endif

        <footer>
            @php($trn = \App\Models\Setting::get('company_trn'))
            @if($trn)
                Company TRN: {{ $trn }}<br>
            @endif
            Prices include UAE VAT at {{ round($order->tax_rate * 100, 2) }}% where applicable. Thank you for shopping with Sephora UAE.<br>
            This tax invoice was generated by SEPHORA Admin on {{ now()->format('d M Y, H:i') }}.
        </footer>
    </div>

    <div class="no-print" style="text-align:center; margin-top:16px">
        <button onclick="window.print()" style="padding:10px 28px; background:#1a1a1a; color:#fff; border:0; cursor:pointer; font-size:14px; letter-spacing:0.06em">Print / Save PDF</button>
    </div>
</body>
</html>
