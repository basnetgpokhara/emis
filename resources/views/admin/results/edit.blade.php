@extends('layouts.admin')

@section('title', 'Edit Result')
@section('page-title', '<span>Edit</span> Result')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.results.index') }}">Results</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-edit me-2 text-primary"></i> Edit Result</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.results.update', $result) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Exam</label>
                    <select name="exam_id" class="form-select" required>
                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}" {{ old('exam_id', $result->exam_id) == $exam->id ? 'selected' : '' }}>{{ $exam->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Student</label>
                    <select name="student_id" class="form-select" required>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $result->student_id) == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Subject</label>
                    <select name="subject_id" class="form-select" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $result->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Marks Obtained <span class="text-danger">*</span></label>
                    <input type="number" name="marks_obtained" class="form-control" value="{{ old('marks_obtained', $result->marks_obtained) }}" step="0.01" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Grade</label>
                    <input type="text" name="grade" class="form-control" value="{{ old('grade', $result->grade) }}">
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Result</button>
                <a href="{{ route('admin.results.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection