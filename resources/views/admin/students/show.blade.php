@extends('layouts.admin')

@section('title', 'Student Details')
@section('page-title', '<span>Student</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
            <li class="breadcrumb-item active">{{ $student->first_name }} {{ $student->last_name }}</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-warning">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
    </div>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-avatar" style="background: {{ $student->gender === 'male' ? 'linear-gradient(135deg, #667eea, #764ba2)' : 'linear-gradient(135deg, #f093fb, #f5576c)' }};">
            {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
        </div>
        <div>
            <h4 class="fw-bold mb-1">{{ $student->first_name }} {{ $student->last_name }}</h4>
            <span class="badge bg-{{ $student->status === 'active' ? 'success' : 'danger' }}">{{ ucfirst($student->status) }}</span>
            <span class="badge bg-info">{{ $student->admission_no }}</span>
        </div>
    </div>
    <div class="detail-body">
        <div class="row">
            <div class="col-md-6">
                <div class="detail-row">
                    <div class="detail-label">Admission No</div>
                    <div class="detail-value">{{ $student->admission_no }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Full Name</div>
                    <div class="detail-value">{{ $student->first_name }} {{ $student->last_name }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Gender</div>
                    <div class="detail-value">{{ ucfirst($student->gender) }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Date of Birth</div>
                    <div class="detail-value">{{ $student->dob ? $student->dob->format('F d, Y') : 'N/A' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Phone</div>
                    <div class="detail-value">{{ $student->phone }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{ $student->email ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-row">
                    <div class="detail-label">Address</div>
                    <div class="detail-value">{{ $student->address ?? 'N/A' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Class</div>
                    <div class="detail-value">{{ $student->class->name ?? 'N/A' }} {{ $student->section ? '('.$student->section.')' : '' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Roll No</div>
                    <div class="detail-value">{{ $student->roll_no ?? 'N/A' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Guardian Name</div>
                    <div class="detail-value">{{ $student->guardian_name }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Guardian Phone</div>
                    <div class="detail-value">{{ $student->guardian_phone }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Enrolled On</div>
                    <div class="detail-value">{{ $student->created_at->format('F d, Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection