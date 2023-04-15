<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken('token');

            return response()->json(
                [
                    'token' => $token->plainTextToken,
                    'user_type' => $user->user_type,
                    'id' => $user->id
                ],
                200
            );
        }

        return response()->json(
            'Credenciais invalidas', 400
        );
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json('', 204);
    }
}
