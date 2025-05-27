<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'ashram_id',
        'name',
        'donation',
        'no_of_beds',
        'room_type',
        'image',
        'active'
    ];

    public function ashram()
    {
        return $this->belongsTo(Ashram::class);
    }
    public function bookings()
    {
        return $this->hasMany(RoomBooking::class);
    }
}
