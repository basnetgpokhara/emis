<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Exam;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $results = Result::with(['student', 'exam', 'subject'])->latest()->paginate(10);
        return view('admin.results.index', compact('results'));
    }

    public function create()
    {
        $exams = Exam::with('class')->get();
        $subjects = Subject::all();
        $students = collect();
        return view('admin.results.create', compact('exams', 'subjects', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'marks_obtained' => 'required|numeric|min:0',
            'grade' => 'nullable|string|max:2',
        ]);

        $exam = Exam::find($request->exam_id);
        if ($request->marks_obtained > $exam->total_marks) {
            return back()->with('error', 'Marks obtained cannot exceed total marks.');
        }

        Result::create($request->all());

        return redirect()->route('admin.results.index')->with('success', 'Result added successfully.');
    }

    public function show(Result $result)
    {
        $result->load(['student', 'exam', 'subject']);
        return view('admin.results.show', compact('result'));
    }

    public function edit(Result $result)
    {
        $exams = Exam::all();
        $subjects = Subject::all();
        $students = Student::all();
        return view('admin.results.edit', compact('result', 'exams', 'subjects', 'students'));
    }

    public function update(Request $request, Result $result)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'marks_obtained' => 'required|numeric|min:0',
            'grade' => 'nullable|string|max:2',
        ]);

        $exam = Exam::find($request->exam_id);
        if ($request->marks_obtained > $exam->total_marks) {
            return back()->with('error', 'Marks obtained cannot exceed total marks.');
        }

        $result->update($request->all());

        return redirect()->route('admin.results.index')->with('success', 'Result updated successfully.');
    }

    public function destroy(Result $result)
    {
        $result->delete();
        return redirect()->route('admin.results.index')->with('success', 'Result deleted successfully.');
    }

    public function getStudentsByExam(Request $request)
    {
        $exam = Exam::with('class')->find($request->exam_id);
        if (!$exam) {
            return response()->json([]);
        }
        $students = Student::where('class_id', $exam->class_id)
            ->where('status', 'active')
            ->get();
        return response()->json($students);
    }
}