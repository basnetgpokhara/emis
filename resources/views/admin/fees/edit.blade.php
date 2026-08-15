@extends('layouts.admin')

@section('title', 'Edit Fee')
@section('page-title', '<span>Edit</span> Fee Record')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.fees.index') }}">Fees</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-edit me-2 text-primary"></i> Edit Fee Record</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.fees.update', $fee) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Student</label>
                    <select name="student_id" class="form-select" required>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $fee->student_id) == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Fee Type</label>
                    <select name="fee_type_id" class="form-select" required>
                        @foreach($feeTypes as $type)
                            <option value="{{ $type->id }}" {{ old('fee_type_id', $fee->fee_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Amount</label>
                    <input type="number" name="amount" class="form-control" value="{{ old('amount', $fee->amount) }}" step="0.01" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Paid Amount</label>
                    <input type="number" name="paid_amount" class="form-control" value="{{ old('paid_amount', $fee->paid_amount) }}" step="0.01" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Payment Date</label>
                    <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', $fee->payment_date ? $fee->payment_date->format('Y-m-d') : date('Y-m-d')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="paid" {{ old('status', $fee->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="partial" {{ old('status', $fee->status) == 'partial' ? 'selected' : '' }}>Partial</option>
                        <option value="unpaid" {{ old('status', $fee->status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Fee Record</button>
                <a href="{{ route('admin.fees.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection