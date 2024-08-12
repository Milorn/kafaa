<?php

namespace Database\Factories;

use App\Enums\LabelType;
use App\Enums\ProfessionalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expert>
 */
class ExpertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(LabelType::class),
            'diploma' => fake()->optional()->sentence(),
            'years_of_experience' => fake()->optional()->numberBetween(0, 20),
            'number_of_projects' => fake()->optional()->numberBetween(0, 20),
            'number_of_metric' => fake()->optional()->numberBetween(0, 20),
            'professional_status' => fake()->randomElement(ProfessionalStatus::class),
        ];
    }
}
