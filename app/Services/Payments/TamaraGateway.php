<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class TamaraGateway implements PaymentGateway
{
    public function name(): string
    {
        return 'tamara';
    }

    public function isEnabled(): bool
    {
        $override = Setting::get('tamara_enabled');
        if ($override !== null && $override !== '') {
            return filter_var($override, FILTER_VALIDATE_BOOLEAN);
        }

        return (bool) config('payments.tamara.enabled', false);
    }

    public function start(Order $order): PaymentResult
    {
        $apiToken = $this->apiToken();

        if ($apiToken === '') {
            throw new RuntimeException(
                'Tamara is not configured. Configure Tamara API Token in Admin Settings.'
            );
        }

        $items = [];
        foreach ($order->items as $item) {
            $items[] = [
                'reference_id' => (string) ($item->product_id ?? $item->id),
                'type' => 'Physical',
                'name' => (string) $item->product_name,
                'sku' => (string) ($item->shade_name ?? 'BEAUTY-SKU'),
                'quantity' => (int) $item->quantity,
                'total_amount' => [
                    'amount' => (float) $item->line_total,
                    'currency' => (string) config('payments.currency', 'AED'),
                ],
            ];
        }

        if ($items === []) {
            $items[] = [
                'reference_id' => $order->order_number,
                'type' => 'Physical',
                'name' => 'Sephora UAE Order '.$order->order_number,
                'sku' => 'ORDER-ITEMS',
                'quantity' => 1,
                'total_amount' => [
                    'amount' => (float) $order->total,
                    'currency' => (string) config('payments.currency', 'AED'),
                ],
            ];
        }

        $nameParts = explode(' ', (string) $order->customer_name, 2);
        $firstName = $nameParts[0] ?? 'Customer';
        $lastName = $nameParts[1] ?? 'Sephora';

        $payload = [
            'order_reference_id' => $order->order_number,
            'order_number' => $order->order_number,
            'total_amount' => [
                'amount' => (float) $order->total,
                'currency' => (string) config('payments.currency', 'AED'),
            ],
            'description' => 'Sephora UAE Order '.$order->order_number,
            'country_code' => 'AE',
            'payment_type' => 'PAY_BY_INSTALMENTS',
            'instalments' => 3,
            'consumer' => [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone_number' => (string) $order->customer_phone,
                'email' => (string) ($order->customer_email ?: $order->guest_email),
            ],
            'shipping_address' => [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'line1' => (string) ($order->shipping_address ?? 'UAE Address'),
                'city' => (string) ($order->emirate ?? 'Dubai'),
                'country_code' => 'AE',
            ],
            'billing_address' => [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'line1' => (string) ($order->shipping_address ?? 'UAE Address'),
                'city' => (string) ($order->emirate ?? 'Dubai'),
                'country_code' => 'AE',
            ],
            'tax_amount' => [
                'amount' => (float) $order->tax_amount,
                'currency' => (string) config('payments.currency', 'AED'),
            ],
            'shipping_amount' => [
                'amount' => (float) $order->shipping_fee,
                'currency' => (string) config('payments.currency', 'AED'),
            ],
            'merchant_url' => [
                'success' => route('checkout.payment.return', ['order' => $order->order_number]).'?gateway=tamara&status=success',
                'failure' => route('checkout.payment.return', ['order' => $order->order_number]).'?gateway=tamara&status=failure',
                'cancel' => route('checkout.payment.return', ['order' => $order->order_number]).'?gateway=tamara&status=cancel',
                'notification' => route('payments.webhook', ['gateway' => 'tamara']),
            ],
            'items' => $items,
        ];

        $response = $this->client($apiToken)
            ->post($this->baseUrl().'/checkout', $payload);

        if ($response->failed()) {
            Log::error('Tamara checkout initialization failed.', [
                'order' => $order->order_number,
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            throw new RuntimeException('Tamara rejected the checkout request. Please try another payment method.');
        }

        $data = $response->json();
        $checkoutUrl = $data['checkout_url'] ?? null;
        $orderId = (string) ($data['order_id'] ?? ($data['checkout_id'] ?? ''));

        return new PaymentResult(
            paid: false,
            redirectUrl: $checkoutUrl,
            reference: $orderId,
            gateway: $this->name(),
            payload: is_array($data) ? $data : [],
        );
    }

    public function confirm(Order $order): PaymentResult
    {
        $apiToken = $this->apiToken();
        $reference = (string) $order->payment_reference;

        if ($apiToken === '' || $reference === '') {
            return new PaymentResult(paid: false, gateway: $this->name());
        }

        $response = $this->client($apiToken)
            ->get($this->baseUrl().'/orders/'.urlencode($reference));

        if ($response->failed()) {
            return new PaymentResult(paid: false, gateway: $this->name());
        }

        $data = $response->json();
        $status = strtolower((string) ($data['status'] ?? ''));
        $paid = in_array($status, ['approved', 'authorised', 'captured', 'fully_captured'], true);

        return new PaymentResult(
            paid: $paid,
            reference: $reference,
            gateway: $this->name(),
            payload: is_array($data) ? $data : [],
        );
    }

    public function verifyWebhook(Request $request): ?array
    {
        $token = $request->bearerToken() ?? $request->header('tamara-token');
        $expectedToken = $this->notificationToken();

        if ($expectedToken !== '' && $token !== null) {
            if (! hash_equals($expectedToken, $token)) {
                Log::warning('Tamara webhook notification token mismatch.');
                return null;
            }
        }

        $payload = $request->json()->all();

        return is_array($payload) && $payload !== [] ? $payload : null;
    }

    private function client(string $token): PendingRequest
    {
        return Http::withToken($token)
            ->acceptJson()
            ->timeout(20);
    }

    private function baseUrl(): string
    {
        $mode = $this->mode();

        return $mode === 'production'
            ? 'https://api.tamara.co'
            : 'https://api-sandbox.tamara.co';
    }

    public function mode(): string
    {
        $admin = Setting::get('tamara_mode');

        return is_string($admin) && in_array($admin, ['sandbox', 'production'], true)
            ? $admin
            : (string) config('payments.tamara.mode', 'sandbox');
    }

    public function apiToken(): string
    {
        $admin = Setting::get('tamara_api_token');

        return is_string($admin) && $admin !== '' ? $admin : (string) config('payments.tamara.api_token', '');
    }

    public function notificationToken(): string
    {
        $admin = Setting::get('tamara_notification_token');

        return is_string($admin) && $admin !== '' ? $admin : (string) config('payments.tamara.notification_token', '');
    }

    public function publicKey(): string
    {
        $admin = Setting::get('tamara_public_key');

        return is_string($admin) && $admin !== '' ? $admin : (string) config('payments.tamara.public_key', '');
    }
}

