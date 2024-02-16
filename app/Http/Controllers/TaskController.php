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
        return view('tasks.edit', compact('projectId'));
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('projects.show', ['id' => $task->project_id])
            ->with('success', 'Task deleted successfully');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $projectId = $task->project_id;
        return view('tasks.edit', compact('task', 'projectId'));
    }

    public function save(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|string|max:255',
            'completion_expected_date' => 'required|date',
            'hours_required' => 'required|integer',
            'technological_level' => 'required|string|max:255',
            'status' => 'required|in:todo,in_progress,completed',
        ]);

        $projectId = $request->input('projectId');

        if (!$projectId) {
            $projectId = $id;
            $data = array_merge($validatedData, ['project_id' => $projectId]);
            $task = Task::create($data);
            $message = 'Task created successfully';
        } else {
            $data = array_merge($validatedData, ['project_id' => $projectId]);
            $task = Task::findOrFail($id);
            $task->update($data);
            $message = 'Task updated successfully';
        }

        return redirect()->route('projects.show', ['id' => $task->project_id])
            ->with('success', $message);
    }
}
