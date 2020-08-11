<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    public function foods()
    {
        return $this->belongsToMany(Food::class);
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
        return $this->hasMany(Reservation::class);
    }
}
