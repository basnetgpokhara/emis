@extends('layouts.admin')

@section('title', 'New Enrollment')
@section('page-title', '<span>New</span> Enrollment')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.enrollments.index') }}">Enrollments</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-plus-circle me-2 text-primary"></i> Enrollment Information</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.enrollments.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Student <span class="text-danger">*</span></label>
                    <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                        <option value="">Select Student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }} ({{ $student->admission_no }})</option>
                        @endforeach
                    </select>
                    @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Class <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select @error('class_id') is-invalid @enderror" required>
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                    @error('class_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Academic Year <span class="text-danger">*</span></label>
                    <input type="text" name="academic_year" class="form-control @error('academic_year') is-invalid @enderror" value="{{ old('academic_year', date('Y') . '/' . (date('Y')+1)) }}" required>
                    @error('academic_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="graduated" {{ old('status') == 'graduated' ? 'selected' : '' }}>Graduated</option>
                        <option value="transferred" {{ old('status') == 'transferred' ? 'selected' : '' }}>Transferred</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Enrollment</button>
                <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection