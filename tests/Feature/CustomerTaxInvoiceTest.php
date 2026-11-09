<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTaxInvoiceTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_customer_can_view_own_tax_invoice(): void
    {
        $customer = User::factory()->create();
        $product = $this->makeProduct(['name' => 'Faux Filter Concealer', 'price' => 120]);

        $order = Order::create([
            'order_number' => 'AE-INV-001',
            'user_id' => $customer->id,
            'status' => 'shipped',
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'delivery_method' => 'standard',
            'courier' => 'aramex',
            'tracking_number' => 'ARMX987654321',
            'customer_name' => 'Aisha Al Nuaimi',
            'customer_phone' => '+971501234567',
            'customer_email' => $customer->email,
            'subtotal' => 240,
            'tax_rate' => 0.05,
            'tax_amount' => 11.43,
            'subtotal_ex_tax' => 228.57,
            'shipping_fee' => 0,
            'total' => 240,
            'placed_at' => now(),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => 120,
            'quantity' => 2,
            'line_total' => 240,
        ]);

        $response = $this->actingAs($customer)->get("/my-account/orders/{$order->order_number}/invoice");

        $response->assertOk()
            ->assertSee('Tax Invoice')
            ->assertSee('AE-INV-001')
            ->assertSee('Aisha Al Nuaimi')
            ->assertSee('Faux Filter Concealer')
            ->assertSee('Aramex')
            ->assertSee('ARMX987654321')
            ->assertSee('https://www.aramex.com/track/results?shipmentNumber=ARMX987654321')
            ->assertSee('5%');
    }

    public function test_customer_cannot_view_another_customers_invoice(): void
    {
        $customerA = User::factory()->create();
        $customerB = User::factory()->create();

        $order = Order::create([
            'order_number' => 'AE-INV-002',
            'user_id' => $customerA->id,
            'status' => 'pending',
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Customer A',
            'customer_phone' => '+971500000000',
            'customer_email' => $customerA->email,
            'subtotal' => 100,
            'total' => 100,
        ]);

        // Customer B trying to view Customer A's invoice gets 404
        $this->actingAs($customerB)
            ->get("/my-account/orders/{$order->order_number}/invoice")
            ->assertNotFound();
    }

    public function test_staff_can_view_invoice_in_admin_panel(): void
    {
        $staff = User::factory()->create(['role' => 'support']);
        $order = Order::create([
            'order_number' => 'AE-INV-003',
            'status' => 'processing',
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'delivery_method' => 'standard',
            'customer_name' => 'Admin Invoice Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'staff-test@example.com',
            'subtotal' => 150,
            'total' => 150,
        ]);

        // Staff can access admin invoice route
        $this->actingAs($staff)
            ->get("/admin/orders/{$order->id}/invoice")
            ->assertOk()
            ->assertSee('AE-INV-003');

        // Customer gets 403 on admin invoice route
        $customer = User::factory()->create(['role' => 'customer']);
        $this->actingAs($customer)
            ->get("/admin/orders/{$order->id}/invoice")
            ->assertForbidden();
    }
}
