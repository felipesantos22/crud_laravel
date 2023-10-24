<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProdutoController extends Controller
{
    public function createProduct(Request $request)
    {
        try {
            $this->validate($request, [
                'nome' => 'unique:produto,nome',
            ], [
                'nome.unique' => 'Produto já cadastrado..',
            ]);
            $produto = Produto::create($request->all());
            return response()->json(['message' => 'Produto cadastrado com sucesso', 'Usuário' => $produto], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
    }




    public function findByIdProduct($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
        return response()->json($produto);
    }




    public function findAllProduct()
    {
        return Produto::all();
    }



    public function updateProduct($id, Request $request)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $produto->nome = $request->input('nome');
        $produto->valor = $request->input('valor');

        $produto->save();

        return response()->json(['message' => 'Product updated successfully', 'Product' => $produto], 200);
    }




    public function deleteProduct($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $produto->delete();

        return response()->json(['message' => 'Produto excluído com sucesso']);
    }




    // Rota para ordenar os produtos por valor
    public function orderProduct()
    {
        $produto = Produto::orderBy('valor', 'asc')->get();
        return response()->json($produto);
    }




    public function paginacao(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $products = Produto::paginate($perPage);
        return response()->json($products);
    }
}
