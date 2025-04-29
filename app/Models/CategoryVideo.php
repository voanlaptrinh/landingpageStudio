<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'subtitle',
        'slug',
        'description',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'category_video_id');
    }
}
