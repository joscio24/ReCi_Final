<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'username',
        'email',
        'status',
    ];

    /**
     * Get the messages associated with this post card.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
