<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        $companies = Company::all();
        return view('users.edit', compact('companies'));
    }
    public function edit($userId)
    {
        $companies = Company::all();
        $user = User::findOrFail($userId);

        return view('users.edit', compact('user'), compact('companies'));
    }
    private function saveUser(Request $request, $user = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . ($user ? $user->id : ''),
            'password' => $request->isMethod('post') ? 'required|min:8' : 'nullable|min:8',
        ];
        if (auth()->user()->user_type !== 'client') {
            $rules += [
                'user_type' => 'required|in:client,staff',
                'company_id' => 'nullable|exists:companies,id',
            ];
        }
        $validatedData = $request->validate($rules);
        if (!$user) {
            $user = new User();
            $user->password = Hash::make($validatedData['password']);

            if (auth()->user()->user_type === 'client') {
                $user->user_type = auth()->user()->user_type;
                $user->company_id = auth()->user()->company->id;
            }
        }
        $user->fill($validatedData);
        $user->save();
        $message = $user->wasRecentlyCreated ? 'User created successfully' : 'User updated successfully';
        return auth()->user()->user_type === 'client'
            ? redirect()->route('companies.show', ['company' => $user->company_id])->with('success', $message)
            : redirect()->route('users.index')->with('success', $message);
    }

    public function store(Request $request)
    {
        return $this->saveUser($request);
    }

    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        return $this->saveUser($request, $user);
    }
}
