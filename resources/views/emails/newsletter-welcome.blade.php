@php($isRtl = app()->getLocale() === 'ar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.newsletter.title') }}</title>
    <style>
        body { font-family: {{ $isRtl ? "'Tahoma', 'Segoe UI', Arial, sans-serif" : 'Arial, Helvetica, sans-serif' }}; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; direction: {{ $isRtl ? 'rtl' : 'ltr' }}; }
        .card { max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 28px; text-align: center; }
        .head h1 { font-size: 20px; letter-spacing: {{ $isRtl ? '0' : '3px' }}; text-transform: uppercase; margin: 0; }
        .body { padding: 32px 28px; text-align: center; }
        h2 { font-size: 18px; margin: 0 0 12px; font-weight: bold; text-transform: uppercase; letter-spacing: {{ $isRtl ? '0' : '1px' }}; }
        p { font-size: 14px; line-height: 1.6; color: #444; margin: 0 0 16px; }
        .voucher-box { background: #000000; color: #ffffff; padding: 20px; margin: 24px 0; border: 1px solid #000000; }
        .voucher-label { font-size: 11px; letter-spacing: {{ $isRtl ? '0' : '2px' }}; text-transform: uppercase; color: #aaa; margin-bottom: 6px; }
        .voucher-code { font-size: 24px; font-weight: bold; letter-spacing: 4px; color: #ffffff; font-family: monospace; direction: ltr; }
        .btn { display: inline-block; background: #000000; color: #ffffff; padding: 14px 28px; text-decoration: none; font-size: 12px; font-weight: bold; letter-spacing: {{ $isRtl ? '0' : '2px' }}; text-transform: uppercase; margin-top: 12px; }
        .foot { padding: 20px 28px; font-size: 11px; color: #999; border-top: 1px solid #eee; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="head">
            <h1>{{ __('emails.newsletter.banner') }}</h1>
        </div>
        <div class="body">
            <h2>{{ __('emails.newsletter.heading') }}</h2>
            <p>{{ __('emails.newsletter.intro') }}</p>

            <div class="voucher-box">
                <div class="voucher-label">{{ __('emails.newsletter.voucher_label') }}</div>
                <div class="voucher-code">WELCOME10</div>
            </div>

            <p style="font-size: 12px; color: #777;">
                {!! __('emails.newsletter.voucher_note') !!}
            </p>

            <a href="{{ config('app.url') }}" class="btn">{{ __('emails.newsletter.cta') }}</a>
        </div>
        <div class="foot">
            {{ __('emails.newsletter.footer_reason', ['email' => $subscriber->email]) }}<br>
            {{ __('emails.common.copyright', ['year' => date('Y')]) }}
        </div>
    </div>
</body>
</html>
