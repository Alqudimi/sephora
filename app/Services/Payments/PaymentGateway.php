<?php

namespace App\Services\Payments;

use App\Models\Order;
use Illuminate\Http\Request;

interface PaymentGateway
{
    public function name(): string;

    /**
     * Create the provider-side payment session. Returns either a redirect URL
     * (hosted checkout) or a final paid/failed result.
     */
    public function start(Order $order): PaymentResult;

    /**
     * Ask the provider for the authoritative status of a started payment.
     * Used on the return URL so a forged ?status=success cannot mark an order
     * paid.
     */
    public function confirm(Order $order): PaymentResult;

    /**
     * Verify and decode a provider webhook. Returns null when the request is
     * not a valid event. Implementations must verify signatures.
     */
    public function verifyWebhook(Request $request): ?array;
}
