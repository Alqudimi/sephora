<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Setting;
use App\Services\Payments\PaymentManager;
use App\Services\Payments\TabbyGateway;
use App\Services\Payments\TamaraGateway;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BnplPaymentTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_tabby_start_payment_creates_session_and_returns_redirect(): void
    {
        Setting::set('tabby_enabled', '1');
        Setting::set('tabby_secret_key', 'sk_test_123456');
        Setting::set('tabby_merchant_code', 'sephora_test');

        Http::fake([
            'https://api.tabby.ai/api/v2/checkout' => Http::response([
                'id' => 'tabby_sess_9988',
                'status' => 'created',
                'configuration' => [
                    'available_products' => [
                        'installments' => [
                            ['web_url' => 'https://checkout.tabby.ai/test-session-url'],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $order = Order::create([
            'order_number' => 'AE-TB-'.uniqid(),
            'status' => 'pending',
            'payment_method' => 'tabby',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Fatima Al Mansoori',
            'customer_phone' => '+971501112233',
            'customer_email' => 'fatima@example.com',
            'shipping_address' => 'Dubai Marina',
            'subtotal' => 300.00,
            'subtotal_ex_tax' => 285.71,
            'tax_rate' => 0.05,
            'tax_amount' => 14.29,
            'total' => 300.00,
        ]);

        $gateway = app(TabbyGateway::class);
        $result = $gateway->start($order);

        $this->assertFalse($result->paid);
        $this->assertEquals('https://checkout.tabby.ai/test-session-url', $result->redirectUrl);
        $this->assertEquals('tabby_sess_9988', $result->reference);
    }

    public function test_tamara_start_payment_creates_session_and_returns_redirect(): void
    {
        Setting::set('tamara_enabled', '1');
        Setting::set('tamara_api_token', 'tamara_test_token_123');

        Http::fake([
            'https://api-sandbox.tamara.co/checkout' => Http::response([
                'order_id' => 'tamara_ord_5544',
                'checkout_url' => 'https://checkout.tamara.co/pay/5544',
                'status' => 'new',
            ], 200),
        ]);

        $order = Order::create([
            'order_number' => 'AE-TM-'.uniqid(),
            'status' => 'pending',
            'payment_method' => 'tamara',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Mariam Al Zaabi',
            'customer_phone' => '+971503334455',
            'customer_email' => 'mariam@example.com',
            'shipping_address' => 'Khalidiya, Abu Dhabi',
            'subtotal' => 450.00,
            'subtotal_ex_tax' => 428.57,
            'tax_rate' => 0.05,
            'tax_amount' => 21.43,
            'total' => 450.00,
        ]);

        $gateway = app(TamaraGateway::class);
        $result = $gateway->start($order);

        $this->assertFalse($result->paid);
        $this->assertEquals('https://checkout.tamara.co/pay/5544', $result->redirectUrl);
        $this->assertEquals('tamara_ord_5544', $result->reference);
    }

    public function test_tabby_webhook_marks_order_paid(): void
    {
        $order = Order::create([
            'order_number' => 'AE-TB-WH01',
            'status' => 'pending',
            'payment_method' => 'tabby',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Fatima Al Mansoori',
            'customer_phone' => '+971501112233',
            'customer_email' => 'fatima@example.com',
            'shipping_address' => 'Dubai Marina',
            'subtotal' => 200.00,
            'total' => 200.00,
        ]);

        $payload = [
            'id' => 'tabby_pay_12345',
            'status' => 'AUTHORIZED',
            'order' => [
                'reference_id' => 'AE-TB-WH01',
            ],
        ];

        $response = $this->postJson(route('payments.webhook', ['gateway' => 'tabby']), $payload);

        $response->assertOk()
            ->assertJson([
                'ok' => true,
                'duplicate' => false,
            ]);

        $this->assertEquals('paid', $order->fresh()->payment_status);
        $this->assertEquals('tabby', $order->fresh()->payment_gateway);
    }

    public function test_tamara_webhook_marks_order_paid(): void
    {
        $order = Order::create([
            'order_number' => 'AE-TM-WH01',
            'status' => 'pending',
            'payment_method' => 'tamara',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Mariam Al Zaabi',
            'customer_phone' => '+971503334455',
            'customer_email' => 'mariam@example.com',
            'shipping_address' => 'Abu Dhabi',
            'subtotal' => 350.00,
            'total' => 350.00,
        ]);

        $payload = [
            'order_id' => 'tamara_ord_9988',
            'order_reference_id' => 'AE-TM-WH01',
            'order_status' => 'approved',
        ];

        $response = $this->postJson(route('payments.webhook', ['gateway' => 'tamara']), $payload);

        $response->assertOk()
            ->assertJson([
                'ok' => true,
                'duplicate' => false,
            ]);

        $this->assertEquals('paid', $order->fresh()->payment_status);
        $this->assertEquals('tamara', $order->fresh()->payment_gateway);
    }
}

