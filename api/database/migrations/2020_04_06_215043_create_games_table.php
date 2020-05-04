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
            $table->boolean('isExpansion')->default(0);
            $table->boolean('isAvailable')->default(1);
            $table->integer('price')->nullable();
            $table->text('description')->nullable();
            $table->text('imageThumb');
            $table->unsignedBigInteger('difficulties_id');
            $table->foreign('difficulties_id')->references('id')->on('difficulties');
            $table->unsignedBigInteger('genres_id');
            $table->foreign('genres_id')->references('id')->on('genres');
            $table->unsignedBigInteger('languages_id');
            $table->foreign('languages_id')->references('id')->on('languages');
            $table->string('languageObs')->nullable();
            $table->unsignedBigInteger('filial_id');
            $table->foreign('filial_id')->references('id')->on('filials');
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
