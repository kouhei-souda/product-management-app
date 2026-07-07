<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        // 画像がアップロードされてる場合は保存、保存先のパスを登録
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $product = Product::create($validated);

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    //更新
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            //古い画像が存在する場合は削除
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            //新しい画像を保存
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $product->update($validated);

        return new ProductResource($product)
            ->response()
            ->setStatusCode(200);
    }

    //削除
    public function destroy(Product $product)
    {
         //画像が存在する場合はpublicフォルダから削除
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return response()->json([
            'message' => '商品を削除しました。'
        ]);
    }
}
