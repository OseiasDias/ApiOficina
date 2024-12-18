<?php

// app/Http/Controllers/FuncionarioController.php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();  // Retorna todos os funcionários
        return response()->json($funcionarios);
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|max:50',
            'sobrenome' => 'required|max:50',
            'email' => 'required|email|unique:funcionarios',
            'celular' => 'required|max:16',
            'genero' => 'required|in:Masculino,Feminino',
            'senha' => 'required',
            'filial' => 'required',
            'cargo' => 'required',
            'dataAdmissao' => 'required|date',
            'pais' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'endereco' => 'required|max:100'
        ]);

        // Criação de novo funcionário
        $funcionario = Funcionario::create($request->all());

        return response()->json($funcionario, 201);
    }

    public function show($id)
    {
        $funcionario = Funcionario::find($id);

        if ($funcionario) {
            return response()->json($funcionario);
        } else {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::find($id);

        if ($funcionario) {
            $request->validate([
                'nome' => 'required|max:50',
                'sobrenome' => 'required|max:50',
                'email' => 'required|email',
                'celular' => 'required|max:16',
                'genero' => 'required|in:Masculino,Feminino',
                'filial' => 'required',
                'cargo' => 'required',
                'dataAdmissao' => 'required|date',
                'pais' => 'required',
                'estado' => 'required',
                'cidade' => 'required',
                'endereco' => 'required|max:100'
            ]);

            $funcionario->update($request->all());
            return response()->json($funcionario);
        } else {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::find($id);

        if ($funcionario) {
            $funcionario->delete();
            return response()->json(['message' => 'Funcionário deletado com sucesso']);
        } else {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }
    }
}
