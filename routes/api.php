<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rotas usuário
Route::post('/usuario', [ClienteController::class, 'createUser']);
Route::get('/usuario/{id}', [ClienteController::class, 'findByIdUser']);
Route::get('/usuario', [ClienteController::class, 'findAllUser']);
Route::get('/usuarioAsc', [ClienteController::class, 'orderClient']);
Route::put('/usuario/{id}', [ClienteController::class, 'updateUser']);
Route::delete('usuario/{id}', [ClienteController::class, 'deleteUser']);

// Rotas produto
Route::post('/produto', [ProdutoController::class, 'createProduct']);
Route::get('/produto/{id}', [ProdutoController::class, 'findByIdProduct']);
Route::get('/produto', [ProdutoController::class, 'findAllProduct']);
Route::get('/produtoAsc', [ProdutoController::class, 'orderProduct']);
Route::put('/produto/{id}', [ProdutoController::class, 'updateProduct']);
Route::delete('/produto/{id}', [ProdutoController::class, 'deleteProduct']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
