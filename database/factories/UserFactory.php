<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => fake()->numerify('##################'),
            'username' => fake()->userName(),
            'discriminator' => fake()->randomNumber(4, true),
            'joined_at' => fake()->dateTimeThisDecade(),
        ];
    }
}
