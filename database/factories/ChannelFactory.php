<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => fake()->numerify('##################'),
            'name' => fake()->words(3, true),
            'position' => fake()->numberBetween(0, 30000)
        ];
    }
}
