<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->user_type === 'client') {
            $users = $user->company->users;
            return view('users.index', compact('users'));
        } else {
            $allUsers = User::all();

            $usersNeedingCompany = [];
            $staffUsers = [];
            $otherUsers = [];

            foreach ($allUsers as $user) {
                if (!$user->company && $user->user_type !== 'staff') {
                    $usersNeedingCompany[] = $user;
                } elseif ($user->user_type === 'staff') {
                    $staffUsers[] = $user;
                } else {
                    $otherUsers[] = $user;
                }
            }

            $usersNeedingCompany = collect($usersNeedingCompany);
            $staffUsers = collect($staffUsers);
            $otherUsers = collect($otherUsers);

            return view('users.index', compact('usersNeedingCompany', 'staffUsers', 'otherUsers'));
        }
    }

    public function create()
    {
        $companies = Company::all();
        $isAdmin = Auth::user()->user_type == 'admin';
        return view('users.edit', compact('companies', 'isAdmin'));
    }

    public function edit(Request $request)
    {
        $userId = $request->input('id');
        $user = User::find($userId);
        $isAdmin = Auth::user()->user_type == 'admin';
        $companies = ($isAdmin) ? Company::all() : $user->company;
        return view('users.edit', compact('user', 'companies', 'isAdmin'));
    }

    public function update(Request $request)
{
    $userId = $request->input('id'); // Get the user ID from the form
    $user = User::find($userId); // Find the user by ID
    
    // Define validation rules
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . ($user ? $user->id : ''),
        'password' => $request->isMethod('post') ? 'required|min:8' : 'nullable|min:8',
    ];
    
    if (Auth::user()->user_type == 'admin') {
        $rules += [
            'user_type' => 'required|in:client,staff',
            'company_id' => 'nullable|exists:companies,id',
        ];
    }

    // Validate the request data
    $validatedData = $request->validate($rules);

    // If user does not exist, create a new user (for create scenarios)
    if (!$user) {
        $user = new User();
        $user->password = Hash::make($validatedData['password']);

        if (Auth::user()->user_type === 'client') {
            $user->user_type = Auth::user()->user_type;
            $user->company_id = Auth::user()->company->id;
        }
    }

    // Update the user with validated data
    $user->fill($validatedData);
    $user->save();

    // Redirect to the edit page
    return redirect()->route('users.edit', ['id' => $user->id]);
}

}
