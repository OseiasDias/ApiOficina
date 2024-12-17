<?php

// app/Http/Controllers/ProdutoController.php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    // Exibir todos os produtos
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos);
    }

    // Exibir um produto específico
    public function show($id)
    {
        $produto = Produto::find($id);

        if ($produto) {
            return response()->json($produto);
        }
        return response()->json(['message' => 'Produto não encontrado'], 404);
    }

    // Criar um novo produto
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numeroProduto' => 'required|string|unique:produtos,numeroProduto|max:50',
            'dataCompra' => 'required|date',
            'nome' => 'required|string|max:255',
            'galho' => 'required|string|max:100',
            'fabricante' => 'required|string|max:100',
            'preco' => 'required|numeric',
            'unidadeMedida' => 'required|string|max:50',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'cor' => 'nullable|string|max:50',
            'garantia' => 'nullable|string|max:100',
            'imagem' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Manipular imagem se fornecida
        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('produtos', 'public');
        } else {
            $imagePath = null;
        }

        // Criar o produto
        $produto = Produto::create([
            'numeroProduto' => $request->numeroProduto,
            'dataCompra' => $request->dataCompra,
            'nome' => $request->nome,
            'galho' => $request->galho,
            'fabricante' => $request->fabricante,
            'preco' => $request->preco,
            'unidadeMedida' => $request->unidadeMedida,
            'fornecedor_id' => $request->fornecedor_id,
            'cor' => $request->cor,
            'garantia' => $request->garantia,
            'imagem' => $imagePath,
        ]);

        return response()->json($produto, 201);
    }

    // Atualizar um produto existente
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'numeroProduto' => 'required|string|max:50|unique:produtos,numeroProduto,' . $id,
            'dataCompra' => 'required|date',
            'nome' => 'required|string|max:255',
            'galho' => 'required|string|max:100',
            'fabricante' => 'required|string|max:100',
            'preco' => 'required|numeric',
            'unidadeMedida' => 'required|string|max:50',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'cor' => 'nullable|string|max:50',
            'garantia' => 'nullable|string|max:100',
            'imagem' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Manipular imagem se fornecida
        if ($request->hasFile('imagem')) {
            if ($produto->imagem) {
                Storage::delete('public/' . $produto->imagem); // Deletar imagem antiga
            }
            $imagePath = $request->file('imagem')->store('produtos', 'public');
        } else {
            $imagePath = $produto->imagem; // Mantém a imagem anterior
        }

        // Atualizar o produto
        $produto->update([
            'numeroProduto' => $request->numeroProduto,
            'dataCompra' => $request->dataCompra,
            'nome' => $request->nome,
            'galho' => $request->galho,
            'fabricante' => $request->fabricante,
            'preco' => $request->preco,
            'unidadeMedida' => $request->unidadeMedida,
            'fornecedor_id' => $request->fornecedor_id,
            'cor' => $request->cor,
            'garantia' => $request->garantia,
            'imagem' => $imagePath,
        ]);

        return response()->json($produto);
    }

    // Deletar um produto
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        if ($produto->imagem) {
            Storage::delete('public/' . $produto->imagem); // Deletar imagem se existir
        }

        $produto->delete();
        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}
