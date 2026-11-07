<?php

namespace Tests\Feature;

use App\Filament\Pages\Reports;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Models\WishlistItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminReportsExtendedTest extends TestCase
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

    private function makeOrder(array $attrs = []): Order
    {
        $product = $this->makeProduct(['price' => 100]);

        $order = Order::create(array_merge([
            'order_number' => 'AE-REP-'.substr(uniqid(), -6),
            'status' => 'processing',
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'delivery_method' => 'standard',
            'customer_name' => 'Report Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'report@example.com',
            'emirate' => 'Dubai',
            'subtotal' => 100,
            'subtotal_ex_tax' => 95.24,
            'tax_rate' => 0.05,
            'tax_amount' => 4.76,
            'discount' => 0,
            'shipping_fee' => 0,
            'total' => 100,
            'placed_at' => now()->subDays(2),
        ], $attrs));

        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => 100,
            'quantity' => 1,
            'line_total' => 100,
        ]);

        return $order;
    }

    public function test_reports_page_renders_every_extended_section(): void
    {
        $this->makeOrder();

        $this->actingAs($this->admin);

        Livewire::test(Reports::class)
            ->assertSuccessful();

        $this->get('/admin/reports')
            ->assertOk()
            ->assertSee('Coupon performance')
            ->assertSee('VAT (')
            ->assertSee('Refunds & cancellations', escape: false)
            ->assertSee('Most wished for')
            ->assertSee('Abandoned carts');
    }

    public function test_coupon_performance_aggregates_redemptions(): void
    {
        $coupon = Coupon::create([
            'code' => 'REPORT15',
            'type' => 'percent',
            'value' => 15,
            'starts_at' => now()->subDay(),
            'expires_at' => now()->addWeek(),
            'is_active' => true,
        ]);

        $order = $this->makeOrder(['discount' => 15, 'coupon_code' => 'REPORT15', 'total' => 85]);
        $coupon->redemptions()->create([
            'order_id' => $order->id,
            'email' => 'report@example.com',
            'amount' => 15,
        ]);

        $this->actingAs($this->admin);

        $page = Livewire::test(Reports::class);
        $rows = $page->instance()->getCouponPerformance();

        $this->assertNotEmpty($rows);
        $this->assertSame('REPORT15', $rows[0]['code']);
        $this->assertSame(1, $rows[0]['orders']);
        $this->assertEqualsWithDelta(15.0, $rows[0]['discount'], 0.001);
    }

    public function test_vat_summary_sums_tax_columns(): void
    {
        $this->makeOrder();
        $this->makeOrder(['tax_amount' => 9.52, 'subtotal_ex_tax' => 190.48, 'total' => 200, 'subtotal' => 200]);

        $this->actingAs($this->admin);

        $summary = Livewire::test(Reports::class)->instance()->getVatSummary();

        $this->assertEqualsWithDelta(14.28, $summary['vat'], 0.001);
        $this->assertEqualsWithDelta(285.72, $summary['taxable'], 0.001);
        $this->assertEqualsWithDelta(300.0, $summary['gross'], 0.001);
    }

    public function test_reviews_summary_counts_distribution_and_average(): void
    {
        $product = $this->makeProduct();

        foreach ([5, 5, 4] as $rating) {
            Review::create([
                'product_id' => $product->id,
                'user_id' => User::factory()->create()->id,
                'rating' => $rating,
                'title' => 'Title',
                'body' => 'Body',
                'is_approved' => true,
            ]);
        }

        $this->actingAs($this->admin);

        $summary = Livewire::test(Reports::class)->instance()->getReviewsSummary();

        $this->assertSame(3, $summary['total']);
        $this->assertEqualsWithDelta(4.67, $summary['average'], 0.01);

        $five = collect($summary['distribution'])->firstWhere('stars', 5);
        $this->assertSame(2, $five['count']);
    }

    public function test_refunds_summary_tracks_refunded_and_cancelled_orders(): void
    {
        $this->makeOrder([
            'status' => 'refunded',
            'refund_amount' => 40,
        ]);
        $this->makeOrder(['status' => 'cancelled']);

        $this->actingAs($this->admin);

        $summary = Livewire::test(Reports::class)->instance()->getRefundsSummary();

        $this->assertSame(1, $summary['refunded_orders']);
        $this->assertEqualsWithDelta(40.0, $summary['refunded_amount'], 0.001);
        $this->assertSame(1, $summary['cancelled_orders']);
    }

    public function test_most_wished_ranks_products(): void
    {
        $product = $this->makeProduct();
        $customer = User::factory()->create();

        WishlistItem::create(['user_id' => $customer->id, 'product_id' => $product->id]);
        WishlistItem::create(['user_id' => User::factory()->create()->id, 'product_id' => $product->id]);

        $this->actingAs($this->admin);

        $rows = Livewire::test(Reports::class)->instance()->getMostWished();

        $this->assertNotEmpty($rows);
        $this->assertSame($product->id, $rows[0]->id);
        $this->assertSame(2, (int) $rows[0]->wishes);
    }

    public function test_summary_export_streams_a_csv_with_every_section(): void
    {
        $this->makeOrder(['discount' => 10, 'coupon_code' => 'CSV10', 'total' => 90]);

        $this->actingAs($this->admin);

        $response = Livewire::test(Reports::class)->instance()->exportSummaryCsv();

        ob_start();
        $response->sendContent();
        $content = (string) ob_get_clean();

        $this->assertStringContainsString('SUMMARY', $content);
        $this->assertStringContainsString('COUPON PERFORMANCE', $content);
        $this->assertStringContainsString('CSV10', $content);
        $this->assertStringContainsString('VAT', $content);
        $this->assertStringContainsString('REFUNDS', $content);
        $this->assertStringContainsString('REVIEWS', $content);
        $this->assertStringContainsString('MOST WISHED FOR', $content);
    }

    public function test_support_cannot_open_reports(): void
    {
        $support = User::factory()->create(['role' => 'support', 'two_factor_confirmed_at' => now()]);

        $this->actingAs($support)
            ->get('/admin/reports')
            ->assertForbidden();
    }
}
