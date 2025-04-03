<?php

namespace App\Http\Controllers;

use App\Models\Debat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DebatController extends Controller
{
    /**
     * Store a newly created debate proposal.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5MB max
            'category'    => 'required|string',
            'email'       => 'required|email',
            'username'    => 'nullable|string|max:255',
            // 'showUser'    => 'nullable|boolean',
            // 'notify'      => 'nullable|boolean',
            'consent'     => 'accepted', // Must be checked
        ]);

        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('debats_images', 'public');
        }

        // Get user ID (if authenticated)
        $userId = Auth::check() ? Auth::id() : null;

        // Create Debate Proposal
        $debat = Debat::create([
            'titre'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
            'category'    => $request->category,
            'statut'      => 'En attente', // Default status
            'id_user'     => $userId, // Assign user ID if logged in
            'date_debut'  => now(),
            'date_fin'    => null, // Can be updated later
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Votre idée de débat a été soumise avec succès.');
    }
}
