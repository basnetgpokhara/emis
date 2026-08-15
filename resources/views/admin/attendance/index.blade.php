@extends('layouts.admin')

@section('title', 'Attendance')
@section('page-title', '<span>Attendance</span> Management')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Attendance</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Take Attendance</a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-calendar-check me-2 text-primary"></i> Attendance Records</h5>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Class</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->id }}</td>
                        <td class="fw-semibold">{{ $attendance->student->first_name ?? '' }} {{ $attendance->student->last_name ?? '' }}</td>
                        <td>{{ $attendance->class->name ?? 'N/A' }}</td>
                        <td>{{ $attendance->date->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : ($attendance->status === 'absent' ? 'danger' : ($attendance->status === 'late' ? 'warning' : 'info')) }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.attendance.edit', $attendance) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.attendance.destroy', $attendance) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event);">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">
                        <div class="empty-state">
                            <i class="fas fa-calendar-check"></i>
                            <h5>No Attendance Records</h5>
                            <p>Take attendance to get started.</p>
                            <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Take Attendance</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($attendances->hasPages())<div class="card-footer bg-transparent">{{ $attendances->links() }}</div>@endif
</div>
@endsection