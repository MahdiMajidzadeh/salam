<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookUserTable extends Migration
{
    public function up()
    {
        Schema::create('book_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('status_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_user');
    }
}
