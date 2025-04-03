<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debat extends Model
{
    use HasFactory;

    protected $table = 'debats';
    protected $primaryKey = 'id_debat';

    protected $fillable = [
        'titre',
        'description',
        'image',
        'category',
        'statut',
        'id_user',
        'date_debut',
        'date_fin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    // Relationships
    public function votes()
    {
        return $this->hasMany(Vote::class, 'id_debat');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_debat');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'id_debat');
    }
}

