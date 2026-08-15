@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', '<span>System</span> Settings')

@section('content')
<div class="row g-4">
    <!-- Exam Types -->
    <div class="col-md-6">
        <div class="table-card">
            <div class="card-header">
                <h5><i class="fas fa-file-alt me-2 text-primary"></i> Exam Types</h5>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#examTypeModal">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>#</th><th>Name</th><th>Description</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse($examTypes as $examType)
                            <tr>
                                <td>{{ $examType->id }}</td>
                                <td class="fw-semibold">{{ $examType->name }}</td>
                                <td>{{ $examType->description ?? 'N/A' }}</td>
                                <td>
                                    <form action="{{ route('admin.settings.exam-types.destroy', $examType) }}" method="POST" class="d-inline" onsubmit="event.preventDefault(); confirmDelete(event);">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">No exam types defined.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Fee Types -->
    <div class="col-md-6">
        <div class="table-card">
            <div class="card-header">
                <h5><i class="fas fa-money-bill-wave me-2 text-primary"></i> Fee Types</h5>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#feeTypeModal">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>#</th><th>Name</th><th>Amount</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse($feeTypes as $feeType)
                            <tr>
                                <td>{{ $feeType->id }}</td>
                                <td class="fw-semibold">{{ $feeType->name }}</td>
                                <td>${{ number_format($feeType->amount, 2) }}</td>
                                <td>
                                    <form action="{{ route('admin.settings.fee-types.destroy', $feeType) }}" method="POST" class="d-inline" onsubmit="event.preventDefault(); confirmDelete(event);">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">No fee types defined.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Exam Type Modal -->
<div class="modal fade" id="examTypeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid #e2e8f0;">
                <h5 class="fw-bold"><i class="fas fa-plus-circle me-2 text-primary"></i> Add Exam Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.settings.exam-types.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Exam Type Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. First Term">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Fee Type Modal -->
<div class="modal fade" id="feeTypeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid #e2e8f0;">
                <h5 class="fw-bold"><i class="fas fa-plus-circle me-2 text-primary"></i> Add Fee Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.settings.fee-types.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Fee Type Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Tuition Fee">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Amount <span class="text-danger">*</span></label>
                        <input type="number" name="amount" class="form-control" required step="0.01" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection