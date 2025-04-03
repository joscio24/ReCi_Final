<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class LoginController extends Controller
// {
//     public function showLoginForm()
//     {
//         return view('auth.login');
//     }

//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required|min:6',
//         ]);

//         // Attempt to authenticate the user
//         if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
//             // User is authenticated
//             $user = Auth::user();

//             // Create a new Sanctum token
//             $token = $user->createToken('YourApp')->plainTextToken;

//             // Option 1: Redirect with Token as a session value
//             session(['token' => $token]);

//             // Option 2: Pass the token to Blade view
//             return redirect()->intended('/accueil')  // Redirect to the intended URL after login
//                 ->with('token', $token);  // Pass token to Blade view
//         }

//         // If login fails, return with an error message
//         return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
//     }

//     public function logout(Request $request)
//     {
//         Auth::logout();
//         return redirect('/login');
//     }
// }



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OTP;
use App\Helpers\OTPHelper;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $user = Auth::user();

            // Generate and send OTP
            OTPHelper::generateOTP($user->email);

            // Store email in session for OTP verification
            session(['otp_email' => $user->email]);

            // Redirect to OTP verification page
            return redirect()->route('otp.verify.form');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
