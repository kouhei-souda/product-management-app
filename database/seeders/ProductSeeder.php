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
            [
                'name' => 'オーバーサイズTシャツ',
                'price' => 3980,
                'stock' => 20,
                'category_id' => 1,
                'description' => 'ゆったりとしたシルエットで着回しやすい定番Tシャツ。',
                'image_path' => 'products/oversize-tshirt.png',
            ],
            [
                'name' => 'ロゴTシャツ',
                'price' => 3500,
                'stock' => 15,
                'category_id' => 1,
                'description' => 'シンプルなロゴデザインが特徴のカジュアルTシャツ。',
                'image_path' => 'products/logo-tshirt.png',
            ],
            [
                'name' => 'スウェットシャツ',
                'price' => 5980,
                'stock' => 10,
                'category_id' => 1,
                'description' => '柔らかな着心地で普段使いしやすいスウェット。',
                'image_path' => 'products/sweat-shirt.png',
            ],
            [
                'name' => 'ニットセーター',
                'price' => 6980,
                'stock' => 8,
                'category_id' => 1,
                'description' => '上品な印象を与えるシンプルなニットセーター。',
                'image_path' => 'products/sweater.png',
            ],
            [
                'name' => 'オックスフォードシャツ',
                'price' => 5480,
                'stock' => 12,
                'category_id' => 1,
                'description' => 'オンオフ問わず活躍する定番シャツ。',
                'image_path' => 'products/oxford-shirt.png',
            ],

            // ボトムス
            [
                'name' => 'ワイドデニム',
                'price' => 7980,
                'stock' => 10,
                'category_id' => 2,
                'description' => 'トレンド感のあるゆったりシルエットのデニム。',
                'image_path' => 'products/wide-denim.png',
            ],
            [
                'name' => 'スキニーデニム',
                'price' => 7480,
                'stock' => 8,
                'category_id' => 2,
                'description' => '脚のラインを美しく見せるスキニーデニム。',
                'image_path' => 'products/skinny-denim.png',
            ],
            [
                'name' => 'カーゴパンツ',
                'price' => 6980,
                'stock' => 12,
                'category_id' => 2,
                'description' => '機能性とデザイン性を兼ね備えたカーゴパンツ。',
                'image_path' => 'products/cargo-pants.png',
            ],
            [
                'name' => 'スラックス',
                'price' => 7980,
                'stock' => 10,
                'category_id' => 2,
                'description' => 'ビジネスからカジュアルまで使えるスラックス。',
                'image_path' => 'products/slacks.png',
            ],
            [
                'name' => 'チノパンツ',
                'price' => 5980,
                'stock' => 15,
                'category_id' => 2,
                'description' => '幅広いコーディネートに合わせやすいチノパンツ。',
                'image_path' => 'products/chino-pants.png',
            ],

            // アウター
            [
                'name' => 'レザージャケット',
                'price' => 19800,
                'stock' => 5,
                'category_id' => 3,
                'description' => '高級感のある本格的なレザージャケット。',
                'image_path' => 'products/leather-jacket.png',
            ],
            [
                'name' => 'コート',
                'price' => 16800,
                'stock' => 5,
                'category_id' => 3,
                'description' => '洗練された印象を与えるロングコート。',
                'image_path' => 'products/coat.png',
            ],
            [
                'name' => 'デニムジャケット',
                'price' => 12800,
                'stock' => 8,
                'category_id' => 3,
                'description' => 'カジュアルスタイルの定番デニムジャケット。',
                'image_path' => 'products/denim-jacket.png',
            ],
            [
                'name' => 'MA-1ジャケット',
                'price' => 14800,
                'stock' => 6,
                'category_id' => 3,
                'description' => 'ミリタリーテイストが魅力のMA-1。',
                'image_path' => 'products/ma-1-jacket.png',
            ],
            [
                'name' => 'マウンテンパーカー',
                'price' => 13800,
                'stock' => 7,
                'category_id' => 3,
                'description' => '機能性とデザイン性を兼ね備えたアウター。',
                'image_path' => 'products/mountain-parka.png',
            ],

            // シューズ
            [
                'name' => 'レザースニーカー',
                'price' => 9800,
                'stock' => 10,
                'category_id' => 4,
                'description' => '上品なレザー素材を使用したスニーカー。',
                'image_path' => 'products/leather-sneakers.png',
            ],
            [
                'name' => 'ブーツ',
                'price' => 15800,
                'stock' => 5,
                'category_id' => 4,
                'description' => 'スマートなシルエットが特徴のブーツ。',
                'image_path' => 'products/boots.png',
            ],
            [
                'name' => 'ローファー',
                'price' => 11800,
                'stock' => 8,
                'category_id' => 4,
                'description' => '幅広いスタイルに合わせやすいローファー。',
                'image_path' => 'products/loafers.png',
            ],
            [
                'name' => 'キャンバススニーカー',
                'price' => 6980,
                'stock' => 12,
                'category_id' => 4,
                'description' => '軽量で履きやすい定番スニーカー。',
                'image_path' => 'products/canvas-sneakers.png',
            ],
            [
                'name' => 'スポーツサンダル',
                'price' => 5980,
                'stock' => 15,
                'category_id' => 4,
                'description' => '快適な履き心地のスポーツサンダル。',
                'image_path' => 'products/sports-sandals.png',
            ],

            // バッグ
            [
                'name' => 'トートバッグ',
                'price' => 12800,
                'stock' => 8,
                'category_id' => 5,
                'description' => '高級感のあるレザートートバッグ。',
                'image_path' => 'products/tote-bag.png',
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => 7980,
                'stock' => 10,
                'category_id' => 5,
                'description' => '普段使いしやすいショルダーバッグ。',
                'image_path' => 'products/shoulder-bag.png',
            ],
            [
                'name' => 'バックパック',
                'price' => 9980,
                'stock' => 12,
                'category_id' => 5,
                'description' => '収納力抜群のバックパック。',
                'image_path' => 'products/bag-pack.png',
            ],
            [
                'name' => 'ボディバッグ',
                'price' => 6980,
                'stock' => 10,
                'category_id' => 5,
                'description' => 'コンパクトで持ち運びやすいバッグ。',
                'image_path' => 'products/body-bag.png',
            ],
            [
                'name' => 'ボストンバッグ',
                'price' => 4980,
                'stock' => 15,
                'category_id' => 5,
                'description' => 'コンパクトながら大容量のバッグ。',
                'image_path' => 'products/boston-bag.png',
            ],

            // アクセサリー
            [
                'name' => 'シルバーネックレス',
                'price' => 3980,
                'stock' => 20,
                'category_id' => 6,
                'description' => 'コーディネートのアクセントになるネックレス。',
                'image_path' => 'products/silver-necklace.png',
            ],
            [
                'name' => 'レザーベルト',
                'price' => 2980,
                'stock' => 15,
                'category_id' => 6,
                'description' => '上質なレザーを使用したベルト。',
                'image_path' => 'products/leather-belt.png',
            ],
            [
                'name' => 'ブレスレット',
                'price' => 2480,
                'stock' => 20,
                'category_id' => 6,
                'description' => 'シンプルで使いやすいブレスレット。',
                'image_path' => 'products/bracelet.png',
            ],
            [
                'name' => 'リング',
                'price' => 1980,
                'stock' => 25,
                'category_id' => 6,
                'description' => '手元をおしゃれに演出するリング。',
                'image_path' => 'products/ring.png',
            ],
            [
                'name' => 'サングラス',
                'price' => 5980,
                'stock' => 10,
                'category_id' => 6,
                'description' => '紫外線対策にも使えるサングラス。',
                'image_path' => 'products/sunglasses.png',
            ],

            // 帽子
            [
                'name' => 'キャップ',
                'price' => 2980,
                'stock' => 15,
                'category_id' => 7,
                'description' => 'カジュアルコーデに合わせやすい定番キャップ。',
                'image_path' => 'products/cap.jpeg',
            ],
            [
                'name' => 'バケットハット',
                'price' => 3480,
                'stock' => 10,
                'category_id' => 7,
                'description' => 'トレンド感のあるバケットハット。',
                'image_path' => 'products/bucket-hat.jpeg',
            ],
            [
                'name' => 'ニット帽',
                'price' => 2480,
                'stock' => 12,
                'category_id' => 7,
                'description' => '寒い季節に活躍するニット帽。',
                'image_path' => 'products/knit.jpeg',
            ],
            [
                'name' => 'ベレー帽',
                'price' => 3980,
                'stock' => 8,
                'category_id' => 7,
                'description' => '上品な印象を演出するベレー帽。',
                'image_path' => 'products/beret.jpeg',
            ],
            [
                'name' => 'メッシュキャップ',
                'price' => 2980,
                'stock' => 10,
                'category_id' => 7,
                'description' => '通気性に優れたメッシュ素材のキャップ。',
                'image_path' => 'products/mesh-cap.jpeg',
            ],

            // 時計
            // [
            //     'name' => 'クロノグラフウォッチ',
            //     'price' => 12800,
            //     'stock' => 5,
            //     'category_id' => 8,
            //     'description' => '多機能でスポーティなデザインの腕時計。',
            //     'image_path' => 'products/chronographwatch.png',,
            // ],
            // [
            //     'name' => 'レザーウォッチ',
            //     'price' => 9800,
            //     'stock' => 8,
            //     'category_id' => 8,
            //     'description' => '上品なレザーベルトを採用した腕時計。',
            //     'image_path' => 'products/leatherwatch.jpg',,
            // ],
            // [
            //     'name' => 'スマートウォッチ',
            //     'price' => 19800,
            //     'stock' => 5,
            //     'category_id' => 8,
            //     'description' => '健康管理や通知機能を備えたスマートウォッチ。',
            //     'image_path' => 'products/smartwatch.jpg',,
            // ],
            // [
            //     'name' => 'ミニマルウォッチ',
            //     'price' => 8800,
            //     'stock' => 10,
            //     'category_id' => 8,
            //     'description' => 'シンプルなデザインが魅力の腕時計。',
            //     'image_path' => 'products/minimalwatch.jpg',,
            // ],
            // [
            //     'name' => 'メタルウォッチ',
            //     'price' => 14800,
            //     'stock' => 6,
            //     'category_id' => 8,
            //     'description' => '重厚感のあるメタルバンドの腕時計。',
            //     'image_path' => 'products/metalwatch.jpg',,
            // ],

            // インナー
            // [
            //     'name' => 'タンクトップ',
            //     'price' => 1980,
            //     'stock' => 20,
            //     'category_id' => 9,
            //     'description' => '重ね着にも使いやすいシンプルなタンクトップ。',
            //     'image_path' => null,
            // ],
            // [
            //     'name' => 'Vネックインナー',
            //     'price' => 2480,
            //     'stock' => 15,
            //     'category_id' => 9,
            //     'description' => '首元がすっきり見えるVネックインナー。',
            //     'image_path' => null,
            // ],
            // [
            //     'name' => 'クルーネックインナー',
            //     'price' => 2480,
            //     'stock' => 15,
            //     'category_id' => 9,
            //     'description' => '定番デザインで着回しやすいインナー。',
            //     'image_path' => null,
            // ],
            // [
            //     'name' => 'ヒートテックシャツ',
            //     'price' => 2980,
            //     'stock' => 20,
            //     'category_id' => 9,
            //     'description' => '保温性に優れた機能性インナー。',
            //     'image_path' => null,
            // ],
            // [
            //     'name' => '長袖インナー',
            //     'price' => 2780,
            //     'stock' => 15,
            //     'category_id' => 9,
            //     'description' => '季節を問わず使える長袖インナー。',
            //     'image_path' => null,
            // ],
        ]);
    }
}
