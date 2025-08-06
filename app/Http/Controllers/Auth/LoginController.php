<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OTP;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

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

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $otpCode = rand(100000, 999999);
            $expiresAt = now()->addMinutes(10);

            OTP::updateOrCreate(
                ['email' => $user->email],
                ['otp' => $otpCode, 'expires_at' => $expiresAt]
            );

            Mail::to($user->email)->send(new SendOtpMail($otpCode));
            session(['user_email' => $request->email]);

            return redirect()->route('otp.verify.form')->with('email', $user->email);
        }

        return back()->withErrors(['email' => 'Identifiants invalides'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }


    public function showOtpForm(Request $request)
    {
        $email = session('email') ?? $request->input('email');
        if (!$email) {
            return redirect('/login')->withErrors('Aucun email pour vérifier OTP.');
        }
        return view('auth.otp-verify', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = session('user_email'); // or wherever you store it

        if (!$email) {
            return response()->json(['success' => false, 'message' => 'Email not found'], 400);
        }

        $otpRecord = Otp::where('email', $email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            return response()->json(['success' => false, 'message' => 'OTP invalide ou expiré'], 403);
        }

        // Mark user as verified or log them in
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->save();

            Auth::login($user);

            // Delete OTP record after successful verification
            $otpRecord->delete();

            return response()->json(['success' => true, 'message' => 'Vérification réussie']);
        }

        return response()->json(['success' => false, 'message' => 'Utilisateur non trouvé'], 404);
    }



    public function resendOtp(Request $request)
    {
        $email = $request->email;

        if (!$email) {
            return response()->json(['success' => false, 'message' => 'Email is required']);
        }

        $otpCode = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        OTP::updateOrCreate(
            ['email' => $email],
            ['otp' => $otpCode, 'expires_at' => $expiresAt]
        );

        Mail::to($email)->send(new SendOtpMail($otpCode));

        return response()->json(['success' => true, 'message' => 'OTP resent successfully']);
    }
}
