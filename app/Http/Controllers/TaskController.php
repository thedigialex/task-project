<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Phase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

    public function create($phaseId)
    {
        $staffUsers = User::where('user_type', 'staff')->get();
        return view('tasks.edit', compact('phaseId', 'staffUsers'));
    }

    public function index()
    {
        $user = auth()->user();
        $sortedTasks = [];
        if($user->user_type == 'staff'){
            $sortedTasks = $user->tasks;
        }
        else{
            $projects = $user->company->projects;
            foreach($projects as $project) {
                $phases = $project->phases;
                foreach($phases as $phase) {
                    $tasks = $phase->tasks;
                    foreach ($tasks as $task) {
                        $sortedTasks[] = $task;
                    }
                }
            }
        }
        $statuses = ['new', 'info', 'progress', 'testing', 'approval','complete'];
        
        return view('tasks.index', compact('sortedTasks', 'statuses'));
    }

    public function edit($taskId)
    {
        $user = auth()->user();
        $task = Task::findOrFail($taskId);
        $project = $task->phase->project;
        if ($user->user_type == 'client') {
            $projects = $user->company->projects;
            if (!$projects->contains($project)) {
                return redirect()->route('phases.show', ['phaseId' => $task->phase->id]);
            }
        }
        $staffUsers = User::where('user_type', 'staff')->get();
        return view('tasks.edit', compact('task', 'staffUsers'));
    }

    public function store(Request $request, $phaseId)
    {
        $task = $this->validateAndSaveTask($request, $phaseId);
        return redirect()->route('phases.show', ['phaseId' => $task->phase->id]);
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
            'status' => 'required|string|in:new,info,hold,progress,testing,approval,complete',
            'priority' => 'required|in:low,medium,high,urgent',
            'technological_level' => 'required|in:low,medium,high',
            'completion_expected_date' => 'required|date',
            'hours_required' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'nullable|exists:users,id',
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
        $image = $request->file('image');
        if ($image) {
            $existingImagePath = $task->image_path;
            if ($existingImagePath && Storage::disk('public')->exists($existingImagePath)) {
                Storage::disk('public')->delete($existingImagePath);
            }
            $imagePath = $image->store('task_images', 'public');
            $task->image_path = $imagePath;
        }

        $phase = Phase::findOrFail($phaseId);
        $task->phase()->associate($phase);
        $user_id = $request->input('user_id');
        $user = $user_id ? User::findOrFail($user_id) : null;
        $task->user()->associate($user);
        $task->save();

        return $task;
    }

    public function destroy($taskId)
    {
        $task = Task::findOrFail($taskId);
        if ($task->image_path) {
            Storage::disk('public')->delete($task->image_path);
        }
        $task->subtasks()->delete();
        $phaseId =  $task->phase->id;
        $task->delete();

        return redirect()->route('phases.show', ['phaseId' => $phaseId])
            ->with('success', 'Task updated successfully');
    }
}
