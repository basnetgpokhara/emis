<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $students = Student::with('class')->latest()->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|unique:students,email',
            'address' => 'nullable|string',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'class_id' => 'required|exists:classes,id',
            'section' => 'nullable|string|max:10',
            'roll_no' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['admission_no'] = 'STU-' . str_pad(Student::max('id') + 1, 5, '0', STR_PAD_LEFT);
        $data['status'] = 'active';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'stu-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $filename);
            $data['photo'] = 'uploads/students/' . $filename;
        }

        // Create user account
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email ?? $request->admission_no . '@emis.local',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'active',
        ]);

        $data['user_id'] = $user->id;
        Student::create($data);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load(['class', 'attendances', 'results']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classes = Classes::all();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'address' => 'nullable|string',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'class_id' => 'required|exists:classes,id',
            'section' => 'nullable|string|max:10',
            'roll_no' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'stu-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $filename);
            $data['photo'] = 'uploads/students/' . $filename;
        }

        $student->update($data);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        if ($student->user) {
            $student->user->delete();
        }
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}