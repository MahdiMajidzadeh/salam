<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
