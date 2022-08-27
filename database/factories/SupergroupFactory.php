<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupergroupFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => ucwords(fake()->words(3, true)),
            'position' => fake()->randomNumber(2, true)
        ];
    }
}
