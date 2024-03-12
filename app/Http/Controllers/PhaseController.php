<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhaseController extends Controller
{
    public function create($projectId)
    {
        $project = Project::find($projectId);
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

    public function store(Request $request, $projectId)
    {
        $rules = $this->getValidationRules();
        $request->validate($rules);
        $phase = $this->createOrUpdatePhase(new Phase, $request);
        $project = Project::find($projectId);
        $phase->project()->associate($project);
        $phase->save();

        return redirect()->route('projects.show', ['projectId' => $projectId])
            ->with('success', 'Phase created successfully');
    }

    public function update(Request $request, $phaseId)
    {
        $rules = $this->getValidationRules();
        $request->validate($rules);
        $phase = Phase::findOrFail($phaseId);
        $this->createOrUpdatePhase($phase, $request);
        $phase->save();

        return redirect()->route('projects.show', ['projectId' => $phase->project->id])
            ->with('success', 'Phase created successfully');
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

    public function show($phaseId)
    {
        $user = auth()->user();
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
        $statuses = ['new', 'info', 'progress', 'testing', 'approval','complete'];
        
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
