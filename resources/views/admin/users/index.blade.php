@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', '<span>Users</span> Management')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
    <div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add User</a>
    </div>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-users-cog me-2 text-primary"></i> System Users</h5>
        <span class="badge bg-primary">{{ $users->total() }} Total</span>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.75rem; flex-shrink: 0;">{{ substr($user->name, 0, 1) }}</div>
                                <span class="fw-semibold">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td><span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'teacher' ? 'success' : 'info') }}">{{ ucfirst($user->role) }}</span></td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                @if(!$user->isAdmin() || $users->where('role', 'admin')->count() > 1)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete(event);">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-users-cog"></i>
                            <h5>No Users Found</h5>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add User</a>
                        </div>
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())<div class="card-footer bg-transparent">{{ $users->links() }}</div>@endif
</div>
@endsection