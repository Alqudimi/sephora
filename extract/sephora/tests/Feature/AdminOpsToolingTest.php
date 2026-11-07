<?php

namespace Tests\Feature;

use App\Filament\Pages\FailedJobs;
use App\Filament\Resources\PaymentWebhookEventResource\Pages\ListPaymentWebhookEvents;
use App\Filament\Widgets\LowStockWidget;
use App\Filament\Widgets\OrderStatusChartWidget;
use App\Filament\Widgets\RecentOrdersWidget;
use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\ShopStatsWidget;
use App\Filament\Widgets\TopProductsWidget;
use App\Models\FailedJob;
use App\Models\Order;
use App\Models\PaymentWebhookEvent;
use App\Models\User;
use App\Services\Payments\WebhookProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class AdminOpsToolingTest extends TestCase
{
    use RefreshDatabase;

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

    // ── Webhook reprocessing ──────────────────────────────────

    public function test_unprocessed_webhook_can_be_reprocessed_and_marks_the_order_paid(): void
    {
        $order = Order::create([
            'order_number' => 'AE-WHK-0001',
            'status' => 'pending',
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Webhook Customer',
            'customer_phone' => '+971',
            'customer_email' => 'whk@example.com',
            'subtotal' => 100,
            'total' => 100,
        ]);

        $event = PaymentWebhookEvent::create([
            'gateway' => 'stripe',
            'event_id' => 'evt_reprocess_1',
            'type' => 'payment_intent.succeeded',
            'payload' => [
                'type' => 'payment_intent.succeeded',
                'data' => ['object' => ['client_reference_id' => 'AE-WHK-0001', 'id' => 'pi_1']],
            ],
        ]);

        $this->assertNull($event->processed_at);

        $this->actingAs($this->admin);

        Livewire::test(ListPaymentWebhookEvents::class)
            ->callTableAction('reprocess', record: $event);

        $order->refresh();
        $event->refresh();

        $this->assertSame('paid', $order->payment_status);
        $this->assertSame('processing', $order->status);
        $this->assertNotNull($event->processed_at);
    }

    public function test_reprocessing_a_processed_event_is_a_no_op(): void
    {
        $event = PaymentWebhookEvent::create([
            'gateway' => 'stripe',
            'event_id' => 'evt_reprocess_2',
            'type' => 'payment_intent.succeeded',
            'payload' => ['id' => 'evt'],
            'processed_at' => now(),
        ]);

        $result = app(WebhookProcessor::class)->process($event);

        $this->assertTrue($result['duplicate']);
        $this->assertFalse($result['applied']);
    }

    public function test_webhook_resource_has_processed_filter_and_payload_view(): void
    {
        PaymentWebhookEvent::create([
            'gateway' => 'stripe',
            'event_id' => 'evt_visible_1',
            'type' => 'payment_intent.succeeded',
            'payload' => ['id' => 'evt'],
            'processed_at' => now(),
        ]);

        $this->actingAs($this->admin);

        Livewire::test(ListPaymentWebhookEvents::class)
            ->assertSuccessful()
            ->assertTableFilterExists('processed_at');
    }

    // ── Failed jobs page ──────────────────────────────────────

    public function test_failed_jobs_page_is_admin_only(): void
    {
        $manager = User::factory()->create(['role' => 'manager', 'two_factor_confirmed_at' => now()]);

        $this->actingAs($manager)->get('/admin/failed-jobs')->assertForbidden();
        $this->actingAs($this->admin)->get('/admin/failed-jobs')->assertOk();
    }

    public function test_failed_jobs_page_lists_and_discards_jobs(): void
    {
        DB::table('failed_jobs')->insert([
            'uuid' => 'job-uuid-1',
            'connection' => 'database',
            'queue' => 'default',
            'payload' => json_encode(['displayName' => 'App\Listeners\SendOrderConfirmation']),
            'exception' => "RuntimeException: boom\n  at line 1",
            'failed_at' => now(),
        ]);

        $this->actingAs($this->admin);

        Livewire::test(FailedJobs::class)
            ->assertSuccessful()
            ->assertSeeText('default');

        // Discard removes the row from the table.
        $job = FailedJob::first();

        Livewire::test(FailedJobs::class)
            ->callTableAction('delete', record: $job);

        $this->assertSame(0, DB::table('failed_jobs')->count());
    }

    // ── Revenue widgets are gated for support ─────────────────

    public function test_revenue_widgets_are_hidden_from_support(): void
    {
        $support = User::factory()->create(['role' => 'support', 'two_factor_confirmed_at' => now()]);
        $manager = User::factory()->create(['role' => 'manager', 'two_factor_confirmed_at' => now()]);

        $this->actingAs($support);

        $this->assertFalse(ShopStatsWidget::canView());
        $this->assertFalse(RevenueChartWidget::canView());
        $this->assertFalse(TopProductsWidget::canView());

        // Operational widgets stay visible for support.
        $this->assertTrue(RecentOrdersWidget::canView());
        $this->assertTrue(OrderStatusChartWidget::canView());
        $this->assertTrue(LowStockWidget::canView());

        $this->actingAs($manager);

        $this->assertTrue(ShopStatsWidget::canView());
        $this->assertTrue(RevenueChartWidget::canView());
    }
}
