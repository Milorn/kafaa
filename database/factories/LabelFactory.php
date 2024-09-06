<?php

namespace Database\Factories;

use App\Enums\LabelStatus;
use App\Enums\LabelType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Label>
 */
class LabelFactory extends Factory
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
            'status' => fake()->randomElement(LabelStatus::class),
            'starts_on' => fake()->dateTimeBetween('-2 years', 'now'),
            'expires_on' => fake()->dateTimeBetween('-2 years', '+5 years'),
        ];
    }
}
