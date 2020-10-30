<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingFood extends Migration
{
    public function up()
    {
        Schema::table('food_tahdig_booking', function (Blueprint $table) {
            $table->boolean('for_inter')->default(false);
            $table->dropTimestamps();
        });
    }

    public function down()
    {
        Schema::table('food_tahdig_booking', function (Blueprint $table) {
            $table->dropColumn('for_inter');
            $table->timestamps();
        });
    }
}
