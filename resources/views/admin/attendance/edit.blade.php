@extends('layouts.admin')

@section('title', 'Edit Attendance')
@section('page-title', '<span>Edit</span> Attendance')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}">Attendance</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-edit me-2 text-primary"></i> Edit Attendance Record</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.attendance.update', $attendance) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="present" {{ old('status', $attendance->status) == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ old('status', $attendance->status) == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="late" {{ old('status', $attendance->status) == 'late' ? 'selected' : '' }}>Late</option>
                        <option value="holiday" {{ old('status', $attendance->status) == 'holiday' ? 'selected' : '' }}>Holiday</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Remark</label>
                    <input type="text" name="remark" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark', $attendance->remark) }}" placeholder="Optional remark">
                    @error('remark') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Attendance</button>
                <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection