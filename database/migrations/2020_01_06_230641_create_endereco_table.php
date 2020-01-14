<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco', function (Blueprint $table){
           $table->bigIncrements('id');
           $table->string('rua', 250);
           $table->integer('numero');
           $table->string('complemento', 20);
           $table->string('bairro', 20);
           $table->bigInteger('cidade_id')->unsigned()->index();
           $table->foreign('cidade_id')->references('id')->on('cidade')->onDelete('cascade');
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
        Schema::dropIfExists('endereco');
    }
}
