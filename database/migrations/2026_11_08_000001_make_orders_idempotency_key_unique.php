<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Defensive de-duplication before the unique index: keep the
        // earliest order per idempotency key and drop the rest, so the
        // unique index below can never fail on pre-existing duplicates.
        $orders = DB::table('orders')
            ->whereNotNull('idempotency_key')
            ->orderBy('id', 'asc')
            ->get(['id', 'idempotency_key']);

        $seen = [];
        foreach ($orders as $row) {
            if (isset($seen[$row->idempotency_key])) {
                DB::table('orders')->where('id', $row->id)->delete();
            } else {
                $seen[$row->idempotency_key] = true;
            }
        }

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['idempotency_key']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unique('idempotency_key');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropUnique(['idempotency_key']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index(['idempotency_key']);
        });
    }
};
