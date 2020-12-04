<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahdigSalonsTable extends Migration
{
    public function up()
    {
        Schema::create('tahdig_salons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tahdig_salons');
    }
}
