<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentaireFactory extends Factory
{
    protected $model = \App\Models\Commentaire::class;

    public function definition()
    {
        return [
            'id_user' => \App\Models\User::factory(),
            'id_debat' => \App\Models\Debat::factory(),
            'id_vote' => \App\Models\Vote::factory(),
            'texte' => $this->faker->text,
            'date_commentaire' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'id_parent_commentaire' => null, // For now, no parent
        ];
    }
}
