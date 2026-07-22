<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Override;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Product $product;
    protected OrderService $orderService;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->product = Product::factory()->create([
            'price' => 1000,
            'stock' => 10,
        ]);

        $this->orderService = app(OrderService::class);
    }

    // 注文処理を実行するとordersテーブルに注文が作成される
    public function test_place_order_create_order()
    {
        $cart = [
            $this->product->id => [
                'quantity' => 1,
            ],
        ];

        $this->orderService->placeOrder(
            $this->user->id,
            $cart
        );

        $this->assertDatabaseHas('orders', [
            'user_id' => $this->user->id,
            'total_price' => 1000,
        ]);
    }

    // 注文処理を実行するとorder_itemsテーブルに注文が作成される
    public function test_place_order_create_order_items()
    {
        $cart = [
            $this->product->id => [
                'quantity' => 1,
            ],
        ];

        $this->orderService->placeOrder(
            $this->user->id,
            $cart
        );

        $order = Order::where('user_id', $this->user->id)->first();

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => 1,
            'price' => $this->product->price,
        ]);
    }

    // 注文処理を実行するとproductテーブルの在庫が減る
    public function test_place_order_decreases_product_stock()
    {
        $cart = [
            $this->product->id => [
                'quantity' => 1,
            ],
        ];

        $this->orderService->placeOrder(
            $this->user->id,
            $cart
        );

        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'stock' => 9,
        ]);
    }

    // 注文処理を実行すると合計金額が正しく計算される
    public function test_place_order_calculates_total_price_correctly()
    {
        $product2 = Product::factory()->create([
            'price' => 3000,
            'stock' => 10,
        ]);

        $cart = [
            $this->product->id => [
                'quantity' => 3,
            ],
            $product2->id => [
                'quantity' => 5,
            ],
        ];

        $this->orderService->placeOrder(
            $this->user->id,
            $cart
        );

        $this->assertDatabaseHas('orders', [
            'user_id' => $this->user->id,
            'total_price' => 18000,
        ]);
    }

    // 商品の在庫数を超えて注文をすると例外が発生する
    public function test_place_order_throws_exception_when_stock_is_insufficient()
    {
        $cart = [
            $this->product->id => [
                'quantity' => 11,
            ],
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("「{$this->product->name}」の在庫が不足しています。");

        $this->orderService->placeOrder(
            $this->user->id,
            $cart
        );
    }
}