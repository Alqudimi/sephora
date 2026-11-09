<?php

namespace Tests\Feature;

use App\Jobs\CancelUnpaidOrdersJob;
use App\Jobs\ProcessPaymentWebhookJob;
use App\Jobs\PruneAbandonedCartsJob;
use App\Jobs\SendContactAlertJob;
use App\Jobs\SendNewsletterWelcomeJob;
use App\Jobs\WarmSystemCacheJob;
use App\Mail\ContactMessageReceivedMail;
use App\Mail\NewsletterWelcomeMail;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ContactMessage;
use App\Models\Coupon;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentWebhookEvent;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class QueueJobsTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_process_payment_webhook_job_executes_and_marks_order_paid(): void
    {
        $order = Order::create([
            'order_number' => 'AE-JOB-001',
            'status' => 'pending',
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Job Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'job@example.com',
            'subtotal' => 200,
            'total' => 200,
        ]);

        $event = PaymentWebhookEvent::create([
            'gateway' => 'stripe',
            'event_id' => 'evt_job_test_001',
            'type' => 'payment_intent.succeeded',
            'payload' => [
                'type' => 'payment_intent.succeeded',
                'data' => [
                    'object' => [
                        'client_reference_id' => 'AE-JOB-001',
                        'id' => 'pi_job_123',
                    ],
                ],
            ],
        ]);

        $job = new ProcessPaymentWebhookJob($event);
        $this->assertSame('payments', $job->queue);

        ProcessPaymentWebhookJob::dispatchSync($event);

        $order->refresh();
        $event->refresh();

        $this->assertSame('paid', $order->payment_status);
        $this->assertSame('processing', $order->status);
        $this->assertNotNull($event->processed_at);

        // Verify idempotency on second execution
        ProcessPaymentWebhookJob::dispatchSync($event);
        $this->assertSame('paid', $order->fresh()->payment_status);
    }

    public function test_send_contact_alert_job_sends_email(): void
    {
        Mail::fake();
        Setting::set('admin_notify_email', 'concierge@sephora.ae');

        $contact = ContactMessage::create([
            'name' => 'Fatima Al Mansoori',
            'email' => 'fatima@example.com',
            'subject' => 'Product Inquiry',
            'message' => 'When will the Huda Beauty faux filter concealer restock?',
        ]);

        $job = new SendContactAlertJob($contact);
        $this->assertSame('emails', $job->queue);

        SendContactAlertJob::dispatchSync($contact);

        Mail::assertQueued(ContactMessageReceivedMail::class, function ($mail) {
            return $mail->hasTo('concierge@sephora.ae');
        });
    }

    public function test_send_newsletter_welcome_job_sends_email(): void
    {
        Mail::fake();

        $subscriber = NewsletterSubscriber::create([
            'email' => 'vip@example.com',
            'source' => 'footer',
            'subscribed_at' => now(),
        ]);

        $job = new SendNewsletterWelcomeJob($subscriber);
        $this->assertSame('emails', $job->queue);

        SendNewsletterWelcomeJob::dispatchSync($subscriber);

        Mail::assertQueued(NewsletterWelcomeMail::class, function ($mail) {
            return $mail->hasTo('vip@example.com');
        });
    }

    public function test_prune_abandoned_carts_job_cleans_up_stale_data(): void
    {
        // 1. Abandoned guest cart older than 30 days
        $oldCart = Cart::create(['user_id' => null, 'session_id' => 'old_guest_sess']);
        $oldCart->updated_at = now()->subDays(35);
        $oldCart->save(['timestamps' => false]);

        // 2. Active guest cart
        $recentCart = Cart::create(['user_id' => null, 'session_id' => 'recent_guest_sess']);

        // 3. Expired coupon
        $expiredCoupon = Coupon::create([
            'code' => 'EXPIRED20',
            'type' => 'percentage',
            'value' => 20,
            'is_active' => true,
            'expires_at' => now()->subDays(2),
        ]);

        // 4. Valid active coupon
        $validCoupon = Coupon::create([
            'code' => 'ACTIVE20',
            'type' => 'percentage',
            'value' => 20,
            'is_active' => true,
            'expires_at' => now()->addDays(10),
        ]);

        $job = new PruneAbandonedCartsJob(30);
        $this->assertSame('low', $job->queue);

        PruneAbandonedCartsJob::dispatchSync(30);

        $this->assertDatabaseMissing('carts', ['id' => $oldCart->id]);
        $this->assertDatabaseHas('carts', ['id' => $recentCart->id]);
        $this->assertFalse($expiredCoupon->fresh()->is_active);
        $this->assertTrue($validCoupon->fresh()->is_active);
    }

    public function test_cancel_unpaid_orders_job_releases_stock(): void
    {
        $product = $this->makeProduct(['stock' => 10]);

        $order = Order::create([
            'order_number' => 'AE-UNPAID-001',
            'status' => 'pending',
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Stale Buyer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'stale@example.com',
            'subtotal' => 100,
            'total' => 100,
            'placed_at' => now()->subHours(50),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => 100,
            'quantity' => 2,
            'line_total' => 200,
        ]);

        $job = new CancelUnpaidOrdersJob(48);
        $this->assertSame('default', $job->queue);

        CancelUnpaidOrdersJob::dispatchSync(48);

        $order->refresh();
        $this->assertSame('cancelled', $order->status);
        $this->assertNotNull($order->stock_restored_at);
        $this->assertSame(12, $product->fresh()->stock);
    }

    public function test_warm_system_cache_job_runs_without_exceptions(): void
    {
        $job = new WarmSystemCacheJob();
        $this->assertSame('low', $job->queue);

        WarmSystemCacheJob::dispatchSync();

        $this->assertTrue(true);
    }

    public function test_http_endpoints_dispatch_queue_jobs(): void
    {
        Queue::fake();

        // Contact endpoint dispatches SendContactAlertJob
        $response = $this->post('/contact-us', [
            'name' => 'Mariam',
            'email' => 'mariam@example.com',
            'message' => 'Looking for the latest Dyson airwrap edition in Dubai Mall.',
        ]);

        $response->assertSessionHas('contact_success', true);
        Queue::assertPushed(SendContactAlertJob::class);

        // Newsletter endpoint dispatches SendNewsletterWelcomeJob
        $newsletterResponse = $this->postJson('/newsletter/subscribe', [
            'email' => 'new-subscriber@example.com',
        ]);

        $newsletterResponse->assertOk()
            ->assertJson(['success' => true]);
        Queue::assertPushed(SendNewsletterWelcomeJob::class);
    }

    public function test_queue_run_workers_command_is_available(): void
    {
        $this->artisan('app:queue-work --help')
            ->assertSuccessful()
            ->expectsOutputToContain('Spawn and supervise multiple parallel queue worker processes');
    }
}
