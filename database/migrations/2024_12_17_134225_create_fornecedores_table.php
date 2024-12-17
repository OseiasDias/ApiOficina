<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresTable extends Migration
{
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('primeiroNome', 50);
            $table->string('ultimoNome', 50);
            $table->string('nomeEmpresa', 100);
            $table->string('email', 50)->unique();
            $table->string('celular', 16)->unique();
            $table->string('telefoneFixo', 16)->nullable();
            $table->string('imagem')->nullable(); // Campo para armazenar o nome da imagem
            $table->enum('genero', ['Masculino', 'Feminino']);
            $table->string('pais');
            $table->string('estado');
            $table->string('municipio');
            $table->text('endereco');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fornecedores');
    }
}
