<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Debat;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Events\Typing;

class MessageController extends Controller
{
    public function index(Debat $debat)
    {
        return $debat->chats()->with('user')->get();
    }

    public function typing($postCardId)
    {
        // You need

        \Log::info("Typing event for Post Card ID: {$postCardId}");
        // to pass the user ID when creating the Typing event
        // In your controller or wherever you are broadcasting the event
        broadcast(new Typing($postCardId, auth()->id(), auth()->user()->name))->toOthers();


        return response()->json([
            'success' => true,
            'message' => 'User is typing',
            'status' => 'typing',
            'postCardId' => $postCardId
        ]);
    }


    public function store(Request $request, $postCardId)
    {



        $validated = $request->validate([
            'texte' => 'required|string|max:255',
        ]);


        $message = Chat::create([
            'id_debat' => $postCardId,
            'id_user' => auth()->id(),
            'texte' => $validated['texte'],
            'date_message' => now(),
        ]);


        // broadcast(new Typing(auth()->id(), $postCardId))->toOthers();

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['success' => true, 'message' => $message]);
    }
}
