<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'content', 'created_by'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isOwner()
    {
        if (auth()->guest()) {
            return false;
        }
        return $this->created_by == auth()->user()->id;
    }

    public function canDelete()
    {
        if (auth()->guest()) {
            return false;
        }
        return $this->isOwner() || $this->post->isOwner() || auth()->user()->isAdmin();
    }
}
