<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailTemplateFactory extends Factory
{

    public function definition(): array
    {
       return [
           'title' => $this->faker->word(),
           'subject' => $this->faker->word(),
           'body' => $this->faker->paragraph(),
       ];
    }
}
