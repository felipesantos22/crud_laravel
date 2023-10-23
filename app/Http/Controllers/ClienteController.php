<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $this->validate($request, [
                'cnpj' => 'unique:usuario|min:14|max:14',
                'razao_social' => 'unique:usuario,razao_social',
            ], [
                'cnpj.unique' => 'O CNPJ fornecido já está em uso. Escolha outro CNPJ.',
                'cnpj.min' => 'O CNPJ deve ter 14 caracteres.',
            ]);
            $cliente = Usuario::create($request->all());
            return response()->json(['message' => 'Usuário criado com sucesso', 'Usuário' => $cliente], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
    }






    public function findByIdUser($id)
    {
        $user = Usuario::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        return response()->json($user);
    }




    public function findAllUser()
    {
        $cliente = Usuario::with('pedidos')->get();
        return response()->json($cliente);
    }




    public function updateUser($id, Request $request)
    {
        $user = Usuario::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->cnpj = $request->input('cnpj');
        $user->nome = $request->input('nome');
        $user->razao_social = $request->input('razao_social');
        $user->endereco = $request->input('endereco');

        $user->save();

        return response()->json(['message' => 'Post updated successfully', 'User' => $user], 200);
    }




    public function deleteUser($id)
    {
        $recurso = Usuario::find($id);

        if (!$recurso) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $recurso->delete();

        return response()->json(['message' => 'User excluído com sucesso']);
    }




    public function orderClient()
    {
        $produto = Usuario::orderBy('nome', 'asc')->get();
        return response()->json($produto);
    }
}
