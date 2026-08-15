@extends('layouts.admin')

@section('title', 'Enrollments')
@section('page-title', '<span>Enrollments</span> Management')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Enrollments</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> New Enrollment</a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-user-plus me-2 text-primary"></i> All Enrollments</h5>
        <span class="badge bg-primary">{{ $enrollments->total() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Class</th>
                    <th>Academic Year</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->id }}</td>
                        <td class="fw-semibold">{{ $enrollment->student->first_name ?? '' }} {{ $enrollment->student->last_name ?? '' }}</td>
                        <td>{{ $enrollment->class->name ?? 'N/A' }}</td>
                        <td>{{ $enrollment->academic_year }}</td>
                        <td>
                            <span class="badge bg-{{ $enrollment->status === 'active' ? 'success' : ($enrollment->status === 'inactive' ? 'danger' : 'warning') }}">
                                {{ ucfirst($enrollment->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.enrollments.edit', $enrollment) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.enrollments.destroy', $enrollment) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event);">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">
                        <div class="empty-state">
                            <i class="fas fa-user-plus"></i>
                            <h5>No Enrollments</h5>
                            <a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> New Enrollment</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($enrollments->hasPages())<div class="card-footer bg-transparent">{{ $enrollments->links() }}</div>@endif
</div>
@endsection