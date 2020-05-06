<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableFood extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_foods', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type_id')->unsigned();
            $table->bigInteger('food_id')->unsigned();
            $table->tinyInteger('meal_id')->unsigned();
            $table->date('reserve_day');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('available_foods');
    }
}
