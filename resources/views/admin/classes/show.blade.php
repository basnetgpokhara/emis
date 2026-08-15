@extends('layouts.admin')

@section('title', 'Class Details')
@section('page-title', '<span>Class</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.classes.index') }}">Classes</a></li>
            <li class="breadcrumb-item active">{{ $class->name }}</li>
        </ol>
    </nav>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="detail-card">
            <div class="detail-header">
                <div class="detail-avatar"><i class="fas fa-school"></i></div>
                <div>
                    <h4 class="fw-bold mb-1">{{ $class->name }}</h4>
                    <span class="badge bg-info">Class {{ $class->numeric_name }} | {{ $class->section ?? 'No Section' }}</span>
                </div>
            </div>
            <div class="detail-body">
                <div class="detail-row"><div class="detail-label">Students</div><div class="detail-value">{{ $class->students->count() }}</div></div>
                <div class="detail-row"><div class="detail-label">Subjects</div><div class="detail-value">{{ $class->subjects->count() }}</div></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="table-card">
            <div class="card-header"><h5><i class="fas fa-user-graduate me-2 text-primary"></i> Enrolled Students</h5></div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>Admission No</th><th>Name</th><th>Roll No</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($class->students as $student)
                            <tr>
                                <td><span class="badge bg-info">{{ $student->admission_no }}</span></td>
                                <td class="fw-semibold">{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->roll_no ?? 'N/A' }}</td>
                                <td><span class="badge bg-{{ $student->status === 'active' ? 'success' : 'danger' }}">{{ ucfirst($student->status) }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No students enrolled yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection