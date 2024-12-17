<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes'; // Nome da tabela

    // Definindo os campos que podem ser preenchidos em massa
    protected $fillable = [
        'primeiroNome',
        'sobrenome',
        'dataNascimento',
        'celular',
        'email',
        'senha',
        'foto',
        'genero',
        'nomeExibicao',
        'nomeEmpresa',
        'telefoneFixo',
        'nif',
        'idPais',
        'idProvincia',
        'municipio',
        'endereco',
    ];

    // Definindo que o campo 'notas' seja tratado como um campo JSON

}
