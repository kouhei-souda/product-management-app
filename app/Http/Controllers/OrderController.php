<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;

class OrderController extends Controller
{
    // DI（依存性注入）でOrderServiceを受け取る
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

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

        // Serviceクラスで注文処理を実行
        try {
            $this->orderService->placeOrder($userId, $cart);
        } catch (\Exception $e) {
            return to_route('cart.index')->with('error', $e->getMessage());
        }

        // カートの中身を削除
        session()->forget('cart');

        return to_route('orders.complete');
    }

    // 購入完了
    public function complete()
    {
        return view('orders.complete');
    }

    // 注文詳細
    public function show(Order $order)
    {
        $orderItems = $order->orderItems()->with('product')->get();

        return view('orders.show', [
            'order' => $order,
            'orderItems' => $orderItems,
        ]);
    }

}
