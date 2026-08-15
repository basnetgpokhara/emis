<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\FeeType;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $examTypes = ExamType::all();
        $feeTypes = FeeType::all();
        return view('admin.settings.index', compact('examTypes', 'feeTypes'));
    }

    // Exam Types
    public function storeExamType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ExamType::create($request->all());

        return redirect()->route('admin.settings')->with('success', 'Exam type created successfully.');
    }

    public function updateExamType(Request $request, ExamType $examType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $examType->update($request->all());

        return redirect()->route('admin.settings')->with('success', 'Exam type updated successfully.');
    }

    public function destroyExamType(ExamType $examType)
    {
        if ($examType->exams()->count() > 0) {
            return back()->with('error', 'Cannot delete exam type with associated exams.');
        }
        $examType->delete();
        return redirect()->route('admin.settings')->with('success', 'Exam type deleted successfully.');
    }

    // Fee Types
    public function storeFeeType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        FeeType::create($request->all());

        return redirect()->route('admin.settings')->with('success', 'Fee type created successfully.');
    }

    public function updateFeeType(Request $request, FeeType $feeType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $feeType->update($request->all());

        return redirect()->route('admin.settings')->with('success', 'Fee type updated successfully.');
    }

    public function destroyFeeType(FeeType $feeType)
    {
        if ($feeType->fees()->count() > 0) {
            return back()->with('error', 'Cannot delete fee type with associated fees.');
        }
        $feeType->delete();
        return redirect()->route('admin.settings')->with('success', 'Fee type deleted successfully.');
    }
}