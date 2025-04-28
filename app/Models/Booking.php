<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'service_id',
        'booking_date', 'booking_time', 'notes', 'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
