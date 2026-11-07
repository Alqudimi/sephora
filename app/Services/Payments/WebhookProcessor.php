<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Models\PaymentWebhookEvent;
use App\Services\Orders\OrderStateMachine;

/**
 * Shared gateway-webhook processing: used by the storefront webhook
 * endpoint and by the admin "reprocess" action so an event can never
 * be applied twice.
 */
class WebhookProcessor
{
    public function __construct(private readonly OrderStateMachine $states) {}

    /**
     * @return array{ok: bool, duplicate: bool, order_number: ?string, applied: bool}
     */
    public function process(PaymentWebhookEvent $event): array
    {
        if ($event->processed_at !== null) {
            return ['ok' => true, 'duplicate' => true, 'order_number' => null, 'applied' => false];
        }

        $type = (string) ($event->type ?? '');
        $object = $event->payload['data']['object'] ?? [];
        $object = is_array($object) ? $object : [];

        $orderNumber = $object['client_reference_id']
            ?? ($object['metadata']['order_number'] ?? null);
        $orderNumber = is_string($orderNumber) && $orderNumber !== '' ? $orderNumber : null;

        $applied = false;

        if ($orderNumber && in_array($type, ['checkout.session.completed', 'payment_intent.succeeded'], true)) {
            $order = Order::where('order_number', $orderNumber)->first();

            if ($order && $order->payment_status !== 'paid') {
                $this->states->markPaid(
                    $order,
                    $event->gateway,
                    (string) ($object['id'] ?? $object['payment_intent'] ?? ''),
                    $object,
                );

                $applied = true;
            }
        }

        $event->forceFill(['processed_at' => now()])->save();

        return [
            'ok' => true,
            'duplicate' => false,
            'order_number' => $orderNumber,
            'applied' => $applied,
        ];
    }
}
