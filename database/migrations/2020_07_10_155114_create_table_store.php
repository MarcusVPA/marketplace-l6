<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); // id da tabela user

            $table->string('name');
            $table->string('description');
            $table->string('phone');
            $table->string('mobile_phone');
            $table->string('slug');

            $table->timestamps();
            // a minha coluna "user_id" vai receber uma chave estrangeira que vai referenciar a coluna "id" da tabela "users"
            // padrão "nome-da-tabela"_"nome-da-coluna"_"foreign" = "stores"_"user_id"_"foreign" 
            $table->foreign('user_id')->references('id')->on('users'); // chave estrangeira "user_id" references ao "id" onde ? lá em "users"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
