<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Debat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VoteController extends Controller
{
    /**
     * Store a new vote for a specific debate.
     */


    public function store(Request $request, $id_debat)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id', // Ensure user exists
            'choix' => 'required|boolean',           // Vote choice must be boolean
        ]);

        $debat = Debat::findOrFail($id_debat);

        $existingVote = Vote::where('id_debat', $id_debat)
            ->where('id_user', $validated['id_user'])
            ->first();

        if ($existingVote) {
            if ($existingVote->choix == $validated['choix']) {
                // User clicks same vote => remove vote (toggle off)
                $existingVote->delete();

                $likesCount = Vote::where('id_debat', $id_debat)->where('choix', true)->count();
                $dislikesCount = Vote::where('id_debat', $id_debat)->where('choix', false)->count();

                return response()->json([
                    'message' => 'Vote retiré.',
                    'likes_count' => $likesCount,
                    'dislikes_count' => $dislikesCount,
                    'vote' => false,  // signal no active vote
                ], 200);
            }

            // Update vote choice
            $existingVote->update(['choix' => $validated['choix']]);
        } else {
            // Create new vote
            Vote::create([
                'id_user' => $validated['id_user'],
                'id_debat' => $id_debat,
                'choix' => $validated['choix'],
                'date_vote' => Carbon::now(),
            ]);
        }

        $likesCount = Vote::where('id_debat', $id_debat)->where('choix', true)->count();
        $dislikesCount = Vote::where('id_debat', $id_debat)->where('choix', false)->count();

        return response()->json([
            'message' => 'Vote ajouté avec succès.',
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'vote' => true,  // signal vote is active
        ], 201);
    }
}
