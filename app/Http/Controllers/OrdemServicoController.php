<?php

namespace App\Http\Controllers;
use App\Models\OrdemServico;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    // Exibe todas as ordens de serviço
    public function index()
    {
        $ordens = OrdemServico::all();
        return response()->json($ordens);
    }

    // Exibe uma ordem de serviço específica
    public function show($id)
    {
        $ordem = OrdemServico::find($id);
        if ($ordem) {
            return response()->json($ordem);
        } else {
            return response()->json(['message' => 'Ordem de serviço não encontrada'], 404);
        }
    }

    // Cria uma nova ordem de serviço
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jobno' => 'required|unique:ordens_servico',
            'nome_cliente' => 'required|string',
            'nome_veiculo' => 'required|string',
            'data_encontro' => 'required|date',
            'categoria_reparo' => 'required|string',
            'tipo_servico' => 'required|in:pago,nao_pago',
            'taxa_servico' => 'required|numeric',
            'filial_id' => 'required|exists:filiais,id',
        ]);

        $ordem = OrdemServico::create($validated);

        return response()->json($ordem, 201);
    }

    // Atualiza uma ordem de serviço existente
    public function update(Request $request, $id)
    {
        $ordem = OrdemServico::find($id);
        if (!$ordem) {
            return response()->json(['message' => 'Ordem de serviço não encontrada'], 404);
        }

        $validated = $request->validate([
            'jobno' => 'required|unique:ordens_servico,jobno,' . $id,
            'nome_cliente' => 'required|string',
            'nome_veiculo' => 'required|string',
            'data_encontro' => 'required|date',
            'categoria_reparo' => 'required|string',
            'tipo_servico' => 'required|in:pago,nao_pago',
            'taxa_servico' => 'required|numeric',
            'filial_id' => 'required|exists:filiais,id',
        ]);

        $ordem->update($validated);

        return response()->json($ordem);
    }

    // Deleta uma ordem de serviço
    public function destroy($id)
    {
        $ordem = OrdemServico::find($id);
        if ($ordem) {
            $ordem->delete();
            return response()->json(['message' => 'Ordem de serviço deletada com sucesso']);
        } else {
            return response()->json(['message' => 'Ordem de serviço não encontrada'], 404);
        }
    }
}
