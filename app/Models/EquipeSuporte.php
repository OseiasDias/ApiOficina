<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class EquipeSuporte extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'equipe_suporte';

    // Definir os campos que podem ser preenchidos
    protected $fillable = [
        'nome',
        'sobrenome',
        'data_nascimento',
        'email',
        'foto',
        'genero',
        'senha',
        'celular',
        'telefone_fixo',
        'filial',
        'cargo',
        'nome_exibicao',
        'data_admissao',
        'pais',
        'estado',
        'cidade',
        'endereco',
    ];

    // Criptografar a senha antes de salvar no banco
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('senha')) {
                $model->senha = Hash::make($model->senha);
            }
        });
    }
}
