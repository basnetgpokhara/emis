@extends('layouts.admin')

@section('title', 'Add Fee')
@section('page-title', '<span>Add</span> Fee Record')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.fees.index') }}">Fees</a></li>
            <li class="breadcrumb-item active">Add New</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-plus-circle me-2 text-primary"></i> Fee Information</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.fees.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Student <span class="text-danger">*</span></label>
                    <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                        <option value="">Select Student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                    @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Fee Type <span class="text-danger">*</span></label>
                    <select name="fee_type_id" class="form-select @error('fee_type_id') is-invalid @enderror" required>
                        <option value="">Select Fee Type</option>
                        @foreach($feeTypes as $type)
                            <option value="{{ $type->id }}" {{ old('fee_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }} (${{ number_format($type->amount, 2) }})</option>
                        @endforeach
                    </select>
                    @error('fee_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Amount <span class="text-danger">*</span></label>
                    <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" step="0.01" min="0" required>
                    @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Paid Amount <span class="text-danger">*</span></label>
                    <input type="number" name="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" value="{{ old('paid_amount', 0) }}" step="0.01" min="0" required>
                    @error('paid_amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Payment Date <span class="text-danger">*</span></label>
                    <input type="date" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', date('Y-m-d')) }}" required>
                    @error('payment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="partial" {{ old('status') == 'partial' ? 'selected' : '' }}>Partial</option>
                        <option value="unpaid" {{ old('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Fee Record</button>
                <a href="{{ route('admin.fees.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection