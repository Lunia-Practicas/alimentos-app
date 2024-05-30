<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $product = Product::factory()->create();
        return [
            'order_num' => $this->faker->unique(),
            'email' => $this->faker->unique()->email(),
            'product_id' => $product->id,
            'category_id' => $product->category_id,
            'note' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }

}
