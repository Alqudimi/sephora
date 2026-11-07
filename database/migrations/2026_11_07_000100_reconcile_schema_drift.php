<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reconcile schema drift: the codebase (models, controllers, services, tests)
 * already references these columns/tables, but no migration ever created them.
 * This migration brings the database in line with the application layer.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── users: roles + 2FA + last login ──────────────────────────────
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->nullable()->after('is_admin');
            $table->text('two_factor_secret')->nullable()->after('role');
            $table->text('two_factor_recovery_codes')->nullable()->after('two_factor_secret');
            $table->timestamp('two_factor_confirmed_at')->nullable()->after('two_factor_recovery_codes');
            $table->timestamp('last_login_at')->nullable()->after('two_factor_confirmed_at');
            $table->index(['role']);
        });

        // ── orders: tracking, tax breakdown, payment & lifecycle fields ──
        Schema::table('orders', function (Blueprint $table) {
            $table->string('tracking_number', 100)->nullable()->after('delivery_instructions');
            $table->decimal('subtotal_ex_tax', 10, 2)->nullable()->after('subtotal');
            $table->decimal('tax_rate', 5, 4)->nullable()->after('subtotal_ex_tax');
            $table->decimal('tax_amount', 10, 2)->nullable()->after('tax_rate');
            $table->string('payment_gateway', 50)->nullable()->after('payment_status');
            $table->string('payment_reference', 100)->nullable()->after('payment_gateway');
            $table->json('payment_payload')->nullable()->after('payment_reference');
            $table->string('idempotency_key', 64)->nullable()->after('payment_payload');
            $table->timestamp('shipped_at')->nullable()->after('placed_at');
            $table->timestamp('delivered_at')->nullable()->after('shipped_at');
            $table->timestamp('cancelled_at')->nullable()->after('delivered_at');
            $table->timestamp('refunded_at')->nullable()->after('cancelled_at');
            $table->timestamp('stock_restored_at')->nullable()->after('refunded_at');
            $table->decimal('refund_amount', 10, 2)->nullable()->after('stock_restored_at');
            $table->string('refund_reference', 100)->nullable()->after('refund_amount');
            $table->text('cancel_reason')->nullable()->after('refund_reference');

            $table->index(['idempotency_key']);
            $table->index(['payment_status']);
            $table->index(['placed_at']);
        });

        // ── coupons: description + per-user limit ────────────────────────
        Schema::table('coupons', function (Blueprint $table) {
            $table->text('description')->nullable()->after('value');
            $table->unsignedInteger('per_user_limit')->nullable()->after('usage_limit');
        });

        // ── reviews: verified purchase flag ──────────────────────────────
        Schema::table('reviews', function (Blueprint $table) {
            $table->boolean('is_verified_purchase')->default(false)->after('is_approved');
        });

        // ── stores: activation flag (used by checkout validation) ────────
        Schema::table('stores', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('sort_order');
        });

        // ── products: SEO metadata ───────────────────────────────────────
        Schema::table('products', function (Blueprint $table) {
            $table->string('meta_title', 150)->nullable()->after('description');
            $table->text('meta_description')->nullable()->after('meta_title');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropColumn(['role', 'two_factor_secret', 'two_factor_recovery_codes', 'two_factor_confirmed_at', 'last_login_at']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['idempotency_key']);
            $table->dropIndex(['payment_status']);
            $table->dropIndex(['placed_at']);
            $table->dropColumn([
                'tracking_number', 'subtotal_ex_tax', 'tax_rate', 'tax_amount',
                'payment_gateway', 'payment_reference', 'payment_payload', 'idempotency_key',
                'shipped_at', 'delivered_at', 'cancelled_at', 'refunded_at', 'stock_restored_at',
                'refund_amount', 'refund_reference', 'cancel_reason',
            ]);
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn(['description', 'per_user_limit']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('is_verified_purchase');
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description']);
        });
    }
};
