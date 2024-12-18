<?php

// database/migrations/xxxx_xx_xx_create_funcionarios_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('sobrenome');
            $table->date('dataNascimento');
            $table->string('email')->unique();
            $table->string('celular')->unique();;
            $table->string('telefoneFixo')->nullable();
            $table->string('foto')->nullable();
            $table->enum('genero', ['Masculino', 'Feminino']);
            $table->string('senha');
            $table->string('filial');
            $table->string('cargo');
            $table->string('nomeExibicao')->nullable();
            $table->date('dataAdmissao');
            $table->string('pais');
            $table->string('estado');
            $table->string('cidade');
            $table->text('endereco');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
