<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'votes';
    protected $primaryKey = 'id_vote';

    protected $fillable = [
        'id_user',
        'id_debat',
        'choix',
        'date_vote',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function debat()
    {
        return $this->belongsTo(Debat::class, 'id_debat');
    }
}

