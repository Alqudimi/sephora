<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class ZainCashGateway implements PaymentGateway
{
    public function name(): string
    {
        return 'zaincash';
    }

    /**
     * Retrieve a configuration value with dynamic fallback:
     * 1. Setting database table (Admin Panel)
     * 2. config('payments.zaincash.*')
     * 3. Provided default value
     */
    public function setting(string $key, $default = null): mixed
    {
        $adminValue = Setting::get("zaincash_{$key}");

        if ($adminValue !== null && $adminValue !== '') {
            return $adminValue;
        }

        return config("payments.zaincash.{$key}", $default);
    }

    public function isEnabled(): bool
    {
        $enabled = $this->setting('enabled');

        if ($enabled !== null && $enabled !== '') {
            return filter_var($enabled, FILTER_VALIDATE_BOOLEAN);
        }

        return (bool) config('payments.methods.zaincash.enabled', false);
    }

    public function mode(): string
    {
        return (string) $this->setting('mode', 'uat');
    }

    public function apiVersion(): string
    {
        return (string) $this->setting('api_version', 'v2');
    }

    public function exchangeRate(): float
    {
        $rate = (float) $this->setting('exchange_rate', 355.0);

        return $rate > 0 ? $rate : 355.0;
    }

    public function language(): string
    {
        return (string) $this->setting('language', 'ar');
    }

    public function merchantId(): string
    {
        return (string) $this->setting('merchant_id', '');
    }

    public function secret(): string
    {
        return (string) $this->setting('secret', '');
    }

    public function msisdn(): string
    {
        return (string) $this->setting('msisdn', '');
    }

    public function clientId(): string
    {
        return (string) $this->setting('client_id', '');
    }

    public function clientSecret(): string
    {
        return (string) $this->setting('client_secret', '');
    }

    /**
     * Convert an AED order total to Iraqi Dinars (IQD).
     */
    public function toIqd(float $aedAmount): int
    {
        return (int) round($aedAmount * $this->exchangeRate());
    }

    /**
     * Determine the base URL based on API version and mode.
     */
    public function baseUrl(): string
    {
        $version = $this->apiVersion();
        $mode = $this->mode();

        if ($version === 'v2') {
            return $mode === 'production'
                ? 'https://pg-api.zaincash.iq'
                : 'https://pg-api-uat.zaincash.iq';
        }

        return $mode === 'production'
            ? 'https://api.zaincash.iq'
            : 'https://test.zaincash.iq';
    }

    /**
     * Create the provider-side payment session. Returns either a redirect URL
     * (hosted checkout) or a final paid/failed result.
     */
    public function start(Order $order): PaymentResult
    {
        if ($this->apiVersion() === 'v2') {
            return $this->startV2($order);
        }

        return $this->startV1($order);
    }

    /**
     * Start transaction using ZainCash API v2 (OAuth2 + REST).
     */
    private function startV2(Order $order): PaymentResult
    {
        $clientId = $this->clientId();
        $clientSecret = $this->clientSecret();

        if ($clientId === '' || $clientSecret === '') {
            throw new RuntimeException(
                'ZainCash v2 credentials are not configured. Please set Client ID and Client Secret in Admin Settings.'
            );
        }

        $token = $this->getOAuth2Token();
        $amountIqd = $this->toIqd((float) $order->total);
        $returnUrl = route('checkout.payment.return', ['order' => $order->order_number]);

        $payload = [
            'amount' => $amountIqd,
            'service_type' => 'Order Payment',
            'order_id' => $order->order_number,
            'redirect_url' => $returnUrl,
            'description' => "Sephora UAE Order #{$order->order_number} (IQD {$amountIqd})",
        ];

        $response = Http::withToken($token)
            ->acceptJson()
            ->timeout(20)
            ->post($this->baseUrl().'/api/v2/payment-gateway/transaction/init', $payload);

        if ($response->failed()) {
            Log::error('ZainCash v2 transaction initiation failed.', [
                'order' => $order->order_number,
                'status' => $response->status(),
                'body' => $response->json() ?? $response->body(),
            ]);

            throw new RuntimeException('ZainCash gateway rejected transaction initialization: '.$response->body());
        }

        $data = $response->json();
        $transactionId = (string) ($data['id'] ?? $data['transaction_id'] ?? '');
        $redirectUrl = (string) ($data['redirect_url'] ?? $data['url'] ?? '');

        if ($redirectUrl === '') {
            throw new RuntimeException('ZainCash did not return a valid redirect URL.');
        }

        return new PaymentResult(
            paid: false,
            redirectUrl: $redirectUrl,
            reference: $transactionId,
            gateway: $this->name(),
            payload: [
                'amount_iqd' => $amountIqd,
                'exchange_rate' => $this->exchangeRate(),
                'version' => 'v2',
                'raw' => $data,
            ],
        );
    }

    /**
     * Start transaction using ZainCash API v1 (JWT HS256).
     */
    private function startV1(Order $order): PaymentResult
    {
        $merchantId = $this->merchantId();
        $secret = $this->secret();
        $msisdn = $this->msisdn();

        if ($merchantId === '' || $secret === '') {
            throw new RuntimeException(
                'ZainCash v1 credentials are not configured. Please set Merchant ID and Secret in Admin Settings.'
            );
        }

        $amountIqd = $this->toIqd((float) $order->total);
        $returnUrl = route('checkout.payment.return', ['order' => $order->order_number]);

        $jwtData = [
            'amount' => $amountIqd,
            'serviceType' => 'Order Payment',
            'msisdn' => $msisdn,
            'orderId' => $order->order_number,
            'redirectUrl' => $returnUrl,
            'iat' => time(),
            'exp' => time() + (60 * 60 * 4),
        ];

        $jwtToken = $this->encodeJwt($jwtData, $secret);

        $response = Http::asJson()
            ->acceptJson()
            ->timeout(20)
            ->post($this->baseUrl().'/transaction/init', [
                'token' => $jwtToken,
                'merchantId' => $merchantId,
                'lang' => $this->language(),
            ]);

        if ($response->failed()) {
            Log::error('ZainCash v1 transaction initiation failed.', [
                'order' => $order->order_number,
                'status' => $response->status(),
                'body' => $response->json() ?? $response->body(),
            ]);

            throw new RuntimeException('ZainCash v1 gateway rejected transaction initialization: '.$response->body());
        }

        $data = $response->json();
        $transactionId = (string) ($data['id'] ?? '');

        if ($transactionId === '') {
            throw new RuntimeException('ZainCash v1 did not return a valid transaction id.');
        }

        $redirectUrl = $this->baseUrl().'/transaction/pay?id='.$transactionId;

        return new PaymentResult(
            paid: false,
            redirectUrl: $redirectUrl,
            reference: $transactionId,
            gateway: $this->name(),
            payload: [
                'amount_iqd' => $amountIqd,
                'exchange_rate' => $this->exchangeRate(),
                'version' => 'v1',
                'raw' => $data,
            ],
        );
    }

    /**
     * Retrieve an OAuth2 Bearer token for API v2 with caching.
     */
    public function getOAuth2Token(): string
    {
        $clientId = $this->clientId();
        $clientSecret = $this->clientSecret();
        $cacheKey = 'zaincash_oauth2_token_'.md5($clientId.$this->mode());

        $cachedToken = Cache::get($cacheKey);
        if (is_string($cachedToken) && $cachedToken !== '') {
            return $cachedToken;
        }

        $response = Http::asForm()
            ->acceptJson()
            ->timeout(15)
            ->post($this->baseUrl().'/oauth2/token', [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'grant_type' => 'client_credentials',
            ]);

        if ($response->failed()) {
            Log::error('ZainCash OAuth2 token request failed.', [
                'status' => $response->status(),
                'body' => $response->json() ?? $response->body(),
            ]);

            throw new RuntimeException('Failed to authenticate with ZainCash API: '.$response->body());
        }

        $data = $response->json();
        $token = (string) ($data['access_token'] ?? '');
        $expiresIn = (int) ($data['expires_in'] ?? 3600);

        if ($token === '') {
            throw new RuntimeException('ZainCash returned an empty OAuth2 token.');
        }

        Cache::put($cacheKey, $token, max(60, $expiresIn - 120));

        return $token;
    }

    /**
     * Confirm authoritative payment status with ZainCash servers.
     */
    public function confirm(Order $order): PaymentResult
    {
        $request = request();
        $token = (string) $request->input('token', '');
        $statusParam = strtolower((string) $request->input('status', ''));
        $reference = (string) ($order->payment_reference ?: $request->input('id', ''));

        // If a JWT token was passed back in query params (standard ZainCash callback flow)
        $decoded = null;
        if ($token !== '' && $this->secret() !== '') {
            $decoded = $this->decodeJwt($token, $this->secret());
        }

        if ($decoded !== null) {
            $decodedStatus = strtolower((string) ($decoded['status'] ?? ''));
            $decodedOrder = (string) ($decoded['orderid'] ?? $decoded['order_id'] ?? $decoded['orderId'] ?? '');

            if ($decodedOrder !== '' && $decodedOrder !== $order->order_number) {
                Log::warning('ZainCash callback order mismatch.', [
                    'order' => $order->order_number,
                    'decoded_order' => $decodedOrder,
                ]);

                return new PaymentResult(paid: false, gateway: $this->name());
            }

            if ($decodedStatus === 'success') {
                return new PaymentResult(
                    paid: true,
                    reference: (string) ($decoded['id'] ?? $reference),
                    gateway: $this->name(),
                    payload: $decoded,
                );
            }

            if (in_array($decodedStatus, ['failed', 'canceled', 'cancelled'], true)) {
                return new PaymentResult(paid: false, reference: $reference, gateway: $this->name(), payload: $decoded);
            }
        }

        // For API v2, perform direct authoritative inquiry
        if ($this->apiVersion() === 'v2' && $reference !== '' && $this->clientId() !== '') {
            return $this->inquireV2($reference, $order);
        }

        // Handle explicit query status if verified
        if ($statusParam === 'success') {
            return new PaymentResult(paid: true, reference: $reference, gateway: $this->name());
        }

        return new PaymentResult(paid: false, reference: $reference, gateway: $this->name());
    }

    /**
     * Inquire transaction status directly via v2 REST API.
     */
    public function inquireV2(string $transactionId, ?Order $order = null): PaymentResult
    {
        try {
            $token = $this->getOAuth2Token();
            $response = Http::withToken($token)
                ->acceptJson()
                ->timeout(15)
                ->get($this->baseUrl().'/api/v2/payment-gateway/transaction/'.$transactionId);

            if ($response->successful()) {
                $data = $response->json();
                $status = strtolower((string) ($data['status'] ?? ''));
                $paid = in_array($status, ['success', 'completed', 'paid'], true);

                return new PaymentResult(
                    paid: $paid,
                    reference: $transactionId,
                    gateway: $this->name(),
                    payload: is_array($data) ? $data : [],
                );
            }
        } catch (\Throwable $e) {
            Log::warning('ZainCash v2 transaction inquiry error.', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage(),
            ]);
        }

        return new PaymentResult(paid: false, reference: $transactionId, gateway: $this->name());
    }

    /**
     * Verify and decode a provider webhook.
     */
    public function verifyWebhook(Request $request): ?array
    {
        $secret = $this->secret();

        // 1. Check if token is passed in JSON payload or query
        $token = $request->input('token');
        if (is_string($token) && $token !== '' && $secret !== '') {
            $decoded = $this->decodeJwt($token, $secret);
            if ($decoded !== null) {
                return [
                    'id' => (string) ($decoded['id'] ?? uniqid('zc_evt_')),
                    'type' => 'zaincash.payment.'.strtolower((string) ($decoded['status'] ?? 'unknown')),
                    'status' => strtolower((string) ($decoded['status'] ?? '')),
                    'order_id' => (string) ($decoded['orderid'] ?? $decoded['order_id'] ?? $decoded['orderId'] ?? ''),
                    'reference' => (string) ($decoded['id'] ?? ''),
                    'amount' => $decoded['amount'] ?? null,
                    'raw' => $decoded,
                ];
            }
        }

        // 2. Check HMAC signature header (e.g., X-ZainCash-Signature or X-Signature)
        $signature = (string) ($request->header('X-ZainCash-Signature') ?: $request->header('X-Signature', ''));
        $content = $request->getContent();

        if ($signature !== '' && $secret !== '' && $content !== '') {
            $expected = hash_hmac('sha256', $content, $secret);
            if (! hash_equals($expected, $signature)) {
                Log::warning('ZainCash webhook signature mismatch.');

                return null;
            }

            $payload = json_decode($content, true);
            if (is_array($payload)) {
                return [
                    'id' => (string) ($payload['id'] ?? $payload['transaction_id'] ?? uniqid('zc_evt_')),
                    'type' => 'zaincash.payment.'.strtolower((string) ($payload['status'] ?? 'unknown')),
                    'status' => strtolower((string) ($payload['status'] ?? '')),
                    'order_id' => (string) ($payload['order_id'] ?? $payload['orderId'] ?? ''),
                    'reference' => (string) ($payload['id'] ?? $payload['transaction_id'] ?? ''),
                    'amount' => $payload['amount'] ?? null,
                    'raw' => $payload,
                ];
            }
        }

        // 3. Raw payload if no secret configured (e.g. testing)
        $raw = $request->json()->all();
        if (! empty($raw['order_id']) || ! empty($raw['orderId']) || ! empty($raw['id'])) {
            return [
                'id' => (string) ($raw['id'] ?? uniqid('zc_evt_')),
                'type' => 'zaincash.payment.'.strtolower((string) ($raw['status'] ?? 'unknown')),
                'status' => strtolower((string) ($raw['status'] ?? '')),
                'order_id' => (string) ($raw['order_id'] ?? $raw['orderId'] ?? ''),
                'reference' => (string) ($raw['id'] ?? ''),
                'amount' => $raw['amount'] ?? null,
                'raw' => $raw,
            ];
        }

        return null;
    }

    /**
     * Standard JWT HS256 Encoder.
     */
    public function encodeJwt(array $payload, string $secret): string
    {
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];

        $b64Header = $this->base64UrlEncode((string) json_encode($header));
        $b64Payload = $this->base64UrlEncode((string) json_encode($payload));

        $signature = hash_hmac('sha256', "{$b64Header}.{$b64Payload}", $secret, true);
        $b64Signature = $this->base64UrlEncode($signature);

        return "{$b64Header}.{$b64Payload}.{$b64Signature}";
    }

    /**
     * Standard JWT HS256 Decoder with signature verification.
     */
    public function decodeJwt(string $jwt, string $secret): ?array
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            return null;
        }

        [$b64Header, $b64Payload, $b64Signature] = $parts;

        $expectedSig = hash_hmac('sha256', "{$b64Header}.{$b64Payload}", $secret, true);
        $actualSig = $this->base64UrlDecode($b64Signature);

        if (! hash_equals($expectedSig, $actualSig)) {
            Log::warning('ZainCash JWT signature mismatch.');

            return null;
        }

        $payloadJson = $this->base64UrlDecode($b64Payload);
        $payload = json_decode($payloadJson, true);

        return is_array($payload) ? $payload : null;
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $data): string
    {
        return base64_decode(strtr($data, '-_', '+/').str_repeat('=', (4 - strlen($data) % 4) % 4));
    }
}

