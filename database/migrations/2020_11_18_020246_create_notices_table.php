<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('banner')->nullable();
            $table->text('content');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('ended_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
