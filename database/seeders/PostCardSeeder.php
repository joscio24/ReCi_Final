<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostCard;

class PostCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PostCard::insert([

            [
                'category' => 'Justice',
                'title' => 'Quid de notre système judiciaire ?',
                'description' => 'Je voudrais que nous nous penchons ici sur les compétences de nos tribunaux régionaux et spécialisés.',
                'image' => 'cover1.png',
                'status' => 'En cours'
            ],
            [
                'category' => 'Education',
                'title' => 'Quel avenir pour les AME ?',
                'description' => 'Les aspirants aux métiers d\'enseignants sont reversés dans...',
                'image' => '/cover2.png',
                'status' => 'En cours'
            ],
            [
                'category' => 'Santé',
                'title' => 'Vers un système de santé moderne ?',
                'description' => 'Explorons les réformes nécessaires pour moderniser nos infrastructures de santé.',
                'image' => '/cover3.png',
                'status' => 'En cours'
            ],
            [
                'category' => 'Santé',
                'title' => 'Aménagement des abords de la route des pêches',
                'description' => 'L\'ouverture de l\'aménagement de la route des pêches pour les...',
                'image' => '/cover4.png',
                'status' => 'En cours'
            ]
        ]);

    }
}
