<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionUserTable extends Migration
{
    public function up()
    {
        Schema::create('permission_user', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('permission_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_user');
    }
}
