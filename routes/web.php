<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
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
    Route::get('admin/lecturers/{lecturer}/assign-courses', [LecturerController::class, 'assignCourses'])->name('lecturers.assignCourses');
    Route::post('admin/lecturers/{lecturer}/assign-courses', [LecturerController::class, 'storeAssignedCourses'])->name('lecturers.storeAssignedCourses');


    Route::resource('admin/students', StudentController::class);
    Route::get('admin/students/{id}/generate-rfid', [StudentController::class, 'generateRFID'])->name('students.generate-rfid');
    Route::get('admin/students/{id}/print-rfid', [StudentController::class, 'printRFID'])->name('students.print-rfid');

});
