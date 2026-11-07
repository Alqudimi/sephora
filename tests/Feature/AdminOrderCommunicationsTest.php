<?php

namespace Tests\Feature;

use App\Events\OrderPlaced;
use App\Filament\Resources\OrderResource\Pages\ViewOrder;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderRefundedMail;
use App\Mail\OrderShippedMail;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\NewOrderPlacedNotification;
use App\Services\Commerce\OrderTotals;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class AdminOrderCommunicationsTest extends TestCase
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

        Mail::fake();
    }

    private function makeOrder(string $status = 'processing'): Order
    {
        $product = $this->makeProduct(['price' => 100]);

        $order = Order::create([
            'order_number' => 'AE-COM-'.substr(uniqid(), -6),
            'status' => $status,
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'delivery_method' => 'standard',
            'customer_name' => 'Comms Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'comms@example.com',
            'subtotal' => 100,
            'subtotal_ex_tax' => 95.24,
            'tax_rate' => 0.05,
            'tax_amount' => 4.76,
            'total' => 100,
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => 100,
            'quantity' => 1,
            'line_total' => 100,
        ]);

        return $order;
    }

    public function test_new_order_sends_confirmation_and_staff_database_notifications(): void
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $support = User::factory()->create(['role' => 'support']);

        $order = $this->makeOrder('pending');

        event(new OrderPlaced($order));

        Mail::assertQueued(OrderConfirmationMail::class, fn ($mail) => $mail->order->id === $order->id);

        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $this->admin->id,
            'type' => NewOrderPlacedNotification::class,
        ]);
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $manager->id,
            'type' => NewOrderPlacedNotification::class,
        ]);
        $this->assertDatabaseHas('notifications', [
            'notifiable_id' => $support->id,
            'type' => NewOrderPlacedNotification::class,
        ]);

        // Customers never receive panel notifications.
        $customer = User::factory()->create();
        $this->assertDatabaseMissing('notifications', [
            'notifiable_id' => $customer->id,
        ]);
    }

    public function test_admin_can_resend_the_confirmation_email(): void
    {
        $order = $this->makeOrder();

        $this->actingAs($this->admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('resendConfirmation');

        Mail::assertQueued(OrderConfirmationMail::class, 1);

        $this->assertDatabaseHas('audit_logs', [
            'action' => 'order.email.resent',
            'auditable_id' => $order->id,
        ]);
    }

    public function test_shipping_an_order_emails_the_customer(): void
    {
        $order = $this->makeOrder('processing');

        $this->actingAs($this->admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('transition_shipped', data: ['tracking_number' => 'DHL-999']);

        $order->refresh();

        $this->assertSame('shipped', $order->status);
        $this->assertSame('DHL-999', $order->tracking_number);

        Mail::assertQueued(OrderShippedMail::class, fn ($mail) => $mail->order->id === $order->id);

        $this->assertDatabaseHas('audit_logs', [
            'action' => 'order.email.sent',
            'auditable_id' => $order->id,
        ]);
    }

    public function test_refunding_an_order_emails_the_customer(): void
    {
        $order = $this->makeOrder('delivered');

        $this->actingAs($this->admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('refund', data: [
                'refund_amount' => 50,
                'refund_reference' => 'rf_test_1',
            ]);

        $order->refresh();

        $this->assertSame('refunded', $order->status);
        $this->assertSame(50.0, $order->refund_amount);

        Mail::assertQueued(OrderRefundedMail::class, fn ($mail) => $mail->order->id === $order->id);
    }

    public function test_order_view_shows_the_vat_breakdown(): void
    {
        $order = $this->makeOrder();

        $this->actingAs($this->admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->assertSuccessful();

        $this->get("/admin/orders/{$order->id}")
            ->assertOk()
            ->assertSee('VAT due')
            ->assertSee('4.76');
    }

    public function test_invoice_is_a_uae_tax_invoice_with_vat_lines(): void
    {
        Setting::set('company_trn', '100123456700003');

        $order = $this->makeOrder();

        $this->actingAs($this->admin)
            ->get("/admin/orders/{$order->id}/invoice")
            ->assertOk()
            ->assertSee('Tax Invoice')
            ->assertSee('VAT @ 5%')
            ->assertSee('4.76')
            ->assertSee('100123456700003')
            ->assertSee('Total (VAT inclusive)');
    }

    public function test_vat_rate_setting_changes_order_tax_extraction(): void
    {
        // Default 5% on a 105 gross.
        $totals = OrderTotals::calculate(100, 0, 5);
        $this->assertEqualsWithDelta(5.0, $totals->taxAmount, 0.01);
        $this->assertEqualsWithDelta(100.0, $totals->subtotalExTax, 0.01);

        // Zero-rated via the settings override.
        Setting::set('vat_rate_percent', '0');

        $totals = OrderTotals::calculate(100, 0, 5);
        $this->assertSame(0.0, $totals->taxAmount);

        Setting::set('vat_rate_percent', null);
    }
}
