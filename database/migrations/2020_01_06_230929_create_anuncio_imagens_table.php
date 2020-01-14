<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnuncioImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AnuncioImagens', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('path');
            $table->string('alt');
            $table->integer('order');
            $table->bigInteger('anuncio_id')->unsigned()->index();
            $table->foreign('anuncio_id')->references('id')->on('anuncio')->onDelete('cascade');
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
        Schema::dropIfExists('AnuncioImagens');
    }
}
