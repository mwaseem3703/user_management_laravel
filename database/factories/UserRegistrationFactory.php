<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserRegistrationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cnic' => fake()->unique()->numerify('#####-#######-#'), // Generates a standard CNIC format
            'telephone' => fake()->phoneNumber(),
            'comments' => fake()->realText(50), // Generates a random dummy sentence
            'profile_picture' => null, // Keeping this null for dummy data
        ];
    }
}