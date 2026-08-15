<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $fees = Fee::with(['student', 'feeType'])->latest()->paginate(10);
        return view('admin.fees.index', compact('fees'));
    }

    public function create()
    {
        $feeTypes = FeeType::all();
        $students = Student::where('status', 'active')->get();
        return view('admin.fees.create', compact('feeTypes', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_type_id' => 'required|exists:fee_types,id',
            'amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|in:paid,partial,unpaid',
        ]);

        $data = $request->all();
        $data['due_amount'] = $request->amount - $request->paid_amount;

        Fee::create($data);

        return redirect()->route('admin.fees.index')->with('success', 'Fee record created successfully.');
    }

    public function show(Fee $fee)
    {
        $fee->load(['student', 'feeType']);
        return view('admin.fees.show', compact('fee'));
    }

    public function edit(Fee $fee)
    {
        $feeTypes = FeeType::all();
        $students = Student::all();
        return view('admin.fees.edit', compact('fee', 'feeTypes', 'students'));
    }

    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_type_id' => 'required|exists:fee_types,id',
            'amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|in:paid,partial,unpaid',
        ]);

        $data = $request->all();
        $data['due_amount'] = $request->amount - $request->paid_amount;

        $fee->update($data);

        return redirect()->route('admin.fees.index')->with('success', 'Fee record updated successfully.');
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('admin.fees.index')->with('success', 'Fee record deleted successfully.');
    }
}