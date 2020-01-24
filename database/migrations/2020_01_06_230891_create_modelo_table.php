<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelo', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('nome');
            $table->bigInteger('marca_id')->unsigned()->index();
            $table->foreign('marca_id')->references('id')->on('marca')->onDelete('cascade');
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
        Schema::dropIfExists('modelo');
    }
}
