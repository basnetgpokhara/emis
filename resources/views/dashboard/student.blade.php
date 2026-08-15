@extends('layouts.admin')

@section('title', 'Student Dashboard')
@section('page-title', '<span>Student Dashboard</span>')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon success"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-label">Attendance</div>
            <div class="stat-value">{{ $attendancePercentage }}%</div>
            <div class="stat-change">{{ $attendances->count() }} total records</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon primary"><i class="fas fa-user"></i></div>
            <div class="stat-label">Profile</div>
            <div class="stat-value" style="font-size:1rem;">
                {{ $student ? $student->full_name : 'N/A' }}
            </div>
        </div>
    </div>
</div>

@if($student)
<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-user me-2 text-primary"></i> My Details</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Admission No:</strong> {{ $student->admission_no }}</p>
                <p><strong>Class:</strong> {{ $student->class->name ?? 'N/A' }} {{ $student->section ?? '' }}</p>
                <p><strong>Roll No:</strong> {{ $student->roll_no ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Guardian:</strong> {{ $student->guardian_name }}</p>
                <p><strong>Guardian Phone:</strong> {{ $student->guardian_phone }}</p>
                <p><strong>Address:</strong> {{ $student->address ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-info">Student profile not found. Please contact the administration.</div>
@endif
@endsection