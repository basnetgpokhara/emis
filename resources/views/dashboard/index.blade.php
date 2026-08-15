@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', '<span>Dashboard</span>')

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="stat-card text-center py-5">
            <div class="stat-icon primary mx-auto">
                <i class="fas fa-user"></i>
            </div>
            <h4 class="fw-bold mt-3">Welcome, {{ $user->name }}!</h4>
            <p class="text-muted">You are logged in as <span class="badge bg-info">{{ ucfirst($user->role) }}</span></p>
            <p class="text-muted">Your personalized dashboard is being prepared.</p>
        </div>
    </div>
</div>
@endsection