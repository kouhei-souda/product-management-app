<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        //商品名検索
        if ($request->filled('search')) {
            $query->where(
                'name',
                'like',
                '%' .$request->search .'%'
            );
        }

        //カテゴリ絞り込み
        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->category_id
            );
        }

        //ソート処理
        if ($request->filled('sort')) {
            switch ($request->sort) {
            //新着順
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;

            //価格が安い順
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            //価格が高い順
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            //商品名順
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            }
        }

        //ページネーション＆ページ移動後検索維持
        $products = $query->paginate(12)->withQueryString();

        //プルダウン表示のため全件取得
        $categories = Category::all();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all();

        return view('products.create', [
            'product' => $product,
            'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'max:1000' ],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        Product::create($validated);

        return to_route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'max:1000' ],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

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

        return to_route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //商品が存在する場合
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();
        return to_route('products.index');
    }
}
