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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . ($user ? $user->id : null),
            'password' => $request->isMethod('post') ? 'required|min:8' : 'nullable|min:8',
            'user_type' => 'required|in:client,staff',
            'company_id' => 'nullable|exists:companies,id',
        ]);
        if (!$user) {
            $user = new User();
            $user->password = Hash::make($validatedData['password']);
        }
        $user->fill($validatedData);
        $user->save();
        $message = $user->wasRecentlyCreated ? 'User created successfully' : 'User updated successfully';

        return redirect()->route('users.index')->with('success', $message);
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
