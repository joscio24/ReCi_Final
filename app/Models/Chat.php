<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';
    protected $primaryKey = 'id_message';

    protected $fillable = [
        'id_user',
        'id_debat',
        'texte',
        'date_message',
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

