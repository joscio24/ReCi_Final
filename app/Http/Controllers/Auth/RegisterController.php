<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Point to your register Blade view
    }

    public function register(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->input('role', 'user'), // Default to 'user' if no role is provided
        ]);

        // Check the role of the authenticated user (if required)
        // if (auth()->check() && auth()->user()->role === 'admin') {
        //     // Add logic specific to admins if necessary
        // }

        // Add the user to the 'utilisateur' table
        \DB::table('utilisateurs')->insert([
            // 'id_utilisateur' => $user->id,
            'nom' => $user->name,
            'email' => $user->email,
            'role' => $request->input('role', 'user'), // Default to 'user' if no role is provided
        ]);

        // Redirect to login with a success message
        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }
}
