<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityReservation extends Migration
{
    public function up()
    {
        Schema::table('tahdig_reservations', function (Blueprint $table) {
            $table->unsignedTinyInteger('quantity')->after('price')->default(1);
        });
    }

    public function down()
    {
        Schema::table('tahdig_reservations', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
}
