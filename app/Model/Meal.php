<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public $timestamps = false;

    public function Available()
    {
        return $this->hasMany(AvailableFood::class);
    }
}
