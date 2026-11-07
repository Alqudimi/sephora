<?php

namespace Tests\Feature;

use App\Filament\Widgets\LowStockWidget;
use App\Filament\Widgets\OrderStatusChartWidget;
use App\Filament\Widgets\RecentOrdersWidget;
use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\ShopStatsWidget;
use App\Filament\Widgets\TopProductsWidget;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Consent;
use App\Models\ContactMessage;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\NewsletterSubscriber;
use App\Models\Offer;
use App\Models\Order;
use App\Models\PaymentWebhookEvent;
use App\Models\Product;
use App\Models\Review;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Smoke-renders every page of the Filament admin panel so a broken
 * table, form, infolist or widget definition can never ship silently.
 */
class AdminPanelSmokeTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
            'two_factor_confirmed_at' => now(),
        ]);
    }

    private function seedEverything(): void
    {
        $product = $this->makeProduct();
        $product->images()->create(['path' => 'products/sample.jpg', 'alt' => $product->name, 'sort_order' => 0]);
        $product->shades()->create(['name' => 'Rose', 'hex_color' => '#ff0000']);

        $brand = Brand::firstOrCreate(['slug' => 'smoke-brand'], ['name' => 'Smoke Brand']);
        Category::firstOrCreate(['slug' => 'smoke-cat'], ['name' => 'Smoke Category']);
        Store::create(['name' => 'Smoke Store', 'city' => 'Dubai', 'address' => 'Mall of the Emirates']);
        Faq::create(['category' => 'orders', 'question' => 'Smoke?', 'answer' => 'Test.', 'sort_order' => 1]);
        Offer::create(['title' => 'Smoke Offer', 'description' => 'Three for two on skincare.']);
        NewsletterSubscriber::create(['email' => 'smoke@example.com']);
        ContactMessage::create(['name' => 'Smoke', 'email' => 's@example.com', 'subject' => 'Hi', 'message' => 'Hello']);
        Consent::create([
            'type' => 'cookies',
            'version' => '1.0',
            'accepted' => true,
            'ip_address' => '127.0.0.1',
            'accepted_at' => now(),
        ]);

        $coupon = Coupon::create([
            'code' => 'SMOKE10',
            'type' => 'percent',
            'value' => 10,
            'starts_at' => now()->subDay(),
            'expires_at' => now()->addDays(7),
            'usage_limit' => 100,
            'is_active' => true,
        ]);

        $order = Order::create([
            'order_number' => 'AE-SMOKE-00001',
            'status' => 'processing',
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'delivery_method' => 'standard',
            'customer_name' => 'Smoke Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'smoke@example.com',
            'subtotal' => 100,
            'total' => 125,
        ]);
        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => $product->price,
            'quantity' => 1,
            'line_total' => $product->price,
        ]);
        $coupon->redemptions()->create([
            'order_id' => $order->id,
            'email' => 'smoke@example.com',
            'amount' => 10,
        ]);

        PaymentWebhookEvent::create([
            'gateway' => 'stripe',
            'event_id' => 'evt_'.uniqid(),
            'type' => 'payment_intent.succeeded',
            'payload' => ['id' => 'pi_test'],
            'processed_at' => now(),
        ]);

        Review::create([
            'product_id' => $product->id,
            'user_id' => User::factory()->create()->id,
            'rating' => 5,
            'title' => 'Great',
            'body' => 'Lovely product.',
            'is_approved' => false,
        ]);

        $cart = Cart::create(['session_id' => 'smoke-session', 'user_id' => User::factory()->create()->id]);
        $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_every_admin_list_page_renders(): void
    {
        $this->seedEverything();

        $pages = [
            '/admin',
            '/admin/products',
            '/admin/products/create',
            '/admin/categories',
            '/admin/brands',
            '/admin/orders',
            '/admin/customers',
            '/admin/reviews',
            '/admin/coupons',
            '/admin/offers',
            '/admin/stores',
            '/admin/faqs',
            '/admin/contact-messages',
            '/admin/newsletter-subscribers',
            '/admin/carts',
            '/admin/payment-webhook-events',
            '/admin/audit-logs',
            '/admin/consents',
            '/admin/reports',
            '/admin/shop-settings',
            '/admin/staff',
            '/admin/staff/create',
            '/admin/failed-jobs',
        ];

        foreach ($pages as $page) {
            $this->actingAs($this->admin)
                ->get($page)
                ->assertOk("Failed rendering {$page}");
        }
    }

    public function test_record_pages_render(): void
    {
        $this->seedEverything();
        $product = Product::first();

        $this->actingAs($this->admin)
            ->get("/admin/products/{$product->id}/edit")
            ->assertOk();

        $order = Order::first();
        $this->actingAs($this->admin)->get("/admin/orders/{$order->id}")->assertOk();
        $this->actingAs($this->admin)->get("/admin/orders/{$order->id}/edit")->assertOk();

        $brand = Brand::first();
        $this->actingAs($this->admin)->get("/admin/brands/{$brand->id}")->assertOk();
        $this->actingAs($this->admin)->get("/admin/brands/{$brand->id}/edit")->assertOk();

        $category = Category::first();
        $this->actingAs($this->admin)->get("/admin/categories/{$category->id}")->assertOk();
        $this->actingAs($this->admin)->get("/admin/categories/{$category->id}/edit")->assertOk();

        $customer = User::where('role', 'customer')->first() ?? User::first();
        $this->actingAs($this->admin)->get("/admin/customers/{$customer->id}")->assertOk();
        $this->actingAs($this->admin)->get("/admin/customers/{$customer->id}/edit")->assertOk();

        $message = ContactMessage::first();
        $this->actingAs($this->admin)->get("/admin/contact-messages/{$message->id}")->assertOk();

        $review = Review::first();
        $this->actingAs($this->admin)->get("/admin/reviews/{$review->id}/edit")->assertOk();

        $cart = Cart::first();
        $this->actingAs($this->admin)->get("/admin/carts/{$cart->id}")->assertOk();
    }

    public function test_dashboard_widgets_render_with_data(): void
    {
        $this->seedEverything();

        $response = $this->actingAs($this->admin)->get('/admin');

        $response->assertOk();
        $response->assertSee('Dashboard');
    }

    /**
     * Widgets load lazily via separate Livewire requests, so a broken
     * widget would never surface in the plain HTTP dashboard request —
     * render every widget component directly with real data present.
     */
    public function test_every_dashboard_widget_renders_with_data(): void
    {
        $this->seedEverything();

        $widgets = [
            ShopStatsWidget::class,
            RevenueChartWidget::class,
            OrderStatusChartWidget::class,
            RecentOrdersWidget::class,
            TopProductsWidget::class,
            LowStockWidget::class,
        ];

        $this->actingAs($this->admin);

        foreach ($widgets as $widget) {
            Livewire::test($widget)
                ->assertSuccessful("Failed rendering {$widget}");
        }
    }

    public function test_invoice_prints_for_an_order(): void
    {
        $this->seedEverything();
        $order = Order::first();

        $this->actingAs($this->admin)
            ->get("/admin/orders/{$order->id}/invoice")
            ->assertOk()
            ->assertSee($order->order_number);
    }

    public function test_global_search_finds_products_and_orders(): void
    {
        $this->seedEverything();

        $this->actingAs($this->admin)
            ->get('/admin?global-search=Hydrating')
            ->assertOk();

        $this->actingAs($this->admin)
            ->get('/admin?global-search=AE-SMOKE')
            ->assertOk();
    }

    public function test_support_navigation_hides_restricted_areas(): void
    {
        $this->seedEverything();

        $support = User::factory()->create([
            'role' => 'support',
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);

        // Support may not open privacy, audit or settings areas at all.
        $this->actingAs($support)->get('/admin/audit-logs')->assertForbidden();
        $this->actingAs($support)->get('/admin/consents')->assertForbidden();
        $this->actingAs($support)->get('/admin/shop-settings')->assertForbidden();
        $this->actingAs($support)->get('/admin/reports')->assertForbidden();
        $this->actingAs($support)->get('/admin/newsletter-subscribers')->assertForbidden();
        $this->actingAs($support)->get('/admin/payment-webhook-events')->assertForbidden();

        // Operational areas stay available.
        $this->actingAs($support)->get('/admin/orders')->assertOk();
        $this->actingAs($support)->get('/admin/products')->assertOk();
        $this->actingAs($support)->get('/admin/customers')->assertOk();
        $this->actingAs($support)->get('/admin/reviews')->assertOk();
    }

    public function test_manager_can_open_settings_and_reports_but_not_privacy_areas(): void
    {
        $this->seedEverything();

        $manager = User::factory()->create([
            'role' => 'manager',
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($manager)->get('/admin/shop-settings')->assertOk();
        $this->actingAs($manager)->get('/admin/reports')->assertOk();
        $this->actingAs($manager)->get('/admin/payment-webhook-events')->assertOk();

        $this->actingAs($manager)->get('/admin/audit-logs')->assertForbidden();
        $this->actingAs($manager)->get('/admin/consents')->assertForbidden();
    }
}
