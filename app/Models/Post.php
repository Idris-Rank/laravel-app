<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'type',
        'user_id',
        'user_editor_id',
        'image_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user_editor()
    {
        return $this->belongsTo(User::class, 'user_editor_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

}
