<?php

namespace App\Services\Payments;

use App\Models\Order;
use Illuminate\Http\Request;

class FakeGateway implements PaymentGateway
{
    public function name(): string
    {
        return 'fake';
    }

    public function start(Order $order): PaymentResult
    {
        return new PaymentResult(
            paid: (bool) config('payments.fake.auto_succeed', true),
            reference: 'FAKE-'.$order->order_number,
            gateway: $this->name(),
            payload: ['simulated' => true],
        );
    }

    public function confirm(Order $order): PaymentResult
    {
        return new PaymentResult(
            paid: (bool) config('payments.fake.auto_succeed', true),
            reference: $order->payment_reference ?: 'FAKE-'.$order->order_number,
            gateway: $this->name(),
            payload: ['simulated' => true, 'confirmed' => true],
        );
    }

    public function verifyWebhook(Request $request): ?array
    {
        return null;
    }
}
