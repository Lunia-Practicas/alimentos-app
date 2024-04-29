<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'weight' => fake()->numberBetween(1, 15),
            'origin' => fake()->city(),
            'price' => fake()->numberBetween(1, 20),
            'vegan' => fake()->boolean(),
            'gluten' => fake()->boolean(),
        ];
    }
}
