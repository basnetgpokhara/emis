@extends('layouts.admin')

@section('title', 'Fees')
@section('page-title', '<span>Fees</span> Management')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Fees</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.fees.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Fee Record</a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-money-bill-wave me-2 text-primary"></i> Fee Records</h5>
        <span class="badge bg-primary">{{ $fees->total() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $fee)
                    <tr>
                        <td>{{ $fee->id }}</td>
                        <td class="fw-semibold">{{ $fee->student->first_name ?? '' }} {{ $fee->student->last_name ?? '' }}</td>
                        <td>{{ $fee->feeType->name ?? 'N/A' }}</td>
                        <td>${{ number_format($fee->amount, 2) }}</td>
                        <td class="text-success fw-bold">${{ number_format($fee->paid_amount, 2) }}</td>
                        <td class="text-danger fw-bold">${{ number_format($fee->due_amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $fee->status === 'paid' ? 'success' : ($fee->status === 'partial' ? 'warning' : 'danger') }}">
                                {{ ucfirst($fee->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.fees.edit', $fee) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.fees.destroy', $fee) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event);">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8">
                        <div class="empty-state">
                            <i class="fas fa-money-bill-wave"></i>
                            <h5>No Fee Records</h5>
                            <a href="{{ route('admin.fees.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Fee</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($fees->hasPages())<div class="card-footer bg-transparent">{{ $fees->links() }}</div>@endif
</div>
@endsection