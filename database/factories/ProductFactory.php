<?php

namespace Database\Factories;

use App\Models\Category;
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
            'name' => fake()->name,
            'weight' => fake()->randomFloat(2, 0, 100),
            'origin' => fake()->country,
            'price' => fake()->randomFloat(2, 1, 1000),
            'vegan' => fake()->boolean,
            'gluten' => fake()->boolean,
            'category_id' => Category::factory()->create()->id
        ];
    }
}
