<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use Tests\TestCase;

class ProductTest extends TestCase
{
    //テストの度にDBリセット
    use RefreshDatabase;

    //一覧表示
    public function test_products_index_can_be_displayed()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
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

        $response = $this->get("/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertSee('テスト商品');
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

        $response = $this->post('/products', $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('products.index'));

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

        $response = $this->put("/products/{$product->id}", $updateData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('products.index'));

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

        $response = $this->delete("/products/{$product->id}");

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    //バリデーション
    //name
    public function test_name_is_required()
    {
        $category = Category::factory()->create();

        $image = UploadedFile::fake()->image('test.jpg');

        $data = [
            'name' => '',
            'price' => 3000,
            'stock' => 10,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image' => $image,
        ];

        $response = $this->post('/products', $data);

        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseCount('products', 0);

    }

    //price
    public function test_price_is_required()
    {
        $category = Category::factory()->create();

         $image = UploadedFile::fake()->image('test.jpg');

        $data = [
            'name' => 'テスト商品',
            'price' => '',
            'stock' => 10,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image' => $image,
        ];

        $response = $this->post('/products', $data);

        $response->assertSessionHasErrors(['price']);

        $this->assertDatabaseCount('products', 0);

    }

    //stock
    public function test_stock_is_required()
    {
        $category = Category::factory()->create();

        $image = UploadedFile::fake()->image('test.jpg');

        $data = [
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => '',
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image' => $image,
        ];

        $response = $this->post('/products', $data);

        $response->assertSessionHasErrors(['stock']);

        $this->assertDatabaseCount('products', 0);

    }

    //category_id_required
    public function test_category_id_is_required()
    {
        $image = UploadedFile::fake()->image('test.jpg');

        $data = [
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => '10',
            'category_id' => '',
            'description' => 'これはテスト商品です。',
            'image' => $image,
        ];

        $response = $this->post('/products', $data);

        $response->assertSessionHasErrors(['category_id']);

        $this->assertDatabaseCount('products', 0);
    }

    //category_id_exists
    public function test_category_id_must_exist()
    {
        $image = UploadedFile::fake()->image('test.jpg');

        $data = [
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => '10',
            'category_id' => 999999,
            'description' => 'これはテスト商品です。',
            'image' => $image,
        ];

        $response = $this->post('/products', $data);

        $response->assertSessionHasErrors(['category_id']);

        $this->assertDatabaseCount('products', 0);
    }

    //description
    public function test_description_is_required()
    {
        $category = Category::factory()->create();

        $image = UploadedFile::fake()->image('test.jpg');

        $data = [
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => 10,
            'category_id' => $category->id,
            'description' => '',
            'image' => $image,
        ];

        $response = $this->post('/products', $data);

        $response->assertSessionHasErrors(['description']);

        $this->assertDatabaseCount('products', 0);

    }

    //検索
    public function test_product_search()
    {
        $category = Category::factory()->create();

        Product::create([
            'name' => 'Tシャツ',
            'price' => 3000,
            'stock' => 50,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        Product::create([
            'name' => 'ロゴTシャツ',
            'price' => 3500,
            'stock' => 30,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        Product::create([
            'name' => 'パーカー',
            'price' => 6000,
            'stock' => 20,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $response = $this->get('/products?search=Tシャツ');

        $response->assertStatus(200);

        $response->assertSee('Tシャツ');
        $response->assertSee('ロゴTシャツ');
        $response->assertDontSee('パーカー');
    }

    //画像アップロード
    public function test_product_image_upload()
    {
        Storage::fake('public');

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

        $response = $this->post('/products', $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => 10,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
        ]);

        $product = Product::first();

        Storage::disk('public')->assertExists($product->image_path);
    }

    //カテゴリ絞り込み
    public function test_products_can_be_filtered_by_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $productA = Product::create([
            'name' => '商品A',
            'price' => 3500,
            'stock' => 50,
            'category_id' => $category1->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $productB = Product::create([
            'name' => '商品B',
            'price' => 2500,
            'stock' => 30,
            'category_id' => $category2->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $response = $this->get('/products?category_id=' . $category1->id);

        $response->assertSee('商品A');
        $response->assertDontSee('商品B');
    }

    //価格昇順
    public function test_products_can_be_sorted_by_price_ascending()
    {
        $category = Category::factory()->create();

        $productA = Product::create([
            'name' => 'Tシャツ',
            'price' => 3500,
            'stock' => 50,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $productB = Product::create([
            'name' => 'ロゴTシャツ',
            'price' => 2500,
            'stock' => 30,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $productC = Product::create([
            'name' => 'パーカー',
            'price' => 6000,
            'stock' => 20,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $response = $this->get('/products?sort=price_asc');

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

        $productA = Product::create([
            'name' => 'Tシャツ',
            'price' => 3500,
            'stock' => 50,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $productB = Product::create([
            'name' => 'ロゴTシャツ',
            'price' => 2500,
            'stock' => 30,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $productC = Product::create([
            'name' => 'パーカー',
            'price' => 6000,
            'stock' => 20,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $response = $this->get('/products?sort=price_desc');

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

        $productA = Product::create([
            'name' => 'Tシャツ',
            'price' => 3500,
            'stock' => 50,
            'category_id' => $category1->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $productB = Product::create([
            'name' => 'ロゴTシャツ',
            'price' => 2500,
            'stock' => 30,
            'category_id' => $category1->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $productC = Product::create([
            'name' => 'デニム',
            'price' => 6000,
            'stock' => 20,
            'category_id' => $category2->id,
            'description' => 'これはテスト商品です。',
            'image_path' => 'products/test.jpg',
        ]);

        $response = $this->get('/products?category_id=' . $category1->id .'&sort=price_asc');

        $response->assertSeeInOrder([
            $productB->name,
            $productA->name,
        ]);

        $response->assertDontSee($productC->name);
    }
}