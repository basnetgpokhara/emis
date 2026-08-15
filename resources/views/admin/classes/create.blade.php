@extends('layouts.admin')

@section('title', 'Add Class')
@section('page-title', '<span>Add</span> Class')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.classes.index') }}">Classes</a></li>
            <li class="breadcrumb-item active">Add New</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-plus-circle me-2 text-primary"></i> Class Information</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.classes.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Class Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Class One" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Numeric Name <span class="text-danger">*</span></label>
                    <input type="number" name="numeric_name" class="form-control @error('numeric_name') is-invalid @enderror" value="{{ old('numeric_name') }}" min="1" max="12" required>
                    @error('numeric_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Section</label>
                    <input type="text" name="section" class="form-control @error('section') is-invalid @enderror" value="{{ old('section') }}" placeholder="e.g. A, B">
                    @error('section') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="2">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Class</button>
                <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection