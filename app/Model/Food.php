<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    public function bookings()
    {
        return $this->belongsToMany(TahdigBooking::class);
    }

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
