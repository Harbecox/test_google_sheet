<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->realText(200),
            'author' => $this->faker->name(),
            'status' => $this->faker->randomElement(['Allowed', 'Prohibited']),
            'category' => $this->faker->randomElement(['News', 'Sports', 'Entertainment']),
            'views' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
