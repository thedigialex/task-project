<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubTaskController extends Controller
{
    
    public function index($taskId)
    {
        $task = Task::findOrFail($taskId);
        $taskName = $task->title;
        $subtasks = $task->subTasks;

        return view('subtasks.index', compact('subtasks', 'taskName', 'task'));
    }

    public function create($taskId)
    {
        $taskName = Task::findOrFail($taskId)->title;
        return view('subtasks.edit', compact('taskId', 'taskName'));
    }

    public function store(Request $request, $taskId)
    {
        $data = $this->validateData($request);
        $subTask = new SubTask($data);
        $task = Task::findOrFail($taskId);
        $subTask->task()->associate($task)->save();
        return redirect()->route('phases.show', ['phaseId' => $task->phase->id]);
    }

    public function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_complete' => 'required|boolean',
        ]);
    }

    public function edit($subtaskId)
    {
        $user = auth()->user();
        $subtask = SubTask::findOrFail($subtaskId);
        $phase = $subtask->task->phase;
        $project = $phase->project;
        if ($user->user_type == 'client') {
            $projects = $user->company->projects;
            if (!$projects->contains($project)) {
                return redirect()->route('phases.show', ['phaseId' => $phase->id]);
            }
        }
        return view('subtasks.edit', compact('subtask'));
    }

    public function update(Request $request, $subtaskId)
    {
        $subTask = SubTask::findOrFail($subtaskId);
        $data = $this->validateData($request);
        $phaseId = $subTask->task->phase->id;
        $subTask->update($data);
        return redirect()->route('phases.show', ['phaseId' => $phaseId]);
    }

    public function destroy($subtaskId)
    {
        $subtask = SubTask::findOrFail($subtaskId);
        $phaseId = $subtask->task->phase->id;
        $subtask->delete();
        return redirect()->route('phases.show', ['phaseId' => $phaseId]);
    }
    
    public function toggleComplete(SubTask $subtask)
    {
        $subtask->is_complete = !$subtask->is_complete;
        $subtask->save();
        return back();
    }
}
