<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['periods' => Period::with('subjects')->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $periodData = array_merge($request->all(), ['user_id' => Auth::user()->id]);
        $period = Period::create($periodData);
        $period->subjects()->attach($request['subjects_id']);

        return response()->json(['period' => $period], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $period)
    {
        if($period = Period::whereId($period)->first()) {
            return response()->json(['period' => $period->load('subjects')], 200);
        }

        return response()->json(['error' => 'Periodo não encontrado'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $period)
    {
        if($period = Period::whereId($period)->first()) {
            $period->update($request->all());
            $periods_subject_id = $period->subjectsArrayId();

            $subjects_to_detach = array_diff($periods_subject_id, $request['periods_id']);
            $subjects_to_attach = array_diff($request['periods_id'], $periods_subject_id);

            $period->attach_detach_subjects($subjects_to_detach, $subjects_to_attach);

            return response()->json(["period" => $period->load('subjects')], 200);
        }

        return response()->json(['error' => 'Periodo não encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $period)
    {
        if(Period::destroy($period)) {
            return response()->json('', 204);
        }

        return response()->json(['error' => 'Periodo não encontrado']);
    }
}
