<?php

namespace App\Http\Controllers;

use App\Models\Pedido_Produto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PedidoProdutoController extends Controller
{

    public function createPedidoProduto(Request $request)
    {
        try {
            $pedido = Pedido_Produto::create($request->all());
            return response()->json(['message' => 'Produto cadastrado com sucesso', 'Usuário' => $pedido], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        } catch (QueryException $e) {
            // Verifique se a exceção é de violação de chave estrangeira (FK)
            if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
                return response()->json(['error' => 'Certifique-se de que as chaves estrangeiras estão corretas.'], 422);
            } else {
                // Trate outros erros de QueryException aqui, se necessário
                return response()->json(['error' => 'Erro ao cadastrar o produto'], 500);
            }
        }
    }
}
