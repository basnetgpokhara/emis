@extends('layouts.admin')

@section('title', 'Students')
@section('page-title', '<span>Students</span> Management')

@section('content')
<div class="page-header">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Students</li>
            </ol>
        </nav>
    </div>
    <div>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Student
        </a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-user-graduate me-2 text-primary"></i> All Students</h5>
        <span class="badge bg-primary">{{ $students->total() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Admission No</th>
                    <th>Name</th>
                    <th>Class/Section</th>
                    <th>Roll No</th>
                    <th>Gender</th>
                    <th>Guardian</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td><span class="badge bg-info">{{ $student->admission_no }}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.75rem; flex-shrink: 0;
                                    background: {{ $student->gender === 'male' ? 'linear-gradient(135deg, #667eea, #764ba2)' : 'linear-gradient(135deg, #f093fb, #f5576c)' }};">
                                    {{ substr($student->first_name, 0, 1) }}
                                </div>
                                <span class="fw-semibold">{{ $student->first_name }} {{ $student->last_name }}</span>
                            </div>
                        </td>
                        <td>{{ $student->class->name ?? 'N/A' }} {{ $student->section ? '('.$student->section.')' : '' }}</td>
                        <td>{{ $student->roll_no ?? 'N/A' }}</td>
                        <td>{{ ucfirst($student->gender) }}</td>
                        <td>
                            <small class="d-block fw-semibold">{{ $student->guardian_name }}</small>
                            <small class="text-muted">{{ $student->guardian_phone }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $student->status === 'active' ? 'success' : ($student->status === 'inactive' ? 'danger' : 'warning') }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.students.show', $student) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event, 'Delete this student?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="fas fa-user-graduate"></i>
                                <h5>No Students Found</h5>
                                <p>Get started by adding your first student.</p>
                                <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Add Student
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($students->hasPages())
        <div class="card-footer bg-transparent">
            {{ $students->links() }}
        </div>
    @endif
</div>
@endsection