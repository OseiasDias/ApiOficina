<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaOrdensServico extends Migration
{
    public function up()
    {
        Schema::create('ordens_servico', function (Blueprint $table) {
            $table->id();
            $table->string('jobno')->unique();               // Nº Ordem de Reparação
            $table->string('nome_cliente'); // Relacionamento com a tabela de clientes
            $table->string('nome_veiculo');// Relacionamento com a tabela de veículos
            $table->datetime('data_encontro');               // Encontro
            $table->string('categoria_reparo');               // Categoria de reparo
            $table->enum('tipo_servico', ['pago', 'nao_pago']); // Tipo de serviço (Pago ou Não Pago)
            $table->decimal('taxa_servico', 10, 2);           // Taxa de serviço
            $table->foreignId('filial_id')->constrained('filiais'); // Galho
            $table->string('detalhes', 100)->nullable();      // Detalhes
            $table->boolean('lavagem')->default(false);       // Lavagem
            $table->decimal('taxa_lavagem', 10, 2)->nullable();  // Preço da lavagem
            $table->boolean('teste_mot')->default(false);     // Teste MOT
            $table->decimal('taxa_teste_mot', 10, 2)->nullable();  // Preço do teste MOT
            $table->json('imagens')->nullable();             // Imagens
            $table->string('titulo', 50)->nullable();         // Título
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordens_servico');
    }
}
