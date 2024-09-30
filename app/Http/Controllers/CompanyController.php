<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $company = $user->user_type != 'admin' ? $user->company : Company::find($request->input('id'));
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

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $companyId = $request->input('id');

        if ($companyId) {
            $company = Company::findOrFail($companyId);
            $company->update($validatedData);
        } else {
            $company = Company::create($validatedData);
        }
        $request->merge(['id' => $company->id]);
        return $this->show($request);
    }
}
