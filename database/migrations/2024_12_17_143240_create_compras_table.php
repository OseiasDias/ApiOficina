<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_compras_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id(); // Chave primária auto incrementada
            $table->string('numeroCompra'); // Número da compra
            $table->date('dataCompra'); // Data da compra
            $table->foreignId('fornecedor_id')->constrained()->onDelete('cascade'); // Chave estrangeira do fornecedor
            $table->string('celular')->nullable(); // Número de celular
            $table->string('email')->nullable(); // E-mail
            $table->text('endereco')->nullable(); // Endereço
            $table->string('galho')->nullable(); // Galho (Categoria)
            $table->timestamps(); // Created_at e Updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
