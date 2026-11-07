<?php

namespace Tests\Feature;

use App\Events\OrderPlaced;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OrderEmailPipelineTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private array $payload = [
        'customer_name' => 'Mail Test',
        'customer_phone' => '+971501234567',
        'customer_email' => 'mailer@example.com',
        'delivery_method' => 'standard',
        'emirate' => 'Dubai',
        'street_address' => 'Test Tower',
        'payment_method' => 'cod',
        'terms' => '1',
    ];

    public function test_order_placed_event_fires_on_checkout(): void
    {
        Event::fake([OrderPlaced::class]);
        $product = $this->makeProduct();

        $r = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($r);
        $this->post('/checkout/place-order', $this->payload);

        $order = Order::first();

        Event::assertDispatched(OrderPlaced::class, fn (OrderPlaced $e) => $e->order->id === $order->id);
    }

    public function test_listener_sends_order_confirmation_mail(): void
    {
        Mail::fake();
        $product = $this->makeProduct();

        $r = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($r);
        $this->post('/checkout/place-order', $this->payload);

        $order = Order::first();
        Event::dispatch(new OrderPlaced($order));

        Mail::assertQueued(OrderConfirmationMail::class, fn ($mail) => $mail->order->id === $order->id);
    }

    public function test_confirmation_mail_renders_order_content(): void
    {
        $product = $this->makeProduct(['name' => 'Mailed Miracle Serum']);

        $r = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($r);
        $this->post('/checkout/place-order', $this->payload);

        $order = Order::first();
        $mailable = new OrderConfirmationMail($order);
        $rendered = $mailable->render();

        $this->assertStringContainsString($order->order_number, $rendered);
        $this->assertStringContainsString('Mailed Miracle Serum', $rendered);
        $this->assertStringContainsString(number_format($order->total, 2), $rendered);
    }
}
