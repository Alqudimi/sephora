<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create the audit_logs, consents and payment_webhook_events tables.
 * Their models, services and tests already exist — this wires the storage.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── audit_logs: who did what, to which record ────────────────────
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action', 100)->index();
            $table->string('auditable_type', 100)->nullable();
            $table->unsignedBigInteger('auditable_id')->nullable();
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->timestamps();

            $table->index(['auditable_type', 'auditable_id']);
            $table->index('created_at');
        });

        // ── consents: GDPR/cookie consent ledger ─────────────────────────
        Schema::create('consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('email', 150)->nullable()->index();
            $table->string('type', 50);
            $table->string('version', 20)->default('1.0');
            $table->boolean('accepted')->default(false);
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();

            $table->index(['type', 'accepted']);
        });

        // ── payment_webhook_events: gateway webhook idempotency ledger ───
        Schema::create('payment_webhook_events', function (Blueprint $table) {
            $table->id();
            $table->string('gateway', 50)->index();
            $table->string('event_id', 100)->unique();
            $table->string('type', 100);
            $table->json('payload')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_webhook_events');
        Schema::dropIfExists('consents');
        Schema::dropIfExists('audit_logs');
    }
};
