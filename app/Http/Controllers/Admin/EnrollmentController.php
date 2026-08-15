<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Classes;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $enrollments = Enrollment::with(['student', 'class'])->latest()->paginate(10);
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::where('status', 'active')->get();
        $classes = Classes::all();
        return view('admin.enrollments.create', compact('students', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'academic_year' => 'required|string|max:20',
            'status' => 'required|in:active,inactive,graduated,transferred',
        ]);

        Enrollment::create($request->all());

        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment created successfully.');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'class']);
        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $classes = Classes::all();
        return view('admin.enrollments.edit', compact('enrollment', 'students', 'classes'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'academic_year' => 'required|string|max:20',
            'status' => 'required|in:active,inactive,graduated,transferred',
        ]);

        $enrollment->update($request->all());

        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('admin.enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}