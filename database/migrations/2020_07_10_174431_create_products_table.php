<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations. 
     * php artisan migrate:fresh faz o drop e migra pra atual
     * php artisan migrate:refresh volta a origem (rollback(sem dropar)) e migra pra atual 
     * php artisan make:migration create_products_table
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');  // id da tabela stores

            $table->string('name');
            $table->string('description');
            $table->text('body');
            $table->decimal('price',10,2); // tamanho 10, float 2
            $table->string('slug');
            
            $table->timestamps();
            // a minha coluna "user_id" vai receber uma chave estrangeira que vai referenciar a coluna "id" da tabela "stores"
            // padrão "nome-da-tabela"_"nome-da-coluna"_"foreign" = "products"_"user_id"_"foreign" 
            $table->foreign('store_id')->references('id')->on('stores'); // chave estrangeira "user_id" references ao "id" onde ? lá em "stores"
        });
    }

    /**
     * Reverse the migrations.
     * php artisan migrate:rollback ou php artisan migrate:rollback --step=3 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
