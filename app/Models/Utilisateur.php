<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur';

    protected $fillable = [
        'nom',
        'email',
        'role',
    ];

    // Relationships
    public function votes()
    {
        return $this->hasMany(Vote::class, 'id_user');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_user');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'id_user');
    }
}

