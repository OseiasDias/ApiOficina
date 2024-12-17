<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_produtos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('numeroProduto')->unique();
            $table->date('dataCompra');
            $table->string('nome');
            $table->string('galho');
            $table->string('fabricante');
            $table->decimal('preco', 10, 2);
            $table->string('unidadeMedida');
            $table->foreignId('fornecedor_id')->constrained('fornecedores'); // Supondo que você tenha uma tabela de fornecedores
            $table->string('cor')->nullable();
            $table->string('garantia')->nullable();
            $table->string('imagem')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
