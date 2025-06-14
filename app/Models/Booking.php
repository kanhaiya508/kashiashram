<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

        'payment_status',
        'paid_amount'
    ];
    protected $casts = [
        'booking_from' => 'date',
        'booking_to' => 'date',
    ];

    public function rooms()
    {
        return $this->hasMany(RoomBooking::class);
    }

    public function getDurationInDays()
    {
        if ($this->booking_from && $this->booking_to) {
            return Carbon::parse($this->booking_from)->diffInDays(Carbon::parse($this->booking_to)) + 1;
        }
        return 0;
    }
}
