<?php

namespace App\Services\Payments;

use App\Models\Order;
use Illuminate\Http\Request;

class CodGateway implements PaymentGateway
{
    public function name(): string
    {
        return 'cod';
    }

    public function start(Order $order): PaymentResult
    {
        return new PaymentResult(
            paid: false,
            reference: null,
            gateway: $this->name(),
            payload: ['collect_on_delivery' => true],
        );
    }

    public function confirm(Order $order): PaymentResult
    {
        return new PaymentResult(
            paid: false,
            reference: null,
            gateway: $this->name(),
            payload: ['collect_on_delivery' => true],
        );
    }

    public function verifyWebhook(Request $request): ?array
    {
        return null;
    }
}
