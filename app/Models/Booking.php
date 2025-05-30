<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'gothra',
        'user_type',
        'travel_type',
        'email',
        'phone',
        'aadhar',
        'message',
        'booking_from',
        'booking_to',
        'status',
        'adults',
        'children',
    ];
    protected $casts = [
        'booking_from' => 'date',
        'booking_to' => 'date',
    ];

    public function rooms()
    {
        return $this->hasMany(RoomBooking::class);
    }
}
