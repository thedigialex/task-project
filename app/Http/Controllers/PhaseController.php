<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhaseController extends Controller
{
    public function create(Request $request)
    {
        $project = Project::findOrFail($request->input('project_id'));
        return view('phases.edit', compact('project'));
    }

    public function edit($phaseId)
    {
        $user = auth()->user();
        $phase = Phase::findOrFail($phaseId);
        $project = $phase->project;
        if ($user->user_type == 'client') {
            $projects = $user->company->projects;
            if (!$projects->contains($project)) {
                return redirect()->route('projects.show', ['projectId' => $phase->project->id]);
            }
        }
        return view('phases.edit', compact('phase'));
    }

    public function store(Request $request)
    {
        $rules = $this->getValidationRules();
        $request->validate($rules);
        $project = Project::findOrFail($request->input('project_id'));
        $phase = $this->createOrUpdatePhase(new Phase, $request);
        $phase->project()->associate($project);
        $phase->save();
        $request->merge(['phase_id' => $phase->id]);
        return $this->show($request);
    }

    public function update(Request $request)
    {
        $rules = $this->getValidationRules();
        $request->validate($rules);
        $phaseId = $request->input('phase_id');
        $phase = Phase::findOrFail($phaseId);
        $this->createOrUpdatePhase($phase, $request);
        $phase->save();

        return $this->show($request);
    }

    private function getValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'target_date' => 'nullable|date',
            'goal' => 'nullable|string',
        ];
    }

    private function createOrUpdatePhase(Phase $phase, Request $request)
    {
        $phase->name = $request->input('name');
        $phase->target_date = $request->input('target_date');
        $phase->goal = $request->input('goal');

        return $phase;
    }

    public function show(Request $request)
    {
        $user = auth()->user();
        $phaseId = $request->input('phase_id');
        $phase = Phase::with('tasks')->findOrFail($phaseId);
        $completedTaskTime = $phase->tasks->filter(fn($task) => $task->status == 'complete')->sum('hours_required');
        $remainingTaskTime = $phase->tasks->filter(fn($task) => $task->status != 'complete')->sum('hours_required');
        $project = $phase->project;
        $mainContactUser = User::find($project->main_contact);
        if ($user->user_type == 'client') {
            $projects = $user->company->projects;
            if (!$projects->contains($project)) {
                return redirect()->route('projects.show', ['projectId' => $phase->project->id]);
            }
        }
        $sortedTasks = $phase->tasks->sortBy(function ($task) {
            return array_search($task->priority, ['urgent', 'high', 'medium', 'low']);
        });
        
        $statuses = ['new', 'progress', 'testing', 'complete'];

        return view('phases.show', compact('phase', 'project', 'remainingTaskTime', 'completedTaskTime', 'mainContactUser', 'sortedTasks', 'statuses'));
    }

    public function destroy($phaseId)
    {
        $phase = Phase::findOrFail($phaseId);
        foreach ($phase->tasks as $task) {
            if ($task->image_path) {
                Storage::disk('public')->delete($task->image_path);
            }
            $task->subtasks()->delete();
            $task->delete();
        }
        $projectId = $phase->project->id;
        $phase->delete();

        return redirect()->route('projects.show', ['projectId' => $projectId])
            ->with('success', 'Phase and associated tasks deleted successfully');
    }
}
