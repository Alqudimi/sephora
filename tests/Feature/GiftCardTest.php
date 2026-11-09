<?php

namespace Tests\Feature;

use App\Models\GiftCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GiftCardTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_can_check_valid_gift_card_balance(): void
    {
        $card = GiftCard::create([
            'code' => '6046123456789012',
            'pin' => '4321',
            'initial_balance' => 500.00,
            'balance' => 350.50,
            'currency' => 'AED',
            'is_active' => true,
        ]);

        $response = $this->postJson(route('gift-card.balance'), [
            'card_number' => '6046 1234 5678 9012',
            'card_pin' => '4321',
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'valid' => true,
                'balance' => '350.50',
                'currency' => 'AED',
            ]);
    }

    public function test_rejects_invalid_gift_card_number(): void
    {
        $response = $this->postJson(route('gift-card.balance'), [
            'card_number' => '9999000011112222',
            'card_pin' => '1234',
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'valid' => false,
                'balance' => '0.00',
            ]);
    }

    public function test_rejects_incorrect_gift_card_pin(): void
    {
        GiftCard::create([
            'code' => '6046123456789012',
            'pin' => '4321',
            'initial_balance' => 500.00,
            'balance' => 500.00,
            'currency' => 'AED',
            'is_active' => true,
        ]);

        $response = $this->postJson(route('gift-card.balance'), [
            'card_number' => '6046123456789012',
            'card_pin' => '9999',
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'valid' => false,
                'balance' => '0.00',
            ]);
    }

    public function test_rejects_inactive_gift_card(): void
    {
        GiftCard::create([
            'code' => '6046000011112222',
            'pin' => '1234',
            'initial_balance' => 200.00,
            'balance' => 200.00,
            'currency' => 'AED',
            'is_active' => false,
        ]);

        $response = $this->postJson(route('gift-card.balance'), [
            'card_number' => '6046000011112222',
            'card_pin' => '1234',
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'valid' => false,
                'balance' => '0.00',
            ]);
    }

    public function test_can_apply_gift_card_at_checkout_and_deduct_on_order(): void
    {
        $card = GiftCard::create([
            'code' => '6046999988887777',
            'pin' => '1122',
            'initial_balance' => 200.00,
            'balance' => 200.00,
            'currency' => 'AED',
            'is_active' => true,
        ]);

        $product = $this->makeProduct(['price' => 150.00, 'stock' => 10]);

        $addResp = $this->postJson(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
        $this->carrySession($addResp);

        $applyResp = $this->postJson(route('checkout.coupon.apply'), [
            'code' => '6046999988887777',
            'delivery_method' => 'standard',
        ]);

        $applyResp->assertOk()
            ->assertJson([
                'success' => true,
                'discount' => 150.00,
            ]);

        $orderResp = $this->post(route('checkout.place'), [
            'customer_name' => 'Sara Al Nuaimi',
            'customer_phone' => '+971501234567',
            'customer_email' => 'sara@example.com',
            'delivery_method' => 'standard',
            'emirate' => 'Dubai',
            'street_address' => 'Villa 12, Jumeirah 1',
            'payment_method' => 'cod',
            'terms' => '1',
        ]);

        $orderResp->assertRedirect();

        $this->assertEquals(50.00, $card->fresh()->balance);
    }
}
