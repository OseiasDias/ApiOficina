<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    // Campos que podem ser preenchidos (mass assignment)
    protected $fillable = [
        'primeiroNome',
        'ultimoNome',
        'nomeEmpresa',
        'email',
        'celular',
        'telefoneFixo',
        'imagem',
        'genero',
        'pais',
        'estado',
        'municipio',
        'endereco',
    
    ];
}
