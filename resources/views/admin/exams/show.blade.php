@extends('layouts.admin')

@section('title', 'Exam Details')
@section('page-title', '<span>Exam</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.exams.index') }}">Exams</a></li>
            <li class="breadcrumb-item active">{{ $exam->name }}</li>
        </ol>
    </nav>
</div>

<div class="row g-4">
    <div class="col-md-5">
        <div class="detail-card">
            <div class="detail-header">
                <div class="detail-avatar"><i class="fas fa-file-alt"></i></div>
                <div>
                    <h4 class="fw-bold mb-1">{{ $exam->name }}</h4>
                    <span class="badge bg-info">{{ $exam->examType->name ?? 'N/A' }}</span>
                </div>
            </div>
            <div class="detail-body">
                <div class="detail-row"><div class="detail-label">Class</div><div class="detail-value">{{ $exam->class->name ?? 'N/A' }}</div></div>
                <div class="detail-row"><div class="detail-label">Subject</div><div class="detail-value">{{ $exam->subject->name ?? 'N/A' }}</div></div>
                <div class="detail-row"><div class="detail-label">Date</div><div class="detail-value">{{ $exam->date ? $exam->date->format('M d, Y') : 'N/A' }}</div></div>
                <div class="detail-row"><div class="detail-label">Total Marks</div><div class="detail-value">{{ $exam->total_marks }}</div></div>
                <div class="detail-row"><div class="detail-label">Passing Marks</div><div class="detail-value">{{ $exam->passing_marks }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="table-card">
            <div class="card-header"><h5><i class="fas fa-chart-bar me-2 text-primary"></i> Results</h5></div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>Student</th><th>Marks</th><th>Grade</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($exam->results as $result)
                            <tr>
                                <td class="fw-semibold">{{ $result->student->first_name ?? '' }} {{ $result->student->last_name ?? '' }}</td>
                                <td>{{ $result->marks_obtained }} / {{ $exam->total_marks }}</td>
                                <td><span class="badge bg-primary">{{ $result->grade ?? 'N/A' }}</span></td>
                                <td>
                                    @if($result->marks_obtained >= $exam->passing_marks)
                                        <span class="badge bg-success">Passed</span>
                                    @else
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No results recorded yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection