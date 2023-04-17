<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $workData = $request->all();
        if($request->file('trabalho')) {
            $work_path = $request->file('trabalho')
                ->store('users_works', 'public');
            $workData = array_merge($request->except('trabalho'), ['trabalho' => $work_path]);
        }
        $work = Work::create($workData);
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
            $workData = $request->all();

            if($request->file('trabalho')) {
                if($work->trabalho) {
                    Storage::disk('public')->delete($work->trabalho);
                }

                $workPath = $request->file('trabalho')
                    ->store('users_works', 'public');
                $workData = array_merge($request->except('trabalho'), ['trabalho' => $workPath]);
            }

            $work->update($workData);
            return response()->json(['work' => $work->load('subject')], 200);
        }

        return response()->json(['error' => 'Trabalho não encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $work)
    {
        if($work = Work::whereId($work)->first()) {
            if($work->trabalho) {
                Storage::disk('public')->delete($work->trabalho);
            }
            $work->delete();
            return response()->json('', 204);
        }

        return response()->json(['error' => 'Trabalho não encontrado'], 404);
    }
}
