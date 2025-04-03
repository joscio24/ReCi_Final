<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = \App\Models\Chat::class;

    public function definition()
    {
        return [
            'id_user' => \App\Models\User::factory(),
            'id_debat' => \App\Models\Debat::factory(),
            'texte' => $this->faker->text,
            'date_message' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
