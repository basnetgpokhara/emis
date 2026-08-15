<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Classes;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $attendances = Attendance::with(['student', 'class'])
            ->latest()
            ->paginate(10);
        $classes = Classes::all();
        return view('admin.attendance.index', compact('attendances', 'classes'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('admin.attendance.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'date' => 'required|date',
            'students' => 'required|array',
            'students.*.status' => 'required|in:present,absent,late,holiday',
            'students.*.remark' => 'nullable|string|max:255',
        ]);

        foreach ($request->students as $studentId => $data) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'class_id' => $request->class_id,
                    'date' => $request->date,
                ],
                [
                    'status' => $data['status'],
                    'remark' => $data['remark'] ?? null,
                ]
            );
        }

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance recorded successfully.');
    }

    public function show(Attendance $attendance)
    {
        return view('admin.attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $classes = Classes::all();
        return view('admin.attendance.edit', compact('attendance', 'classes'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required|in:present,absent,late,holiday',
            'remark' => 'nullable|string|max:255',
        ]);

        $attendance->update($request->all());

        return redirect()->route('admin.attendance.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('admin.attendance.index')->with('success', 'Attendance deleted successfully.');
    }

    public function getStudentsByClass(Request $request)
    {
        $students = Student::where('class_id', $request->class_id)
            ->where('status', 'active')
            ->get();
        return response()->json($students);
    }
}