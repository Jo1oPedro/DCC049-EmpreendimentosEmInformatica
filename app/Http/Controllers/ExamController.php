<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['exams' => Exam::withSubjectPeriods()->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $examPath = $request->file('prova')
            ->store('users_exams', 'public');
        $examData = array_merge($request->except('prova'), ['prova' => $examPath]);
        $exam = Exam::create($examData);
        return response()->json(['exam' => $exam], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $exam)
    {
        if($exam = Exam::whereId($exam)->first()) {
            return response()->json(['exam' => Exam::withSubjectPeriods()->get()], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $exam)
    {
        if($exam = Exam::whereId($exam)->first()) {
            $examData = $request->all();

            if($request->file('prova')) {
                Storage::disk('public')->delete($exam->prova);
                $examPath = $request->file('prova')->store('users_exams', 'public');
                $examData = array_merge($request->except('prova'), ['prova' => $examPath]);
            }

            $exam->update($examData);
            return response()->json(['exam' => $exam->load('subject.periods')], 200);
        }

        return response()->json(['error' => 'Prova não encontrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $exam)
    {
        if(Exam::destroy($exam)) {
            return response()->json('', 204);
        }

        return response()->json(['error' => 'Prova não encontrada'], 404);
    }
}
