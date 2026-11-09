<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\GiftCard;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductShade;
use App\Models\Review;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelRelationshipsAndBusinessLogicTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_user_roles_loyalty_and_relationships(): void
    {
        $user = User::factory()->create([
            'role' => 'customer',
            'loyalty_points' => 150,
            'loyalty_tier' => 'member',
        ]);

        $this->assertFalse($user->isAdmin());
        $this->assertFalse($user->isStaff());
        $this->assertTrue($user->hasRole('customer'));

        // Award points auto-progresses tier
        $user->awardLoyaltyPoints(100); // 250 -> silver
        $user->refresh();
        $this->assertSame(250, $user->loyalty_points);
        $this->assertSame('silver', $user->loyalty_tier);

        $user->awardLoyaltyPoints(800); // 1050 -> gold
        $user->refresh();
        $this->assertSame(1050, $user->loyalty_points);
        $this->assertSame('gold', $user->loyalty_tier);

        $user->awardLoyaltyPoints(1000); // 2050 -> platinum
        $user->refresh();
        $this->assertSame(2050, $user->loyalty_points);
        $this->assertSame('platinum', $user->loyalty_tier);

        // Address relationship
        $address = Address::create([
            'user_id' => $user->id,
            'full_name' => 'Sara Al Ali',
            'phone' => '+971501112233',
            'street_address' => 'Downtown Dubai',
            'city' => 'Dubai',
            'emirate' => 'Dubai',
            'is_default' => true,
        ]);

        $this->assertCount(1, $user->fresh()->addresses);
        $this->assertSame($user->id, $address->user->id);
    }

    public function test_product_shades_images_and_catalog_relations(): void
    {
        $product = $this->makeProduct(['price' => 200, 'stock' => 10]);

        $image = ProductImage::create([
            'product_id' => $product->id,
            'path' => 'images/products/test.webp',
            'is_primary' => true,
            'sort_order' => 1,
        ]);

        $shade = ProductShade::create([
            'product_id' => $product->id,
            'name' => 'Ruby Woo',
            'hex_color' => '#D80027',
            'stock' => 5,
        ]);

        $product->refresh();

        $this->assertCount(1, $product->images);
        $this->assertSame($product->id, $image->product->id);
        $this->assertCount(1, $product->shades);
        $this->assertSame($product->id, $shade->product->id);
        $this->assertInstanceOf(Brand::class, $product->brand);
        $this->assertCount(1, $product->categories);
    }

    public function test_order_and_order_items_relations(): void
    {
        $order = Order::create([
            'order_number' => 'AE-MDL-001',
            'status' => 'pending',
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => 'Model Customer',
            'customer_phone' => '+971500000000',
            'customer_email' => 'model@example.com',
            'subtotal' => 100,
            'total' => 100,
        ]);

        $item = OrderItem::create([
            'order_id' => $order->id,
            'product_name' => 'Lip Gloss',
            'unit_price' => 50,
            'quantity' => 2,
            'line_total' => 100,
        ]);

        $this->assertCount(1, $order->fresh()->items);
        $this->assertSame($order->id, $item->order->id);
    }

    public function test_gift_card_model_validations(): void
    {
        $card = GiftCard::create([
            'code' => '9999-8888-7777-6666',
            'pin' => '4321',
            'initial_balance' => 500,
            'balance' => 500,
            'currency' => 'AED',
            'is_active' => true,
        ]);

        $this->assertTrue($card->isValid());
        $this->assertFalse($card->isExpired());

        // Deduct balance
        $card->deduct(150);
        $this->assertSame(350.0, (float) $card->fresh()->balance);

        // Deduct remaining
        $card->deduct(350);
        $this->assertSame(0.0, (float) $card->fresh()->balance);
        $this->assertFalse($card->isValid());
    }

    public function test_banner_and_offer_scopes(): void
    {
        Banner::create([
            'title' => 'Active Banner',
            'image_path' => 'images/banners/banner1.webp',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Banner::create([
            'title' => 'Inactive Banner',
            'image_path' => 'images/banners/banner2.webp',
            'is_active' => false,
            'sort_order' => 2,
        ]);

        $activeBanners = Banner::where('is_active', true)->get();
        $this->assertCount(1, $activeBanners);
        $this->assertSame('Active Banner', $activeBanners->first()->title);

        Offer::create([
            'title' => 'Active Offer',
            'description' => 'Active offer description',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Offer::create([
            'title' => 'Inactive Offer',
            'description' => 'Inactive offer description',
            'is_active' => false,
            'sort_order' => 2,
        ]);

        $activeOffers = Offer::where('is_active', true)->get();
        $this->assertCount(1, $activeOffers);
        $this->assertSame('Active Offer', $activeOffers->first()->title);
    }
}
