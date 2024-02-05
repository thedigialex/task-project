<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->user_type === 'Client' && auth()->user()->company_id !== $user->id) {
            abort(404);
        }
        return view('users.edit', compact('user'));
    }
    public function store(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        if ($id) {
            $user = User::findOrFail($id);
            $user->name = $validatedData['name'];
            $user->save();
            $message = 'User updated successfully';
        } else {
            $user = new User();
            $user->name = $validatedData['name'];
            $user->save();
            $message = 'User created successfully';
        }
        if (auth()->user()->user_type === 'Client') {
            return redirect()->route('company')->with('success', $message);
        }
        return redirect()->route('users.index')->with('success', $message);
    }
}
