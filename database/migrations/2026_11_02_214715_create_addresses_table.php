<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 40)->nullable()->after('email');
            $table->string('loyalty_tier', 20)->default('member')->after('phone');
            $table->unsignedInteger('loyalty_points')->default(0)->after('loyalty_tier');
            $table->boolean('is_admin')->default(false)->after('loyalty_points');
            $table->date('date_of_birth')->nullable()->after('is_admin');
            $table->string('gender', 20)->nullable()->after('date_of_birth');
            $table->string('preferred_language', 10)->default('en')->after('gender');
            $table->string('preferred_store')->nullable()->after('preferred_language');
            $table->json('marketing_preferences')->nullable()->after('preferred_store');
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('label', 50)->nullable();
            $table->string('full_name');
            $table->string('phone', 40);
            $table->string('emirate', 100);
            $table->string('area')->nullable();
            $table->string('street_address');
            $table->string('building')->nullable();
            $table->text('delivery_instructions')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'loyalty_tier', 'loyalty_points', 'is_admin',
                'date_of_birth', 'gender', 'preferred_language', 'preferred_store',
                'marketing_preferences',
            ]);
        });
    }
};
