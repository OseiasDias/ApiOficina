<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // ID automático
            $table->string('primeiroNome');
            $table->string('sobrenome');
            $table->date('dataNascimento');
            $table->string('celular')->unique();
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('foto')->nullable(); // Para armazenar a foto
            $table->enum('genero', ['Masculino', 'Feminino']);
            $table->string('nomeExibicao')->nullable();
            $table->string('nomeEmpresa')->nullable();
            $table->string('telefoneFixo')->nullable();
            $table->string('nif')->nullable()->unique();
            $table->string('idPais')->nullable();
            $table->string('idProvincia')->nullable();
            $table->string('municipio')->nullable();
            $table->text('endereco');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
