<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $this->actingAs($this->admin())
            ->patch(route('admin.orders.status', $order), [
                'status' => 'cancelled',
                'cancel_reason' => 'Customer changed their mind',
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

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

        $this->actingAs($admin)->patch(route('admin.orders.status', $order), [
            'status' => 'cancelled',
            'cancel_reason' => 'Out of stock',
        ])->assertSessionHasNoErrors();

        $this->actingAs($admin)->patch(route('admin.orders.status', $order), [
            'status' => 'refunded',
            'refund_amount' => 200,
            'refund_reference' => 'REF-123',
        ])->assertSessionHasNoErrors();

        $order->refresh();

        $this->assertSame('refunded', $order->status);
        $this->assertSame('refunded', $order->payment_status);
        $this->assertEquals(200.0, $order->refund_amount);
        $this->assertSame('REF-123', $order->refund_reference);
        $this->assertSame(50, $product->fresh()->stock, 'Stock must only be restored once.');
    }

    public function test_refund_defaults_to_order_total_and_restores_stock(): void
    {
        $product = $this->makeProduct(['stock' => 48]);
        $order = $this->makeOrder($product, 2, 'delivered');

        $this->actingAs($this->admin())
            ->patch(route('admin.orders.status', $order), [
                'status' => 'refunded',
            ])
            ->assertSessionHasNoErrors();

        $order->refresh();

        $this->assertSame('refunded', $order->status);
        $this->assertSame('refunded', $order->payment_status);
        $this->assertEquals(200.0, $order->refund_amount);
        $this->assertSame(50, $product->fresh()->stock);
    }

    public function test_invalid_transition_is_rejected_without_side_effects(): void
    {
        $product = $this->makeProduct(['stock' => 48]);
        $order = $this->makeOrder($product, 2);
        $admin = $this->admin();

        $this->actingAs($admin)
            ->patch(route('admin.orders.status', $order), ['status' => 'delivered'])
            ->assertRedirect()
            ->assertSessionHasErrors('status');

        $order->refresh();

        $this->assertSame('pending', $order->status);
        $this->assertNull($order->stock_restored_at);
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

        $this->actingAs(User::factory()->create())
            ->patch(route('admin.orders.status', $order), ['status' => 'processing'])
            ->assertForbidden();

        $this->assertSame('pending', $order->fresh()->status);
        $this->assertSame(48, $product->fresh()->stock);
    }

    public function test_status_change_writes_an_audit_log(): void
    {
        $product = $this->makeProduct(['stock' => 50]);
        $order = $this->makeOrder($product, 2);
        $admin = $this->admin();

        $this->actingAs($admin)
            ->patch(route('admin.orders.status', $order), ['status' => 'processing'])
            ->assertSessionHasNoErrors();

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
}
