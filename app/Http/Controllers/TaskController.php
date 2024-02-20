<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Phase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

    public function create($phaseId)
    {
        return view('tasks.edit', compact('phaseId'));
    }

    public function edit($taskId)
    {
        $task = Task::findOrFail($taskId);
        return view('tasks.edit', compact('task'));
    }

    public function store(Request $request, $phaseId)
    {
        $task = $this->validateAndSaveTask($request, $phaseId);

        return redirect()->route('phases.show', ['phaseId' => $task->phase->id])
            ->with('success', 'Task updated successfully');
    }

    public function update(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $this->validateAndSaveTask($request, $task->phase->id, $task);

        return redirect()->route('phases.show', ['phaseId' => $task->phase->id])
            ->with('success', 'Task updated successfully');
    }

    protected function validateAndSaveTask(Request $request, $phaseId, $task = null)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:todo,in_progress,completed',
            'priority' => 'required|in:low,medium,high,urgent',
            'technological_level' => 'required|in:low,medium,high',
            'completion_expected_date' => 'required|date',
            'hours_required' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $request->validate($rules);
        if (!$task) {
            $task = new Task();
        }
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->priority = $request->input('priority');
        $task->technological_level = $request->input('technological_level');
        $task->completion_expected_date = $request->input('completion_expected_date');
        $task->hours_required = $request->input('hours_required');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('task_images', 'public');
            $task->image_path = $imagePath;
        }
        $phase = Phase::findOrFail($phaseId);
        $task->phase()->associate($phase);
        $task->save();

        return $task;
    }

    public function destroy($taskId)
    {
        $task = Task::findOrFail($taskId);
        if ($task->image_path) {
            Storage::disk('public')->delete($task->image_path);
        }
        $phaseId =  $task->phase->id;
        $task->delete();

        return redirect()->route('phases.show', ['phaseId' => $phaseId])
            ->with('success', 'Task updated successfully');
    }
}
