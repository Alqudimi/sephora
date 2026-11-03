<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sephora.test'],
            [
                'name' => 'Store Administrator',
                'password' => Hash::make('Sephora@Admin2024'),
                'is_admin' => true,
                'loyalty_tier' => 'gold',
                'loyalty_points' => 0,
            ]
        );

        // Demo customer for testing account pages
        User::updateOrCreate(
            ['email' => 'demo@sephora.test'],
            [
                'name' => 'Noura Al Mansoori',
                'password' => Hash::make('Sephora@Demo2024'),
                'phone' => '+971501234567',
                'loyalty_tier' => 'gold',
                'loyalty_points' => 1240,
            ]
        );
    }
}
