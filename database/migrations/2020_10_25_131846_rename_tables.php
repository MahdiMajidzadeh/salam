<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTables extends Migration
{
    public function up()
    {
        Schema::rename('bookings', 'tahding_bookings');
        Schema::rename('booking_food', 'food_tahding_booking');
        Schema::rename('reservations', 'tahding_reservations');
    }

    public function down()
    {
        Schema::rename('tahding_bookings', 'bookings');
        Schema::rename('food_tahding_booking', 'booking_food');
        Schema::rename('tahding_reservations', 'reservations');
    }
}
