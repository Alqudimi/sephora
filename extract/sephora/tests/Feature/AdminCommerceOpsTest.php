<?php

namespace Tests\Feature;

use App\Filament\Exports\OrderCsvExport;
use App\Filament\Pages\ShopSettings;
use App\Filament\Resources\CartResource\Pages\ListCarts;
use App\Filament\Resources\CustomerResource\Pages\ListCustomers;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Models\AuditLog;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Services\Commerce\ShippingCalculator;
use App\Support\CommerceSettings;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class AdminCommerceOpsTest extends TestCase
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

    // ── Product operations ────────────────────────────────────

    public function test_stock_adjustment_updates_stock_and_writes_audit_log(): void
    {
        $product = $this->makeProduct(['stock' => 50, 'sku' => 'SKU-ADJ-1']);

        $this->actingAs($this->admin);

        Livewire::test(ListProducts::class)
            ->callTableAction('adjustStock', record: $product, data: [
                'new_stock' => 33,
                'reason' => 'cycle count correction',
            ]);

        $this->assertSame(33, (int) $product->fresh()->stock);

        $this->assertDatabaseHas('audit_logs', [
            'action' => 'product.stock.adjusted',
            'auditable_id' => $product->id,
        ]);

        $log = AuditLog::where('auditable_id', $product->id)
            ->where('action', 'product.stock.adjusted')
            ->first();

        $this->assertSame(['stock' => 50], $log->old_values);
        $this->assertSame('cycle count correction', $log->new_values['reason']);
    }

    public function test_bulk_price_adjustment_reprices_products_and_logs_each_one(): void
    {
        $a = $this->makeProduct(['price' => 100.00]);
        $b = $this->makeProduct(['price' => 200.00]);

        $this->actingAs($this->admin);

        Livewire::test(ListProducts::class)
            ->callTableBulkAction('adjustPrices', records: collect([$a, $b]), data: [
                'operation' => 'increase_percent',
                'amount' => 10,
                'round_to' => true,
            ]);

        $this->assertSame(110.0, (float) $a->fresh()->price);
        $this->assertSame(220.0, (float) $b->fresh()->price);

        $this->assertSame(
            2,
            AuditLog::where('action', 'product.price.bulk_updated')->whereIn('auditable_id', [$a->id, $b->id])->count()
        );
    }

    public function test_bulk_price_decrease_never_goes_negative(): void
    {
        $a = $this->makeProduct(['price' => 30.00]);

        $this->actingAs($this->admin);

        Livewire::test(ListProducts::class)
            ->callTableBulkAction('adjustPrices', records: collect([$a]), data: [
                'operation' => 'decrease_fixed',
                'amount' => 100,
                'round_to' => true,
            ]);

        $this->assertSame(0.0, (float) $a->fresh()->price);
    }

    public function test_low_stock_threshold_is_settings_driven(): void
    {
        $this->assertSame(10, CommerceSettings::lowStockThreshold());

        Setting::set('low_stock_threshold', '5');

        $this->assertSame(5, CommerceSettings::lowStockThreshold());

        Setting::set('low_stock_threshold', null);
    }

    // ── Settings page & storefront wiring ─────────────────────

    public function test_settings_page_saves_all_commerce_overrides(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(ShopSettings::class)
            ->fillForm([
                'same_day_fee' => 55,
                'cod_fee' => 15,
                'vat_rate_percent' => 5,
                'low_stock_threshold' => 6,
                'max_quantity_per_item' => 10,
                'max_samples' => 2,
                'loyalty_enabled' => false,
                'company_trn' => '100123456700003',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame('55', (string) Setting::get('same_day_fee'));
        $this->assertSame('15', (string) Setting::get('cod_fee'));
        $this->assertSame('5', (string) Setting::get('vat_rate_percent'));
        $this->assertSame('6', (string) Setting::get('low_stock_threshold'));
        $this->assertSame('0', (string) Setting::get('loyalty_enabled'));
    }

    public function test_shipping_calculator_honours_overrides_live(): void
    {
        $calculator = app(ShippingCalculator::class);

        // Config defaults.
        $this->assertSame(40.0, $calculator->fee('same_day', 100.0));
        $this->assertSame(45.0, $calculator->fee('standard', 100.0, 'cod'));

        Setting::set('same_day_fee', '60');
        Setting::set('cod_fee', '10');
        Setting::set('shipping_fee', '30');

        $this->assertSame(60.0, $calculator->fee('same_day', 100.0));
        $this->assertSame(40.0, $calculator->fee('standard', 100.0, 'cod'));
        $this->assertSame(30.0, $calculator->fee('standard', 100.0));
    }

    public function test_loyalty_can_be_disabled(): void
    {
        $this->assertTrue(CommerceSettings::loyaltyEnabled());

        Setting::set('loyalty_enabled', '0');

        $this->assertFalse(CommerceSettings::loyaltyEnabled());
    }

    // ── Customer tooling ──────────────────────────────────────

    public function test_customer_password_reset_link_can_be_sent_from_the_panel(): void
    {
        Notification::fake();

        $customer = User::factory()->create(['role' => null, 'is_admin' => false]);

        $this->actingAs($this->admin);

        Livewire::test(ListCustomers::class)
            ->callTableAction('sendPasswordReset', record: $customer);

        Notification::assertSentTo($customer, ResetPassword::class);

        $this->assertDatabaseHas('audit_logs', [
            'action' => 'customer.password_reset.sent',
            'auditable_id' => $customer->id,
        ]);
    }

    public function test_customer_export_csv_streams_only_customers(): void
    {
        User::factory()->create([
            'email' => 'staff-member@sephora.test',
            'role' => 'manager',
            'is_admin' => false,
        ]);

        $customer = User::factory()->create([
            'email' => 'real-customer@example.com',
            'role' => null,
            'is_admin' => false,
        ]);

        $response = (new ListCustomers)->exportCsv();

        ob_start();
        $response->sendContent();
        $content = (string) ob_get_clean();

        $this->assertStringContainsString('id,name,email', $content);
        $this->assertStringContainsString('real-customer@example.com', $content);

        // Staff accounts never leak into the customer export.
        $this->assertStringNotContainsString('staff-member@sephora.test', $content);
        $this->assertStringNotContainsString($this->admin->email, $content);
    }

    // ── Filter-aware order export ─────────────────────────────

    public function test_order_export_respects_a_filtered_query_and_includes_vat_columns(): void
    {
        $product = $this->makeProduct();

        $match = Order::create([
            'order_number' => 'AE-EXP-0001',
            'status' => 'delivered',
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'delivery_method' => 'standard',
            'customer_name' => 'Export Match',
            'customer_phone' => '+971',
            'customer_email' => 'match@example.com',
            'subtotal' => 100,
            'subtotal_ex_tax' => 95.24,
            'tax_rate' => 0.05,
            'tax_amount' => 4.76,
            'total' => 100,
        ]);

        Order::create([
            'order_number' => 'AE-EXP-0002',
            'status' => 'cancelled',
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Export Skip',
            'customer_phone' => '+971',
            'customer_email' => 'skip@example.com',
            'subtotal' => 50,
            'total' => 50,
        ]);

        $filtered = Order::query()->where('status', 'delivered');

        $response = app(OrderCsvExport::class)->download($filtered);

        ob_start();
        $response->sendContent();
        $content = (string) ob_get_clean();

        $this->assertStringContainsString('AE-EXP-0001', $content);
        $this->assertStringNotContainsString('AE-EXP-0002', $content);
        $this->assertStringContainsString('subtotal_ex_tax', $content);
        $this->assertStringContainsString('4.76', $content);
    }

    // ── Cart limits wiring ────────────────────────────────────

    public function test_cart_quantity_limit_is_settings_driven(): void
    {
        $this->assertSame(20, CommerceSettings::maxQuantityPerItem());

        Setting::set('max_quantity_per_item', '3');

        $this->assertSame(3, CommerceSettings::maxQuantityPerItem());

        Setting::set('max_quantity_per_item', null);
    }

    public function test_abandoned_cart_filter_is_available(): void
    {
        $product = $this->makeProduct();

        $fresh = Cart::create(['session_id' => 'fresh']);
        $fresh->items()->create(['product_id' => $product->id, 'quantity' => 1]);

        $stale = Cart::create(['session_id' => 'stale']);
        $stale->items()->create(['product_id' => $product->id, 'quantity' => 2]);
        Cart::whereKey($stale->id)->update(['updated_at' => now()->subDays(2)]);

        $this->actingAs($this->admin);

        Livewire::test(ListCarts::class)
            ->filterTable('abandoned')
            ->assertCanSeeTableRecords(collect([$stale->fresh()]));
    }
}
