<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),

            'phone' => fake()->numerify('090########'),
            'postal_code' => fake()->numerify('###-####'),
            'prefecture' => fake()->randomElement([
                '北海道',
                '東京都',
                '神奈川県',
                '大阪府',
                '京都府',
                '愛知県',
                '福岡県',
                '沖縄県',
            ]),
            'city' => fake()->city(),
            'address' => fake()->streetAddress(),
            'building' => fake()->optional()->secondaryAddress(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
