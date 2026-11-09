<?php

namespace Tests\Feature;

use App\Filament\Pages\ShopSettings;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Services\Payments\PaymentManager;
use App\Services\Payments\ZainCashGateway;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ZainCashPaymentTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private const TEST_SECRET = 'zc_secret_test_key_123456';
    private const TEST_CLIENT_ID = 'zc_client_test_id';
    private const TEST_CLIENT_SECRET = 'zc_client_test_secret';
    private const TEST_MERCHANT_ID = 'zc_merchant_5ff64b';
    private const TEST_MSISDN = '9647800000000';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'payments.driver' => 'zaincash',
            'payments.methods.zaincash.enabled' => true,
            'payments.zaincash.enabled' => true,
            'payments.zaincash.mode' => 'uat',
            'payments.zaincash.api_version' => 'v2',
            'payments.zaincash.client_id' => self::TEST_CLIENT_ID,
            'payments.zaincash.client_secret' => self::TEST_CLIENT_SECRET,
            'payments.zaincash.merchant_id' => self::TEST_MERCHANT_ID,
            'payments.zaincash.secret' => self::TEST_SECRET,
            'payments.zaincash.msisdn' => self::TEST_MSISDN,
            'payments.zaincash.exchange_rate' => 355.0,
            'payments.zaincash.language' => 'ar',
            'payments.zaincash.use_fake_driver' => false,
        ]);
    }

    private function createAdminUser(): User
    {
        return User::factory()->create([
            'email' => 'admin-zc@example.com',
            'role' => 'admin',
        ]);
    }

    private function makeOrder(array $attributes = []): Order
    {
        return Order::create(array_merge([
            'order_number' => 'AE-ZC-'.substr(uniqid(), -8),
            'status' => 'pending',
            'payment_method' => 'zaincash',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Ahmed Al-Iraqi',
            'customer_phone' => '+971500000000',
            'customer_email' => 'ahmed@example.com',
            'subtotal' => 100,
            'total' => 100,
        ], $attributes));
    }

    public function test_admin_settings_page_saves_and_retrieves_zaincash_credentials(): void
    {
        $admin = $this->createAdminUser();

        Livewire::actingAs($admin)
            ->test(ShopSettings::class)
            ->set('data.zaincash_enabled', true)
            ->set('data.zaincash_mode', 'production')
            ->set('data.zaincash_api_version', 'v2')
            ->set('data.zaincash_exchange_rate', '360.5')
            ->set('data.zaincash_language', 'ar')
            ->set('data.zaincash_client_id', 'live_client_abc')
            ->set('data.zaincash_client_secret', 'live_secret_xyz')
            ->set('data.zaincash_merchant_id', 'merchant_999')
            ->set('data.zaincash_secret', 'jwt_secret_live')
            ->set('data.zaincash_msisdn', '9647811111111')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertEquals('1', Setting::get('zaincash_enabled'));
        $this->assertEquals('production', Setting::get('zaincash_mode'));
        $this->assertEquals('v2', Setting::get('zaincash_api_version'));
        $this->assertEquals('360.5', Setting::get('zaincash_exchange_rate'));
        $this->assertEquals('live_client_abc', Setting::get('zaincash_client_id'));
        $this->assertEquals('live_secret_xyz', Setting::get('zaincash_client_secret'));
        $this->assertEquals('merchant_999', Setting::get('zaincash_merchant_id'));
        $this->assertEquals('jwt_secret_live', Setting::get('zaincash_secret'));
        $this->assertEquals('9647811111111', Setting::get('zaincash_msisdn'));

        $gateway = app(ZainCashGateway::class);
        $this->assertTrue($gateway->isEnabled());
        $this->assertEquals('production', $gateway->mode());
        $this->assertEquals(360.5, $gateway->exchangeRate());
        $this->assertEquals(36050, $gateway->toIqd(100.0));
    }

    public function test_zaincash_method_availability_in_checkout_when_enabled_or_disabled(): void
    {
        $manager = app(PaymentManager::class);

        Setting::set('zaincash_enabled', '0');
        $this->assertFalse($manager->isEnabled('zaincash'));
        $this->assertNotContains('zaincash', $manager->enabledMethods());

        Setting::set('zaincash_enabled', '1');
        $this->assertTrue($manager->isEnabled('zaincash'));
        $this->assertContains('zaincash', $manager->enabledMethods());
    }

    public function test_zaincash_v2_payment_start_authenticates_and_returns_redirect(): void
    {
        Http::fake([
            'https://pg-api-uat.zaincash.iq/oauth2/token' => Http::response([
                'access_token' => 'mock_access_token_123',
                'token_type' => 'Bearer',
                'expires_in' => 3600,
            ], 200),
            'https://pg-api-uat.zaincash.iq/api/v2/payment-gateway/transaction/init' => Http::response([
                'id' => 'zc_trans_uuid_999',
                'status' => 'pending',
                'redirect_url' => 'https://pg.zaincash.iq/payment/pay?id=zc_trans_uuid_999',
            ], 200),
        ]);

        $order = $this->makeOrder(['total' => 200]);
        $gateway = app(ZainCashGateway::class);

        $result = $gateway->start($order);

        $this->assertFalse($result->paid);
        $this->assertEquals('https://pg.zaincash.iq/payment/pay?id=zc_trans_uuid_999', $result->redirectUrl);
        $this->assertEquals('zc_trans_uuid_999', $result->reference);
        $this->assertEquals('zaincash', $result->gateway);
        $this->assertEquals(71000, $result->payload['amount_iqd']); // 200 AED * 355

        Http::assertSent(function ($request) {
            return $request->url() === 'https://pg-api-uat.zaincash.iq/oauth2/token'
                && $request['client_id'] === self::TEST_CLIENT_ID;
        });

        Http::assertSent(function ($request) {
            return $request->url() === 'https://pg-api-uat.zaincash.iq/api/v2/payment-gateway/transaction/init'
                && $request->hasHeader('Authorization', 'Bearer mock_access_token_123')
                && $request['amount'] === 71000;
        });
    }

    public function test_zaincash_v1_payment_start_signs_jwt_and_returns_pay_url(): void
    {
        config(['payments.zaincash.api_version' => 'v1']);
        Setting::set('zaincash_api_version', 'v1');

        Http::fake([
            'https://test.zaincash.iq/transaction/init' => Http::response([
                'id' => 'zc_v1_tx_456',
            ], 200),
        ]);

        $order = $this->makeOrder(['total' => 150]);
        $gateway = app(ZainCashGateway::class);

        $result = $gateway->start($order);

        $this->assertFalse($result->paid);
        $this->assertEquals('https://test.zaincash.iq/transaction/pay?id=zc_v1_tx_456', $result->redirectUrl);
        $this->assertEquals('zc_v1_tx_456', $result->reference);

        Http::assertSent(function ($request) use ($gateway, $order) {
            if ($request->url() !== 'https://test.zaincash.iq/transaction/init') {
                return false;
            }

            $token = $request['token'];
            $decoded = $gateway->decodeJwt($token, self::TEST_SECRET);

            return $decoded !== null
                && $decoded['amount'] === 53250 // 150 * 355
                && $decoded['msisdn'] === self::TEST_MSISDN
                && $decoded['orderId'] === $order->order_number;
        });
    }

    public function test_zaincash_callback_with_valid_jwt_success_marks_order_paid(): void
    {
        $order = $this->makeOrder(['payment_status' => 'pending']);
        $gateway = app(ZainCashGateway::class);

        $jwtPayload = [
            'status' => 'success',
            'orderid' => $order->order_number,
            'id' => 'zc_tx_confirmed_789',
            'amount' => 35500,
        ];
        $token = $gateway->encodeJwt($jwtPayload, self::TEST_SECRET);

        $response = $this->withSession(["placed_orders.{$order->order_number}" => true])
            ->get(route('checkout.payment.return', [
                'order' => $order->order_number,
                'token' => $token,
            ]));

        $response->assertRedirect(route('checkout.confirmation', ['order' => $order->order_number]));
        $response->assertSessionHas('order_success', true);

        $order->refresh();
        $this->assertEquals('paid', $order->payment_status);
        $this->assertEquals('processing', $order->status);
        $this->assertEquals('zaincash', $order->payment_gateway);
    }

    public function test_zaincash_callback_with_failed_status_shows_payment_error(): void
    {
        $order = $this->makeOrder(['payment_status' => 'pending']);
        $gateway = app(ZainCashGateway::class);

        $jwtPayload = [
            'status' => 'failed',
            'orderid' => $order->order_number,
            'id' => 'zc_tx_failed_000',
            'msg' => 'Insufficient funds in customer wallet',
        ];
        $token = $gateway->encodeJwt($jwtPayload, self::TEST_SECRET);

        $response = $this->withSession(["placed_orders.{$order->order_number}" => true])
            ->get(route('checkout.payment.return', [
                'order' => $order->order_number,
                'token' => $token,
            ]));

        $response->assertRedirect(route('checkout.confirmation', ['order' => $order->order_number]));
        $response->assertSessionHas('payment_error');

        $order->refresh();
        $this->assertEquals('pending', $order->payment_status);
    }

    public function test_zaincash_webhook_with_valid_jwt_marks_order_paid(): void
    {
        $order = $this->makeOrder(['payment_status' => 'pending']);
        $gateway = app(ZainCashGateway::class);

        $jwtPayload = [
            'id' => 'zc_wh_evt_111',
            'status' => 'success',
            'order_id' => $order->order_number,
            'amount' => 35500,
        ];
        $token = $gateway->encodeJwt($jwtPayload, self::TEST_SECRET);

        $response = $this->postJson(route('payments.webhook', ['gateway' => 'zaincash']), [
            'token' => $token,
        ]);

        $response->assertOk();
        $response->assertJson([
            'ok' => true,
            'duplicate' => false,
        ]);

        $order->refresh();
        $this->assertEquals('paid', $order->payment_status);
        $this->assertEquals('processing', $order->status);

        // Idempotency: duplicate webhook does not re-apply
        $duplicateResponse = $this->postJson(route('payments.webhook', ['gateway' => 'zaincash']), [
            'token' => $token,
        ]);

        $duplicateResponse->assertOk();
        $duplicateResponse->assertJson([
            'ok' => true,
            'duplicate' => true,
        ]);
    }

    public function test_zaincash_webhook_with_forged_jwt_is_rejected(): void
    {
        $order = $this->makeOrder();
        $gateway = app(ZainCashGateway::class);

        // Sign with wrong secret
        $token = $gateway->encodeJwt([
            'status' => 'success',
            'order_id' => $order->order_number,
        ], 'wrong_attacker_secret');

        $response = $this->postJson(route('payments.webhook', ['gateway' => 'zaincash']), [
            'token' => $token,
        ]);

        $response->assertStatus(400);

        $order->refresh();
        $this->assertEquals('pending', $order->payment_status);
    }

    public function test_checkout_storefront_renders_zaincash_option_when_enabled(): void
    {
        Setting::set('zaincash_enabled', '1');

        $product = $this->makeProduct([
            'is_active' => true,
            'stock' => 10,
            'price' => 100,
        ]);

        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $response = $this->get(route('checkout'));

        $response->assertOk();
        $response->assertSee('ZainCash (محفظة زين كاش)');
        $response->assertSee('value="zaincash"', false);
    }

    public function test_shopper_can_place_order_with_zaincash_and_get_redirected_to_payment_portal(): void
    {
        Setting::set('zaincash_enabled', '1');

        Http::fake([
            'https://pg-api-uat.zaincash.iq/oauth2/token' => Http::response([
                'access_token' => 'mock_access_token_123',
                'token_type' => 'Bearer',
                'expires_in' => 3600,
            ], 200),
            'https://pg-api-uat.zaincash.iq/api/v2/payment-gateway/transaction/init' => Http::response([
                'id' => 'zc_checkout_trans_555',
                'status' => 'pending',
                'redirect_url' => 'https://pg.zaincash.iq/payment/pay?id=zc_checkout_trans_555',
            ], 200),
        ]);

        $product = $this->makeProduct(['price' => 300, 'stock' => 10]);
        $resp = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($resp);

        $payload = [
            'customer_name' => 'Sara Al-Mansoor',
            'customer_phone' => '+971501234567',
            'customer_email' => 'sara@example.com',
            'delivery_method' => 'standard',
            'emirate' => 'Dubai',
            'street_address' => 'Downtown Dubai Boulevard',
            'payment_method' => 'zaincash',
            'terms' => '1',
        ];

        $response = $this->post('/checkout/place-order', $payload);

        $response->assertRedirect('https://pg.zaincash.iq/payment/pay?id=zc_checkout_trans_555');

        $this->assertDatabaseHas('orders', [
            'payment_method' => 'zaincash',
            'payment_gateway' => 'zaincash',
            'payment_reference' => 'zc_checkout_trans_555',
            'payment_status' => 'pending',
        ]);
    }
}
