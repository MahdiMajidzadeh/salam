<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCopiesTable extends Migration
{
    public function up()
    {
        Schema::create('book_copies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('book_id');
            $table->unsignedSmallInteger('copy');
            $table->unsignedInteger('salon_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_copies');
    }
}
