<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create($companyId)
    {
        $company = Company::find($companyId);
        $users = $company->users;

        return view('projects.edit', compact('company', 'users'));
    }

    public function edit($projectId)
    {
        $project = Project::findOrFail($projectId);
        $users = $project->company->users;

        return view('projects.edit', compact('project', 'users'));
    }

    public function store(Request $request, $companyId)
    {
        $validatedData = $this->validateProjectRequest($request);
        $project = Project::create($validatedData);
        $this->associateProjectWithCompany($project, $companyId);

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
            'company_id' => 'required|int',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'hours' => 'nullable|int',
            'main_contact' => 'required|exists:users,id',
            'notes' => 'nullable|string',
        ]);
    }

    private function associateProjectWithCompany(Project $project, $companyId)
    {
        $company = Company::find($companyId);
        $project->company()->associate($company);
        $project->save();
    }

    public function show($projectId)
    {
        $project = Project::findOrFail($projectId);
        $mainContactUser = User::find($project->main_contact);

        return view('projects.show', compact('project', 'mainContactUser'));
    }

    public function destroy($projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->delete();

        return redirect()->route('companies.company')->with('success', 'Project deleted successfully');
    }
}
