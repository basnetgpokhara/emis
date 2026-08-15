<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $teachers = Teacher::with('subject')->latest()->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('admin.teachers.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:teachers,email',
            'address' => 'nullable|string',
            'qualification' => 'required|string|max:255',
            'experience' => 'nullable|numeric|min:0',
            'subject_id' => 'required|exists:subjects,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['employee_id'] = 'TCH-' . str_pad(Teacher::max('id') + 1, 4, '0', STR_PAD_LEFT);
        $data['status'] = 'active';

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        // Create user account
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'status' => 'active',
        ]);

        $data['user_id'] = $user->id;
        Teacher::create($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('subject');
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $subjects = Subject::all();
        return view('admin.teachers.edit', compact('teacher', 'subjects'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'address' => 'nullable|string',
            'qualification' => 'required|string|max:255',
            'experience' => 'nullable|numeric|min:0',
            'subject_id' => 'required|exists:subjects,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->user) {
            $teacher->user->delete();
        }
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}