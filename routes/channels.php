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
    // Example: Check if the user has access to this post card chat
    // You could create a method like `canAccessChat` on your User model to check if the user
    // is associated with this post or has the required permission.

    if ($user->canAccessChat($debatid)) {
        return ['id' => $user->id]; // You can return additional data, if needed
    }

    // Deny access if the user can't access the chat
    return false;
});

Broadcast::channel('chatType', function ($user, $postCardId) {

    return true; // Or more specific logic
});


// Broadcast::channel('chat.{postCardId}', function ($user, $postCardId) {
//     return auth()->check(); // Allow only authenticated users
// });
