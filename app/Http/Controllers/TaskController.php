<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($projectId)
    {
        $tasks = Task::where('project_id', $projectId)->get();
        return view('tasks.index', compact('tasks', 'projectId'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function create($projectId)
    {
        return view('tasks.create', compact('projectId'));
    }

    public function store(Request $request, $projectId)
    {
        // Validate request data
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'status' => 'required|in:todo,in_progress,completed',
            // Add more validation rules as needed
        ]);

        // Create a new task for the project
        $task = Task::create([
            'project_id' => $projectId,
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('tasks.index', ['projectId' => $projectId])
            ->with('success', 'Task created successfully');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'status' => 'required|in:todo,in_progress,completed',
            // Add more validation rules as needed
        ]);

        // Update the task
        $task = Task::findOrFail($id);
        $task->update($validatedData);

        return redirect()->route('tasks.index', ['projectId' => $task->project_id])
            ->with('success', 'Task updated successfully');
    }
}
