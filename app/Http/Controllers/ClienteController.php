<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClienteModel;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    // public function createUser(Request $request)
    // {
    //     $request->validate([
    //         'cnpj' => 'required|unique:usuario,cnpj',
    //         'razao_social' => 'required|unique:usuario,razao_social',
    //         // Outras regras de validação, se necessário
    //     ], [
    //         'cnpj.required' => 'O CNPJ é obrigatório.',
    //         'cnpj.unique' => 'O CNPJ fornecido já está em uso. Escolha outro CNPJ.',
    //         'razao_social.required' => 'A razão social é obrigatória.',
    //         'razao_social.unique' => 'A razão social fornecida já está em uso. Escolha outra razão social.',
    //         // Mensagens de erro personalizadas para outras regras de validação, se necessário
    //     ]);
    //     return ClienteModel::create($request->all());
    // }

    public function createUser(Request $request)
    {
        try {
            $this->validate($request, [
                'cnpj' => 'unique:usuario,cnpj',
                'razao_social' => 'unique:usuario,razao_social',
            ], [
                'cnpj.unique' => 'O CNPJ fornecido já está em uso. Escolha outro CNPJ.', // Mensagem de erro personalizada
            ]);
            return response()->json(['message' => 'Usuário criado com sucesso'], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
    }





    public function findByIdUser($id)
    {
        $user = ClienteModel::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        return response()->json($user);
    }




    public function findAllUser()
    {
        return ClienteModel::all();
    }




    public function updateUser($id, Request $request)
    {
        $post = ClienteModel::find($id);

        if (!$post) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $post->cnpj = $request->input('cnpj');
        $post->nome = $request->input('nome');
        $post->razao_social = $request->input('razao_social');
        $post->endereco = $request->input('endereco');

        $post->save();

        return response()->json(['message' => 'Post updated successfully', 'User' => $post], 200);
    }




    public function deleteUser($id)
    {
        $recurso = ClienteModel::find($id);

        if (!$recurso) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $recurso->delete();

        return response()->json(['message' => 'Recurso excluído com sucesso']);
    }
}
