<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Debat;
use App\Enums\Category;
use Symfony\Component\String\Inflector\EnglishInflector;

class DebatFactory extends Factory
{
    protected $model = Debat::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph,
            'image' => 'cover' . $this->faker->randomElement([1, 2, 3, 4]) . '.png',
            'category' => $this->faker->randomElement(Category::cases())->value,
            'statut' => $this->faker->randomElement(['Validé', 'Refusé', 'En attente','Terminé']),
            'id_user' => \App\Models\User::factory(),
            'date_debut' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'date_fin' => $this->faker->optional()->dateTimeBetween('now', '+1 month'),
            'created_at' => $this->faker->dateTimeBetween('-2 months', 'now'), // Set created_at as a random date
            'updated_at' => $this->faker->dateTimeBetween('-2 months', 'now'), // Optionally set updated_at
        ];

    }
}
