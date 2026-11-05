<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class OrderStateMachine
{
    /**
     * Allowed forward transitions. Cancellation/refund transitions are
     * handled with explicit guards so money is never silently lost.
     */
    private const TRANSITIONS = [
        'pending' => ['processing', 'cancelled'],
        'processing' => ['shipped', 'cancelled'],
        'shipped' => ['out_for_delivery', 'delivered', 'cancelled'],
        'out_for_delivery' => ['delivered', 'cancelled'],
        'delivered' => ['refunded'],
        'cancelled' => ['refunded'],
        'refunded' => [],
    ];

    public function canTransition(Order $order, string $to): bool
    {
        return in_array($to, self::TRANSITIONS[$order->status] ?? [], true);
    }

    public function transition(Order $order, string $to, array $attributes = []): Order
    {
        return DB::transaction(function () use ($order, $to, $attributes) {
            $locked = Order::query()->lockForUpdate()->findOrFail($order->getKey());

            if (! $this->canTransition($locked, $to)) {
                throw new InvalidArgumentException(
                    "Order [{$locked->order_number}] cannot move from [{$locked->status}] to [{$to}]."
                );
            }

            $timestamps = match ($to) {
                'shipped' => ['shipped_at' => now()],
                'delivered' => ['delivered_at' => now()],
                'cancelled' => ['cancelled_at' => now()],
                'refunded' => ['refunded_at' => now()],
                default => [],
            };

            $locked->fill(array_merge($attributes, $timestamps, ['status' => $to]))->save();

            if (in_array($to, ['cancelled', 'refunded'], true)) {
                $this->restockOnce($locked);
            }

            return $locked->refresh();
        });
    }

    /**
     * Return every ordered unit to stock exactly once.
     *
     * The guard lives on the order row, so cancelling a delivered order and
     * then refunding it can never restock the same items twice.
     */
    private function restockOnce(Order $order): void
    {
        if ($order->stock_restored_at !== null) {
            return;
        }

        $items = $order->items()
            ->whereNotNull('product_id')
            ->orderBy('product_id')
            ->get();

        foreach ($items as $item) {
            $quantity = max(0, (int) $item->quantity);

            if ($quantity > 0) {
                Product::whereKey($item->product_id)->increment('stock', $quantity);
            }
        }

        $order->forceFill(['stock_restored_at' => now()])->save();
    }

    public function markPaid(Order $order, string $gateway, ?string $reference = null, array $payload = []): Order
    {
        $order->forceFill([
            'payment_status' => 'paid',
            'payment_gateway' => $gateway,
            'payment_reference' => $reference,
            'payment_payload' => $payload ?: null,
        ])->save();

        if ($order->status === 'pending') {
            $order->forceFill(['status' => 'processing'])->save();
        }

        return $order->refresh();
    }

    public function markFailed(Order $order, string $reason = ''): Order
    {
        $order->forceFill([
            'payment_status' => 'failed',
            'cancel_reason' => $reason ?: $order->cancel_reason,
        ])->save();

        return $order->refresh();
    }
}
