<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\GiftCard;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DatabaseSqlSeeder::class,
            AdminUserSeeder::class,
            DemoOrdersSeeder::class,
        ]);

        if (GiftCard::count() === 0) {
            GiftCard::create([
                'code' => '6046888812345678',
                'pin' => '1234',
                'initial_balance' => 500.00,
                'balance' => 500.00,
                'currency' => 'AED',
                'is_active' => true,
                'recipient_name' => 'Sara Al Nuaimi',
                'recipient_email' => 'sara@example.com',
                'sender_name' => 'Sephora UAE Concierge',
                'message' => 'A luxury gift for your beauty journey.',
                'expires_at' => now()->addYear(),
            ]);

            GiftCard::create([
                'code' => '6046555598765432',
                'pin' => '4321',
                'initial_balance' => 250.00,
                'balance' => 250.00,
                'currency' => 'AED',
                'is_active' => true,
                'recipient_name' => 'Mariam Al Zaabi',
                'recipient_email' => 'mariam@example.com',
                'sender_name' => 'Sephora UAE Team',
                'message' => 'Happy shopping!',
                'expires_at' => now()->addYear(),
            ]);

            GiftCard::create([
                'code' => '6046111122223333',
                'pin' => '0000',
                'initial_balance' => 1000.00,
                'balance' => 1000.00,
                'currency' => 'AED',
                'is_active' => true,
                'recipient_name' => 'VIP Customer',
                'sender_name' => 'Sephora UAE Flagship',
                'message' => 'Exclusive VIP beauty credit.',
                'expires_at' => now()->addYears(2),
            ]);
        }
    }
}

