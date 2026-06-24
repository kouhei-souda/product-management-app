<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'トップス'],
            ['name' => 'ボトムス'],
            ['name' => 'アウター'],
            ['name' => 'シューズ'],
            ['name' => 'バッグ'],
            ['name' => 'アクセサリー'],
            ['name' => '時計'],
            ['name' => '帽子'],
            ['name' => 'インナー'],
        ]);
    }
}
