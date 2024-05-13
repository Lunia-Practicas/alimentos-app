<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{

    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(),
            'product_id' => Product::factory()->create()->id,
        ];
    }
}
