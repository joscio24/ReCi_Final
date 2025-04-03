<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Chat::factory(70)->create();
    }
}

