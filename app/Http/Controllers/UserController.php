<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

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
    public function edit($id)
    {
        $companies = Company::all();
        $user = User::findOrFail($id);
        if (auth()->user()->user_type === 'Client' && auth()->user()->company_id !== $user->id) {
            abort(404);
        }
        return view('users.edit', compact('user'), compact('companies'));
    }
    public function store(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
            'role' => 'required',
            'company' => 'required_if:role,client',
        ]);

        if ($id) {
            $user = User::findOrFail($id);
            $user->name = $validatedData['name'];
            $user->save();
            $message = 'User updated successfully';
        } else {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'user_type' => $validatedData['role'],
                'company_id' => $validatedData['company'] ?? null,
            ]);

            event(new Registered($user));

            $message = 'User created successfully';
        }

        if (auth()->user()->user_type === 'Client') {
            return redirect()->route('company')->with('success', $message);
        }
        return redirect()->route('users.index')->with('success', $message);
    }
}
