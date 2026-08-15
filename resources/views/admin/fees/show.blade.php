@extends('layouts.admin')

@section('title', 'Fee Details')
@section('page-title', '<span>Fee</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.fees.index') }}">Fees</a></li>
            <li class="breadcrumb-item active">Fee #{{ $fee->id }}</li>
        </ol>
    </nav>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-avatar"><i class="fas fa-money-bill-wave"></i></div>
        <div>
            <h4 class="fw-bold mb-1">Fee Record</h4>
            <span class="badge bg-{{ $fee->status === 'paid' ? 'success' : ($fee->status === 'partial' ? 'warning' : 'danger') }}">{{ ucfirst($fee->status) }}</span>
        </div>
    </div>
    <div class="detail-body">
        <div class="detail-row"><div class="detail-label">Student</div><div class="detail-value">{{ $fee->student->first_name ?? '' }} {{ $fee->student->last_name ?? '' }}</div></div>
        <div class="detail-row"><div class="detail-label">Fee Type</div><div class="detail-value">{{ $fee->feeType->name ?? 'N/A' }}</div></div>
        <div class="detail-row"><div class="detail-label">Amount</div><div class="detail-value">${{ number_format($fee->amount, 2) }}</div></div>
        <div class="detail-row"><div class="detail-label">Paid Amount</div><div class="detail-value text-success fw-bold">${{ number_format($fee->paid_amount, 2) }}</div></div>
        <div class="detail-row"><div class="detail-label">Due Amount</div><div class="detail-value text-danger fw-bold">${{ number_format($fee->due_amount, 2) }}</div></div>
        <div class="detail-row"><div class="detail-label">Payment Date</div><div class="detail-value">{{ $fee->payment_date ? $fee->payment_date->format('M d, Y') : 'N/A' }}</div></div>
    </div>
</div>
@endsection