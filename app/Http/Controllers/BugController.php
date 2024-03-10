<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bug;
use App\Models\Project;

class BugController extends Controller
{
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('bugs.edit', compact('project'));
    }
    public function edit($bugId)
    {
        $bug = Bug::findOrFail($bugId);
        $user = auth()->user();
        if ($user->user_type == 'client') {
            $projects = $user->company->projects;
            $bugProjectId = $bug->project_id;
            $belongsToProject = $projects->contains('id', $bugProjectId);
            if (!$belongsToProject) {
                return redirect()->route('projects.show', ['projectId' => $bugProjectId]);
            }
        }
        return view('bugs.edit', compact('bug'));
    }

    public function store(Request $request, $projectId)
    {
        $validatedData = $this->validateProjectRequest($request);
        $bug = Bug::create($validatedData);
        $this->associateBugWithProject($bug, $projectId);

        return redirect()->route('projects.show', ['projectId' => $projectId])
            ->with('success', 'Bug reported successfully');
    }

    public function update(Request $request, $bugId)
    {
        $validatedData = $this->validateProjectRequest($request);
        $bug = Bug::findOrFail($bugId);
        $bug->update($validatedData);
        $message = 'Bug updated successfully';

        return redirect()->route('projects.show', ['projectId' => $bug->project->id])
            ->with('success', $message);
    }

    private function validateProjectRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_id' => 'nullable|integer|exists:projects,id',
            'status' => 'required|string|in:reported,researching,testing,patched',
        ]);
    }

    private function associateBugWithProject(Bug $bug, $projectId)
    {
        $project = Project::find($projectId);
        $bug->project()->associate($project);
        $bug->save();
    }

    public function destroy($bugId)
    {
        $bug = Bug::findOrFail($bugId);
        $projectId = $bug->project->id;
        $bug->delete();
        $message = 'Bug deleted successfully';

        return redirect()->route('projects.show', ['projectId' => $projectId])
            ->with('success', $message);
    }
}
