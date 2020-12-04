<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TahdigSalon extends Model
{
    public $timestamps = false;

    public function reservations()
    {
        return $this->hasMany(TahdigReservation::class);
    }
}
