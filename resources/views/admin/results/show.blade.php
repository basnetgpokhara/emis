@extends('layouts.admin')

@section('title', 'Result Details')
@section('page-title', '<span>Result</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.results.index') }}">Results</a></li>
            <li class="breadcrumb-item active">Result #{{ $result->id }}</li>
        </ol>
    </nav>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-avatar"><i class="fas fa-chart-bar"></i></div>
        <div>
            <h4 class="fw-bold mb-1">Exam Result</h4>
            <span class="badge bg-info">{{ $result->exam->name ?? 'N/A' }}</span>
        </div>
    </div>
    <div class="detail-body">
        <div class="detail-row"><div class="detail-label">Student</div><div class="detail-value">{{ $result->student->first_name ?? '' }} {{ $result->student->last_name ?? '' }}</div></div>
        <div class="detail-row"><div class="detail-label">Exam</div><div class="detail-value">{{ $result->exam->name ?? 'N/A' }}</div></div>
        <div class="detail-row"><div class="detail-label">Subject</div><div class="detail-value">{{ $result->subject->name ?? 'N/A' }}</div></div>
        <div class="detail-row"><div class="detail-label">Marks Obtained</div><div class="detail-value">{{ $result->marks_obtained }}</div></div>
        <div class="detail-row"><div class="detail-label">Grade</div><div class="detail-value"><span class="badge bg-primary">{{ $result->grade ?? 'N/A' }}</span></div></div>
    </div>
</div>
@endsection