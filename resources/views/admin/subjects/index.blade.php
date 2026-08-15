@extends('layouts.admin')

@section('title', 'Subjects')
@section('page-title', '<span>Subjects</span> Management')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Subjects</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Subject</a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-book me-2 text-primary"></i> All Subjects</h5>
        <span class="badge bg-primary">{{ $subjects->total() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subject Name</th>
                    <th>Code</th>
                    <th>Class</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td class="fw-semibold">{{ $subject->name }}</td>
                        <td><span class="badge bg-info">{{ $subject->code }}</span></td>
                        <td>{{ $subject->class->name ?? 'N/A' }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.subjects.show', $subject) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event);">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <i class="fas fa-book"></i>
                            <h5>No Subjects Found</h5>
                            <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Subject</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($subjects->hasPages())<div class="card-footer bg-transparent">{{ $subjects->links() }}</div>@endif
</div>
@endsection