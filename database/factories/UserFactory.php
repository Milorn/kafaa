<?php

namespace Database\Factories;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fname' => fake()->firstName(),
            'lname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'address' => fake()->optional()->address(),
            'phone' => fake()->optional()->phoneNumber(),
            'job' => fake()->optional()->jobTitle(),
            'type' => fake()->randomElement(UserType::class),
            'remember_token' => Str::random(10),
        ];
    }

    public function type(UserType $type): Factory
    {
        return $this->state(function (array $attributes) use ($type) {
            return [
                'type' => $type,
            ];
        });
    }
}
