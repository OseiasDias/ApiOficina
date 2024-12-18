<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_placa');
            $table->unsignedInteger('tipo_veiculo'); // 1: Turismo, 2: SUV, etc.
            $table->unsignedInteger('marca_veiculo');
            $table->unsignedInteger('nome_modelo');
            $table->decimal('preco', 10, 2);
            $table->unsignedBigInteger('cliente_id'); // Chave estrangeira para a tabela de clientes
            $table->unsignedInteger('tipo_combustivel'); // 1: Diesel, 2: Gasolina, etc.
            $table->string('numero_equipamento')->nullable();
            $table->year('ano_modelo')->nullable();
            $table->decimal('leitura_odometro', 10, 2)->nullable();
            $table->date('data_fabricacao')->nullable();
            $table->string('caixa_velocidade')->nullable();
            $table->string('numero_caixa')->nullable();
            $table->string('numero_motor')->nullable();
            $table->string('tamanho_motor')->nullable();
            $table->string('numero_chave')->nullable();
            $table->string('motor')->nullable();
            $table->string('numero_chassi')->nullable();
            $table->json('imagens')->nullable(); // Usamos JSON para armazenar as URLs das imagens
            $table->timestamps();

            // Definir a chave estrangeira para a tabela de clientes
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculos');
    }
}
