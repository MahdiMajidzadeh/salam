<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToUserEmails extends Migration
{

    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('email_basalam')->nullable();
            $table->unsignedTinyInteger('team_id')->nullable();
            $table->unsignedTinyInteger('chapter_id')->nullable();

            $table->renameColumn('employment_id', 'employee_id');

            $table->dropColumn('zoom_url');
            $table->dropColumn('zoom_auth');

            $table->index('employee_id');
            $table->index('team_id');
            $table->index('chapter_id');
        });
    }

    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('email_basalam');
            $table->dropColumn('team_id');
            $table->dropColumn('chapter_id');
            $table->dropColumn('employee_id', 'employment_id');

            $table->string('zoom_url')->nullable();
            $table->string('zoom_auth')->nullable();
        });
    }
}
