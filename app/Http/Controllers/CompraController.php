<?php

// app/Http/Controllers/CompraController.php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    // Exibe todos os registros de compras
    public function index()
    {
        $compras = Compra::all();
        return response()->json($compras);
    }

    // Exibe um único registro de compra
    public function show($id)
    {
        $compra = Compra::findOrFail($id);
        return response()->json($compra);
    }

    // Armazena um novo registro de compra
    public function store(Request $request)
    {
        $request->validate([
            'numeroCompra' => 'required|string|max:255',
            'dataCompra' => 'required|date',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'celular' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'endereco' => 'nullable|string',
            'galho' => 'nullable|string',
        ]);

        $compra = Compra::create($request->all());

        return response()->json($compra, 201);
    }

    // Atualiza um registro de compra
    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);

        $request->validate([
            'numeroCompra' => 'required|string|max:255',
            'dataCompra' => 'required|date',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'celular' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'endereco' => 'nullable|string',
            'galho' => 'nullable|string',
        ]);

        $compra->update($request->all());

        return response()->json($compra);
    }

    // Deleta um registro de compra
    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->delete();

        return response()->json(null, 204);
    }
}
