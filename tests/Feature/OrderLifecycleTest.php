<?php

namespace Tests\Feature;

use App\Filament\Resources\OrderResource\Pages\ViewOrder;
use App\Models\AuditLog;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\Orders\OrderStateMachine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Tests\TestCase;

class OrderLifecycleTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private function makeOrder(Product $product, int $quantity = 2, string $status = 'pending', string $paymentStatus = 'paid'): Order
    {
        $order = Order::create([
            'order_number' => 'AE-'.now()->format('ymd').'-'.str_pad((string) random_int(1, 999999), 6, '0', STR_PAD_LEFT),
            'status' => $status,
            'payment_method' => 'card',
            'payment_status' => $paymentStatus,
            'delivery_method' => 'standard',
            'customer_name' => 'Test Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'customer@example.com',
            'subtotal' => $product->price * $quantity,
            'total' => $product->price * $quantity,
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => $product->price,
            'quantity' => $quantity,
            'line_total' => $product->price * $quantity,
        ]);

        return $order;
    }

    private function admin(): User
    {
        return User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
            'two_factor_confirmed_at' => now(),
        ]);
    }

    public function test_cancelling_an_order_restores_stock_once(): void
    {
        $product = $this->makeProduct(['stock' => 48]);
        $order = $this->makeOrder($product, 2);
        $admin = $this->admin();

        $this->actingAs($admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('cancel', data: ['cancel_reason' => 'Customer changed their mind']);

        $order->refresh();

        $this->assertSame('cancelled', $order->status);
        $this->assertSame('Customer changed their mind', $order->cancel_reason);
        $this->assertNotNull($order->stock_restored_at);
        $this->assertSame(50, $product->fresh()->stock);
    }

    public function test_refunding_a_cancelled_order_does_not_restock_twice(): void
    {
        $product = $this->makeProduct(['stock' => 48]);
        $order = $this->makeOrder($product, 2);
        $admin = $this->admin();

        $this->actingAs($admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('cancel', data: ['cancel_reason' => 'Out of stock']);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('refund', data: [
                'refund_amount' => 200,
                'refund_reference' => 'REF-123',
            ]);

        $order->refresh();

        $this->assertSame('refunded', $order->status);
        $this->assertSame('refunded', $order->payment_status);
        $this->assertEquals(200.0, $order->refund_amount);
        $this->assertSame('REF-123', $order->refund_reference);
        $this->assertSame(50, $product->fresh()->stock, 'Stock must only be restored once.');
    }

    public function test_refund_of_the_full_total_restores_stock(): void
    {
        $product = $this->makeProduct(['stock' => 48]);
        $order = $this->makeOrder($product, 2, 'delivered');
        $admin = $this->admin();

        $this->actingAs($admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('refund', data: [
                'refund_amount' => (float) $order->total,
            ]);

        $order->refresh();

        $this->assertSame('refunded', $order->status);
        $this->assertSame('refunded', $order->payment_status);
        $this->assertEquals((float) $order->total, (float) $order->refund_amount);
        $this->assertSame(50, $product->fresh()->stock);
    }

    public function test_refund_cannot_exceed_the_order_total(): void
    {
        $product = $this->makeProduct(['stock' => 48]);
        $order = $this->makeOrder($product, 2, 'delivered');
        $admin = $this->admin();

        $this->actingAs($admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('refund', data: [
                'refund_amount' => (float) $order->total + 1,
            ])
            ->assertHasFormErrors(['refund_amount']);

        $this->assertSame('delivered', $order->fresh()->status);
        $this->assertSame(48, $product->fresh()->stock, 'A rejected refund must never touch stock.');
    }

    public function test_invalid_transition_is_rejected_without_side_effects(): void
    {
        $product = $this->makeProduct(['stock' => 48]);
        $order = $this->makeOrder($product, 2);

        // The state machine itself refuses impossible jumps…
        $this->assertFalse(app(OrderStateMachine::class)->canTransition($order, 'delivered'));
        $this->expectException(\InvalidArgumentException::class);
        app(OrderStateMachine::class)->transition($order, 'delivered');
    }

    public function test_invalid_transition_action_is_hidden_from_the_ui(): void
    {
        $product = $this->makeProduct(['stock' => 48]);
        $order = $this->makeOrder($product, 2);
        $admin = $this->admin();

        $this->actingAs($admin);

        // …and the Filament UI never offers it in the first place.
        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->assertActionHidden('transition_delivered')
            ->assertActionVisible('transition_processing')
            ->assertActionVisible('cancel');

        $this->assertSame('pending', $order->fresh()->status);
        $this->assertNull($order->fresh()->stock_restored_at);
        $this->assertSame(48, $product->fresh()->stock);
        $this->assertDatabaseMissing('audit_logs', [
            'auditable_type' => $order->getMorphClass(),
            'auditable_id' => $order->id,
        ]);
    }

    public function test_non_admin_cannot_change_order_status(): void
    {
        $product = $this->makeProduct(['stock' => 48]);
        $order = $this->makeOrder($product, 2);
        $customer = User::factory()->create(['two_factor_confirmed_at' => now()]);

        $this->actingAs($customer)
            ->get("/admin/orders/{$order->id}")
            ->assertForbidden();

        // Even a crafted Livewire request is rejected: customers hold no
        // OrderPolicy abilities at all.
        $this->assertFalse(Gate::forUser($customer)->allows('updateStatus', $order));
        $this->assertFalse(Gate::forUser($customer)->allows('view', $order));

        $this->assertSame('pending', $order->fresh()->status);
        $this->assertSame(48, $product->fresh()->stock);
    }

    public function test_status_change_writes_an_audit_log(): void
    {
        $product = $this->makeProduct(['stock' => 50]);
        $order = $this->makeOrder($product, 2);
        $admin = $this->admin();

        $this->actingAs($admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('transition_processing');

        $log = AuditLog::query()
            ->where('auditable_type', $order->getMorphClass())
            ->where('auditable_id', $order->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($log);
        $this->assertSame('order.status.updated', $log->action);
        $this->assertSame($admin->id, $log->user_id);
        $this->assertSame('pending', $log->old_values['status']);
        $this->assertSame('processing', $log->new_values['status']);
        $this->assertSame(50, $product->fresh()->stock);
    }

    public function test_admin_can_mark_a_pending_payment_as_paid(): void
    {
        $product = $this->makeProduct(['stock' => 20]);
        $order = $this->makeOrder($product, 1, 'pending', 'pending');
        $admin = $this->admin();

        $this->actingAs($admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->assertActionVisible('markPaid')
            ->callAction('markPaid');

        $order->refresh();

        $this->assertSame('paid', $order->payment_status);
        $this->assertSame('processing', $order->status);
        $this->assertSame('manual', $order->payment_gateway);
        $this->assertSame('admin-'.$admin->id, $order->payment_reference);

        $this->assertDatabaseHas('audit_logs', [
            'action' => 'order.payment.marked_paid',
            'auditable_type' => $order->getMorphClass(),
            'auditable_id' => $order->id,
        ]);
    }

    public function test_shipped_transition_records_the_tracking_number(): void
    {
        $product = $this->makeProduct(['stock' => 30]);
        $order = $this->makeOrder($product, 1, 'processing');
        $admin = $this->admin();

        $this->actingAs($admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('transition_shipped', data: ['tracking_number' => 'DHL-123456789']);

        $order->refresh();

        $this->assertSame('shipped', $order->status);
        $this->assertSame('DHL-123456789', $order->tracking_number);
        $this->assertNotNull($order->shipped_at);
    }
}
