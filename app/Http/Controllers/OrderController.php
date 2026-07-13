<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    // 購入履歴
    public function index()
    {
        // ログインしてるユーザーの購入履歴
        $orders = Order::where('user_id', auth()->id())->get();

        return view('orders.index', ['orders' => $orders]);
    }

    // 購入確認
    public function confirm()
    {
        // セッションから現在のカートを取得
        $cart = session()->get('cart', []);

        // カートから商品IDを取得
        $productIds = array_keys($cart);

        // 商品IDに値する商品データを取得
        $products = Product::whereIn('id', $productIds)->get();

        // カート内の合計金額を計算
        $total = 0;
        foreach($products as $product) {
            $total += $product->price * $cart[$product->id]['quantity'];
        }

        return view('orders.confirm', [
            'products' => $products,
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    // 購入
    public function store(Request $request)
    {
        // ユーザー情報取得
        $userId = auth()->id();

        // セッションから現在のカートを取得
        $cart = session()->get('cart', []);

        // カートが空なら注文しない
        if (empty($cart)) {
            return to_route('cart.index')->with('error', 'カートが空です。');
        }

        // カートから商品IDを取得
        $productIds = array_keys($cart);

        // 商品IDに値する商品データを取得
        $products = Product::whereIn('id', $productIds)->get();

        // カート内の合計金額を計算
        $totalPrice = 0;
        foreach($products as $product) {
            $totalPrice += $product->price * $cart[$product->id]['quantity'];
        }

        DB::transaction(function () use ($userId, $totalPrice, $products, $cart) {

            // ordersテーブルへ保存
            $order = Order::create([
                'user_id' => $userId,
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
        });

        // カートの中身を削除
        session()->forget('cart');

        return to_route('orders.complete');
    }

    // 購入完了
    public function complete()
    {
        return view('orders.complete');
    }

    public function show(Order $order)
    {
        //
    }


}
