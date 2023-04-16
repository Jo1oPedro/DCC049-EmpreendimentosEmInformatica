<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['types' => Type::with('tasks')->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $typeData = array_merge($request->all(), ['user_id' => Auth::user()->id]);
        $type = Type::create($typeData);

        return response()->json(['type' => $type->load('tasks')], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $type)
    {
        if($type = Type::whereId($type)->first()) {
            return response()->json(['type' => $type->load('tasks')], 200);
        }

        return response()->json(['error' => 'Tipo não encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $type)
    {
        if($type = Type::whereId($type)->first()) {
            $type->update($request->all());
            return response()->json(['type' => $type->load('tasks')], 200);
        }

        return response()->json(['error' => 'Tipo não encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $type)
    {
        if(Type::destroy($type)) {
            return response()->json('', 204);
        }

        return response()->json(['error' => 'Tipo não encontrado'], 404);
    }
}
