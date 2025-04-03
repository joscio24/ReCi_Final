<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment; // Ensure the Comment model is imported

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create manual comments for specific PostCard IDs
        Comment::create([
            'post_card_id' => 1,
            'user_id' => 1, // If tied to an existing user
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'content' => 'This is a comment for PostCard 1.',
        ]);

        Comment::create([
            'post_card_id' => 2,
            'user_id' => 2, // If tied to an existing user
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'content' => 'Another comment for PostCard 2.',
        ]);

        Comment::create([
            'post_card_id' => 3,
            'user_id' => null, // Guest user
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'content' => 'Guest comment for PostCard 3.',
        ]);

        // Add more comments as needed
    }
}
