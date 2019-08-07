<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->biginteger('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->biginteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->biginteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
