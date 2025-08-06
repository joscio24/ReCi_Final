<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Point to your register Blade view
    }

    public function register(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Generate verification token
        $token = Str::random(60);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->input('role', 'user'),
            'verification_token' => $token,
        ]);

        // ✅ Check if email already exists in utilisateurs table before inserting
        $exists = DB::table('utilisateurs')->where('email', $user->email)->exists();

        if (!$exists) {
            DB::table('utilisateurs')->insert([
                'nom' => $user->name,
                'email' => $user->email,
                'role' => $request->input('role', 'user'),
            ]);
        }

        // Send verification email
        Mail::to($user->email)->send(new VerifyEmailMail($token));

        return redirect('/login')->with('success', 'Inscription réussie. Vérifiez votre e-mail pour activer votre compte.');
    }
}
