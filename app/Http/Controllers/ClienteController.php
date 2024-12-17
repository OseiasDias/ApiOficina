<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    // Método para criar um novo cliente
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'primeiroNome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'dataNascimento' => 'required|date',
            'celular' => 'required|string|max:255|unique:clientes,celular', // Celular único
            'email' => 'required|email|unique:clientes,email', // E-mail único
            'senha' => 'required|string|min:6',
            'foto' => 'nullable|image|max:2048', // Foto opcional, no máximo 2MB
            'genero' => 'required|in:Masculino,Feminino',
            'endereco' => 'required|string',
        ]);
    
        // Processamento de upload da foto, se houver
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/clientes');
        }
    
        // Criação do cliente
        try {
            $cliente = Cliente::create([
                'primeiroNome' => $request->primeiroNome,
                'sobrenome' => $request->sobrenome,
                'dataNascimento' => $request->dataNascimento,
                'celular' => $request->celular,
                'email' => $request->email,
                'senha' => Hash::make($request->senha), // Criptografando a senha
                'foto' => $path ?? null,
                'genero' => $request->genero,
                'nomeExibicao' => $request->nomeExibicao,
                'nomeEmpresa' => $request->nomeEmpresa,
                'telefoneFixo' => $request->telefoneFixo,
                'nif' => $request->nif,
                'idPais' => $request->idPais,
                'idProvincia' => $request->idProvincia,
                'municipio' => $request->municipio,
                'endereco' => $request->endereco,
            ]);
            return response()->json(['message' => 'Cliente criado com sucesso!', 'cliente' => $cliente], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao criar o cliente. ' . $e->getMessage()], 500);
        }
    }

    // Método para listar os clientes
    public function index()
    {
        try {
            $clientes = Cliente::all();
            return response()->json(['message' => 'Clientes listados com sucesso!', 'clientes' => $clientes], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao listar os clientes. ' . $e->getMessage()], 500);
        }
    }

    // Método para visualizar um cliente
    public function show($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            return response()->json(['message' => 'Cliente encontrado com sucesso!', 'cliente' => $cliente], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar o cliente. ' . $e->getMessage()], 500);
        }
    }

    // Método para atualizar um cliente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
    
        // Validação dos dados de entrada
        $request->validate([
            'primeiroNome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'dataNascimento' => 'required|date',
            'celular' => 'required|string|max:255|unique:clientes,celular,' . $cliente->id, // Permite que o celular do próprio cliente seja ignorado
            'email' => 'required|email|unique:clientes,email,' . $cliente->id, // Permite que o e-mail do próprio cliente seja ignorado
            'senha' => 'nullable|string|min:6', // Senha é opcional na atualização
            'foto' => 'nullable|image|max:2048',
            'genero' => 'required|in:Masculino,Feminino',
            'endereco' => 'required|string',
        ]);
    
        // Processamento de upload da foto, se houver
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/clientes');
            $cliente->foto = $path; // Atualiza a foto
        }
    
        // Atualizando o cliente com os novos dados
        try {
            $cliente->update([
                'primeiroNome' => $request->primeiroNome,
                'sobrenome' => $request->sobrenome,
                'dataNascimento' => $request->dataNascimento,
                'celular' => $request->celular,
                'email' => $request->email,
                'senha' => $request->senha ? Hash::make($request->senha) : $cliente->senha, // Se houver senha, atualiza
                'foto' => $cliente->foto, // Mantém a foto atual
                'genero' => $request->genero,
                'nomeExibicao' => $request->nomeExibicao,
                'nomeEmpresa' => $request->nomeEmpresa,
                'telefoneFixo' => $request->telefoneFixo,
                'nif' => $request->nif,
                'idPais' => $request->idPais,
                'idProvincia' => $request->idProvincia,
                'municipio' => $request->municipio,
                'endereco' => $request->endereco,
            ]);
            return response()->json(['message' => 'Cliente atualizado com sucesso!', 'cliente' => $cliente], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar o cliente. ' . $e->getMessage()], 500);
        }
    }
    
    // Método para excluir um cliente
    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            return response()->json(['message' => 'Cliente excluído com sucesso!'], 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir o cliente. ' . $e->getMessage()], 500);
        }
    }
}
