<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function createLogin(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email|unique:login',
            ], [
                'email.required' => 'O campo de email é obrigatório.',
                'email.email' => 'O email fornecido não é válido.',
                'email.unique' => 'O email fornecido já está em uso. Escolha outro email.',
            ]);

            $user = Login::create($request->all());

            return response()->json(['message' => 'Usuário criado com sucesso', 'Usuário' => $user], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Falha ao criar token'], 500);
        }

        return response()->json(compact('token'));
    }
}
