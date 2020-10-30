<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->string('password');
            $table->string('name');
            $table->tinyInteger('role_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['mobile']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
