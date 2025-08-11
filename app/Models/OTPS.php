<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OTPS extends Model
{
    protected $table = 'otps';

    protected $fillable = ['email', 'otp', 'expires_at'];

    public $timestamps = true;
}

