<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'phone' => '09012345678',
            'postal_code' => '1000001',
            'prefecture' => '東京都',
            'city' => '千代田区',
            'address' => '千代田1-1',
            'building' => '',
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'ユーザー',
            'email' => 'user@example.com',
            'phone' => '09087654321',
            'postal_code' => '1580094',
            'prefecture' => '東京都',
            'city' => '世田谷区',
            'address' => '玉川1-2-3',
            'building' => '玉川メゾン 101',
            'is_admin' => false,
            'password' => Hash::make('password'),
        ]);
    }
}
