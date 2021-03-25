<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToLinks extends Migration
{
    public function up()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->text('description');
        });
    }

    public function down()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
