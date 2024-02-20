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
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'main_contact' => 'required|exists:users,id',
            'notes' => 'nullable|string',
        ];

        $request->validate($rules);
        $projectData = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'completion_date' => $request->input('completion_date'),
            'main_contact' => $request->input('main_contact'),
            'notes' => $request->input('notes'),
        ];
        $project = Project::create($projectData);
        $company = Company::find($companyId);
        $project->company()->associate($company);
        $project->save(); 

        return redirect()->route('projects.edit', ['projectId' => $project->id])
            ->with('success', 'Project created successfully');
    }





    public function save(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'main_contact' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $companyId = auth()->user()->company_id;

        if ($id === null) {
            $project = Project::create([
                'name' => $validatedData['name'],
                'company_id' => $companyId,
                'description' => $validatedData['description'],
                'completion_date' => $validatedData['completion_date'],
                'main_contact' => $validatedData['main_contact'],
                'notes' => $validatedData['notes'],
            ]);
            $message = 'Project created successfully';
        } else {
            $project = Project::findOrFail($id);
            $project->update($validatedData);
            $message = 'Project updated successfully';
        }

        return redirect()->route('projects.show', ['id' => $project->id])
            ->with('success', $message);
    }

    public function show($projectId)
    {
        $project = Project::findOrFail($projectId);
        $mainContactUser = User::find($project->main_contact);
        return view('projects.show', compact('project', 'mainContactUser'));
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        $user = auth()->user();
        $company = $user->company;

        return redirect()->route('companies.company', ['id' => $company->id])->with('success', 'Project deleted successfully');
    }
}
