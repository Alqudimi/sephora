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

        if (! $orderNumber && $event->gateway === 'zaincash') {
            $candidate = $event->payload['order_id']
                ?? ($event->payload['orderId']
                ?? ($event->payload['orderid']
                ?? ($object['order_id'] ?? null)));
            $orderNumber = is_string($candidate) && $candidate !== '' ? $candidate : null;
        }

        if (! $orderNumber && $event->gateway === 'tabby') {
            $candidate = $event->payload['payment']['order']['reference_id']
                ?? ($event->payload['order']['reference_id']
                ?? ($event->payload['reference_id']
                ?? ($event->payload['order_id'] ?? null)));
            $orderNumber = is_string($candidate) && $candidate !== '' ? $candidate : null;
        }

        if (! $orderNumber && $event->gateway === 'tamara') {
            $candidate = $event->payload['order_reference_id']
                ?? ($event->payload['order_number']
                ?? ($event->payload['data']['order_reference_id'] ?? null));
            $orderNumber = is_string($candidate) && $candidate !== '' ? $candidate : null;
        }

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
        } elseif ($orderNumber && $event->gateway === 'zaincash') {
            $zcStatus = strtolower((string) ($event->payload['status'] ?? $object['status'] ?? ''));
            $zcPaid = in_array($zcStatus, ['success', 'completed', 'paid'], true)
                || str_ends_with($type, '.success');

            if ($zcPaid) {
                $order = Order::where('order_number', $orderNumber)->first();

                if ($order && $order->payment_status !== 'paid') {
                    $this->states->markPaid(
                        $order,
                        'zaincash',
                        (string) ($event->payload['reference'] ?? $event->payload['id'] ?? ''),
                        $event->payload,
                    );

                    $applied = true;
                }
            }
        } elseif ($orderNumber && $event->gateway === 'tabby') {
            $tabbyStatus = strtoupper((string) ($event->payload['status'] ?? ($event->payload['payment']['status'] ?? '')));
            $tabbyPaid = in_array($tabbyStatus, ['AUTHORIZED', 'CLOSED', 'SUCCEEDED'], true)
                || in_array($type, ['payment.authorized', 'payment.captured'], true);

            if ($tabbyPaid) {
                $order = Order::where('order_number', $orderNumber)->first();

                if ($order && $order->payment_status !== 'paid') {
                    $ref = (string) ($event->payload['id'] ?? ($event->payload['payment']['id'] ?? ''));
                    $this->states->markPaid(
                        $order,
                        'tabby',
                        $ref,
                        $event->payload,
                    );

                    $applied = true;
                }
            }
        } elseif ($orderNumber && $event->gateway === 'tamara') {
            $tamaraStatus = strtolower((string) ($event->payload['order_status'] ?? ($event->payload['data']['order_status'] ?? ($event->payload['status'] ?? ''))));
            $tamaraPaid = in_array($tamaraStatus, ['approved', 'authorised', 'captured', 'fully_captured'], true)
                || in_array($type, ['order_approved', 'order_captured'], true);

            if ($tamaraPaid) {
                $order = Order::where('order_number', $orderNumber)->first();

                if ($order && $order->payment_status !== 'paid') {
                    $ref = (string) ($event->payload['order_id'] ?? ($event->payload['data']['order_id'] ?? ''));
                    $this->states->markPaid(
                        $order,
                        'tamara',
                        $ref,
                        $event->payload,
                    );

                    $applied = true;
                }
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
