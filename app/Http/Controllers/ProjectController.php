<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules as needed
        ]);

        // Retrieve the company ID from the authenticated user or the form data
        $companyId = auth()->user()->company_id; // Assuming the user is associated with a company

        // Create a new project with the associated company ID
        $project = Project::create([
            'name' => $validatedData['name'],
            'company_id' => $companyId,
        ]);

        return redirect()->route('projects.show', ['id' => $project->id])
        ->with('success', 'Project created successfully');

    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
{
    // Validate request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        // Add more validation rules as needed
    ]);

    // Update the project
    $project = Project::findOrFail($id);
    $project->update($validatedData);

    return redirect()->route('projects.show', ['id' => $project->id])
        ->with('success', 'Project updated successfully');
}

}
