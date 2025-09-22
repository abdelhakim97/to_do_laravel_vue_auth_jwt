<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $user = Auth::user();
        return Task::where('user_id', $user->id)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'is_completed' => 'boolean',
        ]);

        $user = Auth::user();

        $task = Task::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed,
        ]);

        return response()->json($task, 201);
    }

    public function show($id)
    {
        $user = Auth::user();
        $task = Task::where('user_id', $user->id)->find($id);
        
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        
        return $task;
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $task = Task::where('user_id', $user->id)->find($id);
        
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|max:255',
            'description' => 'nullable',
            'is_completed' => 'boolean'
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $task = Task::where('user_id', $user->id)->find($id);
        
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(null, 204);
    }
}