<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
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
}
