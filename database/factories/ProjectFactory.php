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
            'started_on' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'finished_on' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'description' => fake()->optional()->text(),
        ];
    }
}
