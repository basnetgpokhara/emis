<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $classes = Classes::withCount('students', 'subjects')->latest()->paginate(10);
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'numeric_name' => 'required|numeric|min:1|max:12',
            'section' => 'nullable|string|max:10',
            'description' => 'nullable|string',
        ]);

        Classes::create($request->all());

        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully.');
    }

    public function show(Classes $class)
    {
        $class->load(['students', 'subjects']);
        return view('admin.classes.show', compact('class'));
    }

    public function edit(Classes $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, Classes $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'numeric_name' => 'required|numeric|min:1|max:12',
            'section' => 'nullable|string|max:10',
            'description' => 'nullable|string',
        ]);

        $class->update($request->all());

        return redirect()->route('admin.classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(Classes $class)
    {
        if ($class->students()->count() > 0) {
            return redirect()->route('admin.classes.index')->with('error', 'Cannot delete class with enrolled students.');
        }
        $class->delete();

        return redirect()->route('admin.classes.index')->with('success', 'Class deleted successfully.');
    }
}