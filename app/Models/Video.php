<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_video_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'video_url',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryVideo::class, 'category_video_id');
    }
}
