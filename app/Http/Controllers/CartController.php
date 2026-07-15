<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    //カート内一覧
    public function index()
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

        return view('cart.index', [
            'products' => $products,
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    //カートへ商品を追加
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        //セッションから現在のカートを取得
        $cart = session()->get('cart', []);

        $productId = $request->product_id;

        //既にカートにある場合
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity;
        } else {
            //カートになければ新しく追加
            $cart[$productId] = [
                'quantity' => $request->quantity,
            ];
        }

        //セッションへ保存
        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    // カート内更新
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        //セッションから現在のカートを取得
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
        }

        // セッションへ保存
        session()->put('cart', $cart);

        return to_route('cart.index')->with('success', 'カートを更新しました。');
    }

    //カート内の商品を削除
    public function destroy(Product $product)
    {
        // セッションから現在のカートを取得
        $cart = session()->get('cart', []);

        // セッションから該当する配列（id）を削除
        unset($cart[$product->id]);

        // セッションへ保存
        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }
}
