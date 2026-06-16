<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([

            // 食品
            ['name' => 'りんご', 'price' => 100, 'stock' => 50, 'category_id' => 1],
            ['name' => 'バナナ', 'price' => 120, 'stock' => 40, 'category_id' => 1],
            ['name' => 'オレンジ', 'price' => 150, 'stock' => 30, 'category_id' => 1],
            ['name' => '牛乳', 'price' => 200, 'stock' => 20, 'category_id' => 1],

            // 家電
            ['name' => 'テレビ', 'price' => 50000, 'stock' => 5, 'category_id' => 2],
            ['name' => '冷蔵庫', 'price' => 80000, 'stock' => 3, 'category_id' => 2],
            ['name' => '電子レンジ', 'price' => 15000, 'stock' => 8, 'category_id' => 2],
            ['name' => '掃除機', 'price' => 20000, 'stock' => 6, 'category_id' => 2],

            // 書籍
            ['name' => 'Laravel入門', 'price' => 3200, 'stock' => 15, 'category_id' => 3],
            ['name' => 'PHP入門', 'price' => 2800, 'stock' => 10, 'category_id' => 3],
            ['name' => 'SQL実践', 'price' => 3500, 'stock' => 12, 'category_id' => 3],
            ['name' => 'Docker基礎', 'price' => 3000, 'stock' => 7, 'category_id' => 3],

            // 日用品
            ['name' => 'ティッシュ', 'price' => 300, 'stock' => 100, 'category_id' => 4],
            ['name' => '洗剤', 'price' => 500, 'stock' => 50, 'category_id' => 4],
            ['name' => '歯ブラシ', 'price' => 200, 'stock' => 80, 'category_id' => 4],
            ['name' => '石鹸', 'price' => 150, 'stock' => 60, 'category_id' => 4],

            // スポーツ
            ['name' => 'サッカーボール', 'price' => 2500, 'stock' => 10, 'category_id' => 5],
            ['name' => 'バスケットボール', 'price' => 3000, 'stock' => 8, 'category_id' => 5],
            ['name' => 'テニスラケット', 'price' => 12000, 'stock' => 5, 'category_id' => 5],
            ['name' => 'ヨガマット', 'price' => 2000, 'stock' => 15, 'category_id' => 5],
        ]);
    }
}
