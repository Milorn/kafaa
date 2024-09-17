<?php

namespace Database\Factories;

use App\Enums\PostType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = fake('fr_FR')->sentence();

        return [
            'type' => fake()->randomElement(PostType::class),
            'title' => ['fr' => $title, 'ar' => fake()->sentence()],
            'slug' => Str::slug($title),
            'subtitle' => fake()->boolean() ? ['fr' => fake('fr_FR')->sentence(), 'ar' => fake()->sentence()] : null,
            'content' => ['fr' => fake('fr_FR')->text(), 'ar' => fake()->text()],
        ];
    }

    public function document(): Factory
    {
        return $this->state(function () {
            return [
                'type' => PostType::Documents,
            ];
        });
    }
}
