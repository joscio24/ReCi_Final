<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire';

    protected $fillable = [
        'id_user',
        'id_debat',
        'id_vote',
        'texte',
        'date_commentaire',
        'id_parent_commentaire',
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

    public function vote()
    {
        return $this->belongsTo(Vote::class, 'id_vote');
    }

    public function replies()
    {
        return $this->hasMany(Commentaire::class, 'id_parent_commentaire');
    }

    public function likes()
{
    return $this->belongsToMany(User::class, 'comment_likes', 'commentaire_id', 'user_id')->withTimestamps();
}

}

