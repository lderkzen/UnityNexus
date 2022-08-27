<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition()
    {
        return [
            'type_id' => fake()->numberBetween(1, 5),
            'position' => fake()->randomNumber(3, true),
            'question' => fake()->sentence(10)
        ];
    }
}
