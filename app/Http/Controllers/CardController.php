<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function showCards()
    {
        $cards = [
            [
                "title" => "Santé et Social",
                "text" => "Apporter mieux pour l'humain",
                "actionUrl" => "/sante",
                "actionText" => "Voir plus",
                "bgColor" => "#3498db"
            ],
            [
                "title" => "Relations internationales",
                "text" => "S'intégrer au monde",
                "actionUrl" => "/relations",
                "actionText" => "Voir plus",
                "bgColor" => "#2ecc71"
            ],
            [
                "title" => "Éducation",
                "text" => "Créer un système éducatif inclusif et progressif",
                "actionUrl" => "/education",
                "actionText" => "Voir plus",
                "bgColor" => "#7f8c8d"
            ],
            [
                "title" => "Économie",
                "text" => "Construire une économie puissante",
                "actionUrl" => "/economie",
                "actionText" => "Voir plus",
                "bgColor" => "#e74c3c"
            ],
            [
                "title" => "Politique",
                "text" => "Bâtir un Bénin meilleur",
                "actionUrl" => "/politique",
                "actionText" => "Voir plus",
                "bgColor" => "#8e44ad"
            ],
            [
                "title" => "Justice",
                "text" => "Construire un système judiciaire fort et inclusif",
                "actionUrl" => "/justice",
                "actionText" => "Voir plus",
                "bgColor" => "#f39c12"
            ]
        ]; 

        $post_cards = [
            [
                'category' => 'Justice',
                'date' => '12 Aout 2024',
                'title' => 'Quid de notre système judiciaire ?',
                'description' => 'Je voudrais que nous nous penchons ici sur les compétences de nos tribunaux régionaux et spécialisés.',
                'image' => '/cover1.png',
                'status' => 'En cours',
                'comments' => '12k',
                'likes' => '2k',
                'views' => '3m',
            ],
            [
                'category' => 'Santé',
                'date' => '10 Septembre 2024',
                'title' => 'Vers un système de santé moderne ?',
                'description' => 'Explorons les réformes nécessaires pour moderniser nos infrastructures de santé.',
                'image' => '/cover2.png',
                'status' => 'En cours',
                'comments' => '8k',
                'likes' => '1k',
                'views' => '1.5m',
            ],
            [
                'category' => 'Santé',
                'date' => '10 Septembre 2024',
                'title' => 'Vers un système de santé moderne ?',
                'description' => 'Explorons les réformes nécessaires pour moderniser nos infrastructures de santé.',
                'image' => '/cover3.png',
                'status' => 'En cours',
                'comments' => '8k',
                'likes' => '1k',
                'views' => '1.5m',
            ],
            [
                'category' => 'Santé',
                'date' => '10 Septembre 2024',
                'title' => 'Vers un système de santé moderne ?',
                'description' => 'Explorons les réformes nécessaires pour moderniser nos infrastructures de santé.',
                'image' => '/cover4.png',
                'status' => 'En cours',
                'comments' => '8k',
                'likes' => '1k',
                'views' => '1.5m',
            ]
            // Add more cards as needed
        ];


        $debates = [
            ['title' => 'Quel avenir pour les AME ?', 'description' => 'Les aspirants aux métiers d\'enseignants sont reversés dans...'],
            ['title' => 'Aménagement des abords de la route des pêches', 'description' => 'L\'ouverture de l\'aménagement de la route des pêches pour les...'],
            ['title' => 'Quel avenir pour les AME ?', 'description' => 'Les aspirants aux métiers d\'enseignants sont reversés dans...'],

            ['title' => 'Aménagement des abords de la route des pêches', 'description' => 'L\'ouverture de l\'aménagement de la route des pêches pour les...'],
            ['title' => 'Quel avenir pour les AME ?', 'description' => 'Les aspirants aux métiers d\'enseignants sont reversés dans...'],
            ['title' => 'Aménagement des abords de la route des pêches', 'description' => 'L\'ouverture de l\'aménagement de la route des pêches pour les...'],
            // Add more items here
        ];

        $links =
            [
                ['title' => 'Consulter le PAG', 'description' => 'Consulter le programme du Benin révélé et les avancements', 'icon' => 'fi fi-ss-shopping-bag'],
                ['title' => 'Finances & coopération', 'description' => 'Visitez le site du ministères des finances et de la coopération et les grandes lignes du Budget', 'icon' => 'fi fi-ss-document'], // Add more items here
                ['title' => 'Cadre de vie et environnement', 'description' => 'Prenez le temps de vous documenter sur le cadre de vie au Bénin et des projets d’impact', 'icon' => 'fi fi-ss-home'] // Add more items here
        ];




      return view('pages.index', compact('cards', 'post_cards', 'debates', 'links')); // Pass $cards to the view
    }
}
