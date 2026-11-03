<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_guest_can_add_product_to_cart(): void
    {
        $product = $this->makeProduct();

        $response = $this->postJson('/cart/add', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('count', 2);

        $this->assertDatabaseCount('cart_items', 1);
    }

    public function test_add_validates_product_exists(): void
    {
        $this->postJson('/cart/add', ['product_id' => 99999])
            ->assertStatus(422)
            ->assertJsonValidationErrors('product_id');
    }

    public function test_add_validates_quantity_bounds(): void
    {
        $product = $this->makeProduct();

        $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 21])
            ->assertStatus(422)
            ->assertJsonValidationErrors('quantity');

        $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 0])
            ->assertStatus(422)
            ->assertJsonValidationErrors('quantity');
    }

    public function test_same_product_same_shade_merges_quantity(): void
    {
        $product = $this->makeProduct();

        $r1 = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($r1);
        $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);

        $this->assertDatabaseCount('cart_items', 1);
        $this->assertDatabaseHas('cart_items', ['quantity' => 2]);
    }

    public function test_cart_update_changes_quantity(): void
    {
        $product = $this->makeProduct();
        $r = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($r);

        $itemId = \DB::table('cart_items')->first()->id;

        $this->postJson('/cart/update', ['item_id' => $itemId, 'quantity' => 5])
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseHas('cart_items', ['id' => $itemId, 'quantity' => 5]);
    }

    public function test_cart_remove_deletes_item(): void
    {
        $product = $this->makeProduct();
        $r = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($r);

        $itemId = \DB::table('cart_items')->first()->id;

        $this->postJson('/cart/remove', ['item_id' => $itemId])->assertOk();

        $this->assertDatabaseCount('cart_items', 0);
    }

    public function test_cart_page_shows_item(): void
    {
        $product = $this->makeProduct(['name' => 'Midnight Recovery Serum']);

        $r = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 1]);
        $this->carrySession($r);

        $this->get('/cart')
            ->assertStatus(200)
            ->assertSee('Midnight Recovery Serum');
    }

    public function test_guest_cart_merges_into_user_cart_on_login(): void
    {
        $product = $this->makeProduct();
        $user = User::factory()->create(['password' => 'SuperSecret123']);

        // Guest session adds an item
        $r = $this->postJson('/cart/add', ['product_id' => $product->id, 'quantity' => 2]);
        $this->carrySession($r);

        // "Login" in the same session context
        $this->post('/sign-in', [
            'email' => $user->email,
            'password' => 'SuperSecret123',
        ]);

        $this->assertDatabaseHas('carts', ['user_id' => $user->id]);
        $this->assertDatabaseCount('cart_items', 1);
        $this->assertDatabaseHas('cart_items', ['product_id' => $product->id, 'quantity' => 2]);
    }
}
