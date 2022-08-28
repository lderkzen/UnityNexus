<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelTypeFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => fake()->numberBetween(1, 30000),
            'type' => fake()->word()
        ];
    }
}
