<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    // カートに商品を追加できるか
    public function test_user_can_add_product_to_cart()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('cart.store'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $response->assertRedirect(route('cart.index'));

        $response->assertSessionHas('cart', [
            $product->id => [
                'quantity' => 1,
            ],
        ]);
    }

    // カート一覧を表示できるか
    public function test_user_can_view_cart()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $this->withSession([
            'cart' => [
                $product->id => [
                    'quantity' =>  1,
                ],
            ],
        ]);

        $this->actingAs($user);

        $response = $this->get(route('cart.index'));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    // カート内商品の数量を更新できるか
    public function test_user_can_update_cart_quantity()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $this->withSession([
            'cart' => [
                $product->id => [
                    'quantity' =>  1,
                ],
            ],
        ]);

        $this->actingAs($user);

        $response = $this->patch(route('cart.update', $product), ['quantity' => 3]);

        $response->assertRedirect(route('cart.index'));

        $response->assertSessionHas('cart', [
            $product->id => [
                'quantity' => 3,
            ],
        ]);
    }


    // カートから商品を削除できるか
    public function test_user_can_remove_product_from_cart()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $this->withSession([
            'cart' => [
                $product->id => [
                    'quantity' =>  1,
                ],
            ],
        ]);

        $this->actingAs($user);

        $response = $this->delete(route('cart.destroy', $product));

        $response->assertRedirect(route('cart.index'));

        $response->assertSessionHas('cart', []);
    }

    // 未ログインでは利用できない
    public function test_guest_cannot_access_cart()
    {
        $response = $this->get(route('cart.index'));

        $response->assertRedirect(route('login'));
    }
}