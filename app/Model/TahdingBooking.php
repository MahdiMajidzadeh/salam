<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahdingBooking extends Model
{
    use SoftDeletes;

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_tahding_booking', 'booking_id');
    }

    public function defaultFood()
    {
        return $this->belongsTo(Food::class, 'default_food_id');
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function reservations()
    {
        return $this->hasMany(TahdingReservation::class, 'booking_id');
    }
}
