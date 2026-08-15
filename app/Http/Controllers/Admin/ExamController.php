<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $exams = Exam::with(['examType', 'class', 'subject'])->latest()->paginate(10);
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        $examTypes = ExamType::all();
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('admin.exams.create', compact('examTypes', 'classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'exam_type_id' => 'required|exists:exam_types,id',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'total_marks' => 'required|numeric|min:1',
            'passing_marks' => 'required|numeric|min:0|lte:total_marks',
        ]);

        Exam::create($request->all());

        return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        $exam->load(['examType', 'class', 'subject', 'results.student']);
        return view('admin.exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        $examTypes = ExamType::all();
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('admin.exams.edit', compact('exam', 'examTypes', 'classes', 'subjects'));
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'exam_type_id' => 'required|exists:exam_types,id',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'total_marks' => 'required|numeric|min:1',
            'passing_marks' => 'required|numeric|min:0|lte:total_marks',
        ]);

        $exam->update($request->all());

        return redirect()->route('admin.exams.index')->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('admin.exams.index')->with('success', 'Exam deleted successfully.');
    }
}