<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'image', 'link', 'is_active'];

    // Nếu có thể thêm phương thức để quản lý slider (ví dụ: lấy slider hoạt động)
    public static function activeSliders()
    {
        return self::where('is_active', true)->get();
    }
}
