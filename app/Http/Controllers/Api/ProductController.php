<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //一覧
    public function index(Request $request)
    {
        return ProductResource::collection(Product::all());
    }

    //詳細
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    //登録
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $product = Product::create($validated);

        return new ProductResource($product);
    }

    //更新
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $product->update($validated);

        return new ProductResource($product);
    }

    //削除
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => '商品を削除しました。'
        ]);
    }
}
