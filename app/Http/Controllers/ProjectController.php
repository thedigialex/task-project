<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        if ($user->user_type === 'client') {
            $users = $user->company->users;
            return view('projects.edit', compact('users'));
        } else {
            $companies = Company::all();
            return view('projects.edit', compact('companies'));
        }
    }

    public function edit($projectId)
    {
        $project = Project::findOrFail($projectId);
        $users = $project->company->users;

        return view('projects.edit', compact('project', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateProjectRequest($request);
        $project = Project::create($validatedData);
        $company = $request->input('company', auth()->user()->company);
        $project->company()->associate($company);
        $project->save();

        return redirect()->route('projects.show', ['projectId' => $project->id])
            ->with('success', 'Project created successfully');
    }

    public function update(Request $request, $projectId)
    {
        $validatedData = $this->validateProjectRequest($request);
        $project = Project::findOrFail($projectId);
        $project->update($validatedData);

        $message = 'Project updated successfully';

        return redirect()->route('projects.show', ['projectId' => $project->id])
            ->with('success', $message);
    }

    private function validateProjectRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'hours' => 'nullable|int',
            'main_contact' => 'nullable|exists:users,id',
            'notes' => 'nullable|string',
            'company' => function ($attribute, $value, $fail) use ($request) {
                if ($request->has('company') && is_null($value)) {
                    $fail('The ' . $attribute . ' field is required.');
                }
            },
        ]);
    }

    public function show($projectId)
    {
        $project = Project::findOrFail($projectId);
        $mainContactUser = User::find($project->main_contact);

        return view('projects.show', compact('project', 'mainContactUser'));
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->user_type === 'client') {
            $projects = $user->company->projects;
            return view('projects.index', compact('projects'));
        } else {
            $projects = Project::all();
            return view('projects.index', compact('projects'));
        }
    }

    public function destroy($projectId)
    {
        $project = Project::findOrFail($projectId);
        $company = $project->company;
        $phases = $project->phases;
        foreach ($phases as $phase) {
            foreach ($phase->tasks as $task) {
                if ($task->image_path) {
                    Storage::disk('public')->delete($task->image_path);
                }
            }
            $phase->tasks()->delete();
            $phase->delete();
        }
        $project->bugs()->delete();
        $project->delete();

        return redirect()->route('companies.show', ['company' => $company->id])->with('success', 'Project deleted successfully');
    }
}
