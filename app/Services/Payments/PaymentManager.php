<?php

namespace App\Services\Payments;

use App\Models\Order;
use Illuminate\Http\Request;
use RuntimeException;

class PaymentManager
{
    public function __construct(
        private readonly FakeGateway $fake,
        private readonly StripeGateway $stripe,
        private readonly CodGateway $cod,
        private readonly ZainCashGateway $zaincash,
    ) {}

    public function isEnabled(string $method): bool
    {
        if ($method === 'zaincash') {
            return $this->zaincash->isEnabled();
        }

        return (bool) config("payments.methods.{$method}.enabled", false);
    }

    public function enabledMethods(): array
    {
        return collect(config('payments.methods', []))
            ->filter(fn (array $method, string $key) => $this->isEnabled($key))
            ->keys()
            ->all();
    }

    public function gatewayFor(string $method): PaymentGateway
    {
        if (! $this->isEnabled($method)) {
            throw new RuntimeException("Payment method [{$method}] is not available.");
        }

        $configured = (string) config("payments.methods.{$method}.gateway", '');
        $driver = (string) config('payments.driver', 'fake');

        if ($configured === 'cod') {
            return $this->cod;
        }

        if ($configured === 'zaincash') {
            if ($driver === 'fake' && config('payments.zaincash.use_fake_driver', false)) {
                return $this->fake;
            }

            return $this->zaincash;
        }

        if ($driver === 'fake') {
            return $this->fake;
        }

        if ($driver === 'stripe' && in_array($configured, ['stripe'], true)) {
            return $this->stripe;
        }

        throw new RuntimeException("No payment gateway is configured for [{$method}].");
    }

    public function start(Order $order): PaymentResult
    {
        return $this->gatewayFor($order->payment_method)->start($order);
    }

    public function confirm(Order $order): PaymentResult
    {
        return $this->gatewayFor($order->payment_method)->confirm($order);
    }

    public function verifyWebhook(string $gateway, Request $request): ?array
    {
        return match ($gateway) {
            'stripe' => $this->stripe->verifyWebhook($request),
            'zaincash' => $this->zaincash->verifyWebhook($request),
            default => null,
        };
    }
}
