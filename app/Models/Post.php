<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    const DEFAULT_THUMBNAIL = 'thumbnails/default.jpg';

    protected $fillable = [
        'title', 'content', 'thumbnail_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function likeFeedback()
    {
        return $this->feedback()
            ->where('type', 'like');
    }

    public function dislikeFeedback()
    {
        return $this->feedback()
            ->where('type', 'dislike');
    }

    public function userFeedback()
    {
        return $this->hasOne(Feedback::class)
            ->where('created_by', auth()->user()->id);
    }
    
    public function thumbnailUrl($prefix = 'storage/')
    {
        return Storage::url($this->thumbnail_path ?: self::DEFAULT_THUMBNAIL);
    }

    public function isOwner()
    {
        return $this->created_by == auth()->user()->id;
    }

    public function isUserLiked()
    {
        return $this->userFeedback?->type == 'like' ?? false;
    }

    public function isUserDisliked()
    {
        return $this->userFeedback?->type == 'dislike' ?? false;
    }
}
