<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\OTP;
use App\Helpers\OTPHelper;
use Carbon\Carbon;

class OTPController extends Controller
{
    public function sendOTP(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $otp = OTPHelper::generateOTP($request->email);

        return response()->json(['message' => 'OTP sent successfully', 'otp' => $otp]);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        $otpRecord = OTP::where('email', $request->email)->where('otp', $request->otp)->first();

        if (!$otpRecord || Carbon::now()->gt($otpRecord->expires_at)) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        // OTP is valid, delete it
        $otpRecord->delete();

        return response()->json(['message' => 'OTP verified successfully']);
    }
}
