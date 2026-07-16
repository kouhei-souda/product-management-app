<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Override;
use Tests\TestCase;

class AdminProductTest extends TestCase
{
    //テストの度にDBリセット
    use RefreshDatabase;

    protected User $admin;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($this->admin);
    }

    //一覧表示
    public function test_admin_products_index_can_be_displayed()
    {
        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(200);
    }

    //詳細
    public function test_admin_product_can_be_displayed()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->get(route('admin.products.show', $product));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    //登録
    public function test_admin_can_create_product()
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

        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'テスト商品',
            'price' => 3000,
            'stock' => 10,
            'category_id' => $category->id,
            'description' => 'これはテスト商品です。',
        ]);
    }

    // 更新
    public function test_admin_can_update_product()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        $updateData = [
            'name' => 'テスト商品(本)',
            'price' => 2200,
            'stock' => 22,
            'category_id' => $category->id,
        ];

        $response = $this->put(route('admin.products.update', $product), $updateData);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'テスト商品(本)',
            'price' => 2200,
            'stock' => 22,
            'category_id' => $category->id,
            'description' => $product->description,
        ]);
    }

    //削除
    public function test_admin_can_delete_product()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->delete(route('admin.products.destroy', $product));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    //nameバリデーション
    public function test__name_is_required()
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

        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseCount('products', 0);

    }

    //priceバリデーション
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

        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionHasErrors(['price']);

        $this->assertDatabaseCount('products', 0);

    }

    //stockバリデーション
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

        $response = $this->post(route('admin.products.store'), $data);

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

        $response = $this->post(route('admin.products.store'), $data);

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

        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionHasErrors(['category_id']);

        $this->assertDatabaseCount('products', 0);
    }

    //descriptionバリデーション
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

        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionHasErrors(['description']);

        $this->assertDatabaseCount('products', 0);

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

        $response = $this->post(route('admin.products.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.products.index'));

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

    // ユーザーは管理画面にアクセスできない
    public function test_user_cannot_access_admin_products()
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $this->actingAs($user);

        $response = $this->get(route('admin.products.index'));

        $response->assertForbidden();
    }

    // 未ログインユーザーは管理画面にアクセスするとログイン画面へリダイレクトされる
    public function test_guest_cannot_access_admin_products()
    {
        auth()->logout();

        $response = $this->get(route('admin.products.index'));

        $response->assertRedirect(route('login'));

        $this->assertGuest();
    }
}