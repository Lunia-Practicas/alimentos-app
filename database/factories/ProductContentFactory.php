<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductContentFactory extends Factory
{

    public function definition(): array
    {
        return [
            'description' => $this->faker->paragraph(),
            'title' => $this->faker->word(),
            'product_id' => Product::factory()->create()->id,
        ];
    }
}
