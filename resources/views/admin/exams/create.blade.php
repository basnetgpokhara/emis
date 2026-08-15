@extends('layouts.admin')

@section('title', 'Create Exam')
@section('page-title', '<span>Create</span> Exam')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.exams.index') }}">Exams</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-plus-circle me-2 text-primary"></i> Exam Information</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.exams.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Exam Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Exam Type <span class="text-danger">*</span></label>
                    <select name="exam_type_id" class="form-select @error('exam_type_id') is-invalid @enderror" required>
                        <option value="">Select Type</option>
                        @foreach($examTypes as $type)
                            <option value="{{ $type->id }}" {{ old('exam_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('exam_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                    <label class="form-label fw-semibold">Subject <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }} ({{ $subject->code }})</option>
                        @endforeach
                    </select>
                    @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Exam Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
                    @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Total Marks <span class="text-danger">*</span></label>
                    <input type="number" name="total_marks" class="form-control @error('total_marks') is-invalid @enderror" value="{{ old('total_marks', 100) }}" step="0.01" min="1" required>
                    @error('total_marks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Passing Marks <span class="text-danger">*</span></label>
                    <input type="number" name="passing_marks" class="form-control @error('passing_marks') is-invalid @enderror" value="{{ old('passing_marks', 40) }}" step="0.01" min="0" required>
                    @error('passing_marks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Create Exam</button>
                <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection