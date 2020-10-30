<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TahdigReservation extends Model
{
    protected $guarded = ['_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(TahdigBooking::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
