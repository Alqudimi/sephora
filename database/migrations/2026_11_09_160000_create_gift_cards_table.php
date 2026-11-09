<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();
            $table->string('code', 32)->unique();
            $table->string('pin', 8)->nullable();
            $table->decimal('initial_balance', 10, 2);
            $table->decimal('balance', 10, 2);
            $table->string('currency', 3)->default('AED');
            $table->boolean('is_active')->default(true);
            $table->string('recipient_name')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('sender_name')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->index(['code', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gift_cards');
    }
};

