<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

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
        //並び順が選択せれた時だけソート処理を行う
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

        //ページネーション＆ページ移動後検索条件維持
        $products = $query->paginate(12)->withQueryString();

        //プルダウン表示のため全件取得
        $categories = Category::all();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            ]);
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

}
