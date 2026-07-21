<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Override;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Product $product;
    protected Category $category;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();

        $this->user = User::factory()->create([
            'is_admin' => false,
        ]);

        $this->actingAs($this->user);

        $this->product = Product::factory()->create([
            'category_id' => $this->category->id,
            'price' => 3000,
            'stock' => 10,
        ]);
    }

    // オーダー一覧を表示できるか
    public function test_user_can_view_order_history()
    {
        $response = $this->get(route('orders.index'));

        $response->assertStatus(200);
        $response->assertViewIs('orders.index');
        $response->assertViewHas('orders');
    }

    // ゲストユーザーは購入履歴画面へアクセスできない
    public function test_guest_cannot_access_order_history()
    {
        auth()->logout();

        $response = $this->get(route('orders.index'));

        $response->assertRedirect(route('login'));

        $this->assertGuest();
    }

    // 購入確認画面が表示されるか
    public function test_user_can_view_order_confirm_page()
    {
        $this->withSession([
            'cart' => [
                $this->product->id => [
                    'quantity' =>  1,
                ],
            ],
        ]);

        $response = $this->get(route('orders.confirm'));

        $response->assertStatus(200);
        $response->assertViewIs('orders.confirm');
        $response->assertViewHasAll([
            'products',
            'cart',
            'total',
        ]);
    }

    // ゲストユーザーは購入確認画面にアクセスできない
    public function test_guest_cannot_access_order_confirm_page()
    {
        auth()->logout();

        $response = $this->get(route('orders.confirm'));

        $response->assertRedirect(route('login'));

        $this->assertGuest();
    }

    // 注文を正常に作成できること
    public function test_user_can_place_order()
    {
        $this->withSession([
            'cart' => [
                $this->product->id => [
                    'quantity' =>  1,
                ],
            ],
        ]);

        $response = $this->post(route('orders.store'));

        $response->assertRedirect(route('orders.complete'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $this->user->id,
            'total_price' => 3000,
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $this->product->id,
            'quantity' => 1,
            'price' => 3000,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'stock' => 9,
        ]);

        $response->assertSessionMissing('cart');
    }

    // カートが空の場合に注文できないこと
    public function test_user_cannot_place_order_when_cart_is_empty()
    {
        $response = $this->post(route('orders.store'));

        $response->assertRedirect(route('cart.index'));

        $response->assertSessionHas('error', 'カートが空です。');

        $this->assertDatabaseCount('orders', 0);
    }

    // 在庫不足の時に購入できないこと
    public function test_user_cannot_place_order_when_stock_is_insufficient()
    {
        $this->withSession([
            'cart' => [
                $this->product->id => [
                    'quantity' =>  11,
                ],
            ],
        ]);

        $response = $this->post(route('orders.store'));

        $response->assertRedirect(route('cart.index'));

        $response->assertSessionHas('error', "「{$this->product->name}」の在庫が不足しています。");

        $this->assertDatabaseCount('orders', 0);

        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'stock' => 10,
        ]);
    }

    // ユーザーが注文完了画面を表示できること
    public function test_user_can_view_order_complete_page()
    {
        $response = $this->get(route('orders.complete'));

        $response->assertStatus(200);
        $response->assertViewIs('orders.complete');
    }

    // ゲストが注文完了画面にアクセスできないこと
    public function test_guest_cannot_access_order_complete_page()
    {
        auth()->logout();

        $response = $this->get(route('orders.complete'));

        $response->assertRedirect(route('login'));

        $this->assertGuest();
    }

    // ユーザーが注文詳細を表示できること
    public function test_user_can_view_order_detail()
    {
        $order = Order::create([
            'user_id' => $this->user->id,
            'total_price' => 3000,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => 1,
            'price' => 3000,
        ]);

        $response = $this->get(route('orders.show', $order));

        $response->assertStatus(200);
        $response->assertViewIs('orders.show');
        $response->assertViewHasAll([
            'order',
            'orderItems',
        ]);
    }

    // ゲストが注文詳細にアクセスできないこと
    public function test_guest_cannot_access_order_detail()
    {
        $order = Order::create([
            'user_id' => $this->user->id,
            'total_price' => 3000,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => 1,
            'price' => 3000,
        ]);

        auth()->logout();

        $response = $this->get(route('orders.show', $order));

        $response->assertRedirect(route('login'));

        $this->assertGuest();
    }

    // 他人の注文詳細を表示できないこと
    public function test_user_cannot_view_other_users_order()
    {
        $otherUser = User::factory()->create();

        $order = Order::create([
            'user_id' => $otherUser->id,
            'total_price' => 3000,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => 1,
            'price' => 3000,
        ]);

        $response = $this->get(route('orders.show', $order));

        $response->assertForbidden();
    }
}

