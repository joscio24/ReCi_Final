<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory(20)->create();
    }
}

