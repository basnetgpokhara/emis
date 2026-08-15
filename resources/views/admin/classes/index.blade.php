@extends('layouts.admin')

@section('title', 'Classes')
@section('page-title', '<span>Classes</span> Management')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Classes</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.classes.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Class</a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-school me-2 text-primary"></i> All Classes</h5>
        <span class="badge bg-primary">{{ $classes->total() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Class Name</th>
                    <th>Numeric</th>
                    <th>Section</th>
                    <th>Students</th>
                    <th>Subjects</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $class)
                    <tr>
                        <td>{{ $class->id }}</td>
                        <td class="fw-semibold">{{ $class->name }}</td>
                        <td>{{ $class->numeric_name }}</td>
                        <td>{{ $class->section ?? 'N/A' }}</td>
                        <td><span class="badge bg-info">{{ $class->students_count }}</span></td>
                        <td><span class="badge bg-success">{{ $class->subjects_count }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.classes.show', $class) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event);">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-school"></i>
                            <h5>No Classes Found</h5>
                            <a href="{{ route('admin.classes.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Class</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($classes->hasPages())<div class="card-footer bg-transparent">{{ $classes->links() }}</div>@endif
</div>
@endsection