@php($isRtl = app()->getLocale() === 'ar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.contact_message.title') }}</title>
    <style>
        body { font-family: {{ $isRtl ? "'Tahoma', 'Segoe UI', Arial, sans-serif" : 'Arial, Helvetica, sans-serif' }}; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; direction: {{ $isRtl ? 'rtl' : 'ltr' }}; }
        .card { max-width: 600px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 20px 28px; }
        .head h1 { font-size: 16px; letter-spacing: {{ $isRtl ? '0' : '2px' }}; text-transform: uppercase; margin: 0; }
        .body { padding: 28px; }
        .field { margin-bottom: 16px; }
        .label { font-size: 11px; text-transform: uppercase; letter-spacing: {{ $isRtl ? '0' : '1px' }}; color: #777; margin-bottom: 4px; font-weight: bold; }
        .value { font-size: 14px; color: #111; line-height: 1.5; }
        .msg-box { background: #f9f9f9; border-{{ $isRtl ? 'right' : 'left' }}: 3px solid #000; padding: 14px 18px; margin: 20px 0; font-size: 14px; line-height: 1.6; white-space: pre-wrap; }
        .foot { padding: 16px 28px; font-size: 11px; color: #999; border-top: 1px solid #eee; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="head">
            <h1>{{ __('emails.contact_message.banner') }}</h1>
        </div>
        <div class="body">
            <div class="field">
                <div class="label">{{ __('emails.contact_message.from') }}</div>
                <div class="value"><strong>{{ $msg->name }}</strong> &lt;{{ $msg->email }}&gt;</div>
            </div>

            @if ($msg->phone)
            <div class="field">
                <div class="label">{{ __('emails.contact_message.phone') }}</div>
                <div class="value" dir="ltr" style="display:inline-block;">{{ $msg->phone }}</div>
            </div>
            @endif

            @if ($msg->subject)
            <div class="field">
                <div class="label">{{ __('emails.contact_message.subject') }}</div>
                <div class="value"><strong>{{ $msg->subject }}</strong></div>
            </div>
            @endif

            <div class="field">
                <div class="label">{{ __('emails.contact_message.message') }}</div>
                <div class="msg-box">{{ $msg->message }}</div>
            </div>

            <p style="font-size: 13px; color: #666; margin-top: 24px;">
                {!! __('emails.contact_message.reply_note', ['email' => e($msg->email)]) !!}
            </p>
        </div>
        <div class="foot">
            {{ __('emails.contact_message.footer', ['date' => $msg->created_at?->format('d M Y, H:i') ?? now()->format('d M Y, H:i')]) }}
        </div>
    </div>
</body>
</html>
