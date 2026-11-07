<?php

namespace Tests\Feature;

use App\Filament\Resources\StaffResource;
use App\Filament\Resources\StaffResource\Pages\CreateStaff;
use App\Filament\Resources\StaffResource\Pages\EditStaff;
use App\Filament\Resources\StaffResource\Pages\ListStaff;
use App\Filament\Resources\StaffResource\RelationManagers\AuditLogsRelationManager;
use App\Models\AuditLog;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class AdminStaffManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private User $otherAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'name' => 'Primary Admin',
            'email' => 'primary@sephora.test',
            'role' => 'admin',
            'is_admin' => true,
            'two_factor_confirmed_at' => now(),
        ]);

        $this->otherAdmin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => false,
            'two_factor_confirmed_at' => now(),
        ]);
    }

    public function test_admin_can_browse_staff_but_other_roles_cannot(): void
    {
        $this->actingAs($this->admin)->get('/admin/staff')->assertOk();

        $manager = User::factory()->create(['role' => 'manager', 'two_factor_confirmed_at' => now()]);
        $support = User::factory()->create(['role' => 'support', 'two_factor_confirmed_at' => now()]);

        $this->actingAs($manager)->get('/admin/staff')->assertForbidden();
        $this->actingAs($support)->get('/admin/staff')->assertForbidden();
    }

    public function test_staff_list_only_contains_panel_accounts(): void
    {
        User::factory()->count(3)->create(); // customers

        $this->actingAs($this->admin);

        Livewire::test(ListStaff::class)
            ->assertCanSeeTableRecords(collect([$this->admin, $this->otherAdmin]));
    }

    public function test_admin_can_create_a_support_account(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(CreateStaff::class)
            ->fillForm([
                'name' => 'New Support Agent',
                'email' => 'agent@sephora.test',
                'password' => 'Sup3r-Secret!',
                'role' => 'support',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $agent = User::whereEmail('agent@sephora.test')->first();

        $this->assertNotNull($agent);
        $this->assertSame('support', $agent->role);
        $this->assertTrue($agent->isStaff());
    }

    public function test_force_logout_destroys_sessions_and_writes_audit_log(): void
    {
        $manager = User::factory()->create(['role' => 'manager', 'two_factor_confirmed_at' => now()]);

        DB::table('sessions')->insert([
            'id' => 'sess_test_1',
            'user_id' => $manager->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'test',
            'payload' => 'x',
            'last_activity' => time(),
        ]);

        $this->actingAs($this->admin);

        Livewire::test(ListStaff::class)
            ->callTableAction('forceLogout', record: $manager);

        $this->assertSame(0, DB::table('sessions')->where('user_id', $manager->id)->count());
        $this->assertDatabaseHas('audit_logs', [
            'action' => 'staff.force_logout',
            'auditable_id' => $manager->id,
        ]);
    }

    public function test_reset_2fa_clears_confirmation_and_sessions(): void
    {
        $manager = User::factory()->create([
            'role' => 'manager',
            'two_factor_confirmed_at' => now(),
        ]);

        DB::table('sessions')->insert([
            'id' => 'sess_test_2',
            'user_id' => $manager->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'test',
            'payload' => 'x',
            'last_activity' => time(),
        ]);

        $this->actingAs($this->admin);

        Livewire::test(ListStaff::class)
            ->callTableAction('resetTwoFactor', record: $manager);

        $manager->refresh();

        $this->assertNull($manager->two_factor_confirmed_at);
        $this->assertSame(0, DB::table('sessions')->where('user_id', $manager->id)->count());
    }

    public function test_admin_cannot_delete_themselves(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(ListStaff::class)
            ->assertActionHidden(TestAction::make('delete')->table($this->admin));

        $this->assertFalse(StaffResource::canDelete($this->admin));
    }

    public function test_last_administrator_cannot_be_deleted(): void
    {
        $this->actingAs($this->admin);

        // Two admins exist, so the second admin can be deleted.
        $this->assertTrue(StaffResource::canDelete($this->otherAdmin));

        // Now the target is the only remaining administrator — blocked.
        $this->admin->delete();

        $this->assertFalse(StaffResource::canDelete($this->otherAdmin));

        // A second admin exists again, so the guard lifts.
        User::factory()->create(['role' => 'admin']);

        $this->assertTrue(StaffResource::canDelete($this->otherAdmin));
    }

    public function test_editing_staff_writes_an_audit_log(): void
    {
        $support = User::factory()->create(['role' => 'support', 'name' => 'Old Name']);

        $this->actingAs($this->admin);

        Livewire::test(EditStaff::class, ['record' => $support->id])
            ->fillForm(['name' => 'New Name'])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame('New Name', $support->fresh()->name);
        $this->assertDatabaseHas('audit_logs', [
            'action' => 'staff.updated',
            'auditable_id' => $support->id,
        ]);
    }

    public function test_admin_cannot_demote_themselves_via_a_crafted_request(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(EditStaff::class, ['record' => $this->admin->id])
            ->fillForm([
                'role' => 'support',
                'is_admin' => false,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->admin->refresh();

        $this->assertSame('admin', $this->admin->role);
        $this->assertTrue((bool) $this->admin->is_admin);
    }

    public function test_audit_log_relation_manager_is_read_only(): void
    {
        $manager = User::factory()->create(['role' => 'manager']);
        AuditLog::create([
            'user_id' => $this->admin->id,
            'action' => 'test.event',
            'auditable_type' => 'user',
            'auditable_id' => $manager->id,
            'description' => 'test',
        ]);

        $relation = new AuditLogsRelationManager;

        $this->assertTrue($relation->isReadOnly());
    }
}
