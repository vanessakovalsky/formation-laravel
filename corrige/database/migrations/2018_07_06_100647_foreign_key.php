<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pronostics', function(Blueprint $table){
          $table->foreign('game_id')->references('id')->on('games')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('user_role', function(Blueprint $table){
          $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('user_role', function(Blueprint $table){
          $table->foreign('role_id')->references('id')->on('role')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
