@extends('layouts.admin')

@section('title', 'Edit Enrollment')
@section('page-title', '<span>Edit</span> Enrollment')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.enrollments.index') }}">Enrollments</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-edit me-2 text-primary"></i> Edit Enrollment</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.enrollments.update', $enrollment) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Student</label>
                    <select name="student_id" class="form-select" required>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $enrollment->student_id) == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Class</label>
                    <select name="class_id" class="form-select" required>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id', $enrollment->class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Academic Year</label>
                    <input type="text" name="academic_year" class="form-control" value="{{ old('academic_year', $enrollment->academic_year) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $enrollment->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $enrollment->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="graduated" {{ old('status', $enrollment->status) == 'graduated' ? 'selected' : '' }}>Graduated</option>
                        <option value="transferred" {{ old('status', $enrollment->status) == 'transferred' ? 'selected' : '' }}>Transferred</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Enrollment</button>
                <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection