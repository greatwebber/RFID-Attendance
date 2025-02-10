<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceSession;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $lecturer = Auth::guard('lecturer')->user();

        // Count total assigned courses
        $totalCourses = $lecturer->courses()->count();

        // Count total students under the lecturer's courses
        $totalStudents = Student::whereHas('courses', function ($query) use ($lecturer) {
            $query->whereIn('courses.id', $lecturer->courses->pluck('id'));
        })->distinct()->count();

        // Get today's date
        $today = now()->toDateString();

        // Count attendance sessions created by the lecturer
        $sessionIds = AttendanceSession::whereIn('course_id', $lecturer->courses->pluck('id'))
            ->whereDate('session_time', $today)
            ->pluck('id');

        // Count students who attended sessions today
        $totalAttendance = Attendance::whereIn('session_id', $sessionIds)->count();

        $totalStudentsExpected = $totalStudents > 0 ? $totalStudents : 1; // Avoid division by zero
        $attendancePercentage = round(($totalAttendance / $totalStudentsExpected) * 100, 2);

        return view('lecturer.dashboard', compact('totalCourses', 'totalStudents', 'attendancePercentage'));
    }



}
