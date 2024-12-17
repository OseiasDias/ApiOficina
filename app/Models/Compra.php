<?php

// app/Models/Compra.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'numeroCompra',
        'dataCompra',
        'fornecedor_id',
        'celular',
        'email',
        'endereco',
        'galho',
    ];

    // Define a relação com o fornecedor (se houver)
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
