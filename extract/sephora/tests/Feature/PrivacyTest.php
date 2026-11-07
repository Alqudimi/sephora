<?php

namespace Tests\Feature;

use App\Models\Consent;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PrivacyTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private function customer(array $attributes = []): User
    {
        return User::factory()->create(array_merge([
            'name' => 'Aisha Customer',
            'email' => 'aisha@example.com',
            'phone' => '+971500000001',
        ], $attributes));
    }

    private function makeOrder(User $user, Product $product, string $orderNumber = 'AE-PDPL-0001'): Order
    {
        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => $user->id,
            'status' => 'delivered',
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'delivery_method' => 'standard',
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone ?: '+971500000000',
            'emirate' => 'Dubai',
            'area' => 'Marina',
            'shipping_address' => '12 Marina Walk',
            'delivery_instructions' => 'Call on arrival',
            'subtotal' => 100,
            'total' => 100,
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => 100,
            'quantity' => 1,
            'line_total' => 100,
        ]);

        return $order;
    }

    public function test_guests_cannot_access_the_privacy_centre(): void
    {
        $this->get(route('account.privacy'))->assertRedirect('/sign-in');
        $this->get(route('account.privacy.export'))->assertRedirect('/sign-in');
        $this->delete(route('account.privacy.destroy'))->assertRedirect('/sign-in');
    }

    public function test_privacy_page_shows_export_and_consent_history(): void
    {
        $user = $this->customer();

        Consent::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'type' => 'marketing',
            'version' => '1.0',
            'accepted' => true,
            'accepted_at' => now(),
        ]);

        $this->actingAs($user)
            ->get(route('account.privacy'))
            ->assertOk()
            ->assertSee('Privacy &amp; My Data', false)
            ->assertSee('Download JSON export')
            ->assertSee('Marketing')
            ->assertSee('Delete my account');
    }

    public function test_export_contains_only_the_authenticated_users_data_and_is_audited(): void
    {
        $user = $this->customer();
        $other = User::factory()->create(['email' => 'other@example.com']);
        $product = $this->makeProduct(['name' => 'Exported Serum']);

        $order = $this->makeOrder($user, $product, 'AE-PDPL-EXPORT');
        $this->makeOrder($other, $product, 'AE-PDPL-OTHER');

        $user->addresses()->create([
            'label' => 'Home',
            'full_name' => 'Aisha Customer',
            'phone' => '+971500000001',
            'emirate' => 'Dubai',
            'area' => 'Marina',
            'street_address' => '12 Marina Walk',
            'building' => 'Tower 1',
            'is_default' => true,
        ]);

        $user->wishlist()->attach($product);
        $user->reviews()->create([
            'product_id' => $product->id,
            'author_name' => $user->name,
            'rating' => 5,
            'title' => 'Lovely',
            'body' => 'Would buy again.',
        ]);

        Consent::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'type' => 'marketing',
            'version' => '1.0',
            'accepted' => true,
            'accepted_at' => now(),
        ]);

        DB::table('carts')->insert([
            'session_id' => 'privacy-cart-1',
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('account.privacy.export'));

        $response->assertOk();
        $this->assertStringContainsString(
            'attachment; filename="sephora-data-export-'.$user->id.'.json"',
            (string) $response->headers->get('content-disposition')
        );

        $payload = $response->json();

        $this->assertSame($user->email, $payload['account']['email']);
        $this->assertArrayNotHasKey('password', $payload['account']);
        $this->assertSame([$order->order_number], array_column($payload['orders'], 'order_number'));
        $this->assertSame($order->order_number, $payload['orders'][0]['order_number']);
        $this->assertSame('Exported Serum', $payload['orders'][0]['items'][0]['product_name']);
        $this->assertSame(['Exported Serum'], $payload['wishlist']);
        $this->assertCount(1, $payload['addresses']);
        $this->assertCount(1, $payload['reviews']);
        $this->assertSame('marketing', $payload['consents'][0]['type']);

        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $user->id,
            'action' => 'account.data.exported',
        ]);
    }

    public function test_deletion_requires_the_current_password(): void
    {
        $user = $this->customer();

        $this->actingAs($user)
            ->delete(route('account.privacy.destroy'), [
                'password' => 'not-the-password',
                'confirm' => '1',
            ])
            ->assertSessionHasErrors('password');

        $this->assertAuthenticatedAs($user);
        $this->assertSame('aisha@example.com', $user->fresh()->email);
        $this->assertDatabaseMissing('audit_logs', ['action' => 'account.deleted']);
    }

    public function test_deletion_requires_explicit_confirmation(): void
    {
        $user = $this->customer();

        $this->actingAs($user)
            ->delete(route('account.privacy.destroy'), ['password' => 'password'])
            ->assertSessionHasErrors('confirm');

        $this->assertSame('aisha@example.com', $user->fresh()->email);
        $this->assertDatabaseMissing('audit_logs', ['action' => 'account.deleted']);
    }

    public function test_deletion_anonymises_the_account_and_retains_only_the_financial_ledger(): void
    {
        $user = $this->customer([
            'role' => 'admin',
            'is_admin' => true,
            'date_of_birth' => '1990-01-01',
            'gender' => 'female',
            'loyalty_tier' => 'Gold',
            'loyalty_points' => 500,
        ]);

        $product = $this->makeProduct();
        $order = $this->makeOrder($user, $product);

        $user->addresses()->create([
            'label' => 'Home',
            'full_name' => 'Aisha Customer',
            'phone' => '+971500000001',
            'emirate' => 'Dubai',
            'area' => 'Marina',
            'street_address' => '12 Marina Walk',
            'building' => 'Tower 1',
            'is_default' => true,
        ]);
        $user->wishlist()->attach($product);
        $user->reviews()->create([
            'product_id' => $product->id,
            'author_name' => $user->name,
            'rating' => 4,
            'title' => 'Nice',
            'body' => 'Good product.',
        ]);
        $consent = Consent::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'type' => 'marketing',
            'version' => '1.0',
            'accepted' => true,
            'accepted_at' => now(),
        ]);
        DB::table('carts')->insert([
            'session_id' => 'privacy-cart-delete',
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $originalId = $user->id;

        $this->actingAs($user)
            ->delete(route('account.privacy.destroy'), [
                'password' => 'password',
                'confirm' => '1',
            ])
            ->assertRedirect(route('home'));

        $this->assertGuest();

        $user->refresh();

        $this->assertSame('Deleted account', $user->name);
        $this->assertNotSame('aisha@example.com', $user->email);
        $this->assertStringStartsWith('deleted+'.$originalId.'-', $user->email);
        $this->assertNull($user->phone);
        $this->assertNull($user->date_of_birth);
        $this->assertNull($user->gender);
        $this->assertSame('member', $user->loyalty_tier);
        $this->assertSame(0, $user->loyalty_points);
        $this->assertSame('customer', $user->role);
        $this->assertFalse($user->is_admin);
        $this->assertFalse($user->hasTwoFactorEnabled());

        $this->assertSame(0, $user->addresses()->count());
        $this->assertSame(0, $user->wishlistItems()->count());
        $this->assertSame(0, $user->reviews()->count());
        $this->assertDatabaseMissing('carts', ['user_id' => $originalId]);

        $order->refresh();
        $this->assertSame('Deleted customer', $order->customer_name);
        $this->assertNull($order->customer_email);
        $this->assertSame('deleted', $order->customer_phone);
        $this->assertNull($order->shipping_address);
        $this->assertNull($order->emirate);
        $this->assertNull($order->area);
        $this->assertNull($order->delivery_instructions);
        $this->assertSame(100.0, $order->total);
        $this->assertSame(1, $order->items()->count());

        $this->assertSame($user->email, $consent->fresh()->email);

        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $originalId,
            'action' => 'account.deleted',
        ]);
        $this->assertDatabaseMissing('users', ['email' => 'aisha@example.com']);
    }
}
