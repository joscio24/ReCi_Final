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
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP.'
            ]);
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // OTP is valid, delete it
        $otpRecord->delete();

        // Generate Sanctum token
        $user = Auth::user();
        $token = $user->createToken('YourApp')->plainTextToken;

        // Store token in session
        session(['token' => $token]);
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'expires_at' => now()->addHours(2),
            'user' => $user
        ]);
    }
}
