<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'post_card_id',
        'user_id',
        'name',
        'email',
        'content',
    ];

    /**
     * Get the post card that owns the comment.
     */
    public function postCard()
    {
        return $this->belongsTo(PostCard::class);
    }

    /**
     * Get the user who authored the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
