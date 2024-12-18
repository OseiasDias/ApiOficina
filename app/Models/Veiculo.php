<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $table = 'veiculos'; // Caso o nome da tabela seja diferente de 'veiculos'
    
    protected $fillable = [
        'numero_placa',
        'tipo_veiculo',
        'marca_veiculo',
        'nome_modelo',
        'preco',
        'cliente_id',
        'tipo_combustivel',
        'numero_equipamento',
        'ano_modelo',
        'leitura_odometro',
        'data_fabricacao',
        'caixa_velocidade',
        'numero_caixa',
        'numero_motor',
        'tamanho_motor',
        'numero_chave',
        'motor',
        'numero_chassi',
        'imagens',
    ];

    // Cast para garantir que o campo 'imagens' seja tratado como um array
    protected $casts = [
        'imagens' => 'array', // Para armazenar como um array JSON
    ];

    // Definindo o relacionamento com o Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
