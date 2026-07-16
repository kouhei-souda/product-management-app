<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\Category;
use Tests\TestCase;

class UserProductTest extends TestCase
{
    //テストの度にDBリセット
    use RefreshDatabase;

    //一覧表示
    public function test_products_index_can_be_displayed()
    {
        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
    }

    //詳細
    public function test_product_can_be_displayed()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('products.show', $product));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    //検索
    public function test_products_can_be_searched()
    {
        $category = Category::factory()->create();

        Product::factory()->create([
            'name' => 'Tシャツ',
            'category_id' => $category->id,
        ]);

        Product::factory()->create([
            'name' => 'ロゴTシャツ',
            'category_id' => $category->id,
        ]);

        Product::factory()->create([
            'name' => 'パーカー',
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('products.index', ['search' => 'Tシャツ']));

        $response->assertStatus(200);

        $response->assertSee('Tシャツ');
        $response->assertSee('ロゴTシャツ');
        $response->assertDontSee('パーカー');
    }

    //カテゴリ絞り込み
    public function test_products_can_be_filtered_by_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        Product::factory()->create([
            'name' => '商品A',
            'category_id' => $category1->id,
        ]);

        Product::factory()->create([
            'name' => '商品B',
            'category_id' => $category2->id,
        ]);

        $response = $this->get(route('products.index', ['category_id' => $category1->id]));

        $response->assertStatus(200);

        $response->assertSee('商品A');
        $response->assertDontSee('商品B');
    }

    //価格昇順
    public function test_products_can_be_sorted_by_price_ascending()
    {
        $category = Category::factory()->create();

        $productA = Product::factory()->create([
            'name' => 'Tシャツ',
            'price' => 3000,
            'category_id' => $category->id,
        ]);

        $productB = Product::factory()->create([
            'name' => 'ロゴTシャツ',
            'price' => 1000,
            'category_id' => $category->id,
        ]);

        $productC = Product::factory()->create([
            'name' => 'パーカー',
            'price' => 5000,
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('products.index', ['sort' => 'price_asc']));

        $response->assertStatus(200);

        $response->assertSeeInOrder([
            $productB->name,
            $productA->name,
            $productC->name,
        ]);
    }

    //価格降順
    public function test_products_can_be_sorted_by_price_descending()
    {
        $category = Category::factory()->create();

        $productA = Product::factory()->create([
            'name' => 'Tシャツ',
            'price' => 3500,
            'category_id' => $category->id,
        ]);

        $productB = Product::factory()->create([
            'name' => 'ロゴTシャツ',
            'price' => 2500,
            'category_id' => $category->id,
        ]);

        $productC = Product::factory()->create([
            'name' => 'パーカー',
            'price' => 6000,
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('products.index', ['sort' => 'price_desc']));

        $response->assertStatus(200);

        $response->assertSeeInOrder([
            $productC->name,
            $productA->name,
            $productB->name,
        ]);
    }

    //カテゴリ絞り込み＆価格昇順
    public function test_products_can_be_filtered_by_category_and_sorted_by_price()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $productA = Product::factory()->create([
            'name' => 'Tシャツ',
            'price' => 3500,
            'category_id' => $category1->id,
        ]);

        $productB = Product::factory()->create([
            'name' => 'ロゴTシャツ',
            'price' => 2500,
            'category_id' => $category1->id,
        ]);

        $productC = Product::factory()->create([
            'name' => 'デニム',
            'price' => 6000,
            'category_id' => $category2->id,
        ]);

        $response = $this->get(route('products.index', [
            'category_id' => $category1->id,
            'sort' => 'price_asc',
        ]));

        $response->assertStatus(200);

        $response->assertSeeInOrder([
            $productB->name,
            $productA->name,
        ]);

        $response->assertDontSee($productC->name);
    }

}
