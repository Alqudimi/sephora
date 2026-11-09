<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\GiftCard;
use App\Models\Order;
use App\Models\User;
use App\Policies\AuditLogPolicy;
use App\Policies\GiftCardPolicy;
use App\Policies\OrderPolicy;
use App\Policies\StaffPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PolicyAuthorizationMatrixTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $manager;
    private User $support;
    private User $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin', 'is_admin' => true]);
        $this->manager = User::factory()->create(['role' => 'manager', 'is_admin' => false]);
        $this->support = User::factory()->create(['role' => 'support', 'is_admin' => false]);
        $this->customer = User::factory()->create(['role' => 'customer', 'is_admin' => false]);
    }

    public function test_staff_policy_authorization(): void
    {
        $policy = new StaffPolicy();

        // Only admin can viewAny, view, or manage staff
        $this->assertTrue($policy->viewAny($this->admin));
        $this->assertFalse($policy->viewAny($this->manager));
        $this->assertFalse($policy->viewAny($this->support));
        $this->assertFalse($policy->viewAny($this->customer));

        $otherStaff = User::factory()->create(['role' => 'support']);
        $this->assertTrue($policy->view($this->admin, $otherStaff));
        $this->assertFalse($policy->view($this->manager, $otherStaff));

        // Admin cannot delete their own account
        $this->assertFalse($policy->delete($this->admin, $this->admin));
        $this->assertTrue($policy->delete($this->admin, $otherStaff));
    }

    public function test_gift_card_policy_authorization(): void
    {
        $policy = new GiftCardPolicy();
        $card = GiftCard::create([
            'code' => 'TEST-1234-5678-9012',
            'pin' => '1234',
            'initial_balance' => 100,
            'balance' => 100,
            'currency' => 'AED',
            'is_active' => true,
        ]);

        // Support and managers can view, but only managers and admins can create/update
        $this->assertTrue($policy->viewAny($this->admin));
        $this->assertTrue($policy->viewAny($this->manager));
        $this->assertTrue($policy->viewAny($this->support));
        $this->assertFalse($policy->viewAny($this->customer));

        $this->assertTrue($policy->create($this->admin));
        $this->assertTrue($policy->create($this->manager));
        $this->assertFalse($policy->create($this->support));
        $this->assertFalse($policy->create($this->customer));

        $this->assertTrue($policy->update($this->admin, $card));
        $this->assertTrue($policy->update($this->manager, $card));
        $this->assertFalse($policy->update($this->support, $card));
    }

    public function test_audit_log_policy_authorization(): void
    {
        $policy = new AuditLogPolicy();
        $log = AuditLog::create([
            'user_id' => $this->admin->id,
            'action' => 'tested',
            'auditable_type' => 'App\Models\Order',
            'auditable_id' => 1,
            'description' => 'Test log',
        ]);

        // Global audit viewAny is admin only
        $this->assertTrue($policy->viewAny($this->admin));
        $this->assertFalse($policy->viewAny($this->manager));
        $this->assertFalse($policy->viewAny($this->support));
        $this->assertFalse($policy->viewAny($this->customer));

        // Individual entry view is accessible to staff for order context
        $this->assertTrue($policy->view($this->admin, $log));
        $this->assertTrue($policy->view($this->manager, $log));
        $this->assertTrue($policy->view($this->support, $log));
        $this->assertFalse($policy->view($this->customer, $log));

        // Audit logs are tamper-proof: cannot be created, updated or deleted manually
        $this->assertFalse($policy->create($this->admin));
        $this->assertFalse($policy->update($this->admin, $log));
        $this->assertFalse($policy->delete($this->admin, $log));
    }

    public function test_order_policy_authorization(): void
    {
        $policy = new OrderPolicy();
        $order = Order::create([
            'order_number' => 'AE-POL-001',
            'status' => 'pending',
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Pol Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'pol@example.com',
            'subtotal' => 100,
            'total' => 100,
        ]);

        $this->assertTrue($policy->viewAny($this->admin));
        $this->assertTrue($policy->viewAny($this->manager));
        $this->assertTrue($policy->viewAny($this->support));
        $this->assertFalse($policy->viewAny($this->customer));

        $this->assertTrue($policy->update($this->admin, $order));
        $this->assertTrue($policy->update($this->manager, $order));
        $this->assertTrue($policy->update($this->support, $order));

        $this->assertTrue($policy->delete($this->admin, $order));
        $this->assertFalse($policy->delete($this->manager, $order));
        $this->assertFalse($policy->delete($this->support, $order));
    }
}
