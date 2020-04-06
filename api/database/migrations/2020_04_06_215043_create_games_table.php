<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('minPlayers');
            $table->integer('maxPlayers');
            $table->integer('minTime');
            $table->integer('maxTime');
            $table->boolean('isExpansion')->default(false);
            $table->boolean('isAvailable')->default(true);
            $table->date('dtaIniRent')->nullable();
            $table->date('dtaEndRent')->nullable();
            $table->integer('price')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->text('imageThumb');
            $table->tinyInteger('difficulties_id');
            $table->foreign('difficulties_id')->references('id')->on('difficulties');
            $table->tinyInteger('genres_id');
            $table->foreign('genres_id')->references('id')->on('genres');
            $table->tinyInteger('languages_id');
            $table->foreign('languages_id')->references('id')->on('languages');
            $table->string('languageObs')->nullable();
            $table->tinyInteger('filial_id');
            $table->foreign('filial_id')->references('id')->on('filial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
