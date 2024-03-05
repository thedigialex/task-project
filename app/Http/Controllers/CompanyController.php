<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;

class CompanyController extends Controller
{
    public function __construct()
    {
        //$this->middleware('admin')->except('index');
    }

    public function show(Request $request, Company $company)
    {
        $projects = $company->projects;
        $users = $company->users;
        return view('companies.show', compact('company', 'projects', 'users'));
        
    }
    public function adminview($companyId)
    {
        $company = Company::findOrFail($companyId);
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
        if(auth()->user()->user_type == 'client'){
            return redirect()->route('companies.show', ['company' => $company->company_id])->with('success', $message);
        }
        return redirect()->route('companies.index')->with('success', $message);
    }
}
