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
        $user = auth()->user();
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

            $groupedOtherUsers = collect($otherUsers)->groupBy(function ($user) {
                return $user->company->name ?? 'No Company';
            });

            $usersNeedingCompany = collect($usersNeedingCompany);
            $staffUsers = collect($staffUsers);
            $otherUsers = collect($otherUsers);

            return view('users.index', compact('usersNeedingCompany', 'staffUsers', 'otherUsers'));
        }
    }

    public function create()
    {
        $companies = Company::all();
        return view('users.edit', compact('companies'));
    }

    public function edit($userId)
    {
        $userEditor = auth()->user();
        if ($userEditor->user_type == 'client') {
            $company = $userEditor->company;
            $users = $company->users;
            $user = User::find($userId);
            if ($user && $users->contains($user)) {
                return view('users.edit', compact('user'));
            } else {
                return redirect()->route('users.index');
            }
        }
        $companies = Company::all();
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('users.index');
        }
        return view('users.edit', compact('user', 'companies'));
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
        return redirect()->route('users.index');
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
