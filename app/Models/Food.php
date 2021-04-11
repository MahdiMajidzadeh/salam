<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use softDeletes;

    protected $table = 'foods';

    public function bookings()
    {
        return $this->belongsToMany(TahdigBooking::class);
    }

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
