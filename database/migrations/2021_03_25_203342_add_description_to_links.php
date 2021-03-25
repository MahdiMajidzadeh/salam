<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
