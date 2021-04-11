<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function Foods()
    {
        return $this->hasMany(Food::class);
    }
}
