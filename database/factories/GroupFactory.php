<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => ucwords(fake()->words(3, true)),
            'description' => fake()->paragraph(),
            'recruiting' => true,
            'position' => fake()->randomNumber(2, true)
        ];
    }
}
