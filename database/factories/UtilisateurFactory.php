<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UtilisateurFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),  // Password is set to 'secret' for testing purposes. In a real-world application, this should be hashed using bcrypt.  // Password is set to 'secret' for testing purposes. In a real-world application, this should be hashed using bcrypt.  // Password is set to 'secret' for testing purposes. In a real-world application, this should be hashed using bcrypt.
            'role' => $this->faker->randomElement(['Admin', 'User']),
        ];
    }
}

