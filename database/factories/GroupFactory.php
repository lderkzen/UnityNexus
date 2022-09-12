<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->toUpper(fake()->words(3, true)),
            'description' => fake()->sentences(2, true),
            'recruiting' => true,
            'position' => fake()->randomNumber(2, true)
        ];
    }
}
