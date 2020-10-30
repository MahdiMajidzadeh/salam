<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChargeUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('tahdig_credits')->default(0)->after('name');
            $table->boolean('is_inter')->default(false);
            $table->timestamp('settlement_at')->after('updated_at')->nullable();
            $table->dropColumn('role_id');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tahdig_credits');
            $table->dropColumn('is_inter');
            $table->dropColumn('settlement_at');
            $table->tinyInteger('role_id')->unsigned();
        });
    }
}
