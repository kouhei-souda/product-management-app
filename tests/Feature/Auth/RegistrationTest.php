<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',

        'phone' => '09012345678',
        'postal_code' => '123-4567',
        'prefecture' => '東京都',
        'city' => '世田谷区',
        'address' => '○○1-2-3',
        'building' => '○○マンション101',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('products.index', absolute: false));
});
