<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Link;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Link::insert([
            ['title' => 'Consulter le PAG', 'description' => 'Consulter le programme du Benin révélé et les avancements', 'url' =>'https://google.com', 'icon' => 'fi fi-ss-shopping-bag'],
            ['title' => 'Finances & coopération', 'description' => 'Visitez le site du ministères des finances et de la coopération et les grandes lignes du Budget', 'url' =>'https://google.com', 'icon' => 'fi fi-ss-document'], // Add more items here
            ['title' => 'Cadre de vie et environnement', 'description' => 'Prenez le temps de vous documenter sur le cadre de vie au Bénin et des projets d’impact','url' =>'https://google.com', 'icon' => 'fi fi-ss-home'] // Add more items here

        ]);
    }
}
