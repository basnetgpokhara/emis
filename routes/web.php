<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Students
    Route::get('students/data', [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('students.data');
    Route::resource('students', App\Http\Controllers\Admin\StudentController::class);

    // Teachers
    Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class);

    // Classes
    Route::resource('classes', App\Http\Controllers\Admin\ClassController::class);

    // Subjects
    Route::resource('subjects', App\Http\Controllers\Admin\SubjectController::class);

    // Attendance
    Route::get('attendance/get-students/{class_id}', [App\Http\Controllers\Admin\AttendanceController::class, 'getStudentsByClass'])->name('attendance.getStudents');
    Route::resource('attendance', App\Http\Controllers\Admin\AttendanceController::class);

    // Exams
    Route::resource('exams', App\Http\Controllers\Admin\ExamController::class);

    // Results
    Route::get('results/get-students/{exam_id}', [App\Http\Controllers\Admin\ResultController::class, 'getStudentsByExam'])->name('results.getStudents');
    Route::resource('results', App\Http\Controllers\Admin\ResultController::class);

    // Enrollments
    Route::resource('enrollments', App\Http\Controllers\Admin\EnrollmentController::class);

    // Fees
    Route::resource('fees', App\Http\Controllers\Admin\FeeController::class);

    // Users
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
    Route::post('settings/exam-types', [App\Http\Controllers\Admin\SettingController::class, 'storeExamType'])->name('settings.exam-types.store');
    Route::put('settings/exam-types/{examType}', [App\Http\Controllers\Admin\SettingController::class, 'updateExamType'])->name('settings.exam-types.update');
    Route::delete('settings/exam-types/{examType}', [App\Http\Controllers\Admin\SettingController::class, 'destroyExamType'])->name('settings.exam-types.destroy');
    Route::post('settings/fee-types', [App\Http\Controllers\Admin\SettingController::class, 'storeFeeType'])->name('settings.fee-types.store');
    Route::put('settings/fee-types/{feeType}', [App\Http\Controllers\Admin\SettingController::class, 'updateFeeType'])->name('settings.fee-types.update');
    Route::delete('settings/fee-types/{feeType}', [App\Http\Controllers\Admin\SettingController::class, 'destroyFeeType'])->name('settings.fee-types.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');