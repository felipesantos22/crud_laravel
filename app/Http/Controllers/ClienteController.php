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

    public function findAll(){
        return ClienteModel::all();
    }
}
