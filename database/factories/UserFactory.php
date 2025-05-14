<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
    public function definition(): array {
        return [
            'email'             => $this->faker->unique()->safeEmail(),
            'password'          => Hash::make('123'),
            'first_name'        => $this->faker->firstName(),
            'last_name'         => $this->faker->lastName(),
            'phone'             => $this->faker->phoneNumber(),
        ];
    }
}
