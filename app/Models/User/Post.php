<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'post_caption', 'media_path', 'media_type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getMediaPathAttribute($posts)
    {
        return Storage::disk('local')->url($posts);
    }
}
