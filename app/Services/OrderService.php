<?php

namespace App\Services;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function placeOrder(int $userId, array $cart)
    {
        // カートから商品IDを取得
        $productIds = array_keys($cart);

        // 商品IDに値する商品データを取得
        $products = Product::whereIn('id', $productIds)->get();

        // 在庫チェック
        foreach ($products as $product) {
            if ($product->stock < $cart[$product->id]['quantity']) {
                throw new \Exception("「{$product->name}」の在庫が不足しています。");
            }
        }

        // 注文時点のユーザー情報を取得
        $user = User::findOrFail($userId);

        // カート内の合計金額を計算
        $totalPrice = 0;
        foreach($products as $product) {
            $totalPrice += $product->price * $cart[$product->id]['quantity'];
        }

        DB::transaction(function () use ($user, $totalPrice, $products, $cart) {

            // ordersテーブルへ保存
            $order = Order::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'postal_code' => $user->postal_code,
                'prefecture' => $user->prefecture,
                'city' => $user->city,
                'address' => $user->address,
                'building' => $user->building,
                'total_price' => $totalPrice,
            ]);

            // order_itemsテーブルへ保存
            foreach ($products as $product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $cart[$product->id]['quantity'],
                    'price' => $product->price,
                ]);
            }

            // productsテーブルからstock（在庫）を減らす
            foreach ($products as $product) {
                $product->stock -= $cart[$product->id]['quantity'];
                $product->save();
            }
        });
    }
}