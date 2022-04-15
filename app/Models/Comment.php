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
        return $this->hasOne(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isOwner()
    {
        return $this->created_by == auth()->user()->id;
    }
}
