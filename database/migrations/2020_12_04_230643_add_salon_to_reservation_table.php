<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalonToReservationTable extends Migration
{
    public function up()
    {
        Schema::table('tahdig_reservations', function (Blueprint $table) {
            $table->unsignedInteger('salon_id')->after('quantity')->default(1);
        });
    }

    public function down()
    {
        Schema::table('tahdig_reservations', function (Blueprint $table) {
            $table->dropColumn('salon_id');
        });
    }
}
