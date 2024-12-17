<?php

// app/Models/Produto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'numeroProduto', 
        'dataCompra', 
        'nome', 
        'galho', 
        'fabricante', 
        'preco', 
        'unidadeMedida', 
        'fornecedor_id', 
        'cor', 
        'garantia', 
        'imagem', 
        'notas'
    ];



    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
