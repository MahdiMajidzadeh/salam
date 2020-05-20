<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
