@extends('layouts.admin')

@section('title', 'Subject Details')
@section('page-title', '<span>Subject</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.subjects.index') }}">Subjects</a></li>
            <li class="breadcrumb-item active">{{ $subject->name }}</li>
        </ol>
    </nav>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-avatar"><i class="fas fa-book"></i></div>
        <div>
            <h4 class="fw-bold mb-1">{{ $subject->name }}</h4>
            <span class="badge bg-info">{{ $subject->code }}</span>
            <span class="badge bg-success">{{ $subject->class->name ?? 'N/A' }}</span>
        </div>
    </div>
    <div class="detail-body">
        <div class="detail-row"><div class="detail-label">Subject Name</div><div class="detail-value">{{ $subject->name }}</div></div>
        <div class="detail-row"><div class="detail-label">Code</div><div class="detail-value">{{ $subject->code }}</div></div>
        <div class="detail-row"><div class="detail-label">Class</div><div class="detail-value">{{ $subject->class->name ?? 'N/A' }}</div></div>
        <div class="detail-row"><div class="detail-label">Description</div><div class="detail-value">{{ $subject->description ?? 'No description' }}</div></div>
        <div class="detail-row"><div class="detail-label">Created On</div><div class="detail-value">{{ $subject->created_at->format('F d, Y') }}</div></div>
    </div>
</div>
@endsection