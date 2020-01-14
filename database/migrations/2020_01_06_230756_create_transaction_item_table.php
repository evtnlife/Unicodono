<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TransactionItem', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('pagseguro_id');
            $table->string('descricao');
            $table->integer('quantidade');
            $table->decimal('valor', 2);
            $table->bigInteger('transaction_id')->unsigned()->index();
            $table->foreign('transaction_id')->references('id')->on('transaction')->onDelete('cascade');
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
        Schema::dropIfExists('TransactionItem');
    }
}
