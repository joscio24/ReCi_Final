<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OTP;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OTPVerificationController extends Controller
{
    public function showOTPForm()
    {
        return view('auth.otp-verification');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $email = session('otp_email');
        if (!$email) {
            return redirect()->route('login')->withErrors(['email' => 'Session expired, please log in again.']);
        }

        $otpRecord = OTP::where('email', $email)->where('otp', $request->otp)->first();

        if (!$otpRecord || Carbon::now()->gt($otpRecord->expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // OTP is valid, delete it
        $otpRecord->delete();

        // Authenticate the user
        $user = \App\Models\User::where('email', $email)->first();
        Auth::login($user);

        // Generate Sanctum token
        $token = $user->createToken('YourApp')->plainTextToken;

        // Optionally: remove session data
        session()->forget('otp_email');

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'expires_at' => now()->addHours(2),
            'user' => $user
        ]);
    }
}
