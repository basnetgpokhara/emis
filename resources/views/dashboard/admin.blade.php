@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', '<span>Dashboard</span>')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-label">Total Students</div>
            <div class="stat-value">{{ $totalStudents }}</div>
            <div class="stat-change"><i class="fas fa-arrow-up me-1"></i> Active enrollments</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="stat-label">Total Teachers</div>
            <div class="stat-value">{{ $totalTeachers }}</div>
            <div class="stat-change"><i class="fas fa-arrow-up me-1"></i> Active staff</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-school"></i>
            </div>
            <div class="stat-label">Total Classes</div>
            <div class="stat-value">{{ $totalClasses }}</div>
            <div class="stat-change"><i class="fas fa-arrow-up me-1"></i> Active classes</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-label">Total Subjects</div>
            <div class="stat-value">{{ $totalSubjects }}</div>
            <div class="stat-change"><i class="fas fa-arrow-up me-1"></i> Active subjects</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-8">
        <div class="table-card">
            <div class="card-header">
                <h5><i class="fas fa-chart-line me-2 text-primary"></i> Monthly Enrollments</h5>
            </div>
            <div class="card-body">
                <canvas id="enrollmentChart" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="table-card">
            <div class="card-header">
                <h5><i class="fas fa-calendar-day me-2 text-primary"></i> Today's Attendance</h5>
            </div>
            <div class="card-body text-center py-4">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-3 rounded-3" style="background: rgba(72,187,120,0.1);">
                            <h2 class="fw-bold text-success mb-0">{{ $presentToday }}</h2>
                            <small class="text-muted">Present</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3" style="background: rgba(245,101,101,0.1);">
                            <h2 class="fw-bold text-danger mb-0">{{ $absentToday }}</h2>
                            <small class="text-muted">Absent</small>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="p-3 rounded-3" style="background: rgba(102,126,234,0.1);">
                        <h2 class="fw-bold text-primary mb-0">{{ $todayAttendance }}</h2>
                        <small class="text-muted">Total Today</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-6">
        <div class="table-card">
            <div class="card-header">
                <h5><i class="fas fa-user-graduate me-2 text-primary"></i> Recent Students</h5>
                <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Admission No</th>
                            <th>Class</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentStudents as $student)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.75rem; flex-shrink: 0;">
                                            {{ substr($student->first_name, 0, 1) }}
                                        </div>
                                        <span class="fw-semibold">{{ $student->first_name }} {{ $student->last_name }}</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">{{ $student->admission_no }}</span></td>
                                <td>{{ $student->class->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-{{ $student->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($student->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No students found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="table-card">
            <div class="card-header">
                <h5><i class="fas fa-chalkboard-teacher me-2 text-primary"></i> Recent Teachers</h5>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Subject</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTeachers as $teacher)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.75rem; flex-shrink: 0;">
                                            {{ substr($teacher->first_name, 0, 1) }}
                                        </div>
                                        <span class="fw-semibold">{{ $teacher->first_name }} {{ $teacher->last_name }}</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">{{ $teacher->employee_id }}</span></td>
                                <td>{{ $teacher->subject->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-{{ $teacher->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($teacher->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No teachers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var ctx = document.getElementById('enrollmentChart').getContext('2d');
    var enrollmentChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Enrollments',
                data: {!! json_encode($enrollmentData) !!},
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderColor: '#667eea',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        borderColor: '#e2e8f0'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush