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

    public function show($id, $tab = 'pending')
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project', 'tab'));

    }

    public function create()
    {
        return view('projects.edit');
    }
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        $user = auth()->user();
        $company = $user->company;

        return redirect()->route('companies.company', ['id' => $company->id])->with('success', 'Project deleted successfully');
    }
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }
    public function save(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'hours' => 'nullable|integer',
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
                'hours' => $validatedData['hours'],
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
}
