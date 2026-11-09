<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\Orders\OrderStateMachine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\Feature\CreatesCatalog;
use Tests\TestCase;

class OrderStateMachineTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private OrderStateMachine $stateMachine;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stateMachine = new OrderStateMachine();
    }

    private function makeTestOrder(string $status = 'pending'): Order
    {
        return Order::create([
            'order_number' => 'AE-STATE-'.substr(uniqid(), -6),
            'status' => $status,
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'State Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'state@example.com',
            'subtotal' => 100,
            'total' => 100,
        ]);
    }

    public function test_can_transition_validates_forward_workflow(): void
    {
        $order = $this->makeTestOrder('pending');

        $this->assertTrue($this->stateMachine->canTransition($order, 'processing'));
        $this->assertTrue($this->stateMachine->canTransition($order, 'cancelled'));
        $this->assertFalse($this->stateMachine->canTransition($order, 'delivered'));
        $this->assertFalse($this->stateMachine->canTransition($order, 'refunded'));
    }

    public function test_transition_advances_order_and_sets_timestamps(): void
    {
        $order = $this->makeTestOrder('pending');

        $this->stateMachine->transition($order, 'processing');
        $this->assertSame('processing', $order->fresh()->status);

        $this->stateMachine->transition($order, 'shipped', ['tracking_number' => 'TRK123', 'courier' => 'dhl']);
        $order->refresh();
        $this->assertSame('shipped', $order->status);
        $this->assertNotNull($order->shipped_at);
        $this->assertSame('TRK123', $order->tracking_number);
        $this->assertSame('dhl', $order->courier);

        $this->stateMachine->transition($order, 'delivered');
        $order->refresh();
        $this->assertSame('delivered', $order->status);
        $this->assertNotNull($order->delivered_at);
    }

    public function test_invalid_transition_throws_exception(): void
    {
        $order = $this->makeTestOrder('delivered');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("cannot move from [delivered] to [processing]");

        $this->stateMachine->transition($order, 'processing');
    }

    public function test_cancelling_order_restocks_inventory_exactly_once(): void
    {
        $product = $this->makeProduct(['stock' => 15]);
        $order = $this->makeTestOrder('pending');

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => 50,
            'quantity' => 3,
            'line_total' => 150,
        ]);

        $this->stateMachine->transition($order, 'cancelled');
        $order->refresh();

        $this->assertSame('cancelled', $order->status);
        $this->assertNotNull($order->cancelled_at);
        $this->assertNotNull($order->stock_restored_at);
        $this->assertSame(18, $product->fresh()->stock);

        // Transitioning to refunded afterward should NOT restore stock a second time
        $this->stateMachine->transition($order, 'refunded');
        $this->assertSame(18, $product->fresh()->stock);
    }
}

