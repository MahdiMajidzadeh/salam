<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysTable extends Migration
{
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->bigInteger('charge_amount');
        });
    }

    public function down()
    {
        Schema::dropIfExists('days');
    }
}
