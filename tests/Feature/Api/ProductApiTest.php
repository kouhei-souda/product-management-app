<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    //テストの度にDBリセット
    use RefreshDatabase;

    //一覧表示
    public function test_products_index_can_be_displayed()
    {
        $response = $this->get('/api/products');

        $response->assertOk();
    }

    //詳細
    public function test_product_can_be_displayed()
    {
        $category = Category::factory()->create();

        $product = Product::create([
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => 30,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $response = $this->get("/api/products/{$product->id}");

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'category_id' => $product->category_id,
            'description' => $product->description,
            'image_path' => $product->image_path,
        ]);
    }

    //登録
    public function test_product_can_be_created()
    {
        $category = Category::factory()->create();

        $image = UploadedFile::fake()->image('test.jpg');

        $data = [
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => 10,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image' => $image,
        ];

        $response = $this->post('/api/products', $data);

        $response->assertCreated();

        $this->assertDatabaseHas('products', [
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => 10,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
        ]);
    }

     // 更新
    public function test_product_can_be_updated()
    {
        $category = Category::factory()->create();

        $product = Product::create([
            'name' => 'テスト商品(仮)',
            'price' => 2000,
            'stock' => 20,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $updateData = [
            'name' => 'テスト商品(本)',
            'price' => 2200,
            'stock' => 22,
            'category_id' => $category->id,
        ];

        $response = $this->put("/api/products/{$product->id}", $updateData);

        $response->assertOk();

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'テスト商品(本)',
            'price' => 2200,
            'stock' => 22,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
        ]);
    }

    //削除
    public function test_product_can_be_deleted()
    {
        $category = Category::factory()->create();

        $product = Product::create([
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => 10,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $response = $this->delete("/api/products/{$product->id}");

        $response->assertOk();

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

}