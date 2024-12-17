<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FornecedorController extends Controller
{
    // Exibir todos os fornecedores
    public function index()
    {
        $fornecedores = Fornecedor::all();
        return response()->json($fornecedores);
    }

    // Exibir um fornecedor específico
    public function show($id)
    {
        $fornecedor = Fornecedor::find($id);
        if ($fornecedor) {
            return response()->json($fornecedor);
        }
        return response()->json(['message' => 'Fornecedor não encontrado'], 404);
    }

    // Criar um novo fornecedor
    public function store(Request $request)
    {
        // Validação
        $validator = Validator::make($request->all(), [
            'primeiroNome' => 'required|string|max:50',
            'ultimoNome' => 'required|string|max:50',
            'nomeEmpresa' => 'required|string|max:100',
            'email' => 'required|email|unique:fornecedores,email',
            'celular' => 'required|string|max:16|unique:fornecedores,celular',
            'telefoneFixo' => 'nullable|string|max:16',
            'imagem' => 'nullable|image',
            'genero' => 'required|in:Masculino,Feminino',
            'pais' => 'required|string',
            'estado' => 'required|string',
            'municipio' => 'required|string',
            'endereco' => 'required|string',
            'notas' => 'nullable|string',
            'senha' => 'required|string|min:8', // Validação de senha
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Manipulação do arquivo de imagem, se existir
        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        // Criptografando a senha
        $senhaCriptografada = Hash::make($request->senha);

        // Criando o fornecedor
        $fornecedor = Fornecedor::create([
            'primeiroNome' => $request->primeiroNome,
            'ultimoNome' => $request->ultimoNome,
            'nomeEmpresa' => $request->nomeEmpresa,
            'email' => $request->email,
            'celular' => $request->celular,
            'telefoneFixo' => $request->telefoneFixo,
            'imagem' => $imagePath,
            'genero' => $request->genero,
            'pais' => $request->pais,
            'estado' => $request->estado,
            'municipio' => $request->municipio,
            'endereco' => $request->endereco,
            'notas' => $request->notas,
            'senha' => $senhaCriptografada, // Salvando a senha criptografada
        ]);

        return response()->json($fornecedor, 201);
    }

    // Atualizar um fornecedor existente
    public function update(Request $request, $id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return response()->json(['message' => 'Fornecedor não encontrado'], 404);
        }

        // Validação
        $validator = Validator::make($request->all(), [
            'primeiroNome' => 'required|string|max:50',
            'ultimoNome' => 'required|string|max:50',
            'nomeEmpresa' => 'required|string|max:100',
            'email' => 'required|email|unique:fornecedores,email,' . $id,
            'celular' => 'required|string|max:16|unique:fornecedores,celular,' . $id,
            'telefoneFixo' => 'nullable|string|max:16',
            'imagem' => 'nullable|image',
            'genero' => 'required|in:Masculino,Feminino',
            'pais' => 'required|string',
            'estado' => 'required|string',
            'municipio' => 'required|string',
            'endereco' => 'required|string',
            'notas' => 'nullable|string',
            'senha' => 'nullable|string|min:8', // Senha é opcional no update, mas se fornecida, precisa ser criptografada
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Manipulação do arquivo de imagem, se existir
        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('images', 'public');
        } else {
            $imagePath = $fornecedor->imagem; // Mantém a imagem anterior, caso não haja nova
        }

        // Se a senha foi fornecida, criptografa
        if ($request->has('senha')) {
            $senhaCriptografada = Hash::make($request->senha);
        } else {
            $senhaCriptografada = $fornecedor->senha; // Mantém a senha anterior
        }

        // Atualizando o fornecedor
        $fornecedor->update([
            'primeiroNome' => $request->primeiroNome,
            'ultimoNome' => $request->ultimoNome,
            'nomeEmpresa' => $request->nomeEmpresa,
            'email' => $request->email,
            'celular' => $request->celular,
            'telefoneFixo' => $request->telefoneFixo,
            'imagem' => $imagePath,
            'genero' => $request->genero,
            'pais' => $request->pais,
            'estado' => $request->estado,
            'municipio' => $request->municipio,
            'endereco' => $request->endereco,
            'notas' => $request->notas,
            'senha' => $senhaCriptografada, // Atualiza com a senha criptografada, se fornecida
        ]);

        return response()->json($fornecedor);
    }

    // Deletar um fornecedor
    public function destroy($id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return response()->json(['message' => 'Fornecedor não encontrado'], 404);
        }

        // Deletando o fornecedor
        $fornecedor->delete();

        return response()->json(['message' => 'Fornecedor deletado com sucesso']);
    }
}
