<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['subject' => Subject::with('periods')->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subject = Subject::create($request->except('period_id'));
        $subject->periods()->attach($request['period_id']);

        return response()->json(['subject' => $subject->load('periods')], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $subject)
    {
        if($subject = Subject::whereId($subject)->first()) {
            return response()->json(['subject' => $subject->load('periods')], 200);
        }

        return response()->json(['error' => 'Matéria não encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $subject)
    {
        if($subject = Subject::whereId($subject)->first()) {
            $subject->update($request->all());
            $subjects_periods_id = $subject->periodsArrayId();

            $periods_to_detach = array_diff($subjects_periods_id, $request['periods_id']);
            $periods_to_attach = array_diff($request['periods_id'], $subjects_periods_id);

            $subject->attach_detach_periods($periods_to_detach, $periods_to_attach);

            return response()->json(['subject' => $subject->load('periods')], 200);
        }

        return response()->json(['error' => 'Matéria não encontrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $subject)
    {
        if(Subject::destroy($subject)) {
            return response()->json('', 204);
        }

        return response()->json(['error' => 'Matéria não encontrada'], 404);
    }
}
