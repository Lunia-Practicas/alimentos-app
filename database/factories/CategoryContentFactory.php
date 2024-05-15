<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryContentFactory extends Factory
{

    public function definition()
    {
        return [
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->image,
            'category_id' => Category::factory()->create()->id,
        ];
    }

}
