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

             // トップス
    ['name' => 'オーバーサイズTシャツ', 'price' => 3980, 'stock' => 20, 'category_id' => 1],
    ['name' => 'ロゴTシャツ', 'price' => 3500, 'stock' => 15, 'category_id' => 1],
    ['name' => 'スウェットシャツ', 'price' => 5980, 'stock' => 10, 'category_id' => 1],
    ['name' => 'ニットセーター', 'price' => 6980, 'stock' => 8, 'category_id' => 1],
    ['name' => 'オックスフォードシャツ', 'price' => 5480, 'stock' => 12, 'category_id' => 1],

    // ボトムス
    ['name' => 'ワイドデニム', 'price' => 7980, 'stock' => 10, 'category_id' => 2],
    ['name' => 'スキニーデニム', 'price' => 7480, 'stock' => 8, 'category_id' => 2],
    ['name' => 'カーゴパンツ', 'price' => 6980, 'stock' => 12, 'category_id' => 2],
    ['name' => 'スラックス', 'price' => 7980, 'stock' => 10, 'category_id' => 2],
    ['name' => 'チノパンツ', 'price' => 5980, 'stock' => 15, 'category_id' => 2],

    // アウター
    ['name' => 'レザージャケット', 'price' => 19800, 'stock' => 5, 'category_id' => 3],
    ['name' => 'チェスターコート', 'price' => 16800, 'stock' => 5, 'category_id' => 3],
    ['name' => 'デニムジャケット', 'price' => 12800, 'stock' => 8, 'category_id' => 3],
    ['name' => 'MA-1ジャケット', 'price' => 14800, 'stock' => 6, 'category_id' => 3],
    ['name' => 'マウンテンパーカー', 'price' => 13800, 'stock' => 7, 'category_id' => 3],

    // シューズ
    ['name' => 'レザースニーカー', 'price' => 9800, 'stock' => 10, 'category_id' => 4],
    ['name' => 'チェルシーブーツ', 'price' => 15800, 'stock' => 5, 'category_id' => 4],
    ['name' => 'ローファー', 'price' => 11800, 'stock' => 8, 'category_id' => 4],
    ['name' => 'キャンバススニーカー', 'price' => 6980, 'stock' => 12, 'category_id' => 4],
    ['name' => 'スポーツサンダル', 'price' => 5980, 'stock' => 15, 'category_id' => 4],

    // バッグ
    ['name' => 'レザートートバッグ', 'price' => 12800, 'stock' => 8, 'category_id' => 5],
    ['name' => 'ショルダーバッグ', 'price' => 7980, 'stock' => 10, 'category_id' => 5],
    ['name' => 'バックパック', 'price' => 9980, 'stock' => 12, 'category_id' => 5],
    ['name' => 'ボディバッグ', 'price' => 6980, 'stock' => 10, 'category_id' => 5],
    ['name' => 'キャンバストート', 'price' => 4980, 'stock' => 15, 'category_id' => 5],

    // アクセサリー
    ['name' => 'シルバーネックレス', 'price' => 3980, 'stock' => 20, 'category_id' => 6],
    ['name' => 'レザーベルト', 'price' => 2980, 'stock' => 15, 'category_id' => 6],
    ['name' => 'ブレスレット', 'price' => 2480, 'stock' => 20, 'category_id' => 6],
    ['name' => 'リング', 'price' => 1980, 'stock' => 25, 'category_id' => 6],
    ['name' => 'サングラス', 'price' => 5980, 'stock' => 10, 'category_id' => 6],

    // 時計
    ['name' => 'クロノグラフウォッチ', 'price' => 12800, 'stock' => 5, 'category_id' => 7],
    ['name' => 'レザーウォッチ', 'price' => 9800, 'stock' => 8, 'category_id' => 7],
    ['name' => 'スマートウォッチ', 'price' => 19800, 'stock' => 5, 'category_id' => 7],
    ['name' => 'ミニマルウォッチ', 'price' => 8800, 'stock' => 10, 'category_id' => 7],
    ['name' => 'メタルウォッチ', 'price' => 14800, 'stock' => 6, 'category_id' => 7],

    // 帽子
    ['name' => 'キャップ', 'price' => 2980, 'stock' => 15, 'category_id' => 8],
    ['name' => 'バケットハット', 'price' => 3480, 'stock' => 10, 'category_id' => 8],
    ['name' => 'ニット帽', 'price' => 2480, 'stock' => 12, 'category_id' => 8],
    ['name' => 'ベレー帽', 'price' => 3980, 'stock' => 8, 'category_id' => 8],
    ['name' => 'メッシュキャップ', 'price' => 2980, 'stock' => 10, 'category_id' => 8],

    // インナー
    ['name' => 'タンクトップ', 'price' => 1980, 'stock' => 20, 'category_id' => 9],
    ['name' => 'Vネックインナー', 'price' => 2480, 'stock' => 15, 'category_id' => 9],
    ['name' => 'クルーネックインナー', 'price' => 2480, 'stock' => 15, 'category_id' => 9],
    ['name' => 'ヒートテックシャツ', 'price' => 2980, 'stock' => 20, 'category_id' => 9],
    ['name' => '長袖インナー', 'price' => 2780, 'stock' => 15, 'category_id' => 9],
        ]);
    }
}
