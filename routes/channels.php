<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Debat;

// Broadcast::channel('chat.{postCardId}', function ($user, $postCardId) {
//     // Only allow the user to join the channel if they are authorized for this post card
//     $postCard = PostCard::findOrFail($postCardId);


//     return $user->can('view', $postCard);  // Use appropriate authorization logic here
// });


// Broadcast::channel('chat.{postCardId}', function ($user, $postCardId) {
//     // Ensure the user has access to the chat room
//     return \App\Models\PostCard::find($postCardId) && auth()->check();
// });
// Broadcast::channel('chat.{postCardId}', function ($user, $postCardId) {
//     // Ensure the user is authorized to join this chat
//     return true; // Adjust this as needed based on your application's authorization logic
// });


Broadcast::channel('chat.{debatid}', function ($user, $debatid) {
    // You can implement your own access logic here.
    // For now, allow any authenticated user.
    return ['id' => $user->id, 'name' => $user->name];
});


Broadcast::channel('chatType', function ($user, $postCardId) {

    return true; // Or more specific logic
});


// Broadcast::channel('chat.{postCardId}', function ($user, $postCardId) {
//     return auth()->check(); // Allow only authenticated users
// });
