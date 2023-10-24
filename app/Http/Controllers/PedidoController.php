<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    public function createPedido(Request $request)
    {
        try {
            $pedido = Pedido::create($request->all());
            return response()->json(['message' => 'Pedido cadastrado com sucesso', 'Pedido' => $pedido], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        } catch (QueryException $e) {
            // Verifique se a exceção é de violação de chave estrangeira (FK)
            if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
                return response()->json(['error' => 'Certifique-se de que a chave estrangeira está correta.'], 422);
            } else {
                // Trate outros erros de QueryException aqui, se necessário
                return response()->json(['error' => 'Erro ao cadastrar o pedido'], 500);
            }
        }
    }

    public function findAllPedido()
    {
        return Pedido::all();
    }
}
