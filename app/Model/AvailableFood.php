<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AvailableFood extends Model
{
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function type()
    {
        return $this->belongsTo(FoodType::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
