<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBioToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('biography')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('virgool_url')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('biography');
            $table->dropColumn('linkedin_url');
            $table->dropColumn('linkedin_url');
        });
    }
}
