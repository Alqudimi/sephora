<?php

namespace Tests\Feature;

use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\OrderResource\Pages\ViewOrder;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPolicyTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private function staff(string $role): User
    {
        return User::factory()->create([
            'role' => $role,
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);
    }

    private function makeOrder(string $status = 'pending', string $paymentStatus = 'pending'): Order
    {
        return Order::create([
            'order_number' => 'AE-POL-'.substr(uniqid(), -8),
            'status' => $status,
            'payment_method' => 'card',
            'payment_status' => $status === 'delivered' ? 'paid' : $paymentStatus,
            'delivery_method' => 'standard',
            'customer_name' => 'Policy Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'policy@example.com',
            'subtotal' => 100,
            'total' => 100,
        ]);
    }

    public function test_support_can_browse_products_but_cannot_change_them(): void
    {
        $support = $this->staff('support');
        $product = $this->makeProduct();

        $this->actingAs($support)->get('/admin/products')->assertOk();

        // Filament authorises every resource page on mount AND on each
        // Livewire hydration, so these 403s hold for forged requests too.
        $this->actingAs($support)->get('/admin/products/create')->assertForbidden();
        $this->actingAs($support)->get("/admin/products/{$product->id}/edit")->assertForbidden();

        $this->assertFalse(Gate::forUser($support)->allows('create', Product::class));
        $this->assertFalse(Gate::forUser($support)->allows('update', $product));
        $this->assertFalse(Gate::forUser($support)->allows('delete', $product));

        Livewire::test(ListProducts::class)
            ->assertActionHidden(TestAction::make('delete')->table($product))
            ->assertActionHidden(TestAction::make('replicate')->table($product));

        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_manager_can_manage_products(): void
    {
        $manager = $this->staff('manager');
        $product = $this->makeProduct();

        $this->actingAs($manager)->get('/admin/products/create')->assertOk();

        $this->actingAs($manager);

        Livewire::test(CreateProduct::class)
            ->fillForm([
                'name' => 'Manager Created Serum',
                'slug' => 'manager-created-serum',
                'description' => 'Created by a manager.',
                'price' => 150,
                'stock' => 8,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('products', ['name' => 'Manager Created Serum']);

        Livewire::test(EditProduct::class, ['record' => $product->id])
            ->fillForm([
                'name' => 'Manager Updated Serum',
                'description' => 'Updated by a manager.',
                'price' => 110,
                'stock' => 12,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Manager Updated Serum']);
    }

    public function test_support_can_update_order_status_but_cannot_refund(): void
    {
        $support = $this->staff('support');
        $order = $this->makeOrder();

        $this->actingAs($support);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->assertActionVisible('transition_processing')
            ->callAction('transition_processing');

        $this->assertSame('processing', $order->fresh()->status);

        $delivered = $this->makeOrder('delivered');

        $this->assertFalse(Gate::forUser($support)->allows('refund', $delivered));

        Livewire::test(ViewOrder::class, ['record' => $delivered->id])
            ->assertActionHidden('refund');

        $delivered->refresh();

        $this->assertSame('delivered', $delivered->status);
        $this->assertSame('paid', $delivered->payment_status);
    }

    public function test_manager_can_refund_a_delivered_order(): void
    {
        $manager = $this->staff('manager');
        $order = $this->makeOrder('delivered');

        $this->actingAs($manager);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->assertActionVisible('refund')
            ->callAction('refund', data: [
                'refund_amount' => 100,
                'refund_reference' => 'rf_policy_1',
            ]);

        $order->refresh();

        $this->assertSame('refunded', $order->status);
        $this->assertSame('refunded', $order->payment_status);
        $this->assertSame(100.0, $order->refund_amount);
        $this->assertSame('rf_policy_1', $order->refund_reference);
    }

    public function test_role_admin_without_boolean_flag_can_refund(): void
    {
        $admin = $this->staff('admin');
        $order = $this->makeOrder('delivered');

        $this->actingAs($admin);

        Livewire::test(ViewOrder::class, ['record' => $order->id])
            ->callAction('refund', data: ['refund_amount' => 100]);

        $this->assertSame('refunded', $order->fresh()->status);
    }

    public function test_boolean_admin_flag_grants_catalogue_management(): void
    {
        $legacyAdmin = User::factory()->create([
            'role' => 'customer',
            'is_admin' => true,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($legacyAdmin)->get('/admin/products/create')->assertOk();

        $this->actingAs($legacyAdmin);

        Livewire::test(CreateProduct::class)
            ->fillForm([
                'name' => 'Legacy Admin Serum',
                'slug' => 'legacy-admin-serum',
                'description' => 'Created by a legacy boolean admin.',
                'price' => 99,
                'stock' => 3,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('products', ['name' => 'Legacy Admin Serum']);
    }

    /**
     * Customer records are policy-guarded end to end: support reads,
     * managers edit, only admins delete. (Regression: the CustomerPolicy
     * used to be dead code because the User model has no UserPolicy by
     * name, which left the resource open to every staff account.)
     */
    public function test_customer_records_follow_the_role_matrix(): void
    {
        $support = $this->staff('support');
        $manager = $this->staff('manager');
        $customer = User::factory()->create(['role' => null, 'is_admin' => false]);

        // Support can browse and open, but never edit or delete.
        $this->actingAs($support);
        $this->assertTrue(CustomerResource::canViewAny());
        $this->assertTrue(CustomerResource::canEdit($customer) === false);
        $this->assertFalse(CustomerResource::canDelete($customer));
        $this->assertFalse(CustomerResource::canCreate());

        // Managers can create and edit, but not delete.
        $this->actingAs($manager);
        $this->assertTrue(CustomerResource::canViewAny());
        $this->assertTrue(CustomerResource::canCreate());
        $this->assertTrue(CustomerResource::canEdit($customer));
        $this->assertFalse(CustomerResource::canDelete($customer));

        // Deleting accounts is reserved for hard admins.
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($admin);
        $this->assertTrue(CustomerResource::canDelete($customer));
    }

    public function test_customer_cannot_enter_the_admin_panel(): void
    {
        $customer = User::factory()->create([
            'role' => 'customer',
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($customer)->get('/admin')->assertForbidden();
        $this->actingAs($customer)->get('/admin/orders')->assertForbidden();
    }
}
