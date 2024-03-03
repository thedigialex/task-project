<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SubTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($taskId)
    {
        $task = Task::findOrFail($taskId);
        $taskName = $task->title;
        $subtasks = $task->subTasks;

        return view('subtasks.index', compact('subtasks', 'taskName', 'task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($taskId)
    {
        $taskName = Task::findOrFail($taskId)->title;
        return view('subtasks.edit', compact('taskId', 'taskName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $taskId)
    {

        $data = $this->validateData($request);

        $subTask = new SubTask($data);
        $task = Task::findOrFail($taskId);
        $subTask->task()->associate($task)->save();
        return redirect()->route('subtasks.index', ['taskId' => $taskId])->with('success', 'Subtask created successfully');
    }

    /**
     * Validate Data
     */
    public function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_complete' => 'required|boolean',
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(SubTask $subTasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($subtaskId)
    {
        $subtask = SubTask::findOrFail($subtaskId);
        return view('subtasks.edit', compact('subtask'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $subtaskId)
    {
        $subTask = SubTask::findOrFail($subtaskId);

        $data = $this->validateData($request);
        $taskId = $subTask->task_id;

        $subTask->update($data);
        return redirect()->route('subtasks.index', ['taskId' => $taskId])->with('success', 'Subtask updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($subtaskId)
    {
        $subtask = SubTask::findOrFail($subtaskId);

        $taskId = $subtask->taskId;
        $subtask->delete();

        return redirect()->route('subtasks.index', ['taskId' => $taskId])->with('success', 'Subtask deleted successfully');

    }
}
