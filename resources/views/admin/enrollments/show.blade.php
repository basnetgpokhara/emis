@extends('layouts.admin')

@section('title', 'Enrollment Details')
@section('page-title', '<span>Enrollment</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.enrollments.index') }}">Enrollments</a></li>
            <li class="breadcrumb-item active">Enrollment #{{ $enrollment->id }}</li>
        </ol>
    </nav>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-avatar"><i class="fas fa-user-plus"></i></div>
        <div>
            <h4 class="fw-bold mb-1">Enrollment Record</h4>
            <span class="badge bg-{{ $enrollment->status === 'active' ? 'success' : ($enrollment->status === 'inactive' ? 'danger' : 'warning') }}">{{ ucfirst($enrollment->status) }}</span>
        </div>
    </div>
    <div class="detail-body">
        <div class="detail-row"><div class="detail-label">Student</div><div class="detail-value">{{ $enrollment->student->first_name ?? '' }} {{ $enrollment->student->last_name ?? '' }}</div></div>
        <div class="detail-row"><div class="detail-label">Class</div><div class="detail-value">{{ $enrollment->class->name ?? 'N/A' }}</div></div>
        <div class="detail-row"><div class="detail-label">Academic Year</div><div class="detail-value">{{ $enrollment->academic_year }}</div></div>
        <div class="detail-row"><div class="detail-label">Enrolled On</div><div class="detail-value">{{ $enrollment->created_at->format('M d, Y') }}</div></div>
    </div>
</div>
@endsection