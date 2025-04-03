<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Debate;
class DebateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Debate::insert([

            ['title' => 'Quel avenir pour les AME ?', 'description' => 'Les aspirants aux métiers d\'enseignants sont reversés dans...'],
            ['title' => 'Aménagement des abords de la route des pêches', 'description' => 'L\'ouverture de l\'aménagement de la route des pêches pour les...'],
            ['title' => 'Quel avenir pour les AME ?', 'description' => 'Les aspirants aux métiers d\'enseignants sont reversés dans...'],

            ['title' => 'Aménagement des abords de la route des pêches', 'description' => 'L\'ouverture de l\'aménagement de la route des pêches pour les...'],
            ['title' => 'Quel avenir pour les AME ?', 'description' => 'Les aspirants aux métiers d\'enseignants sont reversés dans...'],
            ['title' => 'Aménagement des abords de la route des pêches', 'description' => 'L\'ouverture de l\'aménagement de la route des pêches pour les...'],
        
        ]);
    }
}
