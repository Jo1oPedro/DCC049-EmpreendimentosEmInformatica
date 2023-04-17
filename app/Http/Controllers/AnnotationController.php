<?php

namespace App\Http\Controllers;

use App\Models\Annotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $annotationData = $request->all();
        if($request->file('anotacao')) {
            $annotationPath = $request->file('anotacao')
                ->store('users_annotations', 'public');
            $annotationData = array_merge($request->except('anotacao'), ['anotacao' => $annotationPath]);
        }
        $annotation = Annotation::create($annotationData);
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
        $annotationData = $request->all();
        if($annotation = Annotation::whereId($annotation)->first()) {
            if($request->file('anotacao')) {
                if($annotation->anotacao) {
                    Storage::disk('public')->delete($annotation->anotacao);
                }

                $annotationPath = $request->file('anotacao')
                    ->store('users_annotations', 'public');

                $annotationData = array_merge($request->except('anotacao'), ['anotacao' => $annotationPath]);
            }
            $annotation->update($annotationData);
            return response()->json(['annotation' => $annotation->load('subject')], 200);
        }

        return response()->json(['error' => 'Anotação não encontrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $annotation)
    {
        if($annotation = Annotation::whereId($annotation)->first()) {
            if($annotation->anotacao) {
                Storage::disk('public')->delete($annotation->anotacao);
            }
            $annotation->delete();
            return response()->json('', 204);
        }

        return response()->json(['error' => 'Anotação não encontrada'], 404);
    }
}
