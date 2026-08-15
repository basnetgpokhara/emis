@extends('layouts.admin')

@section('title', 'User Details')
@section('page-title', '<span>User</span> Details')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ol>
    </nav>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-avatar">{{ substr($user->name, 0, 1) }}</div>
        <div>
            <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
            <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'teacher' ? 'success' : 'info') }}">{{ ucfirst($user->role) }}</span>
            <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">{{ ucfirst($user->status) }}</span>
        </div>
    </div>
    <div class="detail-body">
        <div class="detail-row"><div class="detail-label">Name</div><div class="detail-value">{{ $user->name }}</div></div>
        <div class="detail-row"><div class="detail-label">Email</div><div class="detail-value">{{ $user->email }}</div></div>
        <div class="detail-row"><div class="detail-label">Role</div><div class="detail-value">{{ ucfirst($user->role) }}</div></div>
        <div class="detail-row"><div class="detail-label">Phone</div><div class="detail-value">{{ $user->phone ?? 'N/A' }}</div></div>
        <div class="detail-row"><div class="detail-label">Address</div><div class="detail-value">{{ $user->address ?? 'N/A' }}</div></div>
        <div class="detail-row"><div class="detail-label">Joined On</div><div class="detail-value">{{ $user->created_at->format('M d, Y') }}</div></div>
    </div>
</div>
@endsection