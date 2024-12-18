<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'ordens_servico';

    // Definindo os campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'jobno',
        'nome_cliente',
        'nome_veiculo',
        'data_encontro',
        'categoria_reparo',
        'tipo_servico',
        'taxa_servico',
        'filial_id',
        'detalhes',
        'lavagem',
        'taxa_lavagem',
        'teste_mot',
        'taxa_teste_mot',
        'imagens',
        'titulo'
    ];

    // Relacionamento com a tabela filiais
    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }
}
