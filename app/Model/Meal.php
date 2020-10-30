<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public $timestamps = false;

    public static function all($columns = ['*'])
    {
        return self::where('is_active', true)->get();
    }

    public function bookings()
    {
        return $this->hasMany(TahdigBooking::class);
    }
}
