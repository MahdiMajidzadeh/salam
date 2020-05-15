<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function Available()
    {
        return $this->hasMany(AvailableFood::class);
    }

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
