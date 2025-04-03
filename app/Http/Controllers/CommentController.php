<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Debat;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $idDebat)
    {
        $request->validate([
            'id_debat' => 'required|exists:debats,id_debat',
            'content' => 'required|string|max:500',
            'id_parent_commentaire' => 'nullable|exists:commentaires,id_commentaire',
            'id_vote' => 'nullable|exists:votes,id_vote',
        ]);

        $Commentaire = Debat::findOrFail($idDebat);

        $Commentaire = $Commentaire->commentaires()->create([
            'id_user' => auth()->id(), // L'utilisateur connecté
            'id_debat' => $idDebat, // ID du débat associé
            'id_vote' => $request->input('id_vote') ?? null, // Optionnel, si lié à un vote
            'texte' => $request->input('content'), // Contenu du commentaire
            'id_parent_commentaire' => $request->input('id_parent_commentaire') ?? null, // Pour les réponses
            'date_commentaire' => now(), // Date actuelle
        ]);

        return response()->json(['message' => 'Commentaire ajouté avec succès!']);
    }

    public function reply(Request $request, $idComment)
    {
        $request->validate([
            'reply_text' => 'required|string|max:500',
        ]);

        $comment = Commentaire::findOrFail($idComment);

        $reply = $comment->replies()->create([
            'id_user' => auth()->id(),
            'id_debat' => $comment->id_debat,
            'texte' => $request->input('reply_text'),
            'id_parent_commentaire' => $idComment,
            'date_commentaire' => now(),
        ]);

        // Load the user to return with the reply
        $reply->load('user');

        return response()->json([
            'message' => 'Reply added successfully!',
            'reply' => [
                'id' => $reply->id,
                'user' => [
                    'id' => $reply->user->id,
                    'name' => $reply->user->name,
                ],
                'texte' => $reply->texte,
                'date_commentaire' => $reply->date_commentaire->format('Y-m-d H:i:s'),
            ]
        ]);
    }



    public function likeComment($idComment)
    {
        $comment = Commentaire::findOrFail($idComment);
        $user = auth()->user();

        if ($comment->likes()->where('user_id', $user->id)->exists()) {
            $comment->likes()->detach($user->id);
            return response()->json(['message' => 'Like retiré', 'liked' => false]);
        } else {
            $comment->likes()->attach($user->id);
            return response()->json(['message' => 'Commentaire liké', 'liked' => true]);
        }
    }
}
