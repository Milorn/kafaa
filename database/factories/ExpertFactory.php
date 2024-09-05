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
            'lname' => fake()->lastName(),
            'fname' => fake()->firstName(),
            'address' => fake()->optional()->address(),
            'phone' => fake()->optional()->phoneNumber(),
            'diploma' => fake()->optional()->sentence(),
            'professional_status' => fake()->optional()->randomElement(ProfessionalStatus::class),
            'label' => fake()->randomElement(LabelType::class),
            'years_of_experience' => fake()->optional()->numberBetween(0, 20),
            'number_of_projects' => fake()->optional()->numberBetween(0, 20),
            'number_of_metric' => fake()->optional()->numberBetween(0, 20),
        ];
    }
}
