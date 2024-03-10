<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{

    public function show(Request $request)
    {
        $user = auth()->user();
        if ($user->user_type == 'client') {
            $company = $user->company;
        } else {
            $companyId = $request->query('companyId');
            $company = Company::find($companyId);
            if (!$company) {
                $companies = Company::all();
                return view('companies.index', compact('companies'));
            }
        }
        $projects = $company->projects;
        $users = $company->users;
        return view('companies.show', compact('company', 'projects', 'users'));
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
        $user = auth()->user();
        if ($user->user_type == 'client') {
            $company = $user->company;
        } else {
            $company = Company::find($companyId);
            if (!$company) {
                $companies = Company::all();
                return view('companies.index', compact('companies'));
            }
        }
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
        if (auth()->user()->user_type == 'client') {
            return redirect()->route('companies.show', ['companyId' => $company->id])->with('success', $message);
        }
        return redirect()->route('companies.index')->with('success', $message);
    }
}
