<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered as UserRegisteredEvent;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login(LoginFormRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken('token');

            return response()->json(
                [
                    'token' => $token->plainTextToken,
                    'user' => $user
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

    public function register(RegisterFormRequest $request)
    {
        $user = User::create($request->all());
        $token = $user->createToken('token');
        Auth::login($user);

        $this->notifyUserAboutSucessfullRegister($user);

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }

    private function notifyUserAboutSucessfullRegister(User $user)
    {
        $userRegisteredEvent = new UserRegisteredEvent($user);
        event($userRegisteredEvent);
    }
}
