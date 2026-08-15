<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'EMIS') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #5a67d8;
            --secondary: #764ba2;
            --success: #48bb78;
            --warning: #ecc94b;
            --danger: #f56565;
            --info: #4299e1;
            --dark: #2d3748;
            --light: #f7fafc;
            --sidebar-width: 260px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: #f0f2f5;
            overflow-x: hidden;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c7cd;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #2d3748 0%, #1a202c 100%);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-brand {
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-gradient, linear-gradient(135deg, #667eea, #764ba2));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .sidebar-brand .brand-text {
            color: white;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .sidebar-brand .brand-text small {
            display: block;
            font-weight: 300;
            font-size: 0.7rem;
            opacity: 0.7;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu .menu-label {
            padding: 0.75rem 1.5rem 0.5rem;
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        .sidebar-menu .nav-item {
            position: relative;
        }

        .sidebar-menu .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.7rem 1.5rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            position: relative;
        }

        .sidebar-menu .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.08);
            border-left-color: var(--primary);
        }

        .sidebar-menu .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.12);
            border-left-color: var(--primary);
        }

        .sidebar-menu .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .sidebar-menu .nav-link .badge {
            margin-left: auto;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Header */
        .header {
            background: white;
            height: var(--header-height);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .header .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--dark);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s;
            display: none;
        }

        .header .sidebar-toggle:hover {
            background: #f0f2f5;
        }

        .header .page-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
        }

        .header .page-title span {
            color: var(--primary);
        }

        /* User Dropdown */
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .user-dropdown:hover {
            background: #f0f2f5;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background: var(--primary-gradient, linear-gradient(135deg, #667eea, #764ba2));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .user-info .user-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }

        .user-info .user-role {
            font-size: 0.7rem;
            color: #718096;
            text-transform: capitalize;
        }

        /* Content Area */
        .content {
            padding: 1.5rem;
        }

        /* Cards */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.2;
        }

        .stat-card .stat-change {
            font-size: 0.8rem;
            color: var(--success);
            font-weight: 600;
        }

        .stat-icon.primary { background: rgba(102,126,234,0.15); color: var(--primary); }
        .stat-icon.success { background: rgba(72,187,120,0.15); color: var(--success); }
        .stat-icon.warning { background: rgba(236,201,75,0.15); color: var(--warning); }
        .stat-icon.danger { background: rgba(245,101,101,0.15); color: var(--danger); }
        .stat-icon.info { background: rgba(66,153,225,0.15); color: var(--info); }

        /* Table Card */
        .table-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: none;
            overflow: hidden;
        }

        .table-card .card-header {
            background: transparent;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-card .card-header h5 {
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }

        .table-card .table {
            margin-bottom: 0;
        }

        .table-card .table th {
            background: #f7fafc;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #718096;
            padding: 0.75rem 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-card .table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .table-card .table tr:hover {
            background: #f7fafc;
        }

        /* Buttons */
        .btn {
            border-radius: 10px;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--primary-gradient, linear-gradient(135deg, #667eea, #764ba2));
            border: none;
            box-shadow: 0 4px 15px rgba(102,126,234,0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102,126,234,0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78, #38a169);
            border: none;
            box-shadow: 0 4px 15px rgba(72,187,120,0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f56565, #e53e3e);
            border: none;
            box-shadow: 0 4px 15px rgba(245,101,101,0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ecc94b, #d69e2e);
            border: none;
            color: white;
        }

        .btn-info {
            background: linear-gradient(135deg, #4299e1, #3182ce);
            border: none;
            color: white;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.8rem;
        }

        /* Form Controls */
        .form-control, .form-select {
            border-radius: 10px;
            padding: 0.6rem 1rem;
            border: 2px solid #e2e8f0;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
        }

        /* Badge */
        .badge {
            font-weight: 600;
            padding: 0.4rem 0.75rem;
            border-radius: 8px;
            font-size: 0.75rem;
        }

        .badge.bg-success { background: linear-gradient(135deg, #48bb78, #38a169) !important; }
        .badge.bg-danger { background: linear-gradient(135deg, #f56565, #e53e3e) !important; }
        .badge.bg-warning { background: linear-gradient(135deg, #ecc94b, #d69e2e) !important; }
        .badge.bg-info { background: linear-gradient(135deg, #4299e1, #3182ce) !important; }

        /* Pagination */
        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            border: none;
            color: var(--dark);
            font-weight: 600;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-gradient, linear-gradient(135deg, #667eea, #764ba2));
        }

        /* Alert */
        .alert {
            border-radius: 12px;
            border: none;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .header .sidebar-toggle {
                display: block;
            }
            .sidebar-backdrop {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            .sidebar-backdrop.show {
                display: block;
            }
        }

        @media (max-width: 767.98px) {
            .content {
                padding: 1rem;
            }
            .header {
                padding: 0 1rem;
            }
            .user-info {
                display: none;
            }
            .stat-card .stat-value {
                font-size: 1.5rem;
            }
            .table-card .card-header {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-in {
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 1rem;
        }

        .empty-state h5 {
            color: #718096;
            font-weight: 600;
        }

        .empty-state p {
            color: #a0aec0;
        }

        /* Page Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h4 {
            font-weight: 800;
            color: var(--dark);
            margin: 0;
        }

        .page-header .breadcrumb {
            margin: 0;
            background: transparent;
            padding: 0;
        }

        .page-header .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        .page-header .breadcrumb-item.active {
            color: #718096;
        }

        /* Detail Card */
        .detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: none;
            overflow: hidden;
        }

        .detail-card .detail-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .detail-card .detail-header .detail-avatar {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .detail-card .detail-body {
            padding: 1.5rem;
        }

        .detail-card .detail-row {
            display: flex;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f2f5;
        }

        .detail-card .detail-row:last-child {
            border-bottom: none;
        }

        .detail-card .detail-label {
            width: 180px;
            font-weight: 600;
            color: #718096;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .detail-card .detail-value {
            color: var(--dark);
            font-weight: 500;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar Backdrop -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="brand-text">
                EMIS
                <small>Education Management</small>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-label">Main</div>
            <div class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            @if(auth()->user()->isAdmin())
            <div class="menu-label">Management</div>
            <div class="nav-item">
                <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i>
                    <span>Students</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.teachers.index') }}" class="nav-link {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Teachers</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.classes.index') }}" class="nav-link {{ request()->routeIs('admin.classes.*') ? 'active' : '' }}">
                    <i class="fas fa-school"></i>
                    <span>Classes</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.subjects.index') }}" class="nav-link {{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
                    <i class="fas fa-book"></i>
                    <span>Subjects</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.enrollments.index') }}" class="nav-link {{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
                    <i class="fas fa-user-plus"></i>
                    <span>Enrollments</span>
                </a>
            </div>

            <div class="menu-label">Academic</div>
            <div class="nav-item">
                <a href="{{ route('admin.attendance.index') }}" class="nav-link {{ request()->routeIs('admin.attendance.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Attendance</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.exams.index') }}" class="nav-link {{ request()->routeIs('admin.exams.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Exams</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.results.index') }}" class="nav-link {{ request()->routeIs('admin.results.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Results</span>
                </a>
            </div>

            <div class="menu-label">Finance</div>
            <div class="nav-item">
                <a href="{{ route('admin.fees.index') }}" class="nav-link {{ request()->routeIs('admin.fees.*') ? 'active' : '' }}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Fees</span>
                </a>
            </div>

            <div class="menu-label">Administration</div>
            <div class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i>
                    <span>Users</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
            @endif

            <div class="menu-label">Account</div>
            <div class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="page-title">
                    @yield('page-title', 'Dashboard')
                </div>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <div class="user-dropdown" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="user-info d-none d-md-block">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-role">{{ auth()->user()->role }}</div>
                        </div>
                        <i class="fas fa-chevron-down text-muted" style="font-size: 0.7rem;"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="border-radius: 12px; border: none; padding: 0.5rem;">
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="fas fa-th-large me-2"></i> Dashboard
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="content fade-in">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Toggle sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarBackdrop').classList.toggle('show');
        }

        document.getElementById('sidebarBackdrop')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            this.classList.remove('show');
        });

        // Auto close alerts
        document.querySelectorAll('.alert-dismissible').forEach(function(alert) {
            setTimeout(function() {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });

        // Confirm delete
        function confirmDelete(event, message) {
            event.preventDefault();
            var form = event.target.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: message || 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>