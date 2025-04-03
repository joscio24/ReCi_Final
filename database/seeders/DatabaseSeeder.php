<?php

namespace Database\Seeders;

use App\Models\User;
// use App\Models\Card;
// use App\Models\Debate;
// use App\Models\Link;
// use App\Models\PostCard;
// use App\Models\Comment;
// use App\Models\;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(CardSeeder::class);
        // $this->call(DebateSeeder::class);
        $this->call(LinkSeeder::class);
        // $this->call(PostCardSeeder::class);
        // $this->call([
        //     UsersTableSeeder::class,
        //     MessagesTableSeeder::class,
        // ]);
        // $this->call(CommentSeeder::class);
        $this->call([
            UtilisateurSeeder::class,
            DebatSeeder::class,
            VoteSeeder::class, // Make sure this matches the actual class name
            CommentaireSeeder::class,
            ChatSeeder::class,
        ]);

    }
}
