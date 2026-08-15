@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', '<span>Edit</span> User')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-user-edit me-2 text-primary"></i> Edit User: {{ $user->name }}</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">New Password (leave empty to keep current)</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                    <select name="role" class="form-select" required>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="parent" {{ old('role', $user->role) == 'parent' ? 'selected' : '' }}>Parent</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address', $user->address) }}</textarea>
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection