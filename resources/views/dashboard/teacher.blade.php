@extends('layouts.admin')

@section('title', 'Teacher Dashboard')
@section('page-title', '<span>Teacher Dashboard</span>')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon primary"><i class="fas fa-user-graduate"></i></div>
            <div class="stat-label">My Students</div>
            <div class="stat-value">{{ $totalStudents }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon warning"><i class="fas fa-school"></i></div>
            <div class="stat-label">Classes</div>
            <div class="stat-value">{{ $myClasses }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon info"><i class="fas fa-book"></i></div>
            <div class="stat-label">Subjects</div>
            <div class="stat-value">{{ $mySubjects }}</div>
        </div>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-user me-2 text-primary"></i> My Profile</h5>
    </div>
    <div class="card-body">
        @if($teacher)
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $teacher->full_name }}</p>
                    <p><strong>Employee ID:</strong> {{ $teacher->employee_id }}</p>
                    <p><strong>Email:</strong> {{ $teacher->email }}</p>
                    <p><strong>Phone:</strong> {{ $teacher->phone }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Qualification:</strong> {{ $teacher->qualification }}</p>
                    <p><strong>Experience:</strong> {{ $teacher->experience }} years</p>
                    <p><strong>Subject:</strong> {{ $teacher->subject->name ?? 'N/A' }}</p>
                </div>
            </div>
        @else
            <p class="text-muted">Teacher profile not found.</p>
        @endif
    </div>
</div>
@endsection