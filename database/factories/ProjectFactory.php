<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'started_on' => fake()->dateTimeBetween('-5 years', '+5 years'),
            'finished_on' => fake()->dateTimeBetween('-1 years', '+5 years'),
            'description' => fake()->optional()->text()
        ];
    }
}
