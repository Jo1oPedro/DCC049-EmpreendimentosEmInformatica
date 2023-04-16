<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['tasks' => Task::WithTypeSubject()->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $taskData = array_merge($request->all(), ['user_id' => Auth::user()->id]);
        $task = Task::create($taskData);

        return response()->json(['task' => $task->load('type', 'subject')], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $task)
    {
        if($task = Task::whereId($task)->first()) {
            return response()->json(['task' => $task->load('type', 'subject')], 200);
        }

        return response()->json(['error' => 'Tarefa não encontrada'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $task)
    {
        if($task = Task::whereId($task)->first()) {
            $task->update($request->all());
            return response()->json(['task' => $task->load('type', 'subject')], 200);
        }

        return response()->json(['error' => 'Tarefa não encontrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $task)
    {
        if(Task::destroy($task)) {
            return response()->json('',  204);
        }

        return response()->json(['error' => 'Tarefa não encontrada'], 404);
    }
}
