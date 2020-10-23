<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->integer('employment_id')->nullable();
            $table->timestamp('deactivated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->removeColumn('employment_id');
            $table->removeColumn('deactivated_at');
        });
    }
}
