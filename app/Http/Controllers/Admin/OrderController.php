<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Order;
use App\Services\Orders\OrderStateMachine;
use Illuminate\Http\Request;
use InvalidArgumentException;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Order::class);

        $orders = Order::with('items')
            ->when($request->input('status'), fn ($q, $s) => $q->where('status', $s))
            ->when($request->input('q'), fn ($q, $t) => $q->where('order_number', 'like', "%{$t}%"))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        return view('admin.order-detail', ['order' => $order->load('items')]);
    }

    /**
     * Move an order through the fulfilment state machine.
     *
     * Cancelling or refunding restores stock exactly once (see
     * OrderStateMachine::restockOnce). Every change is audit-logged so
     * finance and support can reconstruct who did what.
     */
    public function updateStatus(Request $request, Order $order, OrderStateMachine $states)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,out_for_delivery,delivered,cancelled,refunded',
            'payment_status' => 'nullable|in:pending,paid,failed,refunded',
            'cancel_reason' => 'nullable|string|max:500',
            'refund_amount' => 'nullable|numeric|min:0|max:'.$order->total,
            'refund_reference' => 'nullable|string|max:190',
        ]);

        $this->authorize('updateStatus', $order);

        if ($validated['status'] === 'refunded' || ($validated['payment_status'] ?? null) === 'refunded') {
            $this->authorize('refund', $order);
        }

        $old = $order->only([
            'status', 'payment_status', 'cancel_reason',
            'refund_amount', 'refund_reference',
        ]);

        try {
            if ($validated['status'] !== $order->status) {
                $attributes = [];

                if ($validated['status'] === 'cancelled' && filled($validated['cancel_reason'] ?? null)) {
                    $attributes['cancel_reason'] = $validated['cancel_reason'];
                }

                if ($validated['status'] === 'refunded') {
                    $attributes['refund_amount'] = $validated['refund_amount'] ?? $order->total;

                    if (filled($validated['refund_reference'] ?? null)) {
                        $attributes['refund_reference'] = $validated['refund_reference'];
                    }
                }

                $order = $states->transition($order, $validated['status'], $attributes);
            }

            $paymentStatus = $validated['status'] === 'refunded'
                ? 'refunded'
                : ($validated['payment_status'] ?? null);

            if ($paymentStatus && $paymentStatus !== $order->payment_status) {
                $order->forceFill(['payment_status' => $paymentStatus])->save();
            }
        } catch (InvalidArgumentException $exception) {
            return back()->withInput()->withErrors(['status' => $exception->getMessage()]);
        }

        $order->refresh();

        AuditLog::create([
            'user_id' => $request->user()?->id,
            'action' => 'order.status.updated',
            'auditable_type' => $order->getMorphClass(),
            'auditable_id' => $order->getKey(),
            'description' => "Order {$order->order_number}: {$old['status']} -> {$order->status}",
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
            'old_values' => $old,
            'new_values' => $order->only(array_keys($old)),
        ]);

        return back()->with('status_saved', true);
    }
}
