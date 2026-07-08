<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    //一覧
    public function index()
    {

        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);

        $products = Product::whereIn('id', $productIds)->get();

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

    //カート追加
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
            //新しく追加
            $cart[$productId] = [
                'quantity' => $request->quantity,
            ];
        }

        //セッションへ保存
        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }
}
