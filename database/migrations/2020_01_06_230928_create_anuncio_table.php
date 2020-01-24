<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnuncioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncio', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->enum('type', ['Normal', 'Revenda', 'XML']);
            $table->enum('categoria', ['Carro', 'Moto', 'Caminhão', 'Onibus']);
            $table->decimal('valor', 2);
            $table->integer('km');
            $table->integer('ano_fabricacao');
            $table->integer('ano_modelo');
            $table->boolean('patrocinado');
            $table->boolean('unicodono');
            $table->string('titulo');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('versao_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('versao_id')->references('id')->on('versao')->onDelete('cascade');
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
        Schema::dropIfExists('anuncio');
    }
}
