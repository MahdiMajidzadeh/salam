<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function Foods()
    {
        return $this->hasMany(AvailableFood::class);
    }
}
