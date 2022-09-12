<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    public function definition()
    {
        return [
            'status' => fake()->toUpper(fake()->word())
        ];
    }
}
