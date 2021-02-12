<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('banner')->nullable();
            $table->longText('content');
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
