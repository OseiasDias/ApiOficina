<?php


namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VeiculoController extends Controller
{
    /**
     * Exibir todos os veículos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veiculos = Veiculo::with('cliente')->get(); // Eager load do cliente
        return response()->json($veiculos);
    }

    /**
     * Armazenar um novo veículo.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'numero_placa' => 'required|string|max:10',
            'tipo_veiculo' => 'required|integer',
            'marca_veiculo' => 'required|integer',
            'nome_modelo' => 'required|integer',
            'preco' => 'required|numeric',
            'cliente_id' => 'required|exists:clientes,id', // Verifica se o cliente existe
            'tipo_combustivel' => 'required|integer',
            'imagens' => 'nullable|array',
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Processamento das imagens
        $imagens = [];
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $imagens[] = $imagem->store('veiculos', 'public');
            }
        }

        // Criação do veículo
        $veiculo = Veiculo::create([
            'numero_placa' => $request->numero_placa,
            'tipo_veiculo' => $request->tipo_veiculo,
            'marca_veiculo' => $request->marca_veiculo,
            'nome_modelo' => $request->nome_modelo,
            'preco' => $request->preco,
            'cliente_id' => $request->cliente_id, // Definindo o cliente_id
            'tipo_combustivel' => $request->tipo_combustivel,
            'numero_equipamento' => $request->numero_equipamento,
            'ano_modelo' => $request->ano_modelo,
            'leitura_odometro' => $request->leitura_odometro,
            'data_fabricacao' => $request->data_fabricacao,
            'caixa_velocidade' => $request->caixa_velocidade,
            'numero_caixa' => $request->numero_caixa,
            'numero_motor' => $request->numero_motor,
            'tamanho_motor' => $request->tamanho_motor,
            'numero_chave' => $request->numero_chave,
            'motor' => $request->motor,
            'numero_chassi' => $request->numero_chassi,
            'imagens' => $imagens, // Guardando as imagens
        ]);

        return response()->json($veiculo, 201);
    }

    /**
     * Exibir um veículo específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Buscando o veículo com a relação do cliente
        $veiculo = Veiculo::with('cliente')->findOrFail($id);
        return response()->json($veiculo);
    }

    /**
     * Atualizar os dados de um veículo existente.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'numero_placa' => 'required|string|max:10',
            'tipo_veiculo' => 'required|integer',
            'marca_veiculo' => 'required|integer',
            'nome_modelo' => 'required|integer',
            'preco' => 'required|numeric',
            'cliente_id' => 'required|exists:clientes,id', // Verifica se o cliente existe
            'tipo_combustivel' => 'required|integer',
            'imagens' => 'nullable|array',
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procurando o veículo pelo ID
        $veiculo = Veiculo::findOrFail($id);

        // Processamento das imagens (caso haja)
        if ($request->hasFile('imagens')) {
            // Remover as imagens antigas, se houver
            foreach ($veiculo->imagens as $imagem) {
                Storage::delete('public/' . $imagem);
            }

            // Armazenar as novas imagens
            $imagens = [];
            foreach ($request->file('imagens') as $imagem) {
                $imagens[] = $imagem->store('veiculos', 'public');
            }
            $veiculo->imagens = $imagens;
        }

        // Atualizando o veículo
        $veiculo->update([
            'numero_placa' => $request->numero_placa,
            'tipo_veiculo' => $request->tipo_veiculo,
            'marca_veiculo' => $request->marca_veiculo,
            'nome_modelo' => $request->nome_modelo,
            'preco' => $request->preco,
            'cliente_id' => $request->cliente_id, // Atualizando o cliente_id
            'tipo_combustivel' => $request->tipo_combustivel,
            'numero_equipamento' => $request->numero_equipamento,
            'ano_modelo' => $request->ano_modelo,
            'leitura_odometro' => $request->leitura_odometro,
            'data_fabricacao' => $request->data_fabricacao,
            'caixa_velocidade' => $request->caixa_velocidade,
            'numero_caixa' => $request->numero_caixa,
            'numero_motor' => $request->numero_motor,
            'tamanho_motor' => $request->tamanho_motor,
            'numero_chave' => $request->numero_chave,
            'motor' => $request->motor,
            'numero_chassi' => $request->numero_chassi,
        ]);

        return response()->json($veiculo);
    }

    /**
     * Excluir um veículo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Procurando o veículo
        $veiculo = Veiculo::findOrFail($id);

        // Remover as imagens associadas
        foreach ($veiculo->imagens as $imagem) {
            Storage::delete('public/' . $imagem);
        }

        // Deletando o veículo
        $veiculo->delete();

        return response()->json(['message' => 'Veículo excluído com sucesso']);
    }
}
