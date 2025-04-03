<?php

namespace App\Helpers;
use App\Models\OTP;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OTPMail;

class OTPHelper {
    public static function generateOTP($email)
    {
        $otp = rand(100000, 999999);
        OTP::updateOrCreate(
            ['email' => $email],
            ['otp' => $otp, 'expires_at' => Carbon::now()->addMinutes(10)]
        );

        Mail::to($email)->send(new OTPMail($otp));

        return $otp;
    }
}
