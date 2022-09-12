<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationSubmissionFactory extends Factory
{
    public function definition()
    {
        return [
            'public' => fake()->boolean(),
            'age' => fake()->numberBetween(18, 50),
            'location' => fake()->country(),
            'attempts' => 1
        ];
    }
}
