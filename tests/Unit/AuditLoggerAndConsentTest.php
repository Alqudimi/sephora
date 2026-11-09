<?php

namespace Tests\Unit;

use App\Models\AuditLog;
use App\Models\Consent;
use App\Models\Product;
use App\Models\User;
use App\Services\Audit\AuditLogger;
use App\Services\Consent\ConsentRecorder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\Feature\CreatesCatalog;
use Tests\TestCase;

class AuditLoggerAndConsentTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_audit_logger_creates_records_with_user_and_request_meta(): void
    {
        $user = User::factory()->create(['role' => 'admin', 'is_admin' => true]);
        $this->actingAs($user);

        $product = $this->makeProduct(['name' => 'Original Name']);

        $audit = AuditLogger::log(
            subject: $product,
            action: 'updated',
            oldValues: ['name' => 'Original Name'],
            newValues: ['name' => 'Updated Name'],
            description: 'Product name updated via admin panel'
        );

        $this->assertInstanceOf(AuditLog::class, $audit);
        $this->assertSame($user->id, $audit->user_id);
        $this->assertSame('updated', $audit->action);
        $this->assertSame($product->getMorphClass(), $audit->auditable_type);
        $this->assertSame($product->id, $audit->auditable_id);
        $this->assertSame(['name' => 'Original Name'], $audit->old_values);
        $this->assertSame(['name' => 'Updated Name'], $audit->new_values);
    }

    public function test_consent_recorder_tracks_user_consent_decisions(): void
    {
        $user = User::factory()->create(['email' => 'consent.test@sephora.ae']);
        $request = Request::create('/cookies', 'POST', [], [], [], [
            'REMOTE_ADDR' => '192.168.1.100',
        ]);

        $recorder = new ConsentRecorder();
        $consent = $recorder->record($request, $user, 'marketing_email', true, '2.1');

        $this->assertInstanceOf(Consent::class, $consent);
        $this->assertSame($user->id, $consent->user_id);
        $this->assertSame('consent.test@sephora.ae', $consent->email);
        $this->assertSame('marketing_email', $consent->type);
        $this->assertSame('2.1', $consent->version);
        $this->assertTrue($consent->accepted);
        $this->assertSame('192.168.1.100', $consent->ip_address);
        $this->assertNotNull($consent->accepted_at);
    }
}

