<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    public function run()
    {
        Card::insert([


            [
                "title" => "Économie et développement",
                "category"=>"economie_et_developpement",
                "text" => "Croissance économique, emploi, investissements et inégalités.",
                "actionUrl" => "/economie",
                "actionText" => "Voir plus",
                "bgColor" => "#e42452"
            ],

            [
                "title" => "Éducation",
                "category"=>"education",
                "text" => "Accès à l’éducation, innovations pédagogiques, réformes éducatives.",
                "actionUrl" => "/education",
                "actionText" => "Voir plus",
                "bgColor" => "#646464"
            ],

            [
                "title" => "Santé publique",
                "category"=>"sante_publique",
                "text" => "Politiques de santé, couverture médicale universelle, systèmes de soins.",
                "actionUrl" => "/sante",
                "actionText" => "Voir plus",
                "bgColor" => "#1a73e8"
            ],
            [
                "title" => "Relations internationales et intégration régionale",
                "category"=>"relations_internationale",
                "text" => "Diplomatie, commerce international, organisations régionales (CEDEAO, Union africaine).",
                "actionUrl" => "/relations_internationales",
                "actionText" => "Voir plus",
                "bgColor" => "#997315"
            ],
            [
                "title" => "Droits humains et citoyenneté",
                "category"=>"droits_humains_et_citoyennete",
                "text" => "Justice sociale, droits civils, participation citoyenne.",
                "actionUrl" => "/droits",
                "actionText" => "Voir plus",
                "bgColor" => "#c96f1c"
            ],
            [
                "title" => "Politique",
                "category"=>"politique",
                "text" => "Gouvernance, réformes politiques, démocratie participative.",
                "actionUrl" => "/politique",
                "actionText" => "Voir plus",
                "bgColor" => "#7e1abb"
            ],
            [
                "title" => "Environnement et développement durable",
                "category"=>"environnement_et_developpement",
                "text" => "Gestion des ressources naturelles, énergies renouvelables, et protection de l’environnement.",
                "actionUrl" => "/environment",
                "actionText" => "Voir plus",
                "bgColor" => "#147714"
            ],
            [
                "title" => "Technologie et innovation",
                "category"=>"technologie_et_innovation",
                "text" => "Transformation digitale, infrastructures numériques, et soutien aux startups",
                "actionUrl" => "/technologie",
                "actionText" => "Voir plus",
                "bgColor" => "#2e3e84"
            ],
            [
                "title" => "Sécurité et défense",
                "category"=>"securite_et_defense",
                "text" => "Lutte contre l’insécurité, terrorisme, et stabilité régionale.",
                "actionUrl" => "/securite_et_defense",
                "actionText" => "Voir plus",
                "bgColor" => "#7f0e2c"
            ]
            // Add all other cards here
        ]);
    }
}

