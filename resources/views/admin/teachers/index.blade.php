@extends('layouts.admin')

@section('title', 'Teachers')
@section('page-title', '<span>Teachers</span> Management')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Teachers</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Teacher
        </a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-chalkboard-teacher me-2 text-primary"></i> All Teachers</h5>
        <span class="badge bg-primary">{{ $teachers->total() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr>
                        <td><span class="badge bg-info">{{ $teacher->employee_id }}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.75rem; flex-shrink: 0;
                                    background: linear-gradient(135deg, #667eea, #764ba2);">
                                    {{ substr($teacher->first_name, 0, 1) }}
                                </div>
                                <span class="fw-semibold">{{ $teacher->first_name }} {{ $teacher->last_name }}</span>
                            </div>
                        </td>
                        <td>{{ $teacher->subject->name ?? 'N/A' }}</td>
                        <td>{{ $teacher->qualification }}</td>
                        <td>{{ $teacher->experience }} yrs</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>
                            <span class="badge bg-{{ $teacher->status === 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($teacher->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.teachers.show', $teacher) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event);">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <h5>No Teachers Found</h5>
                                <p>Get started by adding your first teacher.</p>
                                <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Teacher</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($teachers->hasPages())
        <div class="card-footer bg-transparent">{{ $teachers->links() }}</div>
    @endif
</div>
@endsection