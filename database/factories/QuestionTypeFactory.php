<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionTypeFactory extends Factory
{
    public function definition()
    {
        return [
            'type' => fake()->randomElement(['text', 'textarea', 'number', 'checkbox', 'radio'])
        ];
    }
}
