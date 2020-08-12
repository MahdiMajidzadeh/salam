<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZoomToUser extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('zoom_url')->nullable();
            $table->string('zoom_auth')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('zoom_url');
            $table->dropColumn('zoom_auth');

        });
    }
}
