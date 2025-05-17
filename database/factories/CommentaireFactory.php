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
        'texte' => $this->faker->sentence(12),
        'date_commentaire' => $this->faker->dateTimeBetween('-1 month', 'now'),
        'id_parent_commentaire' => null, // Pas de réponse pour l’instant
        'choix' => $this->faker->boolean, // true = pour, false = contre
        'valide' => $this->faker->boolean(80), // 80% de chances que ce soit validé
    ];
}

}
