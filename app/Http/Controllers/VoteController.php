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
        // Validate the input
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id', // Ensure the user exists
            'choix' => 'required|boolean',          // Ensure the vote choice is boolean
        ]);

        // Check if the debate exists
        $debat = Debat::findOrFail($id_debat);

        // Check if the user has already voted for this debate
        $existingVote = Vote::where('id_debat', $id_debat)
            ->where('id_user', $validated['id_user'])
            ->first();

        if ($existingVote) {
            // If the user votes the same choice, remove the vote (unvote)
            if ($existingVote->choix == $validated['choix']) {
                $existingVote->delete();

                // Return updated counts
                $likesCount = Vote::where('id_debat', $id_debat)->where('choix', true)->count();
                $dislikesCount = Vote::where('id_debat', $id_debat)->where('choix', false)->count();

                return response()->json([
                    'message' => 'Vote retiré.',
                    'likes_count' => $likesCount,
                    'dislikes_count' => $dislikesCount,
                ], 200);
            }

            // Update the existing vote with the new choice
            $existingVote->update(['choix' => $validated['choix']]);
        } else {
            // Create a new vote
            Vote::create([
                'id_user' => $validated['id_user'],
                'id_debat' => $id_debat,
                'choix' => $validated['choix'],
                'date_vote' => Carbon::now(),
            ]);
        }

        // Return updated counts
        $likesCount = Vote::where('id_debat', $id_debat)->where('choix', true)->count();
        $dislikesCount = Vote::where('id_debat', $id_debat)->where('choix', false)->count();

        return response()->json([
            'message' => 'Vote ajouté avec succès.',
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
        ], 201);
    }
}
