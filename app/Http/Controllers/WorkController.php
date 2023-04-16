<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['works' => Work::with('subject')->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $work = Work::create($request->all());
        return response()->json(['work' => $work->load('subject')], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $work)
    {
        if($work = Work::whereId($work)->first()) {
            return response()->json(['work' => $work->load('subject')], 200);
        }

        return response()->json(['error' => 'Trabalho não encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $work)
    {
        if($work = Work::whereId($work)->first()) {
            $work->update($request->all());
            return response()->json(['work' => $work->load('subject')], 200);
        }

        return response()->json(['error' => 'Trabalho não encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $work)
    {
        if(Work::destroy($work)) {
            return response()->json('', 204);
        }

        return response()->json(['error' => 'Trabalho não encontrado'], 404);
    }
}
