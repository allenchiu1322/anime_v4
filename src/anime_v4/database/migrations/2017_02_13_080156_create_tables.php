<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('title_jp');
            $table->string('comment');
            $table->timestamps();
        });

        Schema::create('seiyuu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seiyuu');
            $table->string('seiyuu_jp');
            $table->string('comment');
            $table->timestamps();
        });

        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('character');
            $table->string('character_jp');
            $table->integer('title');
            $table->integer('seiyuu');
            $table->string('comment');
            $table->timestamps();

//            $table->foreign('title')->references('id')->on('titles');
//            $table->foreign('seiyuu')->references('id')->on('seiyuu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
        Schema::dropIfExists('seiyuu');
        Schema::dropIfExists('titles');
    }
}
