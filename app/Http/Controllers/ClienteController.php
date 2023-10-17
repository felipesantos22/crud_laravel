<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClienteModel;

class ClienteController extends Controller
{
    public function createUser(Request $request)
    {
        return ClienteModel::create($request->all());
    }




    public function show($id)
    {
        $user = ClienteModel::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        return response()->json($user);
    }




    public function findAll()
    {
        return ClienteModel::all();
    }




    public function updateController($id, Request $request)
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
}
