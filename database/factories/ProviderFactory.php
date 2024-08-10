<?php

namespace Database\Factories;

use App\Enums\UserType;
use App\Models\ActivityArea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => (new UserFactory())->type(UserType::Provider),
            'name' => fake()->company(),
            'activity_area_id' => ActivityArea::pluck('id')->random(),
            'register' => fake()->filePath(),
            'website' => fake()->optional()->url(),
        ];
    }
}
