<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'name',
        'gothra',
        'donor_name',
        'occasion',
        'donation_amount',
        'donation_date',
        'contact_details',
        'contact_number',
        'email',
        'note',
    ];
}
