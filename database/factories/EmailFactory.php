<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'name_client' => $this->faker->name(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
        ];
    }
}
