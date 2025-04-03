<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_card_id',
        'user_id',
        'message',
    ];

    /**
     * Get the user who sent this message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post card this message belongs to.
     */
    public function postCard()
    {
        return $this->belongsTo(PostCard::class);
    }

   
}
