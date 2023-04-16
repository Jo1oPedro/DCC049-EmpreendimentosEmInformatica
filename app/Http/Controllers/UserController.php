<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['users' => User::all()], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $user)
    {
        if($user = User::whereId($user)->first()) {
            return response()->json($user, 200);
        }
        return response()->json(['error' => 'Usuário não encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $user)
    {
        if($user = User::whereId($user)->first()) {
            $data = $request->all();
            if(isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            $user->update($data);

            return response()->json(['user' => User::whereId($user->id)->first()], 200);
        }

        return response()->json(['error' => 'Usuário não encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user)
    {
        $id = User::destroy($user);

        if($id) {
            return response('', 204);
        }

        return response(['error' => 'Usuário não encontrado'], 404);
    }
}
