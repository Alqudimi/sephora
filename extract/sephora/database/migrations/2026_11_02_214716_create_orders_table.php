<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 20)->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('guest_email')->nullable();
            $table->string('status', 30)->default('pending');
            $table->string('payment_method', 30)->default('card');
            $table->string('payment_status', 30)->default('pending');
            $table->string('delivery_method', 30)->default('standard');
            $table->string('customer_name');
            $table->string('customer_phone', 40);
            $table->string('customer_email')->nullable();
            $table->string('emirate', 100)->nullable();
            $table->string('area')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('delivery_instructions')->nullable();
            $table->string('store_id')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->string('coupon_code', 50)->nullable();
            $table->decimal('total', 10, 2);
            $table->unsignedInteger('loyalty_points_earned')->default(0);
            $table->json('samples')->nullable();
            $table->text('gift_message')->nullable();
            $table->boolean('gift_box')->default(false);
            $table->timestamp('placed_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('order_number');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->string('brand_name')->nullable();
            $table->string('shade_name')->nullable();
            $table->string('image_path')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('line_total', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
