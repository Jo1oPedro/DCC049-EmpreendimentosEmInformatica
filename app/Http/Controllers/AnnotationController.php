<?php

namespace App\Http\Controllers;

use App\Models\Annotation;
use Illuminate\Http\Request;

class AnnotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['annotation' => Annotation::with('subject')->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $annotation = Annotation::create($request->all());
        return response()->json(['annotation' => $annotation->load('subject')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $annotation)
    {
        if($annotation = Annotation::whereId($annotation)->first()) {
            return response()->json(['annotation' => $annotation->load('subject')], 200);
        }

        return response()->json(['error' => 'Anotação não encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $annotation)
    {
        if($annotation = Annotation::whereId($annotation)->first()) {
            $annotation->update($request->all());
            return response()->json(['annotation' => $annotation->load('subject')], 200);
        }

        return response()->json(['error' => 'Anotação não encontrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $annotation)
    {
        if(Annotation::destroy($annotation)) {
            return response()->json('', 204);
        }

        return response()->json(['error' => 'Anotação não encontrada'], 404);
    }
}
