<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->smallInteger('type')->default(0);
            $table->string('password');
            $table->bigInteger('endereco_id')->unsigned()->index()->nullable();
            $table->foreign('endereco_id')->references('id')->on('endereco');
            $table->bigInteger('plano_id')->unsigned()->index()->nullable();
            $table->foreign('plano_id')->references('id')->on('plano');
            $table->string('documento', 250)->unique();
            $table->enum('doc_tipo', ['cpf', 'cnpj']);
            $table->rememberToken();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
}
