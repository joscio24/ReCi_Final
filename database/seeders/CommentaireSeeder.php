<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Commentaire::factory(100)->create();
    }
}

