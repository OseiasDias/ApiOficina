<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\EquipeSuporteController;
use App\Http\Controllers\ProdutoController;


/*

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


//Routes Para equipe de suporte


Route::get('equipe-suporte', [EquipeSuporteController::class, 'index']); // Para listar todos
Route::get('equipe-suporte/{id}', [EquipeSuporteController::class, 'show']); // Para mostrar um único registro
Route::post('equipe-suporte', [EquipeSuporteController::class, 'store']); // Para criar um novo
Route::put('equipe-suporte/{id}', [EquipeSuporteController::class, 'update']); // Para atualizar um registro
Route::delete('equipe-suporte/{id}', [EquipeSuporteController::class, 'destroy']); // Para deletar um registro



//Route para forncedor




Route::get('fornecedores', [FornecedorController::class, 'index']); // Listar todos
Route::get('fornecedores/{id}', [FornecedorController::class, 'show']); // Mostrar um fornecedor
Route::post('fornecedores', [FornecedorController::class, 'store']); // Criar um novo fornecedor
Route::put('fornecedores/{id}', [FornecedorController::class, 'update']); // Atualizar fornecedor
Route::delete('fornecedores/{id}', [FornecedorController::class, 'destroy']); // Deletar fornecedor

//Routas Para Produtos




// Rotas para Produtos
Route::get('produtos', [ProdutoController::class, 'index']); // Listar todos os produtos
Route::get('produtos/{id}', [ProdutoController::class, 'show']); // Mostrar um produto específico
Route::post('produtos', [ProdutoController::class, 'store']); // Criar um novo produto
Route::put('produtos/{id}', [ProdutoController::class, 'update']); // Atualizar um produto existente
Route::delete('produtos/{id}', [ProdutoController::class, 'destroy']); // Deletar um produto
