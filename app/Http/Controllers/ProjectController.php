<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function show(Request $request)
    {
        $project = Project::findOrFail($request->input('id'));
        $phases = $project->phases;
        $bugs = $project->bugs;
        return view('projects.show', compact('project', 'phases', 'bugs'));
    }

    public function index()
    {
        $user = Auth::user();
        $projects = ($user->user_type != 'admin') ? $user->company->projects : Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->user_type == 'admin') {
            $companies = Company::all();
        }
        return view('projects.edit', compact('companies'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->user_type != 'admin'){
            $request->merge(['company' => $request->user()->company]);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'company' => 'nullable|string',
        ]);

        if ($request->has('id')) {
            $project = Project::findOrFail($request->input('id'));
            $project->update($validatedData);
        } else {
            $project = Project::create($validatedData);
            $company = $request->input('company', $user->company);
            $project->company()->associate($company);
            $project->save();
        }

        $request->merge(['id' => $project->id]);

        return $this->show($request);
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

        $user = Auth::user();
        if ($user->user_type === 'client') {
            $projects = $user->company->projects;
            return view('projects.index', compact('projects'));
        } else {
            $projects = Project::all();
            return view('projects.index', compact('projects'));
        }
    }
}
