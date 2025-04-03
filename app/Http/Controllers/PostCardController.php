<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debat;
use Illuminate\Support\Facades\Storage;

class PostCardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'category' => 'required|string',
            'date_debut' => 'required|string'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('postcards', 'public');
        }

        Debat::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'category' => $request->category,
            'date_debut' => now(),
            'date_fin' => $request->email,
            'statut' => 'pending', // Default status
        ]);

        return redirect()->back()->with('success', 'Votre contribution a été envoyée avec succès !');
    }
}

