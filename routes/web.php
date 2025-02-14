<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\RfidController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\Lecturer\DashboardController;
use App\Http\Controllers\Lecturer\LecturerAttendanceController;
use App\Http\Controllers\LecturerAuthController;
use App\Http\Controllers\LecturerCourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/faculties', FacultyController::class);
    Route::resource('admin/departments', DepartmentController::class);
    Route::resource('admin/lecturers', LecturerController::class);
    Route::resource('admin/courses', CourseController::class);

    // Assign Courses to Lecturers
    Route::get('admin/lecturers/{lecturer}/assign-courses', [LecturerCourseController::class, 'assignCourses'])
        ->name('lecturers.assignCourses');

    Route::post('admin/lecturers/{lecturer}/assign-courses', [LecturerCourseController::class, 'storeAssignedCourses'])
        ->name('lecturers.assignCourses.store');


    Route::resource('admin/students', StudentController::class);
    Route::get('admin/students/{id}/generate-rfid', [StudentController::class, 'generateRFID'])->name('students.generate-rfid');
    Route::get('admin/students/{id}/print-rfid', [StudentController::class, 'printRFID'])->name('students.print-rfid');

    Route::resource('admin/rfid', RfidController::class);

});



Route::prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/login', [LecturerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LecturerAuthController::class, 'login']);

    Route::middleware('auth:lecturer')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/my-courses', [\App\Http\Controllers\Lecturer\CourseController::class, 'index'])->name('courses');
        Route::get('/courses/{course}/students', [\App\Http\Controllers\Lecturer\CourseController::class, 'viewStudents'])->name('courses.students');

        Route::get('/attendance/create', [LecturerAttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/attendance/store', [LecturerAttendanceController::class, 'store'])->name('attendance.store');
        Route::get('/attendance', [LecturerAttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/attendance/{session}/edit', [LecturerAttendanceController::class, 'edit'])->name('attendance.edit');
        Route::post('/attendance/{session}/update', [LecturerAttendanceController::class, 'update'])->name('attendance.update');
        Route::delete('/attendance/{session}/delete', [LecturerAttendanceController::class, 'destroy'])->name('attendance.destroy');

        Route::get('/attendance/{course_id}', [LecturerAttendanceController::class, 'viewAttendance'])
            ->name('attendance.view');


        Route::post('/logout', [LecturerAuthController::class, 'logout'])->name('logout');
    });
});
