@extends('layouts.admin')

@section('title', 'Results')
@section('page-title', '<span>Results</span> Management')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Results</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.results.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Result</a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-chart-bar me-2 text-primary"></i> All Results</h5>
        <span class="badge bg-primary">{{ $results->total() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Exam</th>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results as $result)
                    <tr>
                        <td>{{ $result->id }}</td>
                        <td class="fw-semibold">{{ $result->student->first_name ?? '' }} {{ $result->student->last_name ?? '' }}</td>
                        <td>{{ $result->exam->name ?? 'N/A' }}</td>
                        <td>{{ $result->subject->name ?? 'N/A' }}</td>
                        <td>{{ $result->marks_obtained }}</td>
                        <td><span class="badge bg-primary">{{ $result->grade ?? 'N/A' }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.results.edit', $result) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.results.destroy', $result) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event);">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-chart-bar"></i>
                            <h5>No Results Found</h5>
                            <a href="{{ route('admin.results.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Result</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($results->hasPages())<div class="card-footer bg-transparent">{{ $results->links() }}</div>@endif
</div>
@endsection