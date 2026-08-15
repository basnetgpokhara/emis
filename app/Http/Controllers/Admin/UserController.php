<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,teacher,student,parent',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,teacher,student,parent',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return redirect()->route('admin.users.index')->with('error', 'Cannot delete the only admin user.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}