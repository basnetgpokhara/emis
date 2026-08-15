@extends('layouts.admin')

@section('title', 'Attendance Details')
@section('page-title', '<span>Attendance</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}">Attendance</a></li>
            <li class="breadcrumb-item active">Record #{{ $attendance->id }}</li>
        </ol>
    </nav>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-avatar"><i class="fas fa-calendar-check"></i></div>
        <div>
            <h4 class="fw-bold mb-1">Attendance Record</h4>
            <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : ($attendance->status === 'absent' ? 'danger' : ($attendance->status === 'late' ? 'warning' : 'info')) }}">
                {{ ucfirst($attendance->status) }}
            </span>
        </div>
    </div>
    <div class="detail-body">
        <div class="detail-row"><div class="detail-label">Student</div><div class="detail-value">{{ $attendance->student->first_name ?? '' }} {{ $attendance->student->last_name ?? '' }}</div></div>
        <div class="detail-row"><div class="detail-label">Class</div><div class="detail-value">{{ $attendance->class->name ?? 'N/A' }}</div></div>
        <div class="detail-row"><div class="detail-label">Date</div><div class="detail-value">{{ $attendance->date->format('M d, Y') }}</div></div>
        <div class="detail-row"><div class="detail-label">Remark</div><div class="detail-value">{{ $attendance->remark ?? 'N/A' }}</div></div>
    </div>
</div>
@endsection