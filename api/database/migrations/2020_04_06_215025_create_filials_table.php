<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('phone')->unique();
            $table->string('rua');
            $table->string('bairro');
            $table->string('numero');
            $table->string('cidade');
            $table->string('uf');
            $table->string('país');
            $table->string('cep')->unique();
            $table->string('complemento')->nullable();
            $table->string('referencia')->nullable();
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
        Schema::dropIfExists('filials');
    }
}
