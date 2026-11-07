<?php

namespace App\Services\Payments;

use App\Models\Order;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class StripeGateway implements PaymentGateway
{
    public function name(): string
    {
        return 'stripe';
    }

    public function start(Order $order): PaymentResult
    {
        $secret = (string) config('payments.stripe.secret');

        if ($secret === '') {
            throw new RuntimeException(
                'Stripe is not configured. Set STRIPE_SECRET or switch PAYMENT_DRIVER=fake for local development.'
            );
        }

        $payload = [
            'mode' => 'payment',
            'success_url' => $this->successUrl($order),
            'cancel_url' => $this->cancelUrl($order),
            'customer_email' => $order->customer_email ?: $order->guest_email,
            'client_reference_id' => $order->order_number,
            'metadata[order_number]' => $order->order_number,
            'metadata[order_id]' => (string) $order->id,
            'line_items[0][quantity]' => 1,
            'line_items[0][price_data][currency]' => strtolower((string) config('payments.currency', 'AED')),
            'line_items[0][price_data][unit_amount]' => (int) round($order->total * 100),
            'line_items[0][price_data][product_data][name]' => 'Sephora UAE order '.$order->order_number,
            'line_items[0][price_data][product_data][description]' => 'Beauty products and delivery',
            'payment_intent_data[metadata][order_number]' => $order->order_number,
        ];

        $response = $this->client($secret)
            ->asForm()
            ->post($this->baseUrl().'/v1/checkout/sessions', $payload);

        if ($response->failed()) {
            Log::error('Stripe Checkout Session creation failed.', [
                'order' => $order->order_number,
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            throw new RuntimeException('The payment provider rejected the request. Please try again.');
        }

        $session = $response->json();

        return new PaymentResult(
            paid: false,
            redirectUrl: $session['url'] ?? null,
            reference: $session['id'] ?? null,
            gateway: $this->name(),
            payload: $session,
        );
    }

    public function confirm(Order $order): PaymentResult
    {
        $secret = (string) config('payments.stripe.secret');
        $reference = (string) $order->payment_reference;

        if ($secret === '' || $reference === '') {
            return new PaymentResult(paid: false, gateway: $this->name());
        }

        $response = $this->client($secret)
            ->get($this->baseUrl().'/v1/checkout/sessions/'.urlencode($reference));

        if ($response->failed()) {
            Log::warning('Stripe session confirmation failed.', [
                'order' => $order->order_number,
                'status' => $response->status(),
            ]);

            return new PaymentResult(paid: false, gateway: $this->name());
        }

        $session = $response->json();
        $paid = ($session['payment_status'] ?? null) === 'paid';

        return new PaymentResult(
            paid: $paid,
            reference: $reference,
            gateway: $this->name(),
            payload: is_array($session) ? $session : [],
        );
    }

    public function verifyWebhook(Request $request): ?array
    {
        $secret = (string) config('payments.stripe.webhook_secret');
        $signature = (string) $request->header('Stripe-Signature', '');
        $payload = $request->getContent();

        if ($secret === '' || $signature === '' || $payload === '') {
            return null;
        }

        $timestamp = null;
        $signatures = [];

        // Stripe may send multiple v1 signatures during secret rotation, so
        // collect every value instead of collapsing them into one map entry.
        foreach (explode(',', $signature) as $part) {
            [$key, $value] = array_pad(explode('=', trim($part), 2), 2, null);

            if ($key === 't' && $value !== null) {
                $timestamp = $value;
            } elseif ($key === 'v1' && $value !== null && $value !== '') {
                $signatures[] = $value;
            }
        }

        if ($timestamp === null || ! ctype_digit($timestamp) || $signatures === []) {
            Log::warning('Stripe webhook signature header is malformed.');

            return null;
        }

        $tolerance = (int) config('payments.stripe.webhook_tolerance', 300);

        if ($tolerance > 0 && abs(time() - (int) $timestamp) > $tolerance) {
            Log::warning('Stripe webhook timestamp is outside the allowed tolerance.', [
                'timestamp' => $timestamp,
            ]);

            return null;
        }

        $expected = hash_hmac('sha256', $timestamp.'.'.$payload, $secret);

        $valid = collect($signatures)->contains(
            fn (string $candidate) => hash_equals($expected, $candidate)
        );

        if (! $valid) {
            Log::warning('Stripe webhook signature mismatch.');

            return null;
        }

        $event = json_decode($payload, true);

        return is_array($event) ? $event : null;
    }

    private function client(string $secret): PendingRequest
    {
        return Http::withToken($secret)
            ->acceptJson()
            ->timeout(15);
    }

    private function baseUrl(): string
    {
        return rtrim((string) config('payments.stripe.base_url', 'https://api.stripe.com'), '/');
    }

    private function successUrl(Order $order): string
    {
        return (string) (config('payments.stripe.success_url')
            ?: route('checkout.payment.return', ['order' => $order->order_number]).'?status=success');
    }

    private function cancelUrl(Order $order): string
    {
        return (string) (config('payments.stripe.cancel_url')
            ?: route('checkout.payment.return', ['order' => $order->order_number]).'?status=cancelled');
    }
}
