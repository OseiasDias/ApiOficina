<?php

// app/Models/Funcionario.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'sobrenome', 'dataNascimento', 'email', 'celular', 'telefoneFixo',
        'foto', 'genero', 'senha', 'filial', 'cargo', 'nomeExibicao', 'dataAdmissao', 
        'pais', 'estado', 'cidade', 'endereco'
    ];
}
