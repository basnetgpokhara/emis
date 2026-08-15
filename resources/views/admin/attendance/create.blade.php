@extends('layouts.admin')

@section('title', 'Take Attendance')
@section('page-title', '<span>Take</span> Attendance')

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}">Attendance</a></li>
            <li class="breadcrumb-item active">Take Attendance</li>
        </ol>
    </nav>
</div>

<div class="table-card">
    <div class="card-header"><h5><i class="fas fa-clipboard-list me-2 text-primary"></i> Mark Attendance</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.attendance.store') }}" method="POST" id="attendanceForm">
            @csrf
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Class <span class="text-danger">*</span></label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" class="btn btn-primary" onclick="loadStudents()">
                        <i class="fas fa-sync me-1"></i> Load Students
                    </button>
                </div>
            </div>

            <div id="studentsContainer">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Select a class and date, then click "Load Students" to mark attendance.
                </div>
            </div>

            <div class="mt-4 pt-3 border-top d-flex gap-2" id="submitBtnContainer" style="display: none;">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-save me-1"></i> Save Attendance
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function loadStudents() {
        var classId = document.getElementById('class_id').value;
        if (!classId) {
            alert('Please select a class first.');
            return;
        }

        fetch('/admin/attendance/get-students/' + classId)
            .then(response => response.json())
            .then(students => {
                var container = document.getElementById('studentsContainer');
                var submitBtn = document.getElementById('submitBtnContainer');

                if (students.length === 0) {
                    container.innerHTML = '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle me-2"></i> No active students found in this class.</div>';
                    submitBtn.style.display = 'none';
                    return;
                }

                var html = '<div class="table-responsive"><table class="table"><thead><tr><th>#</th><th>Student</th><th>Roll No</th><th>Status</th><th>Remark</th></tr></thead><tbody>';
                students.forEach(function(student, index) {
                    html += '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td class="fw-semibold">' + student.first_name + ' ' + student.last_name + '</td>' +
                        '<td>' + (student.roll_no || 'N/A') + '</td>' +
                        '<td>' +
                        '<select name="students[' + student.id + '][status]" class="form-select form-select-sm" required>' +
                        '<option value="present">Present</option>' +
                        '<option value="absent">Absent</option>' +
                        '<option value="late">Late</option>' +
                        '<option value="holiday">Holiday</option>' +
                        '</select>' +
                        '</td>' +
                        '<td><input type="text" name="students[' + student.id + '][remark]" class="form-control form-control-sm" placeholder="Optional remark"></td>' +
                        '</tr>';
                });
                html += '</tbody></table></div>';

                container.innerHTML = html;
                submitBtn.style.display = 'flex';
            })
            .catch(error => {
                alert('Error loading students. Please try again.');
                console.error(error);
            });
    }
</script>
@endsection