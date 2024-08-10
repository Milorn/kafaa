<?php

namespace Database\Factories;

use App\Enums\PostType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(PostType::class),
            'title' => fake()->sentence(),
            'subtitle' => fake()->boolean() ? ['ar' => fake()->sentence()] : null,
            'content' => ['ar' => fake()->paragraph()],
            'thumbnail' => fake()->filePath(),
        ];
    }
}
