<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [1, 2, 3]; // Example user IDs, ensure these exist in your database.

        // Seed messages for post_cards with IDs 1, 2, and 3.
        $postCardIds = [1, 2, 3];
        foreach ($postCardIds as $postCardId) {
            foreach ($users as $userId) {
                Message::create([
                    'post_card_id' => $postCardId,
                    'user_id' => $userId,
                    'message' => "This is a sample message from user $userId for post card $postCardId.",
                ]);
            }
        }
    }
}
