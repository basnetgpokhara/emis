@extends('layouts.admin')

@section('title', 'Teacher Details')
@section('page-title', '<span>Teacher</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.teachers.index') }}">Teachers</a></li>
            <li class="breadcrumb-item active">{{ $teacher->first_name }} {{ $teacher->last_name }}</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i> Edit</a>
    </div>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-avatar">{{ substr($teacher->first_name, 0, 1) }}{{ substr($teacher->last_name, 0, 1) }}</div>
        <div>
            <h4 class="fw-bold mb-1">{{ $teacher->first_name }} {{ $teacher->last_name }}</h4>
            <span class="badge bg-{{ $teacher->status === 'active' ? 'success' : 'danger' }}">{{ ucfirst($teacher->status) }}</span>
            <span class="badge bg-info">{{ $teacher->employee_id }}</span>
        </div>
    </div>
    <div class="detail-body">
        <div class="row">
            <div class="col-md-6">
                <div class="detail-row"><div class="detail-label">Employee ID</div><div class="detail-value">{{ $teacher->employee_id }}</div></div>
                <div class="detail-row"><div class="detail-label">Full Name</div><div class="detail-value">{{ $teacher->first_name }} {{ $teacher->last_name }}</div></div>
                <div class="detail-row"><div class="detail-label">Gender</div><div class="detail-value">{{ ucfirst($teacher->gender) }}</div></div>
                <div class="detail-row"><div class="detail-label">Date of Birth</div><div class="detail-value">{{ $teacher->dob ? $teacher->dob->format('F d, Y') : 'N/A' }}</div></div>
                <div class="detail-row"><div class="detail-label">Phone</div><div class="detail-value">{{ $teacher->phone }}</div></div>
                <div class="detail-row"><div class="detail-label">Email</div><div class="detail-value">{{ $teacher->email }}</div></div>
            </div>
            <div class="col-md-6">
                <div class="detail-row"><div class="detail-label">Address</div><div class="detail-value">{{ $teacher->address ?? 'N/A' }}</div></div>
                <div class="detail-row"><div class="detail-label">Qualification</div><div class="detail-value">{{ $teacher->qualification }}</div></div>
                <div class="detail-row"><div class="detail-label">Experience</div><div class="detail-value">{{ $teacher->experience }} years</div></div>
                <div class="detail-row"><div class="detail-label">Subject</div><div class="detail-value">{{ $teacher->subject->name ?? 'N/A' }}</div></div>
                <div class="detail-row"><div class="detail-label">Joined On</div><div class="detail-value">{{ $teacher->created_at->format('F d, Y') }}</div></div>
            </div>
        </div>
    </div>
</div>
@endsection