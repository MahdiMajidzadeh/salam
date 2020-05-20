<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public $timestamps = false;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
