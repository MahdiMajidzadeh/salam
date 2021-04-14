<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWelcomeNoteTable extends Migration
{
    public function up()
    {
        Schema::create('welcome_notes', function (Blueprint $table) {
            $table->id();
            $table->integer('day');
            $table->string('title');
            $table->longText('content');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('welcome_notes');
    }
}
