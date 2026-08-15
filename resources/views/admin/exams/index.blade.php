@extends('layouts.admin')

@section('title', 'Exams')
@section('page-title', '<span>Exams</span> Management')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Exams</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.exams.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Create Exam</a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-file-alt me-2 text-primary"></i> All Exams</h5>
        <span class="badge bg-primary">{{ $exams->total() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Exam Name</th>
                    <th>Type</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Total Marks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($exams as $exam)
                    <tr>
                        <td>{{ $exam->id }}</td>
                        <td class="fw-semibold">{{ $exam->name }}</td>
                        <td>{{ $exam->examType->name ?? 'N/A' }}</td>
                        <td>{{ $exam->class->name ?? 'N/A' }}</td>
                        <td>{{ $exam->subject->name ?? 'N/A' }}</td>
                        <td>{{ $exam->date ? $exam->date->format('M d, Y') : 'N/A' }}</td>
                        <td><span class="badge bg-info">{{ $exam->total_marks }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.exams.show', $exam) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.exams.edit', $exam) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.exams.destroy', $exam) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event);">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8">
                        <div class="empty-state">
                            <i class="fas fa-file-alt"></i>
                            <h5>No Exams Created</h5>
                            <a href="{{ route('admin.exams.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Create Exam</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($exams->hasPages())<div class="card-footer bg-transparent">{{ $exams->links() }}</div>@endif
</div>
@endsection