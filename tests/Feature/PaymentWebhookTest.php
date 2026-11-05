<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\PaymentWebhookEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class PaymentWebhookTest extends TestCase
{
    use RefreshDatabase;

    private const SECRET = 'whsec_test_secret';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'payments.driver' => 'stripe',
            'payments.methods.card.enabled' => true,
            'payments.stripe.webhook_secret' => self::SECRET,
            'payments.stripe.webhook_tolerance' => 300,
        ]);
    }

    private function makeOrder(array $attributes = []): Order
    {
        return Order::create(array_merge([
            'order_number' => 'AE-WH-'.substr(uniqid(), -8),
            'status' => 'pending',
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Webhook Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'webhook@example.com',
            'subtotal' => 100,
            'total' => 100,
        ], $attributes));
    }

    private function payload(Order $order, string $eventId = 'evt_test_1', string $type = 'checkout.session.completed'): array
    {
        return [
            'id' => $eventId,
            'type' => $type,
            'data' => [
                'object' => [
                    'id' => 'cs_test_123',
                    'client_reference_id' => $order->order_number,
                    'metadata' => ['order_number' => $order->order_number],
                ],
            ],
        ];
    }

    private function signature(string $payload, ?int $timestamp = null): string
    {
        $timestamp ??= time();
        $signature = hash_hmac('sha256', $timestamp.'.'.$payload, self::SECRET);

        return "t={$timestamp},v1={$signature}";
    }

    private function postWebhook(array $event, ?string $signature = null, string $gateway = 'stripe'): TestResponse
    {
        $payload = json_encode($event, JSON_THROW_ON_ERROR);
        $signature ??= $this->signature($payload);

        return $this->call(
            'POST',
            route('payments.webhook', ['gateway' => $gateway]),
            [],
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_STRIPE_SIGNATURE' => $signature,
            ],
            $payload,
        );
    }

    public function test_valid_webhook_marks_the_order_paid_and_records_the_event(): void
    {
        $order = $this->makeOrder();

        $this->postWebhook($this->payload($order))
            ->assertOk()
            ->assertJson(['ok' => true]);

        $order->refresh();

        $this->assertSame('paid', $order->payment_status);
        $this->assertSame('processing', $order->status);
        $this->assertSame('stripe', $order->payment_gateway);
        $this->assertSame('cs_test_123', $order->payment_reference);

        $record = PaymentWebhookEvent::query()
            ->where('gateway', 'stripe')
            ->where('event_id', 'evt_test_1')
            ->first();

        $this->assertNotNull($record);
        $this->assertSame('checkout.session.completed', $record->type);
        $this->assertNotNull($record->processed_at);
    }

    public function test_payment_intent_succeeded_marks_the_order_paid(): void
    {
        $order = $this->makeOrder();
        $event = [
            'id' => 'evt_pi_1',
            'type' => 'payment_intent.succeeded',
            'data' => [
                'object' => [
                    'id' => 'pi_123',
                    'metadata' => ['order_number' => $order->order_number],
                ],
            ],
        ];

        $this->postWebhook($event)->assertOk();

        $order->refresh();

        $this->assertSame('paid', $order->payment_status);
        $this->assertSame('pi_123', $order->payment_reference);
    }

    public function test_invalid_signature_is_rejected_without_side_effects(): void
    {
        $order = $this->makeOrder();

        $this->postWebhook($this->payload($order), 't='.time().',v1=deadbeef')
            ->assertStatus(400)
            ->assertJson(['ok' => false]);

        $this->assertSame('pending', $order->fresh()->payment_status);
        $this->assertDatabaseCount('payment_webhook_events', 0);
    }

    public function test_replayed_timestamp_outside_the_tolerance_is_rejected(): void
    {
        $order = $this->makeOrder();
        $event = $this->payload($order);
        $payload = json_encode($event, JSON_THROW_ON_ERROR);

        $this->postWebhook($event, $this->signature($payload, time() - 301))
            ->assertStatus(400);

        $this->assertSame('pending', $order->fresh()->payment_status);
        $this->assertDatabaseCount('payment_webhook_events', 0);
    }

    public function test_signature_rotation_is_accepted_when_any_v1_matches(): void
    {
        $order = $this->makeOrder();
        $event = $this->payload($order);
        $payload = json_encode($event, JSON_THROW_ON_ERROR);
        $timestamp = time();
        $valid = hash_hmac('sha256', $timestamp.'.'.$payload, self::SECRET);

        $this->postWebhook($event, "t={$timestamp},v1=stale,v1={$valid}")
            ->assertOk();

        $this->assertSame('paid', $order->fresh()->payment_status);
    }

    public function test_duplicate_event_is_acknowledged_and_not_reprocessed(): void
    {
        $order = $this->makeOrder();
        $this->postWebhook($this->payload($order))->assertOk();

        $duplicate = $this->payload($order);
        $duplicate['data']['object']['id'] = 'cs_test_999';

        $this->postWebhook($duplicate)
            ->assertOk()
            ->assertJson(['ok' => true, 'duplicate' => true]);

        $this->assertSame('cs_test_123', $order->fresh()->payment_reference);
        $this->assertDatabaseCount('payment_webhook_events', 1);
    }

    public function test_an_event_already_marked_processed_cannot_modify_the_order(): void
    {
        $order = $this->makeOrder();

        PaymentWebhookEvent::create([
            'gateway' => 'stripe',
            'event_id' => 'evt_processed',
            'type' => 'checkout.session.completed',
            'payload' => [],
            'processed_at' => now(),
        ]);

        $this->postWebhook($this->payload($order, 'evt_processed'))
            ->assertOk()
            ->assertJson(['duplicate' => true]);

        $this->assertSame('pending', $order->fresh()->payment_status);
    }

    public function test_unknown_order_reference_is_acknowledged_without_creating_an_order(): void
    {
        $order = $this->makeOrder();
        $event = $this->payload($order, 'evt_unknown_order');
        $event['data']['object']['client_reference_id'] = 'AE-DOES-NOT-EXIST';
        $event['data']['object']['metadata']['order_number'] = 'AE-DOES-NOT-EXIST';

        $this->postWebhook($event)->assertOk();

        $record = PaymentWebhookEvent::where('event_id', 'evt_unknown_order')->first();

        $this->assertNotNull($record);
        $this->assertNotNull($record->processed_at);
        $this->assertSame(1, Order::count());
    }

    public function test_non_stripe_gateway_is_rejected(): void
    {
        $order = $this->makeOrder();

        $this->postWebhook($this->payload($order), gateway: 'fake')
            ->assertStatus(400);
    }

    public function test_non_array_webhook_object_is_acknowledged_without_error(): void
    {
        $event = [
            'id' => 'evt_bad_object',
            'type' => 'checkout.session.completed',
            'data' => ['object' => 'not-an-array'],
        ];

        $this->postWebhook($event)->assertOk();

        $this->assertNotNull(
            PaymentWebhookEvent::where('event_id', 'evt_bad_object')->first()->processed_at
        );
    }

    public function test_unrelated_event_type_is_acknowledged_without_marking_paid(): void
    {
        $order = $this->makeOrder();

        $this->postWebhook($this->payload($order, 'evt_refund', 'charge.refunded'))
            ->assertOk();

        $this->assertSame('pending', $order->fresh()->payment_status);
    }
}
