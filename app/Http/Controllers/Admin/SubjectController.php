<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Classes;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $subjects = Subject::with('class')->latest()->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('admin.subjects.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects',
            'class_id' => 'required|exists:classes,id',
            'description' => 'nullable|string',
        ]);

        Subject::create($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        $subject->load('class');
        return view('admin.subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $classes = Classes::all();
        return view('admin.subjects.edit', compact('subject', 'classes'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects,code,' . $subject->id,
            'class_id' => 'required|exists:classes,id',
            'description' => 'nullable|string',
        ]);

        $subject->update($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
}