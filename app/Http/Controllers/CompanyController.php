<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;

class CompanyController extends Controller
{
    public function overview()
    {
        $user = auth()->user();
        $company = $user->company;
        $projects = $company->projects;
        return view('companies.show', compact('company', 'projects'));
    }
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }
    public function create()
    {
        return view('companies.edit');
    }
    public function edit($companyId)
    {
        $company = Company::findOrFail($companyId);

        return view('companies.edit', compact('company'));
    }

    public function store(Request $request)
    {
        return $this->saveCompany($request);
    }

    public function update(Request $request, $companyId)
    {
        $company = Company::findOrFail($companyId);

        return $this->saveCompany($request, $company);
    }

    private function saveCompany(Request $request, $company = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if (!$company) {
            $company = new Company();
        }
        $company->fill($validatedData);
        $company->save();
        $message = $company->wasRecentlyCreated ? 'Company created successfully' : 'Company updated successfully';

        return redirect()->route('companies.index')->with('success', $message);
    }
}
