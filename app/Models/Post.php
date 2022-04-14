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
    
    public function thumbnailUrl($prefix = 'storage/')
    {
        return Storage::url($this->thumbnail_path ?: self::DEFAULT_THUMBNAIL);
    }

    public function isOwner()
    {
        return $this->created_by == auth()->user()->id;
    }
}
