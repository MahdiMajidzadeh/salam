<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    public function up()
    {
        Schema::create('links', function(Blueprint $table){
           $table->id();
           $table->string('title');
           $table->text('url');
           $table->unsignedInteger('priority')->default('100');

           $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('links');
    }
}
