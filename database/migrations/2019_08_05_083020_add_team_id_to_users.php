<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->biginteger('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->biginteger('lead_id')->unsigned()->nullable();
            $table->foreign('lead_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('team_id'); 
          $table->dropColumn('lead_id');
        });
    }
}
