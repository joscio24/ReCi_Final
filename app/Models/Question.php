<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'debat_id',
        'question',
    ];

    public function debat()
    {
        return $this->belongsTo(Debat::class, 'debat_id', 'id_debat');
    }
}
