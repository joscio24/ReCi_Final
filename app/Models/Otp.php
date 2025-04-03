<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    protected $table = 'otps'; // Explicitly define the table name

    protected $fillable = ['email', 'otp', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
