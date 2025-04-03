<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DebatSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Debat::factory(10)->create();
    }
}

