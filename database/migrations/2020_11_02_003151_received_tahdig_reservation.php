<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReceivedTahdigReservation extends Migration
{
    public function up()
    {
        Schema::table('tahdig_reservations', function(Blueprint $table) {
            $table->timestamp('received_at')->after('price_default')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tahdig_reservations', function(Blueprint $table) {
            $table->dropColumn('received_at');
        });
    }
}
