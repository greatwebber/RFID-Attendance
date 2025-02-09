<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    //

    public function index()
    {
        $lecturer = Auth::guard('lecturer')->user();

        // Get assigned courses and group by Department & Level
        $groupedCourses = $lecturer->courses()
            ->with('department')
            ->get()
            ->groupBy(['department.name', 'level']); // Group by Department then by Level

        return view('lecturer.courses.index', compact('groupedCourses'));
    }

    public function viewStudents(Course $course)
    {
        $lecturer = Auth::guard('lecturer')->user();

        // Ensure the lecturer is assigned to this course
        if (!$lecturer->courses()->where('course_id', $course->id)->exists()) {
            abort(403, 'Unauthorized access');
        }

        // Load students for the course
        $students = $course->students;

        return view('lecturer.courses.students', compact('course', 'students'));
    }


}
