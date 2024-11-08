<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Provider\en_US\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        $this->faker->addProvider(new Address($this->faker));
        return [
            'name' => fake()->name(),
            'email' => $email = fake()->unique()->safeEmail(),
            'username' => strstr($email, '@', true).rand(100,120),
            'city' => rand(0,1) === 0 ? null : $this->faker->city(),
            'country' => rand(0,1) === 0 ? null : $this->faker->country(),
            'about_me' => rand(0,1) === 0 ? null : $this->faker->text(),
            'email_verified_at' => now(),
            'password' => '123', //static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
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
