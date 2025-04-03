<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    protected $model = \App\Models\Vote::class;

    public function definition()
    {
        return [
            'id_user' => \App\Models\User::factory(),
            'id_debat' => \App\Models\Debat::factory(),
            'choix' => $this->faker->boolean,
            'date_vote' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
