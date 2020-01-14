<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Versao', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('nome');
            $table->bigInteger('modelo_id')->unsigned()->index();
            $table->foreign('modelo_id')->references('id')->on('modelo')->onDelete('cascade');
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
        Schema::dropIfExists('Versao');
    }
}
