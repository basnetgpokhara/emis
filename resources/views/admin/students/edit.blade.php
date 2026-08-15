@extends('layouts.admin')

@section('title', 'Edit Student')
@section('page-title', '<span>Edit</span> Student')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header">
        <h5><i class="fas fa-user-edit me-2 text-primary"></i> Edit Student: {{ $student->first_name }} {{ $student->last_name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $student->first_name) }}" required>
                    @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $student->last_name) }}" required>
                    @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                        <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob', $student->dob ? $student->dob->format('Y-m-d') : '') }}" required>
                    @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $student->phone) }}" required>
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address', $student->address) }}</textarea>
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Guardian Name <span class="text-danger">*</span></label>
                    <input type="text" name="guardian_name" class="form-control @error('guardian_name') is-invalid @enderror" value="{{ old('guardian_name', $student->guardian_name) }}" required>
                    @error('guardian_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Guardian Phone <span class="text-danger">*</span></label>
                    <input type="text" name="guardian_phone" class="form-control @error('guardian_phone') is-invalid @enderror" value="{{ old('guardian_phone', $student->guardian_phone) }}" required>
                    @error('guardian_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Class <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select @error('class_id') is-invalid @enderror" required>
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                    @error('class_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Section</label>
                    <input type="text" name="section" class="form-control @error('section') is-invalid @enderror" value="{{ old('section', $student->section) }}">
                    @error('section') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Roll No</label>
                    <input type="text" name="roll_no" class="form-control @error('roll_no') is-invalid @enderror" value="{{ old('roll_no', $student->roll_no) }}">
                    @error('roll_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Photo</label>
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                    @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update Student
                </button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection