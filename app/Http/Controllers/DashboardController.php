<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Exam;
use App\Models\Fee;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isTeacher()) {
            return $this->teacherDashboard();
        } elseif ($user->isStudent()) {
            return $this->studentDashboard();
        } else {
            return view('dashboard.index', compact('user'));
        }
    }

    private function adminDashboard()
    {
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalClasses = Classes::count();
        $totalSubjects = Subject::count();
        $totalUsers = User::count();
        $recentStudents = Student::latest()->take(5)->get();
        $recentTeachers = Teacher::latest()->take(5)->get();

        // Attendance stats for today
        $todayAttendance = Attendance::whereDate('date', today())->count();
        $presentToday = Attendance::whereDate('date', today())->where('status', 'present')->count();
        $absentToday = Attendance::whereDate('date', today())->where('status', 'absent')->count();

        // Monthly student enrollment chart data
        $monthlyEnrollments = Student::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $enrollmentData = [];
        foreach (range(1, 12) as $m) {
            $enrollmentData[] = $monthlyEnrollments[$m] ?? 0;
        }

        return view('dashboard.admin', compact(
            'totalStudents', 'totalTeachers', 'totalClasses', 'totalSubjects',
            'totalUsers', 'recentStudents', 'recentTeachers',
            'todayAttendance', 'presentToday', 'absentToday',
            'months', 'enrollmentData'
        ));
    }

    private function teacherDashboard()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();
        $totalStudents = Student::where('class_id', $teacher->subject->class_id ?? 0)->count();
        $myClasses = Classes::count();
        $mySubjects = Subject::count();

        return view('dashboard.teacher', compact('teacher', 'totalStudents', 'myClasses', 'mySubjects'));
    }

    private function studentDashboard()
    {
        $student = Student::where('user_id', Auth::id())->first();
        $attendances = Attendance::where('student_id', $student->id ?? 0)->get();
        $attendancePercentage = $attendances->count() > 0
            ? round(($attendances->where('status', 'present')->count() / $attendances->count()) * 100, 2)
            : 0;

        return view('dashboard.student', compact('student', 'attendances', 'attendancePercentage'));
    }
}