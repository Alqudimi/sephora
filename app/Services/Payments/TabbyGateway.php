<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class TabbyGateway implements PaymentGateway
{
    public function name(): string
    {
        return 'tabby';
    }

    public function isEnabled(): bool
    {
        $override = Setting::get('tabby_enabled');
        if ($override !== null && $override !== '') {
            return filter_var($override, FILTER_VALIDATE_BOOLEAN);
        }

        return (bool) config('payments.tabby.enabled', false);
    }

    public function start(Order $order): PaymentResult
    {
        $secretKey = $this->secretKey();

        if ($secretKey === '') {
            throw new RuntimeException(
                'Tabby is not configured. Configure Tabby Secret Key in Admin Settings.'
            );
        }

        $items = [];
        foreach ($order->items as $item) {
            $items[] = [
                'title' => (string) $item->product_name,
                'description' => (string) ($item->shade_name ?? 'Beauty Item'),
                'quantity' => (int) $item->quantity,
                'unit_price' => number_format((float) $item->unit_price, 2, '.', ''),
                'category' => 'Cosmetics & Beauty',
                'reference_id' => (string) ($item->product_id ?? $item->id),
            ];
        }

        if ($items === []) {
            $items[] = [
                'title' => 'Sephora UAE Order '.$order->order_number,
                'quantity' => 1,
                'unit_price' => number_format((float) $order->total, 2, '.', ''),
                'category' => 'Cosmetics & Beauty',
                'reference_id' => $order->order_number,
            ];
        }

        $payload = [
            'payment' => [
                'amount' => number_format((float) $order->total, 2, '.', ''),
                'currency' => (string) config('payments.currency', 'AED'),
                'description' => 'Sephora UAE Order '.$order->order_number,
                'buyer' => [
                    'phone' => (string) $order->customer_phone,
                    'email' => (string) ($order->customer_email ?: $order->guest_email),
                    'name' => (string) $order->customer_name,
                ],
                'shipping_address' => [
                    'city' => (string) ($order->emirate ?? 'Dubai'),
                    'address' => (string) ($order->shipping_address ?? 'UAE'),
                    'zip' => '00000',
                ],
                'order' => [
                    'tax_amount' => number_format((float) $order->tax_amount, 2, '.', ''),
                    'shipping_amount' => number_format((float) $order->shipping_fee, 2, '.', ''),
                    'discount_amount' => number_format((float) $order->discount, 2, '.', ''),
                    'reference_id' => $order->order_number,
                    'items' => $items,
                ],
                'buyer_history' => [
                    'registered_since' => $order->user?->created_at?->toIso8601String() ?? now()->toIso8601String(),
                    'loyalty_level' => (int) ($order->user?->loyalty_points ?? 0),
                ],
            ],
            'lang' => 'ar',
            'merchant_code' => $this->merchantCode(),
            'merchant_urls' => [
                'success' => route('checkout.payment.return', ['order' => $order->order_number]).'?gateway=tabby&status=success',
                'cancel' => route('checkout.payment.return', ['order' => $order->order_number]).'?gateway=tabby&status=cancel',
                'failure' => route('checkout.payment.return', ['order' => $order->order_number]).'?gateway=tabby&status=failure',
            ],
        ];

        $response = $this->client($secretKey)
            ->post($this->baseUrl().'/api/v2/checkout', $payload);

        if ($response->failed()) {
            Log::error('Tabby checkout initialization failed.', [
                'order' => $order->order_number,
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            throw new RuntimeException('Tabby rejected the checkout request. Please try another payment method.');
        }

        $data = $response->json();
        $redirectUrl = $data['configuration']['available_products']['installments'][0]['web_url']
            ?? ($data['configuration']['products']['installments']['web_url'] ?? null);

        $sessionId = (string) ($data['id'] ?? '');

        return new PaymentResult(
            paid: false,
            redirectUrl: $redirectUrl,
            reference: $sessionId,
            gateway: $this->name(),
            payload: is_array($data) ? $data : [],
        );
    }

    public function confirm(Order $order): PaymentResult
    {
        $secretKey = $this->secretKey();
        $reference = (string) $order->payment_reference;

        if ($secretKey === '' || $reference === '') {
            return new PaymentResult(paid: false, gateway: $this->name());
        }

        $response = $this->client($secretKey)
            ->get($this->baseUrl().'/api/v2/payments/'.urlencode($reference));

        if ($response->failed()) {
            // Also attempt checkout session check if payment inquiry failed
            $sessionResp = $this->client($secretKey)
                ->get($this->baseUrl().'/api/v2/checkout/'.urlencode($reference));

            if ($sessionResp->failed()) {
                return new PaymentResult(paid: false, gateway: $this->name());
            }

            $data = $sessionResp->json();
            $status = strtolower((string) ($data['status'] ?? ''));
            $paid = in_array($status, ['authorized', 'closed', 'complete', 'succeeded'], true);

            return new PaymentResult(
                paid: $paid,
                reference: $reference,
                gateway: $this->name(),
                payload: is_array($data) ? $data : [],
            );
        }

        $data = $response->json();
        $status = strtolower((string) ($data['status'] ?? ''));
        $paid = in_array($status, ['authorized', 'closed'], true);

        return new PaymentResult(
            paid: $paid,
            reference: $reference,
            gateway: $this->name(),
            payload: is_array($data) ? $data : [],
        );
    }

    public function verifyWebhook(Request $request): ?array
    {
        $signature = (string) $request->header('X-Signature', '');
        $secretKey = $this->secretKey();
        $content = $request->getContent();

        if ($secretKey !== '' && $signature !== '' && $content !== '') {
            $expected = hash_hmac('sha256', $content, $secretKey);
            if (! hash_equals($expected, $signature)) {
                Log::warning('Tabby webhook signature verification failed.');
                return null;
            }
        }

        $payload = $request->json()->all();

        return is_array($payload) && $payload !== [] ? $payload : null;
    }

    private function client(string $secret): PendingRequest
    {
        return Http::withToken($secret)
            ->acceptJson()
            ->timeout(20);
    }

    private function baseUrl(): string
    {
        return 'https://api.tabby.ai';
    }

    public function secretKey(): string
    {
        $admin = Setting::get('tabby_secret_key');

        return is_string($admin) && $admin !== '' ? $admin : (string) config('payments.tabby.secret_key', '');
    }

    public function publicKey(): string
    {
        $admin = Setting::get('tabby_public_key');

        return is_string($admin) && $admin !== '' ? $admin : (string) config('payments.tabby.public_key', '');
    }

    public function merchantCode(): string
    {
        $admin = Setting::get('tabby_merchant_code');

        return is_string($admin) && $admin !== '' ? $admin : (string) config('payments.tabby.merchant_code', 'sephora_ae');
    }
}

