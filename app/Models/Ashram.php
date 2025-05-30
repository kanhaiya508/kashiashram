<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ashram extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'type',
        'order',
        'image',
        'active'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
