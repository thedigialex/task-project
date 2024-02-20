<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function overview()
    {
        $user = auth()->user();
        $company = $user->company;
        return view('companies.show', compact('company'));
    }
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }
    public function create()
    {
        return view('companies.create');
    }
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        if (auth()->user()->user_type === 'Client' && auth()->user()->company_id !== $company->id) {
            abort(404);
        }
        return view('companies.edit', compact('company'));
    }
    public function store(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        if ($id) {
            $company = Company::findOrFail($id);
            $company->name = $validatedData['name'];
            $company->save();
            $message = 'Company updated successfully';
        } else {
            $company = new Company();
            $company->name = $validatedData['name'];
            $company->save();
            $message = 'Company created successfully';
        }
        if (auth()->user()->user_type === 'Client') {
            return redirect()->route('company')->with('success', $message);
        }
        return redirect()->route('companies.index')->with('success', $message);
    }
}
