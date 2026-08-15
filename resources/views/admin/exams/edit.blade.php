@extends('layouts.admin')

@section('title', 'Edit Exam')
@section('page-title', '<span>Edit</span> Exam')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.exams.index') }}">Exams</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-edit me-2 text-primary"></i> Edit Exam: {{ $exam->name }}</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.exams.update', $exam) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Exam Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $exam->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Exam Type</label>
                    <select name="exam_type_id" class="form-select" required>
                        @foreach($examTypes as $type)
                            <option value="{{ $type->id }}" {{ old('exam_type_id', $exam->exam_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Class</label>
                    <select name="class_id" class="form-select" required>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id', $exam->class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Subject</label>
                    <select name="subject_id" class="form-select" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $exam->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Exam Date</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', $exam->date ? $exam->date->format('Y-m-d') : '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Total Marks</label>
                    <input type="number" name="total_marks" class="form-control" value="{{ old('total_marks', $exam->total_marks) }}" step="0.01" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Passing Marks</label>
                    <input type="number" name="passing_marks" class="form-control" value="{{ old('passing_marks', $exam->passing_marks) }}" step="0.01" required>
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Exam</button>
                <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection