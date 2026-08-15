@extends('layouts.admin')

@section('title', 'Add Result')
@section('page-title', '<span>Add</span> Result')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.results.index') }}">Results</a></li>
            <li class="breadcrumb-item active">Add New</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-plus-circle me-2 text-primary"></i> Result Information</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.results.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Exam <span class="text-danger">*</span></label>
                    <select name="exam_id" id="exam_id" class="form-select @error('exam_id') is-invalid @enderror" required onchange="loadStudents()">
                        <option value="">Select Exam</option>
                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}" {{ old('exam_id') == $exam->id ? 'selected' : '' }}>{{ $exam->name }} ({{ $exam->class->name ?? 'N/A' }})</option>
                        @endforeach
                    </select>
                    @error('exam_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Student <span class="text-danger">*</span></label>
                    <select name="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                        <option value="">Select Exam First</option>
                    </select>
                    @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Subject <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Marks Obtained <span class="text-danger">*</span></label>
                    <input type="number" name="marks_obtained" class="form-control @error('marks_obtained') is-invalid @enderror" value="{{ old('marks_obtained') }}" step="0.01" min="0" required>
                    @error('marks_obtained') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Grade</label>
                    <input type="text" name="grade" class="form-control @error('grade') is-invalid @enderror" value="{{ old('grade') }}" placeholder="e.g. A, B+">
                    @error('grade') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Result</button>
                <a href="{{ route('admin.results.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    function loadStudents() {
        var examId = document.getElementById('exam_id').value;
        var studentSelect = document.getElementById('student_id');
        
        if (!examId) {
            studentSelect.innerHTML = '<option value="">Select Exam First</option>';
            return;
        }

        fetch('/admin/results/get-students/' + examId)
            .then(response => response.json())
            .then(students => {
                studentSelect.innerHTML = '<option value="">Select Student</option>';
                students.forEach(function(student) {
                    studentSelect.innerHTML += '<option value="' + student.id + '">' + student.first_name + ' ' + student.last_name + ' (' + student.admission_no + ')</option>';
                });
            });
    }
</script>
@endsection