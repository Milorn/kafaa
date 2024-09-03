<?php

namespace Database\Factories;

use App\Models\ActivityArea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'responsible_name' => fake()->name(),
            'responsible_job' => fake()->optional()->jobTitle(),
            'address' => fake()->optional()->address(),
            'phone' => fake()->optional()->phoneNumber(),
            'website' => fake()->optional()->url(),
            'activity_area_id' => ActivityArea::pluck('id')->random(),
        ];
    }
}
