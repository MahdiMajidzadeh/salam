<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingFood extends Migration
{
    public function up()
    {
        Schema::create('booking_food', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('food_id');
            $table->unsignedInteger('booking_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_food');
    }
}
