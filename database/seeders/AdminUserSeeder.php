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
                'role' => 'admin',
                'loyalty_tier' => 'gold',
                'loyalty_points' => 0,
            ]
        );

        // Demo manager: catalogue, marketing, orders, refunds, customers, content.
        User::updateOrCreate(
            ['email' => 'manager@sephora.test'],
            [
                'name' => 'Catalog Manager',
                'password' => Hash::make('Sephora@Manager2024'),
                'is_admin' => false,
                'role' => 'manager',
                'loyalty_tier' => 'member',
                'loyalty_points' => 0,
            ]
        );

        // Demo support agent: read-only operations + order fulfilment +
        // review moderation — no money movement, no privacy areas.
        User::updateOrCreate(
            ['email' => 'support@sephora.test'],
            [
                'name' => 'Support Agent',
                'password' => Hash::make('Sephora@Support2024'),
                'is_admin' => false,
                'role' => 'support',
                'loyalty_tier' => 'member',
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
